<?php
/*
Template name: Product
*/
?>
<!DOCTYPE html>


<html data-wf-page="5b6c28f0b3323e5dd6ff6606" data-wf-site="5b6c14fe41c6167f1d6ac87d">

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
          <div class="div-block-8">
            <div class="text-block-7">1</div>
          </div>
        </div>
      </nav>
      <div class="w-nav-button">
        <div class="w-icon-nav-menu">
        </div>
      </div>
    </div>
  </div>
  <div class="section-stelki-copy">
    <div class="div-block" data-content="post"><?php if(have_posts()) : ?><?php while (have_posts()) : the_post(); ?>
      <div class="product-bg-photo" style="background-image: url('<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(), "large"); echo $img[0]; ?>');">
      </div>
      <div class="div-single-product-wrapper">
        <h1 class="product-name-card"><?php the_title(); ?></h1>
        <div class="text-block-5">
          <span class="text-span">Размеры:</span>
          <span class="razmer"><?= get_field('razmer') ?></span>
        </div>
        <div class="text-block-5">
          <span class="text-span-2">Назначение:</span>
          <span class="naznachenie"><?= get_field('naznachenie') ?></span>
        </div>
        <div class="text-block-5">
          <span class="text-span-3">Преимущества:</span>
          <span class="advantages"><?= get_field('preimuschestva') ?></span>
        </div>
        <div class="text-description"><?php the_content(); ?></div>
        <div class="text-description _2"><?php the_excerpt(); ?></div>
        <div class="woocommerce-form-coupon-toggle">
        </div>
        <div class="div-block-6 w-clearfix">
          <div class="text-block-6">4990 руб</div>
          <div class="form-block w-form">
            <form id="email-form" name="email-form" data-name="Email Form" class="form">
              <input type="submit" value="Добавить в корзину" data-wait="Please wait..." class="add-to-cart w-button" />
            </form>
            <div class="success-message w-form-done">
              <div class="text-block-9">Thank you! Your submission has been received!</div>
            </div>
            <div class="error-message w-form-fail">
              <div>Oops! Something went wrong while submitting the form.</div>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile; ?><?php endif; ?></div>
  </div>
  <div class="footer">
    <div class="div-block-4">
    </div>
    <div class="row w-row">
      <div class="column-3 w-col w-col-6">
        <img src="<?php bloginfo('template_url'); ?>/images/5b6c1738b3323e2e10ff4e50_logo.png" alt="" />
        <div class="text-block">Ортопедические стельки в Рязани.</div>
        <div class="text-block">
          <a href="http://разработка-сайтов-рязань.рф" target="_blank" class="link-2">Разработано в веб-студии &quot;Ракета&quot;.</a>
        </div>
      </div>
      <div class="column-4 w-col w-col-6">
        <div class="text-block-3">Контакты</div>
        <div class="text-block-4">
          <strong>Почта</strong>: sales@ortodoctor.su</div>
        <div class="text-block-4">
          <strong>Телефон :</strong>+7-920-977-16-61</div>
      </div>
    </div>
  </div>
  
  
  
  
<?php get_template_part("footer_block", ""); ?>