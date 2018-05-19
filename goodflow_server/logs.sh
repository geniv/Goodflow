#! /bin/bash
#by geniv

wc_fce() {
  if [ -e $1 ]; then
    wc -l "$1" | awk '{ print $1 }'
  fi
}

list_fce() {
  COUNT=10
  #$1 = file, $2 = count, $3 = part
  if [ -e $1 ]; then
    #zadavani poctu rozrazenych radku
    if [ "$2" != "" ]; then
      COUNT=$2
    fi

    if [ "$3" != "" ]; then
        #echo "sed -n \"$2,$3p\" $1"
        #sed -n '$2,$3p' $1
        sed -n "$2,$3p" $1
      else
        tail -n $COUNT $1
    fi
      else
    if ![ -e $1 ]; then
      echo "file doesn't exist";
    fi
  fi
}

#------------------------------------------------------------------------------#

case $1 in
  "wc")
    if [ "$2" != "" ] ; then
      wc_fce $2
    fi
  ;;

  "list")
    if [ "$1" != "" ]; then
      list_fce $2 $3 $4
    fi
  ;;

  *)
    echo "invalid parameter!"
  ;;
esac
