<?php

namespace App\Admin\Controllers;

use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use App\Models\DemoPainter;
use Dcat\Admin\Http\Controllers\AdminController;

class DemoPainterController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new DemoPainter(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('username');
            $grid->column('bio');
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
        return Show::make($id, new DemoPainter(), function (Show $show) {
            $show->field('id');
            $show->field('username');
            $show->field('bio');
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
        // 这里需要显式地指定关联关系
        $builder = DemoPainter::with('paintings');

        // 如果你使用的是数据仓库，则可以这样指定关联关系
        // $repository = new Painter(['paintings']);

        return Form::make($builder, function (Form $form) {
        $form->display('id', 'ID');

        $form->text('username')->rules('required');
        $form->textarea('bio')->rules('required');

        $form->hasMany('paintings', function (Form\NestedForm $form) {
        $form->text('title');
        $form->textarea('body');
        $form->datetime('completed_at');
        });

        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');

        // 也可以设置label
        // $form->hasMany('paintings', '画作', function (Form\NestedForm $form) {
        //    ...
        // });
        });
    }
}
