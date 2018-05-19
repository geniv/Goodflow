<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Dynamický mailing - zpravy",
                                              "title" => "Dynamicky mailing - zpravy",),

                                        array("main_href" => "%%1%%%%2%%",
                                              "odkaz" => "Výpis mailu",
                                              "title" => "Výpis mailu",),
                                        ),


                  "admin_permit" => array("%%1%%" => array("" => "Výpis zpráv", "addmsg" => "Přidat zprávu", "editmsg" => "Upravit zprávu", "delmsg" => "Smazat zprávu"),
                                          "%%1%%%%2%%" => array("" => "Výpis mailu", "addmail" => "Přidat mail", "editmail" => "Edit mail", "delmail" => "Smazat mail"),
                                          ),

                  "name_module" => array ("Administrace mailu",
                                          "Mailing"),


                  "normal_odhlaseni" => "Váš email: <strong>%%1%%</strong> byl odebrán.",


                  "normal_na_strankach" => "



              <form method=\"post\" action=\"\">
                <fieldset>
                  <label id=\"form_email\">
                    <input type=\"text\" name=\"%%1%%\" value=\"\" />
                  </label>
                  <label id=\"form_submit\">
                    <input type=\"submit\" name=\"%%2%%\" value=\"&nbsp;\" />
                  </label>
                </fieldset>
              </form>

",

                  "normal_na_strankach_pridano" => "Úspěšně přidáno",

                  "normal_na_strankach_duplicita" => "Duplicitní email",

                  "normal_na_strankach_header" => "from: info@mladipodnikatele.cz\r\nContent-type: text/html; charset=UTF-8",

                  "normal_na_strankach_predmet" => "Newsletter mladipodnikatele.cz",

                  "normal_na_strankach_email" => "
Dobrý den,
<br />
zažádal jste o odběr newsletteru na portálu mladipodnikatele.cz
<br /><br />
V případě, že jste o odběr nezažádal, nebo ho chcete zrušit, klikněte na následující odkaz:<br /><br />
<a href=\"%%2%%\">%%2%%</a>

                  ",



                  "normal_na_registraci" => "Duplicitní email",












                  "normal_cron_email_header" => "from: info@mladipodnikatele.cz\r\nContent-type: text/html; charset=UTF-8",

                  "normal_cron_email" => "
%%1%%
<br /><br /><br /><br />
V případě, že jste o odběr nezažádal, nebo ho chcete zrušit, klikněte na následující odkaz:<br />
<a href=\"%%2%%\">%%2%%</a>
<br />
                  ",














                  "admin_obsah" => "
<div class=\"obal_dynrss\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Dynamický mailing - Přehled zpráv</h3>
  </div>
  <a href=\"%%1%%\" title=\"Přidat zprávu\" class=\"addmsg tlacitko-2 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Přidat zprávu</span>
  </a>
  <div class=\"cl-b\">
    %%2%%
  </div>
</div>\n",

                  "admin_email" => "
<div class=\"obal_dynrss\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Dynamický mailing - Přehled emailu</h3>
  </div>
  <a href=\"%%1%%\" title=\"Přidat email\" class=\"addmail tlacitko-2 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Přidat ručně email</span>
  </a>
  <div class=\"cl-b\">
    %%2%%
  </div>
</div>\n",


                  "admin_addeditmsg_add" => "Přidat zprávu",

                  "admin_addeditmsg_edit" => "Upravit zprávu",

                  "admin_addeditmsg" => "

<script type=\"text/javascript\" src=\"%%2%%/script/tiny_mce/jquery.tinymce.js\"></script>


<div class=\"obal_dyncron\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%1%%</h3>
  </div>
  <a href=\"%%6%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Předmět:</span>
        <input type=\"text\" name=\"predmet\" value=\"%%3%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>


      <script type=\"text/javascript\">
        $(document).ready(function(){
          $('.tinykurva').tinymce({
            // Location of TinyMCE script
            script_url : '%%2%%/script/tiny_mce/tiny_mce.js',

            language : 'cs',

            // General options
            theme : \"advanced\",
            plugins : \"pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist\",


            // Theme options
            theme_advanced_buttons1 : \"newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect\",
            theme_advanced_buttons2 : \"cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,insertdate,inserttime,preview,|,forecolor,backcolor\",
            theme_advanced_buttons3 : \"tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen\",
            theme_advanced_buttons4 : \"insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak\",
            theme_advanced_toolbar_location : \"top\",
            theme_advanced_toolbar_align : \"left\",
            theme_advanced_statusbar_location : \"bottom\",
            theme_advanced_resizing : true,

            // Example content CSS (should be your site CSS)
            //content_css : \"css/content.css\",

            // Drop lists for link/image/media/template dialogs
            template_external_list_url : \"lists/template_list.js\",
            external_link_list_url : \"lists/link_list.js\",
            external_image_list_url : \"lists/image_list.js\",
            media_external_list_url : \"lists/media_list.js\",

            // Replace values for the template plugin
            template_replace_values : {
              username : \"Some User\",
              staffid : \"991234\"
            }
          });
        });
      </script>
      <div class=\"f-wysiwyg-povinny\">
        <span class=\"nazev-elementu\">Zpráva:</span>
        <textarea name=\"zprava\" rows=\"20\" cols=\"60\" class=\"tinykurva\">%%4%%</textarea>
        <span class=\"popis-elementu block ow-h\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </div>







      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"aktivni\"%%5%% />
        <span class=\"nazev-elementu\">Zařadit do fronty k odeslání.</span>
        <span class=\"popis-elementu block ow-h cl-b\">Odesílá se hromadně každý den v 01:00 ráno.</span>
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"%%1%%\" class=\"wymupdate\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_vypis_tvar_datum" => "d.m.Y / H:i:s",

                  "admin_vypis_obsah_edit" => "<a href=\"%%1%%\" class=\"editmsg block fl-l m-r-5 m-l-5 no-u odkaz-4\" title=\"Upravit zprávu\">Upravit zprávu</a>",

                  "admin_vypis_obsah" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\">
  <li class=\"nadpis-2 f-s-16 p-t-6 p-r-5 p-b-6 p-l-10 ow-h\"><span class=\"fl-l\">%%1%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%8%%<a href=\"%%9%%\" title=\"Opravdu chceš smazat zprávu: &quot;%%1%%&quot; ?\" class=\"delmsg confirm block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat zprávu</a></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">%%2%%</span><span class=\"fl-r barva-5\"><!-- --></span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Zámek:</span><span class=\"fl-r barva-5\"><input type=\"checkbox\" disabled=\"disabled\"%%6%% class=\"block m-t-2\" /></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Aktivní:</span><span class=\"fl-r barva-5\"><input type=\"checkbox\" disabled=\"disabled\"%%7%% class=\"block m-t-2\" /></span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Datum / čas vytvoření:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Datum / čas upravení:</span><span class=\"fl-r barva-5\">%%4%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Datum / čas odeslání:</span><span class=\"fl-r barva-5\">%%5%%</span></li>
</ul>\n",

                  "admin_vypis_obsah_null" => "<div class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro cl-b\">žádná zpráva</div>",



                  "admin_addeditmail_add" => "Přidat email",

                  "admin_addeditmail_edit" => "Upravit email",

                  "admin_addeditmail" => "
<div class=\"obal_dyncron\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%1%%</h3>
  </div>
  <a href=\"%%3%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Email:</span>
        <input type=\"text\" name=\"email\" value=\"%%2%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"%%1%%\" />
      </label>
    </fieldset>
  </form>
</div>\n",


                  "admin_vypis_email_tvar_datum" => "d.m.Y / H:i:s",

                  "admin_vypis_email" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\">
  <li class=\"nadpis-2 f-s-16 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"fl-l\">%%1%%</span><span class=\"fl-r\"><span class=\"block fl-r f-s-14 m-t-1 ow-h\"><a href=\"%%6%%\" class=\"editmail block fl-l m-r-5 m-l-5 no-u odkaz-4\" title=\"Upravit email\">Upravit email</a><a href=\"%%7%%\" title=\"Opravdu chceš smazat email: &quot;%%1%%&quot; ?\" class=\"delmail confirm block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat email</a></span></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Datum / čas přidání:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Datum / čas upraveni:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">IP serveru:</span><span class=\"fl-r barva-5\">%%4%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">typ registrace:</span><span class=\"fl-r barva-5\">%%5%%</span></li>
</ul>\n",

                  "admin_vypis_email_null" => "žádný email",

                  "name_typ" => array("dir" => "příme vložení",
                                      "web" => "vložení přes pole na stránkách",
                                      "reg" => "vložení při registraci",
                                      ),


                  );

  return $result;
?>
