function vypocet()
{
var cs1=10000,cs2=10100,cs3=18200,cs4=27600,
pr1=12,pr2=19,pr3=25,pr4=32,
p2=1212,p3=2751,p4=5101,
pop=600,ditek=500,stud=200,maz=350,
soc=8,zdr=4.5,rh1=480,rh2=690,
np1=90,np2=25,np3=69,np4=60;

//rh1 podle novýho 510!!!

var hz=fm.hm.value/100;
var s=hz*soc;
var z=hz*zdr;
fm.mz1.value=s;//mez
fm.mz2.value=z;//mez
var hz1=eval(fm.hm.value-s-z);
var hz2=Math.floor(hz1);
fm.orez.value=hz2;
var hz5,hz3,hz4;
if(hz2<10000)
{
hz3=fm.orez.value.substring(1,2);
hz3++;
hz4=fm.orez.value.substring(0,1);
hz5=hz4+hz3+"00";
}
if(hz2>10000)
{
hz3=fm.orez.value.substring(2,3);
hz3++;
hz4=fm.orez.value.substring(0,2);
hz5=hz4+hz3+"00";
}
fm.mz3.value=hz3;//mez
fm.mz4.value=hz5;//mez
if(hz5<10000)
{
var mzz=eval(cs1-hz5);
fm.mz5.value=mzz;//mez
var prc=(mzz/100)*pr1;
fm.mz6.value=prc;//mez
prc=prc-pop;
if(fm.stud.checked){prc=prc-stud;}
if(fm.manz.checked){prc=prc-maz;}
if((fm.chdeti.checked)&&(fm.deti.value!=0)){var pprc=(fm.deti.value*ditek);prc=prc-pprc;}
var grc=hz1-prc;
fm.vys.value=grc;//mez
}
if((hz5>cs2)&&(hz5<cs3))
{
var mzz=eval(hz5-cs2);
fm.mz5.value=mzz;//mez
var prc=(mzz/100)*pr2;
fm.mz6.value=prc;//mez
prc=prc+p2;
fm.mz7.value=prc;//mez
prc=prc-pop;
if(fm.stud.checked){prc=prc-stud;}
if(fm.manz.checked){prc=prc-maz;}
if((fm.chdeti.checked)&&(fm.deti.value!=0)){var pprc=(fm.deti.value*ditek);prc=prc-pprc;}
var grc=hz1-prc;
fm.vys.value=grc;//mez
}
if((hz5>cs3)&&(hz5<cs4))
{
var mzz=eval(hz5-cs3);
fm.mz5.value=mzz;//mez
var prc=(mzz/100)*pr3;
fm.mz6.value=prc;//mez
prc=prc+p3;
fm.mz7.value=prc;//mez
prc=prc-pop;
if(fm.stud.checked){prc=prc-stud;}
if(fm.manz.checked){prc=prc-maz;}
if((fm.chdeti.checked)&&(fm.deti.value!=0)){var pprc=(fm.deti.value*ditek);prc=prc-pprc;}
var grc=hz1-prc;
fm.vys.value=grc;//mez
}
if(hz5>cs4)
{
var mzz=eval(hz5-cs4);
fm.mz5.value=mzz;//mez
var prc=(mzz/100)*pr4;
fm.mz6.value=prc;//mez
prc=prc+p4;
fm.mz7.value=prc;//mez
prc=prc-pop;
if(fm.stud.checked){prc=prc-stud;}
if(fm.manz.checked){prc=prc-maz;}
if((fm.chdeti.checked)&&(fm.deti.value!=0)){var pprc=(fm.deti.value*ditek);prc=prc-pprc;}
var grc=hz1-prc;
fm.vys.value=grc;//mez
}
// dál nemocenská
var prv=0,nemi=0,nemo=0,pd,pk,ph,pf,pg,pi,pcc;
prv=fm.prij.value;//vložená èástka
nemi=fm.nemm.value;//minuly
nemo=fm.nemt.value;//letosni
prv=Math.round(prv/(365-nemi));// 1)castka
fm.mt.value=prv; //MT
pd=prv/100;//1% z 1

//if prv<480 tak 1. 14.dní 90% a od 15 100%
//if prv>480 tak 60%

if(prv<rh1)//opravit podmínky
{
pk=(np1*pd)/100;//1% z 2
fm.mt1.value=pk; //MT
ph=(3*(np2*pk));//za 3dny
if(nemo>=15)
{
pg=(11*(np3*pk));
pf=nemo-14;
pi=(pf*(np3*pd)); // 100%
pcc=Math.round(ph+pg+pi);
fm.dav.value=pcc; //kon
}
else
{
pf=nemo-3;
pg=(pf*(np3*pk));
pcc=Math.round(ph+pg);
fm.dav.value=pcc; //kon
}
}
if(prv>rh1)
{
pk=(np4*pd)/100;//1% z 2
fm.mt1.value=pk; //MT
ph=(3*(np2*pk));//za 3dny
pf=nemo-3;
pi=(pf*(np3*pk));
pcc=Math.round(ph+pi);
fm.dav.value=pcc; //kon
}
fm.cel.value=grc+pcc;
}