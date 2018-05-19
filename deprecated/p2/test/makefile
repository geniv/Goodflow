##
# Autor: geniv.radek@gmail.com
#
# Pouziti:
#   - hromadna "kompilace" testu
##

#--strict --process-isolation --tap --testdox --stop-on-error --stop-on-failure --tap
PHPTEST=phpunit --strict --verbose --stop-on-error --stop-on-failure --bootstrap
#adresar se souborama trid
DIR=../classes

#aplikace testu pro F8; make UsetTest.o
%.o:
	@FILE=$$( basename $@ .o ).php; \
	echo ">> Probiha test souboru: $$FILE"; \
	$(PHPTEST) $(DIR)/$$( basename $$FILE Test.php | awk '{print tolower($$0)}' )".php" $$( basename $$FILE .php ); \
	echo ""; \

#aplikace testu pro F9; make
all:
	@for FILE in *.php; do \
		echo ">> Probiha test souboru: $$FILE"; \
		$(PHPTEST) $(DIR)/$$( basename $$FILE Test.php | awk '{print tolower($$0)}' )".php" $$( basename $$FILE .php ); \
		echo ""; \
	done; \


# tr 'A-Z' 'a-z'
#	$(PHPTEST) $(DIR)/html.php HtmlTest
#	$(PHPTEST) $(DIR)/htmlpage.php HtmlPageTest
#	$(PHPTEST) $(DIR)/staticweb.php StaticWebTest
#	$(PHPTEST) $(DIR)/form.php FormTest
#	$(PHPTEST) $(DIR)/pdohelper.php PDOHelperTest
#	$(PHPTEST) $(DIR)/route.php RouteTest
##	$(PHPTEST) $(DIR)/debugger.php DebuggerTest
#	$(PHPTEST) $(DIR)/cache.php CacheTest
#####	$(PHPTEST) $(DIR)/user.php UserTest
#	$(PHPTEST) $(DIR)/dateandtime.php DateAndTimeTest
#####	$(PHPTEST) $(DIR)/session.php SessionTest
##	$(PHPTEST) $(DIR)/paginator.php PaginatorTest
##	$(PHPTEST) $(DIR)/message.php MessageTest
#	$(PHPTEST) $(DIR)/language.php LanguageTest
#	$(PHPTEST) $(DIR)/tpl.php TplTest
