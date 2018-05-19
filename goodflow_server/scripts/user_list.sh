#! /bin/bash
#by geniv

DIR=`dirname $0`
SRC="${DIR}/variable.sh"
if [ -e ${SRC} ]; then
  source ${SRC}
    else
  exit -1
fi

ls $HOSTINGHOME
