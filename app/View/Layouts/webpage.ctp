<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php
            if (!empty($title)) {
                echo $title;
            } else {
                echo 'Shagunn';
            }
            ?> </title>

        <meta name="Description" content="
        <?php
        if (!empty($metadescription)) {
            echo $metadescription;
        } else {
            echo "Birla Gold & Precious Metal Pvt. Ltd. has launched a new venture under Birla Gold Brand \"Shagunn\" as – A online Jewellery Stores. It\'s a newly launched e-commerce venture which BGPMPL has launched for the Customers.  With \"Shagunn\" Birla Gold & Precious Metal Pvt. Ltd. wants to reach every house in the Country.";
        }
        ?>
              " />

        <meta name="Keywords" content="
        <?php
        if (!empty($metakeyword)) {
            echo $metakeyword;
        } else {
            echo "Shagun, Shagunn, Shagunn.in, Shagun Jewels, Shagunn Jewels, Shagun Jewelery, Shagunn Jewelery, Shagun Jewellery, Shagunn Jewellery, Shagunn Online Jewellery Store, Online Shopping,  birla gold's Shagunn, Birla Gold's Shagunn Franchise, gold savings plan, jewellery, birla gold jewellery, gold jewellery, gold saving plan, birla, birla gold and precious metals private limited, BGPM, birlagold, birlagoldsp, birla gold, birla gold savings plan, birla gold and precious metals, gold and precious metals";
        }
        ?>">
        </meta>
        <title>Home | <?php echo SITE_NAME; ?></title>
        <!--<link href='http://fonts.googleapis.com/css?family=Merriweather:900|Cinzel:700' rel='stylesheet' type='text/css'>-->
        <?php
        echo $this->Html->css(array('webindex', 'webcss/main', 'webcss/jquery-ui', 'src/skdslider', 'webcss/jquery.jqzoom', 'webcss/jquery.bxslider', 'webcss/colorbox', 'jQuery.validation/validationEngine.jquery', 'message', 'jquery.fancybox-1.3.4', 'lightgallery/lightGallery', 'minicart/css/style'));
        echo $this->Html->script(array('jquery-1.11.1.min', 'webjs/jquery.1.8.2.min', 'webjs/jquery-ui', 'src/skdslider.min', 'webjs/fadeSlideShow', 'src/jquery.jqzoom-core', 'webjs/fadeSlideShow', 'webjs/jquery.bxslider.min', 'webjs/jquery.colorbox', 'jQuery.validation/jquery.validationEngine', 'jQuery.validation/languages/jquery.validationEngine-en', 'integer', 'jquery.fancybox-1.3.4.pack', 'lightgallery/lightGallery', 'flycart/prefixfree.min'));
        ?>
        <link rel="icon" href="/img/icons/fav.png" />


        <script type="text/javascript">
            jQuery(document).ready(function () {
                $('.header_menu').show();
                jQuery('#demo1').skdslider({'delay': 5000, 'animationSpeed': 2000, 'showNextPrev': true, 'showPlayButton': true, 'autoSlide': true, 'animationType': 'fading'});
                jQuery('#demo2').skdslider({'delay': 5000, 'animationSpeed': 1000, 'showNextPrev': true, 'showPlayButton': false, 'autoSlide': true, 'animationType': 'sliding'});
                jQuery('#demo3').skdslider({'delay': 5000, 'animationSpeed': 2000, 'showNextPrev': true, 'showPlayButton': true, 'autoSlide': true, 'animationType': 'fading'});

                jQuery('#responsive').change(function () {
                    $('#responsive_wrapper').width(jQuery(this).val());
                });

                $('.filter_option').click(function () {
                    var current_id = this.id;
                    $('#' + current_id + ' .filter_option_menu').slideToggle();
                });

                $('a').click(function () {
                    $('.coming_soon').fadeIn();
                });
                $('.close').click(function () {
                    $('.coming_soon').fadeOut();
                });


                $('.top_mid a').mouseover(function () {
                    $('.my_account_dropdown').slideDown(700);
                });
                $('.top_mid').mouseout(function () {
                    $('.my_account_dropdown').slideUp(700);
                });

                jQuery('.slideshow2').fadeSlideShow();
                $('.slider1').bxSlider({
                    responsive: false,
                    pager: false,
                    slideWidth: 320,
                    minSlides: 4,
                    maxSlides: 4,
                    moveSlides: 4
                });
                $('.slider2').bxSlider({
                    responsive: false,
                    pager: false,
                    slideWidth: 320,
                    minSlides: 4,
                    maxSlides: 4,
                    moveSlides: 4

                });
                $('.slider3').bxSlider({
                    responsive: false,
                    pager: false,
                    slideWidth: 116,
                    slideMargin: 0,
                    minSlides: 4,
                    maxSlides: 4,
                    moveSlides: 4
                });
                $(".group2").colorbox({rel: 'group2', transition: "fade"});
                $(".youtube").colorbox({iframe: true, innerWidth: 640, innerHeight: 390});

                $("#tabs").tabs({event: "mouseover"}).addClass("ui-tabs-vertical ui-helper-clearfix");
                $("#tabs li").removeClass("ui-corner-top").addClass("ui-corner-left");


                $('#nav > li').hover(function () {
                    _jewel = $(this).find('.shagun_megamenu');
                    if (_jewel.length > 0) {
//                        $(_jewel).css('border-top', '3px solid #e2ba35');
                    } else {
                    }
                    $('#nav > li, #nav > li.home_icn').not(this).css('border-bottom', '3px solid #e2ba35');
                    $(this).css('border-right', '1px solid #e2ba35');
                    $(this).prev().css('border-right', '1px solid #e2ba35');
                }, function () {
                    $('#nav > li, #nav > li.home_icn').css('border-bottom', 'none');
                    $(this).css('border-right', '1px dashed #e2ba35');
                    $(this).prev().css('border-right', '1px dashed #e2ba35')
                });
                $(".inline").colorbox({inline: true, width: "40%"});
                $(".accordion").accordion({
                    autoHeight: true,
                    heightStyle: "content"
                });

                $(".menutabs").tabs({event: "mouseover"}).addClass("ui-tabs-vertical ui-helper-clearfix");
                $(".menutabs li").removeClass("ui-corner-top").addClass("ui-corner-left");

                $('#nav > #offer_header').hover(function () {
//                    console.log($(this).find('#offers_navmenu  ul'));
                    $(this).find('#tabs8').addClass('offer_top');
                }, function () {
                });
            });


        </script>
        <script type="text/javascript">

            $(document).ready(function () {
                $('.jqzoom').jqzoom({
                    zoomType: 'standard',
                    lens: true,
                    preloadImages: false,
                    alwaysOn: false,
                    title: false
                });

                /*$( "#tabs2" ).tabs({
                 collapsible: true
                 });*/

                $('.add-to-cart').on('click', function () {
                    var cart = $('.shopping-cart');
                    var imgtodrag = $(this).closest('.item').find("img").eq(0);
//                    var imgtodrag = $(this).parent('.item').find("img").eq(0);
                    if (imgtodrag) {
                        var imgclone = imgtodrag.clone()
                                .offset({
                                    top: imgtodrag.offset().top,
                                    left: imgtodrag.offset().left
                                })
                                .css({
                                    'opacity': '0.5',
                                    'position': 'absolute',
                                    'height': '150px',
                                    'width': '150px',
                                    'z-index': '100'
                                })
                                .appendTo($('body'))
                                .animate({
                                    'top': cart.offset().top + 10,
                                    'left': cart.offset().left + 10,
                                    'width': 75,
                                    'height': 75
                                }, 1000, 'easeInOutExpo');

                        setTimeout(function () {
                            cart.effect("shake", {
                                times: 2
                            }, 200);
                        }, 1500);

                        imgclone.animate({
                            'width': 0,
                            'height': 0
                        }, function () {
                            $(this).detach()
                        });
                    }
                    _form = $(this).closest('form');

                    _data = _form.serialize();
                    $.ajax({
                        type: "POST",
                        url: "<?php echo BASE_URL; ?>shoppingcarts/minicart",
                        data: _data,
                        dataType: 'html',
                        success: function (data) {
                            $('#loginForm').html(data);
                            _qty = 0;
                            $('.minicart_qty').each(function(){
                                _qty = $(this).data('qty') + _qty;
                            });
                            $('#top_qty').html('Cart ('+_qty+')');
                        }
                    });
                    return false;
                });

                var button = $('#loginButton');
                var box = $('#loginBox');
                var form = $('#loginForm');
                button.removeAttr('href');
                button.mouseup(function (login) {
                    box.toggle();
                    button.toggleClass('active');
                });
                form.mouseup(function () {
                    return false;
                });
                $(this).mouseup(function (login) {
                    if (!($(login.target).parent('#loginButton').length > 0)) {
                        button.removeClass('active');
                        box.hide();
                    }
                });
            });


        </script>

    </head>
    <body>
        <div class="helpfade"></div>
        <div class="helptips"><div class="loader_block"><div class="loader_block_inner"></div><div class="loader_text">Please wait...</div></div></div>
        <div class="dismsg" id="msginfo"><?php
            $msg = $this->Session->flash();
            if (!empty($msg))
                echo $msg . '<div class="close">Click to close.</div>';
            ?></div>
        <?php echo $this->Element('header'); ?>
        <?php echo $content_for_layout; ?>
        <?php echo $this->Element('footer'); ?>
    </div>
    <script>
        $("#msginfo").click(function () {
            $("#msginfo").fadeOut(1000);
        });
        setTimeout(function () {
            $('#msginfo').fadeOut(1000);
        }, 5000);
    </script>

</body>
</html>


