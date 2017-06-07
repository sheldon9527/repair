<?php
namespace App\Repositories\Eloquents;

use Rinvex\Repository\Repositories\EloquentRepository;
use App\Repositories\Contracts\RepairRepositoryContract;
use Illuminate\Contracts\Container\Container;

class RepairEloquentRepository extends EloquentRepository implements RepairRepositoryContract
{
    public function __construct(Container $container)
    {
        $this->setContainer($container)
             ->setModel(\App\Models\Repair::class)
             ->setRepositoryId('rinvex.repository.uniqueid');
    }
}
