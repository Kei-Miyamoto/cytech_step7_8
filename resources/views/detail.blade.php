@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
		<div class="col-6">
			<span id="pageTitle" class="h4">商品詳細画面</span>
		</div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 my-3">
            <div class="card">
                <div class="card-header">商品情報</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container">
						<div class="row">
							<span class="col-4 align-middle p-2">商品名</span>
							<div class="col-8">
								<input type="text" id="productName" class="form-control" readonly>
							</div>
						</div>
						<div class="row">
                            <span class="col-4 align-middle p-2 pt-3">メーカー名</span>
							<div class="col-8">
                                <select id ="company" class="form-select my-2" disabled>
                                    <option selected>選択してください</option>
									<option value="1">One</option>
									<option value="2">Two</option>
									<option value="3">Three</option>
								</select>
							</div>
						</div>
                        <div class="row">
                            <span class="col-4 align-middle p-2">価格</span>
                            <div class="col-8">
                                <input type="text" id="price" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <span class="col-4 align-middle p-2">在庫数</span>
                            <div class="col-8">
                                <input type="text" id="stock" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <span class="col-4 align-middle p-2">商品画像</span>
                            <div class="col-8">
                                <input type="text" id="inputProductName" class="form-control" readonly>
                            </div>
                        </div>
						<div class="row my-3"></div>
						<div class="row">
							<div class="col-12 d-grid gap-2">
								<button class="btn btn-primary btn-block" type="button" onclick="location.href='{{ route('show.edit') }}' ">編集</button>
							</div>
						</div>
					</div>
                </div>
            </div>
            <div class="row my-2"></div>
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-secondary" type="button" onclick="location.href='{{ route('home') }}' ">戻る</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
