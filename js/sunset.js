jQuery(document).ready(function ($) {
    //custom Sunset scripts

    var carousel = '.sunset-carousel-thumb';

    sunset_get_bs_thumbs(carousel);

    $(carousel).on('slid.bs.carousel', function () {
        sunset_get_bs_thumbs(carousel);
    });

    function sunset_get_bs_thumbs(carousel) {

        $(carousel).each(function () {

            var nextThumb = $(this).find('.carousel-item.active').find('.next-image-preview').data('image');
            var prevThumb = $(this).find('.carousel-item.active').find('.prev-image-preview').data('image');

            $(this).find('.carousel-control-next').find('.thumbnail-container').css({
                'background-image': 'url(' + nextThumb + ')'
            });
            $(this).find('.carousel-control-prev').find('.thumbnail-container').css({
                'background-image': 'url(' + prevThumb + ')'
            });

        });

    }

    /** Ajax Function */
    $(document).on('click', '.sunset-load-more', function () {

        var that = $(this);
        var page = that.data('page');
        var newPage = page + 1;
        var ajaxUrl = that.data('url');

        $.ajax({

            url: ajaxUrl,
            type: 'post',
            data: {
                page: page,
                action: 'sunset_load_more'
            },
            error: function (response) {
                console.log(response);
            },
            success: function (response) {
                that.data('page', newPage);
                $('.sunset-posts-container').append(response);
            }
        });

    });

});