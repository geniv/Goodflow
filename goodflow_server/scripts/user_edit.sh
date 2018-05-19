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
ACTION=$2

#help
if [ "${WEBUSERNAME}" == "" ] || [ "${ACTION}" == "" ]; then
  echo "edit user, use:"
  echo "sudo $0 <login> <action>"
  echo "sudo $0 <login> getlink"
  echo "sudo $0 <login> editlink <newlink>"
  echo "sudo $0 <login> editsftp <pass>"
  echo "sudo $0 <login> editmysql <pass>"
  echo "sudo $0 <login> editquota <fsoft> <fhard> <csoft> <chart>"

  exit ${USERHELP}
fi

if [ "${WEBUSERNAME}" != "" ] && [ "${ACTION}" != "" ]; then

  if [ -d ${HOSTINGHOME}/${WEBUSERNAME} ]; then

    case ${ACTION} in
      "getlink")  #search symlink for user
        ls -l $DESTINATIONDIR | grep ' -' | grep "${WEBUSERNAME}" | awk '{ print $9 }'
      ;;

      "editlink")
        if ! [ -L ${DESTINATIONDIR}/${3} ] && ! [ -d ${DESTINATIONDIR}/${3} ]; then
          rm -v ${DESTINATIONDIR}/$( ls -l $DESTINATIONDIR | grep ' -' | grep "${WEBUSERNAME}" | awk '{ print $9 }' )
          ln -s ${HOSTINGHOME}/${WEBUSERNAME}/${PUBLICDIR} ${DESTINATIONDIR}/${3}
          echo "vytvoreni symlinku"
            else
          echo "symlink nebo soubor jiz existuje"
        fi
      ;;

      "editsftp")
        if [ "$3" != "" ]; then
          echo ${WEBUSERNAME}:${3} | chpasswd
          echo "change sftp password for user ${WEBUSERNAME}"
            else
          echo "empty password!"
          exit $INERROR
        fi
      ;;

      "editmysql")
        if [ "$3" != "" ]; then
          mysql -u $MYSQLUSER --password=$MYSQLPASS -e "UPDATE mysql.user SET Password=PASSWORD('${3}') WHERE User='${WEBUSERNAME}'; FLUSH PRIVILEGES;";
          echo "change mysql password for user ${WEBUSERNAME}"
            else
          echo "empty password!"
          exit $INERROR
        fi

      ;;

      "editquota")
        setquota ${WEBUSERNAME} $((${3}*1024)) $((${4}*1024)) $5 $6 -a
        echo "change quota for user ${WEBUSERNAME}"
      ;;

      *)
        echo "unknown command"
        exit $INERROR
      ;;
    esac

  else
    echo "uzivatel neexistuje!"
    exit $USERNOEXIST
  fi
fi
