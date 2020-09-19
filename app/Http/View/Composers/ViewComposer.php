<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Category;

/**
 * Class ViewComposer
 * @package App\Http\View\Composers
 */
class ViewComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('categories', Category::all());
    }
}