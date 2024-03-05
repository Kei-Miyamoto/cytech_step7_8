<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Company;

class Product extends Model
{
    use HasFactory;

    /**
     * 商品一覧取得
     * @param 
     * @return array $products 商品
     */
    function getProducts() {
        // 全件取得
        $products = DB::table('products')->get();
        return $products;
    }
}
