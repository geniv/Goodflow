<?
$sou_ban="ban_weicuweiuvhoihnqpodwkjvnsjfnbvnqwiufehwiujefgvizuddkjsfh.php";
$u=fopen($sou_ban,"r");
$ban=explode("*--ban--*",fread($u,10000));
fclose($u);
for($p=0;$p<count($ban);$p++)
{
if($ban[$p]==$REMOTE_ADDR)
 { print "<br><br><br><br><br><h2 align=center>Na tyto str�nky m�te z�kaz vstupu!!</h2>";
 exit;}
}
          
$sb_hes="hes_sdcjaiuaiudfkkjdvoisdjvoisdjoisoisfoiassoiessdfsdfghsoihzfafoaiufauihcd.php";             
$u=fopen($sb_hes,"r");
$reg=explode("*---*",fread($u,1000));
fclose($u);
           
$pc=0;
for($p1=0;$p1<count($reg);$p1++)
{
if($reg[$p1]==$logjm and $reg[$p1+1]==$loghe){$pc++;}//rovn�-li se p�i�te se 1.
}   //end for
if($pc==1)
{
  echo "<b>V�tejte $logjm</b> na str�nk�ch Geniv web's v chr�n�n� sekci �kola.<br>";
    switch($logjm)
     { 
      case "Geniv";
       {$pozd="pane Administr�tore!";}
       break;
      case "Seveckova";
       {$pozd="pan� U�itelko!";}
      break;
      case "Doktor";
       {$pozd="Dacane!";}
      break;
      case "Rabbit";
       {$pozd="Iv�nku, kamar�de!";}
      break;
      
      default;
       {$pozd=$logjm;}
     }
    echo "Dobr� den $pozd";
   require "awetvetbfvkjasnmnrklvnfjsoijflsfnfiruhnykdmkcnfif.php";
}
else
{
 print "<br><br><br><br><br><br><br><br><h2 align=center>Bez hesla nem�te pr�vo pro p��stup na tuto str�nku!!</h2>";
}
?>
