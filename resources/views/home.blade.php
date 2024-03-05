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

    <div class="row justify-content-center">
        <div class="col-md-8 my-3">
            <div class="card">
                <div class="card-header">商品検索</div>
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
								<input type="text" id="inputProductName" class="form-control" placeholder="商品名を入力してください">
							</div>
						</div>
						<div class="row">
							<span class="col-4 align-middle p-2 pt-3">メーカー名</span>
							<div class="col-8">
								<select id ="inputCompany" class="form-select my-2">
									<option selected>選択してください</option>
									<option value="1">One</option>
									<option value="2">Two</option>
									<option value="3">Three</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-12 d-grid gap-2">
								<button class="btn btn-secondary btn-block" type="button">検索</button>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
		<div class="m-3">
			<hr>
		</div>
		<div class="container">
			<table class="table">
				<thead>
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
				<tbody>
					<tr class="table-active align-middle" align="center">
						<th scope="row">1</th>
						<td>Mark</td>
						<td>name</td>
						<td>Otto</td>
						<td>Otto</td>
						<td>Otto</td>
						<td>
							<button class="btn btn-primary" onclick="location.href='{{ route('show.detail') }}' ">詳細</button>
							<button class="btn btn-danger">削除</button>
						</td>
					</tr>
				</tbody>

			</table>
		</div>
    </div>
</div>
@endsection
