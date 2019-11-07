jQuery(document).ready(function ($) {
    //custom Sunset script

    var carousel = '.sunset-carousel-thumb';

    sunset_get_bs_thumbs(carousel);

    $(carousel).on('slid.bs.carousel', function () {
        sunset_get_bs_thumbs(carousel);
    });

    function sunset_get_bs_thumbs(carousel) {
        var nextThumb = $('.carousel-item.active').find('.next-image-preview').data('image');
        var prevThumb = $('.carousel-item.active').find('.prev-image-preview').data('image');

        $(carousel).find('.carousel-control-next').find('.thumbnail-container').css({
            'background-image': 'url(' + nextThumb + ')'
        });
        $(carousel).find('.carousel-control-prev').find('.thumbnail-container').css({
            'background-image': 'url(' + prevThumb + ')'
        });
    }
});