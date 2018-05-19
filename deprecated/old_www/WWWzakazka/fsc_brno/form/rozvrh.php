<?php
  return
  "
<div id=\"rozvrh_treninku\">
  <h2>Rozvrh tréninků</h2>

  <div class=\"obal_rozvrh_treninku\">
    <h3>{$this->VypisTextuSekce("rozvrh1")}</h3>
    <p class=\"prvni\">
      <strong>
        {$this->VypisTextuSekce("rozvrh1")}
      </strong>
    </p>
    <table>
      <caption>{$this->VypisTextuSekce("rozvrh1")}</caption>
      <thead>
        <tr class=\"lichy\">
          <th scope=\"row\">Datum</th>
          <th scope=\"row\">I. Trénink</th>
          <th scope=\"row\">Suchá Příprava</th>
          <th scope=\"row\" class=\"posledni\">II. Trénink</th>
        </tr>
      </thead>
      <tbody>
        {$this->VypisTrenink()}
      </tbody>
    </table>
    <p class=\"center\">
      <strong>
        {$this->VypisTextuSekce("rozvrh2")}
      </strong>
    </p>
  </div>

  <div class=\"obal_rozvrh_treninku\">
    <h3>{$this->VypisTextuSekce("rozvrh3")}</h3>
    <p class=\"prvni\">
      <strong>
        {$this->VypisTextuSekce("rozvrh3")}
      </strong>
    </p>
    <table>
      <caption>{$this->VypisTextuSekce("rozvrh3")}</caption>
      <thead>
        <tr class=\"lichy\">
          <th scope=\"row\">Datum</th>
          <th scope=\"row\">Led</th>
          <th scope=\"row\" class=\"posledni\">Suchá Příprava</th>
        </tr>
      </thead>
      <tbody>
        {$this->VypisTreninkPripravka()}
      </tbody>
    </table>
    <p class=\"center\">
      <strong>
        {$this->VypisTextuSekce("rozvrh4")}
      </strong>
    </p>
  </div>

</div>
  ";
  
/*
<tr>
          <th scope=\"row\">4.8.</th>
          <td>8:45 – 9:45</td>
          <td>10:15 – 11:15</td>
          <td class=\"posledni\">11:30 – 12:30</td>
        </tr>
        <tr class=\"lichy\">
          <th scope=\"row\">5.8.</th>
          <td>8:45 – 9:45</td>
          <td>10:15 – 11:15</td>
          <td class=\"posledni\">11:30 – 12:30</td>
        </tr>
        <tr>
          <th scope=\"row\">6.8.</th>
          <td>8:45 – 9:45</td>
          <td>10:15 – 11:15</td>
          <td class=\"posledni\">11:30 – 12:30</td>
        </tr>
        <tr class=\"lichy\">
          <th scope=\"row\">7.8.</th>
          <td>8:45 – 9:45</td>
          <td>10:15 – 11:15</td>
          <td class=\"posledni\">11:30 – 12:30</td>
        </tr>
        <tr>
          <th scope=\"row\">8.8.</th>
          <td>8:45 – 9:45</td>
          <td>10:15 – 11:15</td>
          <td class=\"posledni\">11:30 – 12:30</td>
        </tr>
        <tr class=\"lichy\">
          <th scope=\"row\">11.8.</th>
          <td>8:15 – 9:15</td>
          <td>10:00 – 11:00</td>
          <td class=\"posledni\">11:15 – 12:15</td>
        </tr>
        <tr>
          <th scope=\"row\">12.8.</th>
          <td>8:15 – 9:15</td>
          <td>10:00 – 11:00</td>
          <td class=\"posledni\">11:15 – 12:15</td>
        </tr>
        <tr class=\"lichy\">
          <th scope=\"row\">13.8.</th>
          <td>8:15 – 9:15</td>
          <td>10:00 – 11:00</td>
          <td class=\"posledni\">11:15 – 12:15</td>
        </tr>
        <tr>
          <th scope=\"row\">14.8.</th>
          <td>8:15 – 9:15</td>
          <td>10:00 – 11:00</td>
          <td class=\"posledni\">11:15 – 12:15</td>
        </tr>
        <tr class=\"lichy\">
          <th scope=\"row\">15.8.</th>
          <td>8:15 – 9:15</td>
          <td>10:00 – 11:00</td>
          <td class=\"posledni\">11:15 – 12:15</td>
        </tr>
        <tr>
          <th scope=\"row\">6.8.</th>
          <td>8:15 – 9:15</td>
          <td>10:00 – 11:00</td>
          <td class=\"posledni\">11:15 – 12:15</td>
        </tr>

        <tr class=\"lichy\">
          <th scope=\"row\" colspan=\"4\" class=\"posledni\">16. 8. – 24. 8. SOUSTŘEDĚNÍ ROKYCANY</th>
        </tr>

        <tr>
          <th scope=\"row\">25.8.</th>
          <td>9:30 – 10:30</td>
          <td>11:00 – 11:45</td>
          <td class=\"posledni\">12:00 – 13:00</td>
        </tr>
        <tr class=\"lichy\">
          <th scope=\"row\">26.8.</th>
          <td>9:30 – 10:30</td>
          <td>11:00 – 11:45</td>
          <td class=\"posledni\">12:00 – 13:00</td>
        </tr>
        <tr>
          <th scope=\"row\">27.8.</th>
          <td>9:30 – 10:30</td>
          <td>11:00 – 11:45</td>
          <td class=\"posledni\">12:00 – 13:00</td>
        </tr>
        <tr class=\"lichy\">
          <th scope=\"row\">28.8.</th>
          <td>9:30 – 10:30</td>
          <td>11:00 – 11:45</td>
          <td class=\"posledni\">12:00 – 13:00</td>
        </tr>
        <tr>
          <th scope=\"row\">29.8.</th>
          <td>9:30 – 10:30</td>
          <td>11:00 – 11:45</td>
          <td class=\"posledni\">12:00 – 13:00</td>
        </tr>









        <tr>
          <th scope=\"row\">4.8.</th>
          <td>8:45 – 9:45</td>
          <td class=\"posledni\">10:15 – 11:15</td>
        </tr>
        <tr class=\"lichy\">
          <th scope=\"row\">5.8.</th>
          <td>8:45 – 9:45</td>
          <td class=\"posledni\">10:15 – 11:15</td>
        </tr>
        <tr>
          <th scope=\"row\">6.8.</th>
          <td>8:45 – 9:45</td>
          <td class=\"posledni\">10:15 – 11:15</td>
        </tr>
        <tr class=\"lichy\">
          <th scope=\"row\">7.8.</th>
          <td>8:45 – 9:45</td>
          <td class=\"posledni\">10:15 – 11:15</td>
        </tr>
        <tr>
          <th scope=\"row\">8.8.</th>
          <td>8:45 – 9:45</td>
          <td class=\"posledni\">10:15 – 11:15</td>
        </tr>
        <tr class=\"lichy\">
          <th scope=\"row\">11.8.</th>
          <td>8:15 – 9:15</td>
          <td class=\"posledni\">10:00 – 11:00</td>
        </tr>
        <tr>
          <th scope=\"row\">12.8.</th>
          <td>8:15 – 9:15</td>
          <td class=\"posledni\">10:00 – 11:00</td>
        </tr>
        <tr class=\"lichy\">
          <th scope=\"row\">13.8.</th>
          <td>8:15 – 9:15</td>
          <td class=\"posledni\">10:00 – 11:00</td>
        </tr>
        <tr>
          <th scope=\"row\">14.8.</th>
          <td>8:15 – 9:15</td>
          <td class=\"posledni\">10:00 – 11:00</td>
        </tr>
        <tr class=\"lichy\">
          <th scope=\"row\">15.8.</th>
          <td>8:15 – 9:15</td>
          <td class=\"posledni\">10:00 – 11:00</td>
        </tr>
        <tr>
          <th scope=\"row\">25.8.</th>
          <td>9:30 – 10:30</td>
          <td class=\"posledni\">11:00 – 11:45</td>
        </tr>
        <tr class=\"lichy\">
          <th scope=\"row\">26.8.</th>
          <td>9:30 – 10:30</td>
          <td class=\"posledni\">11:00 – 11:45</td>
        </tr>
        <tr>
          <th scope=\"row\">27.8.</th>
          <td>9:30 – 10:30</td>
          <td class=\"posledni\">11:00 – 11:45</td>
        </tr>
        <tr class=\"lichy\">
          <th scope=\"row\">28.8.</th>
          <td>9:30 – 10:30</td>
          <td class=\"posledni\">11:00 – 11:45</td>
        </tr>
        <tr>
          <th scope=\"row\">29.8.</th>
          <td>9:30 – 10:30</td>
          <td class=\"posledni\">11:00 – 11:45</td>
        </tr>
*/
?>
