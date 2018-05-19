##
#	globalni makefile
#
#	Copyright 2012 geniv <geniv.radek@gmail.com>
#
#	prepinace:
#	make test
#	make doc
#
##

all:
	echo "parametry: alltest nebo doc"

alltest:
	echo "spoustim vsechny testy"
	cd test; make

doc:
	echo "zacina generovani dokumentace"; \
	apigen --source $$( pwd ) --destination $$( pwd )/../phpcore_doc --exclude "*/test/*" --title "GoodFlow framework" --source-code no --groups packages