<?php

namespace App\Admin\Controllers;

use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use App\Models\CouponCode;
use Dcat\Admin\Http\Controllers\AdminController;

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
            $grid->column('description')->label();
            $grid->column('usage', '用量')->display(function ($value) {
                return "{$this->used} / {$this->total}";
            });
            $grid->column('enabled')->bool();
            $grid->column('created_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
            });

            $grid->disableViewButton();
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
            $form->display('id', 'ID');
            $form->text('name', '名称')->rules('required', [
                'required' => '名称不能为空'
            ]);
            $form->hidden('code')->value(CouponCode::findAvailableCode());
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

            $form->footer(function ($footer) {
                $footer->disableViewCheck();
            });
        });
    }
}
