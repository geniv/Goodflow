#!/bin/bash

MIN=10
if [ "$1" != "" ]
then
  MIN=$1
fi

ODD=%%
if [ "$2" != "" ]
then
  ODD=$2
fi

for i in $( seq $MIN )
do
  echo "${ODD}${i}${ODD} - ${i}<br />"
done
