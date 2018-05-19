 <DIV id="middle">

	<div id="content">
	
  			
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	
		<div class="navigation">
			
			<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
		</div>
	
		<div class="post" id="post-<?php the_ID(); ?>">
		
<?php include (TEMPLATEPATH . "/infouclankusingle.php"); ?>
	
			<div class="entrytext">
				<?php the_content('<p class="serif">čti více &raquo;</p>'); ?>
	
				<?php link_pages('<p><strong>Stránky:</strong> ', '</p>', 'number'); ?>

<?php if (class_exists('SimpleTagging')) : ?>
	<h3>Související články:</h3>


	<ul>
		<?php STP_RelatedPosts() ?>
	</ul>


<?php endif; ?>


<div align="center">
<?php if (class_exists('SimpleTagging')) : ?> 
	<ul id ="tagcloud">
		<?php STP_Tagcloud(); ?>
	</ul>
<?php endif; ?>
</div>

<?php yatcp_comments_template(); ?>
	
				<p class="postmetadata alt">
					<small>
						Tento příspěvek byl poslaný
						
						on <?php the_time('l, F jS, Y') ?> at <?php the_time() ?>
						a vyplněný pod <?php the_category(', ') ?>.
						Můžete sledovat odpovědi k tomuto příspěvku <?php comments_rss_link('RSS 2.0'); ?> feed. 
						
						<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Both Comments and Pings are open ?>
							Můžete <a href="#respond">zanechat odpověď</a>, or <a href="<?php trackback_url(true); ?>" rel="trackback">trackback</a> z vašeho umístění.
						
						<?php } elseif (!('open' == $post-> comment_status) && ('otevřít' == $post->ping_status)) {
							// Only Pings are Open ?>
							Odpovědi jsou momentálně uzavřené, ale můžete <a href="<?php trackback_url(true); ?> " rel="trackback">trackback</a> z vašeho místa.
						
						<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Comments are open, Pings are not ?>
							Můžete přeskočit nakonec a zanechat vzkaz.Zvonění není povoleno
			
						<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Neither Comments, nor Pings are open ?>
							Both comments and pings are currently closed.			
						
						<?php } edit_post_link('Editovat tento příspěvek.','',''); ?>



						
					</small>
				</p>
	
			</div>
		</div>

	
	
	<?php endwhile; else: ?>
	
		<p>Promiňte, žádná položka odpovídající Vašim požadavkům</p>
	
<?php endif; ?>
	
	</div>
		</div>
