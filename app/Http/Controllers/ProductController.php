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
     * @return object $products 商品リスト
     * @return object $companies メーカーリスト
     * @return view
     */
    public function showList()
    {
        //商品情報の取得
        $products = $this->product->getAllProducts();
        // メーカー情報の取得
        $companies = $this->company->getCompanies();
        return view('home', compact('products', 'companies'));
    }

    /**
     * 検索結果の取得
     * @param object $request リクエスト内容
     * @return json $products 商品リスト
     */
    public function search(Request $request)
    {
        // 検索時
        if ($request) {
            // 検索内容の取得
            $keyword = $request->input('keyword');
            $company_id = $request->input('company_id');
            // 検索商品情報の取得
            $products = $this->product->getProducts($keyword, $company_id);
        } else {
            // 全商品情報の取得
            $products = $this->product->getAllProducts();
        }

        return response()->json([
            'products' => $products,
        ]);
    }

    /**
     * 商品登録画面の表示
     * @return object $companies メーカーリスト
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
     * @param object $request リクエスト内容
     * @return view
     */
    public function register(Request $request)
    {
        // バリデーションチェック
        $inputs = $this->validateInputs($request);
        // 登録処理
        $result = $this->product->register($inputs);

        if (!$result) {
            return redirect()->route('show.register')->with('error', '登録に失敗しました。');
        }
        return redirect()->route('home')->with('message', '登録が完了しました。');
    }

    /**
     * 商品詳細画面の表示
     * @param integer $id 商品ID
     * @return object $product 商品情報
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
     * @param integer $id 商品ID
     * @return object $product 商品情報
     * @return object $companies メーカーリスト
     * @return view
     */
    public function showEdit($id)
    {
        // 商品情報の取得
        $product = $this->product->getProduct($id);
        // メーカー情報の取得
        $companies = $this->company->getCompanies();
        return view('edit', compact('product', 'companies'));
    }

    /**
     * 商品を更新する
     * @param object $request リクエスト内容
     * @return view
     */
    public function update(Request $request)
    {
        // バリデーションチェック
        $inputs = $this->validateInputs($request);
        // 更新処理
        $result = $this->product->exeUpdate($inputs);

        if (!$result) {
            return redirect()->route('home')->with('error', '更新に失敗しました。');
        }
        return redirect()->route('home')->with('message', '更新が完了しました。');
    }

    /**
     * 商品を削除する
     * @param integer $id 商品ID
     * @return view
     */
    public function destroy($id)
    {
        // 存在確認
        $product = $this->product->getProduct($id);
        if (!$product) {
            return redirect()->route('home')->with('error', '削除対象の商品がありません。');
        }
        // 削除処理
        $result = $this->product->exeDestroy($id);

        if (!$result) {
            return redirect()->route('home')->with('error', '削除に失敗しました。');
        }
        return redirect()->route('home')->with('message', '削除が完了しました。');
    }

    /**
     * 商品情報のバリデーションチェック
     */
    function validateInputs($inputs) {

        $inputs->validate([
            'product_name' => 'required|max:255',
            'price' => 'required|max:11',
            'stock' => 'required|max:11',
            'comment' => 'max:255',
            'img_path' => 'max:1000'
        ]);
        return $inputs;
    }
}
