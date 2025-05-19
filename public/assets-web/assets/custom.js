
    // Pick your format here:
    // money_format or money_with_currency_format
    Currency.format = 'money_format';

    var shopCurrency = 'USD';

    /* Sometimes merchants change their shop currency, let's tell our JavaScript file */
    Currency.moneyFormats[shopCurrency].money_with_currency_format = "${{amount}} USD";
    Currency.moneyFormats[shopCurrency].money_format = "${{amount}}";

    var cookieCurrency;
    try {cookieCurrency = Currency.cookie.read();} catch (err) {} // ignore errors reading cookies

    // Fix for customer account pages.
    jQuery('span.money span.money').each(function() {
      jQuery(this).parents('span.money').removeClass('money');
    });

    // Saving the current price.
    jQuery('span.money').each(function() {
      jQuery(this).attr('data-currency-USD', jQuery(this).html());
                        });

      // Select all your currencies buttons.
      var buttons = jQuery('.currency li');

      // If there's no cookie or it's the shop currency.
      if (cookieCurrency == null || cookieCurrency === shopCurrency) {
        buttons.removeClass('active');
        jQuery('.currency li[data-currency=' + shopCurrency + ']').addClass('active');
        Currency.currentCurrency = shopCurrency;
        jQuery(".current-currency").text(shopCurrency);
      }
      else {
        Currency.convertAll(shopCurrency, cookieCurrency);
        buttons.removeClass('active');
        jQuery('.currency li[data-currency=' + cookieCurrency + ']').addClass('active');
        jQuery(".current-currency").text(cookieCurrency);
      }

      // When customer clicks on a currency button.
      buttons.click(function() {
        buttons.removeClass('active');
        var cur = jQuery(this).attr('data-currency');
        jQuery( ".currency li[data-currency='" + cur + "']" ).addClass('active');

        var newCurrency =  jQuery(this).attr('data-currency');
        if(newCurrency == Currency.currentCurrency)
        {
          Currency.convertAll(shopCurrency, newCurrency);
        }
        else
        {
          Currency.convertAll(Currency.currentCurrency, newCurrency);
        }

        jQuery(".current-currency").text(cur);
      });

      // For product options.
      var main_selectCallback = window.selectCallback;
      var selectCallback = function(variant, selector) {
        main_selectCallback(variant, selector);
        Currency.convertAll(shopCurrency, jQuery(".currency .active").attr('data-currency'));
      };


    $(".cart-plus-minus").prepend('<div class="dec qtybutton">-</div>');
    $(".cart-plus-minus").append('<div class="inc qtybutton">+</div>');
    $(".qtybutton").on("click", function() {
      var $button = $(this);
      var oldValue = $button.parent().find("input").val();
      if ($button.text() == "+") {
        var newVal = parseFloat(oldValue) + 1;
      } else {
        // Don't allow decrementing below zero
        if (oldValue > 0) {
          var newVal = parseFloat(oldValue) - 1;
        } else {
          newVal = 1;
        }
      }
      $button.parent().find("input").val(newVal);
    });


    $(function() {
        // Current Ajax request.
        var currentAjaxRequest = null;
        // Grabbing all search forms on the page, and adding a .search-results list to each.
        var searchForms = $('form[action="/search"]').css('position','relative').each(function() {
          // Grabbing text input.
          var input = $(this).find('input[name="q"]');
          // Adding a list for showing search results.
          var offSet = input.position().top + input.innerHeight();
          $('<ul class="search-results home-two"></ul>').css( { 'position': 'absolute', 'left': '0px', 'top': offSet } ).appendTo($(this)).hide();    
          // Listening to keyup and change on the text field within these search forms.
          input.attr('autocomplete', 'off').bind('keyup change', function() {
            // What's the search term?
            var term = $(this).val();
            // What's the search form?
            var form = $(this).closest('form');
            // What's the search URL?
            var searchURL = '/search?type=product&q=' + term;
            // What's the search results list?
            var resultsList = form.find('.search-results');
            // If that's a new term and it contains at least 3 characters.
            if (term.length > 3 && term != $(this).attr('data-old-term')) {
              // Saving old query.
              $(this).attr('data-old-term', term);
              // Killing any Ajax request that's currently being processed.
              if (currentAjaxRequest != null) currentAjaxRequest.abort();
              // Pulling results.
              currentAjaxRequest = $.getJSON(searchURL + '&view=json', function(data) {
                // Reset results.
                resultsList.empty();
                // If we have no results.
                if(data.results_count == 0) {
                  // resultsList.html('<li><span class="title">No results.</span></li>');
                  // resultsList.fadeIn(100);
                  resultsList.hide();
                } else {
                  // If we have results.
                  $.each(data.results, function(index, item) {
                    var link = $('<a></a>').attr('href', item.url);
                    link.append('<span class="thumbnail"><img src="' + item.thumbnail + '" /></span>');
                    link.append('<span class="title">' + item.title + '</span>');
                    link.wrap('<li></li>');
                    resultsList.append(link.parent());
                  });
                  // The Ajax request will return at the most 10 results.
                  // If there are more than 10, let's link to the search results page.
                  if(data.results_count > 10) {
                    resultsList.append('<li><span class="title"><a href="' + searchURL + '">See all results (' + data.results_count + ')</a></span></li>');
                  }
                  resultsList.fadeIn(100);
                }        
              });
            }
          });
        });
        // Clicking outside makes the results disappear.
        $('body').bind('click', function(){
          $('.search-results').hide();
        });
      });


      jQuery('.addtocartqv').click(function(e) {
        e.preventDefault();
        Shopify.addItemFromFormStart('add-item-qv', jQuery(this).attr('id'));
      });


      var mainImage = '';
            jQuery(function ($) {

            quiqview = function(product_handle) {
                Shopify.getProduct(product_handle);
            }
            Shopify.onProduct = function(product) {
                $('.viewfullinfo').attr('href', product.url);

                // product description without shortcode
                text_truncate = function(str, length, ending) {
                if (length == null) {
                    length = 500;
                }
                if (ending == null) {
                    ending = '...';
                }
                if (str.length > length) {
                    return str.substring(0, length - ending.length) + ending;
                } else {
                    return str;
                }
                };

                var _parent = '#quickViewModal';
                $(_parent+' .product_title').text(product.title);
            


                // product rating
                $(_parent+' .rating').empty();
                $(_parent+' .rating').append("<span class=\"shopify-product-reviews-badge\" data-id=\""+product.id+"\"></span>");


                //check variants
                var variant = '';

                for (i = 0; i < product.variants.length; i++) {
                if(product.variants[i].inventory_quantity > 0) {
                    variant = product.variants[i];
                    break;
                }
                }

                if(variant == '') {
                for (i = 0; i < product.variants.length; i++) {
                    if(product.variants[i].inventory_policy == "continue") {
                    variant = product.variants[i];
                    break;
                    }
                }
                if(variant == '') {
                    variant = product.variants[0];
                }
                }

                mainImage = product.featured_image;
                var shopifyimgurl = variant.featured_image ? variant.featured_image.src : product.featured_image;
                var imgurl = "<img class=\"full-width\" alt=\"\" src = \""+shopifyimgurl+"\" >";
                jQuery(_parent+' .product-main-image__item .img_box_1').empty();
                jQuery(_parent+' .product-main-image__item .img_box_1').append(imgurl);
                jQuery(_parent+' .product-main-image__item .img_box_2').empty();
                jQuery(_parent+' .product-main-image__item .img_box_2').append(imgurl);

                // product description with shortcode
                var desc = product.description;
                if (desc.indexOf("[short_description]") >= 0) {
                desc = desc.split("[short_description]");
                desc = desc[1].split("[/short_description]");
                $(_parent+' .product-des').show();
                $(_parent+' .product-des').html(desc[0]);
                }
                else {
                $(_parent+' .product-des').html(text_truncate(product.description,499));
                }

                //set variants property
                var inv_qua = variant.inventory_quantity;
                //price
                if(variant.price < variant.compare_at_price) {
                $('.price-part .main').addClass('amount');
                $('.price-part .price-box__new').show();
                changePriceValue('.price-part .main', variant.compare_at_price);
                changePriceValue('.price-part .price-box__new', variant.price);
                }
                else {
                $('.price-part .price-box__new').hide();
                $('.price-part .main').removeClass('amount');
                changePriceValue('.price-part .main', variant.price);
                }

                // Variants select
                if(product.variants.length > 1) {
                var variants_margin = product.options.length == 2 ? 'variants_margin' : '';

                var select = '<select id="product-select-qv" name="id">';
                var selected = 'selected';
                for (i = 0; i < product.variants.length; i++) {
                    var _var = product.variants[i];
                    if(_var.available) {
                    select += '<option value="' + _var.id + '"' + selected +'>' + _var.title + ' - ' + Shopify.formatMoney(_var.price, "<span class=money>${{amount}}</span>") + '</option>'
                                                                                                                            selected = '';
                                                                                                                            }
                                                                                                                            }
                                                                                                                            select += '</select>';

                                                                                                                            var variant_select = '<div class="variants_selects ' + variants_margin + '">';
                                                                                                                            variant_select += select;
                                                                                                                            variant_select += '</div><div class="divider divider--sm"></div>';
                                                                                                                            select = variant_select;
                                                                                                                            }
                                                                                                                            else {
                                                                                                                            var select = '<input type="hidden" name="id" value="' + product.variants[0].id + '" />';
                                                                                                                            }
                                                                                                                            $('.variants').empty();
                    $('.variants').html(select);

                    //parametres
                    setParametresText(_parent+' .product-sku', variant.sku);
                    if(jQuery(_parent + ' .product-sku').length) {
                        var $ava = jQuery(_parent + " .product-info__availabilitu");
                        if(variant.sku != "") {
                        if($ava.hasClass('pull-left')){ $ava.removeClass('pull-left') }
                        } else {
                        if(!$ava.hasClass('pull-left')){ $ava.addClass('pull-left') }
                        }
                    }

                    //quantity
                    var out_of_stock = false;
                    if(variant.inventory_management) {
                        if(inv_qua > 0) {
                        $(_parent+' .product-availability').text(inv_qua + " In Stock");
                                                                }
                                                                else {
                                                                out_of_stock = true;
                                                                $(_parent+' .product-availability').text("In Stock");
                                                                                                            }
                                                                                                            }
                                                                                                            else {
                                                                                                            $(_parent+' .product-availability').text("Many in stock");
                                                                                                                                                    }

                                                                                                                                                    // button
                                                                                                                                                    if(!out_of_stock || variant.inventory_policy == "continue") {        
                            $('.product-available').show();
                            $('.product-disable').hide();
                            $('.addtocartqv').attr('id', product.id );
                        }
                        else {
                            $('.product-available').hide();
                            $('.product-disable').show();
                        }

                        if (product.available && product.variants.length > 1) {
                            new Shopify.OptionSelectors("product-select-qv", { product: product, onVariantSelected: selectCallbackQv, enableHistoryState: true });

                            if($('#quickViewModal .variants_selects .selector-wrapper').length > 0) {
                            $.each( jQuery('#quickViewModal .variants_selects .selector-wrapper'), function(index) {
                                $(this).find('label').text(product.options[index].name);
                            });
                            }
                        }
                        else {
                            jQuery('.currency .active').trigger('click');
                        }
                        selectGrid(_parent);

                        if($(".spr-badge").length > 0) {
                            $.getScript(window.location.protocol + "//productreviews.shopifycdn.com/assets/v4/spr.js");
                        }

                        if($(".selector-wrapper label").length) {
                            $(".selector-wrapper label").each(function( index ) {
                            $(this).text(jQuery(this).text() + ":");
                            });
                        }

                        $(_parent).modal('show');

                        if( !( 'ontouchstart' in window ) &&
                            !navigator.msMaxTouchPoints &&
                            !navigator.userAgent.toLowerCase().match( /windows phone os 7/i ) ) return false;

                        $j('body').css("top", -$j('body').scrollTop());
                        $j('body').addClass("no-scroll");
                        $j('.close').click(function(){
                            var top = parseInt($j('body').css("top").replace("px", ""))*-1;
                            $j('body').removeAttr("style");
                            $j('body').removeClass("no-scroll");
                            $j('body').scrollTop(top);
                        });
                        }

                        function setParametresText(obj, value) {
                        if(value != '') {
                            $(obj).parent().show();
                            $(obj).text(value);
                        }
                        else {
                            $(obj).parent().hide();
                        }
                        }

                        function changePriceValue (cell, value) {
                        $(cell).html(Shopify.formatMoney(value, "<span class=money>${{amount}}</span>"));
                                                        };

                                                        });



                                    var selectCallbackQv = function(variant, selector) {

                            var _parent = '#quickViewModal';
                            var _parentprice = _parent + ' .price-part';
                            if (!variant) {
                            jQuery(_parent + " .price-box").hide();
                            jQuery(_parent + " .qwt").hide();
                            jQuery(_parent + " .control-console").hide();
                            jQuery(_parent + ' .addtocartqv').attr('disabled','disabled');
                            jQuery(_parent + ' .addtocartqv').text('Unavailable');
                                                                    return false;
                                                                    }

                                                                    jQuery(_parent + " .price-box").show();
                            jQuery(_parent + " .qwt").show();
                            jQuery(_parent + " .control-console").show();

                            if(variant.price < variant.compare_at_price){
                                jQuery(_parentprice + ' .main').addClass('price-box__old');
                                jQuery(_parentprice + ' .price-box__new').show();
                                changePriceValue(_parentprice + ' .main', variant.compare_at_price);
                                changePriceValue(_parentprice + ' .price-box__new', variant.price);
                            } else {
                                jQuery(_parentprice + ' .price-box__new').hide();
                                jQuery(_parentprice + ' .main').removeClass('price-box__old');
                                changePriceValue(_parentprice + ' .main', variant.price);
                            }

                            newVariantTextDataQv(_parent + ' .product-sku', variant.sku);

                            if(jQuery(_parent + ' .product-sku').length) {
                                var $ava = jQuery(_parent + " .product-info__availabilitu");
                                if(variant.sku != "") {
                                if($ava.hasClass('pull-left')){ $ava.removeClass('pull-left') }
                                } else {
                                if(!$ava.hasClass('pull-left')){ $ava.addClass('pull-left') }
                                }
                            }

                            if (variant.available) {
                                if (variant.inventory_management == null) {
                                jQuery(_parent + " .product-availability").text("Many in stock");
                                                                                } else {
                                                                                jQuery(_parent + " .product-availability").text(" Many in stock");
                                                                                                                                }
                                                                                                                                } else {
                                                                                                                                jQuery(_parent + " .product-availability").text("Sold Out");
                }

            var shopifyimgurl = variant.featured_image ? variant.featured_image.src : mainImage;
                var imgurl = "<img class=\"full-width\" alt=\"\" src = \""+shopifyimgurl+"\" >";
            if(jQuery(_parent+' .product-main-image__item .img_box_1').children().length > 0) {
                var detach = jQuery(_parent+' .product-main-image__item .img_box_1 img').detach();
                jQuery(_parent+' .product-main-image__item .img_box_2').empty();
                jQuery(_parent+' .product-main-image__item .img_box_2').append(detach);
                }
                jQuery(_parent+' .product-main-image__item .img_box_1').empty();
                jQuery(_parent+' .product-main-image__item .img_box_1').append(imgurl);

                if (variant && variant.available) {
                jQuery(_parent + ' .addtocartqv').removeAttr('disabled');
                jQuery(_parent + ' .addtocartqv').html('Add to Cart');
                                                        jQuery(_parent + " .control-console").show();
                } else {
                jQuery(_parent + ' .addtocartqv').attr('disabled','disabled');
                jQuery(_parent + ' .addtocartqv').text('Unavailable');
                                                        jQuery(_parent + " .control-console").hide();
                }

                jQuery('.currency .active').trigger('click');
            };

            function changePriceValue (cell, value) {
                jQuery(cell).html(Shopify.formatMoney(value, "<span class=money>${{amount}}</span>"));
                                                    };

                                                    function newVariantTextDataQv (obj, value) {
                                if(value != '') {
                jQuery(obj).parent().show();
                jQuery(obj).text(value);
                }
                else {
                jQuery(obj).parent().hide();
                }
            };


            function selectGrid(_parent) {
                setTimeout(timeout, 5);
                function timeout() {
                if(jQuery(_parent + " .selector-wrapper").length > 2){
                    jQuery(_parent + " .single-option-selector").addClass("select--wd");
                } else if(jQuery(_parent + " .selector-wrapper").length == 1){
                    jQuery(_parent + " .single-option-selector").before("<label></label>");
                                                                        jQuery(_parent + " .single-option-selector").addClass("select--wd");
                }
                }
            };

        /*----------------------------
        6. Slider Activation
        -----------------------------*/
        $("#section-template--15048606908614__16315994201db2f330 .slider-activation").owlCarousel({
            loop: true,
          
            margin: 0,
            nav: true,
            autoplay: false,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            items: 1,
            autoplayTimeout: 10000,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            dots: true,
            autoHeight: true,
            lazyLoad: true,
        });

            
        /*-------------------------------------
          8. Apple Watch Product activation
          --------------------------------------*/
          $('#section-template--15048606908614__1631599496b8b3949c .large-active').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.thumb_active',
            infinite: true,
        });
    
    
        $('#section-template--15048606908614__1631599496b8b3949c .thumb_active').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.large-active',
            dots: false,
            arrows: false,
            centerMode: true,
            centerPadding: 0,
            focusOnSelect: true,
            infinite: true,
            vertical: true,
        }).on('beforeChange', function (event, slick, currentSlide, nextSlide) {
            $(this).find('.slick-slide').removeClass('first-item last-item');
            $(this).find('.slick-slide[data-slick-index="' + nextSlide + '"]').prev().addClass('first-item');
            $(this).find('.slick-slide[data-slick-index="' + nextSlide + '"]').next().addClass('last-item');
        });
    
        $('#section-template--15048606908614__1631599496b8b3949c .thumb_active').find('.slick-slide.slick-active').first().addClass('first-item');
        $('#section-template--15048606908614__1631599496b8b3949c .thumb_active').find('.slick-slide.slick-active').last().addClass('last-item');

        /*----------------------------------------
          10. Featured Product Activation
          ----------------------------------------*/
          $('#section-template--15048606908614__163153428287f898ba .feature-pro-active').owlCarousel({
            loop: true,
          
            nav: true,
            dots: false,
            smartSpeed: 1500,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            margin: 30,
            responsive: {
                0: {
                    items: 1,
                    autoplay: true,
                    smartSpeed: 500
                },
                480: {
                    items: 2
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 4
                }
            }
        })

        $('a.remove').removeAttr('href');