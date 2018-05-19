<?

?>
<div class="styl6" id="CHeader">::Menu:.</div>
<a href="index.php">:: Home</a><br>
<a href="index.php?kam=hitorie">:: Historie</a><br>
<a href="index.php?kam=clenove">:: Èlenové</a><br>
<a href="index.php?kam=pozary">:: Požáry</a><br>
<a href="index.php?kam=technika">:: Technika</a><br>
<a href="index.php?kam=akce">:: Akce</a><br>
<a href="index.php?kam=mladi">:: Mladí Hasièi</a><br>	 
</div>
				
<div id="CHeader2"><b>::Gallerie:.</b></div>
<div id="SideC"><a href="Files/galerie/hasicka.html">Hasická Zbrojnice</a></div>
				
<div id="CHeader2"><b>::Návštìvnost:.</b></div>

<div id="CHeader2"><b>::Náhodné foto:.</b></div>
<div id="SideC">
<center>
<?
$nah=rand(1,8);
print "<img src=\"Files/foto/foto_0$nah.jpg\">";

/*
 <script language="JavaScript"> 
			var i=Math.round(Math.random()*8); 
			if (i==0) vloz='<img src="Files/foto/foto_01.jpg" width="175" title="D">'; 
			if (i==1) vloz='<img src="Files/foto/foto_02.jpg" width="175" title="D">'; 
			if (i==2) vloz='<img src="Files/foto/foto_03.JPG" width="175" title="D">'; 
			if (i==3) vloz='<img src="Files/foto/foto_04.jpg" width="175" title="D">'; 
			if (i==4) vloz='<img src="Files/foto/foto_05.jpg" width="175" title="D">'; 
			if (i==5) vloz='<img src="Files/foto/foto_06.jpg" width="175" title="D">';
			if (i==6) vloz='<img src="Files/foto/foto_07.jpg" width="175" title="D">'; 
			if (i==7) vloz='<img src="Files/foto/foto_08.jpg" width="175" title="D">';
			</script> 
		 	<SCRIPT LANGUAGE="JavaScript"> 
			document.write(vloz); 
			</script> 
*/
?>
</center>
				</div>
				
				<div id="CHeader2"><b>::Kontakty:.</b></div>
				<div id="SideC"><center>
				<a href="kontakty.html">Kontakty</a><br />
				<a href="odkazy.html">Odkazy</a><br />
				<a href="kniha.html">Kniha</a><br />
				</center></div>
			</div>
		
