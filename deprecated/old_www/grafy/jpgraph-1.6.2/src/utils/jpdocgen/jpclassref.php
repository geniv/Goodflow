<?php
//==============================================================================
// Name:        JPCLASSREF.PHP
// Description:	Basic framework to extract information about class hierarchi
//              and structure from DB. To do specific output this framework
//              expects a "formatter" plugin which handles the actual 
//              layout and formatting of class, functions and variables.
//              See jpgenhtmldoc.php for example on how to write a simple
//              HTML formatter.
// Created: 	2002-04-12 
// Author:	    johanp@aditus.nu
// Version: 	$Id: jpclassref.php,v 1.1 2002/04/20 19:31:32 aditus Exp $
//
// License:	QPL 1.0
// Copyright (C) 2001,2002 Johan Persson
//
//==============================================================================
include("jpdb.php");
include_once("jputils.php");

DEFINE("MAX_METHODREF",5);
DEFINE("MAX_METHODARGS",10);


class DBCache {
    var $iDB;
    var $iClasses, $iClassesByName, $iClassMethods, $iClassMethodsByName;
    var $iMethods;
    function DBCache($aDB) {
        $this->iDB = $aDB;
    }
    
    function RefreshMethods() {
        $q = "SELECT * FROM tbl_method ORDER BY fld_name";
        $res = $this->iDB->query($q);
        $n = $res->NumRows();
        $this->iMethods = array();
        $this->iClassMethods = array();
        $this->iClassMethodsByName = array();
        for( $i=0; $i < $n; ++$i ) {
            $row = $res->Fetch();
            if( empty( $this->iClasses[$row["fld_classidx"]] ) )
                $classname = "";
            else
                $classname = $this->iClasses[$row["fld_classidx"]][0];
            $this->iMethods[$row["fld_key"]] = array($classname,$row["fld_name"],$row["fld_public"]);        
            $this->iClassMethods[$classname][] = array($row["fld_name"],$row["fld_public"]);
            $this->iClassMethodsByName[$classname][$row["fld_name"]] = array($row["fld_name"],$row["fld_public"]);            
        }
    }
    
    function RefreshClasses() {
        $q = "SELECT fld_key, fld_name, fld_parentname FROM tbl_class ORDER BY fld_name";
        $res = $this->iDB->query($q);
        $n = $res->NumRows();
        $this->iMethods = array();
        for( $i=0; $i < $n; ++$i ) {
            $row = $res->Fetch();
            $this->iClasses[$row["fld_key"]] = array($row["fld_name"],$row["fld_parentname"]);        
            $this->iClassesByName[$row["fld_name"]] = array($row["fld_key"],$row["fld_parentname"]);        
        }
    }
    
}    

DEFINE("FMT_CLASSVARS",1);

class ClassFormatter {
    var $iDBCache;
    var $iFlags;
        
    function ClassFormatter($aDBCache,$aFlags="") {
        $this->iDBCache = $aDBCache;
        $this->iFlags = $aFlags;
    }
    
    // Empty stubs ("virtual functions")
    // A subclass needs to override this methods to actual achieve the
    // desired formatting. The framework will call these formatting
    // functions at the appropriate time.
    
    function FmtClassHierarchySetup($aHier,$aNbr) {}
    function FmtClassHierarchyExit($aHier,$aNbr) {}
    function FmtClassHierarchyHeaders($aHier,$aNbr) {}    
    function FmtClassHierarchyColumnSetup($aClassName,$aColNbr) {}
    function FmtClassHierarchyColumnExit($aClassName,$aColNbr) {}    
    function FmtClassHierarchyRow($aClassName,$aMethodName,$aOverridden,$aPublic) {}    
    function FmtClassSetup($aClassInfo) {}    
    function FmtClassOverview($aClassInfo) {}
    function FmtClassVars($aVars) {}
    function FmtFuncPrototype($aClassName,$aFunc) {}    
    function FmtFuncArgs($aFunc)  {}    
    function FmtFuncDesc($aFunc) {}
    function FmtFuncRef($aRef) {}           
    function FmtFuncExample($aFunc) {}    
    function FmtIndexSetup() {}
    function FmtIndexClass($aClassName) {}
   	function FmtIndexMethod($aClassName,$aMethodName) {}
    function FmtIndexExit() {}
     

    // -------  END OF STUBS  -----------
    
    function ClassHierarchy($aHier) {
        $n = count($aHier);
        $this->FmtClassHierarchySetup($aHier,$n);
        $this->FmtClassHierarchyHeaders($aHier,$n);
        
        for( $i=0; $i<$n; ++$i ) {
            $this->FmtClassHierarchyColumnSetup($aHier[$i],$i);
            
            if( empty($this->iDBCache->iClassMethods[$aHier[$i]]) ) {
                $this->FmtClassHierarchyRow($aHier[$i],"",false,false);
            }
            else {
                $methods = $this->iDBCache->iClassMethods[$aHier[$i]];
                $m = count($methods);
                for( $j=0; $j<$m; ++$j ) {
                    $overridden = false;
                    if( $i > 0 ) {
                        if( !empty($supermethods[$methods[$j][0]]) )
                            $overridden = true;
                    }                    
                    $this->FmtClassHierarchyRow($aHier[$i],$methods[$j][0],$overridden,$methods[$j][1]);                    
                }
            }
            if( !empty($this->iDBCache->iClassMethodsByName[$aHier[$i]]) )
                $supermethods = $this->iDBCache->iClassMethodsByName[$aHier[$i]];
            else
                $supermethods = array();
            $this->FmtClassHierarchyColumnExit($aHier[$i],$i);                
        }
        $this->FmtClassHierarchyExit($aHier,$n);
    }
            
        
    function DoClass($aClass,$aHier) {
        $this->FmtClassSetup($aClass);
        $this->ClassHierarchy($aHier);        
        $this->FmtClassOverview($aClass);
    }
    
    function DoVars($aVars) {
        if( !$this->iFlags & FMT_CLASSVARS )
            return;
        $this->FmtClassVars($aVars);
    }
    
    function ResolvMethRef($aRef) {
        if( empty( $this->iDBCache->iMethods[$aRef] ) )
            Utils::Error("Unknown method reference=$aRef");
        else return $this->iDBCache->iMethods[$aRef];
    }
    
    function DoFuncs($aFuncs,$aClassName) {
        $n = count($aFuncs);
        for( $i=0; $i < $n; ++$i ) {
            $this->FmtFuncPrototype($aClassName,$aFuncs[$i]);
            $this->FmtFuncArgs($aFuncs[$i]);
            $this->FmtFuncDesc($aFuncs[$i]);            
            $j = 1;
            $ref=array();
            while( $j <= MAX_METHODREF && $aFuncs[$i]["fld_methref$j"]!=0 ) {
                $ref[]=$aFuncs[$i]["fld_methref$j"];
                ++$j;
            }
            $m = count($ref); 
            if( $m > 0 ) {
                $refarr=array();
                for( $j=0; $j < $m; ++$j ) {
                    if( empty( $this->iDBCache->iMethods[$ref[$j]] ) )
                        Utils::Error("Unknown method reference=$aRef");
                    else $refarr[] = $this->iDBCache->iMethods[$ref[$j]];
                }        
                $this->FmtFuncRef($refarr);                          
            }            
            $this->FmtFuncExample($aFuncs[$i]);
        }
    }
}

class ClassRef {
    var $iIdx, $iRow, $iVars, $iFuncs, $iDBCache, $iHierarchy;
    function ClassRef($aRow,$aHierarchy,$aVars,$aFuncs,$aIdx,$aDBCache) {
        $this->iIdx = $aIdx;
        $this->iRow = $aRow;
        $this->iVars = $aVars;
        $this->iFuncs = $aFuncs;                
        $this->iDBCache = $aDBCache;
        $this->iHierarchy = $aHierarchy;
    }
        
    function Stroke($aFormatter) {
        $aFormatter->DoClass($this->iRow,$this->iHierarchy); 
        $aFormatter->DoVars($this->iVars);  
        $aFormatter->DoFuncs($this->iFuncs,$this->iRow["fld_name"]);                                      
    }    
}

class ClassReader {
    var $iDB, $iDBCache, $iFlags;
    var $iFormatter;
    function ClassReader($aFormatter,$aDB,$aDBCache,$aFlags="") {
        $this->iDB = $aDB;
        $this->iDBCache = $aDBCache;
        $this->iFlags = $aFlags;
        $this->iFormatter = $aFormatter;
    }
    
    function GetHierarchy($aClassName) {    
        $h = array($aClassName);
        $parent = $this->iDBCache->iClassesByName[$aClassName][1];
        while( $parent != "" ) {
            $h[] = $parent;       
            if( empty($this->iDBCache->iClassesByName[$parent][1]) ) {
                break;
            }
            else                 
                $parent = $this->iDBCache->iClassesByName[$parent][1];
        }
        return $h;
    }
    
    function GenClassIndex() {
    	$this->iFormatter->FmtIndexSetup(count($this->iDBCache->iClasses),count($this->iDBCache->iMethods));
		foreach( $this->iDBCache->iClasses as $c ) {
			$this->iFormatter->FmtIndexClass($c[0]);
			foreach( $this->iDBCache->iClassMethods[$c[0]] as $m ) {
				$this->iFormatter->FmtIndexMethod($c[0], $m[0]);
			}			
		}
		$this->iFormatter->FmtIndexExit();    	
    }
     
    
    function Run($aClass) {
    	$this->GenClassIndex();
    	
        $q = "SELECT * FROM tbl_class ORDER BY fld_name ";        
        if( $aClass != "" )
            $q .= " WHERE fld_name='".$aClass."'";
        $classres = $this->iDB->query($q);
        $n = $classres->NumRows();
        for( $i=0; $i < $n; ++$i ) {
            $row = $classres->Fetch();
            
            $hier = $this->GetHierarchy($row["fld_name"]);
            
            $q = "SELECT * FROM tbl_classvars WHERE fld_classidx=".$row["fld_key"]." ORDER BY fld_name";
            $varres = $this->iDB->query($q);
            $nn = $varres->NumRows();
            $vars = array();
            for( $j=0; $j < $nn; ++$j ) {
                $vars[] = $varres->Fetch();
            }

            $q = "SELECT * FROM tbl_method WHERE fld_classidx=".$row["fld_key"]." ORDER BY fld_name";
            $funcres = $this->iDB->query($q);
            $nn = $funcres->NumRows();
            $funcs = array();
            for( $j=0; $j < $nn; ++$j ) {
                $funcs[] = $funcres->Fetch();
            }
            
            $c = new ClassRef($row,$hier,$vars,$funcs,$i,$this->iDBCache);  
            $c->Stroke($this->iFormatter);
        }
    }
}

// Driver
class Driver {
    var $iDB,$iDBCache;

    function NewClassFormatter($aDBCache,$aFlags) {
        Utils::Error("ERROR: NewClassFormatter must be overridden to provide the actual formatter");
    }

    function Driver() {
	    $this->iDB = new DBServer("root","");
    	$this->iDB->SetDB("jpgraph_doc");
    }
    
    function Run($aClass,$aFlags="") {
        $this->iDBCache = new DBCache($this->iDB);
        $this->iDBCache->RefreshClasses();
        $this->iDBCache->RefreshMethods();
        $fmt = $this->NewClassFormatter($this->iDBCache,$aFlags);
        $cr = new ClassReader($fmt,$this->iDB,$this->iDBCache,$aFlags);
        $cr->Run($aClass);
    }	
}

?>
