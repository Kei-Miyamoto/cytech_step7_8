$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#searchBtn').on('click', function() {
        // 検索内容を取得する
        let keyword = $('#inputProductName').val();
        let companyId = $('#inputCompany').val();

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
            });
        })
        .fail(function(data, xhr, err) {
            console.log(err);
            console.log(xhr);
            console.log(data || 'null');
        });
    });
})