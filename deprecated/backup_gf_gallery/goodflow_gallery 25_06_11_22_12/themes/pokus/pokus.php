<?php

  use classes\Html,
      classes\SelectionTheme;

  $name = _('Testing theme no.1');

  $layout = Html::elem('div');

  //bude se nastavovat: css (array) + i podminkove, js (array), body ..pod

  return array (
                SelectionTheme::THEME_NAME => $name,
                SelectionTheme::THEME_LAYOUT => $layout,
                );

?>
