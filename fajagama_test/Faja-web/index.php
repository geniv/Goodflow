<?php
require 'loader.php'; //load autoload

use 
  classes\html,
  classes\HtmlPage,
  classes\Core,
  classes\Route,
  classes\LightHtml,
  classes\LightHtml as lh, //vytvori alias k tride
  classes\LightStaticWeb;
  
if (Core::checkPHP()) {  
  //~ echo LightHtml::span()->setText('Zdar Geniv'); span s textem ....  
  
  //~ echo LightHtml::link()->href('style.css'); pripojeni stylu
  
  LightHtml::setbreakdepth(true); // zalomuje tagy pro lepsi prehlednost
  
  /*$weburl = Core::getUrl();
  $page = new HtmlPage(HtmlPage::DOCTYPE_HTML5);
  $page->setLanguage('cs')
    ->setUrlPage($weburl)
	->addMeta('author', 'Fajagama amatersky PHP nadsenec')
	->addMeta('copyright', 'Create by Geniv')
	->addMeta('description', 'Zvejka')
	->setTitle('TEST WEB');*/
	
	
	
  $html = LightHtml::html()
					->add(array(LightHtml::head()
										->add(LightHtml::link()->href('style.css')),
								LightHtml::body() 
										 ->add(array(LightHtml::header(),
													 lighthtml::nav(),
													 LightHtml::section()
															  ->add(LightHtml::article()),
													 LightHtml::footer()
													)
											 )
								)
						 );
						 
						 
	$html2 = lh::html()
				->add(array
						(lh::head()
							->add(	lh::link()->href('style.css')->rel('stylesheet')->type('text/css')),
						lh::body()
							->add(array
									(lh::div()->id('wrapper')
										->add(array	
												(lh::div()->id('header')
													->add(lh::div()->id('logo')
															->add(array(
																	lh::h1()
																		->add(lh::a()->href('#')->settext('nightvision')),
																	lh::p()
																		->add(lh::span()->settext('By Free CSS Templates'))
																		)
																)
														),
												lh::div()->id('menu')
													->add(lh::ul()
														->add(lh::li()->class('current_page_item')
															->add(lh::a()->href('#')->settext('HOME'))
															)
														->add(lh::li()
															->add(lh::a()->href('#')->settext('BLOG'))
															)
														->add(lh::li()
															->add(lh::a()->href('#')->settext('PHOTO'))
															)
														->add(lh::li()
															->add(lh::a()->href('#')->settext('ABOUT'))
															)
														->add(lh::li()
															->add(lh::a()->href('#')->settext('CONTACT'))
															)			
														),															
												lh::div()->id('page')
													->add(array
															(lh::div()->id('ads')
																->add(lh::a()->href('#')
																	->add(lh::img()->height('600')->width('160')->alt('')->src('images/ad160x600.gif'))
																	),
															lh::div()->id('conten')
															)
														),
												lh::div()->id('sidebar')
												)
											 ),
									lh::div()->id('footer')
														
									)
								)
						)
					);
	
	
	
	
  echo $html2;

  
  
	}

?>
