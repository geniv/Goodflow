<html>

	<head>
		<meta http-equiv="content-type" content="text/html;charset=windows-1250">
		<title>Kontaktn� formul��</title>
	</head>

	<body bgcolor="white">
		<center>
			<font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="5"><b>
			<table border="4" cellpadding="0" cellspacing="2" width="100%" bgcolor="#ffff9c" height="60">
				<tr>
					<td>
						<center>
							<font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="5"><b>Kontaktn� formul��</b></font></center>
					</td>
				</tr>
			</table>
			</b></font></center>
		<form name="FormName" action="sendform.php" method="post" enctype="multipart/form-data">
			<input type="hidden" value="Y" name="html">
			<input type="hidden" value="noreply@terc.cz" name="komu">
			<input type="hidden" value="dekujeme.php" name="nexturl">
			<p><font size="4"><strong>Pokud m�te z�jem o bli��� informace, vypl�te n�sleduj�c� formul��.</strong></font></p>
			<p>Napi�te n�m i co si mysl�te o na�em webu, na�ich produktech, na�� firm�, nebo cokoliv jin�ho co n�m chcete sd�lit. V�t�me v�echny Va�e p�ipom�nky a koment��e.</p>
			<p><strong>O jak� informace ��d�te nebo co n�m chcete sd�lit?</strong></p>
			<dl>
			<dd><input type="radio" name="predmet" value="WebNews.cz - ��dost o informace" checked>��dost o informace <input type="radio" name="predmet" value="WebNews.cz - ��dost o zasl�n� nab�dky">Zasl�n� nab�dky <input type="radio" name="predmet" value="WebNews.cz - Objedn�vka">Objedn�vka <input type="radio" name="predmet" value="WebNews.cz - Zpr�va pro n�s">Zpr�va pro n�s
		</dl>
			<p><strong>Zde napi�t� Va�i ��dost, objedn�vku nebo koment��:</strong></p>
		<dl>
			<dd><textarea name="@Text" rows="5" cols="42"></textarea>
		</dl>
			<p><strong>N�zev souboru, kter� n�m chcete zaslat jako p��lohu e-mailu:</strong></p>
		<dl>
			<dd><input type="file" name="soubor" size="42">
		</dl>
		<p><strong>Zadejte V� kontakt, aby jsme se mohli s V�mi spojit:</strong></p>
		<dl>
			<dd>
			<table border="0" width="482">
				<tr>
					<td width="116">Jm�no nebo firma:</td>
					<td width="362"><input type="text" size="35" name="@Jm�no" maxlength="256"></td>
				</tr>
				<tr>
					<td width="116">Adresa:</td>
					<td width="362"><input type="text" size="35" maxlength="256" name="#Adresa"></td>
				</tr>
				<tr>
					<td width="116" valign="top">E-mail:</td>
					<td width="362"><input type="text" size="35" name="email" maxlength="256"><br>
							(na tento mail V�m bude zasl�no potvrzen�)</td>
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
			<dd><input type="checkbox" name="#Odpov��" value="Po�aduji rychlou odpov��."> Pros�m o kontaktov�n� v co nejkrat�� dob�.
		</dl>
			<p><input type="submit" value="Odeslat informace" name="btn"> <input type="reset" value="Smazat formul��"></p>
		</form>
		<p><a href="http://webnews.terc.cz/ps/section_view.php?r=18" target="_blank">WebNews.cz - PHP a MySQL</a></p>
	</body>

</html>