<?php
namespace App\Repositories\Eloquents;

use Rinvex\Repository\Repositories\EloquentRepository;
use App\Repositories\Contracts\AdminRepositoryContract;
use Illuminate\Contracts\Container\Container;

class AdminEloquentRepository extends EloquentRepository implements AdminRepositoryContract
{
    public function __construct(Container $container)
    {
        $this->setContainer($container)
             ->setModel(\App\Models\Admin::class)
             ->setRepositoryId('rinvex.repository.uniqueid');
    }
}
