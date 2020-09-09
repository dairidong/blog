<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Post;
use App\Models\Category;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class PostController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Post(['category']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('slug');
            $grid->column('category.title', '分类');
            $grid->column('is_published')->switch();
            $grid->column('updated_at')->sortable();

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
        return Form::make(new Post(), function (Form $form) {
            $categories = Category::query()->pluck('title', 'id');

            $form->display('id');
            $form->text('title')->rules('string');
            if ($form->isEditing()) {
                $form->text('slug')->rules('nullable|string');
            }
            $form->markdown('content')->height(800)->rules('string');
            $form->select('category_id', '分类')
                ->model(Category::class, 'id', 'title')
                ->options($categories)
                ->rules('exists:categories,id');
            $form->image('cover')->autoUpload()->uniqueName()->rules('image');
            $form->switch('is_published')->rules('boolean');

            $form->disableViewButton();
            $form->disableViewCheck();
        });
    }
}
