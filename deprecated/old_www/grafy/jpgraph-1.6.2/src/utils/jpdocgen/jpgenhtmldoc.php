<?php
//==============================================================================
// Name:        JPGENHTMLDOC.PHP
// Description:	Implements a HTML plugin for the reference framework as 
//              specified in jpclassref.php
// Created: 	2002-04-14 
// Author:	    johanp@aditus.nu
// Version: 	$Id: jpgenhtmldoc.php,v 1.1 2002/04/20 19:31:32 aditus Exp $
//
// License:	    QPL 1.0
// Copyright (C) 2002 Johan Persson
//
//==============================================================================

include ( "jpclassref.php" );

// Basic HTML Class formatter
class ClassHTMLFormatter extends ClassFormatter {
	var $iNumClasses,$iClassCnt,$iNumMethods,$iMethCnt;
	var $iCol;

    function FmtClassHierarchySetup($aHier,$aNbr) {
        echo "<table border=1>";
    }

    function FmtClassHierarchyExit($aHier,$aNbr) {
        echo "</tr></table>";
    }

    function FmtClassHierarchyHeaders($aHier,$aNbr) {
        echo "<tr>";
        for( $i=0; $i<$aNbr; ++$i ) {
            echo "<td><b>&nbsp;".$aHier[$i]."&nbsp;</b></td>";          
        }
        echo "</tr><tr>";
    }
    
    function FmtClassHierarchyColumnSetup($aClassName,$aColNbr) {
        echo "<td valign=top>";
    }

    function FmtClassHierarchyColumnExit($aClassName,$aColNbr) {
        echo "</td>";
    }
    
    function FmtClassHierarchyRow($aClassName,$aMethodName,$aOverridden,$aPublic) {
        if( $aMethodName == "" )
            echo "&nbsp;";
        else {
            if( $aPublic ) {
                if($aOverridden) {
                    echo "&nbsp;<font color=gray>".$aMethodName."()&nbsp;</font><br>\n";
                }
                else { 
                    echo "&nbsp;".
                         "<a href=\"#".strtoupper("_".$aClassName."_".$aMethodName)."\">".
                         $aMethodName."()</a>&nbsp;<br>\n";
                }
            }
        }        
    }
    
    function FmtClassSetup($aClassInfo) {
        
	    $res = "<hr><a name=\"".strtoupper("_C_".$aClassInfo["fld_name"])."\"><div style=\"background-color:yellow;font-family:courier new;\"></a>";
	    $res .= "CLASS <b>".$aClassInfo["fld_name"]."</b>";
	    if( $aClassInfo["fld_parentname"] != "" )
	        $res .= " EXTENDS <a href=\"#".strtoupper("_C_".$aClassInfo["fld_parentname"])."\">".$aClassInfo["fld_parentname"]."</a>";
	    $res .= "</div>\n";
	    $res .= "<i>(Defined in: ".$aClassInfo['fld_file']." : $aClassInfo[fld_linenbr])</i>";
        echo $res;
    }            
    
    function FmtClassOverview($aClassInfo) {
        echo "&nbsp;<p><div style=\"font-weight:bold;font-family:arial;font-size:100%;\">Class usage and Overview</div>";        
        echo $aClassInfo["fld_desc"]."<br>";                 
    }
    
    function FmtClassVars($aVars) {
    	$res =  "<table border=0>\n";
	    for($i=0; $i<count($aVars); ++$i) {
	        $res .= "<tr><td valign=top>";
    	    // highlight_string is buggy so we add ';' to be able to parse a 
	        // single variable.
	        $t = $aVars[$i]["fld_name"];
    	    $t = "<?php $t?>";
	        ob_start();
	        highlight_string($t);
    	    $t = ob_get_contents();	
	        ob_end_clean();
	        $t=str_replace('&lt;?php&nbsp;','',$t);
    	    $t=str_replace('?&gt;','',$t);
	        $res .= "<span style=\"font-family:times;font-size:85%;font-weight:bold;\">$t</span>\n";	    
    	    $res .= "</td></tr>\n";
	    }
    	$res .= "</table>\n";
	    echo $res;
    }

    function FmtFuncPrototype($aClassName,$aFunc) {        
    	$t="function ".$aFunc["fld_name"]."(";
	    for($i=0; $i<$aFunc["fld_numargs"]; ++$i) {
	        if( $i != 0 ) $t .= ",";
    	        $t .= $aFunc["fld_arg".($i+1)];
	    }
	    $t .= ")";
	    $t  = Utils::HighlightCodeSnippet($t);
	    $t  = "<a name=\"".strtoupper("_".$aClassName."_".$aFunc["fld_name"])."\">".$t."</a>\n";
	    $t .= "<i>".$aFunc["fld_shortdesc"]."</i><p>\n";
	    echo $t;
    }
    
    function FmtFuncArgs($aFunc)  {
    	if( $aFunc["fld_numargs"] == 0 ) 
    	    return "<br>\n";
    	    
	    $res =  "<table border=0>\n";
    	for($i=0; $i<$aFunc["fld_numargs"]; ++$i) {
	        $res .= "<tr><td valign=bottom>";
	        // highlight_string is buggy so we add ';' to be able to parse a 
    	    // single variable.
	        $t = $aFunc["fld_arg".($i+1)];
	        $t = "<?php $t?>";
    	    ob_start();
	        highlight_string($t);
	        $t = ob_get_contents();	
    	    ob_end_clean();
	        $t=str_replace('&lt;?php&nbsp;','',$t);
	        $t=str_replace('?&gt;','',$t);
    	    $res .= "<span style=\"font-family:times;font-size:85%;font-weight:bold;\">$t</span>\n";
	        $res .= "</td><td valign=top>&nbsp;</td><td>".$aFunc["fld_argdes".($i+1)]."</td></tr>\n";
	    }
	    $res .= "</table>\n";
	    echo $res;
    }
    
    function FmtFuncDesc($aFunc) {
        echo "<br>\n";
        echo "<div style=\"font-weight:bold;font-family:arial;font-size:85%;\">Description</div>";                     
        echo $aFunc["fld_desc"]."&nbsp;<br>\n";
    }

    function FmtFuncRef($aRef) {
        echo "<div style=\"font-weight:bold;font-family:arial;font-size:85%;\"><p>See also</div>";                                             
        $m = count($aRef);
        for( $i=0; $i < $m; ++$i ) {
            list($cname,$mname) = $aRef[$i];
            echo "<a href=\"#".strtoupper("_".$cname."_".$mname)."\">".$cname."::".$mname."</a>";
            if( $i < $m-1 ) 
                echo ", ";
        }                  
    }       
    
    function FmtFuncExample($aFunc) {
        if( $aFunc["fld_example"] != "" ) {                
            echo "\n<div style=\"font-weight:bold;font-family:arial;font-size:85%;\"><p>Example</div>";                     
            echo Utils::HighlightCodeSnippet($aFunc["fld_example"],false)."<br>\n";        
        }    
    }  
    
    function FmtIndexSetup($aNumClasses,$aNumMethods) {
    	echo "<h2>Class reference</h2>";
    	$this->iNumClasses = $aNumClasses;
    	$this->iNumMethods = $aNumMethods;
    	$this->iCol = 1;
    	$this->iClassCnt = 0;
    	$this->iMethCnt = 0;
    	echo "<table width=100%><tr><td valign=top width=30%>";
    }
    
    function FmtIndexClass($aClassName) {
    	$this->iClassCnt++;
    	if( $this->iClassCnt > floor($this->iNumClasses/3) || $this->iMethCnt >= $this->iNumMethods/3 ) {
    		if( $this->iCol < 3 ) {
    			echo "</td><td valign=top width=30%>";
    			$this->iClassCnt = 0;
    			$this->iMethCnt = 0;
    		}
		}
		echo "<h3><a href=\"#".strtoupper("_C_$aClassName")."\">$aClassName</a></h3>";    	
   	}
   	
   	function FmtIndexMethod($aClassName,$aMethodName) {
   		$this->iMethCnt++;
   		echo "<b>.&nbsp;.&nbsp;.&nbsp;<a href=\"#".strtoupper("_".$aClassName."_".$aMethodName)."\">$aMethodName</a></b><br>";
    }

    function FmtIndexExit() {
		echo "</td></tr></table><p>";   
    }
}


class HTMLDriver extends Driver {
    // Factory function
    function NewClassFormatter($aDBCache,$aFlags) {
        return new ClassHTMLFormatter($aDBCache,$aFlags);
    }
}


//==========================================================================
// Script entry point
// Read URL argument and create Driver
//==========================================================================
if( !isset($HTTP_GET_VARS['class']) )
    $class = "";
else
    $class = urldecode($HTTP_GET_VARS['class']);
$driver = new HTMLDriver();
$driver->Run($class,FMT_CLASSVARS);
?>