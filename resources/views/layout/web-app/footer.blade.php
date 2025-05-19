{{-- <div id="shopify-section-footer" class="shopify-section">
  <!-- Footer Area Start Here -->
  <footer id="section-footer" class="pt-3 bg-secondary">
    <div class="footer-bottom text-center off-black-bg">
      <p>Copyright © {{date('Y')}} <a title="#" href="/">Lawliet Store</a> | Built with <a href="https://www.akushoping.com" target="blank" title="#">Aku Airdiv</a></p>
    </div>
  </footer>
  <!-- Footer Area End Here -->
</div> --}}
<style>
    .widget-list {
    display: flex; /* Ensures the list is displayed as a flex container */
    flex-wrap: wrap; /* Allows wrapping to the next line if items don't fit */
    padding: 0; /* Removes default padding */
    margin: 0; /* Removes default margin */
    list-style: none; /* Removes bullet points */
}
.widget-list-item {
    margin-right: 15px; /* Adjust spacing between list items */
    margin-bottom: 10px; /* Adds spacing for wrapping items */
}
.widget-list-link {
    text-decoration: none;
    color: inherit;
}
    </style>
<footer class="pt-3 bg-secondary">

    <div class="container py-lg-4">
        <div class="row">
            <div class="col-12 col-lg-9">
                <div class="widget widget-links widget-light pb-2">
                    <h3 class="widget-title text-dark text-center text-lg-left">QUICKLINKS</h3>
                </div>
                <div class="row">
                    <div class="col">
                        <ul class="widget-list">
                            {{-- <li class="widget-list-item footer-list-item-link">
                                <a href="https://soklyphone.com/products?category=mobile-phone" class="widget-list-link">
                                    Mobile Phone
                                </a>
                            </li>
                            <li class="widget-list-item footer-list-item-link">
                                <a href="https://soklyphone.com/products?category=laptop" class="widget-list-link">
                                    Laptop
                                </a>
                            </li>
                            <li class="widget-list-item footer-list-item-link">
                                <a href="https://soklyphone.com/products?category=tablet" class="widget-list-link">
                                    Tablet
                                </a>
                            </li>
                            <li class="widget-list-item footer-list-item-link">
                                <a href="https://soklyphone.com/products?category=accessories" class="widget-list-link">
                                    Play Station
                                </a>
                            </li>
                            <li class="widget-list-item footer-list-item-link">
                                <a href="https://soklyphone.com/products?category=bluetooth-speaker" class="widget-list-link">
                                    Bluetooth Speaker
                                </a>
                            </li>
                            <li class="widget-list-item footer-list-item-link">
                                <a href="https://soklyphone.com/products?category=connector" class="widget-list-link">
                                    Connector
                                </a>
                            </li>
                            <li class="widget-list-item footer-list-item-link">
                                <a href="https://soklyphone.com/products?category=keyboard" class="widget-list-link">
                                    Keyboard
                                </a>
                            </li>
                            <li class="widget-list-item footer-list-item-link">
                                <a href="https://soklyphone.com/products?category=router-wireless" class="widget-list-link">
                                    Router Wireless
                                </a>
                            </li>
                            <li class="widget-list-item footer-list-item-link">
                                <a href="https://soklyphone.com/news" class="widget-list-link">
                                    News
                                </a>
                            </li>
                            <li class="widget-list-item footer-list-item-link">
                                <a href="https://soklyphone.com/products?category=case" class="widget-list-link">
                                    Case
                                </a>
                            </li> --}}
                            <li class="widget-list-item footer-list-item-link">
                                <a href="{{ route('contact') }}" class="widget-list-link">
                                    Contact us
                                </a>
                            </li>
                            <li class="widget-list-item footer-list-item-link">
                                <a href="{{ route('privacy-policy') }}" class="widget-list-link">
                                    Privacy-policy
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 d-block d-sm-none">
                <hr class="my-3">
            </div>
            <div class="col-12 col-lg-3">
                <div class="widget follow pb-2 mb-4">
                    <h3 class="widget-title text-dark pb-1">FOLLOW US</h3>
                    <a href="javascript:void(0)" class="d-flex flex-wrap align-items-center"></a>
                    <div>
                        <a href="javascript:void(0)" class="d-flex flex-wrap align-items-center">
                            &ZeroWidthSpace;&ZeroWidthSpace;&ZeroWidthSpace;&ZeroWidthSpace;
                        </a>
                        <a href="https://www.facebook.com/akustupidd/?utm_source=social&utm_medium=facebook&utm_campaign=follow_us" target="_blank" class="d-flex align-items-center">
                            <img style="width:25px; height;25px;" class="mr-2" src="{{asset('assets-web/images/fb.png')}}">
                            <span>Aku Stupidd</span>
                        </a>
                    </div>
                    <div>
                        &ZeroWidthSpace;&ZeroWidthSpace;&ZeroWidthSpace;&ZeroWidthSpace;
                        <a href="https://github.com/akustupidd/?utm_source=social&utm_medium=github&utm_campaign=follow_us" target="_blank" class="d-flex align-items-center">
                            <img style="width:25px; height;25px;" class="mr-2" src="{{asset('assets-web/images/github-logo.png')}}">
                            <span>Aku_atupidd</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white py-3">
        <div class="container text-center ">
            Copyright © {{date('Y')}} <a title="#" href="/">Lawliet Store</a> | Built with <a href="https://www.akushoping.com" target="blank" title="#">Aku Airdiv</a>
        </div>

    </div>
</footer>


{{-- modal view  --}}

<!-- Necessary JS -->

<!-- modalAddToCart -->
{{-- <div class="modal fade ajax-popup" id="modalAddToCart" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog white-modal modal-md">
    <div class="modal-content">
      <div class="modal-body">
        <div class="modal-content-text">
          <div class="popup-image">
            <img class="popupimage" src="">
          </div>
          <div class="popup-content">
            <h6 class="productmsg"></h6>
            <p class="success-message">
              <i class="fa fa-check-circle"></i>Added to cart successfully!
            </p>
            <div class="modal-button">
              <a href="/cart" class="theme-default-button">View Cart</a>
              <a href="/checkout" class="theme-default-button">Checkout</a>
            </div>
          </div>
        </div>
        <div class="modal-close">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div> --}}
<!-- modalAddToCart -->

<!-- modalAddToCart Error -->
{{-- <div class="modal fade ajax-popup error-ajax-popup" id="modalAddToCartError" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog white-modal modal-md">
    <div class="modal-content ">
      <div class="modal-body">
        <div class="modal-content-text">
          <p class="error_message"></p>
        </div>
        <div class="modal-close">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div> --}}


<!-- END QUICKVIEW PRODUCT -->
<div class="ajax-success-compare-modal compare_modal" id="moda-compare" tabindex="-1" role="dialog" style="display:none">
  <div class="overlay"></div>
  <div class="modal-dialog modal-lg">
    <div class="modal-content content" id="compare-modal">
      <div class="modal-header">
        <div class="modal-close">
          <span class="compare-modal-close">x</span>
        </div>
        <h4 class="modal-title">Compare Product</h4>
      </div>
      <div class="modal-body">
        <div class="table-wrapper">
          <table class="table table-hover table-responsive">
            <thead>
              <tr class="th-compare">
                <td>Action</td>
                <th class=" fhasellus-viverra-urna">
                  <button type="button" class="close remove-compare center-block" aria-label="Close" data-handle="fhasellus-viverra-urna">
                    <i class="fa fa-times"></i>
                  </button>
                </th>
              </tr>
            </thead>
            <tbody id="table-compare">
              <tr>
                <th width="15%" class="product-name"> Product name </th>
                <td width="90%" class="fhasellus-viverra-urna"> fhasellus viverra urna </td>
              </tr>
              <tr>
                <th width="15%" class="product-name"> Product image </th>
                <td width="90%" class="item-row fhasellus-viverra-urna" id="product-13333044658243">
                  <img src="//cdn.shopify.com/s/files/1/0037/2680/3011/products/9_dc5704b1-cf6a-4c17-8df7-3787956fbcc8.png?v=1536039129" width="150">
                  <div class="product-price">
                    <span class="price-sale">
                      <span class="money" data-currency-bdt="Tk 3,527.28">Tk 3,527.28</span>
                    </span>
                  </div>
                  <a href="javascript:void(0);" onclick="location.href='/products/fhasellus-viverra-urna'">view Product</a>
                </td>
              </tr>
              <tr>
                <th width="15%" class="product-name"> Product description </th>
                <td width="90%" class="fhasellus-viverra-urna ">
                  <p class="description-compare"> [new_products]300[/new_products] Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, [short_description] Contrary... </p>
                </td>
              </tr>
              <tr></tr>
              <tr>
                <th width="15%" class="product-name"> AVAILABILITY </th>
                <td width="90%" class="available-stock fhasellus-viverra-urna">
                  <p> Available In stock </p>
                </td>
              </tr>
              <tr></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>