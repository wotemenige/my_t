<?php

namespace App\Admin\Controllers;

use App\Models\Books;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BookController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '书籍列表';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Books());

        $grid->column('id', __('Id'));
        $grid->column('name', __('书名'));
        $grid->column('luck_num', __('幸运数字'));
        $grid->column('start_time', __('开始时间'));
        $grid->column('end_time', __('结束时间'));
        $grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('更新时间'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Books::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('luck_num', __('Luck num'));
        $show->field('start_time', __('Start time'));
        $show->field('end_time', __('End time'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Books());

        $form->text('name', __('名字'));
        $form->number('luck_num', __('幸运数字'));
        $form->datetime('start_time', __('开始时间'))->default(date('Y-m-d H:i:s'));
        $form->datetime('end_time', __('结束时间'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
