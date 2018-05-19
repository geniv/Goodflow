<?php
//==============================================================================
// Name:        JPGENDB.PHP
// Description:	Use parsing classes to generate a documentation skeleton
// Created: 	01/12/03 
// Author:	johanp@aditus.nu
// Version: 	$Id: jpgendb.php,v 1.1 2002/04/20 19:31:32 aditus Exp $
//
// License:	QPL 1.0
// Copyright (C) 2002 Johan Persson
//
//==============================================================================
include("jplintphp.php");
include("jpdb.php");

class Log {
    var $iDisplayLog=false;  
      
    // Used to log action
    function ToScreen($aStr,$aLineBreak=true) {
    	if( $this->iDisplayLog ) {
	        echo "<font color=#FF0000>";
	        echo $aStr;
    	    echo "</font>";
	        if( $aLineBreak ) 
		        echo "<br>\n";
    	}
    }
}

$gLogger = new Log();

class DBFuncProp extends FuncProp {
    var $iKey="";
    var $iDesc="";
    var $iClassIdx="";
    var $iMethodRef=array();
    var $iArgsDes=array();
    var $iExample="";

    function DBFuncProp($aClassName,$aName,$aLineNbr,$aArgs,$aArgsVal,$aShortComment="") {
	    parent::FuncProp($aClassName,$aName,$aLineNbr,$aArgs,$aArgsVal,$aShortComment);
    }

    function Internalize($aDBRow) {
    }

    function Externalize($aDB,$aClassIdx="",$aKey="") {
	    $this->iClassIdx = $aClassIdx;

	    $q = "REPLACE INTO tbl_method SET ";
	    $q .= "fld_key='".$aKey."',";
	    $q .= "fld_name='".$this->iName."',";
	    $q .= "fld_linenbr='".$this->iLineNbr."',";
	    $q .= "fld_shortdesc='".mysql_escape_string($this->iShortComment)."',";
	    $q .= "fld_classidx='".$aClassIdx."',";
    	$q .= "fld_desc='".mysql_escape_string($this->iDesc)."',";
    	$q .= "fld_example='".mysql_escape_string($this->iExample)."',";
	
    	for( $i=1; $i<=4; ++$i ) {
	        $mref = '';
	        if( !empty($this->iMethodRef[$i-1]) )
        		$mref = $this->iMethodRef[$i-1];
	        $q .= "fld_methref$i='".$mref."',";
	    }
    	$q .= "fld_numargs=".$this->iNumArgs;
    	for( $i=1; $i<=$this->iNumArgs; ++$i ) {
	        $q .= ",fld_arg$i='".$this->iArgs[$i-1]."'"; 
    	}
	    for( $i=1; $i<=$this->iNumArgs; ++$i ) {
	        if( empty($this->iArgsDes[$i-1]) )
		        $argdes="";
	        else
		        $argdes = $this->iArgsDes[$i-1];
	        $q .= ",fld_argdes$i='".$argdes."'"; 
	    }
	    $aDB->query($q);
	    $this->iKey = $aDB->LastIdx();
	    return $this->iKey;
    }
}

class DBClassProp extends ClassProp {
    var $iKey="";
    var $iDesc="";

    function DBClassProp($aParent,$aName,$aLineNbr,$aFile) {
    	parent::ClassProp($aParent,$aName,$aLineNbr,$aFile);
    }

    function Internalize($aDBRow) {
    }

    function Externalize($aDB) {	    
    	// Check if this class already exist in the DB
	    $q  = "SELECT * FROM tbl_class WHERE ";
    	$q .= "fld_name='".$this->iName."'";
	    $res = $aDB->query($q);
    	if( $res->NumRows() > 0 ) {
	        $GLOBALS["gLogger"]->ToScreen( "Class '".$this->iName."' at line #".$this->iLineNbr." is already in database<br>" );
	        $row = $res->Fetch();
    	    if( !empty($row["fld_desc"]) )
	            $this->iDesc = $row["fld_desc"];
            $idx = $row["fld_key"];
   	        $this->ExternalizeClass($aDB,$idx);
	        $this->ExternalizeUpdateMethods($aDB,$idx);
	    }
    	else {
	        $GLOBALS["gLogger"]->ToScreen( "Adding class ".$this->iName );
	        $idx=$this->ExternalizeClass($aDB);
        	$this->ExternalizeMethods($aDB,$idx);
        }   
	    $this->ExternalizeVars($aDB,$idx);    
        return $idx;
    }
    
    function ExternalizeClass($aDB,$aKey="") {

	    $q  = "REPLACE INTO tbl_class SET ";
    	$q .= "fld_key='".$aKey."',";
    	$q .= "fld_name='".$this->iName."',";
	    $q .= "fld_parentname='".$this->iParent."',";
	    $q .= "fld_file='".$this->iFileName."',";
	    $q .= "fld_desc='".mysql_escape_string($this->iDesc)."',";
    	$q .= "fld_linenbr=".$this->iLineNbr." ";
    	$aDB->query($q);
    	$this->iKey = $aDB->LastIdx();
	
	    return $this->iKey;
    }

    function ExternalizeMethods($aDB,$aClassIdx) {
	    for( $m=0; $m<$this->iFuncNbr; ++$m) {
	        $func = $this->iFuncs[$m];
	        $func->Externalize($aDB,$aClassIdx);
    	}
    }
    
    function ExternalizeUpdateMethods($aDB,$aClassIdx) {
	    // Now get all the methods that is registred for this class
	    
	    $q = "SELECT * FROM tbl_method WHERE fld_classidx=$aClassIdx";
	    $methres = $aDB->query($q);
	    $nbrmeth = $methres->NumRows();
	    if( $nbrmeth > 0 ) {
	    	// Read all existing methods into 'oldfuncs'
		    $oldfuncs = array();
    		for($i=0; $i<$nbrmeth; ++$i) {
	    	    $oldfuncs[$i]=$methres->Fetch();
		        $exists[$i] = false;
    		}	
		    // Walk throught all the existing methods
    		for($i=0; $i<$this->iFuncNbr ; ++$i) {
	    	    $found = false;
		        $func = $this->iFuncs[$i];

		        // This unfortunately have to be an O(n^2) mathching ...
	    	    for($j=0; $j<count($oldfuncs) && !$found ; ++$j) {
		        	if( $oldfuncs[$j]["fld_name"] == $func->iName ) {
			            $found = true;
			            $exists[$j] = true;
    			        $oldfunc = $oldfuncs[$j];
            		}
		        }

		        if( !$found ) {
    	    		$exists[$j] = true;
	    	    	$GLOBALS["gLogger"]->ToScreen( " no. Adding it to DB." );
        			$func->Externalize($aDB,$aClassIdx);
		        }
		        else {
        			$GLOBALS["gLogger"]->ToScreen( " yes." );
		        	// Now check if any of the arguments have changed
    	    		$func = $this->UpdateArguments($func,$oldfunc);
	    	    	if( $func != false ) { 
			            $func->Externalize($aDB,$aClassIdx,$oldfunc["fld_key"]);
        			}
		        }
    		} // for

	    	// Delete no longer existing methods
		    for( $i=0; $i<count($oldfuncs); ++$i ) {
    		    if( empty($exists[$i]) || !$exists[$i] ) {
	        		$GLOBALS["gLogger"]->ToScreen( "Deleting  method ".$this->iName."::".$oldfuncs[$i]["fld_name"]."()" );
			        $q = "DELETE FROM tbl_method WHERE fld_key=".$oldfuncs[$i]["fld_key"];
        			$aDB->query($q);
		        }
    		}
	    } // if
    }

    function UpdateArguments($aNewFunc,$aOldFunc) {
	    // Sanity check
    	if( $aNewFunc->iName != $aOldFunc["fld_name"] )
	        die("internal error: UpdateArguments() Function name different!".$aNewFunc->iName." != ". $aOldFunc["fld_name"] );

	    $numoldargs=$aOldFunc["fld_numargs"];
    	$numnewargs=$aNewFunc->iNumArgs;

	    // Get the old descriptions and references
    	$aNewFunc->iDesc = empty($aOldFunc["fld_desc"]) ? "" : $aOldFunc["fld_desc"];
	    $aNewFunc->iShortDesc = empty($aOldFunc["fld_shortdesc"]) ? "" : $aOldFunc["fld_shortdesc"];
    	$aNewFunc->iExample = empty($aOldFunc["fld_example"]) ? "" : $aOldFunc["fld_example"];

	    for( $i=0; $i < 4 ; ++$i) {
	        $aNewFunc->iMethodRef[$i] = $aOldFunc["fld_methref".($i+1)];
	    }

    	// DB Optimization. If old args are the same as new then don't
	    // bother touching DB.
	    for($i=0; $i<$numoldargs; ++$i) {
	        $exists[$i] = false;
    	}
	    for($i=1; $i<=$numoldargs; ++$i) {
	        $arg = $aOldFunc["fld_arg$i"];
	        for( $j=0; $j<$numnewargs; ++$j) {
		        if( $aNewFunc->iArgs[$j] == $arg ) {
		            $exists[$i-1] = true;
		        }
	        }
	    }
	    if( $numoldargs == $numnewargs ) {
	        $allsame=true;
	        for( $i=0; $i<$numoldargs; ++$i) {
		        if( !$exists[$i] ) 
		            $allsame=false;
	        }
	        if( $allsame && ($aOldFunc["fld_linenbr"]==$aNewFunc->iLineNbr) ) { 
	            return false;
	        }
	    }
	
    	// Create the new set of arguments by combining the old existing
	    // one that is the same with the new one. 
	    for( $i=0; $i<$numnewargs; ++$i ) {
	        $newarg = $aNewFunc->iArgs[$i];
	        $aNewFunc->iArgsDes[$i] = "";
	        for( $j=0; $j<$numoldargs; ++$j ) {
		        $oldarg = $aOldFunc["fld_arg".($j+1)];
		        if( empty($aOldFunc["fld_argdes".($j+1)]) )
		            $oldargdes = "";
		        else
		            $oldargdes = $aOldFunc["fld_argdes".($j+1)];

		        if( $newarg==$oldarg ) {
		            $aNewFunc->iArgsDes[$i]  = $oldargdes;
		        }
	        }
	    }
	    return $aNewFunc;
    }

    
    function ExternalizeVars($aDB,$aClassIdx) {
	    // We just delete all exiting variables for this class and then
    	// add the new ones. This could be DB optimized to only
	    // delete variables that doesn't exist any more and just adding
    	// the new one but this is simpler!
	    $q = "DELETE FROM tbl_classvars WHERE fld_classidx=".$aClassIdx;
    	$res = $aDB->query($q);

        for( $i=0; $i < $this->iVarNbr; ++$i ) {
	        $q = "INSERT INTO tbl_classvars SET fld_key='',";
    	    $q .= "fld_name='".mysql_escape_string($this->iVars[$i][0])."',";
	        $q .= "fld_default='".mysql_escape_string($this->iVars[$i][1])."',";
	        $q .= "fld_classidx=".$aClassIdx;
    	    $aDB->query($q);
        }
    }    
}

class DBParser extends Parser {
    var $iLogNbr;
    var $iDB;
    var $iClassIdx=array();

    function DBParser($aFile,$aDB) {
	    $this->iDB = $aDB;
    	parent::Parser($aFile);
	    $this->iLogNbr = 0;
    }

    // Override Factory function for classes
    function &NewClassProp($aParent,$aName,$aLineNbr,$aFileName) {
	    return new DBClassProp($aParent,$aName,$aLineNbr,$aFileName);
    }
	
    // Override Factory function for methods
    function &NewFuncProp($aClassName,$aName,$aLineNbr,$aArgs,$aArgsVal,$aShortComment) {
	    return new DBFuncProp($aClassName,$aName,$aLineNbr,$aArgs,$aArgsVal,$aShortComment);
    }
    
    // Map function for global functions
    function MapFunc(&$aFunc) {
    	parent::MapFunc($aFunc);
	    $aFunc->Externalize($this->iDB);
    }

    // map function for classes
    function MapClass($aClass) {
	    $GLOBALS["gLogger"]->ToScreen( "<p>Mapping class '".$aClass->iName );
	    parent::MapClass($aClass);
	    $this->iClassIdx[$aClass->iName] = $aClass->Externalize($this->iDB);
    }
}


// Driver
class DBDriver extends Driver {
    var $iDB;

    function DBDriver($aFile) {
	    $this->iDB = new DBServer("root","");
    	$this->iDB->SetDB("jpgraph_doc");
	    parent::Driver($aFile);	
    }
	
    function NewParser($aFile) {
	    return new DBParser($aFile,$this->iDB);
    }
	
    function PostProcessing() {
    	parent::PostProcessing();
	    $res = $this->iParser->GetUnusedClassVariables();
    	if( trim($res!="") )
	        echo "<hr><h3>SUMMARY of unused instance variables</h3>$res";		
    	$res = $this->iParser->GetWarnings();
	    if( trim($res!="") )
	        echo "<hr><h3>SUMMARY of warnings</h3>$res";
    	$this->iDB->close();
    }		
}


//==========================================================================
// Script entry point
// Read URL argument and create Driver
//==========================================================================
if( !isset($HTTP_GET_VARS['target']) )
die("<b>No file specified.</b> Use 'mylintphp.php?target=file_name'" );	
$file = urldecode($HTTP_GET_VARS['target']);
$driver = new DBDriver($file);
$driver->Run();




?>





