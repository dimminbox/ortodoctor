<!--FOOTER CODE-->
<?php wp_footer(); ?>
<script type="text/javascript">$(document).ready(function(){$('[href*="brandjs"]').attr('style', 'display:none !important');});</script><?php if(file_exists(dirname( __FILE__ ).'/js/front.js')){ ?><script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/front.js"></script><?php } ?>
<?php if(file_exists(dirname( __FILE__ ).'/js/shop.js')){ ?><script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/shop.js"></script><?php } ?>
<?php if(function_exists('the_field')) { the_field('footer_code', 'option'); } ?>
<?php if(file_exists(dirname( __FILE__ ).'/footer_code.php')){ include_once 'footer_code.php'; } ?>
<?php if(file_exists(dirname( __FILE__ ).'/mailer.php')){ include_once 'mailer.php'; } ?>
</body>

</html>