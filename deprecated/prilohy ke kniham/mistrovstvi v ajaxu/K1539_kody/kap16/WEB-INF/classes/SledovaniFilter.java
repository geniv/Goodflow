import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;

public final class SledovaniFiltr implements Filter 
{
  private FilterConfig konfigurace = null;

  public void doFilter(ServletRequest pozadavek, ServletResponse odpoved,
    FilterChain retezec)
    throws IOException, ServletException 
  {

    long zacatek = System.currentTimeMillis();
    String adresa =  pozadavek.getRemoteAddr();
    String soubor = ((HttpServletRequest) pozadavek).getRequestURI();
        
    retezec.doFilter(pozadavek, odpoved);

    konfigurace.getServletContext().log(
        "Přístup uživatele! " +      
        " IP: " + adresa +      
        " Prostředek: " + soubor + 
        " Doba přístupu: " + (System.currentTimeMillis() - zacatek) 
    );
  }

  public void destroy() { }

  public void init(FilterConfig konfigurace) {
    this.konfigurace = konfigurace;
  }
}
