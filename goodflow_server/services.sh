#! /bin/bash
#by geniv

ls_fce() {
  ls /etc/init.d/*
}

status_all_fce() {
  service --status-all
}

status_fce() {
  #$1 = name
  if [ "$1" != "" ]; then
    sudo service "$1" status
  fi
}

#//  www-data ALL=NOPASSWD: /usr/bin/*

#whereis <nazev> a povolit ve $visudo
restart_fce() {
  #$1 = name
  if [ "$1" != "" ]; then
    sudo service $1 restart
  fi
}

start_fce() {
  #$1 = name
  if [ "$1" != "" ]; then
    sudo service $1 start
  fi
}

stop_fce() {
  #$1 = name
  if [ "$1" != "" ]; then
    sudo service $1 stop
  fi
}

gethelp_fce() {
  #$1 = name
  if [ "$1" != "" ]; then
    service $1 help
  fi
}

#------------------------------------------------------------------------------#

case $1 in
  "list")
    ls_fce
  ;;

  "status")
    if [ "$2" != "" ]; then
      status_fce $2
        else
      status_all_fce
    fi
  ;;

  "start")
    start_fce $2
  ;;

  "stop")
    stop_fce $2
  ;;

  "stop+start")
    stop_fce $2
    sleep 5
    start_fce $2
  ;;

  "restart")
    restart_fce $2S
  ;;
esac
