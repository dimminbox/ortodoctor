<head>
  <meta charset="utf-8" />
  <title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo( 'name' ); ?></title>
  <meta content="Main" property="og:title" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  
  
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">
  WebFont.load({  google: {    families: ["Montserrat:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic","Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic"]  }});
  </script>
  
  <script type="text/javascript">
  !function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);
  </script>
  <link href="<?php bloginfo('template_url'); ?>/images/5b7187d43d9b84d85e72b599_fav-32.png" rel="shortcut icon" type="image/x-icon" />
  <link href="<?php bloginfo('template_url'); ?>/images/5b7187d9681f8985adb672ac_fav-256.png" rel="apple-touch-icon" />
  
  <meta name="author" content="wtw">
  
<?php wp_head(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/main.css?ver=1545809660">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/style.css">
<?php if(function_exists('the_field')) { the_field('head_code', 'option'); } ?>
<?php if(file_exists(dirname( __FILE__ ).'/header_code.php')){ include_once 'header_code.php'; } ?>
</head>