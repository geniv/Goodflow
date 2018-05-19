
function WriteCookie (Name, Value, Expire, Path, Domain, Secure){

  if (Name=='') return;


  var Cookie = Name + '=' + escape (Value);


  if (Expire){

    var D = new Date((new Date()).getTime() + Expire*3600000);


    Cookie += '; expires=' + D.toGMTString();
  }


  if (Path)
    Cookie += '; path=' + Path;


  if (Domain)
    Cookie += '; domain=' + Domain;



  if (Secure)
    Cookie += '; secure';


  document.cookie = Cookie;
}



function ReadCookie (Name, DefValue){

  var Cookies = document.cookie;


  if (Cookies == "") return (DefValue);


  var Start = Cookies.indexOf (Name+'=');


  if (Start == -1) return DefValue;



  Start += Name.length + 1;



  var End = Cookies.indexOf(';', Start);
  if (End == -1) End = Cookies.length;


  return (unescape (Cookies.substring(Start, End)));
}


