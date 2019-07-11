
      <div class="row-cart-products" level="_2"><?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) { ?><div class="row-2 w-row" level="_3">
          <div class="column-5 w-col w-col-2 w-col-small-2 w-col-tiny-2" level="_4">
            <div class="div-block-9">
              <img src="<?php bloginfo('template_url'); ?>/images/image-placeholder.svg" wp_cart="product_image" alt="" class="image-7" />
            </div>
          </div>
          <div class="column-product-name w-col w-col-4 w-col-small-4 w-col-tiny-4" level="_4">
            <h3 wp_cart="product_title" class="heading-4">Название продукта</h3>
          </div>
          <div class="column-5 w-col w-col-2 w-col-small-2 w-col-tiny-2" level="_4">
            <a href="#" wp_cart="product_qty_minus" class="link-block w-inline-block" level="_5">
              <div class="minus-busket w-hidden-tiny">-</div>
            </a>
            <div wp_cart="product_qty" class="busket-qty">1</div>
            <a href="#" wp_cart="product_qty_plus" class="link-block-2 w-inline-block" level="_5">
              <div class="plus-busket w-hidden-tiny">+</div>
            </a>
          </div>
          <div class="column-5 w-col w-col-3 w-col-small-3 w-col-tiny-3" level="_4">
            <h5 wp_cart="product_price" class="heading-5">2 250</h5>
          </div>
          <div class="column-5 w-col w-col-1 w-col-small-1 w-col-tiny-1" level="_4">
            <a href="#" wp_cart="product_remove" class="link-block w-inline-block" level="_5">
              <div class="delete-from-busket">X</div>
            </a>
          </div>
        </div><?php } ?></div>
      <div class="gray-line-down">
      </div>
      <div class="row-4 w-row" level="_2">
        <div class="column-6 w-col w-col-5 w-col-small-4 w-col-tiny-4" level="_3">
          <h2 class="heading-6">Сумма заказа</h2>
        </div>
        <div class="column-5 w-col w-col-3 w-col-small-4 w-col-tiny-4" level="_3">
          <h5 wp_cart="total" class="heading-7">2 250</h5>
        </div>
        <div class="column-5 w-col w-col-4 w-col-small-4 w-col-tiny-4" level="_3">
          <a href="/checkout" class="button-3 w-button">Заказать</a>
        </div>
      </div>
    