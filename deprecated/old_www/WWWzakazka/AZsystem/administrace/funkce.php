<?

//******************************************************************************
function LengthOpenFile($where)
{
  $soubr = "$where/DelkaOtvirani_wfohvusdncshbfvjbhjjwepfonvbswgf.php";
  $u = fopen($soubr, "r");
  $navrat = fread($u, 1000);
  fclose($u);
  
  return $navrat;
}
//******************************************************************************

function FlashDefault()
{
  $text = "<script type=\"text/javascript\">
              	if (AC_FL_RunContent == 0) {
              		alert(\"This page requires AC_RunActiveContent.js.\");
              	} else {
              		AC_FL_RunContent(
              			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0',
              			'width', '780',
              			'height', '174',
              			'src', 'js21_1_default',
              			'quality', 'best',
              			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
              			'align', 'middle',
              			'play', 'true',
              			'loop', 'false',
              			'scale', 'showall',
              			'wmode', 'opaque',
              			'devicefont', 'false',
              			'id', 'js21_1_default',
              			'bgcolor', '#ffffff',
              			'name', 'js21_1_default',
              			'menu', 'false',
              			'allowFullScreen', 'false',
              			'allowScriptAccess','sameDomain',
              			'movie', 'js21_1_default',
              			'salign', ''
              			);
              	}
              </script>
              <!--[if IE]>
                <noscript>
                	<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\" width=\"780\" height=\"174\" id=\"js21_1_default\">
                  <param name=\"allowScriptAccess\" value=\"sameDomain\" />
                	<param name=\"allowFullScreen\" value=\"false\" />
                	<param name=\"movie\" value=\"js21_1_default.swf\" /><param name=\"loop\" value=\"false\" /><param name=\"menu\" value=\"false\" /><param name=\"quality\" value=\"best\" /><param name=\"wmode\" value=\"opaque\" /><param name=\"bgcolor\" value=\"#ffffff\" />	<embed src=\"js21_1_default.swf\" loop=\"false\" menu=\"false\" quality=\"best\" wmode=\"opaque\" bgcolor=\"#ffffff\" width=\"780\" height=\"174\" name=\"js21_1_default\" align=\"middle\" allowScriptAccess=\"sameDomain\" allowFullScreen=\"false\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" />
                	</object>
                </noscript>
              <![endif]-->";
  return $text;
}

function FlashNormal()
{
  $text = "<script type=\"text/javascript\">
              	if (AC_FL_RunContent == 0) {
              		alert(\"This page requires AC_RunActiveContent.js.\");
              	} else {
              		AC_FL_RunContent(
              			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0',
              			'width', '780',
              			'height', '174',
              			'src', 'js21_1',
              			'quality', 'best',
              			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
              			'align', 'middle',
              			'play', 'true',
              			'loop', 'false',
              			'scale', 'showall',
              			'wmode', 'opaque',
              			'devicefont', 'false',
              			'id', 'js21_1',
              			'bgcolor', '#ffffff',
              			'name', 'js21_1',
              			'menu', 'false',
              			'allowFullScreen', 'false',
              			'allowScriptAccess','sameDomain',
              			'movie', 'js21_1',
              			'salign', ''
              			);
              	}
              </script>
              <!--[if IE]>
                <noscript>
                	<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\" width=\"780\" height=\"174\" id=\"js21_1\">
                	<param name=\"allowScriptAccess\" value=\"sameDomain\" />
                	<param name=\"allowFullScreen\" value=\"false\" />
                	<param name=\"movie\" value=\"js21_1.swf\" /><param name=\"loop\" value=\"false\" /><param name=\"menu\" value=\"false\" /><param name=\"quality\" value=\"best\" /><param name=\"wmode\" value=\"opaque\" /><param name=\"bgcolor\" value=\"#ffffff\" />	<embed src=\"js21_1.swf\" loop=\"false\" menu=\"false\" quality=\"best\" wmode=\"opaque\" bgcolor=\"#ffffff\" width=\"780\" height=\"174\" name=\"js21_1\" align=\"middle\" allowScriptAccess=\"sameDomain\" allowFullScreen=\"false\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" />
                	</object>
                </noscript>
              <![endif]-->";
  return $text;
}

/*
              <!--[if IE]>
                <noscript>
                	<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\" width=\"780\" height=\"174\" id=\"js21_1_default\">
                  <param name=\"allowScriptAccess\" value=\"sameDomain\" />
                	<param name=\"allowFullScreen\" value=\"false\" />
                	<param name=\"movie\" value=\"js21_1_default.swf\" /><param name=\"loop\" value=\"false\" /><param name=\"menu\" value=\"false\" /><param name=\"quality\" value=\"best\" /><param name=\"wmode\" value=\"opaque\" /><param name=\"bgcolor\" value=\"#ffffff\" />	<embed src=\"js21_1_default.swf\" loop=\"false\" menu=\"false\" quality=\"best\" wmode=\"opaque\" bgcolor=\"#ffffff\" width=\"780\" height=\"174\" name=\"js21_1_default\" align=\"middle\" allowScriptAccess=\"sameDomain\" allowFullScreen=\"false\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" />
                	</object>
                </noscript>
              <![endif]-->
              --------------------------------------------------------------------------------
              <!--[if IE]>
                <noscript>
                	<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\" width=\"780\" height=\"174\" id=\"js21_1\">
                	<param name=\"allowScriptAccess\" value=\"sameDomain\" />
                	<param name=\"allowFullScreen\" value=\"false\" />
                	<param name=\"movie\" value=\"js21_1.swf\" /><param name=\"loop\" value=\"false\" /><param name=\"menu\" value=\"false\" /><param name=\"quality\" value=\"best\" /><param name=\"wmode\" value=\"opaque\" /><param name=\"bgcolor\" value=\"#ffffff\" />	<embed src=\"js21_1.swf\" loop=\"false\" menu=\"false\" quality=\"best\" wmode=\"opaque\" bgcolor=\"#ffffff\" width=\"780\" height=\"174\" name=\"js21_1\" align=\"middle\" allowScriptAccess=\"sameDomain\" allowFullScreen=\"false\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" />
                	</object>
                </noscript>
              <![endif]-->
*/
