<html>

	<head>
		<meta http-equiv="content-type" content="text/html;charset=windows-1250">
		<title>Kontaktní formulář</title>
	</head>

	<body bgcolor="white">
		<center>
			<font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="5"><b>
			<table border="4" cellpadding="0" cellspacing="2" width="100%" bgcolor="#ffff9c" height="60">
				<tr>
					<td>
						<center>
							<font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="5"><b>Kontaktní formulář</b></font></center>
					</td>
				</tr>
			</table>
			</b></font></center>
		<form name="FormName" action="sendform.php" method="post" enctype="multipart/form-data">
			<input type="hidden" value="Y" name="html">
			<input type="hidden" value="noreply@terc.cz" name="komu">
			<input type="hidden" value="dekujeme.php" name="nexturl">
			<p><font size="4"><strong>Pokud máte zájem o bližší informace, vyplňte následující formulář.</strong></font></p>
			<p>Napište nám i co si myslíte o našem webu, našich produktech, naší firmě, nebo cokoliv jiného co nám chcete sdělit. Vítáme všechny Vaše připomínky a komentáře.</p>
			<p><strong>O jaké informace žádáte nebo co nám chcete sdělit?</strong></p>
			<dl>
			<dd><input type="radio" name="predmet" value="WebNews.cz - Žádost o informace" checked>Žádost o informace <input type="radio" name="predmet" value="WebNews.cz - Žádost o zaslání nabídky">Zaslání nabídky <input type="radio" name="predmet" value="WebNews.cz - Objednávka">Objednávka <input type="radio" name="predmet" value="WebNews.cz - Zpráva pro nás">Zpráva pro nás
		</dl>
			<p><strong>Zde napiště Vaši žádost, objednávku nebo komentář:</strong></p>
		<dl>
			<dd><textarea name="@Text" rows="5" cols="42"></textarea>
		</dl>
			<p><strong>Název souboru, který nám chcete zaslat jako přílohu e-mailu:</strong></p>
		<dl>
			<dd><input type="file" name="soubor" size="42">
		</dl>
		<p><strong>Zadejte Váš kontakt, aby jsme se mohli s Vámi spojit:</strong></p>
		<dl>
			<dd>
			<table border="0" width="482">
				<tr>
					<td width="116">Jméno nebo firma:</td>
					<td width="362"><input type="text" size="35" name="@Jméno" maxlength="256"></td>
				</tr>
				<tr>
					<td width="116">Adresa:</td>
					<td width="362"><input type="text" size="35" maxlength="256" name="#Adresa"></td>
				</tr>
				<tr>
					<td width="116" valign="top">E-mail:</td>
					<td width="362"><input type="text" size="35" name="email" maxlength="256"><br>
							(na tento mail Vám bude zasláno potvrzení)</td>
				</tr>
				<tr>
					<td width="116">Telefon:</td>
					<td width="362"><input type="text" size="35" maxlength="256" name="#Telefon"></td>
				</tr>
				<tr>
					<td width="116">Fax:</td>
					<td width="362"><input type="text" size="35" maxlength="256" name="#Fax"></td>
				</tr>
			</table>
			<dd>
			<dd><input type="checkbox" name="#Odpověď" value="Požaduji rychlou odpověď."> Prosím o kontaktování v co nejkratší době.
		</dl>
			<p><input type="submit" value="Odeslat informace" name="btn"> <input type="reset" value="Smazat formulář"></p>
		</form>
		<p><a href="http://webnews.terc.cz/ps/section_view.php?r=18" target="_blank">WebNews.cz - PHP a MySQL</a></p>
	</body>

</html>