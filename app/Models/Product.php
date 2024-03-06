<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    /**
     * 全商品一覧の取得
     * @param
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
     * @param
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
        $products = $query->get();

        return $products;
    }
}
