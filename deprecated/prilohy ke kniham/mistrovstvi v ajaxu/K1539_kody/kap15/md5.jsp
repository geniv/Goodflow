<%@ page import="java.security.MessageDigest" %>

<html>
  <head>
    <title>
      Použití hešovacího algoritmu
    </title>
  </head>

  <body>

    <%
      String retezecProhlizec = request.getParameter("data");

      String retezecServer = new String("");

      byte[] bajty = {0, 0, 0};

      try
      {
        MessageDigest md = MessageDigest.getInstance("MD5");

        bajty = md.digest("test".getBytes());
      }

      catch(Exception ex)
      {
        out.println(Chyba.");
      }

      for (int citac = 0; citac < bajty.length; citac++){
        byte b  = bajty[citac];

        Integer i = new Integer(b);

        String s = Integer.toHexString(i.intValue());

        if(java.lang.Math.abs(i.intValue()) < 10){
          s = "0" + s;
        }

        if(s.indexOf("ffffff") >= 0){
          s = s.substring(6);
        }

        retezecServer += s;
      }

   
      if(retezecProhlizec.equals(retezecServer)){
        out.println("Přihlášení bylo úspěšné");
      }
      else {
        out.println("Přihlášení nebylo úspěšné");
      }
    %>
  </body>
</html>
