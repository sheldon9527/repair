<?php
namespace App\Repositories\Eloquents;

use Rinvex\Repository\Repositories\EloquentRepository;
use App\Repositories\Contracts\PermissionRepositoryContract;
use Illuminate\Contracts\Container\Container;

class PermissionEloquentRepository extends EloquentRepository implements PermissionRepositoryContract
{
    public function __construct(Container $container)
    {
        $this->setContainer($container)
             ->setModel(\App\Models\Permission::class)
             ->setRepositoryId('rinvex.repository.uniqueid');
    }
}
