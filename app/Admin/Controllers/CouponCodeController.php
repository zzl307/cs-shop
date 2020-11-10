<?php

namespace App\Admin\Controllers;

use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use App\Models\CouponCode;
use Dcat\Admin\Controllers\AdminController;

class CouponCodeController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new CouponCode(), function (Grid $grid) {
            $grid->model()->orderBy('created_at', 'desc');
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('code');
            $grid->column('description');
            $grid->column('usage', '用量')->display(function ($value) {
                return "{$this->used} / {$this->total}";
            });
            $grid->column('enabled')->display(function ($value) {
                return $value ? '启用' : '不启用';
            });
            $grid->column('created_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new CouponCode(), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->text('code');
            $form->text('type');
            $form->text('value');
            $form->text('total');
            $form->text('used');
            $form->text('min_amount');
            $form->text('not_before');
            $form->text('not_after');
            $form->text('enabled');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
