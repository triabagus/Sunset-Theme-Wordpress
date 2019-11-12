jQuery(document).ready(function ($) {
    //custom Sunset scripts

    revealPosts();

    function sunset_get_thumbs() { // wrap it with a new function
        var carousel = '.sunset-carousel-thumb';

        sunset_get_bs_thumbs(carousel);

        $(carousel).on('slid.bs.carousel', function () {
            sunset_get_bs_thumbs(carousel);
        });
    } // END sunset_get_thumbs()

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
    $(document).on('click', '.sunset-load-more:not(.loading)', function () {

        var that = $(this);
        var page = that.data('page');
        var newPage = page + 1;
        var ajaxUrl = that.data('url');

        that.addClass('loading').find('.text').slideUp(320);
        that.find('.sunset-icon').addClass('spin');

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

                setTimeout(function () {
                    that.data('page', newPage);
                    $('.sunset-posts-container').append(response);

                    that.removeClass('loading').find('.text').slideDown(320);
                    that.find('.sunset-icon').removeClass('spin');

                    revealPosts();

                }, 2000);


            }
        });

    });

    /** Helper function */
    function revealPosts() {
        var posts = $('article:not(.reveal)');
        var i = 0;

        setInterval(function () {

            if (i >= posts.length) return false;

            var el = posts[i];
            $(el).addClass('reveal').find('.sunset-carousel-thumb').carousel();
            sunset_get_thumbs(); // call the new function

            i++;

        }, 200);
    }


});