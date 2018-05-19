<DIV id="middle">

<div id="content">



		<?php if (have_posts()) : ?>



		 <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

<?php /* Jestli je to archiv kategorie*/ if (is_category()) { ?>				

		<h2 class="pagetitle">Archiv pro '<?php echo single_cat_title(); ?>' Category</h2>

		

 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>

		<h2 class="pagetitle">Archiv pro <?php the_time('F jS, Y'); ?></h2>

		

	 <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>

		<h2 class="pagetitle"Článek pro <?php the_time('F, Y'); ?></h2>



		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>

		<h2 class="pagetitle">Článek pro <?php the_time('Y'); ?></h2>

		

	  <?php /* If this is a search */ } elseif (is_search()) { ?>

		<h2 class="pagetitle">Hledat výsledky</h2>

		

	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>

		<h2 class="pagetitle">Autor článku</h2>



		<?php /* Jestliže je stránka archiv*/ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>

		<h2 class="pagetitle">Blog Archiv</h2>



		<?php } ?>





		<div class="navigation">

			<div class="alignleft"><?php next_posts_link('&laquo; Předešlé články') ?></div>

			<div class="alignright"><?php previous_posts_link('Další články &raquo;') ?></div>

		</div>



		<?php while (have_posts()) : the_post(); ?>

		<div class="post">



				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Trvalé spojení s <?php the_title(); ?>"><?php the_title(); ?></a></h3>
					

				<div class="entry">

					<?php the_content('read more &raquo;') ?>

				</div>

		

 
				
<?php include (TEMPLATEPATH . "/infouclanku.php"); ?>



			</div>

	

		<?php endwhile; ?>



		<div class="navigation">

			<div class="alignleft"><?php next_posts_link('&laquo; Předchozí článek') ?></div>

			<div class="alignright"><?php previous_posts_link('Další článek &raquo;') ?></div>

		</div>

	

	<?php else : ?>



		<h2 class="center">Nenalezeno</h2>

		<?php include (TEMPLATEPATH . '/searchform.php'); ?>



	<?php endif; ?>

		

	</div>
		</div>
