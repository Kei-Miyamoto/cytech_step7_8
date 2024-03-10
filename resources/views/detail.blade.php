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
                            <span class="col-4 align-middle p-2">ID</span>
                            <div class="col-8">
                                <input type="text" id="productId" class="form-control" name="product_id" value="{{ $product->id }}" readonly>
                            </div>
                        </div>
						<div class="row">
							<span class="col-4 align-middle p-2">商品名</span>
							<div class="col-8">
								<input type="text" id="productName" class="form-control" value="{{ $product->product_name }}" readonly>
							</div>
						</div>
						<div class="row">
                            <span class="col-4 align-middle p-2">メーカー名</span>
							<div class="col-8">
                                <select id ="company" class="form-select" disabled>
                                    <option selected>{{ $product->company_name }}</option>
								</select>
							</div>
						</div>
                        <div class="row">
                            <span class="col-4 align-middle p-2">価格</span>
                            <div class="col-8">
                                <input type="text" id="price" class="form-control" value="{{ $product->price }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <span class="col-4 align-middle p-2">在庫数</span>
                            <div class="col-8">
                                <input type="text" id="stock" class="form-control" value="{{ $product->stock }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <span class="col-4 align-middle p-2">コメント</span>
                            <div class="col-8">
                                <input type="text" id="comment" class="form-control" name="comment" value="{{ $product->comment }}"  readonly>
                            </div>
                        </div>
                        <div class="row">
                            <span class="col-4 align-middle p-2">商品画像</span>
                            <div class="col-8 p-2">
                                <img src="{{ asset('storage/'.$product->img_path) }}" alt="商品画像無し" width="200" height="200">
                            </div>
                        </div>
						<div class="row my-3"></div>
						<div class="row">
							<div class="col-12 d-grid gap-2">
								<button class="btn btn-primary btn-block" type="button" onclick="location.href='{{ route('show.edit', $product->id) }}' ">編集</button>
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
