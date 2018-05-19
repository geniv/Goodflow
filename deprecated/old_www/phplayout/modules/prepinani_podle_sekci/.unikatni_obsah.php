<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Přepínání obsahu podle sekcí",
                                              "title" => "Přepínání obsahu podle sekcí",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => false),
                                        ),

                  "admin_obsah" => "
<div class=\"prepinani_podle_sekci\">
  <h3>Výpis obsahu přepínaného podle sekcí</h3>
  <p class=\"odkaz_pridat\"><a href=\"%%1%%\" title=\"Přidat sekci\">Přidat sekci</a></p>
%%2%%
</div>\n",

                  "admin_add" => "
<div class=\"prepinani_podle_sekci_add_edit_sekce\">
  <h3>Přidat sekci</h3>
  <p>
    <a href=\"%%1%%\" title=\"Zpět do výpisu obsahu přepínaného podle sekcí\">Zpět do výpisu obsahu přepínaného podle sekcí</a>
  </p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label>
        <span>Adresa sekce:</span>
        <input type=\"text\" name=\"adresa\" />
      </label>
      <label>
        <span>Obsah sekce:</span>
        <textarea name=\"kod\" rows=\"30\" cols=\"80\"></textarea>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat sekci\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_add_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla přidána sekce: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_edit" => "
<div class=\"prepinani_podle_sekci_add_edit_sekce\">
  <h3>Upravit sekci <strong>%%1%%</strong></h3>
  <p>
    <a href=\"%%3%%\" title=\"Zpět do výpisu obsahu přepínaného podle sekcí\">Zpět do výpisu obsahu přepínaného podle sekcí</a>
  </p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label>
        <span>Adresa sekce:</span>
        <input type=\"text\" name=\"adresa\" value=\"%%1%%\" />
      </label>
      <label>
        <span>Obsah sekce:</span>
        <textarea name=\"kod\" rows=\"30\" cols=\"80\">%%2%%</textarea>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit sekci\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_edit_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla upravena sekce: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_del_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla smazána sekce: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_vypis_obsah" => "
<ul>
  <li class=\"nazev_sekce\">[%%1%%] - <strong>%%2%%</strong></li>
  <li class=\"odkazy_sekce\"><a href=\"%%4%%\" title=\"Upravit sekci\">Upravit sekci</a> - <a href=\"%%5%%\" title=\"Smazat sekci\" onclick=\"return confirm('Opravdu chceš smazat sekci: &quot;%%2%%&quot; ?');\">Smazat sekci</a></li>
  <li class=\"pre\">
    <pre>%%3%%</pre>
  </li>
</ul>\n",

                  "" => "",
                  "" => "",
                  "" => "",
                  );

  return $result;
?>
