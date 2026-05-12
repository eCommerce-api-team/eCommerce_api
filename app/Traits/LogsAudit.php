<?php

namespace App\Traits;

use App\Models\AuditLogs;

trait LogsAudit
{
    public function logActivity(
        $model, string $action, $oldValues = null, $newValues = null
    ): void {

        AuditLogs::create([

            'actor_id' => auth()->id,
            'action' => strtolower(class_basename($model)).'_'.$action,
            'auditable_type' => get_class($model),
            'auditable_id' => $model->id,
            'payload_before' => $oldValues,
            'payload_after' => $newValues,
        ]);
    }
}
