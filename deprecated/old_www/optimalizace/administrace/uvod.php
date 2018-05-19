<?
if(!Empty($AD_jmeno) and !Empty($AD_heslo) and LoginAdmin($AD_jmeno,$AD_heslo,".")=="true")
{
print DostaveniDelkyOtvirani(true);

}
else
{
print "Nepovolený pøístup";
}
?>
