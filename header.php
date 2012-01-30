<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php
	$category = get_the_category();
	if (is_home () ) { bloginfo('name'); }
	elseif ( is_category() ) { single_cat_title(); echo ' | ' ; bloginfo('name'); }
	elseif (is_single() ) { single_post_title(); echo ' | '; echo $category[0]->cat_name; }
	elseif (is_page() ) { single_post_title();}
	else { wp_title('',true); } ?> | <?php bloginfo('description'); ?></title>
<?php if ( is_tax() ) {
	$term_description = term_description(); ?>
<meta name="description" content="<?php echo $term_description; ?>">
<?php } elseif (( is_single() ) || ( is_page())) { ?>
<meta name="description" content="<?php the_excerpt(); ?>">
<?php }
	$author_id = $post->post_author;
	$author = get_userdata($author_id);
?>
<meta name="author" content="<?php echo $author->display_name; ?>">
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="Shortcut Icon" href="<?php echo get_template_directory_uri() ?>/images/favicon.ico" type="image/x-icon" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_get_archives('type=monthly&format=link'); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="row container">
		<header>
			<div class="header">
				<?php wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'topnav', 'container_id' => 'nav', 'theme_location' => 'top', 'fallback_cb' => false, 'depth' => 1 ) ); ?>
				<hgroup class="siteinfo">
					<h1><a href="<?php echo home_url() ?>" title="<?php bloginfo('title'); ?>"><?php bloginfo('title'); ?></a></h1>
				</hgroup>

			<div class="clear"></div>
				<?php wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mainnav', 'theme_location' => 'main', 'fallback_cb' => false ) ); ?>
			</div>
		</header>
		<div class="clear"></div>