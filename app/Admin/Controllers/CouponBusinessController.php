<?php

namespace App\Admin\Controllers;

use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use App\Models\CouponCode;
use App\Models\CouponBusiness;
use Dcat\Admin\Http\Controllers\AdminController;

class CouponBusinessController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new CouponBusiness(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('coupon_business_id');
            $grid->column('name');
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
        return Show::make($id, new CouponBusiness(), function (Show $show) {
            $show->field('id');
            $show->field('coupon_business_id');
            $show->field('name');
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
        $builder = CouponBusiness::with('CouponCode');

        return Form::make($builder, function (Form $form) {
            $form->display('id', 'ID');

            $form->text('name')->rules('required');

            $form->hasMany('codes', '优惠券', function (Form\NestedForm $form) {
                $form->text('name', '名称')->rules('required', [
                    'required' => '名称不能为空'
                ]);
                $form->text('code', '优惠码')->rules(function ($form) {
                    if ($id = $form->model()->id) {
                        return 'nullable|unique:coupon_codes,code,' . $id . ',id';
                    } else {
                        return 'nullable|unique:coupon_codes';
                    }
                });
                $form->radio('type', '类型')->options(CouponCode::$typeMap)->rules('required')->default(CouponCode::TYPE_FIXED);
                $form->text('value', '折扣')->rules(function ($form) {
                    if (request()->input('type') === CouponCode::TYPE_PERCENT) {
                        // 如果选择了百分比折扣类型，那么折扣范围只能是 1 ~ 99
                        return 'required|numeric|between:1,99';
                    } else {
                        // 否则只要大等于 0.01 即可
                        return 'required|numeric|min:0.01';
                    }
                });
                $form->text('total', '总量')->rules('required|numeric|min:0');
                $form->text('min_amount', '最低金额')->rules('required|numeric|min:0');
                $form->datetime('not_before', '开始时间');
                $form->datetime('not_after', '结束时间');
                $form->radio('enabled', '启用')->options(['1' => '是', '0' => '否'])->default('1');

                $form->saving(function (Form $form) {
                    if (!$form->code) {
                        $form->code = CouponCode::findAvailableCode();
                    }
                });

                $form->footer(function ($footer) {
                    $footer->disableViewCheck();
                });
            });
        });
    }
}