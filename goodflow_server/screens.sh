#! /bin/bash
#by geniv

list_fce() {
  screen -ls
}

listen_fce() {
  #$1 = nazev, $2 = soubor, $3 = timeout
  screen -S $1 -p 0 -X logfile $2
  screen -S $1 -p 0 -X flush $3
  screen -S $1 -p 0 -X log on
  echo "process: '$1', logfile: '$2', interval: '$3's"
}

run_screen_fce() {
  #$1 = nazev, $2 = cmd
  screen -S $1 -p 0 -d -m $2
  echo "process: '$1', cmd: '$2'"
}

run_multiscreen_fce() {
  #$1 = nazev, $2 = cmd, $3 = dir

  MULTIDIR="multiscreen.conf"

  #nastaveni multiuseru
  echo "multiuser on" >> $MULTIDIR  #zapnuti multi useru
  echo "acladd root" >> $MULTIDIR  #muze pristupovat uzivatel: root

  #echo $1":::"$2":::"$3":::"$4

  if [ "$3" != "" ]; then
    cd $3 && screen -c multiscreen.conf -S $1 -p 0 -d -m $2
    #cd $3 ; screen -S $1 -p 0 -d -m $2
    echo "spustil jsem screen s nazvem: '$1', cestou: '$3' a prikazem: '$2'"
      else
    screen -c multiscreen.conf -S $1 -p 0 -d -m $2
    echo "spustil jsem screen s nazvem: '$1' a prikazem: '$2'"
  fi

  rm -v $MULTIDIR
}

send_fce() {
  #$1 = nazev, $2 = text
  screen -S $1 -p 0 -X stuff "$2"$( echo -ne '\r' )
  echo "procesu: '$1' bylo zaslano: '$2'"
}

kill_fce() {
  #$1 = pid
  kill $1
  echo "zabil jsem $1"
}

kill_name_fce() {
  #$1 = name pid; !sudo!
  killall $1
  echo "zabil jsem $1"
}

mkdir_fce() {
  #$1 = file path
  mkdir -v -p -m 0777 $( dirname $1 )
}

#bezi restart?
is_run_shutdown_restart_fce() {
  ps aux | grep -v grep | grep -v ' SCREEN ' | grep -c 'shutdown -r'
}

#bezi vypnuti?
is_run_shutdown_off_fce() {
  ps aux | grep -v grep | grep -v ' SCREEN ' | grep -c 'shutdown -h'
}

#restart po X s
run_shudown_restart_fce() {
  #$1 = time in minute or time (xx:xx); !sudo!
  #run_multiscreen_fce 'shutdown_task' $( shutdown -r $1 )
  screen -p 0 -d -m shutdown -r $1
}

#vypnuti po X s
run_shudown_off_fce() {
  #$1 = time in minute or time (xx:xx); !sudo!
  screen -p 0 -d -m shutdown -h $1
}

#------------------------------------------------------------------------------#

#echo $1":::"$2":::"$3":::"$4

case $1 in
  "list")
    list_fce
  ;;

  "add")
    #param: $2 = nazev, $3 = prikaz, $4 = cesta
    if [ "$2" != "" ] && [ "$3" != "" ]; then
      if [ "$4" != "" ]; then
        run_multiscreen_fce "$2" "$3" "$4"
          else
        run_multiscreen_fce "$2" "$3"
      fi
    fi
  ;;

  "add+listen") #spusteni s poslechem
    #param: $2 = nazev, $3 = prikaz, $4 = logdir, $5 = log timeout, $6 = adresar
    if [ "$2" != "" ] && [ "$3" != "" ] && [ "$4" != "" ] && [ "$5" != "" ]; then
      mkdir_fce "$4"
      if [ "$6" != "" ]; then
          #run_multiscreen_fce "$2" "$3" "$6"
          #FIXME u KF rozlisovat jestzli multiscreen nebo normal
        cd "$6" && run_screen_fce "$2" "$3"
        echo "cesta: '$6' a"
        LOG=$( screen -ls | grep "$2" | awk '{ print $1 }' )".log"
        listen_fce "$2" "$4/$LOG" "$5"
          else
        run_multiscreen_fce "$2" "$3"
        LOG=$( screen -ls | grep "$2" | awk '{ print $1 }' )".log"
        listen_fce "$2" "$4/$LOG" "$5"
      fi
    fi
  ;;

  "send") #zaslani prikazu do screeny
    #param: $2 = nazev, $3 = samotny prikaz
    if [ "$2" != "" ]; then
      send_fce "$2" "$3"
    fi
  ;;

  "listen") #samostatne zapnuti
    #param: $2 = nazev, $3 = soubor vcetne cesty, $4 = timeout
    if [ "$2" != "" ]; then
      mkdir_fce "$3"
      listen_fce "$2" "$3" "$4"
    fi
  ;;

  "kill")
    #param: $2 = nazev
    if [ -e /proc/$2 ]; then
      kill_fce "$2"
    fi
  ;;

  "killall")
    if [ "$2" != "" ]; then
      kill_name_fce "$2"
    fi
  ;;

  "isshutdown_restart")
    is_run_shutdown_restart_fce
  ;;

  "shutdown_restart")
    if [ "$2" != "" ]; then
      run_shudown_restart_fce "$2"
    fi
  ;;

  "isshutdown_off")
    is_run_shutdown_off_fce
  ;;

  "shutdown_off")
    if [ "$2" != "" ]; then
      run_shudown_off_fce "$2"
    fi
  ;;

  *)
    echo "invalid parameter!"
  ;;
esac
