@extends('layout.web-app.app')
@section('title') {{'Product Detail'}} @endsection
@section('content-web')

<main role="main">
  <div id="shopify-section-template--16447384748230__main" class="shopify-section">
    <!-- Product Thumbnail Start -->
    <div class="main-product-thumbnail" id="section-template--16447384748230__main">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb custom-bread">
            <li class="breadcrumb-item"><a href="{{route('home-page')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('product-shop')}}">Product</a></li>
            <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
          </ol>
        </nav>
        <div class="row">
          <div class="col-lg-6 col-md-6 mb-all-40">
            <!-- Thumbnail Large Image start -->
            <div class="tab-content">
              <div class="" id="ProductPhoto">
                <img id="ProductPhotoImg" class="product-zoom product_variant_image"
                    data-image-id="{{ asset('uploads/products/' . $product->image) }}" alt="{{$product->name}}"
                    src="{{ asset('uploads/products/' . $product->image) }}">
              </div>
            </div>
            <!-- Thumbnail Large Image End -->
            <!-- Thumbnail Image End -->
            <div class="product-thumbnail">
              <div class="thumb-menu owl-carousel" id="ProductThumbs">
                <a class="product-single__thumbnail active" href="{{asset('uploads/products/' . $product->image) }}"
                  data-image="{{asset('uploads/products/' . $product->image) }}" data-zoom-image="{{asset('uploads/products/' . $product->image) }}" data-image-id="{{$product->id}}">
                  <img src="{{asset('uploads/products/' . $product->image) }}" alt="$product->name">
                </a>
                @foreach($features_img as $feature_img)
                  <a class="product-single__thumbnail " href="{{asset('uploads/features-img/' . $feature_img->image) }}"
                    data-image="{{asset('uploads/features-img/' . $feature_img->image) }}" data-zoom-image="{{asset('uploads/features-img/' . $feature_img->image) }}" data-image-id="{{$feature_img->product_id}}">
                    <img src="{{asset('uploads/features-img/' . $feature_img->image) }}" alt="{{$feature_img->product_id}}">
                  </a>
                @endforeach
              </div>
            </div>
            <!-- Thumbnail image end -->
            <!-- soft-info start-->
            <div class="order-lg-1 soft-info pb-3 pt-4 d-none {{count($softinfos) >= 1 ? 'd-block' : 'd-none'}}">
              <div class="card">
                <div class="card-body p-2">
                  <div class="row row-cols-4 no-gutters">
                    @foreach($softinfos as $softinfo)
                      <div class="col">
                        <div class="d-flex flex-column justify-content-between align-items-center">
                          <div class="icon">
                            <img src="{{ asset('uploads/softinfos/' . $softinfo->icon) }}" alt="{{$softinfo->icon}}">
                          </div>
                          <h6 class="mt-3 mb-2 font-md"> {{$softinfo->level}}</h6>
                          <small class="text-muted font-size-xs">
                            <div>{{$softinfo->description}}</div>
                          </small>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
            <!-- soft-info end -->
          </div>
          <div class="col-lg-6 col-md-6">
            <form method="get" action="{{ route('cart.add', $product->id)}}" id="AddToCartForm" accept-charset="UTF-8" class="shopify-product-form" enctype="multipart/form-data">
              @csrf
              @method('GET')
              <div class="thubnail-desc">
                <h3 id="popup_cart_title" class="product-header">{{$product->name}}</h3>
                <ul class="rating-summary">
                  <li class="rating-pro">
                    <span class="shopify-product-reviews-badge" data-id="1488431415363"></span>
                  </li>
                </ul>
                <div class="pro-thumb-price">
                  <p>
                    <span class="special-price" id="ProductPrice">
                      <span class=money>${{ $product->stock ? number_format($product->stock->price, 2) : 'N/A' }}</span>
                    </span>
                  </p>

                  <!-- For Unit Price  -->
                  <small class="unit_price_box caption hidden ">
                    <dd>
                      <span id="product__unit_price">5454</span>
                      <span aria-hidden="true">/</span>
                      <span id="product__unit_price_value">5454</span>
                    </dd>
                  </small>
                  <!-- For Unit Price  -->
                  <div class="product-variant-inventory">
                    <span class="inventory-title">Availability:</span>
                    @if($product->stock && $product->stock->quantity > 0)
                      <span class="variant-inventory">{{ $product->stock->quantity }} left in stock</span>
                    @else
                      <span class="variant-inventory">Out of Stock</span>
                    @endif
                  </div>
                </div>
                <div class="product-description-2">
                  <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                </div>

                <div class="choose-store mb-1 pt-1 {{count($rams) >= 1 ? 'd-block' : 'd-none'}}">
                  <h5 class="h7 mb-3">Choose your memory (RAM)</h5>
                  <div class="row">
                    @foreach($rams as $key => $ram)
                    <div class="col-lg-3 p-r-0">
                      <input type="radio" value="{{$ram->size}}" name="ram" price="0" prefix="+" except-storages="[]" id="ram-{{$key}}" checked="">
                      <label for="ram-{{$key}}" class="subscription__button justify-content-center">
                        <h3 class="h6 subscription__title">{{$ram->size}}</h3>
                      </label>
                    </div>
                    @endforeach
                  </div>
                </div>
                <div class="choose-store mb-1 pt-1 {{count($storages) >= 1 ? 'd-block' : 'd-none'}}">
                  <h5 class="h7 mb-3">Choose your storage</h5>
                  <div class="row">
                    @foreach($storages as $key => $storage)
                      <div class="col-lg-3 p-r-0">
                        <input type="radio" name="storage" value="{{$storage->size}}" price="0" prefix="+" except-storages="[]" id="storage-{{$key}}" checked="">
                        <label for="storage-{{$key}}" class="subscription__button justify-content-center">
                          <h3 class="h6 subscription__title">{{$storage->size}}</h3>
                        </label>
                      </div>
                    @endforeach
                  </div>
                </div>
                <div class="choose-store mb-1 pt-1 choose-color m-b-20 {{count($colors) >= 1 ? 'd-block' : 'd-none'}}">
                  <h5 class="h7 mb-3">Choose your color</h5>
                  <div class="row color-options">
                    @foreach($colors as $key => $color)
                      <div class="col-lg-3 p-r-0" id="color-option-186">
                        <input type="radio" name="color" value="{{$color->color_name}}" price="0" prefix="+" except-storages="[]" id="color-{{$key}}" checked="">
                        <label for="color-{{$key}}" class="subscription__button" style="padding-top: 10px;">
                          <div class="rounded-circle bg-secondary mb-1 color" style="background-color: {{$color->color_code}} !important; border:0.5px solid #bcb7b7;"></div>
                          <h3 class="h6 subscription__title text-capitalize">{{$color->color_name}}</h3>
                        </label>
                      </div>
                    @endforeach
                  </div>
                </div>



                <div class="quatity-stock">
                  <ul class="d-flex flex-wrap">
                    <label>Quantity</label>
                    <li class="box-quantity">
                      <input class="quantity" type="number" value="1" min="1" name="quantity">
                    </li>

                    <li>
                      <button type="submit" class="pro-cart">
                        <span class="addto">Add To Cart</span>
                      </button>
                    </li>
                    <li class="wishlist-button">
                      <a class="action-wishlist action--wishlist tile-actions--btn flex wishlist-btn wishlist" href="{{ route('favorite-add', $product->id)}}" button-wishlist data-product-handle="aliquam-consequat-mattis" title="Wishlist">
                        <i class="ti-heart"></i>
                        <i class="ti-settings fa-spin"></i>
                        <i class="fa fa-heart"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
    <!-- Product Thumbnail End -->
    <script src="https://ponno-demo.myshopify.com/cdn/shop/t/15/assets/jquery.elevateZoom-3.0.8.min.js?v=123299089282303306721714830619"></>
    <link href="https://ponno-demo.myshopify.com/cdn/shop/t/15/assets/jquery.fancybox.css?v=95878193068690839161714830619" rel="stylesheet" type="text/css" media="all" />
    <script src="https://ponno-demo.myshopify.com/cdn/shop/t/15/assets/jquery.fancybox.min.js?v=52186688543886745331714830619"></script>
    <script>
      $(document).ready(function() {
        $('.fancybox').fancybox();
      });
    </script>
    <script>
        // Preorder
        var var_array = {"13333050064963": {qty: "0", inventory_policy: "deny" },"13333050097731": {qty: "8", inventory_policy: "deny" },"13333050130499": {qty: "9", inventory_policy: "deny" },"13333050163267": {qty: "8", inventory_policy: "deny" },"13333050196035": {qty: "9", inventory_policy: "deny" },"13333050228803": {qty: "9", inventory_policy: "deny" },"13333050261571": {qty: "8", inventory_policy: "deny" },"13333050294339": {qty: "9", inventory_policy: "deny" },"13333050327107": {qty: "9", inventory_policy: "deny" },"13333050359875": {qty: "9", inventory_policy: "deny" },"13333050392643": {qty: "9", inventory_policy: "deny" },"13333050425411": {qty: "9", inventory_policy: "deny" },"13333050458179": {qty: "9", inventory_policy: "deny" },"13333050490947": {qty: "9", inventory_policy: "deny" },"13333050523715": {qty: "9", inventory_policy: "deny" },"13333050556483": {qty: "9", inventory_policy: "deny" },"13333050589251": {qty: "9", inventory_policy: "deny" },"13333050622019": {qty: "9", inventory_policy: "deny" },"13333050654787": {qty: "9", inventory_policy: "deny" },"13333050687555": {qty: "9", inventory_policy: "deny" },"13333050720323": {qty: "9", inventory_policy: "deny" },"13333050753091": {qty: "9", inventory_policy: "deny" },"13333050785859": {qty: "9", inventory_policy: "deny" },"13333050818627": {qty: "9", inventory_policy: "deny" },"13333050851395": {qty: "9", inventory_policy: "deny" },"13333050884163": {qty: "9", inventory_policy: "deny" },"13333050916931": {qty: "9", inventory_policy: "deny" },"13333050949699": {qty: "9", inventory_policy: "deny" },"13333050982467": {qty: "9", inventory_policy: "deny" },"13333051015235": {qty: "9", inventory_policy: "deny" },"13333051048003": {qty: "9", inventory_policy: "deny" },"13333051080771": {qty: "9", inventory_policy: "deny" },"13333051113539": {qty: "9", inventory_policy: "deny" },"13333051146307": {qty: "9", inventory_policy: "deny" },"13333051179075": {qty: "9", inventory_policy: "deny" },"13333051211843": {qty: "9", inventory_policy: "deny" },"13333051244611": {qty: "9", inventory_policy: "deny" },"13333051277379": {qty: "9", inventory_policy: "deny" },"13333051310147": {qty: "9", inventory_policy: "deny" },"13333051342915": {qty: "9", inventory_policy: "deny" },"13333051375683": {qty: "9", inventory_policy: "deny" },"13333051408451": {qty: "9", inventory_policy: "deny" },"13333051441219": {qty: "9", inventory_policy: "deny" },"13333051473987": {qty: "9", inventory_policy: "deny" },"13333051506755": {qty: "9", inventory_policy: "deny" },"13333051539523": {qty: "9", inventory_policy: "deny" },"13333051572291": {qty: "9", inventory_policy: "deny" },"13333051605059": {qty: "9", inventory_policy: "deny" },"13333051637827": {qty: "9", inventory_policy: "deny" },"13333051670595": {qty: "9", inventory_policy: "deny" },"13333051703363": {qty: "9", inventory_policy: "deny" },"13333051736131": {qty: "9", inventory_policy: "deny" },"13333051768899": {qty: "9", inventory_policy: "deny" },"13333051801667": {qty: "9", inventory_policy: "deny" },},
        var_num = '';


        var selectCallback = function(variant, selector) {
          timber.productPage({
            money_format: "",
            variant: variant,
            selector: selector
          });


          // Preorder
        var addToCartBtn = $('#AddToCart');

        if (variant) {



              // Preorder
          if (variant.inventory_management != null) {
            for( variant_id in var_array){
              if(variant.id == variant_id ){
                var_num = var_array[variant_id].qty;
                var inventoryQuantity = parseInt(var_num);
                var inventroyPolicy = var_array[variant_id].inventory_policy;
              }
              if(inventoryQuantity <= 0 && inventroyPolicy === "continue"){
                addToCartBtn.text("Preorder");
              }else if(inventoryQuantity <= 0 && inventroyPolicy !== "continue"){
                addToCartBtn.text("Soldout");
              }else{
                addToCartBtn.text("Add To Cart");
              }
            }
          }


          // Current variant select+
          var form = jQuery('#' + selector.domIdPrefix).closest('form');
          for (var i=0,length=variant.options.length; i<length; i++) {
            var val = variant.options[i].replace(/'/g,"&#039;");
            var radioButton = form.find(".swatch[data-option-index='" + i + "'] :radio[value='" + val +"']");
            if (radioButton.size()) {
              radioButton.get(0).checked = true;
            }
          }

          // Current sku pass
          $('.variant-sku').text(variant.sku);
        }else {
          $('.variant-sku').empty();
        }




        /* -- code added for Inventory -- */
          var selectors = {
            variantInventory: '.variant-inventory'
          };
          var inventory_level = (inv_qty[ variant.id ]);
          if (inventory_level == 0){
            $(selectors.variantInventory, this.$container).html('Out of stock').show();
          }
          else if (inventory_level > 100) {
              $(selectors.variantInventory, this.$container).html("In stock").show();
          }
          else {
            $(selectors.variantInventory, this.$container).html(inventory_level + ' left in stock').show();
          }
          /* - Inventory end - */

      // product image zoom with variant
        if (variant && variant.featured_image) {
          jQuery('#ProductThumbs a[data-image-id="' + variant.featured_image.id + '"]').trigger('click');
        }};



      jQuery(function($) {
        new Shopify.OptionSelectors('productSelect', {
          product: {"id":1488431415363,"title":"aliquam consequat mattis","handle":"aliquam-consequat-mattis","description":"\u003cp\u003eThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.\u003c\/p\u003e\n[short_description]\n\u003cp\u003eThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.\u003c\/p\u003e\n[\/short_description] [product_description]\n\u003cp\u003eSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\u003c\/p\u003e\n\u003cp\u003eTo take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\u003c\/p\u003e\n[\/product_description]","published_at":"2018-09-02T05:50:51-04:00","created_at":"2018-09-02T05:50:54-04:00","vendor":"otobi","type":"assorted","tags":["gray","magenta","orange","pink","purple","violet"],"price":15000,"price_min":15000,"price_max":15000,"available":true,"price_varies":false,"compare_at_price":null,"compare_at_price_min":0,"compare_at_price_max":0,"compare_at_price_varies":false,"variants":[{"id":13333050064963,"title":"xl \/ gray \/ partex","option1":"xl","option2":"gray","option3":"partex","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":false,"name":"aliquam consequat mattis - xl \/ gray \/ partex","public_title":"xl \/ gray \/ partex","options":["xl","gray","partex"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050097731,"title":"xl \/ gray \/ wood","option1":"xl","option2":"gray","option3":"wood","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xl \/ gray \/ wood","public_title":"xl \/ gray \/ wood","options":["xl","gray","wood"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050130499,"title":"xl \/ gray \/ glass","option1":"xl","option2":"gray","option3":"glass","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xl \/ gray \/ glass","public_title":"xl \/ gray \/ glass","options":["xl","gray","glass"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050163267,"title":"xl \/ magenta \/ partex","option1":"xl","option2":"magenta","option3":"partex","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xl \/ magenta \/ partex","public_title":"xl \/ magenta \/ partex","options":["xl","magenta","partex"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050196035,"title":"xl \/ magenta \/ wood","option1":"xl","option2":"magenta","option3":"wood","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xl \/ magenta \/ wood","public_title":"xl \/ magenta \/ wood","options":["xl","magenta","wood"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050228803,"title":"xl \/ magenta \/ glass","option1":"xl","option2":"magenta","option3":"glass","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xl \/ magenta \/ glass","public_title":"xl \/ magenta \/ glass","options":["xl","magenta","glass"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050261571,"title":"xl \/ orange \/ partex","option1":"xl","option2":"orange","option3":"partex","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xl \/ orange \/ partex","public_title":"xl \/ orange \/ partex","options":["xl","orange","partex"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050294339,"title":"xl \/ orange \/ wood","option1":"xl","option2":"orange","option3":"wood","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xl \/ orange \/ wood","public_title":"xl \/ orange \/ wood","options":["xl","orange","wood"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050327107,"title":"xl \/ orange \/ glass","option1":"xl","option2":"orange","option3":"glass","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xl \/ orange \/ glass","public_title":"xl \/ orange \/ glass","options":["xl","orange","glass"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050359875,"title":"xl \/ purple \/ partex","option1":"xl","option2":"purple","option3":"partex","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xl \/ purple \/ partex","public_title":"xl \/ purple \/ partex","options":["xl","purple","partex"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050392643,"title":"xl \/ purple \/ wood","option1":"xl","option2":"purple","option3":"wood","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xl \/ purple \/ wood","public_title":"xl \/ purple \/ wood","options":["xl","purple","wood"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050425411,"title":"xl \/ purple \/ glass","option1":"xl","option2":"purple","option3":"glass","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xl \/ purple \/ glass","public_title":"xl \/ purple \/ glass","options":["xl","purple","glass"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050458179,"title":"xl \/ pink \/ partex","option1":"xl","option2":"pink","option3":"partex","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xl \/ pink \/ partex","public_title":"xl \/ pink \/ partex","options":["xl","pink","partex"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050490947,"title":"xl \/ pink \/ wood","option1":"xl","option2":"pink","option3":"wood","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xl \/ pink \/ wood","public_title":"xl \/ pink \/ wood","options":["xl","pink","wood"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050523715,"title":"xl \/ pink \/ glass","option1":"xl","option2":"pink","option3":"glass","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xl \/ pink \/ glass","public_title":"xl \/ pink \/ glass","options":["xl","pink","glass"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050556483,"title":"xl \/ violet \/ partex","option1":"xl","option2":"violet","option3":"partex","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xl \/ violet \/ partex","public_title":"xl \/ violet \/ partex","options":["xl","violet","partex"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050589251,"title":"xl \/ violet \/ wood","option1":"xl","option2":"violet","option3":"wood","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xl \/ violet \/ wood","public_title":"xl \/ violet \/ wood","options":["xl","violet","wood"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050622019,"title":"xl \/ violet \/ glass","option1":"xl","option2":"violet","option3":"glass","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xl \/ violet \/ glass","public_title":"xl \/ violet \/ glass","options":["xl","violet","glass"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050654787,"title":"ml \/ gray \/ partex","option1":"ml","option2":"gray","option3":"partex","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - ml \/ gray \/ partex","public_title":"ml \/ gray \/ partex","options":["ml","gray","partex"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050687555,"title":"ml \/ gray \/ wood","option1":"ml","option2":"gray","option3":"wood","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - ml \/ gray \/ wood","public_title":"ml \/ gray \/ wood","options":["ml","gray","wood"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050720323,"title":"ml \/ gray \/ glass","option1":"ml","option2":"gray","option3":"glass","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - ml \/ gray \/ glass","public_title":"ml \/ gray \/ glass","options":["ml","gray","glass"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050753091,"title":"ml \/ magenta \/ partex","option1":"ml","option2":"magenta","option3":"partex","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - ml \/ magenta \/ partex","public_title":"ml \/ magenta \/ partex","options":["ml","magenta","partex"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050785859,"title":"ml \/ magenta \/ wood","option1":"ml","option2":"magenta","option3":"wood","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - ml \/ magenta \/ wood","public_title":"ml \/ magenta \/ wood","options":["ml","magenta","wood"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050818627,"title":"ml \/ magenta \/ glass","option1":"ml","option2":"magenta","option3":"glass","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - ml \/ magenta \/ glass","public_title":"ml \/ magenta \/ glass","options":["ml","magenta","glass"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050851395,"title":"ml \/ orange \/ partex","option1":"ml","option2":"orange","option3":"partex","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - ml \/ orange \/ partex","public_title":"ml \/ orange \/ partex","options":["ml","orange","partex"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050884163,"title":"ml \/ orange \/ wood","option1":"ml","option2":"orange","option3":"wood","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - ml \/ orange \/ wood","public_title":"ml \/ orange \/ wood","options":["ml","orange","wood"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050916931,"title":"ml \/ orange \/ glass","option1":"ml","option2":"orange","option3":"glass","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - ml \/ orange \/ glass","public_title":"ml \/ orange \/ glass","options":["ml","orange","glass"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050949699,"title":"ml \/ purple \/ partex","option1":"ml","option2":"purple","option3":"partex","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - ml \/ purple \/ partex","public_title":"ml \/ purple \/ partex","options":["ml","purple","partex"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333050982467,"title":"ml \/ purple \/ wood","option1":"ml","option2":"purple","option3":"wood","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - ml \/ purple \/ wood","public_title":"ml \/ purple \/ wood","options":["ml","purple","wood"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333051015235,"title":"ml \/ purple \/ glass","option1":"ml","option2":"purple","option3":"glass","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - ml \/ purple \/ glass","public_title":"ml \/ purple \/ glass","options":["ml","purple","glass"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333051048003,"title":"ml \/ pink \/ partex","option1":"ml","option2":"pink","option3":"partex","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - ml \/ pink \/ partex","public_title":"ml \/ pink \/ partex","options":["ml","pink","partex"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333051080771,"title":"ml \/ pink \/ wood","option1":"ml","option2":"pink","option3":"wood","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - ml \/ pink \/ wood","public_title":"ml \/ pink \/ wood","options":["ml","pink","wood"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333051113539,"title":"ml \/ pink \/ glass","option1":"ml","option2":"pink","option3":"glass","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - ml \/ pink \/ glass","public_title":"ml \/ pink \/ glass","options":["ml","pink","glass"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333051146307,"title":"ml \/ violet \/ partex","option1":"ml","option2":"violet","option3":"partex","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - ml \/ violet \/ partex","public_title":"ml \/ violet \/ partex","options":["ml","violet","partex"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333051179075,"title":"ml \/ violet \/ wood","option1":"ml","option2":"violet","option3":"wood","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - ml \/ violet \/ wood","public_title":"ml \/ violet \/ wood","options":["ml","violet","wood"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333051211843,"title":"ml \/ violet \/ glass","option1":"ml","option2":"violet","option3":"glass","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - ml \/ violet \/ glass","public_title":"ml \/ violet \/ glass","options":["ml","violet","glass"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333051244611,"title":"xs \/ gray \/ partex","option1":"xs","option2":"gray","option3":"partex","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xs \/ gray \/ partex","public_title":"xs \/ gray \/ partex","options":["xs","gray","partex"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333051277379,"title":"xs \/ gray \/ wood","option1":"xs","option2":"gray","option3":"wood","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xs \/ gray \/ wood","public_title":"xs \/ gray \/ wood","options":["xs","gray","wood"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333051310147,"title":"xs \/ gray \/ glass","option1":"xs","option2":"gray","option3":"glass","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xs \/ gray \/ glass","public_title":"xs \/ gray \/ glass","options":["xs","gray","glass"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333051342915,"title":"xs \/ magenta \/ partex","option1":"xs","option2":"magenta","option3":"partex","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xs \/ magenta \/ partex","public_title":"xs \/ magenta \/ partex","options":["xs","magenta","partex"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333051375683,"title":"xs \/ magenta \/ wood","option1":"xs","option2":"magenta","option3":"wood","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xs \/ magenta \/ wood","public_title":"xs \/ magenta \/ wood","options":["xs","magenta","wood"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333051408451,"title":"xs \/ magenta \/ glass","option1":"xs","option2":"magenta","option3":"glass","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xs \/ magenta \/ glass","public_title":"xs \/ magenta \/ glass","options":["xs","magenta","glass"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333051441219,"title":"xs \/ orange \/ partex","option1":"xs","option2":"orange","option3":"partex","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xs \/ orange \/ partex","public_title":"xs \/ orange \/ partex","options":["xs","orange","partex"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333051473987,"title":"xs \/ orange \/ wood","option1":"xs","option2":"orange","option3":"wood","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xs \/ orange \/ wood","public_title":"xs \/ orange \/ wood","options":["xs","orange","wood"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333051506755,"title":"xs \/ orange \/ glass","option1":"xs","option2":"orange","option3":"glass","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xs \/ orange \/ glass","public_title":"xs \/ orange \/ glass","options":["xs","orange","glass"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333051539523,"title":"xs \/ purple \/ partex","option1":"xs","option2":"purple","option3":"partex","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xs \/ purple \/ partex","public_title":"xs \/ purple \/ partex","options":["xs","purple","partex"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333051572291,"title":"xs \/ purple \/ wood","option1":"xs","option2":"purple","option3":"wood","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xs \/ purple \/ wood","public_title":"xs \/ purple \/ wood","options":["xs","purple","wood"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333051605059,"title":"xs \/ purple \/ glass","option1":"xs","option2":"purple","option3":"glass","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xs \/ purple \/ glass","public_title":"xs \/ purple \/ glass","options":["xs","purple","glass"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333051637827,"title":"xs \/ pink \/ partex","option1":"xs","option2":"pink","option3":"partex","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xs \/ pink \/ partex","public_title":"xs \/ pink \/ partex","options":["xs","pink","partex"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333051670595,"title":"xs \/ pink \/ wood","option1":"xs","option2":"pink","option3":"wood","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xs \/ pink \/ wood","public_title":"xs \/ pink \/ wood","options":["xs","pink","wood"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333051703363,"title":"xs \/ pink \/ glass","option1":"xs","option2":"pink","option3":"glass","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xs \/ pink \/ glass","public_title":"xs \/ pink \/ glass","options":["xs","pink","glass"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333051736131,"title":"xs \/ violet \/ partex","option1":"xs","option2":"violet","option3":"partex","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xs \/ violet \/ partex","public_title":"xs \/ violet \/ partex","options":["xs","violet","partex"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333051768899,"title":"xs \/ violet \/ wood","option1":"xs","option2":"violet","option3":"wood","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xs \/ violet \/ wood","public_title":"xs \/ violet \/ wood","options":["xs","violet","wood"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":13333051801667,"title":"xs \/ violet \/ glass","option1":"xs","option2":"violet","option3":"glass","sku":"","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"aliquam consequat mattis - xs \/ violet \/ glass","public_title":"xs \/ violet \/ glass","options":["xs","violet","glass"],"price":15000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}}],"images":["\/\/ponno-demo.myshopify.com\/cdn\/shop\/products\/3_27fb7bc8-f509-49b9-b571-965fcf57e01c.png?v=1536038080","\/\/ponno-demo.myshopify.com\/cdn\/shop\/products\/4_6d126974-7768-49b0-bf41-d5ae8bc0ee44.png?v=1536038081","\/\/ponno-demo.myshopify.com\/cdn\/shop\/products\/5_1a9aa76e-5f36-43cf-a652-3f51dcb59107.png?v=1536038082","\/\/ponno-demo.myshopify.com\/cdn\/shop\/products\/6_664ffde8-4666-42d5-9f51-e999a5c15131.png?v=1536038084","\/\/ponno-demo.myshopify.com\/cdn\/shop\/products\/7.png?v=1536038085"],"featured_image":"\/\/ponno-demo.myshopify.com\/cdn\/shop\/products\/3_27fb7bc8-f509-49b9-b571-965fcf57e01c.png?v=1536038080","options":["Size","Color","Material"],"media":[{"alt":null,"id":3401832857667,"position":1,"preview_image":{"aspect_ratio":1.0,"height":800,"width":800,"src":"\/\/ponno-demo.myshopify.com\/cdn\/shop\/products\/3_27fb7bc8-f509-49b9-b571-965fcf57e01c.png?v=1536038080"},"aspect_ratio":1.0,"height":800,"media_type":"image","src":"\/\/ponno-demo.myshopify.com\/cdn\/shop\/products\/3_27fb7bc8-f509-49b9-b571-965fcf57e01c.png?v=1536038080","width":800},{"alt":null,"id":3401833119811,"position":2,"preview_image":{"aspect_ratio":1.0,"height":800,"width":800,"src":"\/\/ponno-demo.myshopify.com\/cdn\/shop\/products\/4_6d126974-7768-49b0-bf41-d5ae8bc0ee44.png?v=1536038081"},"aspect_ratio":1.0,"height":800,"media_type":"image","src":"\/\/ponno-demo.myshopify.com\/cdn\/shop\/products\/4_6d126974-7768-49b0-bf41-d5ae8bc0ee44.png?v=1536038081","width":800},{"alt":null,"id":3401833349187,"position":3,"preview_image":{"aspect_ratio":1.0,"height":800,"width":800,"src":"\/\/ponno-demo.myshopify.com\/cdn\/shop\/products\/5_1a9aa76e-5f36-43cf-a652-3f51dcb59107.png?v=1536038082"},"aspect_ratio":1.0,"height":800,"media_type":"image","src":"\/\/ponno-demo.myshopify.com\/cdn\/shop\/products\/5_1a9aa76e-5f36-43cf-a652-3f51dcb59107.png?v=1536038082","width":800},{"alt":null,"id":3401833513027,"position":4,"preview_image":{"aspect_ratio":1.0,"height":800,"width":800,"src":"\/\/ponno-demo.myshopify.com\/cdn\/shop\/products\/6_664ffde8-4666-42d5-9f51-e999a5c15131.png?v=1536038084"},"aspect_ratio":1.0,"height":800,"media_type":"image","src":"\/\/ponno-demo.myshopify.com\/cdn\/shop\/products\/6_664ffde8-4666-42d5-9f51-e999a5c15131.png?v=1536038084","width":800},{"alt":null,"id":3401833840707,"position":5,"preview_image":{"aspect_ratio":1.0,"height":800,"width":800,"src":"\/\/ponno-demo.myshopify.com\/cdn\/shop\/products\/7.png?v=1536038085"},"aspect_ratio":1.0,"height":800,"media_type":"image","src":"\/\/ponno-demo.myshopify.com\/cdn\/shop\/products\/7.png?v=1536038085","width":800}],"requires_selling_plan":false,"selling_plan_groups":[],"content":"\u003cp\u003eThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.\u003c\/p\u003e\n[short_description]\n\u003cp\u003eThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.\u003c\/p\u003e\n[\/short_description] [product_description]\n\u003cp\u003eSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\u003c\/p\u003e\n\u003cp\u003eTo take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\u003c\/p\u003e\n[\/product_description]"},
          onVariantSelected: selectCallback,
          enableHistoryState: true
        });

        // Add label if only one product option and it isn't 'Title'. Could be 'Size'.


        // Hide selectors if we only have 1 variant and its title contains 'Default'.

      });function productZoom(){
        $(".product-zoom").elevateZoom({
          gallery: 'ProductThumbs',
          galleryActiveClass: "active",
          zoomType: "inner",
          cursor: "crosshair"
        });$(".product-zoom").on("click", function(e) {
          var ez = $('.product-zoom').data('elevateZoom');
          $.fancybox(ez.getGalleryList());
          return false;
        });

      };
      function productZoomDisable(){
        if( $(window).width() < 767 ) {
          $('.zoomContainer').remove();
          $(".product-zoom").removeData('elevateZoom');
          $(".product-zoom").removeData('zoomImage');
        } else {
          productZoom();
        }
      };

      productZoomDisable();

      $(window).resize(function() {
        productZoomDisable();
      });$('#section-template--16447384748230__main .thumb-menu').owlCarousel({
            loop: true,

            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            margin: 15,
            smartSpeed: 500,
            nav: true,
            dots: false,
            responsive: {
                767: {
                    items: 3,
                    autoplay: true,
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 3
                }
            }
        })




    </script>
  </div>

  <div id="shopify-section-template--16447384748230__single-product-tab" class="shopify-section">
    <!-- Product Thumbnail Description Start -->
    <div class="thumnail-desc" id="section-template--16447384748230__single-product-tab">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="title-acordion">Specification</h1>
            <div class="accordion">
              @foreach($specifications as $specification)
                <div class="accordion-item">
                    <h5 class="accordion-header">{{$specification->title}}</h5>
                    <div class="accordion-content">
                      <div class="card-body">
                        <div class="d-flex">
                          {!! $specification->description !!}
                        </div>
                      </div>
                    </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>

        <script>
          document.addEventListener('DOMContentLoaded', () => {
              const headers = document.querySelectorAll('.accordion-header');

              headers.forEach(header => {
                  header.addEventListener('click', () => {
                      const item = header.parentElement;
                      const content = item.querySelector('.accordion-content');

                      if (content.style.display === 'block') {
                          content.style.display = 'none';
                      } else {
                          document.querySelectorAll('.accordion-content').forEach(content => {
                              content.style.display = 'none';
                          });
                          content.style.display = 'block';
                      }
                  });
              });
          });
        </script>
      </div>
      <!-- Container End -->
    </div>
    <!-- Product Thumbnail Description End -->
  </div>

  <div id="shopify-section-template--15048369275078__related-product" class="shopify-section">
    <!-- More Product Start Here -->
    <div class="more-product" id="section-template--15048369275078__related-product">
      <div class="container">
        <div class="section-title text-center mb-50">
          <h2>Related Products</h2>
        </div>
        <!-- Featured Product Activation Start Here -->
        <div class="feature-pro-active owl-carousel">
          @foreach($products as $product)
            <!-- Single Product Start -->
            <div class="single-ponno-product 13333033254979">
              <!-- Product Image Start -->
              <div class="pro-img">
                <a href="{{ route('product-detail', ['slug' => $product->slug]) }}">
                  <img class="primary-img popup_cart_image" src="{{asset('uploads/products/'. $product->image)}}" alt="{{$product->name}}">
                </a>
                <div class="pro-actions-link">
                  <a href="#" class="compare" data-toggle="tooltip" title="Compare" data-pid="cras-neque-metus" data-original-title="Compare" data-placement="left" title="Compare View">
                    <i class="icon icon-MusicMixer"></i>
                  </a>
                  <a href="javascript:void(0);" class="action-btn quick-view" onclick="quiqview('cras-neque-metus')" data-toggle="modal" data-target="#quickViewModal" title="Quick View">
                    <span class="icon icon-Eye"></span>
                  </a>
                </div>
                <a class="action-wishlist action--wishlist tile-actions--btn flex wishlist-btn wishlist sticker-new" href="{{ route('favorite-add', $product->id) }}" button-wishlist data-product-handle="" title="Wishlist">
                  <i class="ti-heart"></i>
                  <i class="ti-settings fa-spin"></i>
                  <i class="fa fa-heart"></i>
                </a>
              </div>
              <!-- Product Image End -->
              <!-- Product Content Start -->
              <div class="pro-content">
                <div class="pro-info">
                  <h4 class="popup_cart_title">
                    <a href="/products/cras-neque-metus">{{ $product->name }}</a>
                  </h4>
                  <p>
                    <span class="special-price">
                      <span class="money">
                        ${{ $product->stock ? number_format($product->stock->price, 2) : 'N/A' }}
                      </span>
                    </span>
                  </p>
                </div>
              </div>
              <!-- Product Content End -->
              <div class="pro-add-cart">
                <a href="{{ route('cart.add', $product->id)  }}" class="action-btn"  data-original-title="add to cart" title="add to cart">
                  <span class="addto">Add To Cart</span>
                </a>
              </div>
            </div>
            <!-- Single Product End -->
          @endforeach
        </div>
        <!-- Featured Product Activation Start Here -->
      </div>
    </div>
    <!-- More Product End Here -->
    <script>
      /*----------------------------------------
      10. Featured Product Activation
      ----------------------------------------*/
        $('#section-template--15048369275078__related-product .feature-pro-active').owlCarousel({
              loop: true,
              nav: true,
              dots: false,
              smartSpeed: 1500,
              navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'> </i>"],
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
    </script>
  </div>
</main>

@endsection
