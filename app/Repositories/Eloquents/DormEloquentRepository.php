<?php
namespace App\Repositories\Eloquents;

use Rinvex\Repository\Repositories\EloquentRepository;
use App\Repositories\Contracts\DormRepositoryContract;
use Illuminate\Contracts\Container\Container;

class DormEloquentRepository extends EloquentRepository implements DormRepositoryContract
{
    public function __construct(Container $container)
    {
        $this->setContainer($container)
             ->setModel(\App\Models\Dorm::class)
             ->setRepositoryId('rinvex.repository.uniqueid');
    }
}
