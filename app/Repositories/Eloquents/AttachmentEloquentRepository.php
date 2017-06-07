<?php
namespace App\Repositories\Eloquents;

use Rinvex\Repository\Repositories\EloquentRepository;
use App\Repositories\Contracts\AttachmentRepositoryContract;
use Illuminate\Contracts\Container\Container;

class AttachmentEloquentRepository extends EloquentRepository implements AttachmentRepositoryContract
{
    public function __construct(Container $container)
    {
        $this->setContainer($container)
             ->setModel(\App\Models\Attachment::class)
             ->setRepositoryId('rinvex.repository.uniqueid');
    }
}
