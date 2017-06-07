<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\Contracts\RepairRepositoryContract::class,
            \App\Repositories\Eloquents\RepairEloquentRepository::class,
            \App\Repositories\Contracts\DormRepositoryContract::class,
            \App\Repositories\Eloquents\DormEloquentRepository::class,
            \App\Repositories\Contracts\AdminRepositoryContract::class,
            \App\Repositories\Eloquents\AdminEloquentRepository::class,
            \App\Repositories\Contracts\RoleRepositoryContract::class,
            \App\Repositories\Eloquents\RoleEloquentRepository::class,
            \App\Repositories\Contracts\PermissionRepositoryContract::class,
            \App\Repositories\Eloquents\PermissionEloquentRepository::class,
            \App\Repositories\Contracts\AttachmentRepositoryContract::class,
            \App\Repositories\Eloquents\AttachmentEloquentRepository::class,
            \App\Repositories\Contracts\CategoryRepositoryContract::class,
            \App\Repositories\Eloquents\CategoryEloquentRepository::class
        );
    }
}
