<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Registrace",
                                              "title" => "Registrace"),

                                        array("main_href" => "%%1%%%%2%%",
                                              "odkaz" => "Statistiky",
                                              "title" => "Statistiky"),

                                        array("main_href" => "%%1%%%%3%%",
                                              "odkaz" => "Přehled uživatelů",
                                              "title" => "Přehled uživatelů"),
                                        ),

                  "admin_permit" => array("%%1%%" => array("" => "Konfigurace"),
                                          "%%1%%%%2%%" => array("" => "Statistiky"),
                                          "%%1%%%%3%%" => array("" => "Přehled uživatelů", "infouser" => "Informace o uživateli", "edituser" => "Upravit uživatele", "deluser" => "Smazat uživatele"),
                                        ),

                  "name_module" => array ("Administrace registrace",
                                          "Registrace"),




                  "normal_def_form" => array ("jmeno" => array("name" => "Jméno", "typ" => "text", "value" => "", "moznosti" => array(), "show" => array("registr", "profil"), "povinne" => true, "fpovinne" => "", "class" => ""),
                                              "prijmeni" => array("name" => "Příjmení", "typ" => "text", "value" => "", "moznosti" => array(), "show" => array("registr", "profil"), "povinne" => true, "fpovinne" => "", "class" => ""),
                                              "vek" => array("name" => "Věk", "typ" => "select", "value" => "17 let", "moznosti" => array("15 let", "16 let", "17 let", "18 let", "19 let", "20 let", "21 let", "22 let", "23 let", "24 let", "25 let", "26 let", "27 let", "28 let", "29 let", "30 let", "mrtvola"), "show" => array("registr", "profil"), "povinne" => true, "fpovinne" => "", "class" => ""),
                                              "vzdelani" => array("name" => "Dosažené vzdělání", "typ" => "text", "value" => "", "moznosti" => array(), "show" => array("registr", "profil"), "povinne" => true, "fpovinne" => "", "class" => ""),
                                              "telefon" => array("name" => "Telefon", "typ" => "text", "value" => "", "moznosti" => array(), "show" => array("registr", "profil"), "povinne" => true, "fpovinne" => "", "class" => ""),
                                              //"mail" => array("name" => "Mail", "typ" => "text", "value" => "", "moznosti" => array(), "show" => array("registr", "profil"), "povinne" => true, "fpovinne" => "", "class" => ""),
                                              "nabidka" => array("name" => "Co mohu nabídnout", "typ" => "textarea", "value" => "", "moznosti" => array(), "show" => array("registr", "profil"), "povinne" => true, "fpovinne" => "", "class" => ""),
                                              "osobe" => array("name" => "Napište nám ve zkratce něco o sobě", "typ" => "textarea", "value" => "", "moznosti" => array(), "show" => array("registr", "profil"), "povinne" => true, "fpovinne" => "", "class" => ""),
                                              "zkusenosti" => array("name" => "Pracovní zkušenosti", "typ" => "textarea", "value" => "", "moznosti" => array(), "show" => array("registr", "profil"), "povinne" => true, "fpovinne" => "", "class" => ""),
                                              "novinky" => array("name" => "Odebírat spam novinky", "typ" => "checkbox", "value" => true, "moznosti" => array(), "show" => array("registr", "profil"), "povinne" => false, "fpovinne" => "", "class" => ""),
                                              //"novinky" => array("name" => "Odebírat spam novinky", "typ" => "mailcheckbox", "value" => true, "moznosti" => array(), "show" => array("registr", "profil"), "povinne" => false, "fpovinne" => "", "class" => ""),
                                              "foto" => array("name" => "Fotka", "typ" => "file", "value" => "", "moznosti" => array(), "show" => array("profil"), "povinne" => false, "fpovinne" => "", "class" => ""),
                                              ),





                  "normal_def_form_text" => "
<label%%1%%>
  <span>%%2%%</span>
  <input type=\"text\" name=\"%%3%%\" value=\"%%4%%\" />
  %%5%%
</label>\n",

                  "normal_def_form_textarea" => "
<label%%1%%>
  <span>%%2%%</span>
  <textarea name=\"%%3%%\" rows=\"20\" cols=\"60\">%%4%%</textarea>
  %%5%%
</label>\n",

                  "normal_def_form_checkbox" => "
<label%%1%%>
  <span>%%2%%</span>
  <input type=\"checkbox\" name=\"%%3%%\"%%4%% />
  %%5%%
</label>\n",

                  "normal_def_form_file" => "
<label%%1%%>
  <span>%%2%%</span>
  <input type=\"file\" name=\"%%3%%[main]\" />
  %%5%%
  <img src=\"%%4%%\" alt=\"\" />
</label>\n",

                  "normal_def_form_select" => "
<label%%1%%>
  <span>%%2%%</span>
  <select name=\"%%3%%\">
    %%4%%
  </select>
  %%5%%
</label>\n",

                  "normal_def_form_select_row" => "<option value=\"%%1%%\"%%2%%>%%1%%</option>\n",









                  "normal_registrace_datum" => "d.m.Y / H:i:s",

                  "normal_registrace_done" => "registrace oka",

                  "normal_registrace_fail" => "neco se porouchalo... typoval bych duplikatni login",

                  "normal_registrace_fail_login" => "nevyplněn login",

                  "normal_registrace_fail_heslo" => "nevyplneno jedno z hesel",

                  "normal_registrace_fail_compare_heslo" => "hesla se nerovnaji",

                  "normal_registrace_fail_email" => "nevyplnen korektni email",

                  "normal_registrace_fail_captcha" => "zdrbany captcha kod...",



                  "normal_registrace_predmet" => "Predmet",

                  "normal_registrace_message" => "Message %%login%%, %%datum%%, %%email%%, ",

                  "normal_registrace_header" => "from:",


                  "normal_registrace_user_predmet" => "predmet",

                  "normal_registrace_user_message" => "message %%login%%, %%datum%%, %%email%%, ...",

                  "normal_registrace_user_header" => "from:",



                  "normal_registrace_disable" => "registrace je vypnuta, utřeli jste :D",

                  "normal_registrace_form" => "
        <form method=\"post\" action=\"\">
          <fieldset>
            <label>
              <span>Login</span>
              <input type=\"text\" name=\"%%1%%\" value=\"%%2%%\" />
            </label>
            <label>
              <span>Heslo 1</span>
              <input type=\"password\" name=\"%%3%%\" />
            </label>
            <label>
              <span>Heslo 2</span>
              <input type=\"password\" name=\"%%4%%\" />
            </label>
            <label>
              <span>Email</span>
              <input type=\"text\" name=\"%%5%%\" value=\"%%6%%\" />
            </label>

%%7%%

captcha kod:
%%8%%
            <label>
              <span>Captcha kod</span>
              <input type=\"text\" name=\"%%9%%\" value=\"\" />
            </label>

            <label id=\"form_submit\">
              <input type=\"submit\" name=\"%%10%%\" value=\"Odeslat přihlášku\" />
            </label>

            <label>
              <span>Odesláním přihlášky souhlasíte s podmínkami uvedenými zde.</span>
            </label>

          </fieldset>
        </form>
                  ",



                  "normal_login_form_pred" => "
        <form method=\"post\" action=\"\">
          <fieldset>
            <label>
              <span>Login</span>
              <input type=\"text\" name=\"%%1%%\" />
            </label>
            <label>
              <span>Heslo</span>
              <input type=\"password\" name=\"%%2%%\" />
            </label>
            <label id=\"form_submit\">
              <input type=\"submit\" name=\"%%3%%\" value=\"Přihlásit se...\" />
            </label>
          </fieldset>
          <a href=\"%%4%%\">registrovat se</a>
        </form>
                  ",


                  "normal_login_form_po_datum" => "d.m.Y H:i:s",

                  "normal_login_form_po" => "
                  přihlášen: <a href=\"%%1%%\">%%2%%</a>
                  <a href=\"%%3%%\">odhlásit se</a>
                  obnoveno v: %%4%%
                  ",



                  "normal_login_form_po_expire" => "expirace přihlášení",

                  "normal_login_form_log_on_true" => "
                  přihlášení uživatele: %%1%% proběhlo uspěšně
                  ",

                  "normal_login_form_log_on_false" => "
                  špatné udaje přihlašování...
                  ",

                  "normal_login_form_log_out" => "
                  odhláseni upesne provedeno...
                  ",


                  "normal_profile_form" => "
        <form method=\"post\" enctype=\"multipart/form-data\" action=\"\">
          <fieldset>
%%1%%
%%2%%
%%3%%

<hr />

%%4%%

            <label id=\"form_submit\">
              <input type=\"submit\" name=\"%%5%%\" value=\"Upravit profil\" />
            </label>

          </fieldset>
        </form>
                  ",

                  "normal_profile_file_size" => "305x371",

                  "normal_profile_done" => "upraveno: %%1%%",

                  "normal_profile_fail" => "chyba v: %%1%%",





                  "normal_info_profile_defpic" => "def_pic.png",

                  "normal_info_profile" => "<br />
<h2>%%jmeno%% %%prijmeni%% <span>{profil}</span></h2>


<div id=\"obal_sekce_profil\">



<div id=\"obal_uzivatel_foto\">

<p>
<img src=\"%%profil_foto%%\" alt=\"\" />

<strong>%%jmeno%% %%prijmeni%%</strong>
<em>Člen akademie mladých podnikatelů</em>
<span>%%profil_url%%</span>


</p>


</div>

<div id=\"obal_uzivatel_obsah\">


<h4>Jméno & Příjmení</h4>

<p>%%jmeno%% %%prijmeni%%</p>


<h4>Věk</h4>

<p>%%vek%%</p>


<h4>Dosažené vzdělání</h4>

<p>%%vzdelani%%</p>


<h4>Telefon</h4>

<p>%%telefon%%</p>



<h4>Mail</h4>

<p>%%email%%</p>





<h4>Co mohu nabídnout</h4>

<p>%%nabidka%%</p>




<h4>Něco o mě</h4>

<p>%%osobe%%</p>



<h4>Moje pracovní zkušenosti</h4>

<p>
%%zkusenosti%%
</p>



<a href=\"%%edit_url%%\" title=\"\" id=\"upravit_profil\">Upravit profil</a>


</div>
</div>
                  ",

                  "normal_info_public_profile" => "<br />
<h2>%%jmeno%% %%prijmeni%% <span>{profil}</span></h2>


<div id=\"obal_sekce_profil\">



<div id=\"obal_uzivatel_foto\">

<p>
<img src=\"%%profil_foto%%\" alt=\"\" />

<strong>%%jmeno%% %%prijmeni%%</strong>
<em>Člen akademie mladých podnikatelů</em>
<span>%%profil_url%%</span>


</p>


</div>

<div id=\"obal_uzivatel_obsah\">


<h4>Jméno & Příjmení</h4>

<p>%%jmeno%% %%prijmeni%%</p>


<h4>Věk</h4>

<p>%%vek%%</p>


<h4>Dosažené vzdělání</h4>

<p>%%vzdelani%%</p>


<h4>Telefon</h4>

<p>%%telefon%%</p>



<h4>Mail</h4>

<p>%%email%%</p>





<h4>Co mohu nabídnout</h4>

<p>%%nabidka%%</p>




<h4>Něco o mě</h4>

<p>%%osobe%%</p>



<h4>Moje pracovní zkušenosti</h4>

<p>
%%zkusenosti%%
</p>



</div>
</div>
                  ",







                  "admin_obsah_user" => "
                  vypis uživatelů:<br>
-- tu bude mozna i filtrovani--<br>
                  %%1%%

                  ",

                  "admin_edituser" => "
<div class=\"obal_dyncent\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Uprava uživatele %%1%%</h3>
  </div>
  <a href=\"%%5%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" enctype=\"multipart/form-data\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Login uživatele:</span>
        <input type=\"text\" name=\"login\" value=\"%%1%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>

      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Email uživatele:</span>
        <input type=\"text\" name=\"email\" value=\"%%2%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>

      <label class=\"f-checkbox w-500 m-b-3-i\">
        <input type=\"checkbox\" name=\"aktivni\"%%3%% />
        <span class=\"nazev-elementu\">Aktivni</span>
      </label>

%%4%%

      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit uživatel\" />
      </label>
    </fieldset>
  </form>
</div>\n",


                  "admin_vypis_konfigurace_text" => "
      <label class=\"%%1%%\">
        <span class=\"nazev-elementu\">%%2%%:</span>
        <input type=\"text\" name=\"%%3%%\" value=\"%%4%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
                  ",

                  "admin_vypis_konfigurace_select_row" => "<option value=\"%%1%%\"%%2%%>%%1%%</option>\n",

                  "admin_vypis_konfigurace_select" => "
      <label class=\"%%1%%\">
        <span class=\"nazev-elementu\">%%2%%:</span>
        <select name=\"%%3%%\">
          %%4%%
        </select>
      </label>
                  ",

                  "admin_vypis_konfigurace_checkbox" => "
      <label class=\"%%1%%\">
        <input type=\"checkbox\" name=\"%%3%%\"%%4%% />
        <span class=\"nazev-elementu\">%%2%%</span>
      </label>
                  ",

                  "admin_vypis_konfigurace_file" => "
      <label class=\"%%1%%\">
        <span class=\"nazev-elementu\">%%2%%</span>
        <input type=\"file\" name=\"%%3%%[main]\" />
        <img src=\"%%4%%\" alt=\"\">
      </label>
                  ",



                  "admin_vypis_user_row" => "%%1%% %%2%% %%3%% %%4%% <input type=\"checkbox\" disabled=\"disabled\"%%5%% />

                  <a href=\"%%6%%\">edit</a>
                  <a href=\"%%7%%\" title=\"smazat?\" class=\"confirm\">del</a>
                  <br>",

                  "admin_vypis_user" => "
                  %%1%%",

                  "admin_vypis_user_null" => "žadná položka",

                  "admin_vypis_user_datum" => "d.m.Y H:i:s",

                  "admin_vypis_user_datum_null" => "este se neupravilo",




                  "admin_obsah" => "
<div class=\"obal_dyncron\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">nastaveni uzivatelu</h3>
  </div>

  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Email admina (pro zasilani emailu):</span>
        <input type=\"text\" name=\"emailadmin\" value=\"%%emailadmin%%\" />
      </label>
      <label class=\"f-radiobutton w-355 m-b-3-i\">
        <input type=\"radio\" name=\"typregistrace\" value=\"vypnuto\"%%typ_vypnuto%% />
        <span class=\"nazev-elementu\">Pozastaveni regisrace do stranek</span>
      </label>
      <label class=\"f-radiobutton w-355 m-b-3-i\">
        <input type=\"radio\" name=\"typregistrace\" value=\"primo\"%%typ_primo%% disabled=\"disabled\" />
        <span class=\"nazev-elementu\">Regisrace primo</span>
      </label>
      <label class=\"f-radiobutton w-355 m-b-3-i\">
        <input type=\"radio\" name=\"typregistrace\" value=\"presemail\"%%typ_presemail%% disabled=\"disabled\" />
        <span class=\"nazev-elementu\">Registrace pres potvrzovaci email</span>
      </label>
      <label class=\"f-radiobutton w-355 m-b-3-i\">
        <input type=\"radio\" name=\"typregistrace\" value=\"presadmin\"%%typ_presadmin%% />
        <span class=\"nazev-elementu\">Registrace pres admina stranek</span>
      </label>
<hr />
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Expirace prihlaseni uzivatele:</span>
        <input type=\"text\" name=\"loginexpirace\" value=\"%%loginexpirace%%\" />
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"onregexpirace\"%%onregexpirace%% />
        <span class=\"nazev-elementu\">Povolit expiraci nepotvrzených uživatelů</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Expirace nepotvrzene registrace uzivatele:</span>
        <input type=\"text\" name=\"regexpirace\" value=\"%%regexpirace%%\" />
      </label>
<hr />
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"verejne\"%%verejne%% />
        <span class=\"nazev-elementu\">Veřejne (on)/neverejne profily</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">ID captcha kodu:</span>
        <input type=\"text\" name=\"captcha\" value=\"%%captcha%%\" />
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"podminky\"%%podminky%% disabled=\"disabled\" />
        <span class=\"nazev-elementu\">Potvzovat pri registraci podminky</span>
      </label>
      <label class=\"f-textarea w-500\">
        <span class=\"nazev-elementu\">Podminky registrace (pripadne tu muze byt tiny_mce):</span>
        <textarea name=\"textpodminky\" rows=\"20\" cols=\"60\" disabled=\"disabled\">%%textpodminky%%</textarea>
      </label>
<hr /><hr />
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Delka loginu (min, 0 = infinite):</span>
        <input type=\"text\" name=\"lenloginmin\" value=\"%%lenloginmin%%\" disabled=\"disabled\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Delka loginu (max, 0 = infinite):</span>
        <input type=\"text\" name=\"lenloginmax\" value=\"%%lenloginmax%%\" disabled=\"disabled\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Delka hesla (min, 0 = infinite):</span>
        <input type=\"text\" name=\"lenpassmin\" value=\"%%lenpassmin%%\" disabled=\"disabled\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Delka hesla (max, 0 = infinite):</span>
        <input type=\"text\" name=\"lenpassmax\" value=\"%%lenpassmax%%\" disabled=\"disabled\" />
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"typchar[]\" value=\"uplow\"%%uplow%% disabled=\"disabled\" />
        <span class=\"nazev-elementu\">Potřeba velkých i malích písmen</span>
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"typchar[]\" value=\"alfamun\"%%alfamun%% disabled=\"disabled\" />
        <span class=\"nazev-elementu\">Potřeba alfanumerických znaků</span>
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"typchar[]\"value=\"spec\"%%spec%% disabled=\"disabled\" />
        <span class=\"nazev-elementu\">Potřeba speciálních znaků</span>
      </label>
<hr />
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"changelogin\"%%changelogin%% disabled=\"disabled\" />
        <span class=\"nazev-elementu\">Povolit zmenu loginu</span>
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"duplicemail\"%%duplicemail%% disabled=\"disabled\" />
        <span class=\"nazev-elementu\">Povolit duplicitni emaily</span>
      </label>
<hr />
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Pocet pokusu o prihlaseni, nez se zacne ptat na captchu (0 = infinite):</span>
        <input type=\"text\" name=\"maxlogin\" value=\"%%maxlogin%%\" disabled=\"disabled\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Pocet registraci z jednoho session (0 = infinite):</span>
        <input type=\"text\" name=\"maxregistration\" value=\"%%maxregistration%%\" disabled=\"disabled\" />
      </label>
<hr />
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"interpost\"%%interpost%% disabled=\"disabled\" />
        <span class=\"nazev-elementu\">Povolit interni poštu mezi uzivately</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Max pocet pošty (0 = infinite):</span>
        <input type=\"text\" name=\"maxinterpost\" value=\"%%maxinterpost%%\" disabled=\"disabled\" />
      </label>
<hr />
blokovani emailu podle masky (pattern): [ajax polozky] ???<br />
blokovani ip adres podle masky (pattern): [ajax polozky] ???<br />

      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"Uložit nastavení\" />
      </label>
    </fieldset>
  </form>
</div>\n",





/*
                  "admin_vypis_logu_begin" => "
<div class=\"obal_dyncron\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Výpis CRON logování</h3>
  </div>
</div>\n",

                  "admin_addeditcron_add" => "Přidat úlohu CRON",

                  "admin_addeditcron_edit" => "Upravit úlohu CRON",

                  "admin_addeditcron" => "
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
      <label class=\"f-select-optgroup f-povinny w-505\">
        <span class=\"nazev-elementu\">Modul &rsaquo;&rsaquo; Funkce:</span>
%%2%%
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Parametry:</span>
        <input type=\"text\" name=\"parametry\" value=\"%%3%%\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Popis:</span>
        <input type=\"text\" name=\"popis\" value=\"%%4%%\" />
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"aktivni\"%%5%% />
        <span class=\"nazev-elementu\">Aktivní</span>
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"%%1%%\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_vypis_tvar_datum" => "d.m.Y / H:i:s",

                  "admin_vypis_obsah" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\">
  <li class=\"nadpis-2 f-s-16 p-t-6 p-r-5 p-b-6 p-l-10 ow-h\"><span class=\"fl-l\">%%2%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\"><a href=\"%%8%%\" class=\"editcron block fl-l m-r-5 m-l-5 no-u odkaz-4\" title=\"Upravit úlohu\">Upravit úlohu</a><a href=\"%%9%%\" title=\"Opravdu chceš smazat CRON úlohu: &quot;%%1%% - %%2%%&quot; ?\" class=\"delcron confirm block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat úlohu</a></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">%%1%%</span><span class=\"fl-r barva-5\">%%4%%<!-- --></span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Aktivní:</span><span class=\"fl-r barva-5\"><input type=\"checkbox\" disabled=\"disabled\"%%7%% class=\"block m-t-2\" /></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Datum / čas vytvoření:</span><span class=\"fl-r barva-5\">%%5%%</span></li>
</ul>\n",

                  "admin_vypis_obsah_null" => "<div class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro cl-b\">Není vytvořena CRON úloha nebo nebyl CRON ještě spuštěn</div>",

                  "admin_vypis_logu_tvar_datum" => "d.m.Y / H:i:s",

                  "admin_vypis_logu" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\">
  <li class=\"nadpis-2 f-s-16 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"fl-l\">%%1%%</span><span class=\"fl-r\">%%2%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Datum / čas spuštění:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Operační systém:</span><span class=\"fl-r barva-5\">%%5%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">IP serveru:</span><span class=\"fl-r barva-5\">%%4%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Prohlížeč:</span><span class=\"fl-r barva-5\">%%6%%</span></li>
</ul>\n",

                  "set_expire_log" => "-5 day",
*/

                  );

  return $result;
?>
