<?
//---------------------------------------------------------------------
$soub="kadernictvi/administrace/udaje_kadernictvi_sdichnboipppjqqfqwoncoisnswdofcvnooiwvoiihwvohnwe.php";
$u=fopen($soub,"r");
$udj=explode("--UDJ--",fread($u,DelkaOtevirani("kadernictvi/administrace")));
fclose($u);
//---------------------------------------------------------------------
echo
"<h4>Objedn�vky</h4>
Objedn�vky osobn� nebo na telefon�m ��sle: <b>{$udj[2]}</b><br>
viz.kontakt<br><br><br><u>Otev�rac� doba:</u><br>Pond�l� a� p�tek: 9:00 - 17:00 (nebo dle objedn�vek)<br>Sobota: dle objedn�vek";
?>
