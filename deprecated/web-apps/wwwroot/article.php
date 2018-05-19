<?php

    header("Content-Type: text/html; charset=utf-8");

    if(!require_once("./config.php")) {print("<div align=\"center\"><br /><br /><br />Chyba 702</div>"); exit();} else{}
    
    if(!require_once("./functions.php")) {print("<div align=\"center\"><br /><br /><br />Chyba 702</div>"); exit();} else {}
    
    pconnect_mysql($host, $user, $password, $db);

//  zavola pozadovany clanok, ak existuje
    if(($_GET["article"] != "")) {
        $article_ID = trim(addslashes($_GET["article"]));
        $article_action = mysql_query(" SELECT * FROM articles WHERE ID='$article_ID' ");
        $article = mysql_fetch_assoc($article_action);
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
    <title dir="ltr"><?php print($article["title"]); ?></title>
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
            <h2><a href="<?php print(URL."article.php?article=".$article["ID"].""); ?>" class="linkcolor" title="<?php print($article["title"]); ?>" target="_self"><?php print($article["title"]); ?></a></h2>
            <?php print($article["content"]); ?>
            <span class="time"><?php print($article["date"]); ?>, Zobrazené: <?php print($article["visits"]); ?> krát, Autor: Martin Kravec
              <span class="zdielanie"><a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;pub=xa-4ac35c1872a8c883"><img src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js?pub=xa-4ac35c1872a8c883"></script></span>
            </span>
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
    $ID_clanku = $article["ID"];
    mysql_query(" UPDATE articles SET visits=visits+1 WHERE ID='$ID_clanku' ");
    mysql_close();
?>
