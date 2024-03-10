@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
		<div class="col-6">
			<span id="pageTitle" class="h4">商品編集画面</span>
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
                        <form action="{{ route('update')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <span class="col-4 align-middle p-2">ID</span>
                                <div class="col-8">
                                    <input type="text" id="productId" class="form-control" name="product_id" value="{{ $product->id }}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <span class="col-4 align-middle p-2">商品名<span class="text-danger">*</span></span>
                                <div class="col-8">
                                    <input type="text" id="productName" class="form-control" name="product_name" value="{{ $product->product_name }}">
                                </div>
                            </div>
                            <div class="row">
                                <span class="col-4 align-middle p-2">メーカー名<span class="text-danger">*</span></span>
                                <div class="col-8">
                                    <select id ="company" class="form-select" name="company_id">
                                        @foreach ($companies as $company)
                                            @if ($company->company_name == $product->company_name)
                                                <option value="{{ $company->id }}" selected>{{ $company->company_name }}</option>
                                            @else
                                                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <span class="col-4 align-middle p-2">価格<span class="text-danger">*</span></span>
                                <div class="col-8">
                                    <input type="text" id="price" class="form-control" name="price" value="{{ $product->price }}">
                                </div>
                            </div>
                            <div class="row">
                                <span class="col-4 align-middle p-2">在庫数<span class="text-danger">*</span></span>
                                <div class="col-8">
                                    <input type="text" id="stock" class="form-control" name="stock" value="{{ $product->stock }}">
                                </div>
                            </div>
                            <div class="row">
                                <span class="col-4 align-middle p-2">コメント</span>
                                <div class="col-8">
                                    <input type="text" id="comment" class="form-control" name="comment" value="{{ $product->comment }}" >
                                </div>
                            </div>
                            <div class="row">
                                <span class="col-4 align-middle p-2">商品画像</span>
                                <div class="col-8 p-2">
                                    <input type="file" id="imgPath" class="form-control" name="img_path">
                                </div>
                            </div>
                            <div class="row my-3"></div>
                            <div class="row">
                                <div class="col-12 d-grid gap-2">
                                    <button class="btn btn-primary btn-block" type="submit">更新</button>
                                </div>
                            </div>
                        </form>
					</div>
                </div>
            </div>
            <div class="row my-2"></div>
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-secondary" type="button" onclick="location.href='{{ route('show.detail', $product->id) }}' ">戻る</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
