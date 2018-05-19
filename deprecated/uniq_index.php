<?php
  $result = $html::div()->id('obal')
                        ->add($html::header()->add(
                                                    $html::h1()->add($html::a()->href()->setText('Minecraft CZ wiki')),
                                                    $html::h2()->setText('Ceska minecraft wikipedie i o modech')
                                                  ),
                              $html::nav()->add($html::ul()->add($index_menu)),  //$sweb->getMenu($menuskel)
                              $html::div()->id('search')->add(
                                                              $html::div()->id('search_obal')->add(
                                                                                                  $html::p()->setText('V databázi se nachází %s článků', $index_pocetClanku),
                                                                                                  $index_searchform->render()
                                                                                                  )
                                                              ),
                              $html::div()->id('obsah')->add(
                                                            $html::div()->id('middle')->setHtml($index_content) //->add($sweb->getContent($maindata))
                                                            ),
                              $html::footer()->setHtml('Design by <a href="http://www.d3x.co">D3X</a> | Web power by Guuudfloumasta system <a href="'.$weburl.'admin">admin</a>')  // TODO doresit admin link
                              );
  return $result;

