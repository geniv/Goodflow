<%
  String text = request.getParameter("text");

  text = text.replaceAll("<", "&lt;");
  text = text.replaceAll(">", "&gt;");

  out.println("Zadali jste: ");
  out.println(text);
%>
