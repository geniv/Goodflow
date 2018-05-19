<?
require "administrace/funkce.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<link rel="stylesheet" href="fugess-f-z.css" type="text/css">
<style type="text/css">
<!--


/* General font families for common tags */
font,th,td,p { font-family: Verdana, Arial, Helvetica, sans-serif }
p, td { font-size : 11; color : #FFFFFF; }
h1 { font-family: "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; font-size : 20px; font-weight : bold; text-decoration : none; line-height : 120%; color : #FFFFFF;}
h2 { font-family: "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; font-size : 18px; font-weight : bold; text-decoration : none; line-height : 120%; color : #FFFFFF;}
h3 { font-family: "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; font-size : 16px; font-weight : bold; text-decoration : none; line-height : 120%; color : #FFFFFF;}


/* The largest text used in the index page title and toptic title etc. */
.maintitle	{
			font-weight: bold; font-size: 22px; font-family: "Trebuchet MS",Verdana, Arial, Helvetica, sans-serif;
			text-decoration: none; line-height : 120%;
}

/* General text */
.gen { font-size : 12px; }
.genmed { font-size : 11px; }
.gensmall { font-size : 10px; }


/* The register, login, search etc links at the top of the page */
.mainmenu		{ font-size : 11px; }

/* Forum category titles */
.cattitle		{ font-weight: bold; font-size: 12px; }

/* Forum title: Text and link to the forums used in: index.php */
.forumlink		{ font-weight: bold; font-size: 12px; }

/* Used for the navigation text, (Page 1,2,3 etc) and the navigation bar when in a forum */
.nav			{ font-weight: bold; font-size: 11px; }

/* Name of poster in viewmsg.php and viewtopic.php and other places */
.name			{ font-size : 11px; }

/* Location, number of posts, post date etc */
.postdetails		{ font-size : 10px; }


/* The content of the posts (body of text) */
.postbody { font-size : 12px; }


/* Form elements */
input,textarea, select {
	font: normal 11px;
}

input { text-indent : 2px; }

/* The buttons used for bbCode styling in message post */
input.button {
	font-size: 11px;
}

.ic_lista
{
visibility: hidden;
background-color: #BDD0EE;
position:absolute;
top:-100px;
}

/* Import the fancy styles for IE only (NS4.x doesn't use the @import function) */
@import url("fugess_form.css");
-->
</style>


<title>CZ & SK Trainz Tutorial</title>
</head>
<div class="ic_lista">
<body bgcolor="#BDD0EE" text="#000000" link="#A3C8FF" vlink="#579AFF">
</div>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
<tr>
<td width="0%" class="mainboxLefttop"><img src="images/spacer.gif" width="17px" height="17px"></td>
<td width="90%" class="mainboxTop"><img src="images/spacer.gif" height="17px"></td>
<td width="0%" class="mainboxRighttop"><img src="images/spacer.gif" width="17px" height="17px"></td>
</tr>

<tr>
<td width="0%" class="mainboxLeft"><img src="images/spacer.gif" width="17px"></td>

<td width="100%" class="mainbox">
<table width="100%" cellpadding="0" border="0">
<tr>
<td align="center" width="100%" valign="top" colspan="2"><span class="maintitle"><img src="images/logo_cz_sk_trainz_tutorial.jpg" border="0"></span></td>
</tr>

<tr>
<td valign="top">

<table border="0" cellspacing="0" cellpadding="0" align="left" valign="top">
 <tr>
  <td colspan="3"><img src="images/menu/vrsek.jpg"></td>
 </tr>
 <tr>
  <td><img src="images/menu/raoa.jpg"></td>
  <td><a href="index.php?kam=uvod&str=1"><img src="images/menu/raob.jpg" border="0"></a></td>
  <td><img src="images/menu/raoc.jpg"></td>
 </tr>
 <tr>
  <td colspan="3"><img src="images/menu/rboa.jpg"></td>
 </tr>
 <tr>
  <td><img src="images/menu/rcoa.jpg"></td>
  <td><a href="index.php?kam=navody&str=1"><img src="images/menu/rcob.jpg" border="0"></a></td>
  <td><img src="images/menu/rcoc.jpg"></td>
 </tr>
 <tr>
  <td colspan="3"><img src="images/menu/rdoa.jpg"></td>
 </tr>
 <tr>
  <td><img src="images/menu/reoa.jpg"></td>
  <td><a href="index.php?kam=odkazy"><img src="images/menu/reob.jpg" border="0"></a></td>
  <td><img src="images/menu/reoc.jpg"></td>
 </tr>
 <tr>
  <td colspan="3"><img src="images/menu/rfoa.jpg"></td>
 </tr>
 <tr>
  <td><img src="images/menu/rgoa.jpg"></td>
  <td><a href="index.php?kam=kontakt"><img src="images/menu/rgob.jpg" border="0"></a></td>
  <td><img src="images/menu/rgoc.jpg"></td>
 </tr>
 <tr>
  <td colspan="3"><img src="images/menu/spodek.jpg"></td>
 </tr>
</table>
</td>
<td class="mainboxobsah" width="90%" valign="top">


<table border="0" cellspacing="0" cellpadding="0" align="center" width="70%">
<tr>
<td height="6px"></td>
</tr>
</table>


<?
if(Empty($kam))
{require "uvod.php";}
else
{require "$kam.php";}

?>

</td>
</tr>




</td>
</tr>
</table>

</td>
<td width="0%" class="mainboxRight"><img src="images/spacer.gif" width="17px"></td>
</tr>
<tr>
<td width="0%" class="mainboxLeftbottom" border="0"><img src="images/spacer.gif" width="17px" height="18px" border="0"></td>
<td width="100%" class="mainboxBottom" border="0"><img src="images/spacer.gif" height="18px" border="0"></td>
<td width="0%" class="mainboxRightbottom" border="0"><a href="administrace" border="0"><img src="images/spacer.gif" width="17px" height="18px" border="0"></a></td>
</tr>
</table>


</tr>
</table>







</body>
</html>
