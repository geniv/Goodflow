<?
$host = "localhost";
$uziv = "root";
$heslo = "geniv";

print
"<br>
<a href=\"?action=edit\">klikni</a><br>
<a href=\"?action=reset\">vynuluj</a><br>
<a href=\"?action=new\">vytvor db</a><br>
<a href=\"?action=tab\">vytvor tabulku</a><br>
<a href=\"?action=newline\">vytvor ��dek</a><br>
";
$klik=0;
	if (!$con=mysql_connect($host, $uziv, $heslo))
	{
			print "DB nep�ipojena!<br>";
	}
		else
	{
		print "spojen� nav�z�no<br>";
//******************************************************************************
		if (!Empty($action))
		{
//******************************************************************************
			if ($action=="new") //vytvo�� datab�zi (slo�ku)
			{
				if (mysql_query("CREATE DATABASE `moje_db`;")) {
		        print ("Datab�ze byla vytvo�ena\n");
		    }
					else 
				{
		        printf ("Chyba p�i vytv��en� datab�ze: %s\n", mysql_error());
		    }
			}
//******************************************************************************
			if ($action=="tab") //vytvo�� tabulku (samotnou datab�zi)
			{
				mysql_db_query("moje_db", "create table pocet (id char(10), cislo int default 0);", $con) or 
				printf("Chyba p�i vytv��en� tabulky: %s", mysql_error());
			}
//******************************************************************************
			if ($action=="newline") //p�id� ��dek do tabulky
			{
				mysql_db_query("moje_db", "insert into pocet values ('prvni', 0);", $con) or 
				printf("Chyba p�i vytv��en� ��dku: %s", mysql_error());
			}
//******************************************************************************
			if ($action=="edit") //p�i�te k hodnot� +1
			{
				$nav=mysql_db_query("moje_db", "select cislo from pocet where id='prvni';", $con);
				$klik=mysql_fetch_array($nav);
				$klik["cislo"]++;
				mysql_db_query("moje_db", "update pocet set cislo={$klik["cislo"]} where id='prvni';", $con) or 
				printf("Chyba p�i uprav� hodnoty: %s", mysql_error());
			}
//******************************************************************************
			if ($action=="reset") //vynuluje
			{
				mysql_db_query("moje_db", "update pocet set cislo=0 where id='prvni';", $con) or 
				printf("Chyba p�i uprav� hodnoty: %s", mysql_error());
			}
//******************************************************************************
		}
			else
		{
			$nav=mysql_db_query("moje_db", "select cislo from pocet where id='prvni';", $con);
			$klik=mysql_fetch_array($nav);
			print_r($klik);
		}
//******************************************************************************
		$db_list = mysql_list_dbs();
		print "<br>datab�ze:<br>";
		$i = 0;
		$cnt = mysql_num_rows($db_list);
		while ($i < $cnt) {
		    print "<b>".mysql_db_name($db_list, $i)."</b><br>";
		    $i++;
		}
//******************************************************************************
//		$result = mysql_query("SELECT * FROM moje_db", $con);
//		print $num_rows = mysql_num_rows($result);


mysql_select_db("moje_db")
    or die("Nelze vybrat datab�zi");
// P��prava SQL dotazu
$query = "SELECT * FROM pocet;";
$result = mysql_query($query)
    or die("Dotaz nelze prov�st");

// Zobrazen� v�sledku v HTML
print "<br><table border=1>\n";
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    print "\t<tr>\n";
    foreach ($line as $col_value) {
        print "\t\t<td>$col_value</td>\n";
    }
    print "\t</tr>\n";
}
print "</table>\n";
//nebo def.0!!
	if (Empty($klik["cislo"]))
	{
		$cislo = 0;
	}
		else
	{
		$cislo = $klik["cislo"];
	}
  print "kliknuto: $cislo x";

		mysql_close($con);
	}

//mysql_select_db("poc");
//print @mysql_list_tables("poc");
//$poc=mysql_query("select * from poc;");
//$pol=mysql_fetch_array($con);
//print $pol;

/*
<script type="text/javascript">
// inspirace by Hugo v diskusi

function zkontrolujEmail(){
	if (window.RegExp) { 
		re = new RegExp("^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$"); 
		if (!re.test(document.getElementById("email").value)) { 
			window.alert("Emailov� adresa nem� spr�vn� form�t"); 
			return false; 
		} 
	}
}
</script>
*/

?>