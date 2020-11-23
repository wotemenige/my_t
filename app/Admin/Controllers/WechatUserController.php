<?php

namespace App\Admin\Controllers;

use App\Models\WechatUser;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class WechatUserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '书籍用户列表';
    public $status = [
        0=>'没有获奖',
        1=>'获奖了'
    ];

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new WechatUser());

        $grid->column('id', __('Id'));
        $grid->column('openid', __('Openid'));
        $grid->column('luck_num', __('填写的数字'));
        $grid->column('status', __('是否获奖'))->using($this->status);
        $grid->column('book_name', __('奖品名称'));
        $grid->column('address', __('填写的地址'));
        $grid->column('order_id', __('快递单号'));
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
        $show = new Show(WechatUser::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('openid', __('Openid'));
        $show->field('luck_num', __('Luck num'));
        $show->field('status', __('Status'));
        $show->field('book_name', __('Book name'));
        $show->field('address', __('Address'));
        $show->field('phone', __('Phone'));
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
        $form = new Form(new WechatUser());

        $form->text('openid', __('Openid'));
//        $form->number('luck_num', __('Luck num'));
//        $form->switch('status', __('Status'));
        $form->text('book_name', __('书名'));
        $form->text('address', __('详细地址'));
        $form->mobile('phone', __('手机号'));
        $form->text('order_id', __('快递单号'));

        return $form;
    }
}
