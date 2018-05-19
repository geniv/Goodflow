<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>098.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 098.php -->
<?
@$spojeni = MySQL_Connect("xxx","ccc","ccc");
if(!$spojeni):
  echo "Nepodařilo se připojit k MySQL <br>";
  exit;
endif;
?>
     </body>
</html>
