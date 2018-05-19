#! /bin/bash
#by geniv

IPTABLESPATH="/sbin/"

list_fce() {
  ${IPTABLESPATH}iptables --list --numeric --verbose
}

all_connection() {
  netstat -tupan
}

active_connection() {
  netstat -ntup
}

flush_fce() {
  ${IPTABLESPATH}iptables --flush
}

disable_all_fce() {
  ${IPTABLESPATH}iptables --policy INPUT DROP
  ${IPTABLESPATH}iptables --policy OUTPUT ACCEPT
  ${IPTABLESPATH}iptables --policy FORWARD DROP
}


enable_22_fce() {
  ${IPTABLESPATH}iptables -D INPUT -p tcp --dport 22 -j DROP
  echo "povolena 22"
}

disable_22_fce() {
  #iptables -I INPUT -p tcp --dport 22 -j DROP
  #disable davat na posledni misto
  ${IPTABLESPATH}iptables -A INPUT -p tcp --dport 22 -j DROP
  echo "zakazana 22"
}


enable_22_for_fce() {
  ${IPTABLESPATH}iptables -I INPUT -s $1 -p tcp --dport 22 -j ACCEPT
  echo "otevrena 22 pro $1"
}

disable_22_for_fce() {
  ${IPTABLESPATH}iptables -D INPUT -s $1 -p tcp --dport 22 -j ACCEPT
  echo "zakazana 22 pro $1"
}


enable_port_for_fce() {
  # $1 = port
  ${IPTABLESPATH}iptables -D INPUT -p tcp --dport $1 -j DROP
  echo "otevren port: $1"
}

disable_port_for_fce() {
  # $1 = port
  ${IPTABLESPATH}iptables -A INPUT -p tcp --dport $1 -j DROP
  echo "zakazan port: $1"
}


enable_ip_port_for_fce() {
  # IP, PORT
  ${IPTABLESPATH}iptables -I INPUT -s $1 -p tcp --dport $2 -j ACCEPT
  echo "zakazano ip: $1, port: $2"
}

disable_ip_port_for_fce() {
  # IP, PORT
  ${IPTABLESPATH}iptables -D INPUT -s $1 -p tcp --dport $2 -j ACCEPT
  echo "zakazano ip: $1, port: $2"
}


delete_fce() {
  #param: $1 = chain, $2 = ip, $3 = protocol, $4 = dport
  ${IPTABLESPATH}iptables -D $1 -s $2 -p $3 --dport $4 -j ACCEPT
  echo "smazano pravidlo z $1, $3, $2:$4"
}

add_fce() {
  #$1 = target, $ = protocol
  ls #TODO
}

#------------------------------------------------------------------------------#

case $1 in
  "list")
    list_fce
  ;;

  "all")
    all_connection
  ;;

  "active")
    active_connection
  ;;

  "flush")
    flush_fce
    echo "provedeno flush"
  ;;

  "disableall")
    #disable_all_fce
    #echo "provedeno disable all"
  ;;

  "enable22")
    enable_22_fce
  ;;

  "disable22")
    disable_22_fce
  ;;

  "enable22for")
    enable_22_for_fce $2
  ;;

  "disable22for")
    disable_22_for_fce $2
  ;;

  "enableportfor")
    enable_port_for_fce $2
  ;;

  "disableportfor")
    disable_port_for_fce $2
  ;;

  "enableipportfor")
    enable_ip_port_for_fce $2 $3
  ;;

  "disableipportfor")
    disable_ip_port_for_fce $2 $3
  ;;

  "delete")
    delete_fce $2 $3 $4 $5
  ;;

  *)
    echo "invalid parameter!"
  ;;
esac
