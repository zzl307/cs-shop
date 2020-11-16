<?php

namespace App\Admin\Repositories;

use App\Models\CouponBusiness as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class CouponBusiness extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
