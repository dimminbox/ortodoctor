<?php
/*
Template name: Main
*/
?>
<!DOCTYPE html>


<html data-wf-page="5b6c14fe41c6168b576ac881" data-wf-site="5b6c14fe41c6167f1d6ac87d">

<?php get_template_part("header_block", ""); ?>

<body>
  <div data-collapse="medium" data-animation="default" data-duration="400" class="navbar w-nav">
    <div class="container w-container">
      <a href="#" class="w-nav-brand">
        <img src="<?php bloginfo('template_url'); ?>/images/5b6c1738b3323e2e10ff4e50_logo.png" width="173" alt="" />
      </a>
      <nav role="navigation" class="w-clearfix w-nav-menu">
        <a href="https://ортопедические-стельки-рязань.рф" class="nav-link w-nav-link">Главная</a>
        <a href="https://xn-----8kcnebabtebdveo1bbatspmemm6j9fh7f.xn--p1ai/#feature-page" class="nav-link w-nav-link">Преимущества</a>
        <a href="https://xn-----8kcnebabtebdveo1bbatspmemm6j9fh7f.xn--p1ai/#gallery-page" class="nav-link w-nav-link">Галерея</a>
        <a href="https://xn-----8kcnebabtebdveo1bbatspmemm6j9fh7f.xn--p1ai/#price-page" class="nav-link w-nav-link">Цены</a>
        <a href="https://xn-----8kcnebabtebdveo1bbatspmemm6j9fh7f.xn--p1ai/#contact-page" class="nav-link w-nav-link">Контакты</a>
        <div class="div-block-7 w-clearfix">
          <a href="/cart" class="button-nav w-button">Корзина</a>
          <div class="div-block-8" data-wc="cart_count"><?= WC()->cart->cart_contents_count ?></div>
        </div>
      </nav>
      <div class="w-nav-button">
        <div class="w-icon-nav-menu">
        </div>
      </div>
    </div>
  </div>
  <div class="section-stelki">
    <h1 class="heading">Ортопедические стельки</h1>
    <div class="div-block"><?php $query = new WP_Query(select_query_by_name("Стельки")); if($query->have_posts()) : ?><?php while($query->have_posts()) : $query->the_post(); ?>
<div class="div-block-2">
        <div class="div-block-11" style="background-image: url('<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(), "large"); echo $img[0]; ?>');">
        </div>
        <h3 class="product-name"><?php the_title(); ?></h3>
        <div class="div-block-3 w-clearfix">
          <div class="text-block-10 product-price">
            <?php $product = get_product(get_the_ID()); if(is_object($product)){ if( $product->get_sale_price() !== $product->get_price() ) { ?><span class="price" data-content="product_price"><?= wc_price($product->get_price()) ?></span><?php }} ?>
          </div>
          <a href="<?php the_permalink(); ?>" class="link-4 w-button">Подробнее</a>
        </div>
      </div><?php endwhile; ?><?php else : ?><?php endif; wp_reset_postdata(); ?></div>
    <h1 class="heading">Обувь детская</h1>
    <div class="div-block"><?php $query = new WP_Query(select_query_by_name("Обувь детская")); if($query->have_posts()) : ?><?php while($query->have_posts()) : $query->the_post(); ?>
<div class="div-block-2">
        <div class="div-block-11" style="background-image: url('<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(), "large"); echo $img[0]; ?>');">
        </div>
        <h3 class="product-name"><?php the_title(); ?></h3>
        <div class="div-block-3 w-clearfix">
          <?php $product = get_product(get_the_ID()); if(is_object($product)){ if( $product->get_sale_price() !== $product->get_price() ) { ?><h3 class="product-price" data-content="product_price"><?= wc_price($product->get_price()) ?></h3><?php }} ?>
          <a href="<?php the_permalink(); ?>" class="link-4 w-button">Подробнее</a>
        </div>
      </div><?php endwhile; ?><?php else : ?><?php endif; wp_reset_postdata(); ?></div>
  </div>
  <div class="section-obuv">
    <h1 class="heading">Ортопедическая обувь</h1>
    <div class="div-block-obuv"><?php $query = new WP_Query(select_query_by_name("Стельки")); if($query->have_posts()) : ?><?php while($query->have_posts()) : $query->the_post(); ?>
<div class="div-block-2">
        <img src="<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large'); echo $img[0]; ?>" width="222" alt="<?= get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true) ?>" title="<?= get_the_title(get_post_thumbnail_id()) ?>" />
        <h3 class="product-name"><?php the_title(); ?></h3>
        <div class="div-block-3 w-clearfix">
          <?php $product = get_product(get_the_ID()); if(is_object($product)){ if( $product->get_sale_price() !== $product->get_price() ) { ?><h3 class="product-price" data-content="product_price"><?= wc_price($product->get_price()) ?></h3><?php }} ?>
          <div class="form-block w-clearfix w-form">
            <form id="add_to_cart_<?= get_the_ID() ?>" name="add_to_cart" data-name="add_to_cart" class="form w-clearfix" action="/index.php" data-product-id="<?php $product = get_product(get_the_ID()); if($product->product_type === "variable"){ echo($product->get_available_variations()[0][variation_id]); } else { echo($product->id); } ?>">
              <input type="submit" value="В корзину" data-wait="Please wait..." class="link w-button" />
            </form>
            <div class="w-form-done">
              <div>Thank you! Your submission has been received!</div>
            </div>
            <div class="w-form-fail">
              <div>Oops! Something went wrong while submitting the form.</div>
            </div>
          </div>
        </div>
      </div><?php endwhile; ?><?php else : ?><?php endif; wp_reset_postdata(); ?></div>
  </div>
  <div class="footer">
    <div class="div-block-4">
    </div>
    <div class="row w-row">
      <div class="column-3 w-col w-col-4">
        <img src="<?php bloginfo('template_url'); ?>/images/5b6c1738b3323e2e10ff4e50_logo.png" alt="" />
        <div class="text-block">Ортопедические стельки в Рязани.</div>
        <div class="text-block">
          <a href="http://raketaweb.ru" target="_blank" class="link-2">Разработано в веб-студии «Ракета»</a>
        </div>
      </div>
      <div class="column-4 w-col w-col-4">
        <div class="text-block-3">Следите за нами в соцсетях</div>
        <a href="https://vk.com/ortodoctor_su" target="_blank" class="link-block-3 w-inline-block">
          <img src="<?php bloginfo('template_url'); ?>/images/5c235e66fd28a79b4dec058f_vkontakte_PNG19.png" alt="" class="image-8" />
        </a>
        <a href="https://www.facebook.com/ortodoctor.su" class="link-block-3 _2 w-inline-block">
          <img src="<?php bloginfo('template_url'); ?>/images/5c235eb21110ec62b3fd9f85_Facebook-2-512.png" alt="" class="image-9" />
        </a>
      </div>
      <div class="w-col w-col-4">
        <div class="text-block-3">Контакты</div>
        <div class="text-block-4">
          <strong>Почта</strong>: sales@ortodoctor.su</div>
        <div class="text-block-4">
          <strong>Телефон :</strong>+7-920-977-16-61</div>
      </div>
    </div>
  </div>
  
  
  
  
<?php get_template_part("footer_block", ""); ?>