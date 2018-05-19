<html>

	<head>
		<meta http-equiv="content-type" content="text/html;charset=windows-1250">
		<title>Dotaz</title>
	</head>

	<body bgcolor="#ffffff">
		<b><font color="#0000A0" size="4">Zaslání dotazu</font></b>
		<form name="Form" action="sendform.php" method="post">
			<input type="text" value="objednavka" name="predmet">
			<input type="text" value="geniv@centrum.cz" name="komu">
			<input type="text" value="dekujeme.php" name="nexturl">
			<table cellspacing="5" border=1>
				<tr>
					<td>Jméno:</td>
					<td><input type="text" name="#Jméno" size="43"></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><input type="text" name="email" size="43"><br>
						
							(na tento mail Vám bude zasláno potvrzení)</td>
				</tr>
				<tr>
					<td colspan="2"><textarea name="@Dotaz" cols="48" rows="7"></textarea></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="submitButtonName" value="Odeslat"></td>
				</tr>
			</table>
		</form>
	
	</body>

</html>