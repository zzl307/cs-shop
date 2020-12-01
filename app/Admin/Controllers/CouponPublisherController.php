<?php

namespace App\Admin\Controllers;

use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use App\Models\CouponCode;
use App\Admin\Renderable\CodeTable;
use App\Admin\Repositories\CouponPublisher;
use App\Admin\Renderable\PublisherCodeTable;
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
        $builder = CouponPublisher::with('codes');

        return Grid::make($builder, function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('coupon_publisher_id');
            $grid->column('name');
            $grid->column('scenes_used');
            $grid->优惠券->display('查看')->modal('优惠券', PublisherCodeTable::make());
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
        $model = CouponPublisher::with('codes');

        return Show::make($id, $model, function (Show $show) {
            $show->field('id');
            $show->field('coupon_publisher_id');
            $show->field('name');
            $show->field('scenes_used');
            $show->codes()->pluck('name')->label();
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
                ->model(CouponCode::class, 'id', 'name')
                ->customFormat(function ($v) {
                    if (!$v) return [];

                    return array_column($v, 'id');
                });
        });
    }
}
