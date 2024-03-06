<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Company;

class Company extends Model
{
    use HasFactory;

    /**
     * メーカー情報取得
     * @param
     * @return array $companies メーカー
     */
    function getCompanies() {
        // 全件取得
        $query = DB::table('companies');
        $query->select('*');
        $companies = $query->get();

        return $companies;
    }
}
