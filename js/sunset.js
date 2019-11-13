jQuery(document).ready(function ($) {
    //custom Sunset scripts

    /**init function */
    revealPosts();

    var last_scroll = 0;

    function sunset_get_thumbs() { // wrap it with a new function
        /**variable function */
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
        var prev = that.data('prev');
        console.log(prev);

        if (typeof prev === 'undefined') {
            prev = 0;
        }

        that.addClass('loading').find('.text').slideUp(320);
        that.find('.sunset-icon').addClass('spin');

        $.ajax({

            url: ajaxUrl,
            type: 'post',
            data: {
                page: page,
                prev: prev,
                action: 'sunset_load_more'
            },
            error: function (response) {
                console.log(response);
            },
            success: function (response) {

                if (response == 0) {

                    $('.sunset-posts-container').append('<div class="text-center"><h3>You reached the end of the line !</h3><p>No more posts to load.</p></div>');
                    that.slideUp(320);

                } else {

                    setTimeout(function () {

                        if (prev == 1) {
                            $('.sunset-posts-container').prepend(response);
                            newPage = page - 1;
                        } else {
                            $('.sunset-posts-container').append(response);
                        }

                        if (newPage == 1) {
                            that.slideUp(320);
                        } else {
                            that.data('page', newPage);
                            that.removeClass('loading').find('.text').slideDown(320);
                            that.find('.sunset-icon').removeClass('spin');
                        }

                        revealPosts();

                    }, 1000);

                }


            }
        });

    });

    /**Scroll  function*/
    $(window).scroll(function () {

        var scroll = $(window).scrollTop();

        if (Math.abs(scroll - last_scroll) > $(window).height() * 0.1) {
            last_scroll = scroll;

            $('.page-limit').each(function (index) {

                if (isVisible($(this))) {

                    history.replaceState(null, null, $(this).attr("data-page"));
                    return (false);

                }

            });

        }

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

    function isVisible(element) {

        var scroll_pos = $(window).scrollTop();
        var window_height = $(window).height();
        var el_top = $(element).offset().top;
        var el_height = $(element).height();
        var el_bottom = el_top + el_height;
        return ((el_bottom - el_height * 0.25 > scroll_pos) && (el_top < (scroll_pos + 0.5 * window_height)));
    }
});