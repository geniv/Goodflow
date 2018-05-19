<?php
/*
 *      index_unique.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  return array (
                'main_index' => "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta http-equiv=\"Content-Language\" content=\"cs\" />
    <meta name=\"author\" content=\"GoodFlow design - Tvorba webových stránek a systémů (www.gfdesign.cz)\" />
    <meta name=\"copyright\" content=\"Created by GoodFlow design\" />
    <meta name=\"description\" content=\"%%description%%\" />
    <meta name=\"robots\" content=\"%%robots%%\" />
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/global_styles.css\" media=\"screen\" title=\"\" />

    <!--[if IE]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_ie.css\" media=\"screen\" />
    <![endif]-->
    <!--[if IE 7]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_ie7.css\" media=\"screen\" />
    <![endif]-->

    <title>%%title_galery%% - %%title%%</title>
    <!-- <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" /> -->

    <script type=\"text/javascript\" src=\"%%absolutni_url%%/script/jquery/jquery-1.6.min.js\"></script>

  </head>
  <body>
    <div id=\"obal_layout\">
      <div id=\"obal_sekce\">
        <h1><a href=\"%%absolutni_url%%\">%%title_galery%% - %%title%%</a></h1>
        <div id=\"obal\">
          <div id=\"menu\">
            %%menu%%
          </div>
          %%jazyk%%
          <div id=\"vypis\">
            %%obsah%%
          </div>

%%login_form%%

%%login_exception%%
        </div>
        %%end_time%%
      </div>
    </div>
  </body>
</html>",

                'main_admin_index' => "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta http-equiv=\"Content-Language\" content=\"cs\" />
    <meta name=\"author\" content=\"GoodFlow design - Tvorba webových stránek a systémů (www.gfdesign.cz)\" />
    <meta name=\"copyright\" content=\"Created by GoodFlow design\" />
    <meta name=\"description\" content=\"%%description%%\" />
    <meta name=\"robots\" content=\"noindex, nofollow\" />
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/admin_global_styles.css\" media=\"screen\" title=\"\" />

    <!--[if IE]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/admin_styles_ie.css\" media=\"screen\" />
    <![endif]-->
    <!--[if IE 7]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/admin_styles_ie7.css\" media=\"screen\" />
    <![endif]-->

    <title>%%title_galery%% - %%title%%</title>
    <!-- <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" /> -->

    <script type=\"text/javascript\" src=\"%%absolutni_url%%/script/jquery/jquery-1.6.min.js\"></script>
    <script type=\"text/javascript\" src=\"%%absolutni_url%%/script/jquery/jquery-ui-1.8.12.custom.min.js\"></script>
    <script type=\"text/javascript\" src=\"%%absolutni_url%%/script/jquery.supersized/supersized.3.1.3.core.min.js\"></script>

    <script type=\"text/javascript\">
      jQuery(function($){
        $.supersized({
          //Background image
          slides	:  [ { image : '%%absolutni_url%%images/body_small.png' } ]					
        });
      });
    </script>

  </head>
  <body>





    <div id=\"wrap_layout\">
      <div id=\"wrap_header\">
        <div id=\"header\">
          <a href=\"%%absolutni_url%%\" title=\"%%title_galery%%\" id=\"logo\"><!-- --></a>
          <div id=\"stripe_top\">%%logout_form%%</div>
          <div id=\"navigation\">
            %%admin_menu%%
          </div>
          <div id=\"wrap_title\">
            <h1>%%title%%<!-- --></h1>
          </div>
        </div>
      </div>







      <div id=\"obal_sekce\">

        <div id=\"obal\">

          %%jazyk%%
          <div id=\"vypis\">
%%admin_content%%
          </div>


        </div>
        %%end_time%%
      </div>
    </div>
  </body>
</html>",

/*
                'main_admin_content' => array('' => array('' => 'hlavni obsah navigace a vypis',
                                                          'add' => 'přidávání něčeho neznámého'),
                                              'authors' => array('' => 'hlavni vypis autoru'),
                                              'dir' => array('' => 'hlavni vypis slozek'),
                                              'file' => array('' => 'hlavni vypis souboru'),
                                              'set' => array('' => 'hlavni vypis nastaveni'),
                                              ),
*/

                );

?>
