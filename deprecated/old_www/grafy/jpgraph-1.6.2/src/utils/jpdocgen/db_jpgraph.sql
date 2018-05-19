# phpMyAdmin MySQL-Dump
# version 2.2.3
# http://phpwizard.net/phpMyAdmin/
# http://phpmyadmin.sourceforge.net/ (download page)
#
# Host: localhost
# Generation Time: Apr 14, 2002 at 01:26 PM
# Server version: 3.23.43
# PHP Version: 4.1.1
# Database : `jpgraph_doc`
# -------------------------------------------------------- #
# Table structure for table `tbl_class`
# DROP TABLE IF EXISTS tbl_class;
CREATE TABLE tbl_class (
  fld_key int(11) NOT NULL auto_increment,
  fld_name varchar(40) NOT NULL default '',
  fld_public tinyint(4) NOT NULL default '1',
  fld_parentname varchar(40) default NULL,
  fld_file varchar(80) NOT NULL default '',
  fld_linenbr int(11) NOT NULL default '0',
  fld_desc text,
  fld_timestamp timestamp(14) NOT NULL,
  PRIMARY KEY  (fld_key),
  FULLTEXT KEY fld_name (fld_name)
) TYPE=MyISAM;

# -------------------------------------------------------- #
# Table structure for table `tbl_classvars`
# DROP TABLE IF EXISTS tbl_classvars;
CREATE TABLE tbl_classvars (
  fld_key int(11) NOT NULL auto_increment,
  fld_name char(30) NOT NULL default '',
  fld_public tinyint(4) NOT NULL default '1',
  fld_default char(30) default NULL,
  fld_classidx int(11) NOT NULL default '0',
  fld_timestamp timestamp(14) NOT NULL,
  PRIMARY KEY  (fld_key)
) TYPE=MyISAM;

# -------------------------------------------------------- #
# Table structure for table `tbl_method`
# DROP TABLE IF EXISTS tbl_method;
CREATE TABLE tbl_method (
  fld_key int(11) NOT NULL auto_increment,
  fld_name varchar(40) NOT NULL default '',
  fld_public tinyint(4) NOT NULL default '1',
  fld_linenbr int(11) NOT NULL default '0',
  fld_classidx int(11) default NULL,
  fld_shortdesc tinytext,
  fld_desc text,
  fld_example text,
  fld_methref1 int(11) default NULL,
  fld_methref2 int(11) default NULL,
  fld_methref3 int(11) default NULL,
  fld_methref4 int(11) default NULL,
  fld_methref5 int(11) default NULL,
  fld_numargs tinyint(4) default NULL,
  fld_arg1 varchar(40) default NULL,
  fld_arg2 varchar(40) default NULL,
  fld_arg3 varchar(40) default NULL,
  fld_arg4 varchar(40) default NULL,
  fld_arg5 varchar(40) default NULL,
  fld_arg6 varchar(40) default NULL,
  fld_arg7 varchar(40) default NULL,
  fld_arg8 varchar(40) default NULL,
  fld_arg9 varchar(40) default NULL,
  fld_arg10 varchar(40) default NULL,
  fld_argdes1 varchar(80) default NULL,
  fld_argdes2 varchar(80) default NULL,
  fld_argdes3 varchar(80) default NULL,
  fld_argdes4 varchar(80) default NULL,
  fld_argdes5 varchar(80) default NULL,
  fld_argdes6 varchar(80) default NULL,
  fld_argdes7 varchar(80) default NULL,
  fld_argdes8 varchar(80) default NULL,
  fld_argdes9 varchar(80) default NULL,
  fld_argdes10 varchar(80) default NULL,
  fld_timestamp timestamp(14) NOT NULL,
  PRIMARY KEY  (fld_key)
) TYPE=MyISAM;