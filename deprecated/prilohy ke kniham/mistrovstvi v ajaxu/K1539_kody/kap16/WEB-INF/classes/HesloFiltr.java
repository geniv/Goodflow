import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;

public final class HesloFiltr implements Filter 
{
  private FilterConfig konfigurace = null;

  public void doFilter(ServletRequest pozadavek, ServletResponse odpoved,
    FilterChain retezec)
    throws IOException, ServletException 
  {
    String heslo = ((HttpServletRequest) pozadavek).getParameter("heslo");
     
    if(heslo.equals("123456")) {   
        retezec.doFilter(pozadavek, odpoved);
    } else {
        odpoved.setContentType("text/html");
        PrintWriter vystup = odpoved.getWriter();
        vystup.println("<HTML>");
        vystup.println("<HEAD>");
        vystup.println("<TITLE>");
        vystup.println("Nesprávné heslo");
        vystup.println("</TITLE>");
        vystup.println("</HEAD>");
        vystup.println("<BODY>");
        vystup.println("<H1>Nesprávné heslo</H1>");
        vystup.println("Zadali jste nesprávné heslo.");
        vystup.println("</BODY>");
        vystup.println("</HTML>");
    }    
  }

  public void destroy() 
  { 
  }

  public void init(FilterConfig konfigurace) 
  {
  }
}
