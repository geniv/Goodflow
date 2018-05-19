<?php
//header('WWW-Authenticate: Basic realm="upload.gfdesign.cz"');//Basic
//header('HTTP/1.0 401 Unauthorized');
//'{$_SERVER['PHP_AUTH_USER']}'<br>'{$_SERVER['PHP_AUTH_PW']}'<br>
/*
 target=\"ram_upload\" onsubmit=\"StartUpload();\"  action=\"upload.php\"
 <iframe name=\"ram_upload\" src=\"#\"></iframe>

  :
        "<input type=\"submit\" name=\"tlacitko\" value=\"Přidat soubor\" disabled=\"disabled\" />")."
                ".(session_id() != "" ?
        "
        <input name=\"idj\" type=\"hidden\" value=\"{$this->var->iduser}\" id=\"idjm\" />
        <input name=\"jme\" type=\"hidden\" value=\"{$this->var->jmeno}\" id=\"jmen\" />
        <input name=\"pro\" type=\"hidden\" value=\"{$this->var->prostor}\" id=\"prostor\" />
        <input name=\"session\" type=\"hidden\" value=\"".session_id()."\" id=\"session\" />

        <input type=\"file\" name=\"soubory[]\" />
*/

  return
  "<script type=\"text/javascript\">
    PocetHlavniInput('soubory[]', true);
  </script>

  {$this->var->main->Upload()}

<div id=\"pridat_slozku_soubor\"".(!Empty($_POST["tlacitko"]) ? " style=\"display: none;\"" : "").">
  <form method=\"post\" action=\"\" enctype=\"multipart/form-data\" onsubmit=\"SkryjUpload();\">
    <fieldset>
      <div id=\"poc_inputhlavnifile\"></div>
      <dl id=\"label_input_dl_vyber_slozku_soubor\">
        <dt>
          <label>Umístnění:</label>
        </dt>
        <dd>
          <strong>--- Vyber složku ---</strong>
          <span class=\"input_label_dl_obal_polozka_vyber_slozku_soubor\">
            {$this->var->main->ListingDirSelectForFile()}
          </span>
        </dd>
      </dl>
      <div id=\"pridat_slozku_soubor_tlacitko\" class=\"soubor_pridat_tlacitko\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat soubor\" />
      </div>
    </fieldset>
  </form>
  <div id=\"centralni_napoveda\" class=\"napoveda_vychozi\" title=\"Nápověda\">
    <div>
      <p class=\"napoveda_prvni\"><strong>Cesta k souboru</strong> - Když budeš nahrávat několik souborů, tak si nejprve nastav počet vkládacích polí podle počtu souborů a potom nastavuj cesty</p>
      <p><strong>Umístnění</strong> - Kořenový adresář / první zanoření / druhé zanoření</p>
      <p><strong>./</strong> - Kořenový adresář</p>
    </div>
  </div>
</div>
<div id=\"msg_file\">
  <span></span>
  <p>Probíhá nahrávání ... čekejte prosím ...</p>
</div>
  ";

//onsubmit=\"Ajax(document.getElementById('soub').value);\"  --- ".(!Empty($_POST["tlacitko"]) ? " style=\"display: none;\"" : "")." --- doladit a dat do msg_file
/*

<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Max's AJAX File Uploader</title>
   <link href="style/style.css" rel="stylesheet" type="text/css" />

<script language="javascript" type="text/javascript">
<!--
function startUpload(){
      document.getElementById('f1_upload_process').style.visibility = 'visible';
      document.getElementById('f1_upload_form').style.visibility = 'hidden';
      return true;
}

function stopUpload(success){
      var result = '';
      if (success == 1){
         result = '<span class="msg">The file was uploaded successfully!<\/span><br/><br/>';
      }
      else {
         result = '<span class="emsg">There was an error during file upload!<\/span><br/><br/>';
      }
      document.getElementById('f1_upload_process').style.visibility = 'hidden';
      document.getElementById('f1_upload_form').innerHTML = result + '<label>File: <input name="myfile" type="file" size="30" /><\/label><label><input type="submit" name="submitBtn" class="sbtn" value="Upload" /><\/label>';
      document.getElementById('f1_upload_form').style.visibility = 'visible';
      return true;
}
//-->
</script>
</head>

<body>
       <div id="container">
            <div id="header"><div id="header_left"></div>
            <div id="header_main">Max's AJAX File Uploader</div>
            <div id="header_right"></div></div>
            <div id="content">
                <form action="upload.php" method="post" enctype="multipart/form-data" target="upload_target" onsubmit="startUpload();" >
                     <p id="f1_upload_process">Loading...<br/><img src="loader.gif" /><br/></p>
                     <p id="f1_upload_form" align="center"><br/>
                         <label>File:
                              <input name="myfile" type="file" size="30" />
                         </label>
                         <label>
                             <input type="submit" name="submitBtn" class="sbtn" value="Upload" />
                         </label>
                     </p>
                    <iframe id="upload_target" name="upload_target" src="#" ></iframe>
                 </form>
             </div>
         </div>
</body>
*/
?>
