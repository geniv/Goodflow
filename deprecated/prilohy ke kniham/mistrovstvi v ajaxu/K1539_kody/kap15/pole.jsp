<%
  String[] pole = {"Prvek1", "Prvek2", "Prvek3"};

  int index = Integer.parseInt(request.getParameter("index"));

  if(index < 0 || index > pole.length){

    out.println("Zadaný index je mimo rozsah pole.");

  }
  else {

    out.println("Prvek pole: ");
 
    out.println(pole[index]);
  }
%>
