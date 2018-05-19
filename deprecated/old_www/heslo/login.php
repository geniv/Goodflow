<?
If ($HTTP_POST_VARS["heslo"]=="heslo"):
session_start();
session_register("user_register");
$user_register = "ANO";
header("location:private.php");

else:
if (isset($HTTP_POST_VARS["heslo"])) echo "Prihlášení se nepodarilo" ;
endif;
?>
<FORM ACTION="login.php" METHOD="post">
zadej heslo:
<INPUT TYPE="password" NAME="heslo" value="">
<INPUT TYPE="submit" NAME="odoslat" VALUE="GO!">
</form>
</body>
</html>