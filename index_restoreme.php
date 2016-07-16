<!DOCTYPE html>
<html <?php language_attributes(); ?> >
	<head>
		<meta charset="UTF-8">
		<title><?php bloginfo(); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="robots" content="index, follow" />
		<?php wp_head(); ?>
		<link rel="icon" type="image/png" href="favicon.png" />		
		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" >		
	</head>
	<body>
		<nav class="primary-menu">
			<div class="primary-menu-icon"></div>
			<ul>
			<?php wp_list_categories(array('title_li' => '')); ?>
			<?php 
				wp_nav_menu(
					array(
						'theme_location' => 'primary-menu', 
						'container' => false
					)
				); 
			?>
			</ul>
		</nav>
		<header class="logo">
			<p class="logo"><a href="/"><?php bloginfo(); ?></a></p>
			<p class="description"><?php bloginfo('description'); ?></p>
		</header>
		<div class="content">
			<?php 
				if ( have_posts() ) 
				{
					while ( have_posts() ) 
					{
						the_post(); 
						the_content();
					}
				}
			?>
		</div>
	</body>
</html>
