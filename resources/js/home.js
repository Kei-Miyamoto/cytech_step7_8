$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

    // 検索ボタン押下時
    $('#searchBtn').on('click', function() {
        // 検索内容を取得する
        let keyword = $('#inputProductName').val();
        let companyId = $('#inputCompany').val();
        let priceMin = $('#inputPriceMin').val();
        let priceMax = $('#inputPriceMax').val();
        let stockMin = $('#inputStockMin').val();
        let stockMax = $('#inputStockMax').val();

        //テーブルを空にする
        $('#tableBody').empty();

        // ajax通信
        $.ajax({
            type: 'GET',
            url: '/home/search',
            dataType: 'json',
            data: {
                keyword: keyword,
                company_id: companyId,
                price_min: priceMin,
                price_max: priceMax,
                stock_min: stockMin,
                stock_max: stockMax,
            },
            cache: false,
        })
        .done(function(data) {
            let html = '';
            // 検索結果を整形
            $.each(data.products, function(key, value) {
                html = `
                    <tr class="table align-middle" align="center">
                        <td>${value.id}</td>
                        <td>
                            <img src="storage/${value.img_path}" alt="商品画像無し" width="100" height="100">
                        </td>
                        <td>${value.product_name}</td>
                        <td>${value.price}</td>
                        <td>${value.stock}</td>
                        <td>${value.company_name}</td>
                        <td>
                            <button class="btn btn-primary" onclick="location.href='detail/${value.id}'">詳細</button>
                            <button class="btn btn-danger" onclick="location.href='destroy/${value.id}'">削除</button>
                        </td>
                    </tr>
                `;
                // テーブルに差し込む
                $('#tableBody').append(html);
                // 追加した項目もソート対象になるようにする
                $("#table").trigger("update");
            });
        })
        .fail(function(data, xhr, err) {
            console.log(err);
            console.log(xhr);
            console.log(data || 'null');
        });
    });

    // クリアボタン押下時
    $('#clearBtn').on('click', function() {
        // 検索内容を空にする
        $('#inputProductName').val('');
        $('#inputCompany').val('');
        $('#inputPriceMin').val('');
        $('#inputPriceMax').val('');
        $('#inputStockMin').val('');
        $('#inputStockMax').val('');
    });

    // ソート機能
    $(document).ready(function() {
        $('#table').tablesorter();
    });

    // 一覧から削除ボタンを押下時
    $('#destroyModal').on('show.bs.modal', function(event) {
        // 削除対象のproduct_idを取得する
        let button = $(event.relatedTarget);
        let productId = button.data('id');

            // 削除実行
            $('#destroyBtn').on('click', function() {
            // ajax通信
            $.ajax({
                type: 'GET',
                url: '/destroy/' + productId,
                dataType: 'json',
                data: {
                    product_id: productId,
                },
                cache: false,
            })
            .done(function(data) {
                // 異常応答
                if (!data.status) {
                    // メッセージの作成
                    let flag = false;
                    let flashMessage = createFlashMessage(data.id, flag);
                    $('.jquery-alert').append(flashMessage);
                    // メッセージの削除
                    window.setTimeout(function(){
                        flashMessage.remove();
                    }, 4000);

                //正常応答
                } else{
                    // テーブルを空にする
                    $('#tr_' + data.id).remove();
                    // メッセージの作成
                    let flag = true;
                    let flashMessage = createFlashMessage(data.id, flag);
                    $('.jquery-alert').append(flashMessage);
                    // メッセージの削除
                    window.setTimeout(function(){
                        flashMessage.remove();
                    }, 4000);
                }
            })
            .fail(function(data, xhr, err) {
                // メッセージの作成
                let flag = false;
                let flashMessage = createFlashMessage(data.id, flag);
                $('.jquery-alert').append(flashMessage);
                // メッセージの削除
                window.setTimeout(function(){
                    flashMessage.remove();
                }, 4000);
            });
        });
    });

    // フラッシュメッセージの作成
    function createFlashMessage (id, flag) {
        let message = '';
        let flashMessage = document.createElement('div');
        // 成功時
        if (flag) {
            message = 'ID' + id + 'の削除に成功しました。'
            flashMessage.setAttribute('class', 'alert alert-success my-2 flash-message');

            // 失敗時
        } else {
            message = 'ID' + id + 'の削除に失敗しました。'
            flashMessage.setAttribute('class', 'alert alert-danger my-2 flash-message');
        }
        flashMessage.innerHTML = message;
        return flashMessage;
    }
    window.setTimeout(function(){
        $('.alert-success').remove();
        $('.alert-danger').remove();
    }, 4000);
})