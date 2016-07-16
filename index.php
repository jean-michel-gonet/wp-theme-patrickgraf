<!DOCTYPE html>
<html id="doc" class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php bloginfo(); ?></title>
		<script type="text/javascript">
			var doc = document.getElementById('doc');
			doc.removeAttribute('class', 'no-js');
			doc.setAttribute('class', 'js');
		</script>
		<meta name="robots" content="index, follow" />
		<?php wp_head(); ?>
		<link rel="icon" type="image/png" href="favicon.png" />		
		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" >		
	</head>
	<body id="page">
		<div class="container">
			<header class="logo">
				<p class="logo"><a href="/"><?php bloginfo(); ?></a></p>
				<p class="description"><?php bloginfo('description'); ?></p>
			</header>
			<nav class="off-canvas-navigation">
				<ul>
					<li class="menu-item"><a class='menu-button' href="#menu">Menu</a></li>			
					<li class="sidebar-item"><a class='sidebar-button' href="#sidebar">Extra</a></li>
				</ul>
			</nav>			
			<nav id="menu" role="navigation">
				<ul id="nav">
				<?php wp_list_categories(array('title_li' => '')); ?>
				</ul>
			</nav>
			<section role="main">
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
			</section>
			<section id="sidebar" role="complementary">
				<aside>
					<ul>
						<?php 
							wp_nav_menu(
								array(
									'theme_location' => 'right-menu', 
									'container' => false
								)
							); 
						?>
					</ul>
				</aside>
			</section>
			<footer class="site-footer" role="contentinfo">
				<ul>
					<li>Design by <a href="http://wernerarnold.name">Werner Arnold</a></li>
					<li>Code by <a href="http://jeanmichelgonet.name">Jean-Michel Gonet</a></li>
				</ul>	
			</footer>		

		</div>
	</body>
</html>
