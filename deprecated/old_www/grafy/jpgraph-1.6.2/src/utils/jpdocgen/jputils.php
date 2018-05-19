<?php
//==============================================================================
// Name:        JPUTILS.PHP
// Description:	Some utility methods organized as static methods
// Created: 	2002-04-14 
// Author:	    johanp@aditus.nu
// Version: 	$Id: jputils.php,v 1.1 2002/04/20 19:31:32 aditus Exp $
//
// License:	QPL 1.0
// Copyright (C) 2001,2002 Johan Persson
//
//==============================================================================

class Utils {

    function HighlightCodeSnippet($t,$bg=true) {
        $t = "<?php $t?>";
        ob_start();
        highlight_string($t);
        $t = ob_get_contents();	
        ob_end_clean();
        $t=str_replace('&lt;?php&nbsp;','',$t);
        $t=str_replace('?&gt;','',$t);
        if( $bg ) {
	        $t = "<div style=\"background-color:#D1D1D1;font-family:courier new;font-size:85%;font-weight:bold;\"><b>$t</b></div>";
        }
        else {
	        $t = "<span style=\"font-family:courier;font-size:85%;font-weight:bold;\">$t</span>";
        }
        return $t;
    }
    
    function Error($aMsg) {
        die( "<font color=red><b>Error:</b></font> $aMsg" );
    }
    
    function Warning($aMsg) {
        echo "<font color=red><b>Warning:</b></font> $aMsg";
    }
    
}

?>
