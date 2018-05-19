<%@ page import="java.security.*" %>

<% 
  Principal uzivatel = request.getUserPrincipal();
  out.println("Vaše uživatelské jméno je: " + uzivatel.getName());
%>
