<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\CouponCode;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
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
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('code');
            $grid->column('type');
            $grid->column('value');
            $grid->column('total');
            $grid->column('used');
            $grid->column('min_amount');
            $grid->column('not_before');
            $grid->column('not_after');
            $grid->column('enabled');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new CouponCode(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('code');
            $show->field('type');
            $show->field('value');
            $show->field('total');
            $show->field('used');
            $show->field('min_amount');
            $show->field('not_before');
            $show->field('not_after');
            $show->field('enabled');
            $show->field('created_at');
            $show->field('updated_at');
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
