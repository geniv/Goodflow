#! /bin/bash
#by geniv

SCRIPTDIR="/home/gmr/scripts"

listuser_fce() {
  if [ -e "${SCRIPTDIR}/user_list.sh" ]; then
    for user in $( "${SCRIPTDIR}/user_list.sh" )
    do
      ./quotas.sh getuser $user | grep -v Filesystem | awk '{ if ($4 == "user") { print $5 } else { print } }'
    done
      else
    exit -1
  fi
}

adduser_fce() {
  #$1 = name, $2 = pass, $3 = fsoft, $4 = fhard, $5 = csoft, $6 = chart
  "${SCRIPTDIR}/user_add.sh" "$1" "$2" $3 $4 $5 $6
}

edituser_getlink_fce() {
  #$1 = name
  "${SCRIPTDIR}/user_edit.sh" "$1" getlink
}

edituser_link_fce() {
  #$1 = name, $2 = new name
  "${SCRIPTDIR}/user_edit.sh" "$1" editlink "$2"
}

edituser_sftp_fce() {
  #$1 = name, $2 = new sftp pass
  "${SCRIPTDIR}/user_edit.sh" "$1" editsftp "$2"
}

edituser_mysql_fce() {
  #$1 = name, $2 = new mysql pass
  "${SCRIPTDIR}/user_edit.sh" "$1" editmysql "$2"
}

edituser_quota_fce() {
  #$1 = name, $2 = fsoft, $3 = fhart, $4 = csoft, $5 = chart
  "${SCRIPTDIR}/user_edit.sh" "$1" editquota $2 $3 $4 $5
}

deluser_fce() {
  #$1 = name
  "${SCRIPTDIR}/user_del.sh" "$1"
}

#TODO doimplementovat!!!
#$ sudo chmod -v -x faja/  #zakaz spousteni www  ←←  zmena nad symlinkem!
#$ sudo chmod -v +x faja/  #povoleni sposteni www
#$ sudo usermod -L faja  #lock sftp  ←←  zmena nad uzivatelem!
#$ sudo usermod -U faja  #unlock sftp

#------------------------------------------------------------------------------#

case $1 in
  "list")
    listuser_fce
  ;;

  "add")
    if [ "$2" != "" ] && [ "$3" != "" ]; then
      adduser_fce "$2" "$3" $4 $5 $6 $7
    fi
  ;;

  "getlink")
    if [ "$2" != "" ]; then
      edituser_getlink_fce "$2"
    fi
  ;;

  "editlink")
    if [ "$2" != "" ] && [ "$3" != "" ]; then
      edituser_link_fce "$2" "$3"
    fi
  ;;

  "editsftp")
    if [ "$2" != "" ] && [ "$3" != "" ]; then
      edituser_sftp_fce "$2" "$3"
    fi
  ;;

  "editmysql")
    if [ "$2" != "" ] && [ "$3" != "" ]; then
      edituser_mysql_fce "$2" "$3"
    fi
  ;;

  "editquota")
    if [ "$2" != "" ]; then
      edituser_quota_fce "$2" $3 $4 $5 $6
    fi
  ;;

  "del")
    if [ "$2" != "" ]; then
      deluser_fce "$2"
    fi
  ;;
esac
