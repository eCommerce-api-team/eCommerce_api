<?php

namespace App\Observers;

class UserObserver
{
    use LogsAudit;

    public function updated($model)
    {
        $this->LogActivity($model, 'active_status_updated', $model->getOriginal(), $model->toArray());
    }
}
