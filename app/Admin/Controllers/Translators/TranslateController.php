<?php
namespace App\Admin\Controllers\Translators;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Http\Model\Translator;

class TranslateController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('翻譯');
            $content->description('翻譯頁面管理');
            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header('翻譯');
            $content->description('翻譯頁面管理');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {
            $content->header('翻譯');
            $content->description('翻譯頁面管理');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Translator::class, function (Grid $grid) {
            $grid->id('ID')->sortable();
            $grid->column('title');
            $grid->column('url');
            $grid->updated_at();
            $grid->created_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Translator::class, function (Form $form) {
            $form->display('id', 'ID');
            $form->display('url', '翻譯網址');
            $form->text('title', '標題');
        });
    }
}
