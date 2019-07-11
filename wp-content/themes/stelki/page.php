<?php
/*
Template name: Page
*/
?>
<!DOCTYPE html>


<html data-wf-page="5b717f5ab3323eedef0328e1" data-wf-site="5b6c14fe41c6167f1d6ac87d">

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
  <div>
    <div class="container-2 w-container" data-content="post"><?php if(have_posts()) : ?><?php while (have_posts()) : the_post(); ?>
      <h1>Оформление заказа</h1>
      <div><?php the_content(); ?></div>
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