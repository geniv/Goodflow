<?php 
	if (!Empty($_POST["login"]) && !Empty($_POST["heslo"]))
	{
		if ($this->KontrolaLogin(md5(md5($_POST["login"])), md5(md5($_POST["heslo"]))))
		{
			SetCookie("JURIX_JMENO", md5(md5($_POST["login"])), Time() + 31536000); //zápis do cookie
	    SetCookie("JURIX_HESLO", md5(md5($_POST["heslo"])), Time() + 31536000);
	    $this->AutoClick(1, "?action=administrace");
	    $prih =
	    "
      <div class=\"odhlaseno_prihlaseno\">
        <p>
          Byl jsi přihlášen.
        </p>
        <p>
          Pokračuj klapnutím <a href=\"?action=administrace\" title=\"Pokračuj klapnutím zde\">zde</a>.
        </p>
      </div>
      ";
		}
			else
		{
			$prih =
			"
	    <div class=\"odhlaseno_prihlaseno\">
        <p>
          Zadal jsi špatné loginy.
        </p>
        <p>
          Pokračuj klapnutím <a href=\"?action=administrace\" title=\"Pokračuj klapnutím zde\">zde</a>.
        </p>
      </div>
      ";
		}
	}

	if (!Empty($_GET["akce"]) && $_GET["akce"] == "logoff")
	{
		SetCookie("JURIX_JMENO", "", 0); //vymazání cookie
		SetCookie("JURIX_HESLO", "", 0);
		$this->AutoClick(1, "?action=administrace");
		$prih =
		"
	    <div class=\"odhlaseno_prihlaseno\">
        <p>
          Byl jsi odhlášen.
        </p>
        <p>
          Pokračuj klapnutím <a href=\"?action=administrace\" title=\"Pokračuj klapnutím zde\">zde</a>.
        </p>
      </div>
    ";
	}

	if (!Empty($_COOKIE["JURIX_JMENO"]) && 
			!Empty($_COOKIE["JURIX_HESLO"]) && 
			$this->KontrolaLogin($_COOKIE["JURIX_JMENO"], $_COOKIE["JURIX_HESLO"]) &&
			$_GET["akce"] != "logoff")
	{
		$menuadmin = $this->MenuAdmin();
		$obsahadmin = $this->ObsahAdmin();
		return
		"
		{$menuadmin}
		{$obsahadmin}
		";
	}
		else
	{
    return
	  "
	    <h2>
	      Administrace
	    </h2>
	    <p class=\"uvodni_text\">
	      {$this->TextSekce("administrace")}
	    </p>
	    <form id=\"admin_form\" action=\"\" method=\"post\">
	      <fieldset>
	        <legend>Administrátorský formulář</legend>
	        <label for=\"login_label_input\">Login:</label>
	          <input id=\"login_label_input\" type=\"text\" name=\"login\" />
	        <label for=\"heslo_label_input\">Heslo:</label>
	          <input id=\"heslo_label_input\" type=\"password\" name=\"heslo\" />
	          <input id=\"tl_prihlasit\" type=\"submit\" value=\"Přihlásit\" name=\"\" />
	      </fieldset>
	    </form>
      {$prih}
	  ";
//onclick=\"AutoClick(2, 'administrace', '');\"
// onkeydown=\"Enter(event, 'tl_prihlasit');\"
//AjaxLogin(document.getElementById('login_label_input').value, document.getElementById('heslo_label_input').value);
	}
?>
