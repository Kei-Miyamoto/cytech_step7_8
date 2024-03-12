<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

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
     * @param string $keyword キーワード
     * @param integer $company_id メーカーID
     * @param integer $price_min 価格下限
     * @param integer $price_max 価格上限
     * @param integer $stock_min 在庫数下限
     * @param integer $stock_max 在庫数上限
     * @return object $products 商品
     */
    function getProducts($keyword, $company_id, $price_min, $price_max, $stock_min, $stock_max) {

        // 検索内容に応じて商品情報の取得
        $query = DB::table('products as p');
        $query->select('p.*', 'c.company_name');
        $query->leftJoin('companies as c', 'p.company_id', '=', 'c.id');
        $query->where('p.product_name', 'like', "%$keyword%");
        // メーカー名の入力があった時のみメーカーIDで絞り込み
        if ($company_id) {
            $query->where('c.id', '=', $company_id);
        }
        // 価格下限の入力があった時のみ価格下限値で絞り込み
        if ($price_min) {
            $query->where('p.price', '>=', $price_min);
        }
        // 価格上限の入力があった時のみ価格上限値で絞り込み
        if ($price_max) {
            $query->where('p.price', '<=', $price_max);
        }
        // 在庫数下限の入力があった時のみ在庫数下限値で絞り込み
        if ($stock_min) {
            $query->where('p.stock', '>=', $stock_min);
        }
        // 在庫数上限の入力があった時のみ在庫数上限値で絞り込み
        if ($stock_max) {
            $query->where('p.stock', '<=', $stock_max);
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
     * 商品登録
     * @param object $inputs 入力内容
     * @return boolean $result 成功：True  失敗：False
     */
    function register($inputs) {

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
                $file_name = $inputs->file('img_path')->getClientOriginalName();
                $inputs->file('img_path')->storeAs('public/' . $dir, $file_name);
                // パスを格納
                $img_path = $dir . '/' . $file_name;
                $product->img_path = $img_path;
            }
            $product->save();
            return true;

        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * 商品更新
     * @param object $inputs 入力内容
     * @return boolean $result 成功：True  失敗：False
     */
    function exeUpdate($inputs) {

        try {
            // 画像有無の確認
            $org_product = $this->getProduct($inputs['product_id']);
            $org_img_path = $org_product->img_path;
            $img_path = null;
            // 画像のアップロードがある場合
            if ($inputs['img_path']) {
                $dir = 'image';
                // ファイル名を取得し保存
                $file_name = $inputs->file('img_path')->getClientOriginalName();
                $inputs->file('img_path')->storeAs('public/' . $dir, $file_name);
                // パスを格納
                $img_path = $dir . '/' . $file_name;
            }

            // 更新処理
            $query = DB::table('products');
            $query->where('id', $inputs['product_id']);
            $query->update([
                'product_name' => $inputs['product_name'],
                'company_id' => $inputs['company_id'],
                'price' => $inputs['price'],
                'stock' => $inputs['stock'],
                'comment' => $inputs['comment'],
                'img_path' => $img_path ? $img_path: $org_img_path,
                'updated_at' => Carbon::now(),
            ]);

            return true;

        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * 商品情報を削除する
     */
    function exeDestroy($id) {

        $query = DB::table('products');
        $query->where('id', $id);
        $query->delete();
        return true;
    }
}
