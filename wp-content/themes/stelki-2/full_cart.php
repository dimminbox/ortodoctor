
      <div class="row-cart-products" level="_2"><?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) { ?><div class="row-2 w-row" level="_3">
          <div class="column-5 w-col w-col-2 w-col-small-2 w-col-tiny-2" level="_4">
            <div class="div-block-9">
              <img src="<?= $cart_item['variation_id'] == 0 || !get_the_post_thumbnail_url($cart_item['variation_id'], 'thumbnail')? get_the_post_thumbnail_url($cart_item['product_id'], 'thumbnail') : get_the_post_thumbnail_url($cart_item['variation_id'], 'thumbnail') ?>" wp_cart="product_image" alt="" class="image-7" />
            </div>
          </div>
          <div class="column-product-name w-col w-col-4 w-col-small-4 w-col-tiny-4" level="_4">
            <h3 wp_cart="product_title" class="heading-4"><?php $_product = $cart_item['data']; echo($_product->get_title()); ?></h3>
          </div>
          <div class="column-5 w-col w-col-2 w-col-small-2 w-col-tiny-2" level="_4">
            <a href="#" class="link-block w-inline-block" data-action="cart_qty_minus" level="_5">
              <div class="minus-busket w-hidden-tiny">-</div>
            </a>
            <input class="busket-qty" name="qty" data-name="qty" data-action="cart_product_qty" value="<?= $cart_item['quantity'] ?>" type="text" data-product-id="<?= $cart_item['variation_id'] == 0 ? $cart_item['product_id'] : $cart_item['variation_id'] ?>"></input>
            <a href="#" class="link-block-2 w-inline-block" data-action="cart_qty_plus" level="_5">
              <div class="plus-busket w-hidden-tiny">+</div>
            </a>
          </div>
          <div class="column-5 w-col w-col-3 w-col-small-3 w-col-tiny-3" level="_4">
            <h5 wp_cart="product_price" class="heading-5"><?php $_product = $cart_item['data']; echo(WC()->cart->get_product_price( $_product )); ?></h5>
          </div>
          <div class="column-5 w-col w-col-1 w-col-small-1 w-col-tiny-1" level="_4">
            <a href="#" class="link-block w-inline-block" data-product-id="<?= $cart_item['variation_id'] == 0 ? $cart_item['product_id'] : $cart_item['variation_id'] ?>" data-action="cart_product_remove" level="_5">
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
          <h5 wp_cart="total" class="heading-7"><?= WC()->cart->get_cart_total() ?></h5>
        </div>
        <div class="column-5 w-col w-col-4 w-col-small-4 w-col-tiny-4" level="_3">
          <a href="/checkout" class="button-3 w-button">Заказать</a>
        </div>
      </div>
    