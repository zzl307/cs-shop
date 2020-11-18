<?php

namespace App\Admin\Repositories;

use App\Models\DemoPainter as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class DemoPainter extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
