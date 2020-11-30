<?php

namespace App\Admin\Controllers;

use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use App\Models\CouponCode;
use Dcat\Admin\Form\Field;
use App\Admin\Renderable\CodeTable;
use App\Admin\Repositories\CouponPublisher;
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
            // $grid->codes()->display(function ($CouponCode) {

            //     $res = array_map(function ($CouponCode) {
            //             return "<span class='label label-success'>{$CouponCode['name']}</span>";
            //         }, $CouponCode);

            //     return join(' ', $res);
            // });
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
        $builder = CouponPublisher::with('codes');

        return Form::make($builder, function (Form $form) {
            $form->display('id', 'ID');

            $form->text('coupon_publisher_id', 'id')->required();
            $form->text('name', '名称')->required();
            $form->text('scenes_used', '使用场景');

            $form->multipleSelectTable('codes', '选择优惠券')
                ->title('选择优惠券')
                ->dialogWidth('68%')
                ->max(10)
                ->from(CodeTable::make(['id' => $form->getKey()]))
                ->model(CouponCode::class, 'id', 'name');
        });
    }
}
