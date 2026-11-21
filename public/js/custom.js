(function ($) {
    "use strict";

    $(document).ready(function () {
        $('#load-more').click(function (e) {
            e.preventDefault();

            let btn = $(this);
            let page = $(this).attr('data-page');
            let category_id = $(this).attr('data-category');

            $.ajax({
                url: 'view-more',
                type: 'POST',
                dataType: 'html',
                data: {
                    page,
                    category_id
                }
            }).done(function (response) {
                console.log(response);
                if (response.trim() === '') {
                    btn.hide();
                    return;
                }
                $('#posts-container').append(response);
                btn.attr('data-page', parseInt(page) + 1);
            });

        });
    });

    $('.list-cate .nav-pills .nav-link').on('click', function () {
        let category_id = $(this).attr('data-category-id');

        if (!category_id) return;

        $.ajax({
            url: 'filter-by-category',
            type: 'POST',
            dataType: 'html',
            data: {
                category_id
            }
        }).done(function (response) {
            $('.tab-post').html(response);
        });
    });

    $('#search-icon-1').on('click', function () {
        let keyword = $('.category-search input').length > 0 
                    ? $('.category-search input').val() 
                    : $('input[type="search"]').val();
        
        if (keyword) {
            window.location.href = "/search-result?keyword=" + encodeURIComponent(keyword);
        }else{
            alert('vui lòng nhập keyword');
        }
    });

    $(document).ready(function () {
        $('#view-more').click(function (e) {
            e.preventDefault();

            let btn = $(this);
            let page = $(this).attr('data-page');

            $.ajax({
                url: 'view-more-posts',
                type: 'POST',
                dataType: 'html',
                data: {
                    page,
                }
            }).done(function (response) {
                if (response.trim() === '') {
                    btn.hide();
                    return;
                }

                $('#posts-viewmore').append(response);
                
                // Đếm số bài viết trả về trong response
                var itemCount = $(response).filter('.features-item').length 
                            || $(response).find('.features-item').length;
                
                if (itemCount < 2) {
                    btn.hide();
                } else {
                    btn.attr('data-page', parseInt(page) + 1);
                }
            });

        });
    });

})(jQuery);
