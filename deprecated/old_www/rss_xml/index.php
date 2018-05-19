<?php
//odkaz na rss: <a href=\"http://geniv.ic.cz/rss/rss.php\">zde...</a>
print
"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
<html>
<head>
<link type=\"application/rss+xml\" rel=\"alternate\" title=\"Pokusné RSS\" href=\"http://geniv.ic.cz/rss/rss.php\" />
</head>
<script type=\"text/javascript\">
  return false;
<body>
</script>
<br>
<a href=\"http://validator.w3.org/feed/check.cgi?url=http%3A//geniv.ic.cz/rss/rss.php\">
  <img src=\"valid-rss.png\" alt=\"[Valid RSS]\" title=\"Validate my RSS feed\" border=\"0\" />
</a>
</body>
</html>";

//print_r(gethostbynamel ($REMOTE_ADDRES));
//print gethostbyname ("localhost");
//print_r($_SERVER);

?>
