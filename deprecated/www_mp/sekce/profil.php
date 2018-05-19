<?php
  $absolute_url = $this->var->absolutni_url;




$infoprofil = $this->var->main[0]->NactiFunkci("DynamicRegistration", "InfoProfile");




/*




<hr />


<h2>Martin Šulák <span>{profil}</span></h2>



<div id=\"obal_sekce_profil\">

















<div id=\"obal_uzivatel_foto\">

<p>
<img src=\"{$absolute_url}jedi_martin.png\" alt=\"\" />




<strong>Martin Šulák</strong>
<em>Člen akademie mladých podnikatelů</em>
<span>http://www.mladipodnikatele.cz/martinsulak</span>


</p>






</div>

<div id=\"obal_uzivatel_obsah\">









<h4>Jméno & Příjmení</h4>

<p>Martin Šulák</p>



<h4>Věk</h4>

<p>20</p>




<h4>Dosažené vzdělání</h4>

<p>Střední</p>


<h4>Telefon</h4>

<p>603 654 689</p>



<h4>Mail</h4>

<p>mail@mail.com</p>





<h4>Co mohu nabídnout</h4>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan tempus tortor, id vehicula nulla lobortis vitae. Quisque a turpis nisi. Quisque adipiscing purus nec velit lacinia adipiscing. Quisque rutrum, tellus eget accumsan dignissim, ante augue tincidunt eros, nec bla Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan tempus tortor, id vehicula nulla lobortis vitae. Quisque a turpis nisi.</p>




<h4>Něco o mě</h4>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan tempus tortor, id vehicula nulla lobortis vitae. Quisque a turpis nisi. Quisque adipiscing purus nec velit lacinia adipiscing. Quisque rutrum, tellus eget accumsan dignissim, ante augue tincidunt eros, nec bla</p>





<h4>Moje pracovní zkušenosti</h4>

<p>
   lorem ipsum dolor sit amet
   consectetur adipiscing elit 
   praesent accumsan tempus tortor
   id vehicula nulla lobortis vitae
   uisque a turpis nisi 
</p>







<a href=\"{$absolute_url}upravit-profil\" title=\"\" id=\"upravit_profil\">Upravit profil</a>






</div>

















</div>





*/





  $result =
  "

















<div id=\"sekce_profil\">

{$infoprofil}




</div>




































  ";
  return $result;
?>