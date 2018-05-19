<?php

  use classes\Html,
      classes\SelectionTheme as ST;

  return array (
                ST::THEME_NAME => _('Testing theme no.2'),
                //ST::THEME_LAYOUT => $layout,
                //takto:
                'sablona_menu' => Html::elem('a')//->setDepth(1)
                                      ->href('{href_link}')
                                      ->title('{name}')
                                      //->id('{conditions}')
                                      ->class('{conditions}')
                                      //->setText('{name}')
                                      ->insert(Html::elem('span')->setText('{name}'))
                                      //->insert(Html::br())
                                      //->setText('{name}')
                                      ,

                'sablona_obsahu' => Html::elem('span')
                                        ->insert(Html::elem('strong')->setText('ultra komentář: {comment}')//->appendAfter(Html::elem('br'))
                                        )
                                        ->insert(Html::elem('a')->href('{href_link}')//->setUse(Html::USE_REPEAT)
                                                                ->title('{name}')
                                                                ->insert(Html::elem('img')
                                                                              ->src('{obr_path}')
                                                                              ->title('nazev obrazku je: {name}')
                                                                        )
                                                )
                                        ->appendAfter(Html::elem('br'))
                                        //->appendAfter(Html::elem('br'))
                                        ,
                );

?>
