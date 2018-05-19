<?
$sou_ban="ban_weicuweiuvhoihnqpodwkjvnsjfnbvnqwiufehwiujefgvizuddkjsfh.php";
$u=fopen($sou_ban,"r");
$ban=explode("*--ban--*",fread($u,10000));
fclose($u);
for($p=0;$p<count($ban);$p++)
{
if($ban[$p]==$REMOTE_ADDR)
 { print "<br><br><br><br><br><h2 align=center>Na tyto stránky máte zákaz vstupu!!</h2>";
 exit;}
}
          
$sb_hes="hes_sdcjaiuaiudfkkjdvoisdjvoisdjoisoisfoiassoiessdfsdfghsoihzfafoaiufauihcd.php";             
$u=fopen($sb_hes,"r");
$reg=explode("*---*",fread($u,1000));
fclose($u);
           
$pc=0;
for($p1=0;$p1<count($reg);$p1++)
{
if($reg[$p1]==$logjm and $reg[$p1+1]==$loghe){$pc++;}//rovná-li se pøiète se 1.
}   //end for
if($pc==1)
{
  echo "<b>Vítejte $logjm</b> na stránkách Geniv web's v chránìné sekci Škola.<br>";
    switch($logjm)
     { 
      case "Geniv";
       {$pozd="pane Administrátore!";}
       break;
      case "Seveckova";
       {$pozd="paní Uèitelko!";}
      break;
      case "Doktor";
       {$pozd="Dacane!";}
      break;
      case "Rabbit";
       {$pozd="Ivánku, kamaráde!";}
      break;
      
      default;
       {$pozd=$logjm;}
     }
    echo "Dobrý den $pozd";
   require "awetvetbfvkjasnmnrklvnfjsoijflsfnfiruhnykdmkcnfif.php";
}
else
{
 print "<br><br><br><br><br><br><br><br><h2 align=center>Bez hesla nemáte právo pro pøístup na tuto stránku!!</h2>";
}
?>
