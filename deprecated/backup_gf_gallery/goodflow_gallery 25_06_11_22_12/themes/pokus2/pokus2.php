<?php

  use classes\Html,
      classes\SelectionTheme;

  $name = _('Testing theme no.2');

  $layout = Html::elem('div');

  return array (
                SelectionTheme::THEME_NAME => $name,
                SelectionTheme::THEME_LAYOUT => $layout,
                );

?>
