##
# Autor: geniv.radek@gmail.com
#
# "kompilace testu"
#
# konktretni test:
# $ make TplTest.o
#
# hromadny test:
# $ make
##


# --stop-on-error --stop-on-failure --colors
PHPTEST=phpunit --strict --verbose --stop-on-error --stop-on-failure --bootstrap loader.php
#adresar se souborama trid
DIR=../classes

#aplikace testu pro F8; make UserTest.o
%.o:
	@FILE=$$( basename $@ .o ).php; \
	echo ">> Probiha test souboru: $$FILE"; \
	$(PHPTEST) $$( basename $$FILE .php ); \
	echo ""; \

#aplikace testu pro F9; make
all:
	@for FILE in *.php; do \
		echo ">> Probiha test souboru: $$FILE"; \
		$(PHPTEST) $$( basename $$FILE .php ); \
		echo ""; \
	done; \
