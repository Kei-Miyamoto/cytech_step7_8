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
        $this->product = new Product();
        $this->company = new Company();
    }

    /**
     * 商品一覧画面の表示
     * @return array $products 商品リスト
     * @return view
     */
    public function showList(Request $request)
    {
        // 検索時
        if ($request) {
            // 検索商品情報の取得
            $products = $this->product->getProducts($request);
        } else {
            // 全商品情報の取得
            $products = $this->product->getAllProducts();
        }
        // メーカー情報の取得
        $companies = $this->company->getCompanies();
        return view('home', compact('products', 'companies'));
    }

    /**
     * 商品登録画面の表示
     * @return view
     */
    public function showRegister()
    {
        // メーカー情報の取得
        $companies = $this->company->getCompanies();
        return view('register', compact('companies'));
    }

    /**
     * 商品を登録する
     * @return view
     */
    public function register(Request $request)
    {
        // 登録処理
        $result = $this->product->register($request);

        if (!$result) {
            return redirect()->route('show.register')->with('message', '登録に失敗しました。');
        }
        return redirect()->route('home')->with('message', '登録が完了しました。');
    }

    /**
     * 商品詳細画面の表示
     * @return view
     */
    public function showDetail($id)
    {
        // 商品情報の取得
        $product = $this->product->getProduct($id);
        return view('detail', compact('product'));
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
