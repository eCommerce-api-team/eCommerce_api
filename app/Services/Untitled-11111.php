$lock = Cache::lock("payment_" . $userId, 10);

if (!$lock->get()) {
    return "في عملية شغالة";
}

try {

    // 🟢 Idempotency
    $key = "payment_" . $request->idempotency_key;

    if (!Redis::set($key, 1, ['NX', 'EX' => 60])) {
        return "أنت دفعت قبل كده";
    }

    DB::transaction(function () {

        // 🔴 DB Lock
        $product = Product::lockForUpdate()->find(1);

        if ($product->stock <= 0) {
            throw new Exception("خلص");
        }

        $product->stock--;
        $product->save();

        processPayment();

    });

} finally {
    $lock->release();
}=