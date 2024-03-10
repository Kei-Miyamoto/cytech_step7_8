<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class Product extends Model
{
    use HasFactory;

    /**
     * 全商品一覧の取得
     * @return object $products 商品
     */
    function getAllProducts() {

        // 全件取得
        $query = DB::table('products as p');
        $query->select('p.*', 'c.company_name');
        $query->leftJoin('companies as c', 'p.company_id', '=', 'c.id');
        $query->orderBy('p.id', 'asc');
        $products = $query->get();

        return $products;
    }

    /**
     * 商品検索情報の取得
     * @param object $request リクエスト内容
     * @return object $products 商品
     */
    function getProducts($request) {

        // 検索内容の取得
        $keyword = $request->input('input_name');
        $company_id = $request->input('company_id');
        // 検索内容に応じて商品情報の取得
        $query = DB::table('products as p');
        $query->select('p.*', 'c.company_name');
        $query->leftJoin('companies as c', 'p.company_id', '=', 'c.id');
        $query->where('p.product_name', 'like', "%$keyword%");
        // メーカー名の入力があった時のみメーカーIDで絞り込み
        if ($company_id) {
            $query->where('c.id', '=', $company_id);
        }
        $query->orderBy('p.id', 'asc');
        $products = $query->get();

        return $products;
    }

    /**
     * 商品情報1件の取得
     * @param integer $id 商品ID
     * @return object $product 商品情報
     */
    function getProduct($id) {

        // リクエストに応じて商品情報の取得
        $query = DB::table('products as p');
        $query->select('p.*', 'c.company_name');
        $query->leftJoin('companies as c', 'p.company_id', '=', 'c.id');
        $query->where('p.id', '=', "$id");
        $product = $query->first();

        return $product;
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

    /**
     * 商品登録
     * @param object $request リクエスト内容
     * @return boolean $result 成功：True  失敗：False
     */
    function register($request) {

        // バリデーションチェック
        $inputs = $this->validateInputs($request);
        $result = false;
        try {
            $product = new Product();
            // 登録処理
            $product->product_name = $inputs['product_name'];
            $product->company_id = $inputs['company_id'];
            $product->price = $inputs['price'];
            $product->stock = $inputs['stock'];
            $product->comment = $inputs['comment'];

            // 画像のアップロードがある場合
            if ($inputs['img_path']) {
                $dir = 'image';
                // ファイル名を取得し保存
                $file_name = $request->file('img_path')->getClientOriginalName();
                $request->file('img_path')->storeAs('public/' . $dir, $file_name);
                // パスを格納
                $img_path = $dir . '/' . $file_name;
                $product->img_path = $img_path;
            }
            $product->save();
            $result = true;
            return $result;

        } catch (Exception $e) {
            return $result;
        }
    }
}
