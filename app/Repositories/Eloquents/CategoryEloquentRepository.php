<?php
namespace App\Repositories\Eloquents;

use Rinvex\Repository\Repositories\EloquentRepository;
use App\Repositories\Contracts\CategoryRepositoryContract;
use Illuminate\Contracts\Container\Container;

class CategoryEloquentRepository extends EloquentRepository implements CategoryRepositoryContract
{
    public function __construct(Container $container)
    {
        $this->setContainer($container)
             ->setModel(\App\Models\Category::class)
             ->setRepositoryId('rinvex.repository.uniqueid');
    }
}
