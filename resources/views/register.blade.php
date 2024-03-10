@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
		<div class="col-6">
			<span id="pageTitle" class="h4">商品登録画面</span>
		</div>
    </div>

    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-success" role="alert">
            {{ session('error') }}
        </div>
    @endif
    @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach

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
                        <form action="{{ route('register')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-2">
                                <span class="col-4 align-middle p-2 position-relative">商品名<span class="text-danger">*</span></span>
                                <div class="col-8">
                                    <input type="text" id="productName" name="product_name" class="form-control" placeholder="商品名を入力してください">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <span class="col-4 align-middle p-2">メーカー名<span class="text-danger">*</span></span>
                                <div class="col-8">
                                    <select id ="companyId" class="form-select" name="company_id">
                                        <option value="" selected>選択してください</option>
                                        @foreach($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <span class="col-4 align-middle p-2">価格<span class="text-danger">*</span></span>
                                <div class="col-8">
                                    <input type="text" id="price" class="form-control" name="price" placeholder="価格を入力してください">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <span class="col-4 align-middle p-2">在庫数<span class="text-danger">*</span></span>
                                <div class="col-8">
                                    <input type="text" id="stock" class="form-control" name="stock" placeholder="在庫数を入力してください">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <span class="col-4 align-middle p-2">コメント</span>
                                <div class="col-8">
                                    <input type="text" id="comment" class="form-control" name="comment" placeholder="コメントを入力してください">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <span class="col-4 align-middle p-2">商品画像</span>
                                <div class="col-8">
                                    <input type="file" id="imgPath" class="form-control" name="img_path" placeholder="商品画像を選択してください">
                                </div>
                            </div>
                            <div class="row my-3"></div>
                            <div class="row">
                                <div class="col-12 d-grid gap-2">
                                    <button class="btn btn-primary btn-block" type="submit">登録</button>
                                </div>
                            </div>
                        </form>
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
