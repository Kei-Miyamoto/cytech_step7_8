<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;

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
    public function showList(Request $request)
    {
        // インスタンス作成
        $product_model = new Product();
        $company_model = new Company();

        // 検索時
        if ($request) {
            // 検索商品情報の取得
            $products = $product_model->getProducts($request);
        } else {
            // 全商品情報の取得
            $products = $product_model->getAllProducts();
        }
        // メーカー情報の取得
        $companies = $company_model->getCompanies();
        return view('home', compact('products', 'companies', 'request'));
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
