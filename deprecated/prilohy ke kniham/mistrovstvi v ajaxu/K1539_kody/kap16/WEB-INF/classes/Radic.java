import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import beans.Model;

public class Radic extends HttpServlet 
{
    String cil = "pohled.jsp";

    Model model = new Model();

    public void doGet(HttpServletRequest pozadavek, HttpServletResponse odpoved) 
        throws ServletException, IOException 
    {
        pozadavek.setAttribute("zprava", model.msg());
        RequestDispatcher predani = 
          pozadavek.getRequestDispatcher(cil);
        predani.forward(pozadavek, odpoved);
    } 
}
