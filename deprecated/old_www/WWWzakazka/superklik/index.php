<?php
  $result =
  "<html>
<head>
<meta http-equiv=\"Content-Language\" content=\"cs\">
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
<title>Výherní portál Superklik.cz</title>
</head>
<body bgcolor=\"#99CCFF\">
<br />
<br />
<p align=\"center\"><big><big><b>Server <u><a href=\"http://www.superklik.cz/\">Superklik.cz</a></u> je v současné době mimo provoz z důvodu prodeje.</p>
<br />
<p align=\"center\">Děkujeme za pochopení.</b></p>
<br />
<br />
<p align=\"center\">
  <form method=\"post\">
      Jméno: <input type=\"text\" name=\"jmeno\" /><br />
      Heslo: <input type=\"password\" name=\"heslo\" /><br />
      <input type=\"submit\" name=\"tlacitko\" value=\"Přihlásit\" />
  </form>
</p>
<br />
<br />
<center>
<img src=\"logo.png\" alt=\"Logo provozovatele - společnost  MV Consulting s.r.o. Břeclav\" border=\"1\" / >
<br />
<br />
<img style=\"filter:alpha(finishopacity=10,style=2); opacity: 0.6)\" src=\"logo2.png\" alt=\"Logo výherního portálu Superklik.cz\" />
<p align=\"center\"><TABLE STYLE=\"filter:Glow(color=99FFFF,strenght=1)\"><TR><TD><small>MV Consulting s.r.o.  Břeclav 2009</TABLE></p>

<marquee behavior=alternate direction=up scrollamount=2 scrolldelay=65 height=80 style=\"Text-align;filter:wave(add=0,phase=1, freq=1,strength=15,color=.FFFFFF)\">
  <center>Čerstvé zprávy každý den...To je IDNES.CZ<br>Sledujte to nejzajímavější z českých i zahraničních novinek.</center>
</marquee>

<iframe width=120 height=600 marginwidth=0 marginheight=0 frameborder=0 hspace=0 vspace=0 scrolling=no src=\"http://b.idnes.cz/pb.asp?r=&s=60\"></iframe>
</center>
<br />

<br />
<br />
<br />
<br />
</body>
</html>
  ";

  //<a href=\"http://www.gfdesign.cz\" title= \"Created by GFdesign\">Created by GFdesign</a>

  $login = array("projekt" => "klik"); //login => heslo

  $jmeno = $_POST["jmeno"];
  $heslo = $_POST["heslo"];

  if (!Empty($jmeno) && !Empty($heslo) && $login[$jmeno] == $heslo)
  {
    include_once "asfdzughfzguwf7656FTGZSWRSF6756RSWTFRFWR765SWFRFSRFWRFSWFsaddssd_index.php";
  }
    else
  {
    echo $result;
  }
?>
