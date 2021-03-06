<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="<?php echo nt_get_option('appearance', 'direction', 'ltr'); ?>">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width,initial-scale=1">

<link rel="profile" href="http://gmpg.org/xfn/11" />

<?php wp_head(); ?>

<style type="text/css" media="all">
body{background-image:none!important;}
section.comments, .poly_kh, .poly_jp {
    display: none!important;
}
@media screen and (max-width:1024px) {
.vc_tta-tabs .vc_tta-tabs-list li a {
    padding: 10px 12px!important;
}
.sticky-element-original{background: #fff;}
.hero{display:none!important;}
}

@media screen and (min-width:1024px) {
.rangeSlider {
    padding: 20px 6px 0px 0!important;
}
.sidebar .section{border-left: solid 1px #efefef;padding-left: 40px;}
.element-round .tooltip{width: 120px;text-align: center;}
.type-flag img{width:26px!important;}
.property-search-box {
    background: #fff!important;
    box-shadow:0 2px 6px 0 rgba(50, 50, 50, 0.18)!important;
}
.scroll-back-to-top-wrapper.show{display:none!important;}
}

.property-search-form label, .property-search-form small span{color:#000!important;}
.header-wrap .header-top .nav-language.type-flag li{opacity: 0.7;-webkit-filter: none!important;}
li.active{opacity:1!important;}

.TK{display:none!important;}

.menu-item-2344 a:hover:{color:#fff!important;}

body, div, h1, hd2, h3, h4, span.primary-nav{font-family: Verdana, Arial, battambang,
   sans-serif;}

ul.sub-menu a:hover, .primary-nav a:hover{color:#0695de;}

.section-blog article{    
border-bottom: solid 1px #e2e2e2;
padding-bottom: 20px;
}
.post-title{font-size:24px!important;}
</style>

</head>

<body <?php body_class(); ?> id="body">

<?php 
	$header_line_height = '';
	if( nt_get_option('header', 'logo') ) {
		$logo = wp_get_attachment_image_src(nt_get_option('header', 'logo'), 'full');
		$logo_height = $logo[2]/2;
		$header_line_height = $logo_height.'px';
	}

	$header_height = intval(nt_get_option('header', 'height', 100));
	$header_type = nt_get_option('header', 'header_type');

?>


<div class="layout-wrap <?php echo nt_get_option('appearance', 'site_layout'); ?>"><div class="layout-inner">
<header class="header-wrap sticky-<?php echo nt_get_option('header', 'sticky', 'on'); ?> <?php echo nt_get_option('header', 'element_style', 'element-dark') ?> <?php echo esc_attr($header_type); ?>" >

<?php if(nt_get_option('header', 'show_topbar', 'on') == 'on'): ?>
<div class="header-top">
<div class="row">
	<div class="large-6 medium-12 columns left">
		<?php echo nt_get_option('header', 'announce_text', ''); ?>
	</div>
	<div class="large-6 medium-12 columns right">
		
		<?php if(nt_get_option('header', 'show_login', 'on') == 'on') get_template_part('section/section', 'user-menu'); ?>
		
		<?php if(function_exists('icl_get_languages') && nt_get_option('header', 'show_wpml', 'on') == 'on') get_template_part('section/section', 'wpml-menu'); ?>
		
		<?php if(is_array(nt_get_option('header', 'social_items'))): ?>
		<ul class="menu social">
		<?php foreach( nt_get_option('header', 'social_items') as $link ): ?>
		<li><a href="<?php echo esc_url($link['stack_title']); ?>"><?php echo do_shortcode('[nt_icon id="'.$link['icon'].'"]'); ?></a></li>
		<?php endforeach; ?>
		</ul>
		<?php endif; ?>

		<?php if(nt_get_option('header', 'show_search', 'on') == 'on'): ?>
			<i class="flaticon-zoom22 search-button"></i> 
		<?php endif; ?>
	
	</div>
</div>
</div>
<?php endif; ?>

<div class="header-main" style="height: <?php echo intval($header_height); ?>px;">
<div class="row">
<div class="columns">
	
	<?php if($header_type == 'logo-center'): ?>
	<nav class="primary-nav" id="primary-nav-left" style="line-height: <?php echo intval($header_height); ?>px;">
	<?php wp_nav_menu( array( 'theme_location' => 'primary-left', 'container' => false, 'container_class' => false, 'menu_id' => false, 'fallback_cb' => '', 'depth' => 0  ) ); ?>
	</nav>
	<?php endif; ?>
	<?php if(nt_get_option('header', 'logo')): ?>
	<div class="branding" style="height: <?php echo intval($header_height); ?>px;">
	<?php else: ?>
	<div class="branding text" style="height: <?php echo intval($header_height); ?>px; line-height: <?php echo intval($header_height); ?>px;">
	<?php endif; ?>
		<a href="<?php echo home_url(); ?>">
		<span class="helper"></span>
		<?php 
			if( nt_get_option('header', 'logo') ){
				$logo = wp_get_attachment_image_src(nt_get_option('header', 'logo'), 'full');
				echo '<img src="'.$logo[0].'" alt="'.get_bloginfo('name').'" width="'.$logo[1].'" height="'.$logo[2].'"  />';
			} else {
				bloginfo('name');
			}
		?></a>
		<div class="menu-toggle"><i class="menu flaticon-list26"></i><i class="close flaticon-cross37"></i></div>
	</div>

	<?php if($header_type == 'logo-center'): ?>
	<nav class="primary-nav" id="primary-nav-right" style="line-height: <?php echo intval($header_height); ?>px;">
	<?php wp_nav_menu( array( 'theme_location' => 'primary-right', 'container' => false, 'container_class' => false, 'menu_id' => false, 'fallback_cb' => '', 'depth' => 0  ) ); ?>
	</nav>
	<?php else: ?>
	<nav class="primary-nav" style="line-height: <?php echo intval($header_height); ?>px;">
	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'container_class' => false, 'menu_id' => false, 'fallback_cb' => '', 'depth' => 0  ) ); ?>
	</nav>
	<?php endif; ?>
	
</div>
</div>
</div>
<div class="header-bg"></div>
</header>


<div class="mobile-menu">
	<nav>
	<?php if(nt_get_option('header', 'header_type') == 'logo-center') {
			wp_nav_menu( array( 'theme_location' => 'primary-left', 'container' => false, 'container_class' => false, 'menu_id' => false, 'fallback_cb' => '', 'depth' => 0  ) );
			wp_nav_menu( array( 'theme_location' => 'primary-right', 'container' => false, 'container_class' => false, 'menu_id' => false, 'fallback_cb' => '', 'depth' => 0  ) );
		} else {
			wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'container_class' => false, 'menu_id' => false, 'fallback_cb' => '', 'depth' => 0  ) );
		}
	?>
	</nav>

	<?php if(nt_get_option('header', 'show_topbar', 'on') == 'on'): ?>

		<?php wp_nav_menu( array( 'theme_location' => 'top-right', 'container' => 'nav', 'container_class' => false, 'menu_id' => false, 'fallback_cb' => '', 'depth' => 1  ) ); ?>

		<?php if(function_exists('icl_get_languages') && nt_get_option('header', 'show_wpml', 'on') == 'on'): ?>
			<nav><?php get_template_part('section/section', 'wpml-menu'); ?></nav>
		<?php endif; ?>

		<?php if(is_array(nt_get_option('header', 'social_items'))): ?>
		<nav>
		<ul class="menu social-menu">
		<?php foreach( nt_get_option('header', 'social_items') as $link ): ?>
		<li><a href="<?php echo esc_url($link['stack_title']); ?>"><?php //echo $link['stack_title']; ?> <?php echo do_shortcode('[nt_icon id="'.$link['icon'].'"]'); ?></a></li>
		<?php endforeach; ?>
		</ul>
		</nav>
		<?php endif; ?>

		<?php if(nt_get_option('header', 'show_search', 'on') == 'on'): ?>
		<nav>
		<form method="get" class="nt-search-form" action="<?php echo home_url(); ?>">
			<input type="text" id="search-text" class="input-text" name="s" placeholder="<?php _e('Search &#8230;', 'theme_front');?>" autocomplete="off" />
		</form>
		</nav>
		<?php endif; ?>

		<?php if(nt_get_option('header', 'show_login', 'on') == 'on'): ?>
			<?php if(is_user_logged_in()): ?>
				<nav><?php get_template_part('section/section', 'user-menu'); ?></nav>
			<?php endif; ?>

			<?php if(!is_user_logged_in()) get_template_part('section/section', 'login-register'); ?>
		<?php endif; ?>




	<?php endif; ?>
</div>

<?php if(nt_get_option('header', 'show_search', 'on') == 'on') get_template_part('section/section', 'search'); ?>
<?php get_template_part('section/section', 'title'); ?>
<?php get_template_part('section/section', 'hero'); ?>
