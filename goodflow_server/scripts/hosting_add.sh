#! /bin/bash
#by geniv

DIR=`dirname $0`
SRC="${DIR}/variable.sh"
if [ -e ${SRC} ]; then
  source ${SRC}
    else
  exit -1
fi

#TODO dodelat nasledujici:
## vytvoreni souboru v /etc/apache2/sites-available
## povoleni webu: a2ensite

WEBUSERNAME=$1
WEBUSERPASS=$2

WEBDOMEN=$3

#napoveda
if [ "${WEBUSERNAME}" == "" ] || [ "${WEBUSERPASS}" == "" ]; then
  echo "pridavani uzivatele hostingu, pouziti:"
  #echo "sudo $0 <domena> <heslo>"
  echo "sudo $0 <login> <heslo> <domena> <F-SOFT> <F-HARD> <C-SOFT> <C-HART>"
  ##### sudo hosting_add.sh fmlight heslo fmlight.cz 300 400 20000 40000
  exit ${USERHELP}
fi

if [ "$4" != "" ] && [ "$5" != "" ] && [ "$6" != "" ] && [ "$7" != "" ]; then
  SOFTSIZE=$4
  HARDSIZE=$5
  SOFTCOUNT=$6
  HARDCOUNT=$7
fi


##FIXME musi se vazat pres databazi na protoze se musi uzvazovat ze jeden uzivatel muze mit vic webovek (vic domen s webovkama)
if [ "${WEBUSERNAME}" != "" ] && [ "${WEBUSERPASS}" != "" ] && [ "${WEBDOMEN}" != "" ]; then

## TODO vytvoreni zakladni slozky ve /var/www

WWWHOME="/var/www"
WWWDIR="www"


  #vytvoreni slozky uzivatele
  mkdir -vpm 0777 ${WWWHOME}/${WEBDOMEN}/${WWWDIR}
  echo "vytvoreneno: ${WWWHOME}/${WEBDOMEN}/${WWWDIR}"

##TODO smazat na tvrdo a vytvorit od nuly!!! a spravne!


# cesta musi byt:
# sudo chmod -v 0755 /var/www/
### sudo chown -v root:gmr /var/www
# sudo chown -v root /var/www
#-----------------------------
# sudo chmod -v 0755 /var/www/fmlight.cz
### sudo chown -v root:gmr /var/www/fmlight.cz/
# sudo chown -v root /var/www/fmlight.cz/
# sudo chown -v fmlight /var/www/fmlight.cz/*
# sudo chmod -vR 0755 /var/www/fmlight.cz/*

# pozn:
# sudo userdel fmlight
#TODO dohledat dotazy na smazani z sql, pripadne smazat uzivatele z db i s jeho opravnenim

#DROP USER 'jeffrey'@'localhost';

#random: 
# tr -cd '[:alnum:]' < /dev/urandom | fold -w10 | head -n1

  useradd -N -s /bin/false -d ${WWWHOME}/${WEBDOMEN} -g ${USERGROUP} ${WEBUSERNAME} -G ${FTP}
  echo "pridan uzivatel: ${WEBUSERNAME}"
  echo ${WEBUSERNAME}:${WEBUSERPASS} | chpasswd
  echo "nastaveno heslo"

#TODO vytvaret .htaccess

  #vytvoreni indexu
  touch ${WWWHOME}/${WEBDOMEN}/${WWWDIR}/${INDEX}
  chown ${WEBUSERNAME} ${WWWHOME}/${WEBDOMEN}/${WWWDIR}/${INDEX}
  chmod -v 0755 ${WWWHOME}/${WEBDOMEN}/${WWWDIR}/${INDEX}

  #naplneni indexu
  echo "<?php echo 'It works!: '.PHP_VERSION;" > ${WWWHOME}/${WEBDOMEN}/${WWWDIR}/${INDEX}
  echo "vytvoren ${INDEX}"

  #nastaveni prav na slozky uvnit uzivatelova home
  chown -v root ${WWWHOME}/${WEBDOMEN}
  chown -v ${WEBUSERNAME} ${WWWHOME}/${WEBDOMEN}/*;
  chmod -vR 755 ${WWWHOME}/${WEBDOMEN}/*;
  echo "nastavena opravneni"

  #nastaveni kvot
  setquota ${WEBUSERNAME} $((${SOFTSIZE}*1024)) $((${HARDSIZE}*1024)) ${SOFTCOUNT} ${HARDCOUNT} -a
  echo "nastaveny kvoty"

  #vytvoreni uzivatele do MySQL
  mysql -u $MYSQLUSER --password=$MYSQLPASS -e "CREATE USER '${WEBUSERNAME}'@'localhost' IDENTIFIED BY  '${WEBUSERPASS}';";
  #vytvoreni prav
  mysql -u $MYSQLUSER --password=$MYSQLPASS -e "GRANT USAGE ON * . * TO  '${WEBUSERNAME}'@'localhost' IDENTIFIED BY  '${WEBUSERPASS}' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;";
  #vytvoreni databaze stejne jako jeho login
  mysql -u $MYSQLUSER --password=$MYSQLPASS -e "CREATE DATABASE IF NOT EXISTS  ${WEBUSERNAME} ;";
  #nastaveni prav na dotycnou databazi
  mysql -u $MYSQLUSER --password=$MYSQLPASS -e "GRANT ALL PRIVILEGES ON  ${WEBUSERNAME} . * TO  '${WEBUSERNAME}'@'localhost';";
  echo "vytvorena databaze"

fi