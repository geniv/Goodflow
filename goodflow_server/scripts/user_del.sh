#! /bin/bash
#by geniv

DIR=`dirname $0`
SRC="${DIR}/variable.sh"
if [ -e ${SRC} ]; then
  source ${SRC}
    else
  exit -1
fi

WEBUSERNAME=$1

#napoveda
if [ "${WEBUSERNAME}" == "" ]; then
  echo "# pouziti:"
  echo "# sudo ./user_del.sh <hosting>"
  exit ${USERHELP}
fi

if [ "${WEBUSERNAME}" != "" ]; then

  if ! [ -d ${HOSTINGHOME}/${WEBUSERNAME} ]; then
    echo "# uzivatel neexistuje!"
    exit $USERNOEXIST
  fi

  userdel -r ${WEBUSERNAME}
  echo "# smazan uzivatel: ${WEBUSERNAME}"

  if [ -d ${HOSTINGHOME}/${WEBUSERNAME} ]; then
    rm -Rv ${HOSTINGHOME}/${WEBUSERNAME}
    echo "# smazano ${HOSTINGHOME}/${WEBUSERNAME}"
  fi

  #if [ -L ${DESTINATIONDIR}/${WEBUSERNAME} ]; then
  #  rm -v ${DESTINATIONDIR}/${WEBUSERNAME}
  #fi

  #odmazani symlinku
  rm -v ${DESTINATIONDIR}/$( ls -l $DESTINATIONDIR | grep ' -' | grep "${WEBUSERNAME}" | awk '{ print $9 }' )
  echo "# odstraneni symlinku pro: ${WEBUSERNAME}"

  #smazani uzivatele
  mysql -u $MYSQLUSER --password=$MYSQLPASS -e "DROP USER '${WEBUSERNAME}'@'localhost';";
  #smazani databaze
  mysql -u $MYSQLUSER --password=$MYSQLPASS -e "DROP DATABASE IF EXISTS  ${WEBUSERNAME} ;";
  echo "# smazana databaze"
fi
