<!--  otvdatab.php slou�� - pouze pro odd�len� otv�r�n� datab�ze -->
<?
@$spojeni = MySQL_Connect("",root,"");
if(!$spojeni):
  echo "Nepoda�ilo se p�ipojit k MySQL <br>";
  exit;
endif;
MySQL_Select_DB("priklad_db");
@$jmenatab = MySQL_List_Tables("priklad_db");
?>
