<?php

namespace App\Http\Controllers;

use App\Product;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * @param string $alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(string $alias)
    {
        $model = Product::getByAlias($alias);

        return view('product', compact('model'));
    }
}
