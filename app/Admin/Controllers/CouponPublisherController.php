<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\CouponPublisher;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class CouponPublisherController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new CouponPublisher(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('coupon_publisher_id');
            $grid->column('name');
            $grid->column('scenes_used');
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
        return Show::make($id, new CouponPublisher(), function (Show $show) {
            $show->field('id');
            $show->field('coupon_publisher_id');
            $show->field('name');
            $show->field('scenes_used');
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
        return Form::make(new CouponPublisher(), function (Form $form) {
            $form->display('id');
            $form->text('coupon_publisher_id');
            $form->text('name');
            $form->text('scenes_used');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
