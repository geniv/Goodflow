<?php

  use classes\Html,
      classes\SelectionTheme as ST;

  $name = _('Testing theme no.1');

  $layout = Html::elem('div');

  //bude se nastavovat: css (array) + i podminkove, js (array), body ..pod

  return array (
                ST::THEME_NAME => $name,
                ST::THEME_LAYOUT => $layout,
                );

?>
