<?php

namespace App\Observers;

use App\Traits\LogsAudit;

class OrderObserver
{
    use LogsAudit;

    public function updated($model)
    {
        $this->LogActivity($model, 'payment_status_updated', $model->getOriginal(), $model->toArray());
    }
}
