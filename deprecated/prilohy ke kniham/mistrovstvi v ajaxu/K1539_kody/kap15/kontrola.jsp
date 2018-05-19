<% 
  if(request.getParameter("heslo").equals("123456")){
    out.println("Přihlášení bylo úspěšné");
  }
  else {
    out.println("Nesprávné heslo");
  }
%>
