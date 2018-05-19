<DIV id="right_menu">
<DIV id="content_box_top"></DIV>
<DIV id="content_box_middle">

<!-- Začátek ankety -->

<STRONG>Anketa pro Vás</STRONG>
<br><br>
<?php if (function_exists('vote_poll') && !in_pollarchive()): ?>
   <ul>
      <?php get_poll();?>
   </ul>
   <?php display_polls_archive_link(); ?>
<?php endif; ?>	
</DIV>

<!-- Konec ankety -->

<DIV id="content_box_bottom"></DIV>

<UL>
<LI class="the_title">Stránky</LI>

  <div id="el1" class="collapsible">
<!-- Start -->
<?php wp_list_pages('title_li' ); ?>

<LI class="the_title">Archiv za měsíc</LI>
<?php wp_get_archives('type=monthly'); ?>
  </div>
  <!-- End -->
</UL>
</DIV>
