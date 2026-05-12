<?php

namespace App\Observers;

class BaseObserver
{
    use LogsAudit;

    public function created($model)
    {
        $this->LogActivity($model, 'created', null, $model->toArray());
    }

    public function updated($model)
    {
        $this->LogActivity($model, 'updated', $model->getOriginal(), $model->toArray());
    }

    public function deleted($model)
    {
        $this->LogActivity($model, 'soft_deleted', $model->toArray(), null);
    }

    public function restored($model)
    {
        $this->LogActivity($model, 'restored', null, $model->toArray());
    }

    public function forceDeleted($model)
    {
        $this->LogActivity($model, 'force_deleted', $model->toArray(), null);
    }
}
