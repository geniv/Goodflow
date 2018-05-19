<?php

$maskarada = <<<T
<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="Monday, 16-Apr-73 13:10:00 GMT">
    <meta http-equiv="X-UA-Compatible" content="IE=8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title>Centrálni přihlášení k systémům Univerzity Pardubice</title>
    <link rel="stylesheet" href="https://idp.upce.cz/css/style.css" media="screen and (min-width: 800px)">
    <link rel="stylesheet" href="https://idp.upce.cz/css/mobile.css" media="only screen and (max-width: 799px)">
    <link rel="icon" href="https://idp.upce.cz/favicon.ico">
    <link rel="shortcut icon" href="https://idp.upce.cz/favicon.ico">

<!--[if lt IE 9]>
    <script src="https://idp.upce.cz/js/html5shiv.js"></script>
    <link rel="stylesheet" href="https://idp.upce.cz/css/style.css" media="screen">
<![endif]-->


  <body class="cs kerberos-possibly">
    <header>

        <div id="lang-switcher">
          <a id="lang-cs" href="https://idp.upce.cz/jasig/login?service=https%3A%2F%2Fstudenti.upce.cz%2Findex.html&locale=cs">Czech</a>
          <a id="lang-en" href="https://idp.upce.cz/jasig/login?service=https%3A%2F%2Fstudenti.upce.cz%2Findex.html&locale=en">English</a>
        </div>

    </header>
    <section id="body">

<section class="mobile-only instructions"><h1>Je vyžadováno přihlášení</h1><div>Zadejte Vaše přihlašovací údaje a pro pokračování zmáčknete tlačítko "Přihlásit"</div></section>
<section id="factors">
  <section class="factor" id="factor-ldap">
    <h2>Uživatel &amp; heslo</h2>
    <form id="credentials" action="https://idp.upce.cz/jasig/login?service=https%3a%2f%2fportal.upce.cz%2flogin.jsp" method="post">

      <input type="hidden" name="lt" value="LT-468673-hx3HhUT6yoWRRELbCKGmB4uQPumwJH">
      <input type="hidden" name="execution" value="e1s1">
      <input type="hidden" name="_eventId" value="submit">
      <div class="input">
        <label for="login">Uživatel</label>
        <input id="login" name="username" type="text" value="" autocomplete="false">
      </div>
      <div class="input">
        <label for="password">Heslo</label>
        <input id="password" name="password" type="password" value="" autocomplete="off">
      </div>
      <div class="login">
        <button type="submit" name="submit">Přihlásit</button>
      </div>
    </form>
  </section>

    <section class="factor non-mobile" id="factor-kerberos">
      <h2>Automatické přihlášení</h2>
      <form id="credentials" action="https://idp.upce.cz/spnegoJasig/login?service=https%3A%2F%2Fstudenti.upce.cz%2Findex.html" method="post">
        <div id="kerberos-testing">Testuji použitelnost automatického přihlášení<br><img src="https://idp.upce.cz/negotiate/loader.gif" alt="Testuji použitelnost automatického přihlášení"></div>
        <div id="kerberos-not-available">Automatické přihlášení není dostupné</div>
        <div id="kerberos-available">
          <div class="login">
            <button type="submit">Automaticky přihlásit</button>
          </div>
          <div id="kerberos-possibly"><em>Budete-li po stisknutí tlačítka dotázání na uživatelské jméno a heslo v novém okně, stiskněte prosím Storno, vraťte se zpět</em> a přihlašujte se pomocí uživatelského jména a hesla na této stránce.</div>
          <div>Budete přihlášen(a) jako uživatel aktuálně přihlášený k Vašemu počítači. Při přerušení práce <em>doporučujeme uzamknout klávesnici</em> pomocí CTRL+ALT+DEL.</div>
        </div>
      </form>
      <hr>
      <div class="kerberos-info">Další údaje o této funkci a možnosti jejího povolení jsou v <a href="https://dokumenty.upce.cz/Univerzita/ic/navody/ostatni/cas-autoprihlasovani.html" target="_blank">návodu</a>.</div>
    </section>

</section>
<section id="instructions" class="instructions">
  <section class="non-mobile"><h1>Je vyžadováno přihlášení</h1><div>Zadejte Vaše přihlašovací údaje a pro pokračování zmáčknete tlačítko "Přihlásit"</div></section>
  <section class="security"><h2>Bezpečnostní upozornění</h2><p><em>Univerzita Pardubice nikdy nepožaduje poskytování hesel, osobních či přihlašovacích údajů.</em></p><p>Pokud obdržíte e-mail se žádostí o ověření údajů, který je zdánlivě odeslán z e-mailové adresy Univerzity Pardubice, jedná se o podvodný pokus o vylákání Vašich osobních údajů. Pokud máte pochybnosti o pravosti obdrženého e-mailu, kontaktujte prosím helpdesk na lince 46&nbsp;603&nbsp;6777.</p></section>
  <section><h2>Potřebujete účet (NetID), nebo jste zapomněli heslo?</h2><ul><li>Zaměstnanci - kontaktujte helpdesk, tel: 6777, 6778</li><li>Studenti - aktivujte své NetID <a href="https://dokumenty.upce.cz/Univerzita/ic/navody/id.html" target="_blank">dle návodu</a>.</li></ul></section>
</section>
<div class="clear"></div>


    </section>
    <footer>
      <p>© <a href="http://www.upce.cz/" target="_blank">Univerzita Pardubice</a> za použití <a href="http://www.jasig.org/cas/" target="_blank">Jasig CAS</a>.</p>
    </footer>


</body></html>
T;

$add = <<<T
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

<pre>
class GraphicsPanel extends JPanel {

   private Color barva1;
   private Color barva2;

    public GraphicsPanel(Color barva1, Color barva2) {
        this.barva1 = barva1;
        this.barva2 = barva2;
    }

    public void setBarva1(Color barva1) {
        this.barva1 = barva1;
        repaint(); //prekreslime
    }

    public void setBarva2(Color barva2) {
        this.barva2 = barva2;
        repaint(); //prekreslime
    }

    @Override //metoda paint() pouze u framu
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);

        int r1, g1, b1, r2, g2, b2;

        r1 = barva1.getRed();
        g1 = barva1.getGreen();
        b1 = barva1.getBlue();

        r2 = barva2.getRed();
        g2 = barva2.getGreen();
        b2 = barva2.getBlue();

        //diference, kroky
        float dr = (r2 - r1) / (float) getWidth();
        float dg = (g2 - g1) / (float) getWidth();
        float db = (b2 - b1) / (float) getWidth();

        float red = r1, green = g1, blue = b1;

        for (int i = 0; i < getWidth(); i++) {

            g.setColor(new Color(Math.round(red), Math.round(green), Math.round(blue)));
            g.drawLine(i, 0, i, getHeight() - 1);

            red += dr;
            green += dg;
            blue += db;
        }

    }
};
</pre>

<a href="#">up</a>
<pre>
class Kruh {

    private Color barva;
    private Point pozice;
    private int polomer;
    private boolean vypln;

    public Kruh(Color barva, Point pozice, boolean vypln, int polomer) {
        this.barva = barva;
        this.pozice = pozice;
        this.polomer = polomer;
        this.vypln = vypln;
    }

    public Color getBarva() {
        return barva;
    }

    public Point getPozice() {
        return pozice;
    }

    public int getPolomer() {
        return polomer;
    }

    public boolean isVypln() {
        return vypln;
    }
};
----
    private void formMouseMoved(java.awt.event.MouseEvent evt) {
        //pohyb mysi
        labelSouradnice.setText(evt.getX() + " : " + evt.getY());
    }

    private void formMousePressed(java.awt.event.MouseEvent evt) {

        //zmacknuti tlacitka mysi
        Graphics g = getGraphics();

        int polomer = 10;
        int strana = 15;

        switch (evt.getButton()) {
            case MouseEvent.BUTTON1: //leve tlacitko
                g.setColor(aktBarva);
                if (evt.isControlDown()) { //drzim Ctrl - kruznice
                    g.fillOval(evt.getX() - polomer, evt.getY() - polomer, 2 * polomer, 2 * polomer);

                    //seznam zapamatovanych kruhu
                    seznamKruh.add(new Kruh(aktBarva, new Point(evt.getX() - polomer, evt.getY() - polomer), true, 2 * polomer));

                    if (evt.isShiftDown()) { //drzim Shift - okraje kruznice
                        g.setColor(Color.black);
                        g.drawOval(evt.getX() - polomer, evt.getY() - polomer, 2 * polomer, 2 * polomer);

                        //seznam zapamatovanych kruhu
                        seznamKruh.add(new Kruh(Color.BLACK, new Point(evt.getX() - polomer, evt.getY() - polomer), false, 2 * polomer));
                    }
                } else { // bez Ctrl - ctverce
                    g.fillRect(evt.getX() - strana / 2, evt.getY() - strana / 2, strana, strana);
                    //seznam zapamatovanych ctvercu
                    seznamCtverec.add(new Ctverec(aktBarva, new Point(evt.getX() - strana / 2, evt.getY() - strana / 2), true, strana));
                    if (evt.isShiftDown()) { //drzim Shift - okraje ctvercu
                        g.setColor(Color.black);
                        g.drawRect(evt.getX() - strana / 2, evt.getY() - strana / 2, strana, strana);
                        //seznam zapamatovanych ctvercu
                        seznamCtverec.add(new Ctverec(aktBarva, new Point(evt.getX() - strana / 2, evt.getY() - strana / 2), false, strana));
                    }
                }
                break;
            case MouseEvent.BUTTON2: //prostredni tlacitko
                zacatek = evt.getPoint();
                break;
            case MouseEvent.BUTTON3: //prave tlacitko
                zacatek = evt.getPoint();
                konec = evt.getPoint();
                g.setXORMode(aktBarva);
                g.drawLine(zacatek.x, zacatek.y, konec.x, konec.y);
                break;
        }
        g.dispose();
    }

    private void formMouseDragged(java.awt.event.MouseEvent evt) {
        //tazeni mysi
        Graphics g = getGraphics();
        //tahnu mysi a drzim stredni tlacitko mysi
        //evt.getModifiersEx() vi co vsechno je stisknuto - maskujeme pres & (AND)
        if ((evt.getModifiersEx() & MouseEvent.BUTTON2_DOWN_MASK)
                == MouseEvent.BUTTON2_DOWN_MASK) {
            g.setColor(aktBarva);
            g.drawLine(zacatek.x, zacatek.y, evt.getX(), evt.getY());
            //seznam zapamatovanych car
            seznamCar.add(new Cara(zacatek,new Point(evt.getX(), evt.getY()), aktBarva));
            //posun zacatku na konec `/]
            zacatek = evt.getPoint();
        }
        //tahnu mysi a drzim prave tlacitko mysi
        if ((evt.getModifiersEx() & MouseEvent.BUTTON3_DOWN_MASK)
                == MouseEvent.BUTTON3_DOWN_MASK) {
            g.setXORMode(aktBarva); // XoR mode
            g.drawLine(zacatek.x, zacatek.y, konec.x, konec.y);
            konec = evt.getPoint();
            g.drawLine(zacatek.x, zacatek.y, konec.x, konec.y);
        }
        g.dispose();
    }

    private void formMouseReleased(java.awt.event.MouseEvent evt) {
        //uvolneni mysi
        Graphics g = getGraphics();

        switch (evt.getButton()) {
            case MouseEvent.BUTTON3: //prave tlacitko
                g.setXORMode(aktBarva);
                g.drawLine(zacatek.x, zacatek.y, konec.x, konec.y);
                konec = evt.getPoint();

                g.setPaintMode();
                g.setColor(aktBarva);
                g.drawLine(zacatek.x, zacatek.y, konec.x, konec.y);

                 //seznam zapamatovanych car
                seznamCar.add(new Cara(zacatek, konec, aktBarva));

                break;
        }
        g.dispose();
    }
</pre>

<a href="#">up</a>
<pre>
    Color novaBarva = JColorChooser.showDialog(this, "Vyber barvu", jPanelBarva.getBackground());
    if (novaBarva != null) {
        panelKresleni.setAktBarva(novaBarva);
        jPanelBarva.setBackground(novaBarva);
    }
----
    Image obrazek = null;
    JFileChooser fileVyber = new JFileChooser();
    FileNameExtensionFilter filter = new FileNameExtensionFilter("BMP & JPG & GIF Images", "jpg", "gif", "gif");
    fileVyber.setFileFilter(filter);
    int result = fileVyber.showOpenDialog(this);
    //potvrzeni
    if (result == JFileChooser.APPROVE_OPTION) {
        try {
            obrazek = ImageIO.read(new File(fileVyber.getSelectedFile().getAbsolutePath()));
        } catch (IOException e) {
            //nic
        }
    }
----
    rectPointZacatek = evt.getPoint();
    rectPointKonec = evt.getPoint();
    Graphics g = getGraphics();
    g.setXORMode(Color.YELLOW);
    g.drawRect(rectPointZacatek.x, rectPointZacatek.y,
            rectPointKonec.x - rectPointZacatek.x,
            rectPointKonec.y - rectPointZacatek.y);
----
    if ((evt.getModifiersEx() & MouseEvent.BUTTON3_DOWN_MASK) == MouseEvent.BUTTON3_DOWN_MASK) {
        g.setXORMode(Color.YELLOW);
        g.drawRect(rectPointZacatek.x, rectPointZacatek.y,
                rectPointKonec.x - rectPointZacatek.x,
                rectPointKonec.y - rectPointZacatek.y);
        rectPointKonec = evt.getPoint();
        g.drawRect(rectPointZacatek.x, rectPointZacatek.y,
                rectPointKonec.x - rectPointZacatek.x,
                rectPointKonec.y - rectPointZacatek.y);
    }
----
    g.drawRect(rectPointZacatek.x, rectPointZacatek.y,
            rectPointKonec.x - rectPointZacatek.x,
            rectPointKonec.y - rectPointZacatek.y);
    g.setColor(Color.green);
    rectPointKonec = evt.getPoint();
    g.drawRect(rectPointZacatek.x, rectPointZacatek.y,
            rectPointKonec.x - rectPointZacatek.x,
            rectPointKonec.y - rectPointZacatek.y);
    Rectangle rect = new Rectangle(rectPointZacatek.x, rectPointZacatek.y,
            rectPointKonec.x - rectPointZacatek.x,
            rectPointKonec.y - rectPointZacatek.y);
----
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);


        if (obrazek != null) {
            //pozice vyhledem ke komponente !!!
            g.drawImage(obrazek, 0, 0, getWidth() - 1, getHeight() - 1, this);
        } else {
            //kriz a barva pozadi
            g.setColor(barva);
            g.fillRect(0, 0, getWidth() - 1, getHeight() - 1);
            g.setColor(Color.black);
            g.drawLine(0, 0, getWidth() - 1, getHeight() - 1);
            g.drawLine(0, getHeight() - 1, getWidth() - 1, 0);
        }
        g.setColor(Color.black);
        g.drawRect(0, 0, getWidth() - 1, getHeight() - 1);

    }
</pre>

<a href="#">up</a>
<pre>
public abstract class Funkce {

    abstract public double fx(double x);

    @Override
    abstract public String toString();
}

class F_1 extends Funkce {

    @Override
    public double fx(double x) {
        return (double) Math.cos(x);
    }

    @Override
    public String toString() {
        return "y = cos(x)";
    }
}
----
    this.jComboBoxFunkce.addItem(new F_1());
----
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);
        kresliOsy(g);
        kresliFunkce(g);
    }
----
    private int realToPixX(double xReal) {
        pomerX = realMaxX - realMinX;
        return (int) ((xReal - realMinX) * getWidth() / pomerX);
    }

    private int realToPixY(double yReal) {
        pomerY = realMaxY - realMinY;
        return (int) ((yReal - realMinY) * getHeight() / pomerY);
    }

    private double pixToRealX(int xPix) {
        pomerX = realMaxX - realMinX;
        return xPix * pomerX / getWidth() + realMinX;
    }

    private double pixToRealY(int yPix) {
        pomerY = realMaxY - realMinY;
        return yPix * pomerY / getHeight() + realMinY;
    }

    private void kresliOsy(Graphics g) {
        g.setColor(Color.black);
        g.drawLine(realToPixX(realMinX), realToPixY(0), realToPixX(realMaxX), realToPixY(0));
        g.drawLine(realToPixX(0), realToPixY(realMaxY), realToPixX(0), realToPixY(realMinY));
        double meritkoX = realMaxX - realMinX;
        g.drawString("0", realToPixX(0) ,realToPixY(0));
    }

    private void kresliFunkce(Graphics g) {
        g.setColor(Color.red);

        DoublePoint zacatek = new DoublePoint(realMinX, this.funkce.fx(realMinX));
        DoublePoint konec = new DoublePoint(realMinX, this.funkce.fx(realMinX));

        double krokX = 0.1;//realMaxX - realMinX / ;

        while (konec.x <= realMaxX) {
            konec.x += krokX;
            konec.y = this.funkce.fx(konec.x);
            g.drawLine(realToPixX(zacatek.x), realToPixY(zacatek.y),
                    realToPixX(konec.x), realToPixY(konec.y));
            zacatek.x = konec.x;
            zacatek.y = konec.y;
        }
    }

    public void posunVpravo() {
        setBounds(realMinX + this.posunX(), realMaxX + this.posunX(), realMinY, realMaxY);
        ukazPlochu();
    }

    public void posunVlevo() {
        setBounds(realMinX - this.posunX(), realMaxX - this.posunX(), realMinY, realMaxY);
        ukazPlochu();
    }

    public void posunNahoru() {
        setBounds(realMinX, realMaxX, realMinY - this.posunY(), realMaxY - this.posunY());
        ukazPlochu();
    }

    public void posunDolu() {
        setBounds(realMinX, realMaxX, realMinY + this.posunY(), realMaxY + this.posunY());
        ukazPlochu();
    }

    private double posunX() {
        return (realMaxX - realMinX) / 10;
    }

    private double posunY() {
        return (realMaxY - realMinY) / 10;
    }
----
    private void formMouseWheelMoved(java.awt.event.MouseWheelEvent evt) {
        if (evt.getWheelRotation() > 0) { //tocime k sobe -- zvetsujeme zoom
            setBounds(realMinX + posunX(), realMaxX + posunX(), realMinY + posunY(), realMaxY + posunY());
        } else { //tocime od sebe snizujeme zoom
            setBounds(realMinX - posunX(), realMaxX - posunX(), realMinY - posunY(), realMaxY - posunY());
        }
    }
</pre>

<a href="#">up</a>
<pre>
public class RastAlgoritmy {

    public static void kresliKruhBresenham(Graphics g, Color barva, int sx,
            int sy, int polomer) {
        g.setColor(barva);
        // g.drawOval(sx - polomer, sy - polomer, 2*polomer, 2*polomer);

        setPixel(g, Color.BLACK, sx, sy); //stred

        int predikce = 1 - polomer;
        int x = 0;
        int y = polomer;

        while (x <= y) {
            //pocitany
            setPixel(g, Color.CYAN, sx + x, sy + y); // kreslime v 0,0 ... proto posun na stred sx,sy
            //kopirovane
            setPixel(g, barva, sx - x, sy + y);
            setPixel(g, barva, sx - x, sy - y);
            setPixel(g, barva, sx + x, sy - y);

            setPixel(g, barva, sx + y, sy + x);
            setPixel(g, barva, sx - y, sy + x);
            setPixel(g, barva, sx - y, sy - x);
            setPixel(g, barva, sx + y, sy - x);

            if (predikce <= 0) {
                predikce += 2 * x + 3; // vztahy z prednasky
                //y zustava
            } else {
                predikce += 2 * x + 5 - 2 * y; // vztahy z prednasky
                y--; //y klesna o 1
            }
            x++; //posun na dalsi x
        }
    }

    public static void kresliUseckuDDA(Graphics g, Color barva,
            Point zacatek, Point konec) {
        g.setColor(barva);
        //g.drawLine(zacatek.x, zacatek.y, konec.x, konec.y);

        int dx = konec.x - zacatek.x;
        int dy = konec.y - zacatek.y;

        int pocetKroku = Math.max(Math.abs(dx), Math.abs(dy));

        float px = (float) dx / pocetKroku;
        float py = (float) dy / pocetKroku;

        float x = zacatek.x;
        float y = zacatek.y;

        for (int i = 1; i <= pocetKroku; i++) {
            setPixel(g, barva, Math.round(x), Math.round(y));
            x += px;
            y += py;
        }
    }

    public void vykresliDDA(Point start, Point end) {
        Graphics g = this.getGraphics();
        double dx, dy, px, py, kroky, x, y;

        dx = end.x - start.x;
        dy = end.y - start.y;

        kroky = Math.max(Math.abs(dx), Math.abs(dy));

        double dr, dg, db;

        dr = (barva2.getRed() - barva1.getRed()) / kroky;
        dg = (barva2.getGreen() - barva1.getGreen()) / kroky;
        db = (barva2.getBlue() - barva1.getBlue()) / kroky;

        double red = barva1.getRed();
        double green = barva1.getGreen();
        double blue = barva1.getBlue();

        px = dx / kroky;
        py = dy / kroky;

        x = start.x;
        y = start.y;

        while (kroky > 0) {
            g.setColor(new Color((int) red, (int) green, (int) blue));
            g.drawLine((int) Math.round(x), (int) Math.round(y),
                       (int) Math.round(x), (int) Math.round(y));
            x = x + px;
            y = y + py;
            kroky--;
            red += dr;
            green += dg;
            blue += db;
        }
    }

    public void bresenham(Point pocatek, Point konec) {
        Graphics g = this.getGraphics();
        int stepX, stepY;

        int dx = (int) (konec.getX() - pocatek.getX());
        int dy = (int) (konec.getY() - pocatek.getY());

        int x = (int) pocatek.getX();
        int y = (int) pocatek.getY();

        if (dx < 0) {
            dx = -dx;
            stepX = -1;
        } else {
            stepX = 1;
        }

        if (dy < 0) {
            dy = -dy;
            stepY = -1;
        } else {
            stepY = 1;
        }

        if (dx > dy) {  //osa x
            int p = 2 * dy - dx;
            while (x != konec.getX()) {
                x += stepX;
                if (p > 0) {
                    y += stepY;
                    p += 2 * dy - 2 * dx;
                } else {
                    p += 2 * dy;
                }
                g.drawLine(x, y, x, y);
            }
        } else {  // osa Y
            int p = 2 * dx - dy;
            while (y != konec.getY()) {
                y += stepY;
                if (p > 0) {
                    x += stepX;
                    p += 2 * dx - 2 * dy;
                } else {
                    p += 2 * dx;
                }
                g.drawLine(x, y, x, y);
            }
        }
    }

    public static void kresliUseckuDDATlusta(Graphics g, Color barva,
            Point zacatek, Point konec, int sirka) {

        int dx = konec.x - zacatek.x;
        int dy = konec.y - zacatek.y;

        int pocetKroku = Math.max(Math.abs(dx), Math.abs(dy));

        float px = (float) dx / pocetKroku;
        float py = (float) dy / pocetKroku;

        float x = zacatek.x;
        float y = zacatek.y;

        // zajisteni tloustky
        float prepona = (float) Math.sqrt(dx * dx + dy * dy); // prepona por urceni cosinu
        float cosAlfa = dx / prepona;
        float X = sirka / cosAlfa; // vytah z prdnasky
        int pocetPix = Math.round(Math.abs(X)); //pocet pridanych pixelu
        //*******************************

        for (int i = 1; i <= pocetKroku; i++) {
            for (int j = 0; j < pocetPix; j++) {
                setPixel(g, barva, Math.round(x), Math.round(y - j));
            }
            x += px;
            y += py;
        }
    }

    public static void kresliUseckuDDAAlias(Graphics g, Color barva, Color pozadi,
            Point zacatek, Point konec) {

        int dx = konec.x - zacatek.x;
        int dy = konec.y - zacatek.y;

        int pocetKroku = Math.max(Math.abs(dx), Math.abs(dy));

        float px = (float) dx / pocetKroku;
        float py = (float) dy / pocetKroku;

        float x = zacatek.x;
        float y = zacatek.y;

        for (int i = 1; i <= pocetKroku; i++) {
            float posunuti = y - Math.round(y);
            if (posunuti > 0) {
                setPixel(g, prechodovaBarva(pozadi, posunuti,barva), Math.round(x), Math.round(y));
                setPixel(g, prechodovaBarva(pozadi, 1 - posunuti,barva), Math.round(x), Math.round(y + 1));
            } else if (posunuti < 0) {
                posunuti = -posunuti;
                setPixel(g, prechodovaBarva(pozadi, posunuti,barva), Math.round(x), Math.round(y));
                setPixel(g, prechodovaBarva(pozadi, 1 - posunuti,barva), Math.round(x), Math.round(y - 1));
            } else {
                setPixel(g, barva, Math.round(x), Math.round(y));
            }
            x += px;
            y += py;
        }

    }

    private static void setPixel(Graphics g, Color barva, int x, int y) {
        g.setColor(barva);
        g.drawLine(x, y, x, y);
    }

    private static Color prechodovaBarva(Color barva1, float vahaBarvy1, Color barva2) {
        int r1, g1, b1, r2, g2, b2;

        r1 = barva1.getRed();
        g1 = barva1.getGreen();
        b1 = barva1.getBlue();

        r2 = barva2.getRed();
        g2 = barva2.getGreen();
        b2 = barva2.getBlue();

        float red = r1 * vahaBarvy1 + r2 * (1 - vahaBarvy1);
        float green = g1 * vahaBarvy1 + g2 * (1 - vahaBarvy1);
        float blue = b1 * vahaBarvy1 + b2 * (1 - vahaBarvy1);

        return new Color(Math.round(red), Math.round(green), Math.round(blue));
    }
</pre>

<a href="#">up</a>
<pre>
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);

        g.setColor(Color.black);
        g.drawString("Panel kreselni", 10, getHeight() - 10);

        g.setColor(Color.CYAN);

        if (this.pravouhelnik == null) { // v konstruktoru bych neznal rozmery komponenty
            this.pravouhelnik = new Rectangle(getWidth() / 3, getHeight() / 3, getWidth() / 3, getHeight() / 3);
        }

        g.drawRect(pravouhelnik.x, pravouhelnik.y, pravouhelnik.width, pravouhelnik.height);
    }
----
    private Point generujBod() {

        int x, y;
        x = (int) (Math.random() * getWidth());
        y = (int) (Math.random() * getHeight());

        return new Point(x, y);

    }

    public void kresliUsecku() {
        Point z = generujBod();
        Point k = generujBod();

        Graphics g = getGraphics();

        g.setColor(Color.black);
        g.drawLine(z.x, z.y, k.x, k.y);

        if (orezUseckuLBPravouhelnikem(z, k, pravouhelnik)) {
            g.setColor(Color.cyan);
            g.drawLine(z.x, z.y, k.x, k.y);
        }
    }
----
    private boolean orezUseckuLBPravouhelnikem(Point z, Point k, Rectangle hranice) {
        //Liang/barsky
        //vraci true/false malo se usecka orezavat, pres parametr z,k vraci hodnoty
        //bodu ve kterych dojde k oriznuti

        int dx = k.x - z.x;
        int dy = k.y - z.y;


        float p1 = -dx;
        float p2 = dx;
        float p3 = -dy;
        float p4 = dy;

        float q1 = z.x - hranice.x;
        float q2 = hranice.x + hranice.width - z.x;
        float q3 = z.y - hranice.y;
        float q4 = hranice.y + hranice.height - z.y;

        float[] p = {p1, p2, p3, p4};
        float[] q = {q1, q2, q3, q4};


        float u1 = 0, u2 = 1, r = 0;

        for (int i = 0; i < 4; i++) {

            if ((p[i] == 0) && (q[i] < 0)) {
                return false; //vynechame
            }

            if (p[i] != 0) {
                r = q[i] / p[i];
                if (p[i] < 0) {
                    u1 = Math.max(u1, r);
                } else if (p[i] > 0) { //p[i] > 0
                    u2 = Math.min(u2, r);
                }
            }
        }

        int x1 = (int) Math.round(z.x + u1 * dx);
        int y1 = (int) Math.round(z.y + u1 * dy);

        int x2 = (int) Math.round(z.x + u2 * dx);
        int y2 = (int) Math.round(z.y + u2 * dy);


        //vraceni odkazem
        z.x = x1;
        z.y = y1;

        k.x = x2;
        k.y = y2;


        if (u1 < u2) {
            return true;
        } else {
            return false;
        }
    }
----
    public static boolean jeBodVPravouhelniku(Point bod, Rectangle pravouhelnik) {
        if (bod.x > pravouhelnik.x && bod.x < pravouhelnik.x + pravouhelnik.width
                && bod.y > pravouhelnik.y && bod.y < pravouhelnik.y + pravouhelnik.height) {
            return true;
        } else {
            return false;

        }
    }
----
    public static boolean jeBodVPrav(Point p, Rectangle prav) {
        int xMin = prav.x;
        int xMax = prav.x + prav.width;
        int yMin = prav.y;
        int yMax = prav.y + prav.height;

        if ((p.x > xMin) && (p.x < xMax) && (p.y > yMin) && (p.y < yMax)) {
            return true;
        } else {
            return false;
        }
    }

    public static boolean orezUseckuLB(Point z, Point k, Rectangle rectHranice) {
        int xMin = rectHranice.x;
        int xMax = rectHranice.x + rectHranice.width;
        int yMin = rectHranice.y;
        int yMax = rectHranice.y + rectHranice.height;

        int dX = k.x - z.x;
        int dY = k.y - z.y;

        float[] p = new float[4];
        float[] q = new float[4];
        float r = 0;

        float u1 = 0f;
        float u2 = 1f;

        //Definice hodnot p a q
        p[0] = -dX;
        q[0] = z.x - xMin;

        p[1] = dX;
        q[1] = xMax - z.x;

        p[2] = -dY;
        q[2] = z.y - yMin;

        p[3] = dY;
        q[3] = yMax - z.y;

        for (int i = 0; i < 4; i++) {
            // vynechání úsečky
            if ((p[i] == 0) && (q[i] < 0)) {
                return false;
            }
            if (p[i] != 0) {
                r = q[i] / p[i];
            }
            if (p[i] < 0) {
                u1 = Math.max(u1, r);
            } else if (p[i] > 0) {
                u2 = Math.min(u2, r);
            }
        }

        Point nz = new Point();
        Point nk = new Point();

        nz.x = Math.round(z.x + u1 * dX);
        nz.y = Math.round(z.y + u1 * dY);
        nk.x = Math.round(z.x + u2 * dX);
        nk.y = Math.round(z.y + u2 * dY);

        z.x = nz.x;
        z.y = nz.y;
        k.x = nk.x;
        k.y = nk.y;

        if (u1 > u2) {
            return false;
        } else {
            return true;
        }
    }
</pre>

<a href="#">up</a>
<pre>
    if (obrazek != null) {
        VyplnAlgoritmy.vyplnRastr((BufferedImage) this.obrazek, evt.getPoint(), barvaVyplne);
        repaint();
    }
----
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);

        if (this.obrazek != null) {
            g.drawImage(obrazek, 0, 0, this);
        } else {
            g.setColor(Color.black);
            g.drawLine(0, 0, getWidth() - 1, getHeight() - 1);
            g.drawLine(0, getHeight() - 1, getWidth() - 1, 0);
        }

    }
----
    public static void vyplnRastr(BufferedImage bufObr, Point puvodniSeminko, Color barva) {

        int rgbPuvodSeminka = bufObr.getRGB(puvodniSeminko.x, puvodniSeminko.y);

        ArrayList<Seminko> zasobnik = new ArrayList<Seminko>();
        zasobnik.add(new Seminko(puvodniSeminko.x, puvodniSeminko.y, true, true));

        Seminko sem = null;

        Graphics g = bufObr.getGraphics();
        g.setColor(barva);

        while (!zasobnik.isEmpty()) { //dokud neni zasobnik prazdny
            sem = zasobnik.remove(zasobnik.size() - 1); //vybereme


            if (sem.nahoru == true && //seminko obsahuje smer nahoru a je vnitrni
                    rgbPuvodSeminka == bufObr.getRGB(sem.x, sem.y - 1)) {
                zasobnik.add(new Seminko(sem.x, sem.y - 1, true, false));
            }
            if (sem.dolu == true && //seminko obsahuje smer dolu a je vnitrni
                    rgbPuvodSeminka == bufObr.getRGB(sem.x, sem.y + 1)) {
                zasobnik.add(new Seminko(sem.x, sem.y + 1, false, true));
            }

            int minX = sem.x;
            int maxX = sem.x;

            int rgbHore = bufObr.getRGB(sem.x, sem.y - 1);
            int rgbDole = bufObr.getRGB(sem.x, sem.y + 1);


            if (sem.vlevo == true) { //hledame posledni vnitrni bod vlevo
                while (bufObr.getRGB(minX - 1, sem.y) == rgbPuvodSeminka) {
                    if (rgbHore != rgbPuvodSeminka &&
                            bufObr.getRGB(minX - 1, sem.y - 1) == rgbPuvodSeminka) {
                        zasobnik.add(new Seminko(minX - 1, sem.y - 1, true, false));
                    }
                    if (rgbDole != rgbPuvodSeminka &&
                            bufObr.getRGB(minX - 1, sem.y + 1) == rgbPuvodSeminka) {
                        zasobnik.add(new Seminko(minX - 1, sem.y + 1, false, true));
                    }
                    rgbHore = bufObr.getRGB(minX, sem.y - 1);
                    rgbDole = bufObr.getRGB(minX, sem.y + 1);
                    minX--;//posun vlevo
                }
            }

            rgbHore = bufObr.getRGB(sem.x, sem.y - 1);
            rgbDole = bufObr.getRGB(sem.x, sem.y + 1);

            if (sem.vpravo == true) {//hledame posledni vnitrni bod vpravo
                while (bufObr.getRGB(maxX + 1, sem.y) == rgbPuvodSeminka) {
                    if (rgbHore != rgbPuvodSeminka &&
                            bufObr.getRGB(maxX + 1, sem.y - 1) == rgbPuvodSeminka) {
                        zasobnik.add(new Seminko(maxX + 1, sem.y - 1, true, false));
                    }
                    if (rgbDole != rgbPuvodSeminka &&
                            bufObr.getRGB(maxX + 1, sem.y + 1) == rgbPuvodSeminka) {
                        zasobnik.add(new Seminko(maxX + 1, sem.y + 1, false, true));
                    }
                    rgbHore = bufObr.getRGB(minX, sem.y - 1);
                    rgbDole = bufObr.getRGB(minX, sem.y + 1);
                    maxX++; //posun vpravo
                }
            }

            g.drawLine(minX, sem.y, maxX, sem.y);
          //  for (int i = minX ; i <= maxX ; i++){
            //    bufObr.setRGB(i, sem.y, barva.getRGB());
           // }
        } //end while
    }
</pre>

<a href="#">up</a>
<pre>
    bodyBezier = new Point[4];
    this.pocetKroku = pocetKroku;
    this.labelPoziceMysi = labelPoziceMysi;
    this.indexAktbodu = -1;
----
    public void vymazat() {
        for (int i = 0; i < pocetBodu; i++) {
            bodyBezier[i] = null;
        }
        pocetBodu = 0;
        indexAktbodu = -1;
        repaint();
    }

    public void setPocetKroku(int pocetKroku) {
        this.pocetKroku = pocetKroku;
        repaint();
    }


    private void kresliBod(Graphics g, Point bod, Color barva) {
        g.setColor(barva);
        g.fillOval(bod.x - 2, bod.y - 2, 4, 4);
    }

    private void kresliSpojnice(Graphics g) {
        g.setColor(Color.green);

        if (pocetBodu >= 2) {
            for (int i = 0; i < pocetBodu - 1; i++) {
                g.drawLine(bodyBezier[i].x, bodyBezier[i].y, bodyBezier[i + 1].x, bodyBezier[i + 1].y);
            }
        }

        if (pocetBodu == 4) { //posledni bod s prvni
            g.drawLine(bodyBezier[0].x, bodyBezier[0].y, bodyBezier[pocetBodu - 1].x, bodyBezier[pocetBodu - 1].y);
        }
    }

    private int nejblizsiBod(Point poziceMysi) {
        double minVzdalenost = Integer.MAX_VALUE;
        double vzdalenost = 0;
        int index = 0;

        for (int i = 0; i < pocetBodu; i++) {
            vzdalenost = poziceMysi.distance(bodyBezier[i].x, bodyBezier[i].y);
            if (vzdalenost < minVzdalenost) {
                minVzdalenost = vzdalenost;
                index = i;
            }
        }
        return index;
    }

    private void kresliBeziera(Graphics g) {
        Point z, k;
        float t;

        g.setColor(Color.blue);

        z = bodyBezier[0];

        for (int i = 1; i <= pocetKroku; i++) {
            t = i / (float) pocetKroku;

            k = new Point();

            k.x = (int) Math.round(bodyBezier[0].x * Math.pow(1 - t, 3)
                    + bodyBezier[1].x * 3 * t * Math.pow(1 - t, 2)
                    + bodyBezier[2].x * 3 * Math.pow(t, 2) * (1 - t)
                    + bodyBezier[3].x * Math.pow(t, 3));

            k.y = (int) Math.round(bodyBezier[0].y * Math.pow(1 - t, 3)
                    + bodyBezier[1].y * 3 * t * Math.pow(1 - t, 2)
                    + bodyBezier[2].y * 3 * Math.pow(t, 2) * (1 - t)
                    + bodyBezier[3].y * Math.pow(t, 3));
            g.drawLine(z.x, z.y, k.x, k.y);

            z = k;
        }

    }

    @Override
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);


        //kresleni bodu
        for (int i = 0; i < pocetBodu; i++) {
            if (indexAktbodu >= 0 && indexAktbodu == i){
                kresliBod(g, bodyBezier[i], Color.red);
            }else{
                kresliBod(g, bodyBezier[i], Color.cyan);
            }
            g.drawString(String.valueOf(i), bodyBezier[i].x - 2, bodyBezier[i].y - 2);
        }
        //kresleni spojnic
        kresliSpojnice(g);
        //kresleni beziera
        if (pocetBodu == 4) {
            kresliBeziera(g);
        }
        //kresli beziera pomoci javy
        if (pocetBodu == 4){
            Graphics2D g2 = (Graphics2D) g;
            CubicCurve2D.Float cc = new CubicCurve2D.Float(
                    bodyBezier[0].x , bodyBezier[0].y,
                    bodyBezier[1].x , bodyBezier[1].y,
                    bodyBezier[2].x , bodyBezier[2].y,
                    bodyBezier[3].x , bodyBezier[3].y
                    );
            g2.setColor(Color.yellow);
            g2.draw(cc);
        }

    }
---- click
    switch (evt.getButton()) {
        case MouseEvent.BUTTON1:
            if (pocetBodu < 4) { // 0,1,2,3
                bodyBezier[pocetBodu] = evt.getPoint();
                pocetBodu++;
                repaint();
            }
            break;
    }
---- move
    if (pocetBodu > 0) {
        this.indexAktbodu = nejblizsiBod(evt.getPoint());
        repaint();
    }
    labelPoziceMysi.setText(evt.getX() + " : " + evt.getY());
---- drag
    if ((evt.getModifiersEx() & MouseEvent.BUTTON3_DOWN_MASK) == MouseEvent.BUTTON3_DOWN_MASK) {
        if (pocetBodu > 0) {
            int indexNejbliziho = nejblizsiBod(evt.getPoint());
            bodyBezier[indexNejbliziho].x = evt.getX();
            bodyBezier[indexNejbliziho].y = evt.getY();
            repaint();
        }
    }
----
----
    @Override
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);
        g.setColor(Color.white);
        g.fillRect(0, 0, getWidth(), getHeight());
        g.drawRect(0, 0, getWidth(), getWidth());

        if (!poleBodu.isEmpty()) {
            for (int i = 0; i < poleBodu.size(); i++) {
                vykresliBod(g, poleBodu.get(i), Color.red);
            }
        }

        g.setColor(Color.blue);
        if (poleBodu.size() == 4) {
            g.drawLine(poleBodu.get(0).x, poleBodu.get(0).y, poleBodu.get(1).x, poleBodu.get(1).y);
            g.drawLine(poleBodu.get(2).x, poleBodu.get(2).y, poleBodu.get(3).x, poleBodu.get(3).y);

            g.drawString("P0", poleBodu.get(0).x +5, poleBodu.get(0).y + 10);
            g.drawString("P'0", poleBodu.get(1).x +5, poleBodu.get(1).y + 10);
            g.drawString("P1", poleBodu.get(2).x +5, poleBodu.get(2).y + 10);
            g.drawString("P'1", poleBodu.get(3).x +5, poleBodu.get(3).y + 10);

            kresliFerguson(g);
        }

        if (nejblizsiBod != null) {
            vykresliBod(g, nejblizsiBod, Color.yellow);
        }
    }

    public void vykresliBod(Graphics g, Point p, Color barva) {
        g.setColor(barva);
        g.fillOval(p.x - 3, p.y - 3, 6, 6);
        g.setColor(Color.black);
        g.drawOval(p.x - 3, p.y - 3, 6, 6);
        //g.drawString(label, p.x + 6, p.y + 6);
    }

    public void zobrazSouradnice(Point p) {
        jLabelSouradnice.setText(p.x + ":" + p.y);
    }

    public void vymazat() {
        poleBodu.clear();
        nejblizsiBod = null;
        repaint();
    }

    public void setPocetKroku(int pocetKrokuu) {
        this.pocetKroku = pocetKrokuu;
        repaint();
    }

    public void kresliFerguson(Graphics g) {

        Point start = null;
        Point konec = null;
        float t;

        int vekt1x = poleBodu.get(1).x - poleBodu.get(0).x;
        int vekt1y = poleBodu.get(1).y - poleBodu.get(0).y;

        int vekt2x = poleBodu.get(3).x - poleBodu.get(2).x;
        int vekt2y = poleBodu.get(3).y - poleBodu.get(2).y;

        start = new Point(poleBodu.get(0));

        for(int krok = 0; krok <= pocetKroku; krok++) {
            t = (float) krok / pocetKroku;
            konec = new Point();

            konec.x = (int) Math.round(
                      poleBodu.get(0).x * (2 * t * t * t - 3 * t * t + 1)
                    + poleBodu.get(2).x * (-2 * t * t * t + 3 * t * t)
                    + vekt1x * (t * t * t - 2 * t * t + t)
                    + vekt2x * (t * t * t - t * t));

            konec.y = (int) Math.round(
                      poleBodu.get(0).y * (2 * t * t * t - 3 * t * t + 1)
                    + poleBodu.get(2).y * (-2 * t * t * t + 3 * t * t)
                    + vekt1y * (t * t * t - 2 * t * t + t)
                    + vekt2y * (t * t * t - t * t));

            g.setColor(Color.black);
            g.drawLine(start.x, start.y, konec.x, konec.y);

            start = konec;
        }
    }

    public Point nejblizsiBod(Point bod) {
        if (poleBodu.isEmpty()) {
            return null;
        }

        Point nejblizsi = poleBodu.get(0);
        double minVzdalenost = nejblizsi.distance(bod);

        for (int i = 0; i < poleBodu.size(); i++) {
            double vzdalenost = poleBodu.get(i).distance(bod);
            if (minVzdalenost > vzdalenost) {
                nejblizsi = poleBodu.get(i);
                minVzdalenost = vzdalenost;
            }
        }
        return nejblizsi;
    }
</pre>

<a href="#">up</a>
<pre>
   public PanelKresleni(JLabel labelPoziceMysi) {
        initComponents();
        setBackground(Color.white);

        body = new ArrayList<Point>();
        this.labelPoziceMysi = labelPoziceMysi;
        indexAktBodu = -1;
    }

    public void vymazat() {
        body.clear();
        indexAktBodu = -1;
        repaint();
    }

    private void kresliBod(Graphics g, Point bod, Color barva) {
        g.setColor(barva);
        g.fillOval(bod.x - 2, bod.y - 2, 4, 4);
    }

    private void seradBody() {
        int z = 0; //utridena cast
        boolean konec = false;

        while (!konec) {
            konec = true;
            for (int i = 0; i < body.size() - 1; i++) {
                if (body.get(i).x > body.get(i + 1).x) {
                    //vymena
                    Point p = body.get(i);
                    body.set(i, body.get(i + 1));
                    body.set(i + 1, p);
                    konec = false;
                }
            } //end for
        }//end while

    }

    private void kresliKrivku(Graphics g) {

        if (body.size() < 2){
            return;
        }

        g. setColor(Color.blue);

        Point z = new Point();
        Point k = new Point();


        int minX = body.get(0).x;
        int maxX = body.get(body.size() - 1).x;

        z.x = minX ;
        z.y = pocitejPolynom(minX);

        for (int i = minX ; i < maxX; i++) {
           k.x =  i;
           k.y = pocitejPolynom(i);
           g.drawLine(z.x, z.y, k.x, k.y);
           z = k;
        }

    }

    private int pocitejPolynom(int x) { //pro dane x vrati hodnotu polynomu y
        double y = 0;
        double citatel = 1; // 1 kvuli *= nasobeni
        double jmenovatel = 1;


        for (int k = 0; k < this.body.size(); k++) { //soucet
            for (int j = 0; j < this.body.size(); j++) { //soucin jmenovatele a citatele
                if (j != k) {
                    citatel *= x - body.get(j).x;
                    jmenovatel *= body.get(k).x - body.get(j).x;
                }
            } //end for j
            y += body.get(k).y * citatel / jmenovatel;
            //dalsi pruchod
            citatel = 1;
            jmenovatel = 1;
        } //end for k
        return (int) Math.round(y);
    }

    private int nejblizsiBod(Point poziceMysi) {
        double minVzdalenost = Integer.MAX_VALUE;
        double vzdalenost = 0;
        int index = 0;

        for (int i = 0; i < body.size(); i++) {
            vzdalenost = poziceMysi.distance(body.get(i).x, body.get(i).y);
            if (vzdalenost < minVzdalenost) {
                minVzdalenost = vzdalenost;
                index = i;
            }
        }
        return index;
    }

    @Override
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);

        //kresleni bodu
        for (int i = 0; i < body.size(); i++) {
            if (indexAktBodu == i && indexAktBodu >= 0) {
                kresliBod(g, body.get(i), Color.red);
            } else {
                kresliBod(g, body.get(i), Color.CYAN);
            }
            g.drawString(String.valueOf(i + 1), body.get(i).x - 2, body.get(i).y - 2);
        }

        //kresleni krivky
        kresliKrivku(g);

    }
---- click
    switch (evt.getButton()) {
        case MouseEvent.BUTTON1:
            if (body.size() < 20) {
                body.add(evt.getPoint());
                //musime seradit pole bodu podle x/ove souradnice
                seradBody();
                repaint();
            }
            break;
    }
---- move
    if (body.size() > 0) {
        indexAktBodu = nejblizsiBod(evt.getPoint());
        repaint();
    }
    labelPoziceMysi.setText(evt.getX() + " : " + evt.getY());
---- drag
    //prave tlacitko mysi
    if ((evt.getModifiersEx() & MouseEvent.BUTTON3_DOWN_MASK) == MouseEvent.BUTTON3_DOWN_MASK) {
        if (body.size() > 0) {
            int indexNejbliziho = nejblizsiBod(evt.getPoint());
            body.get(indexNejbliziho).x = evt.getX();
            body.get(indexNejbliziho).y = evt.getY();
            seradBody();
            repaint();
        }
    }
</pre>

<a href="#">up</a>
<pre>
public class AlgoritmyUpravy {

    private static int getR(int iBarva) {
        return (((iBarva) & 0xFF0000) >> 16);
    }

    private static int getG(int iBarva) {
        return (((iBarva) & 0x00FF00) >> 8);
    }

    private static int getB(int iBarva) {
        return ((iBarva) & 0x0000FF);
    }

    private static int jas(int iBarva) {

        int r = getR(iBarva);
        int g = getG(iBarva);
        int b = getB(iBarva);

        return (int) Math.round(0.299 * r + 0.587 * g + 0.114 * b);
    }

    private static int negativ(int iBarva) {
        int r = getR(iBarva);
        int g = getG(iBarva);
        int b = getB(iBarva);

        r = 255 - r;
        g = 255 - g;
        b = 255 - b;

        Color barva = new Color(r, g, b);
        return barva.getRGB();
    }

    public static BufferedImage prevodNaOdstinySede(BufferedImage orgObr) {
        if (orgObr == null) {
            return null;
        }

        //kopie, ale prazdna
        BufferedImage kopieObr = new BufferedImage(orgObr.getWidth(), orgObr.getHeight(), orgObr.getType());

        int jasHodnota = 0;
        Color barva = null;

        for (int y = 0; y < orgObr.getHeight(); y++) {
            for (int x = 0; x < orgObr.getWidth(); x++) {
                jasHodnota = jas(orgObr.getRGB(x, y));
                barva = new Color(jasHodnota, jasHodnota, jasHodnota);
                kopieObr.setRGB(x, y, barva.getRGB());
            }
        }

        return kopieObr;
    }

    public static BufferedImage prevodNaNegativ(BufferedImage orgObr) {
        if (orgObr == null) {
            return null;
        }
        //kopie, ale prazdna
        BufferedImage kopieObr = new BufferedImage(orgObr.getWidth(), orgObr.getHeight(), orgObr.getType());

        for (int y = 0; y < orgObr.getHeight(); y++) {
            for (int x = 0; x < orgObr.getWidth(); x++) {

                kopieObr.setRGB(x, y, negativ(orgObr.getRGB(x, y)));

            }
        }

        return kopieObr;

    }

    public static BufferedImage nahodneRozptylovani(BufferedImage orgObr) {
        if (orgObr == null) {
            return null;
        }

        //kopie, ale prazdna
        BufferedImage kopieObr = new BufferedImage(orgObr.getWidth(), orgObr.getHeight(), orgObr.getType());

        int nahodnyPrah = 0;
        Color cernaBarva = new Color(255, 255, 255);
        Color bilaBarva = new Color(0, 0, 0);
        Color pomBarva = null;
        for (int y = 0; y < orgObr.getHeight(); y++) {
            for (int x = 0; x < orgObr.getWidth(); x++) {
                nahodnyPrah = (int) Math.round(Math.random() * 255);
                pomBarva = new Color(nahodnyPrah, nahodnyPrah, nahodnyPrah);
                if (orgObr.getRGB(x, y) > pomBarva.getRGB()) {
                    kopieObr.setRGB(x, y, cernaBarva.getRGB());
                } else {
                    kopieObr.setRGB(x, y, bilaBarva.getRGB());
                }
            }
        }
        return kopieObr;

    }

    public static BufferedImage prahovani(BufferedImage orgObr, int prah) {
        if (orgObr == null) {
            return null;
        }

        //kopie, ale prazdna
        BufferedImage kopieObr = new BufferedImage(orgObr.getWidth(), orgObr.getHeight(), orgObr.getType());

        Color pomBarva = new Color(prah, prah, prah);
        Color cernaBarva = new Color(255, 255, 255);
        Color bilaBarva = new Color(0, 0, 0);

        for (int y = 0; y < orgObr.getHeight(); y++) {
            for (int x = 0; x < orgObr.getWidth(); x++) {

                if (orgObr.getRGB(x, y) > pomBarva.getRGB()) {
                    kopieObr.setRGB(x, y, cernaBarva.getRGB());
                } else {
                    kopieObr.setRGB(x, y, bilaBarva.getRGB());
                }
            }
        }
        return kopieObr;
    }

    public static BufferedImage zrcadleni(BufferedImage orgObr) {

        if (orgObr == null) {
            return null;
        }

        int polovina = orgObr.getWidth() / 2;

        Color barvaVlevo = null;
        Color barvaVpravo = null;

        if (polovina % 2 == 0) { //suda
            for (int y = 0; y < orgObr.getHeight(); y++) {
                for (int x = 0; x < polovina; x++) {

                    barvaVlevo = new Color(orgObr.getRGB(x, y));
                    barvaVpravo = new Color(orgObr.getRGB((orgObr.getWidth() - 1) - x, y));

                    orgObr.setRGB(x, y, barvaVpravo.getRGB());
                    orgObr.setRGB((orgObr.getWidth() - 1) - x, y, barvaVlevo.getRGB());
                }
            }

        } else { //licha

            for (int y = 0; y < orgObr.getHeight(); y++) {
                for (int x = 0; x < polovina - 1; x++) {

                    barvaVlevo = new Color(orgObr.getRGB(x, y));
                    barvaVpravo = new Color(orgObr.getRGB((orgObr.getWidth() - 1) - x, y));

                    orgObr.setRGB(x, y, barvaVpravo.getRGB());
                    orgObr.setRGB((orgObr.getWidth() - 1) - x, y, barvaVlevo.getRGB());
                }
            }

        }
        return orgObr;
    }

    public static BufferedImage distribuceChyby(BufferedImage origObr) {

        BufferedImage kopie = new BufferedImage(origObr.getWidth(), origObr.getHeight(), origObr.getType());

        float chyba = 0;
        Color barva = null;
        Color hranice = new Color(128, 128, 128);

        float tmpRGB = 0;
        int rgb = 0;



        for (int y = 0; y < origObr.getHeight(); y++) {
            for (int x = 0; x < origObr.getWidth(); x++) {

                chyba = jas(origObr.getRGB(x, y)) + jas(kopie.getRGB(x, y));

                if (chyba > 128 ) {
                    barva = Color.white;
                } else {
                    barva = Color.black;
                }

                chyba -= jas(barva.getRGB());

                kopie.setRGB(x  , y , barva.getRGB());


                //distribuce chyby
                if (x - 1 > 0 && y + 1 < origObr.getHeight()) { //dolu a zpet
                    tmpRGB = (chyba * 3) / 17;
                    rgb = kontrolaRozahuRGB(Math.round(tmpRGB));
                    barva = new Color(rgb, rgb, rgb);
                    kopie.setRGB(x - 1, y + 1, barva.getRGB());
                }

                if (y + 1 < origObr.getHeight()) { //dolu
                    tmpRGB = (chyba * 5) / 17;
                    rgb = kontrolaRozahuRGB(Math.round(tmpRGB));
                    barva = new Color(rgb, rgb, rgb);
                    kopie.setRGB(x, y + 1, barva.getRGB());
                }
                if (x + 1 < origObr.getWidth() && y + 1 < origObr.getHeight()) { //dolu a dopredu
                    tmpRGB = chyba / 17;
                    rgb = kontrolaRozahuRGB(Math.round(tmpRGB));
                    barva = new Color(rgb, rgb, rgb);
                    kopie.setRGB(x + 1, y + 1, barva.getRGB());
                }
                if (x + 1 < origObr.getWidth()) { //doprava
                    tmpRGB = (chyba * 7) / 17;
                    rgb = kontrolaRozahuRGB(Math.round(tmpRGB));
                    barva = new Color(rgb, rgb, rgb);
                    kopie.setRGB(x + 1, y, barva.getRGB());
                }
            }
        }
        return kopie;
    }

    private static int kontrolaRozahuRGB(int rgb) {
        if (rgb > 255) {
            return 255;
        }
        if (rgb < 0) {
            return 0;
        }
        return rgb;
    }

    public static BufferedImage emboss(BufferedImage orgObr, int posun) {
        BufferedImage kopieObr = new BufferedImage(orgObr.getWidth(), orgObr.getHeight(), orgObr.getType());

        //int upraveneRGB = 0;
        //int posunNegativuRGB = 0;
        Color barva = null;
        int r1 = 0, g1 = 0, b1 = 0;
        int r2 = 0, g2 = 0, b2 = 0;


        for (int y = 0; y < orgObr.getHeight(); y++) {
            for (int x = 0; x < orgObr.getWidth(); x++) {

                if (x + posun > orgObr.getWidth() || y - posun <= 0) { //neco mimo
                    if (x + posun > orgObr.getWidth() && y - posun <= 0) { //oba mimo
                        //posunNegativuRGB = 1 - orgObr.getRGB(orgObr.getWidth() - 1, 0);
                        r2 = 1 - getR(orgObr.getRGB(orgObr.getWidth() - 1, 0));
                        g2 = 1 - getG(orgObr.getRGB(orgObr.getWidth() - 1, 0));
                        b2 = 1 - getB(orgObr.getRGB(orgObr.getWidth() - 1, 0));
                    }
                    if (x + posun > orgObr.getWidth() && y - posun >= 0) { //x mimo, y ne
                        // posunNegativuRGB = 1 - orgObr.getRGB(orgObr.getWidth() - 1, y - posun);
                        r2 = 1 - getR(orgObr.getRGB(orgObr.getWidth() - 1, y - posun));
                        g2 = 1 - getG(orgObr.getRGB(orgObr.getWidth() - 1, y - posun));
                        b2 = 1 - getB(orgObr.getRGB(orgObr.getWidth() - 1, y - posun));
                    }
                    if (x + posun < orgObr.getWidth() && y - posun <= 0) { // x ne, y mimo
                        // posunNegativuRGB = 1 - orgObr.getRGB(x + posun, 0);
                        r2 = 1 - getR(orgObr.getRGB(x + posun, 0));
                        g2 = 1 - getG(orgObr.getRGB(x + posun, 0));
                        b2 = 1 - getB(orgObr.getRGB(x + posun, 0));
                    }
                } else if (x + posun < orgObr.getWidth() && y - posun >= 0) { //OK
                    //posunNegativuRGB = 1 - orgObr.getRGB(x + posun, y - posun);
                    r2 = 1 - getR(orgObr.getRGB(x + posun, y - posun));
                    g2 = 1 - getG(orgObr.getRGB(x + posun, y - posun));
                    b2 = 1 - getB(orgObr.getRGB(x + posun, y - posun));
                }

                //upraveneRGB = (orgObr.getRGB(x, y) + posunNegativuRGB) / posun;
                //upraveneRGB = kontrolaRozahuRGB(upraveneRGB);
                r1 = (getR(orgObr.getRGB(x, y)) + r2) / 2;
                g1 = (getG(orgObr.getRGB(x, y)) + g2) / 2;
                b1 = (getB(orgObr.getRGB(x, y)) + b2) / 2;

                r1 = kontrolaRozahuRGB(r1);
                g1 = kontrolaRozahuRGB(g1);
                b1 = kontrolaRozahuRGB(b1);

                barva = new Color(r1, g1, b1);
                kopieObr.setRGB(x, y, barva.getRGB());

            }
        }

        return kopieObr;
    }
}
----
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);

        g.setColor(Color.black);

        if (obrazek == null){
            g.drawLine(0, 0, getWidth() - 1, getHeight() -1);
            g.drawLine(getWidth() - 1 , 0, 0, getHeight() -1);
            g.drawRect(0, 0, getWidth() - 1, getHeight() -1);
        }else{
            g.drawImage(obrazek, 0, 0, this);
        }
    }
</pre>

<a href="#">up</a>
<pre>
public class JPanelHistogram extends javax.swing.JPanel {

    private BufferedImage obrazek = null;
    private int[] histogramJas = new int[256];
    private int[] histogramRed = new int[256];
    private int[] histogramGreen = new int[256];
    private int[] histogramBlue = new int[256];

    public JPanelHistogram(BufferedImage obrazek) {
        initComponents();
        this.obrazek = obrazek;
    }

    public void setObrazek(BufferedImage obrazek) {
        this.obrazek = obrazek;
        repaint();
    }

    @Override
    protected void paintComponent(Graphics g) {
        if (obrazek != null) {
            kresliHistogram(g);
        }
    }

    private void pocitejHistogram() {
        int r = 0, g = 0, b = 0, jas = 0;

        for (int y = 0; y < obrazek.getHeight(); y++) {
            for (int x = 0; x < obrazek.getWidth(); x++) {
                r = UpravyObr.getR(obrazek.getRGB(x, y));
                g = UpravyObr.getG(obrazek.getRGB(x, y));
                b = UpravyObr.getB(obrazek.getRGB(x, y));
                jas = UpravyObr.jas(obrazek.getRGB(x, y));

                histogramRed[r]++;
                histogramGreen[g]++;
                histogramBlue[b]++;
                histogramJas[jas]++;
            }
        }

    }

    private int najdiMax() {
        int max = Integer.MIN_VALUE;

        for (int i = 0; i < histogramJas.length; i++) {

            if (histogramJas[i] > max) {
                max = histogramJas[i];
            }

            if (histogramRed[i] > max) {
                max = histogramRed[i];
            }

            if (histogramGreen[i] > max) {
                max = histogramGreen[i];
            }
            if (histogramBlue[i] > max) {
                max = histogramBlue[i];
            }


        }
        return max;
    }

    private void kresliHistogram(Graphics g) {

        vynulujPole();
        pocitejHistogram();

        int vyska = getHeight();
        int maxPocet = najdiMax();

        float pomer = (float) vyska / maxPocet;

        float yJas = 0;
        int[] yRed = new int[256];
        int[] yGreen = new int[256];
        int[] yBlue = new int[256];
        int[] souradniceX = new int[256];



        for (int x = 0; x < 256; x++) {
            g.setColor(Color.BLACK);
            yJas = histogramJas[x] * pomer;
            //takhle to je vzhuru nohama
            //g.drawLine(x, 0, x, Math.round(y));
            g.drawLine(x, getHeight(), x, getHeight() - Math.round(yJas));
            souradniceX[x] = x;
            yRed[x] = getHeight() - Math.round(histogramRed[x] * pomer);
            yGreen[x] = getHeight() - Math.round(histogramGreen[x] * pomer);
            yBlue[x] = getHeight() - Math.round(histogramBlue[x] * pomer);

        }

        g.setColor(Color.red);
        g.drawPolyline(souradniceX, yRed, 256);
        g.setColor(Color.green);
        g.drawPolyline(souradniceX, yGreen, 256);
        g.setColor(Color.blue);
        g.drawPolyline(souradniceX, yBlue, 256);
    }

    private void vynulujPole() {
        //nulovani poli
        for (int i = 0; i < histogramJas.length; i++) {
            histogramJas[i] = 0;
            histogramRed[i] = 0;
            histogramGreen[i] = 0;
            histogramBlue[i] = 0;
        }
    }
----
    protected void paintComponent(Graphics g) {
        if (obrazek != null) {
            g.drawImage(obrazek, 0, 0, this);
        } else {
            g.setColor(Color.BLACK);
            g.drawString("Bez obrazku", getWidth()/ 2, getHeight() /2);

        }
    }
----
public class UpravyObr {

    public static int getR(int iBarva) {
        return (((iBarva) & 0xFF0000) >> 16);
    }

    public static int getG(int iBarva) {
        return (((iBarva) & 0x00FF00) >> 8);
    }

    public static int getB(int iBarva) {
        return ((iBarva) & 0x0000FF);
    }

    public static int jas(int iBarva) {

        int r = getR(iBarva);
        int g = getG(iBarva);
        int b = getB(iBarva);

        return (int) Math.round(0.299 * r + 0.587 * g + 0.114 * b);
    }

    public static BufferedImage upravCernyBilyBod(BufferedImage obrazekOrig, int cerny, int bily) {

        if (bily < 0 || bily > 255 || cerny < 0 || cerny > 255) {
            return null;
        }

        BufferedImage obrazek = new BufferedImage(obrazekOrig.getWidth(), obrazekOrig.getHeight(), obrazekOrig.getType());

        int rozsah = bily - cerny;

        float pomer = (float) 255 / rozsah;

        int jas = 0;
        int upravenyJas = 0;

        Color cerna = new Color(0, 0, 0);
        Color bila = new Color(255, 255, 255);
        Color barva = null;

        for (int y = 0; y < obrazek.getHeight(); y++) {
            for (int x = 0; x < obrazek.getWidth(); x++) {
                jas = jas(obrazekOrig.getRGB(x, y));
                if (jas < cerny) {
                    obrazek.setRGB(x, y, cerna.getRGB());
                } else if (jas > bily) {
                    obrazek.setRGB(x, y, bila.getRGB());
                } else {
                    upravenyJas = Math.round((jas - cerny) * pomer);
                    barva = new Color(upravenyJas, upravenyJas, upravenyJas);
                    obrazek.setRGB(x, y, barva.getRGB());
                }

            }
        }

        return obrazek;

    }

    public static BufferedImage upravaJasu(BufferedImage obrazekOrig, int jasZmena) {

        BufferedImage obrazek = new BufferedImage(obrazekOrig.getWidth(), obrazekOrig.getHeight(), obrazekOrig.getType());


        int jas = 0;
        int upravenyJas = 0;
        Color barva = null;

        for (int y = 0; y < obrazek.getHeight(); y++) {
            for (int x = 0; x < obrazek.getWidth(); x++) {
                jas = jas(obrazekOrig.getRGB(x, y));
                barva = new Color(kontrolaRozsahu(jas + jasZmena),kontrolaRozsahu(jas + jasZmena),kontrolaRozsahu(jas + jasZmena));
                obrazek.setRGB(x, y, barva.getRGB());
            }
        }

        return obrazek;
    }

    private static int kontrolaRozsahu(int jas) {
        if (jas > 255) {
            return 255;
        } else if (jas < 0) {
            return 0;
        } else {
            return jas;
        }
    }
}
</pre>

<a href="#">up</a>
<pre>
  private ArrayList<Polygon> seznam = new ArrayList<Polygon>();

  public PanelKresleni(Color barva) {
    initComponents();
    this.barvaVyplne = barva;
    nastavPolygony();

  }

  @Override
  protected void paintComponent(Graphics g) {
    super.paintComponent(g);
    g.setColor(Color.BLACK);

    for (int i = 0; i < seznam.size(); i++) {
      g.drawPolygon(seznam.get(i));
    }

  }

  void setObrazek(BufferedImage obrazek) {
    this.obrazek = obrazek;
  }

  void nastavBarvu(Color barva) {
    this.barvaVyplne = barva;
  }

  @Override
  public Dimension preferredSize() {
    return new Dimension(330, 380);
  }

  private void vyplnPolygon(Polygon p) {
    int yMin, yMax;
    Graphics g = getGraphics();

    yMin = p.ypoints[0];
    yMax = p.ypoints[0];

    for (int i = 1; i < p.npoints; i++) {
      if (p.ypoints[i] < yMin) {
        yMin = p.ypoints[i];
      } else if (p.ypoints[i] > yMax) {
        yMax = p.ypoints[i];
      }
    }

    ArrayList<Float> prus;

    g.setColor(barvaVyplne);
    for (int y = yMin; y < yMax; y++) {
      prus = hledejPrusecik(p, y);
      //System.out.println(prus.size());
      if (prus.size() >= 2) {
        //System.out.println(prus);
        for (int i = 0; i < prus.size(); i += 2) {
          if(this.obrazek != null) {
            int xMin = Math.round(prus.get(i));
            int xMax = Math.round(prus.get(i + 1));
            int delka = this.obrazek.getWidth();
            int vyska = this.obrazek.getHeight();
            Point aktP = new Point();
            int barva;
            Color barvaPixelu;

            for(int x = xMin; x < xMax; x++) {
              aktP = new Point(x % delka, y % vyska);
              barva = this.obrazek.getRGB(aktP.x, aktP.y);
              barvaPixelu = getBarva(barva);
              g.setColor(barvaPixelu);
              g.drawLine(x, y, x, y);
            }
          }
          else {
            g.drawLine(Math.round(prus.get(i)), y, Math.round(prus.get(i + 1)), y);
          }
        }
      }
    }

  }

  private ArrayList<Float> hledejPrusecik(Polygon p, int y) {
    Point pZacatek, pKonec;
    int zx, zy, kx, ky;
    float prusX;
    int dx, dy;
    float smernice;
    ArrayList<Float> pruseciky = new ArrayList<Float>();

    pZacatek = new Point(p.xpoints[p.npoints - 1], p.ypoints[p.npoints - 1]);

    for (int i = 0; i < p.npoints; i++) {
      pKonec = new Point(p.xpoints[i], p.ypoints[i]);

      if (pKonec.y >= pZacatek.y) {
        kx = pKonec.x;
        ky = pKonec.y;
        zx = pZacatek.x;
        zy = pZacatek.y;
      } else {
        zx = pKonec.x;
        zy = pKonec.y;
        kx = pZacatek.x;
        ky = pZacatek.y;
      }

      dx = kx - zx;
      dy = ky - zy;

      /////////////////
      if(dy < 0) {
        System.out.println("nekde chyba");
      }////////////////

      if (dy != 0) {
        smernice = (float) dy / dx;
        //System.out.println(smernice);
        kx = Math.round(kx - 1 / smernice);
        ky -= 1;

        if (zy <= y && ky >= y) {
          // existuje průsečík
          prusX = zx + (y - zy) / smernice;
          pruseciky.add(prusX);
        }
      }
      pZacatek = pKonec;
    }
    //System.out.println(pruseciky.size());
    bubblesort(pruseciky);
    return pruseciky;
  }
</pre>

<a href="#">up</a>
<pre>
public class Otoceni {

    public static BufferedImage otoceniOStupnu(float pocetStupnuRad, BufferedImage orig) {
        BufferedImage img = null;
        int puvSirka = orig.getWidth();
        int puvVyska = orig.getHeight();


        double e = Math.sin(pocetStupnuRad);
        double d = Math.cos(pocetStupnuRad);

        double posun = Math.cos(1.5707 - pocetStupnuRad) * puvVyska;
        double x2 =  Math.cos(pocetStupnuRad) * puvSirka;
        int sirka = (int) (posun+x2);

        double y1 = Math.sin(1.5707 - pocetStupnuRad) * puvVyska;
        double y2 =  Math.sin(pocetStupnuRad) * puvSirka;

        int vyska = (int) (y1+y2);

        img = new BufferedImage(sirka+1, vyska+1, orig.getType());

        for (int x = 0; x < orig.getWidth(); x++) {
            for (int y = 0; y < orig.getHeight(); y++) {
                int barva = orig.getRGB(x, y);
                int noveX = (int) ((x * Math.cos(pocetStupnuRad) - y * Math.sin(pocetStupnuRad)) + posun);
                int noveY = (int) ((x * Math.sin(pocetStupnuRad) + y * Math.cos(pocetStupnuRad)));
                img.setRGB(noveX, noveY, barva);
            }
        }
        return img;
    }
}
----
public class Orezavani {

    public static BufferedImage Orez(Rectangle rec, BufferedImage orig) {
        BufferedImage imgOrez = null;

        imgOrez = new BufferedImage(rec.width, rec.height, orig.getType());
        int x = 0;
        int y = 0;

        for (int i = rec.x; i < (rec.width+rec.x); i++) {
            for (int j = rec.y; j <(rec.height+rec.y); j++) {
                int barva = orig.getRGB(i, j);
                imgOrez.setRGB(y, x, barva);
                x++;
            }
            x=0;
            y++;
        }
        return imgOrez;
    }
}
----
    private void drawJavaCubic(Graphics2D g2d)
    {
        if (points.size() < MaxPoints)
            return;

        g2d.setColor(Color.PINK);

        CubicCurve2D.Float cubicCurve = new CubicCurve2D.Float(
                points.get(0).x, points.get(0).y,
                points.get(1).x, points.get(1).y,
                points.get(2).x, points.get(2).y,
                points.get(3).x, points.get(3).y);

        g2d.draw(cubicCurve);
    }
----
  public static void kresliElipsu(Graphics g,int sX, int sY, int a, int b) {
    int x, y;
    double aa, bb, pi;
    x = 0;
    y = b;
    aa = a * a;
    bb = b * b;
    pi = bb - aa * b + aa / 4;

    g.drawLine(sX + x, sY + y, sX + x, sY + y);
    g.drawLine(sX + x, sY - y, sX + x, sY - y);
    g.drawLine(sX - x, sY + y, sX - x, sY + y);
    g.drawLine(sX - x, sY - y, sX - x, sY - y);
    //Body(x,y);                        /* 4 středově symetrické body */

    //while (aa * (y - 0.5) > bb * (x + 1)) /* oblast 1 */ {
    while (aa * (y - 0.5) > bb * (x + 1)) /* oblast 1 */ {
      if (pi < 0) {
        pi = pi + bb * (2 * x + 3);
        x++;
      } else {
        pi = pi + bb * (2 * x + 3) + aa * (-2 * y + 2);
        x++;
        y--;
      }

    g.drawLine(sX + x, sY + y, sX + x, sY + y);
    g.drawLine(sX + x, sY - y, sX + x, sY - y);
    g.drawLine(sX - x, sY + y, sX - x, sY + y);
    g.drawLine(sX - x, sY - y, sX - x, sY - y);      //Body(x,y);
    }
    pi = bb * (x + 0.5) * (x + 0.5) + aa * (y - 1) * (y - 1) - aa * bb;

    while (y > 0) /* oblast 2 */ {
    //while (y > 0) /* oblast 2 */ {
      if (pi < 0) {
        pi = pi + bb * (2 * x + 2) + aa * (-2 * y + 3);
        x++;
        y--;
      } else {
        pi = pi + aa * (-2 * y + 3);
        y--;
      }

    g.drawLine(sX + x, sY + y, sX + x, sY + y);
    g.drawLine(sX + x, sY - y, sX + x, sY - y);
    g.drawLine(sX - x, sY + y, sX - x, sY + y);
    g.drawLine(sX - x, sY - y, sX - x, sY - y);      //Body(x, y);
    }
    }
</pre>

<a href="#">up</a>
<pre>
    private Image image;
    AffineTransform identity = new AffineTransform();

    Graphics2D g2d = (Graphics2D)g;
    AffineTransform trans = new AffineTransform();
    trans.setTransform(identity);
    trans.rotate( Math.toRadians(45) );
    g2d.drawImage(image, trans, this);
----
    public void paint(Graphics g) {
        Graphics2D g2d = (Graphics2D)g;
        AffineTransform trans = new AffineTransform();
        trans.setTransform(identity);
        trans.rotate( Math.toRadians(45) );
        g2d.drawImage(image, trans, this);
    }
----
    public static BufferedImage rotateMyImage(BufferedImage img, double angle) {
        int w = img.getWidth();
        int h = img.getHeight();
        BufferedImage dimg =new BufferedImage(w, h, img.getType());
        Graphics2D g = dimg.createGraphics();
        g.setRenderingHint(RenderingHints.KEY_ANTIALIASING, // Anti-alias!
        RenderingHints.VALUE_ANTIALIAS_ON);
        g.rotate(Math.toRadians(angle), w/2, h/2);
        g.drawImage(img, null, 0, 0);
        return dimg;
    }
----
    return Math.toRadians(slider.getValue());
----
    @Override
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);

        Graphics2D g2d = (Graphics2D) g.create();

        g2d.setColor(Color.RED);
        g2d.drawLine(getWidth() / 2, 0, getWidth() / 2, getHeight());
        g2d.drawLine(0, getHeight() / 2, getWidth(), getHeight() / 2);

        g2d.setColor(Color.BLACK);
        int x = (getWidth() - rectangle.width) / 2;
        int y = (getHeight() - rectangle.height) / 2;
        AffineTransform at = new AffineTransform();
        at.setToRotation(getAngle(), x + (rectangle.width / 2), y + (rectangle.height / 2));
        at.translate(x, y);
        g2d.setTransform(at);
        g2d.draw(rectangle);
        g2d.dispose();
    }
----
    public static Image rotate(Image img, double angle)
    {
        double sin = Math.abs(Math.sin(Math.toRadians(angle))),
               cos = Math.abs(Math.cos(Math.toRadians(angle)));

        int w = img.getWidth(null), h = img.getHeight(null);

        int neww = (int) Math.floor(w*cos + h*sin),
            newh = (int) Math.floor(h*cos + w*sin);

        BufferedImage bimg = toBufferedImage(getEmptyImage(neww, newh));
        Graphics2D g = bimg.createGraphics();

        g.translate((neww-w)/2, (newh-h)/2);
        g.rotate(Math.toRadians(angle), w/2, h/2);
        g.drawRenderedImage(toBufferedImage(img), null);
        g.dispose();

        return toImage(bimg);
    }
----
    public static BufferedImage tilt(BufferedImage image, double angle) {
        double sin = Math.abs(Math.sin(angle)),
                cos = Math.abs(Math.cos(angle));
        int w = image.getWidth(),
            h = image.getHeight();
        int neww = (int)Math.floor(w*cos+h*sin),
            newh = (int)Math.floor(h*cos+w*sin);
        GraphicsConfiguration gc = getDefaultConfiguration();
        BufferedImage result = gc.createCompatibleImage(neww, newh, Transparency.TRANSLUCENT);
        Graphics2D g = result.createGraphics();
        g.translate((neww-w)/2, (newh-h)/2);
        g.rotate(angle, w/2, h/2);
        g.drawRenderedImage(image, null);
        g.dispose();
        return result;
    }
----
    //vytvoření objektu GradientPaint pro levý obrázek (prechod)
    GradientPaint gr = new GradientPaint(0,0,Color.red,100,0,Color.green,true);
    //vytvoření objektu GradientPaint pro pravý obrázek - zatím jako komentář
    //GradientPaint gr = new GradientPaint(0,0,Color.red,100,0,Color.green,false);
    //...
    //V metodě paint pak nastavíte štětec takto:
    g2.setPaint(gr);
</pre>

<a href="#">up</a>
<pre>
    public static void bubbleSort(int[] array){
        for (int i = 0; i < array.length - 1; i++) {
            for (int j = 0; j < array.length - i - 1; j++) {
                if(array[j] < array[j+1]){
                    int tmp = array[j];
                    array[j] = array[j+1];
                    array[j+1] = tmp;
                }
            }
        }
    }
----
    // u1-u2: usecka A, u3-u4: usecka B
    private static Point vypocetPruniku(Point u1, Point u2, Point u3, Point u4) {
        int x = ((u2.y - u1.y) * (u4.x - u3.x) * u1.x + (u2.x - u1.x) * (u4.x - u3.x) * (u3.y - u1.y) - (u4.y - u3.y) * (u2.x - u1.x) * u3.x) / ((u2.y - u1.y) * (u4.x - u3.x) - (u2.x - u1.x) * (u4.y - u3.y));
        int y = (x * (u2.y - u1.y) + u1.y * (u2.x - u1.x) - u1.x * (u2.y - u1.y)) / (u2.x - u1.x);
        if ((x >= Math.min(u1.x, u2.x) && x <= Math.max(u1.x, u2.x))
                && (x >= Math.min(u3.x, u4.x) && x <= Math.max(u3.x, u4.x))
                && (y >= Math.min(u1.y, u2.y) && y <= Math.max(u1.y, u2.y))
                && (y >= Math.min(u3.y, u4.y) && y <= Math.max(u3.y, u4.y))) {
            return new Point(x, y);
        }
        return null;
    }
----
    public void otocObrazek90() {
        if (obrazek == null) {
            return;
        }
        BufferedImage kopie = new BufferedImage(obrazek.getHeight(), obrazek.getWidth(), obrazek.getType());
        int pixel;

        for (int x = 0; x < obrazek.getWidth(); x++) {
            for (int y = 0; y < obrazek.getHeight(); y++) {
                pixel = obrazek.getRGB(x, y);
                kopie.setRGB(kopie.getWidth() - y - 1, x, pixel);
            }
        }
        setObrazek(kopie);
    }

    public void setObrazek(BufferedImage obrazek) {
        this.obrazek = obrazek;
        setPreferredSize(new Dimension(obrazek.getWidth(), obrazek.getHeight()));
        repaint();
        revalidate();
    }
----
    double angle = Math.toRadians(++rotate);
    Graphics2D g = (Graphics2D) getGraphics();

    int w = this.obrazek.getWidth();
    int h = this.obrazek.getHeight();

    AffineTransform trans = new AffineTransform();
    trans.rotate(angle, w - (w / 2), h - (h / 2));
    g.fillRect(0, 0, getWidth(), getHeight());
    g.drawImage(this.obrazek, trans, this);
    g.dispose();
----
    int w = this.obrazek.getWidth();
    int h = this.obrazek.getHeight();
    BufferedImage kopie = new BufferedImage(h, w, this.obrazek.getType());
    int pixel;

    for (int x = 0; x < w; x++) {
        for (int y = 0; y < h; y++) {
            pixel = this.obrazek.getRGB(x, y);
            kopie.setRGB(kopie.getWidth() - y - 1, x, pixel);
        }
    }
    this.obrazek = kopie;
    repaint();
----
    Polygon p;
    int xPoint[] = {80, 130, 200, 320, 400};
    int yPoint[] = {40, 190, 10, 40, 200};

    p = new Polygon(xPoint, yPoint, 5);
    g.drawPolygon(p);

    static void VyplnPolygon(Polygon p, Graphics g, Color barva) {
        if (p == null) {
            return;
        }


        int minY = p.ypoints[0];
        int maxY = p.ypoints[0];


        for (int i = 1; i < p.npoints; i++) { // vyberu minY a maxY
            if (p.ypoints[i] < minY) {
                minY = p.ypoints[i];
            }

            if (p.ypoints[i] > maxY) {
                maxY = p.ypoints[i];
            }
        }

        ArrayList<Float> seznam;

        g.setColor(barva);
        //projizdim od minY do maxY a vyplnuju
        for (int y = minY; y < maxY; y++) {  // v kazdem y hledam seznam pruseciku na ose x
            seznam = UrceniPruseciku(p, y);
            //jestli je seznam vetsi nez 1 a jestli jsou pruseciky sude, spojim je
            if ((seznam.size() > 1) && (seznam.size() % 2) == 0) {
                for (int i = 0; i <= seznam.size() - 2; i += 2) {
                    g.drawLine(Math.round(seznam.get(i)), y, Math.round(seznam.get(i + 1)), y);
                }
            }
        }
    }

    private static ArrayList<Float> UrceniPruseciku(Polygon p, int y) {
        ArrayList<Float> seznamPruseciku = new ArrayList<Float>();
        //zacatek a konec os X, Y
        int zx, zy, kx, ky;
        float x;

        int dx, dy;          // delta x, y
        float smernice;

        Point zacatek = new Point(p.xpoints[0], p.ypoints[0]);
        Point konec;

        for (int i = 0; i < p.npoints; i++) { // cyklem projedu vsechny body polygonu
            konec = new Point(p.xpoints[p.npoints - i - 1], p.ypoints[p.npoints - i - 1]);

            //orientovat hrany(doufam)
            if (zacatek.y < konec.y) {
                zx = zacatek.x;
                zy = zacatek.y;

                kx = konec.x;
                ky = konec.y;
            } else {
                kx = zacatek.x;
                ky = zacatek.y;

                zx = konec.x;
                zy = konec.y;
            }
            //velikost usecky dx
            dx = kx - zx;
            //velikost usecky dy
            dy = ky - zy;

            if (dy != 0) { //vypocet smernice (vzorec) smernice = (dy / dx) => dx = zx - kx; dy = zy - ky
                smernice = (float) dy / dx;
                ky = ky - 1;

                if (dx != 0) {
                    kx = Math.round(kx - 1 / smernice);
                }

                if (zy <= y && ky >= y) {
                    if (dx != 0) {
                        x = zx + (y - zy) / smernice;
                    } else {
                        x = zx;
                    }
                        seznamPruseciku.add(x);
                }
            }
            zacatek = konec;
        }
        Collections.sort(seznamPruseciku);
        return seznamPruseciku;
    }

    if (p.contains(bod)) {
        PanelKresleni.VyplnPolygon(p, g, Color.green);
    }
----
    g.drawImage(obrazek, 0, 0, sirka, vyska, this);

    public void zmenProporcionalneVelikost2() {
        double dW = (double) getWidth() / (double) obrazek.getWidth();
        double dH = (double) getHeight() / (double) obrazek.getHeight();
        double ratio = Math.min(dW, dH);
        sirka = (int) (ratio * obrazek.getWidth());
        vyska = (int) (ratio * obrazek.getHeight());
        repaint();
    }
----
----
    public void zoom(BufferedImage original, int vstupni_pomer) {

        double pomer = vstupni_pomer / (double) 100;
        int nova_velikost_x = (int) (pomer * original.getWidth());
        int nova_velikost_y = (int) (pomer * original.getHeight());
        BufferedImage upraveny = new BufferedImage(nova_velikost_x, nova_velikost_y, BufferedImage.TYPE_INT_RGB);

        int r, g, b;
        int rgb1, rgb2, rgb3, rgb4;
        double m, n;
        double dpx, dpy;

        for (int x = 0; x < upraveny.getWidth(); x++) {
            for (int y = 0; y < upraveny.getHeight(); y++) {
                dpx = x / pomer;
                dpy = y / pomer;
                m = dpx - Math.ceil(dpx);
                n = dpy - Math.ceil(dpy);

                if (Math.ceil(dpx) >= original.getWidth() || Math.ceil(dpy) >= original.getHeight()) {
                    continue;
                }
                rgb1 = original.getRGB((int) Math.floor(dpx), (int) Math.floor(dpy));
                rgb2 = original.getRGB((int) Math.ceil(dpx), (int) Math.floor(dpy));
                rgb3 = original.getRGB((int) Math.floor(dpx), (int) Math.ceil(dpy));
                rgb4 = original.getRGB((int) Math.ceil(dpx), (int) Math.ceil(dpy));

                r = (int) Math.round((1 - n) * ((1 - m) * zjistiR(rgb1) + m * zjistiR(rgb2))
                        + (n) * ((1 - m) * zjistiR(rgb3) + m * zjistiR(rgb4)));
                g = (int) Math.round((1 - n) * ((1 - m) * zjistiG(rgb1) + m * zjistiG(rgb2))
                        + (n) * ((1 - m) * zjistiG(rgb3) + m * zjistiG(rgb4)));
                b = (int) Math.round((1 - n) * ((1 - m) * zjistiB(rgb1) + m * zjistiB(rgb2))
                        + (n) * ((1 - m) * zjistiB(rgb3) + m * zjistiB(rgb4)));
                upraveny.setRGB(x, y, new Color(overRozsah(r), overRozsah(g), overRozsah(b)).getRGB());
            }
        }
        this.setObrazek(upraveny);

    }

    private int overRozsah(int kanal) {
        int overeno;
        if (kanal > 255) {
            overeno = 255;
        } else if (kanal < 0) {
            overeno = 0;
        } else {
            overeno = kanal;
        }
        return overeno;
    }

    private int zjistiR(int barva) {
        int r = (barva & 0xFF0000) >> 16;
        return r;
    }

    private int zjistiG(int barva) {
        int g = (barva & 0xFF00) >> 8;
        return g;
    }

    private int zjistiB(int barva) {
        int b = (barva & 0xFF);
        return b;
    }
----
    Point bodyKrivky[] = new Point[4];
    int aktualniBod;
    int pocetBodu = 0;
    int pocetKroku = 20;

    public JPanel_Canvas(JLabel souradnice)
    {
        initComponents();
        this.jLabel_Souradnice = souradnice;
    }

    public void vymazatBody()
    {
        for (int i = 0; i < pocetBodu; i++) {
            bodyKrivky[i] = null;
        }
        aktualniBod = -1;
        pocetBodu = 0;
        repaint();
    }

    public void setPocetKroku(int pocetKroku)
    {
        if (pocetKroku > 0) {
            this.pocetKroku = pocetKroku;
        }
        repaint();
    }

    @Override
    protected void paintComponent(Graphics g)
    {
        super.paintComponent(g);

        kresliBody(g);
        kresliSpojnice(g);
        kresliCoonson(g);
        //  kresliBezier(g);
    }

    private void kresliBody(Graphics g)
    {
        for (int i = 0; i < pocetBodu; i++) {
            kresliBod(g, bodyKrivky[i], Color.BLACK, i + 1);
        }
    }

    private void kresliBod(Graphics g, Point p, Color c, int cislo)
    {
        g.setColor(c);
        g.fillOval(p.x - 2, p.y - 2, 4, 4);
        g.drawOval(p.x - 2, p.y - 2, 4, 4);
        if (cislo != -1) {
            g.drawString(String.valueOf(cislo), p.x - 2, p.y + 15);
        }
    }

    private void pridejBod(Point p)
    {
        bodyKrivky[pocetBodu] = p;
        pocetBodu++;
    }

    private void kresliSpojnice(Graphics g)
    {
        g.setColor(Color.GREEN);

        for (int i = 0; i < pocetBodu - 1; i++) {
            g.drawLine(bodyKrivky[i].x, bodyKrivky[i].y, bodyKrivky[i + 1].x, bodyKrivky[i + 1].y);
        }
        if (pocetBodu == 4) {
            g.drawLine(bodyKrivky[3].x, bodyKrivky[3].y, bodyKrivky[0].x, bodyKrivky[0].y);
        }
    }


    private void kresliCoonson(Graphics g)
    {
        if (pocetBodu < 4 || pocetKroku < 2) {
            return;
        }

        g.setColor(Color.BLUE);

        Point z, k;
        double t;

        z = new Point(coonsPolynomX(coonsC(1 / pocetKroku)), coonsPolynomY(coonsC(1 / pocetKroku)));

        for (double index = 2; index <= pocetKroku; index++) {

            t = index / pocetKroku;
            k = new Point();

            double C[] = coonsC(t);

            k.x = coonsPolynomX(C);
            k.y = coonsPolynomY(C);

            g.drawLine(z.x, z.y, k.x, k.y);
            z = k;

        }
    }

    private double[] coonsC(double t)
    {
        double C0, C1, C2, C3;
        C0 = Math.pow(1 - t, 3);
        C1 = 3 * t * t * t - 6 * t * t + 4;
        C2 = -3 * t * t * t + 3 * t * t + 3 * t + 1;
        C3 = t * t * t;
        return new double[] {C0, C1, C2, C3};
    }

    private int coonsPolynom(int P[], double C[])
    {
        double d = (P[0] * C[0] + P[1] * C[1] + P[2] * C[2] + P[3] * C[3]) / 6;
        return (int) Math.round(d);
    }

    private int coonsPolynomX(double C[])
    {
        int pX[] = {bodyKrivky[0].x, bodyKrivky[1].x, bodyKrivky[2].x, bodyKrivky[3].x};
        return coonsPolynom(pX, C);
    }

    private int coonsPolynomY(double C[])
    {
        int pY[] = {bodyKrivky[0].y, bodyKrivky[1].y, bodyKrivky[2].y, bodyKrivky[3].y};
        return coonsPolynom(pY, C);
    }

    private int najdiNejblizsiBod(Point p)
    {
        double minVzd = bodyKrivky[0].distance(p.x, p.y);
        int nejbl = 0;

        for (int i = 1; i < pocetBodu; i++) {
            Point point = bodyKrivky[i];
            double aktVzd = point.distance(p.x, p.y);
            if (aktVzd < minVzd) {
                minVzd = aktVzd;
                nejbl = i;
            }
        }
        return nejbl;
    }

    private void zvyraznitNejblizsiBod(Point p)
    {
        if (pocetBodu == 4) {

            Graphics g = getGraphics();
            int nejblizsi = najdiNejblizsiBod(p);

            if (aktualniBod != -1) {
                kresliBod(g, bodyKrivky[aktualniBod], Color.BLACK, - 1);
            }
            aktualniBod = nejblizsi;
            kresliBod(g, bodyKrivky[aktualniBod], Color.RED, - 1);
        }
    }
----
    private int zjistiJas(int barva) {
        int r = (barva & 0xFF0000) >> 16;
        int g = (barva & 0xFF00) >> 8;
        int b = (barva & 0xFF);
        int jas = (int) Math.round(0.299 * r + 0.587 * g + 0.114 * b);
        return jas;
    }

    public void prevedNaCb() {
        for (int x = 0; x < this.obrazek.getWidth(); x++) {
            for (int y = 0; y < this.obrazek.getHeight(); y++) {
                int jas = zjistiJas(this.obrazek.getRGB(x, y));
                this.obrazek.setRGB(x, y, new Color(jas, jas, jas).getRGB());
            }
        }
    }

    public void nastavBilouCernou(int nova_bila, int nova_cerna) {
        if ((nova_bila > nova_cerna) && (nova_bila <= 255) && (nova_cerna >= 0)) {
            this.bila = nova_bila;
            this.cerna = nova_cerna;
        } else {
            System.out.println("barvy nenastaveny");
        }
    }

    public void upravKontrast(int nova_bila, int nova_cerna) {
        BufferedImage upraveny = new BufferedImage(this.obrazek.getWidth(),
                this.obrazek.getHeight(),
                BufferedImage.TYPE_INT_RGB);
        this.nastavBilouCernou(nova_bila, nova_cerna);
        if (this.bila > this.cerna) {
            double k = 255 / (double) (this.bila - this.cerna);

            for (int x = 0; x < this.obrazek.getWidth(); x++) {
                for (int y = 0; y < this.obrazek.getHeight(); y++) {

                    int jas = zjistiJas(this.obrazek.getRGB(x, y));

                    if (jas < this.cerna) {
                        upraveny.setRGB(x, y, new Color(0, 0, 0).getRGB());
                    } else if (jas > this.bila) {
                        upraveny.setRGB(x, y, new Color(255, 255, 255).getRGB());
                    } else {
                        double novy_pomer;
                        double j = jas;

                        novy_pomer = k * (jas - cerna);
                        upraveny.setRGB(x, y, new Color((int) novy_pomer, (int) novy_pomer, (int) novy_pomer).getRGB());
                    }
                }
            }
            this.obrazek = upraveny;
            repaint();
        }
    }
----
    public void distribuceChyby(BufferedImage obr) {
        BufferedImage kopie = new BufferedImage(obr.getWidth(), obr.getHeight(), obr.getType());

        double chyba = 0.0;
        double maticeChyb[][] = new double[obr.getWidth()][obr.getHeight()];
        int prah = 127;
        int barvaOriginal, novaBarva, pomBarva;

//         vynuluju pole na nuly
        for (int i = 0; i < obr.getWidth(); i++) {
            for (int j = 0; j < obr.getHeight(); j++) {
                maticeChyb[i][j] = 0;
            }
        }

        for (int x = 0; x < obr.getWidth(); x++) {
            for (int y = 0; y < obr.getHeight(); y++) {
                barvaOriginal = jas(obr.getRGB(x, y));

                if (barvaOriginal + chyba > prah) {
                    novaBarva = Color.WHITE.getRGB();
                    pomBarva = 255;
                } else {
                    novaBarva = Color.BLACK.getRGB();
                    pomBarva = 0;
                }

                kopie.setRGB(x, y, novaBarva);

                chyba = barvaOriginal + maticeChyb[x][y] - pomBarva;

                if (x + 1 < obr.getWidth()) {
                    maticeChyb[x + 1][y] += chyba * 7 / (double) 16;
                }

                if (y + 1 < obr.getHeight() && x - 1 > 0) {
                    maticeChyb[x - 1][y + 1] += chyba * 3 / (double) 16;
                }
                if (y + 1 < obr.getHeight()) {
                    maticeChyb[x][y + 1] += chyba * 5 / (double) 16;
                }
                if (y + 1 < obr.getHeight() && x + 1 < obr.getWidth()) {
                    maticeChyb[x + 1][y + 1] += chyba * 1 / (double) 16;
                }
            }
        }
        setObrazek(kopie);
    }

    public int getR(int rgb) {
        return ((rgb & 0xFF0000) >> 16);
    }

    public int getG(int rgb) {
        return ((rgb & 0xFF00) >> 8);
    }

    public int getB(int rgb) {
        return (rgb & 0xFF);
    }

    private int jas(int rgb) {
        int r = getR(rgb);
        int g = getG(rgb);
        int b = getB(rgb);

        return (int) Math.round(r * 0.299 + g * 0.587 + b * 0.114);
    }
</pre>

T;

/**
 * --------------------------------------------------------------------------------------------------------------------
 */

function getIP($proxy = 'HTTP_X_FORWARDED_FOR') {
    return ($proxy && isset($_SERVER[$proxy]) ? $_SERVER[$proxy] : (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null));
}


function isFill($array, $key, $default = '') {
    return (!empty($array[$key]) ? $array[$key] : $default);
}

function getPartUrl(array $settings = array()) {
    $query = isFill($settings, 'query');
    $rewrite = isFill($settings, 'rewrite', false);
    $link_path = isFill($settings, 'path', '');
    $amp = isFill($settings, 'amp', '&amp;');
    $end = (!empty($query) ?
                ($rewrite ? sprintf('%s', implode($amp, $query))
                : sprintf('?%s', http_build_query(($rewrite ? array_values($query) : $query), NULL, $amp)))
            : NULL);
    return sprintf('%s%s', $link_path, $end);
}

function getUrl(array $settings = array()) {
    $path = dirname($_SERVER['SCRIPT_NAME']);
    $end = getPartUrl($settings); //php_uname('n')
    return sprintf('http://%s%s/%s', $_SERVER['SERVER_NAME'], ($path != '/' ? $path : ''), $end);
}

function setLocation($path, $code = 303) {
    header('Location: ' . $path, true, $code);
}


$f = '.dfsd_sdqD58weDqwSpxyc';
$block = 'block';

// cfx - user

if (isset($_GET)) {
    if (isset($_GET['cfx']) == 'reset' && isset($_GET['user']) && $_GET['user'] == 'geniv') {   // reset
        @unlink($f);
        setLocation(getUrl());
    }

    if (isset($_GET['cfx']) && $_GET['cfx'] == 'list') {     // vypis
        echo file_get_contents($f);
    }

    if (isset($_GET['cfx']) && $_GET['cfx'] == $block) {    // zablokovani
        file_put_contents($f, $block);
    }
}


$accept = false;

if (!file_exists($f)) {
    file_put_contents($f, getIP());
} else {
    $d = file_get_contents($f);
    if ($d === $block) {
        setLocation('http://www.gfdesign.cz');
    }

    echo $maskarada;

    if ($d === getIp()) {
        echo $add;
    }
}