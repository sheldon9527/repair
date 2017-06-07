<?php
namespace App\Repositories\Eloquents;

use Rinvex\Repository\Repositories\EloquentRepository;
use App\Repositories\Contracts\RoleRepositoryContract;
use Illuminate\Contracts\Container\Container;

class RoleEloquentRepository extends EloquentRepository implements RoleRepositoryContract
{
    public function __construct(Container $container)
    {
        $this->setContainer($container)
             ->setModel(\App\Models\Role::class)
             ->setRepositoryId('rinvex.repository.uniqueid');
    }
}
