<?php

namespace App\Admin\Renderable;

use Dcat\Admin\Grid;
use App\Models\CouponCode;
use Dcat\Admin\Grid\LazyRenderable;
use Dcat\Admin\Models\Administrator;

class CodeTable extends LazyRenderable
{
    public function grid(): Grid
    {
        // 获取外部传递的参数
        $id = $this->id;

        return Grid::make(new CouponCode(), function (Grid $grid) {
            $grid->model()->orderBy('created_at', 'desc');
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('code', '优惠券编码');
            $grid->column('description', '优惠券描述')->label();
            $grid->column('usage', '用量')->display(function ($value) {
                return "{$this->used} / {$this->total}";
            });
            $grid->column('enabled', '使用状态')->bool();
            $grid->column('created_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
            });

            // 指定行选择器选中时显示的值的字段名称
            // 指定行选择器选中时显示的值的字段名称
            // 指定行选择器选中时显示的值的字段名称
            // 如果表格数据中带有 “name”、“title”或“username”字段，则可以不用设置
            $grid->rowSelector()->titleColumn('name');

            $grid->quickSearch(['id', 'name', 'description']);

            $grid->paginate(10);
            $grid->disableActions();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('name')->width(5);
                $filter->like('code')->width(5);
            });
        });
    }
}
?>
