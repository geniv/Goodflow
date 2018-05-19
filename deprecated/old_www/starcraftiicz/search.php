<?php get_header(); ?>

<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" />



<div id="wrapper">

	<div id="content">



	<?php if (have_posts()) : ?>



		<h2 class="pagetitle">Hledané výsledky</h2>

		

		<div class="navigation">

			<div class="alignleft"><?php next_posts_link('&laquo; Předešlá položka') ?></div>

			<div class="alignright"><?php previous_posts_link('Další položka &raquo;') ?></div>

		</div>





		<?php while (have_posts()) : the_post(); ?>

				

			<div class="post">

				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Trvalý odkaz na <?php the_title(); ?>"><?php the_title(); ?></a></h3>

				<small><?php the_time('l, F jS, Y') ?></small>

				

				<div class="entry">

					<?php the_content('read more &raquo;') ?>

				</div>

		

				<p class="postmetadata">Poslaný <?php the_category(', ') ?> <strong>|</strong> <?php edit_post_link('Edit','','<strong>|</strong>'); ?>  <?php comments_popup_link('Bez komentáře &#187;', '1 Komentář &#187;', '% Komentářů &#187;'); ?></p>

			</div>

	

		<?php endwhile; ?>



		<div class="navigation">

			<div class="alignleft"><?php next_posts_link('&laquo; Předešlé položky') ?></div>

			<div class="alignright"><?php previous_posts_link('Další položky &raquo;') ?></div>

		</div>

	

	<?php else : ?>



		<h2 class="center">Nenalezeno </h2>

		<?php include (TEMPLATEPATH . '/searchform.php'); ?>



	<?php endif; ?>

		

	</div>



<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>
