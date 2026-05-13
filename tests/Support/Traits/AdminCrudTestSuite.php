<?php

namespace Tests\Support\Traits;

trait AdminCrudTestSuite
{
    abstract protected function endpoint(): string;

    abstract protected function modelFactory();

    abstract protected function storeValidData(): array;

    abstract protected function updateValidData(): array;

    public function test_store(): void
    {
        $data = $this->storeValidData();

        $this->assertAdminSuccess(
            'POST',
            $this->endpoint(),
            $data,
            function () use ($data) {
                $table = app($this->modelFactory())->getTable();
                $this->assertDatabaseHas($table, $data);
            }
        );

        $this->assertCustomerForbidden('POST', $this->endpoint(), $data);
        $this->assertGuestUnauthorized('POST', $this->endpoint(), $data);
    }

    public function test_update(): void
    {
        $model = $this->modelFactory()::factory()->create();
        $data = $this->updateValidData();

        $this->assertAdminSuccess(
            'PUT',
            "{$this->endpoint()}/{$model->id}",
            $data
        );

        $this->assertCustomerForbidden('PUT', "{$this->endpoint()}/{$model->id}", $data);
        $this->assertGuestUnauthorized('PUT', "{$this->endpoint()}/{$model->id}", $data);
    }

    public function test_delete(): void
    {
        $model = $this->modelFactory()::factory()->create();

        $this->assertAdminSuccess(
            'DELETE',
            "{$this->endpoint()}/{$model->id}",
            [],
            function () use ($model) {
                $table = app($this->modelFactory())->getTable();
                $this->assertSoftDeleted($table, ['id' => $model->id]);
            }
        );

        $this->assertCustomerForbidden('DELETE', "{$this->endpoint()}/{$model->id}");
        $this->assertGuestUnauthorized('DELETE', "{$this->endpoint()}/{$model->id}");
    }

    public function test_restore(): void
    {
        $model = $this->modelFactory()::factory()->trashed()->create();

        $this->assertAdminSuccess(
            'PATCH',
            "{$this->endpoint()}/{$model->id}/restore"
        );

        $this->assertCustomerForbidden('PATCH', "{$this->endpoint()}/{$model->id}/restore");
        $this->assertGuestUnauthorized('PATCH', "{$this->endpoint()}/{$model->id}/restore");
    }

    public function test_force_delete(): void
    {
        $model = $this->modelFactory()::factory()->trashed()->create();

        $this->assertAdminSuccess(
            'DELETE',
            "{$this->endpoint()}/{$model->id}/force"
        );

        $this->assertCustomerForbidden('DELETE', "{$this->endpoint()}/{$model->id}/force");
        $this->assertGuestUnauthorized('DELETE', "{$this->endpoint()}/{$model->id}/force");
    }
}
