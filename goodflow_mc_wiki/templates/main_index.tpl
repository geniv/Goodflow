
    <div id="obal">
      <header>
        <h1>
          <a href="#">Minecraft CZ wiki</a>
        </h1>
        <h2>Ceska minecraft wikipedie i o modech</h2>
      </header>
      <nav>
{$html::ul()->add($index_menu)->setDepth(4)}
      </nav>
      <div id="search">
        <div id="search_obal">
          <p>V databázi se nachází {$index_pocetClanku} článků</p>
{$index_searchform->render(5)}
        </div>
      </div>
      <div id="obsah">
        <div id="middle">{$index_content}</div>
      </div>
      <footer>Design by <a href="http://www.d3x.co">D3X</a> | Web power by Guuudfloumasta system <a href="{$weburl}admin">admin</a></footer>
    </div>
  
