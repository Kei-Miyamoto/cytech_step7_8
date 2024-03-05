<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧画面の表示
     * @return array $products 商品リスト
     * @return view
     */
    public function showList()
    {
        $product_model = new Product();
        $products = $product_model->getProducts();
        return view('home');
    }

    /**
     * 商品登録画面の表示
     * @return view
     */
    public function showRegister()
    {
        return view('register');
    }

    /**
     * 商品詳細画面の表示
     * @return view
     */
    public function showDetail()
    {
        return view('detail');
    }

    /**
     * 商品編集画面の表示
     * @return view
     */
    public function showEdit()
    {
        return view('edit');
    }
}
