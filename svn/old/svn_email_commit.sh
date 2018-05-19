#!/bin/bash
REPOS=$1
REV=$2
SENDTO=$3
SENDFROM=svn@gfdesign.cz

LIMITDIFF=1
CHANGELOG=`svnlook log -r $REV $REPOS`
AUTHOR=`svnlook author -r $REV $REPOS`
CHANGED=`svnlook changed -r $REV $REPOS`
DIFF=`svnlook diff -r $REV $REPOS | head --lines=$LIMITDIFF`
DATE=`date`
PROJECTNAME=`basename $REPOS`
#TMPFILE=/tmp/svn$REV-$RANDOM.message

SUBJECT="$PROJECTNAME r$REV - $REPOS"

#BODY=`/var/www/www/svn/svn2cl-0.14/svn2cl.sh --stdout --revision $REV file://$REPOS`

#echo "<pre style='font-size: 12px;'>Author: $AUTHOR
#Date: $DATE
#Added:
#    ...
#Removed:
#    ...
#Modified:
#    ...

# Send email
php /var/www/gfdesign.cz/svn/log.php $REV $REPOS | mail \
-a "From: $SENDFROM" \
-a "MIME-Version: 1.0" \
-a "Content-Type: text/html; charset=UTF-8" \
-s "$SUBJECT" \
"$SENDTO"

# Cleanup
#rm $TMPFILE
