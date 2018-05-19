<?php
  $result = array(
                  $html::nav()->id('menu')->add($index_menu),
                  $html::section()->id('content')->setHtml($index_content)
                  );
  return $result;
