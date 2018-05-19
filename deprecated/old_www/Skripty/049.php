<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>049.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="black">
     </head>
     <body>
 <!-- 049.php -->
 <table align="center">
  <tr><th>Přepínací pole</th><th>Zaškrtávací pole</th></tr>
  <tr><th>&nbsp;</th><th>&nbsp;</th></tr>
  <tr><td valign="top">
  <fieldset>
    <blockquote>
      <form method="post">
        <legend accesskey="k"><font color="brown">Z<u>k</u>uste výběr:</font></legend>
        <input type=radio name="Penize" value="Dolary"
         <? if($Penize=="Dolary" || !$Penize) echo "checked"; ?>>&nbsp;&nbsp;Dolary<br>
        <input type=radio name="Penize" value="Libry"
         <? if($Penize=="Libry") echo "checked"; ?>>&nbsp;&nbsp;Libry<br>
        <input type=radio name="Penize" value="Eura"
         <? if($Penize=="Eura") echo "checked"; ?>>&nbsp;&nbsp;Eura&nbsp;&nbsp;
        <input type=submit value="Vyberte"><br>
      </form>
        <? if($Penize) echo "<font color=brown>Provedený výběr: $Penize.</font>"; ?>
    </blockquote>
  </fieldset>
  </td>
  <td valign="top">
    <fieldset>
      <blockquote>
        <form method="post">
          <legend accesskey="d">
            <font color="brown">Zkuste&nbsp;<u>d</u>alší výběr:</font>
          </legend>
          <input type=checkbox name="Penize2[]" value="Dolary"
           <? if($Penize2[0]=="Dolary") echo "checked"; ?>>&nbsp;&nbsp;Dolary<br>
          <input type=checkbox name="Penize2[]" value="Libry"
           <? if($Penize2[0]=="Libry" || $Penize2[1]=="Libry")
            echo "checked"; ?>>&nbsp;&nbsp;Libry<br>
          <input type=checkbox name="Penize2[]" value="Eura"
           <? // neefektivní, ale zde při malém počtu prvků dostačující kontrola
              if($Penize2[0]=="Eura" || $Penize2[1]=="Eura" || $Penize2[2]=="Eura")
            echo "checked"; ?>>&nbsp;&nbsp;Eura&nbsp;&nbsp;
          <input type=submit value="Vyberte"><br>
        </form>
        <? if($Penize2){
             echo "<font color=\"brown\">Provedený výběr: ";
             while(List($h1,$h2)=Each($Penize2)){ // první=index, druhá=hodnota
               if($h1>0) echo ", ";
               echo $h2;
             }
             echo ".</font>";
           }
        ?>
      </blockquote>
    </fieldset>
    </td>
   </tr> 
 </table>
     </body>
</html>
