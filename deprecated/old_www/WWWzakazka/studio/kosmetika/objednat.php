<?
//---------------------------------------------------------------------
$soub="kosmetika/administrace/udaje_kosmetika_kjfnvoiwpsejfowksjpkopijqqqwjmoinjsdfvokknoksldncoiksndvlkidfjviosdjnhgef.php";
$u=fopen($soub,"r");
$udj=explode("--UDJ--",fread($u,DelkaOtevirani("kosmetika/administrace")));
fclose($u);
//---------------------------------------------------------------------
echo
"<h4>Objedn�vky</h4>
Objedn�vky osobn� nebo na telefon�m ��sle: <b>{$udj[4]}</b><br>
viz.kontakt<br><br><br><u>Otev�rac� doba:</u><br>Pond�l� a� p�tek: 9:00 - 17:00 (nebo dle objedn�vek)<br>Sobota: dle objedn�vek";
?>
