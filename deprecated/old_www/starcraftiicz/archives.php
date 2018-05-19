<?php

/*

Template Name: Archives

*/

?>



<?php get_header(); ?>

<link href="main.css" rel="stylesheet" type="text/css" />



<div id="wrapper">

<div id="content">



<?php include (TEMPLATEPATH . '/searchform.php'); ?>



<h2>Archiv měsíce:</h2>

  <ul>

    <?php wp_get_archives('type=monthly'); ?>

  </ul>



<h2>Archiv podle tématu: </h2>

  <ul>

     <?php wp_list_cats(); ?>

  </ul>



</div>	

<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>

