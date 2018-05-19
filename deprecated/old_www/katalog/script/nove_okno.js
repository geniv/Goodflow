var myTWin = window.myTWin;

function OpenMyWin(link,winName)
{
  var retValue=true;
  if (myTWin!=null && !myTWin.closed)
  {
    myTWin.focus();
    myTWin.location.href=link.href;
  }
  else
  {
    myTWin=window.open(link.href,winName);
    if (myTWin==null || typeof(myTWin)=="undefined")
      retValue=false;
    else
    {
      link.target=winName;
      myTWin.focus();
    }
  }
  return retValue;
}

