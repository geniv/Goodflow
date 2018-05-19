<!--  otvdatab.php slouží - pouze pro oddìlení otvírání databáze -->
<?
@$spojeni = MySQL_Connect("",root,"");
if(!$spojeni):
  echo "Nepodaøilo se pøipojit k MySQL <br>";
  exit;
endif;
MySQL_Select_DB("priklad_db");
@$jmenatab = MySQL_List_Tables("priklad_db");
?>
