/*<![CDATA[*/
  if(self.location!=top.location) { top.location=self.location }

  function contact(owner,domain,subject)
   {
     if(subject) subject="?subject="+subject; else subject="";

     var at = "@";
     document.write("<a href='mailto:"+owner+at+domain+subject+"'>napište mi</a>"); 
   }
/*]]>*/
