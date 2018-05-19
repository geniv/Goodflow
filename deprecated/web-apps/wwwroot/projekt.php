<?php

    header("Content-Type: text/html; charset=utf-8");

    if(!require_once("./config.php")) {print("<div align=\"center\"><br /><br /><br />Chyba 702</div>"); exit();} else{}
    
    if(!require_once("./functions.php")) {print("<div align=\"center\"><br /><br /><br />Chyba 702</div>"); exit();} else {}
    
    pconnect_mysql($host, $user, $password, $db);
    
//  zavola pozadovany projekt, ak existuje
    if(($_GET["nazov"] != "")) {
        $projekt = trim(addslashes($_GET["nazov"]));
        $projekt_action = mysql_query(" SELECT * FROM projects WHERE nazov='$projekt' ");
        $projekt = mysql_fetch_assoc($projekt_action);
    }
    else {
        @header("Location: error_404.php");
        exit();
    }

?>
<!--[if lte IE 6]>
<script type="text/javascript">
    alert("Používate príliš starý internetový prehliadač. Stiahnite si bezpečnejší a komfortnejší prehliadač 'Firefox' alebo 'Operu'! V tomto prehliadači môžete stránky vidieť chybne.");
</script>
<![endif]-->
<?php
    print("<?xml version=\"1.0\" encoding=\"utf-8\"?>\n");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title dir="ltr"><?php print($projekt["nazov"]); ?></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="content-language" content="" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="expires" content="never" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="MSThemeCompatible" content="no" />
    <meta name="MSSmartTagsPreventParsing" content="true" />
    <meta name="description" content="Open source vyvíjanie webových aplikácií online" />
    <meta name="keywords" content="opensource, online, web, programovanie, php, mysql, seo, rss, xhtml" />
    <meta name="author" content="Martin Kravec - martin&#64;erwe.cz" />
    <meta name="revisit-after" content="7 days" />
    <meta name="robots" content="all, follow" />
    <meta name="google-site-verification" content="2a-WuyeP9m7dXMdZWV1z6_VtyGn9EMlZrrGU2jYE8-8" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php print(URL); ?>styles/main.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php print(URL); ?>styles/content.css" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php print(URL); ?>images/favicon.ico" />
    <!-- jQuery library is required, see http://jquery.com/ -->
    <script type="text/javascript" src="<?php print(URL); ?>files/jquery/jquery.js"></script>
    <!-- WYMeditor main JS file, minified version -->
    <script type="text/javascript" src="<?php print(URL); ?>files/wymeditor/jquery.wymeditor.min.js"></script>
    <script type="text/javascript">
    jQuery(function() {
    jQuery('.wymeditor').wymeditor();
    });
    </script>
  </head>
  <body>
    <div class="main_content">
      <div class="header">
        <a class="linkcolor" href="<?php print(URL); ?>index.php" title="Web-Apps" target="_self">
          <img src="<?php print(URL); ?>images/logo.png" width="124" height="54" border="0" alt="Web-apps logo" />
        </a>
        <h1>Open source vyvíjanie webových aplikácií online</h1>
      </div>
      <div class="content">
        <div class="content_left">
          <div class="article">
            <h2><?php print($projekt["nazov"]); ?></h2>
            <p>form.php</p>
            <div class="code"><?php highlight_file("./projekty/mailto/form.php"); ?></div>
            <p>send.php</p>
            <div class="code"><?php highlight_file("./projekty/mailto/send.php"); ?></div>
            <br />
            <div>
			  <table width="100%" border="0">
              <?php
              
                  switch($diskusia["os"]) {
                      case "linux":
                          $os = "linux";
                          break;
                      case "mac":
                          $os = "mac";
                          break;
                      case "windows":
                          $os = "windows";
                          break;
                      case "os2":
                          $os = "os2";
                          break;
                      case "beos":
                          $os = "beos";
                          break;
                      case "iphone":
                          $os = "iphone";
                          break;
                      case "ipod":
                          $os = "ipod";
                          break;
                  }

                  switch($diskusia["browser"]) {
                      case "opera":
                          $browser = "opera";
                          break;
                      case "msie":
                          $browser = "internet_explorer";
                          break;
                      case "safari":
                         $browser = "safari";
                          break;
                      case "chrome":
                          $browser = "chrome";
                          break;
                      case "mozilla":
                          $browser = "mozilla_firefox";
                          break;
                      case "konqueror":
                          $browser = "konqueror";
                          break;
                      case "android":
                          $browser = "android";
                          break;
                  }
              
                  $project_nazov = $projekt["nazov"];
                  $diskusia_action = mysql_query(" SELECT * FROM projects_diskusia WHERE project='$project_nazov' ORDER BY date DESC LIMIT 0, 30 ");
                  while($diskusia = mysql_fetch_assoc($diskusia_action)) {
              ?>
                <tr><td class="diskusia"><a class="linkcolor" href="mailto:<?php print(str_replace("@", "&#64;", $diskusia["mail"])); ?>"><?php print($diskusia["name"]); ?></a> <img src="<?php print(URL); ?>images/diskusia/<?php print($diskusia["os"]); ?>" width="16" height="16" border="0" alt="<?php print($diskusia["os"]); ?>" /> <img src="<?php print(URL); ?>images/diskusia/<?php print($diskusia["browser"]); ?>" width="16" height="16" border="0" alt="<?php print($diskusia["browser"]); ?>" /> <?php print($diskusia["date"]); ?></td></tr>
                <?php
                    $content = $diskusia["content"];
                    //$content = trim($content);
                    //$content = str_replace("[CODE]", "\".highlight_string(\"", $content);
                    //$content = str_replace("[/CODE]", "\").", $content);
                    //$content = str_replace("[URL]", "<a rel=\"nofollow\" class=\"link\" target=\"_blank\" href=\"", $content);
                    //$content = str_replace("[/URL]", "\">ODKAZ</a>", $content);
                ?>
                <tr><td><?php print(stripslashes($content)); ?></td></tr>
                <tr><td><br /></td></tr>
              <?php
                  }
              ?>
              </table>
            </div>
            <br />
            <div>
              <script type="text/javascript">
                  function vlozText(text, blok) {
                      text += (blok ? '\n' : ' ');			// prida k textu zalomenie riadku alebo medzeru
                      document.formular.text.value += text;	// prida na koniec textarea
                      document.formular.text.focus();		// premiesti kurzor do textoveho policka
                  }
              </script>
            <form name="formular" action="<?php print(URL); ?>diskusia.php" method="post">
			<table width="100%" border="0">
              <tr>
                <td valign="top" align="left">Meno: </td>
                <td valign="top" align="left"><input type="text" name="meno" value="<?php print($_COOKIE["diskusia_meno"]); ?>" /></td>
              </tr>
              <tr>
                <td valign="top" align="left">E-mail: </td>
                <td valign="top" align="left"><input type="text" name="mail" value="<?php print($_COOKIE["diskusia_mail"]); ?>" /></td>
              </tr>
              <tr>
                <td valign="top" align="left">Text: </td>
                <td valign="top" align="left"><textarea class="wymeditor" name="text" rows="10" cols="70"></textarea></td>
              </tr>
              <tr>
                <td valign="top" align="left"></td>
                <td valign="top" align="left">
	              <!--<a class="linkcolor" onclick="vlozText('[CODE][/CODE]')">[CODE][/CODE]</a>
	              <a class="linkcolor" onclick="vlozText('[URL][/URL]')">[URL][/URL]</a> - klikni</td>-->
              </tr>
              <tr>
                <td valign="top" align="left"><input type="hidden" name="project" value="<?php print($projekt["nazov"]); ?>" /></td>
                <td valign="top" align="left"><input class="wymupdate" type="submit" name="action" value="Odoslať" /></td>
              </tr>
            </table>
            </form>
          </div>
          </div>
        </div>
        <?php require_once("./files/sidebar.php"); ?>
      </div>
      <div class="footer">
        <p>&copy;&nbsp;2010&nbsp;Martin&nbsp;Kravec,&nbsp;All&nbsp;rights&nbsp;reserved</p>
      </div>
    </div>
    <script type="text/javascript">
    var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
    document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <script type="text/javascript">
    try {
    var pageTracker = _gat._getTracker("UA-8931227-7");
    pageTracker._trackPageview();
    } catch(err) {}</script>
  </body>
</html>
<?php
    mysql_close();
?>
