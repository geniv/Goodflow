#! /bin/bash
#by geniv

URL="http://www.netfirmy.cz/katalog/"

# prochazeni sekci katalogu + separace linku katalogu
for KATALOG_ITEM in $( wget $URL -q -O - | grep -Po '(?<=href=")[^"]*' | egrep '/katalog/[a-zA-Z0-9]{2,}' )
do
    echo "nactena polozka: ${KATALOG_ITEM}"
    URL_PAGE=${URL}${KATALOG_ITEM:9}"?page="
    # nacteni jmena zarazeni
    ZARAZENI=$( php parse_zarazeni.php "$( wget ${URL}${KATALOG_ITEM:9} -q -O - | iconv -f WINDOWS-1250 -t UTF-8 )" )
    for ITEM_PAGE in $( seq 1000 )  # limit na 1000 stranek, driv se to stejne breakuje
    do
        # prohledavani jestli existuje jeste dana stranka pri strankovani
        EXIST_PAGE=$( wget ${URL_PAGE}${ITEM_PAGE} -q -O - | grep -Po '(?<=href=")[^"]*' | egrep '?page=' | wc -l )
        if [ $EXIST_PAGE == 0 ]; then
            break
        fi
        echo "prohledavam stranku: ${ITEM_PAGE} - (detekovano dalsich ${EXIST_PAGE} stranek)"

        # nacitani linku firem ze stranek
        for ITEM in $( wget ${URL_PAGE}${ITEM_PAGE} -q -O - | grep -Po '(?<=href=")[^"]*' | grep '/firma' | uniq )
        do
            # stahnuti konkretni firmy + konvert do UTF-8
            echo "predani na php-cli: ${URL:0:-9}${ITEM}"
            # $0 jmeno-zarazeni url-kategorie cislo-stranky detail-url html-detailu-stranky
            php parse_page.php "${ZARAZENI}" "${URL}${KATALOG_ITEM:9}" "${ITEM_PAGE}" "${URL:0:-9}${ITEM}" "$( wget ${URL:0:-9}${ITEM} -q -O - | iconv -f WINDOWS-1250 -t UTF-8 )"
            # exit 0
        done
    done
done
