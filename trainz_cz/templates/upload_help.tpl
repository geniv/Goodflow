<div class="obal_upload_help">
  <div class="well well-sm div-validate">
    <ul class="list-group">
      <li class="list-group-item">
        <h4>Nápověda</h4>
      </li>
    </ul>
    <ul class="list-group">
      <li class="list-group-item">
        <h5>Co to znamená UID?</h5>
      </li>
      <li class="list-group-item">
        <p>UID znamená "Unikátní identifikátor". Jedná se o unikátní číslo každé položky vytvořené systémem databáze, které je třeba uvádět pro snazší hledání objektu v databázi při řešení problémů s administrátory.</p>
      </li>
    </ul>
    <ul class="list-group">
      <li class="list-group-item">
        <h5>Jak přidat objekt / mapu?</h5>
      </li>
      <li class="list-group-item">
        <p>Předtím, než začnete s formulářem pracovat tak si přečtěte u každého pole jeho popis, který Vás informuje o tom, zda-li je povinné či nikoliv a co se do něj má zadávat popřípadě v jakém tvaru.</p>
        <p>Zde si můžete prohlédnout vzorový postup.</p>
        <p>Jako první musíte vyplnit povinné pole "Název" a "Popis". Jedná se o stručný název a popis objektu/mapy. Poté zvolíte kategorii, kam by měl být objekt/mapa v Downloadu zařazen.</p>
        <br />
        <a href="{$weburl}img/help/web_01.png" title="Vzorový náhled" class="upload-img-fancy thumbnail"><img src="{$weburl}img/help/web_01.png" alt"Vzorový náhled" class="img-rounded" /></a>
        <br />
        <p>Další část formuláře jsou "Oddíly". Můžete libovolně přidávat či odebírat oddíly, podle toho, kolik jich potřebujete.</p>
        <br />
        <a href="{$weburl}img/help/web_02.png" title="Vzorový náhled" class="upload-img-fancy thumbnail"><img src="{$weburl}img/help/web_02.png" alt"Vzorový náhled" class="img-rounded" /></a>
        <br />
        <p>Každý jeden oddíl znamená jeden soubor (*.cdp, *.zip, *.rar, apod.). Při odesílání formuláře můžou mít všechny soubory naráz maximálně 64MB. Pokud budete potřebovat nahrát soubory, které budou přesahovat celkovou maximální velikost, tak je můžete rozdělit a po schválení objektu/mapy je přidat jako aktualizaci.</p>
        <p>Ke každému souboru můžete určit "Trainz verzi" a "Kuid". Můžete určit libovolný počet Trainz verzí i kuidů. Pokud Váš objekt/mapa obsahuje nějaký kuid, který už se nachází v naší databázi, tak ho můžete vyhledat a zvolit v poli "Kuid (databáze)". Pokud Váš objekt/mapa nemá v naší databázi kuid/y, tak je můžete ručně zadat v poli "Kuid (přidat nový)".</p>
        <p>Pokud zadáváte nový kuid, tak musíte dodržet formát zápisu. Formát zápisu kuidu jsou pouze čísla, dvojtečky a pokud je potřeba tak i mínusy (-)xxxxx:yyyyy(:zzz).</p>
        <p>V případě zadání čísel a jedné dvojtečky se určí tvar kuidu &lt;kuid:xxxxx:yyyyy&gt;,<br />takže takový zápis: 123456:123456 bude mít takový výsledek &lt;kuid:123456:123456&gt;</p>
        <p>V případě zadání čísel a dvou dvojteček se určí tvar kuidu &lt;kuid2:xxxxx:yyyyy:zzz&gt;,<br />takže takový zápis: 123456:123456:123 bude mít takový výsledek &lt;kuid2:123456:123456:123&gt;</p>
        <p>Pokud zadáváte mínus, tak se píše pouze k prvnímu číslu, mínus za dvojtečkou znamená chybný zápis.</p>
        <br />
        <a href="{$weburl}img/help/web_03.png" title="Vzorový náhled" class="upload-img-fancy thumbnail"><img src="{$weburl}img/help/web_03.png" alt"Vzorový náhled" class="img-rounded" /></a>
        <br />
        <p>Obrázek níže zobrazuje správné zápisy Kuidů.</p>
        <br />
        <a href="{$weburl}img/help/web_05.png" title="Vzorový náhled" class="upload-img-fancy thumbnail"><img src="{$weburl}img/help/web_05.png" alt"Vzorový náhled" class="img-rounded" /></a>
        <br />
        <p>Obrázek níže zobrazuje špatné zápisy Kuidů.</p>
        <br />
        <a href="{$weburl}img/help/web_04.png" title="Vzorový náhled" class="upload-img-fancy thumbnail"><img src="{$weburl}img/help/web_04.png" alt"Vzorový náhled" class="img-rounded" /></a>
        <br />
        <p>Každý kuid musí být na novém řádku. Prázdný řádek znamená chybné zadání.</p>
        <p>V případě chybného zadání se znepřístupní tlačítko pro odeslání formuláře. Chybně zadané kuidy je proto nutné opravit.</p>
        <p>Další validace formátu kuidů se provádí i po odeslání formuláře.</p>
        <p>Poslední část formuláře jsou doplňující údaje. Jsou zde "Kuid závislosti". Tyto kuid závislosti znamenají "Doporučené KUID součásti". Pokud Váš objekt vyžaduje ke svému fungování cizí objekty, tak kuidy těchto cizích objektů zadáváte právě do formuláře "Kuid závislosti". Kuidy zadáváte stejným stylem jak již bylo popsáno výše. Pokud některé kuidy nejsou v naší databázi, tak je opět zadáváte ručně.</p>
        <p>Náhled je povinný. Stačí nahrát jeden velký obrázek (např. 1024x768, 1280x800, apod., doporučujeme v poměru 4:3), minimální rozměry obrázku musí být však 240x180 pixelů. Podporovány jsou obrázkové formáty (.jpg, .png, apod.). Pokud je obrázek větší než 800x600 pixelů, tak se automaticky proporcionálně zmenší na délku 800 pixelů a výška se dopočítá. Z velkého náhledu se pak automaticky vytvoří i malý.</p>
        <p>Jako poslední pole je "Počet polygonů". Jedná se o nepovinný údaj. Pokud se ovšem rozhodnete jej zadat, tak má několik pravidel.</p>
        <p>Musí mít správný formát, jen čísla. Pokud máte více (polygonově stejných) objektů v jednom CDP, tak zadáte počet polygonů jednoho z objektů.</p>
        <p>Pokud ale objekt pracuje pouze s dalšími objekty tak zadáte celkový počet polygonů všech objektů včetně těch se kterými pracuje.</p>
        <p>U mapy se počet polygonů nevyplňuje.</p>
        <br />
        <a href="{$weburl}img/help/web_06.png" title="Vzorový náhled" class="upload-img-fancy thumbnail"><img src="{$weburl}img/help/web_06.png" alt"Vzorový náhled" class="img-rounded" /></a>
        <br />
        <p>Po odeslání formuláře se objekt/mapa zobrazí v sekci "Objekty / Mapy" pod tlačítkem "Přidat objekt / mapu". Objekt/mapa bude mít v té chvíli stav "Čeká na schválení a zatím nezařazeno v Download sekci".</p>
        <br />
        <a href="{$weburl}img/help/web_07.png" title="Vzorový náhled" class="upload-img-fancy thumbnail"><img src="{$weburl}img/help/web_07.png" alt"Vzorový náhled" class="img-rounded" /></a>
        <br />
        <p>Po schválení objektu/mapy příslušným administrátorem se přepne objektu/mapě stav na "Schváleno a zatím nezařazeno v Download sekci" nebo na stav "Schváleno a zařazeno v Download sekci".</p>
        <br />
        <a href="{$weburl}img/help/web_08.png" title="Vzorový náhled" class="upload-img-fancy thumbnail"><img src="{$weburl}img/help/web_08.png" alt"Vzorový náhled" class="img-rounded" /></a>
        <br />
        <p>Poté jak se Váš objekt/mapa schválí, tak máte možnost jej aktualizovat.</p>
        <p>Aktualizace pak probíhá podobným stylem. Všechny příslušné pole, které jste vyplnily budou už předvyplněné a ty můžete upravit podle potřeby. Po odeslání aktualizace bude objekt/mapa opět procházet procesem schvalování.</p>
        <p>Pokud se aktualizace objektu/mapy schválí příslušným administrátorem, tak se nové změny projeví. Pokud ovšem administrátor Vaší aktualizaci objektu/mapy zamítne, tak se vrátí původní obsah.</p>
        <p>Stav přidání objektu/mapy, aktualizaci objektu/mapy můžete sledovat v sekci "Stav požadavků".</p>
        <br />
        <a href="{$weburl}img/help/web_09.png" title="Vzorový náhled" class="upload-img-fancy thumbnail"><img src="{$weburl}img/help/web_09.png" alt"Vzorový náhled" class="img-rounded" /></a>
        <br />
        <a href="{$weburl}img/help/web_10.png" title="Vzorový náhled" class="upload-img-fancy thumbnail"><img src="{$weburl}img/help/web_10.png" alt"Vzorový náhled" class="img-rounded" /></a>
        <br />
        <p>Po schválení a zařazení do Download sekce se pak objekt/mapa zobrazí v příslušné kategorii.</p>
        <br />
        <a href="{$weburl}img/help/web_11.png" title="Vzorový náhled" class="upload-img-fancy thumbnail"><img src="{$weburl}img/help/web_11.png" alt"Vzorový náhled" class="img-rounded" /></a>
      </li>
    </ul>
    <ul class="list-group">
      <li class="list-group-item">
        <h5>Jak přidat screenshot?</h5>
      </li>
      <li class="list-group-item">
        <p>Předtím, než začnete s formulářem pracovat tak si přečtěte u každého pole jeho popis, který Vás informuje o tom, zda-li je povinné či nikoliv a co se do něj má zadávat.</p>
        <p>Zde si můžete prohlédnout vzorový postup.</p>
        <p>Samotný proces přidávání screenshotu probíhá ve třech krocích. Jako první musíte nahrát obrázek, který by se měl zobrazovat na úvodní straně. Rozměry obrázku musí být minimálně 950x370 pixelů.</p>
        <br />
        <a href="{$weburl}img/help/web_12.png" title="Vzorový náhled" class="upload-img-fancy thumbnail"><img src="{$weburl}img/help/web_12.png" alt"Vzorový náhled" class="img-rounded" /></a>
        <br />
        <p>Pokud jsou rozměry větší, tak máte možnost nastavit ve druhém kroku výřez obrázku na požadovanou velikost.</p>
        <br />
        <a href="{$weburl}img/help/web_13.png" title="Vzorový náhled" class="upload-img-fancy thumbnail"><img src="{$weburl}img/help/web_13.png" alt"Vzorový náhled" class="img-rounded" /></a>
        <br />
        <p>Ve druhém kroku přesunete ohraničení na místo, kde chcete provést výřez na požadovanou velikost obrázku.</p>
        <br />
        <a href="{$weburl}img/help/web_16.png" title="Vzorový náhled" class="upload-img-fancy thumbnail"><img src="{$weburl}img/help/web_16.png" alt"Vzorový náhled" class="img-rounded" /></a>
        <br />
        <a href="{$weburl}img/help/web_15.png" title="Vzorový náhled" class="upload-img-fancy thumbnail"><img src="{$weburl}img/help/web_15.png" alt"Vzorový náhled" class="img-rounded" /></a>
        <br />
        <p>Po nastavení výřezu budete přesměrování na poslední krok, kde doplníte popis k obrázku a odešlete formulář.</p>
        <br />
        <a href="{$weburl}img/help/web_17.png" title="Vzorový náhled" class="upload-img-fancy thumbnail"><img src="{$weburl}img/help/web_17.png" alt"Vzorový náhled" class="img-rounded" /></a>
        <br />
        <a href="{$weburl}img/help/web_18.png" title="Vzorový náhled" class="upload-img-fancy thumbnail"><img src="{$weburl}img/help/web_18.png" alt"Vzorový náhled" class="img-rounded" /></a>
        <br />
        <p>Pokud nahráváte obrázek, u kterého jsou dodrženy rozměry 950x370 pixelů, tak bude přeskočen druhý krok a budete rovnou přesměrováni na krok třetí.</p>
        <br />
        <a href="{$weburl}img/help/web_14.png" title="Vzorový náhled" class="upload-img-fancy thumbnail"><img src="{$weburl}img/help/web_14.png" alt"Vzorový náhled" class="img-rounded" /></a>
        <br />
        <p>Po odeslání formuláře se screenshot zobrazí v sekci "Screenshoty" pod tlačítkem "Přidat obrázek". Screenshot bude mít v té chvíli stav "Čeká na schválení a zatím nezařazeno ve slideshow na úvodní straně".</p>
        <br />
        <a href="{$weburl}img/help/web_19.png" title="Vzorový náhled" class="upload-img-fancy thumbnail"><img src="{$weburl}img/help/web_19.png" alt"Vzorový náhled" class="img-rounded" /></a>
        <br />
        <p>Po schválení screenshotu příslušným administrátorem se přepne jeho stav na "Schváleno a zatím nezařazeno ve slideshow na úvodní straně" nebo na stav "Schváleno a zařazeno ve slideshow na úvodní straně".</p>
        <br />
        <a href="{$weburl}img/help/web_20.png" title="Vzorový náhled" class="upload-img-fancy thumbnail"><img src="{$weburl}img/help/web_20.png" alt"Vzorový náhled" class="img-rounded" /></a>
        <br />
        <p>Poté jak se Váš screenshot schválí, tak máte možnost aktualizovat jeho popis.</p>
        <p>Po odeslání aktualizace bude screenshot opět procházet procesem schvalování.</p>
        <p>Pokud se aktualizace screenshotu schválí příslušným administrátorem, tak se nové změny projeví. Pokud ovšem administrátor Vaší aktualizaci screenshotu zamítne, tak se vrátí původní popis.</p>
        <p>Stav přidání screenshotu či aktualizaci screenshotu můžete sledovat v sekci "Stav požadavků".</p>
        <br />
        <a href="{$weburl}img/help/web_21.png" title="Vzorový náhled" class="upload-img-fancy thumbnail"><img src="{$weburl}img/help/web_21.png" alt"Vzorový náhled" class="img-rounded" /></a>
        <br />
        <a href="{$weburl}img/help/web_22.png" title="Vzorový náhled" class="upload-img-fancy thumbnail"><img src="{$weburl}img/help/web_22.png" alt"Vzorový náhled" class="img-rounded" /></a>
        <br />
        <p>Po schválení a zařazení do slideshow můžete vidět svůj screenshot na úvodní straně.</p>
        <br />
        <a href="{$weburl}img/help/web_23.png" title="Vzorový náhled" class="upload-img-fancy thumbnail"><img src="{$weburl}img/help/web_23.png" alt"Vzorový náhled" class="img-rounded" /></a>
      </li>
    </ul>
  </div>
</div>