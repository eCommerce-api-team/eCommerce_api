<?php

namespace App\Observers;

class OrderObserver
{
    use LogsAudit;

    public function updated($model)
    {
        $this->LogActivity($model, 'payment_status_updated', $model->getOriginal(), $model->toArray());
    }
}
