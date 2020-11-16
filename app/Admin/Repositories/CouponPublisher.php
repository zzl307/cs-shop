<?php

namespace App\Admin\Repositories;

use App\Models\CouponPublisher as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class CouponPublisher extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
