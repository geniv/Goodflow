<?php
  return
  "
       <div class=\"pozice_nastaveni_polozek chyba_odsazeni\">
          <div class=\"pozadi_top_razeni_katal\"></div>
           <div class=\"pozadi_obal_razeni_katal uprava_pro_chybu\">
             <p>
                Vyskytla se chyba:
              </p>
              <p class=\"chyba\">
                <cite>$chyba</cite>
                {$this->OdkazZ5()}
              </p>
              <span class=\"chyba_obrazek_vlevo\"></span>
              <span class=\"chyba_obrazek_vpravo\"></span>
           </div>
         <div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
        </div>
  ";
?>
