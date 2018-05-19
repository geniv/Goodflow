import java.io.*;
import java.util.*;
import javax.servlet.*;
import javax.servlet.http.*;

public final class CasFiltr implements Filter 
{
  public void doFilter(ServletRequest pozadavek, ServletResponse odpoved,
    FilterChain retezec)
    throws IOException, ServletException 
  {
 
    GregorianCalendar kalendar = new GregorianCalendar();
    Date datum = new Date();
    kalendar.setTime(datum);
    int hodin = kalendar.get(Calendar.HOUR_OF_DAY);
    if(hodin < 9 || hodin > 17) {   
        retezec.doFilter(pozadavek, odpoved);
    } else {
        odpoved.setContentType("text/html");
        PrintWriter vystup = odpoved.getWriter();
        vystup.println("<HTML>");
        vystup.println("<HEAD>");
        vystup.println("<TITLE>");
        vystup.println("Zpátky do práce!");
        vystup.println("</TITLE>");
        vystup.println("</HEAD>");
        vystup.println("<BODY>");
        vystup.println("<H1>Zpátky do práce!</H1>");
        vystup.println("Tento prostředek nyní není dostupný.");
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
