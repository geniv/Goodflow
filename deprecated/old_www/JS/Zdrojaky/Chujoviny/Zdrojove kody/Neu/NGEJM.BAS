screen 12
sa=200
sb=300
sc=300
sd=300
cls
locate 2,10:print "Stupen: "sbt
locate 2,30:print "Stupen: "sdt
locate 2,10:print "                               "
locate 2,30:print"                                "
14
cls
a$=inkey$
if a$=chr$(27) then end
if a$="4" then sa=sa-2
if a$="6" then sa=sa+2
if a$="5" then sb=sb+1:sbt=sbt+1
if a$="s" then sc=sc-2
if a$="f" then sc=sc+2
if a$="d" then sd=sd+1:sdt1=sdt1+1

if sbt = 8 then sbt = 1
if sdt = 8 then sdt = 1



pset(sa,sb)
draw"c4r10d30l20u30r10"
pset(sc,sd)
draw"c2r10d30l20u30r10"


goto 14