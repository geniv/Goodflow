#! /bin/bash
#by geniv

DIR=`dirname $0`
SRC="${DIR}/pass.sh"
if [ -e ${SRC} ]; then
  source ${SRC}
    else
  exit -1
fi

#
#soubor pass.sh obsahuje:
#MYSQLUSER="user"
#MYSQLPASS="pass"
#

HOSTINGHOME="/home/hostings"
DESTINATIONDIR="/var/www/gfdesign.cz"
PUBLICDIR="public_html"
USERGROUP="users"
FTP="sftp"
INDEX="index.php"

#default value for quota
SOFTSIZE=5  #MB
HARDSIZE=10   #max MB
SOFTCOUNT=1000  #dirs
HARDCOUNT=2000  #max dirs

#error code
USERHELP=100
USEROK=0
USEREXIST=101
USERNOEXIST=102

#test na skupinu
if [ -z $( cat /etc/group | cut -d':' -f1 | grep $FTP ) ]; then
  echo "skupina ${FTP} neexistuje"
  addgroup $FTP
  echo "vytvoreni skupiny: ${FTP}"
fi

#self security
if [ "$1" == "geniv" ]; then
  echo "Stop this!!!"
  exit -1
fi

