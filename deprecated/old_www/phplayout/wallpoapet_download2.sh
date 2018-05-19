#!/bin/sh

URL="http://www.vandegoor.com/coppermine/thumbnails.php?album=6&page="
DOWNURL="http://www.vandegoor.com/coppermine/albums/uploads/2008/eee-pc-900/"

stahni_stranku()
{
  TEMP=`mktemp`

  wget -o $TEMP $1
  SOUBOR=$( cat $TEMP | grep "html" | sed s/"„"/"|"/ | sed s/"“"/"|"/ | cut -d "|" -f 2  | cut -d " " -f 8 )
  echo $SOUBOR | cut -d " " -f 1

  cat $SOUBOR > $TEMP
  rm $SOUBOR

  cat $TEMP
}

for cislo in $( seq 1 )
do
  # echo $cislo
  #stranka=$( stahni_stranku "${URL}/index${cislo}.html" | grep -E [a-z0-9\\].jpg | grep "Click here to download" | sort -u | cut -d "\"" -f 2 | cut -d "/" -f 4 )
  stranka=$(stahni_stranku "${URL}${cislo}" );
echo $stranka
  #for obrazek in $stranka
  #do
  #  echo "\nstahuji obrazek: ${DOWNURL}${obrazek}\n"
    #wget -m "${URL}/index${cislo}.html"
  #  wget -k "${DOWNURL}${obrazek}"
  #done
done
