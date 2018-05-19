    <html>
	<!-- Creation date: 1/1/2002 -->
    <head>
<script> 
<!-- 
function 
mahfocus(){document.nothing.message.focus();} 
// --> 
</script>
    <title>Chat</title>
    </head>
    <body bgcolor="#ffffff" text="#000000" link="#0000ff" vlink="#800080" alink="#ff0000" onLoad=mahfocus()>
    <?
    $person = str_replace ("\n"," ", $person);
    $person = str_replace ("<", " ", $person);
    $person = str_replace (">", " ", $person);
	$color = str_replace ("\n"," ", $color);
    $color = str_replace ("<", " ", $color);
    $color = str_replace (">", " ", $color);
	$font = str_replace ("\n"," ", $font);
    $font = str_replace ("<", " ", $font);
    $font = str_replace (">", " ", $font);
    $person = stripslashes ($person);
	$color = stripslashes ($color);
	$font = stripslashes ($font);
	$color = stripslashes ($color);
    ?>
	<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td valign="top" width="50%">
    <tr><td valign="top">
	<form name="nothing" action="chat1.php" method="post">
    <b>Nickname:</b><input type="text" name="person" size="20" maxlength="80" value="<? echo $person; ?>"><br>
    </td><td valign="top" rowspan="2">
	<b><u>Chat Settings:</u></b><br>
	<b>Font:</b> <input type="text" name="font" size="20" maxlength="80" value="<? echo $font; ?>"><br>
	<b>Font Color:</b> <input type="text" name="color" size="20" maxlength="80" value="<? echo $color; ?>"> <A href="color.html" target="_blank">List of colors</a><br>
	<A href="smilies.html" target="_blank">List of smilies</a><br>
	<A href="links.html" target="_blank">How to insert a link</a><br>
	</td></tr><tr><td valign="top">
	<b>Your message:</b><br><input name="message" size="40" type="text"></textarea>
    <input type="submit" value="Send Message">
	</td></tr></table>
	<?
    $chat_file_ok = "msg.txt";
    $chat_lenght = 0;
    $max_single_msg_lenght = 100000;
    $max_file_size = $chat_lenght * $max_single_msg_lenght;
    $file_size= filesize($chat_file);
    			
    if ($file_size > $max_file_size) {
    $lines = file($chat_file_ok);
    $a = count($lines);
    $u = $a - $chat_lenght;
    for($i = $a; $i >= $u ;$i--){
    		$msg_old = $lines[$i] . $msg_old;
    	}
    $deleted = unlink($chat_file_ok);
    $fp = fopen($chat_file_ok, "a+");
    $fw = fwrite($fp, $msg_old);
    fclose($fp);
    }
    $msg = str_replace ("\n"," ", $message);
    $msg = str_replace ("\n"," ", $message);
    $msg = str_replace ("<", " ", $msg);
    $msg = str_replace (">", " ", $msg);
	$msg = str_replace ("[a1]", "<a target =\"_blank\" href=\"", $msg);
	$msg = str_replace ("[a2]", "\"> ", $msg);
	$msg = str_replace ("[a3]", "</a>", $msg);
	$msg = str_replace (":)", "<img src=\"icon_smile.gif\">", $msg);
	$msg = str_replace (":-)", "<img src=\"icon_smile.gif\">", $msg);
	$msg = str_replace (":smile:", "<img src=\"icon_smile.gif\">", $msg);
	$msg = str_replace (":D", "<img src=\"icon_biggrin.gif\">", $msg);
	$msg = str_replace (":-D", "<img src=\"icon_biggrin.gif\">", $msg);
	$msg = str_replace (":grin:", "<img src=\"icon_biggrin.gif\">", $msg);
	$msg = str_replace (":(", "<img src=\"icon_frown.gif\">", $msg);
	$msg = str_replace (":-(", "<img src=\"icon_frown.gif\">", $msg);
	$msg = str_replace (":sad:", "<img src=\"icon_frown.gif\">", $msg);
	$msg = str_replace (":o", "<img src=\"icon_eek.gif\">", $msg);
	$msg = str_replace (":-o", "<img src=\"icon_eek.gif\">", $msg);
	$msg = str_replace (":eek:", "<img src=\"icon_eek.gif\">", $msg);
	$msg = str_replace (":-?", "<img src=\"icon_confused.gif\">", $msg);
	$msg = str_replace (":???:", "<img src=\"icon_confused.gif\">", $msg);
	$msg = str_replace ("8)", "<img src=\"icon_cool.gif\">", $msg);
	$msg = str_replace ("8-)", "<img src=\"icon_cool.gif\">", $msg);
	$msg = str_replace (":cool:", "<img src=\"icon_cool.gif\">", $msg);
	$msg = str_replace (":lol:", "<img src=\"icon_lol.gif\">", $msg);
	$msg = str_replace (":x", "<img src=\"icon_mad.gif\">", $msg);
	$msg = str_replace (":-x", "<img src=\"icon_mad.gif\">", $msg);
	$msg = str_replace (":mad:", "<img src=\"icon_mad.gif\">", $msg);
	$msg = str_replace (":p", "<img src=\"icon_razz.gif\">", $msg);
	$msg = str_replace (":-p", "<img src=\"icon_razz.gif\">", $msg);
	$msg = str_replace (":razz:", "<img src=\"icon_razz.gif\">", $msg);
	$msg = str_replace (":oops:", "<img src=\"icon_redface.gif\">", $msg);
	$msg = str_replace (":cry:", "<img src=\"icon_cry.gif\">", $msg);
	$msg = str_replace (":evil:", "<img src=\"icon_evil.gif\">", $msg);
	$msg = str_replace (":roll:", "<img src=\"icon_rolleyes.gif\">", $msg);
	$msg = str_replace (":wink:", "<img src=\"icon_wink.gif\">", $msg);
	$msg = str_replace (";)", "<img src=\"icon_smile.gif\">", $msg);
	$msg = str_replace (";-)", "<img src=\"icon_smile.gif\">", $msg);
    $msg = stripslashes ($msg);		
    if ($msg != ""){
    $fp = fopen($chat_file_ok, "a+");
    $fw = fwrite($fp, "\n<font face=\"$font\" color=\"$color\"><b>$person :</b> $msg</a><br></font>");
    fclose($fp);
    }
    $lines = file($chat_file_ok);
    $a = count($lines);
    $u = $a - $chat_lenght;
    for($i = $a; $i >= $u ;$i--){
    		echo $lines[$i] . "<br>";
    	}
    ?>
    </form>
    </body>
    </html>

