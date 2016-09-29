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
		<link rel="prev" href="<?php echo get_previous_posts_page_link(); ?>" />
		<link rel="next" href="<?php echo get_next_posts_page_link(); ?>" />
	</head>
	<body id="page">
		<div class="image-viewer"><img src=""/></div>
		<div class="container">
			<header id="header">	
				<h1 class="page-title"><a href="/"><?php bloginfo(); ?></a></h1>
			</header>
			<nav id="menu" role="navigation">
				<ul id="nav">
				<?php wp_list_categories(array('title_li' => '')); ?>
				<?php 
					wp_nav_menu(
						array(
							'theme_location' => 'right-menu', 
							'container' => false
						)
					); 
				?>
				</ul>
			</nav>
			<section role="main">
				<?php 
					if ( have_posts() ) 
					{
						while ( have_posts() ) 
						{
				?><div class="article"><?php
							the_post(); 
							the_content();
				?></div><?php
						}
					}
				?>
			</section>
			<div role="navigation" id="pagination">
				<ul>
					<li class="nav-next"><a href="#">&lt;</a></li>
					<li><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li class="current"><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#">6</a></li>
					<li class="nav-previous"><a href="#">&gt;</a></li>
				</ul>
			</div>
		</div>
	</body>
</html>
