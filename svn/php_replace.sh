#! /bin/bash
#by geniv
#
# pouziti:
# $ ./php_replace.sh "/var/www/www/git/goodflow/nette/USAShopping"

DIR=$1

if [ "${1}" == "" ]; then
    echo "nevyplnen parametr!"
    echo "pouziti: ${0} \"/var/www/DIR/DIR\""
    exit 0
fi

echo "prohledavam adresar: ${DIR}"

find ${DIR} -type f -name '*.php' -print0 | while IFS= read -r -d '' fl; do
    # echo "prochazim soubor: ${fl}"
    if grep -e "<?[[:space:]]" "$fl"; then
        echo "vyhovuje soubor: ${fl}"

        # a tu dal by bylo dalsi nahrazovani vybranych souboru
    fi
done;
