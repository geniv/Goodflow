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
WEBUSERPASS=$2

#napoveda
if [ "${WEBUSERNAME}" == "" ] || [ "${WEBUSERPASS}" == "" ]; then
  echo "# pridavani uzivatele, pouziti:"
  echo "# sudo $0 <login> <heslo>"
  echo "# sudo $0 <login> <heslo> <FSOFT> <FHARD> <CSOFT> <CHART>"
  exit ${USERHELP}
fi

if [ "$3" != "" ] && [ "$4" != "" ] && [ "$5" != "" ] && [ "$6" != "" ]; then
  SOFTSIZE=$3
  HARDSIZE=$4
  SOFTCOUNT=$5
  HARDCOUNT=$6
fi

if [ "${WEBUSERNAME}" != "" ] && [ "${WEBUSERPASS}" != "" ]; then

  #vytvareni slozky uzivatele
  if ! [ -d ${HOSTINGHOME}/${WEBUSERNAME} ]; then
    sudo mkdir -vpm 0755 ${HOSTINGHOME}/${WEBUSERNAME}
    chown root ${HOSTINGHOME}/${WEBUSERNAME}
      else
    echo "# uzivatel jiz existuje!"
    exit ${USEREXIST}
  fi

  #vytvoreni slozky uzivatele
  mkdir -vpm 0777 ${HOSTINGHOME}/${WEBUSERNAME}/${PUBLICDIR}
  echo "# vytvoreneno: ${HOSTINGHOME}/${WEBUSERNAME}/${PUBLICDIR}"

  useradd -N -s /bin/false -d ${HOSTINGHOME}/${WEBUSERNAME} -g ${USERGROUP} ${WEBUSERNAME} -G ${FTP}
  echo "# pridan uzivatel: ${WEBUSERNAME}"

  #nastaveni hesla
  #`echo ${WEBUSERNAME}:${WEBUSERPASS} | chpasswd`
  echo ${WEBUSERNAME}:${WEBUSERPASS} | chpasswd
  echo "# nastaveno heslo"

  #vytvoreni indexu
  touch ${HOSTINGHOME}/${WEBUSERNAME}/${PUBLICDIR}/${INDEX}
  chown ${WEBUSERNAME} ${HOSTINGHOME}/${WEBUSERNAME}/${PUBLICDIR}/${INDEX}
  chmod 0755 ${HOSTINGHOME}/${WEBUSERNAME}/${PUBLICDIR}/${INDEX}

  #naplneni indexu
  echo "<?php echo 'It works!: '.PHP_VERSION; ?>" > ${HOSTINGHOME}/${WEBUSERNAME}/${PUBLICDIR}/${INDEX}
  echo "# vytvoren ${INDEX}"

  #nastaveni prav na slozky uvnit uzivatelova home
  chown ${WEBUSERNAME} ${HOSTINGHOME}/${WEBUSERNAME}/*;
  chmod -R 755 ${HOSTINGHOME}/${WEBUSERNAME}/*;
  echo "# nastavena opravneni"

  if ! [ -L ${DESTINATIONDIR}/${WEBUSERNAME} ] && ! [ -d ${DESTINATIONDIR}/${WEBUSERNAME} ]; then
    ln -s ${HOSTINGHOME}/${WEBUSERNAME}/${PUBLICDIR} ${DESTINATIONDIR}/${WEBUSERNAME}
    echo "# vytvoreni symlinku"
      else
    echo "# symlink nebo soubor jiz existuje"
  fi

  #nastaveni kvot
  setquota ${WEBUSERNAME} $((${SOFTSIZE}*1024)) $((${HARDSIZE}*1024)) ${SOFTCOUNT} ${HARDCOUNT} -a
  echo "# nastaveny kvoty"

  #vytvoreni uzivatele do MySQL
  mysql -u $MYSQLUSER --password=$MYSQLPASS -e "CREATE USER '${WEBUSERNAME}'@'localhost' IDENTIFIED BY  '${WEBUSERPASS}';";
  #vytvoreni prav
  mysql -u $MYSQLUSER --password=$MYSQLPASS -e "GRANT USAGE ON * . * TO  '${WEBUSERNAME}'@'localhost' IDENTIFIED BY  '${WEBUSERPASS}' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;";
  #vytvoreni databaze stejne jako jeho login
  mysql -u $MYSQLUSER --password=$MYSQLPASS -e "CREATE DATABASE IF NOT EXISTS  ${WEBUSERNAME} ;";
  #nastaveni prav na dotycnou databazi
  mysql -u $MYSQLUSER --password=$MYSQLPASS -e "GRANT ALL PRIVILEGES ON  ${WEBUSERNAME} . * TO  '${WEBUSERNAME}'@'localhost';";
  echo "# vytvorena databaze"

fi
