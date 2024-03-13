@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
		<div class="col-6">
			<span id="pageTitle" class="h4">商品一覧画面</span>
		</div>
		<div class="col-6 d-flex justify-content-end">
			<button class="btn btn-primary" onclick="location.href='{{ route('show.register') }}' ">新規登録</button>
		</div>
    </div>
    @if (session('message'))
        <div class="alert alert-success my-2" role="alert">
            {{ session('message') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger my-2" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-10 my-3">
            <div class="card">
                <div class="card-header accordion" data-bs-toggle="collapse" href="#collapse" role="button" aria-expanded="true" aria-controls="collapse">
                    <span>商品検索</span>
                    <a id="icon"></a>
                    <span id="icon">
                    </span>
                </div>
                <div class="collapse show" id="collapse" name="collapse">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container">
                                <div class="row my-1">
                                    <span class="col-3 align-middle p-2">商品名</span>
                                    <div class="col-9">
                                        <input type="search" id="inputProductName" name="input_name" class="form-control" placeholder="商品名を入力してください">
                                    </div>
                                </div>
                                <div class="row my-1">
                                    <span class="col-3 align-middle p-2 pt-3">メーカー名</span>
                                    <div class="col-9">
                                        <select id ="inputCompany" class="form-select my-2" name="company_id">
                                            <option value="" selected>選択してください</option>
                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <span class="col-3 align-middle p-2">価格</span>
                                    <div class="col-4">
                                        <input type="number" min="0" id="inputPriceMin" name="input_price_min" class="form-control col-6" placeholder="下限">
                                    </div>
                                    <div class="col-1 p-2"><span>〜</span></div>
                                    <div class="col-4">
                                        <input type="number" min="0" id="inputPriceMax" name="input_price_max" class="form-control col-6" placeholder="上限">
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <span class="col-3 align-middle p-2">在庫数</span>
                                    <div class="col-4">
                                        <input type="number" min="0" id="inputStockMin" name="input_stock_min" class="form-control col-6" placeholder="下限">
                                    </div>
                                    <div class="col-1 p-2"><span>〜</span></div>
                                    <div class="col-4">
                                        <input type="number" min="0" id="inputStockMax" name="input_stock_max" class="form-control col-6" placeholder="上限">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 d-grid gap-2">
                                        <button id="clearBtn" class="btn btn-secondary btn-block">クリア</button>
                                    </div>
                                    <div class="col-8 d-grid gap-2">
                                        <button id="searchBtn" class="btn btn-primary btn-block">検索</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<div class="m-3">
			<hr>
		</div>
		<div class="container card">
			<table id="table" class="table table-hover">
				<thead class="">
					<tr class="align-middle" align="center">
						<th>ID</th>
						<th>商品画像</th>
						<th>商品名</th>
						<th>価格</th>
						<th>在庫数</th>
						<th>メーカー名</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody id="tableBody">
                    @foreach($products as $product)
                        <tr class="table align-middle" align="center">
                            <td>{{ $product->id }}</td>
                            <td>
                                <img src="{{ asset('storage/'.$product->img_path) }}" alt="商品画像無し" width="100" height="100">
                            </td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->company_name }}</td>
                            <td>
                                <button class="btn btn-primary" onclick="location.href='{{ route('show.detail', $product->id) }}' ">詳細</button>
                                <button class="btn btn-danger" onclick="location.href='{{ route('destroy', $product->id) }}' ">削除</button>
                            </td>
                        </tr>
                    @endforeach
				</tbody>

			</table>
		</div>
    </div>
</div>
@endsection
