#!/bin/bash
REPOS=$1
REV=$2
SENDTO=$3
SENDFROM=svncommit@gfdesign.cz

LIMITDIFF=200
CHANGELOG=`svnlook log -r $REV $REPOS`
AUTHOR=`svnlook author -r $REV $REPOS`
CHANGED=`svnlook changed -r $REV $REPOS`
DIFF=`svnlook diff -r $REV $REPOS | head --lines=$LIMITDIFF`
DATE=`date`
TMPFILE=/tmp/svn$REV-$RANDOM.message

SUBJECT="SVNCommit ($AUTHOR) $REPOS [$REV]"
echo "-------------------- SVN Commit Notification --------------------
Repository: $REPOS
Revision:   $REV
Author:     $AUTHOR
Date:       $DATE

-----------------------------------------------------------------
Log Message:
-----------------------------------------------------------------
$CHANGELOG

-----------------------------------------------------------------
Changes:
-----------------------------------------------------------------
$CHANGED

-----------------------------------------------------------------
Diff: (only first $LIMITDIFF lines shown)
-----------------------------------------------------------------
$DIFF
" > $TMPFILE

# Send email
cat $TMPFILE | mail -a "From: $SENDFROM" -s "$SUBJECT" "$SENDTO"

# Cleanup
rm $TMPFILE
