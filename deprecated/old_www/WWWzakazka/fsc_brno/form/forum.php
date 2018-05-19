<?php
  return
  "
<div id=\"forum\">
  <h2>Fórum</h2>
<div id=\"mesg_forum\"></div>
  <div id=\"pridat_prispevek\">
    <form action=\"\">
      <fieldset>
        <legend>Přidat příspěvek</legend>
        <h3>Přidat příspěvek:</h3>
          <label for=\"label_input_jmeno\">Jméno:</label>
            <input id=\"label_input_jmeno\" type=\"text\" name=\"jmeno\" />
          <label for=\"label_input_mail\">E-mail:</label>
            <input id=\"label_input_mail\" type=\"text\" name=\"mail\" value=\"@\" onchange=\"kontrolaEmailu('label_input_mail');\" /><span>*</span>
          <label for=\"label_textarea_zprava\">Zpráva:</label>
            <textarea name=\"zprava\" id=\"label_textarea_zprava\" cols=\"\" rows=\"\"></textarea>
          <input id=\"tl_odeslat_prispevek\" type=\"button\" value=\"&nbsp;\" name=\"tlacitko\" onclick=\"AjaxForum(document.getElementById('label_input_jmeno').value, document.getElementById('label_input_mail').value, document.getElementById('label_textarea_zprava').value);AutoClick(2, 'forum', '');document.getElementById('tl_odeslat_prispevek').style.visibility='hidden';\" />
      </fieldset>
    </form>
    <p>* Povinný údaj</p>
  </div>

{$this->VypisForum()}

</div>

  ";
?>
