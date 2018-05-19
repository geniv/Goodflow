<?php

/* -------------------------------------------------------------------------- */

  $result = array(

/* -------------------------------------------------------------------------- */

/* - - - - - - - - - - Normal výpis default - - - - - - - - - - */

                  "admin_obsah_sablony_add" => "
  <a href=\"%%1%%\" title=\"Přidat\" class=\"addobsah tlacitko-2 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Přidat</span>
  </a>\n",

                  "admin_obsah_sablony" => "
<div class=\"obal_dyncent__%%1%%\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%3%%</h3>
    <h4 class=\"pod-nadpis-sekce f-s-17 f-f-web-pro\">%%4%%<!-- --></h4>
  </div>
%%2%%
  <div class=\"cl-b pos-rel fw-around\">
    %%5%%
  </div>
</div>\n",

                  "normal_vypis_obal" => "%%vypis%%",

                  "normal_vypis_obal_null" => "<strong style=\"display: block; text-align: center;\">Není vložen obsah</strong>",

                  "admin_vypis_obsah_sablony_copy" => "<a href=\"%%1%%\" title=\"Duplikovat\" class=\"copyobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Duplikovat</a>",

                  "admin_vypis_obsah_sablony_del" => "<a href=\"%%2%%\" title=\"Opravdu chceš smazat obsah: &quot;%%1%%&quot; ?\" class=\"confirm delobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat</a>",

/* - - - - - - - - - - /Normal výpis default - - - - - - - - - - */



/* -------------------------------------------------------------------------- */


                  "normal_vypis=index-slider" => "
%%10%%
  <img src=\"%%15%%\" alt=\"%%12%%\" />
  <span>
    <em class=\"cs-title-opacity\"><!-- --></em>
    <em id=\"studio_puls_nadpis\"><!-- --></em>
    <strong>%%16%%<!-- --></strong>
    <strong>%%17%%<!-- --></strong>
    <strong>%%18%%<!-- --></strong>
    <strong>%%19%%<!-- --></strong>
    <strong>%%20%%<!-- --></strong>
    <strong>%%21%%<!-- --></strong>
  </span>
</a>\n",

                  "normal_vypis_url=index-slider" => "<a href=\"%%absolutni_url%%%%11%%\" title=\"%%12%%\">",




                  "admin_vypis_obsah_sablony=1" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\"><span class=\"fl-l\">%%11%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%5%%<a href=\"%%6%%\" title=\"Upravit\" class=\"editobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit</a>%%7%%%%8%%</span></li>
%%4%%
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah upraven:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\"><img src=\"%%13%%\" alt=\"%%11%%\" class=\"block\" /></span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%14%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%15%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%16%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%17%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%18%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%19%%</span></li>
</ul>\n",



/*

<a href=\"{$absolute_url}salony/salon-puls\">
  <img src=\"{$absolute_url}salon_puls.png\" alt=\"\" />
  <span>
    <em class=\"cs-title-opacity\"><!-- --></em>
    <em id=\"salon_puls_nadpis\"><!-- --></em>
    <strong>- Kadeřnické studio</strong>
    <strong>- Solárium</strong>
    <strong>- Kosmetika</strong>
    <strong>- Masáže</strong>
  </span>
</a>

<a href=\"{$absolute_url}salony/studio-puls\">
  <img src=\"{$absolute_url}studio_puls.png\" alt=\"\" />
  <span>
    <em class=\"cs-title-opacity\"><!-- --></em>
    <em id=\"studio_puls_nadpis\"><!-- --></em>
    <strong>- Kadeřnické studio</strong>
    <strong>- Inner Efect</strong>
    <strong>- Elumen</strong>
    <strong>- Cafe</strong>
    <strong>- Terasa</strong>
  </span>
</a>

<a href=\"{$absolute_url}salony/salon-pulsline\">
  <img src=\"{$absolute_url}salon_pulsline.png\" alt=\"\" />
  <span>
    <em class=\"cs-title-opacity\"><!-- --></em>
    <em id=\"salon_pulsline_nadpis\"><!-- --></em>
    <strong>- Kosmetika</strong>
    <strong>- Galvanizace</strong>
    <strong>- P-shine</strong>
    <strong>- Pedikúra</strong>
    <strong>- Modeláž nehtů</strong>
  </span>
</a>

*/



/* -------------------------------------------------------------------------- */

                  "normal_vypis_onefoto=aktuality" => "<img src=\"%%1%%\" alt=\"\" />",

                  "normal_vypis=aktuality" => "
            <li>
              <a class=\"thumb\" href=\"{$absolute_url}obr/puls_salony_podklad_obsah.png\" title=\"\">
                <strong>%%10%%</strong>
                <em>(%%16%%)</em>
              </a>
              <div class=\"caption\">
<strong><span class=\"left\">%%10%%</span><span class=\"right\">%%16%%</span></strong>
<div class=\"obal_odstavce\">
%%14%%
%%11%%
</div>
              </div>
            </li>",





                  "admin_vypis_obsah_sablony=2" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\"><span class=\"fl-l\">%%10%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%5%%<a href=\"%%6%%\" title=\"Upravit\" class=\"editobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit</a>%%7%%</span></li>
%%4%%
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah upraven:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%11%%</span></li>
</ul>\n",









/*

            <li>
              <a class=\"thumb\" href=\"{$absolute_url}obr/puls_salony_podklad_obsah.png\" title=\"title obrazku prej\">
                <strong>Nadpis akce / aktuality 1</strong>
                <em>(16.8.2010)</em>
              </a>
              <div class=\"caption\">


<strong><span class=\"left\">Něco málo o účesu</span><span class=\"right\">14.7.2010 / 18:25</span></strong>








<div class=\"obal_odstavce\">


<img src=\"{$absolute_url}aktuality_img.png\" alt=\"\" />



<p>

Účes vždy hrál vyznanou kulturní a společenskou úlohu. V dobách středověku a raného novověku (hlavně v 18. století) bylo běžné že muži i ženy nosili dlouhé vlasy. Na počátku 19. století a po první světové válce začínají muži v západních kulturách nosit vlasy kratší, zatímco ženy je mají typicky delší (byť na začátku 20. století začala určitá část žen nosit též i vlasy kratší).
</p>

<br />

<p>
Byl to přímý důsledek válek, během které se museli muži na frontě vypořádat s řadou nemocí a parazitů a krátký sestřih byl výhodnější z hygienického hlediska. Nošení dlouhých vlasů u mužů se začalo vracet v 60. letech 20. století, kdy se stalo symbolem hippies a politického protestu proti estabilismentu. Ke konci 20. století se staly delší vlasy u mužů symbolem určité snahy o nonkonformitu.
</p>




</div>







              </div>
            </li>


            <li>
              <a class=\"thumb\" href=\"{$absolute_url}obr/puls_salony_podklad_obsah.png\" title=\"title obrazku prej\">
                <strong>Nadpis akce / aktuality 2</strong>
                <em>(16.8.2010)</em>
              </a>
              <div class=\"caption\">



<strong><span class=\"left\">Něco málo o účesu</span><span class=\"right\">14.7.2010 / 18:25</span></strong>








<div class=\"obal_odstavce\">

<p>


<img src=\"{$absolute_url}Print_68.jpg\" alt=\"\" />
Byl to přímý důsledek válek, během které se museli muži na frontě vypořádat s řadou nemocí a parazitů a krátký sestřih byl výhodnější z hygienického hlediska. Nošení dlouhých vlasů u mužů se začalo vracet v 60. letech 20. století, kdy se stalo symbolem hippies a politického protestu proti estabilismentu. Ke konci 20. století se staly delší vlasy u mužů symbolem určité snahy o nonkonformitu.


</p>

<br />

<p>
Účes vždy hrál vyznanou kulturní a společenskou úlohu. V dobách středověku a raného novověku (hlavně v 18. století) bylo běžné že muži i ženy nosili dlouhé vlasy. Na počátku 19. století a po první světové válce začínají muži v západních kulturách nosit vlasy kratší, zatímco ženy je mají typicky delší (byť na začátku 20. století začala určitá část žen nosit též i vlasy kratší).
</p>




</div>







              </div>
            </li>

*/

/* -------------------------------------------------------------------------- */

                  "normal_vypis=aktuality-index" => "








<div>



<strong><span class=\"left\">%%10%%</span><span class=\"right\">%%16%%</span></strong>

<p>
%%12%%
</p>

<a href=\"%%absolutni_url%%aktuality\" title=\"\" class=\"cela_aktualita\">Číst celou aktualitu</a>






</div>
",


/*



<div>

<strong><span class=\"left\">Název aktuality</span><span class=\"right\">14.7.2010 / 18:25</span></strong>

<p>
Proin sit amet arcu mi, varius facilisis erat. Morbi dapibus, turpis ac luctus vehicula, ante dolor pulvinar nisi, id tincidunt justo mi vitae felis. Integer elit libero, consequat et pulvinar vitae, imperdiet nec quam. Nullam at sagittis enim. consequat et pulvinar vitae, imperdiet nec quam. Nullam at sagittis enim. consequat et pulvinar vitae, imperdiet nec quam.
</p>

<a href=\"#\" title=\"\" class=\"cela_aktualita\">Číst celou aktualitu</a>

</div>

<div>


<strong><span class=\"left\">Název aktuality</span><span class=\"right\">14.7.2010 / 18:25</span></strong>


<p>


<img src=\"{$absolute_url}Print_68.jpg\" alt=\"\" />
Byl to přímý důsledek válek, během které se museli muži na frontě vypořádat s řadou nemocí a parazitů a krátký sestřih byl výhodnější z hygienického hlediska. Nošení dlouhých vlasů u mužů se začalo vracet v 60. letech 20. století, kdy se stalo symbolem hippies a politického protestu proti estabilismentu. Ke konci 20. století se staly delší vlasy u mužů symbolem určité snahy o nonkonformitu.


</p>




<a href=\"#\" title=\"\" class=\"cela_aktualita\">Číst celou aktualitu</a>




</div>



















<div>



<strong><span class=\"left\">Název aktuality</span><span class=\"right\">14.7.2010 / 18:25</span></strong>

<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi interdum, nisl a eleifend vulputate, augue augue pharetra sem, ac rutrum lacus turpis non tellus. Morbi sed iaculis magna. Nunc rhoncus elit ut lacus scelerisque ullamcorper. Aliquam hendrerit quam et quam vehicula sodales. In dolor leo, aliquet a sagittis sed.
</p>

<a href=\"#\" title=\"\" class=\"cela_aktualita\">Číst celou aktualitu</a>






</div>


*/

/* -------------------------------------------------------------------------- */

                  "normal_vypis=galerie-ucesu" => "




            <li>
              <a class=\"thumb\" href=\"%%12%%\" title=\"%%10%%\" style=\"background-image: url(%%14%%);\"></a>
            </li>











",

/*




            <li>
              <a class=\"thumb\" href=\"{$absolute_url}1_velky.png\" title=\"Title\" style=\"background-image: url({$absolute_url}1.png);\"></a>
            </li>
            <li>
              <a class=\"thumb\" href=\"{$absolute_url}2_velky.png\" title=\"Title\" style=\"background-image: url({$absolute_url}2.png);\"></a>
            </li>
            <li>
              <a class=\"thumb\" href=\"{$absolute_url}3_velky.png\" title=\"Title\" style=\"background-image: url({$absolute_url}3.png);\"></a>
            </li>
            <li>
              <a class=\"thumb\" href=\"{$absolute_url}4_velky.png\" title=\"Title\" style=\"background-image: url({$absolute_url}4.png);\"></a>
            </li>
            <li>
              <a class=\"thumb\" href=\"{$absolute_url}5_velky.png\" title=\"Title\" style=\"background-image: url({$absolute_url}5.png);\"></a>
            </li>




*/


/* -------------------------------------------------------------------------- */




                  "normal_vypis=galerie-ucesu-index" => "

<div>
<a href=\"%%absolutni_url%%galerie-ucesu\" title=\"%%10%%\" style=\"background-image: url(%%20%%);\"><!-- --></a>
</div>




",

                  "admin_vypis_obsah_sablony=3" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\"><span class=\"fl-l\">%%10%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%5%%<a href=\"%%6%%\" title=\"Upravit\" class=\"editobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit</a>%%7%%</span></li>
%%4%%
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah upraven:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\"><img src=\"%%11%%\" alt=\"%%10%%\" class=\"block\" /></span></li>
</ul>\n",


/*





<div>
<a href=\"{$absolute_url}galerie-ucesu\" title=\"PULS - hairstyle - caffe - shop - Galerie účesů\" style=\"background-image: url({$absolute_url}obr2.png);\"><!-- --></a>
</div>


<div>
<a href=\"{$absolute_url}galerie-ucesu\" title=\"PULS - hairstyle - caffe - shop - Galerie účesů\" style=\"background-image: url({$absolute_url}obr3.png);\"><!-- --></a>
</div>

<div>
<a href=\"{$absolute_url}galerie-ucesu\" title=\"PULS - hairstyle - caffe - shop - Galerie účesů\" style=\"background-image: url({$absolute_url}obr4.png);\"><!-- --></a>
</div>


*/



/* -------------------------------------------------------------------------- */




                  "normal_vypis=pulsteam" => "



            <li>
              <a class=\"thumb\" href=\"%%13%%\" title=\"%%10%%\">
                <img src=\"%%12%%\" alt=\"%%10%%\" />
                <span>%%10%%</span>
              </a>
              <div class=\"caption\">

<span class=\"pulsteam_jmeno\">%%10%%</span>

<span class=\"pulsteam_nadpis\">%%14%%</span>
<span class=\"pulsteam_popis\">%%15%%</span>

<span class=\"pulsteam_nadpis\">%%16%%</span>
<span class=\"pulsteam_popis\">%%17%%</span>

<span class=\"pulsteam_nadpis\">%%18%%</span>
<span class=\"pulsteam_popis\">%%19%%</span>

<span class=\"pulsteam_nadpis\">%%20%%</span>
<span class=\"pulsteam_popis\">%%21%%</span>

              </div>
            </li>



",



                  "admin_vypis_obsah_sablony=4" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\"><span class=\"fl-l\">%%10%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%5%%<a href=\"%%6%%\" title=\"Upravit\" class=\"editobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit</a>%%7%%</span></li>
%%4%%
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah upraven:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\"><img src=\"%%11%%\" alt=\"%%10%%\" class=\"block\" /></span></li>
</ul>\n",



/*





            <li>
              <a class=\"thumb\" href=\"{$absolute_url}fotka_kadernik.png\" title=\"Title #0\">
                <img src=\"{$absolute_url}fotka_mala_kadernik.png\" alt=\"Title #0\" />
                <span>Jmeno a prijmeni</span>
              </a>
              <div class=\"caption\">

<span class=\"pulsteam_jmeno\">Jmeno a prijmeni</span>

<span class=\"pulsteam_nadpis\">nadpis</span>
<span class=\"pulsteam_popis\">nejake info</span>

<span class=\"pulsteam_nadpis\">nadpis</span>
<span class=\"pulsteam_popis\">nejake info info info</span>

<span class=\"pulsteam_nadpis\">nadpis</span>
<span class=\"pulsteam_popis\">nejake info</span>

<span class=\"pulsteam_nadpis\">nadpis</span>
<span class=\"pulsteam_popis\">a tady bude taky neco info info info info info info info </span>

              </div>
            </li>


*/



/* -------------------------------------------------------------------------- */

                  "normal_vypis=salony-studio-puls" => "








<div id=\"slider_obrazky\">

%%10%%

</div>

<div id=\"slider_popisy\"></div>

<div id=\"slider_triggery\"></div>







</div>



<div id=\"salony_kdo_jsme\">

%%11%%


</div>




<h2>Služby</h2>

<script type=\"text/javascript\">
  $(document).ready(function(){


$('#salony_accordion').accordion({
autoHeight: false,
navigation: true,

animated: 'easeOutExpo'


});



  });
</script>

<div id=\"salony_accordion\">



<h3><a href=\"#\" title=\"\" class=\"studio_inner_effect\"><!-- --></a></h3>
<div>
%%12%%



</div>





<h3><a href=\"#\" title=\"\" class=\"studio_fyzikalni_barva_elumen\"><!-- --></a></h3>
<div>
%%13%%



</div>






<h3><a href=\"#\" title=\"\" class=\"studio_permanentni_narovnavani_vlasu_straightnshine\"><!-- --></a></h3>
<div>
%%14%%


</div>




<h3><a href=\"#\" title=\"\" class=\"studio_hot_razor\"><!-- --></a></h3>
<div>
%%15%%






</div>










<h3><a href=\"#\" title=\"\" class=\"studio_prodluzovani_vlasu\"><!-- --></a></h3>
<div>
%%16%%






</div>












<h3><a href=\"#\" title=\"\" class=\"studio_caffe_nespresso\"><!-- --></a></h3>
<div>
%%17%%





</div>











</div>








<h2>Mapa a adresa</h2>

<img src=\"%%19%%\" alt=\"mapa\" id=\"salony_mapa\" />



",


                  "normal_vypis_oneseriefoto_row=salony-studio-puls" => "<img src=\"%%1%%\" alt=\"%%2%%\" />",





                  "admin_vypis_obsah_sablony=5" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\"><span class=\"fl-l\">Studio Puls</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%5%%<a href=\"%%6%%\" title=\"Upravit\" class=\"editobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit</a>%%7%%</span></li>
%%4%%
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah upraven:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%11%%</span></li>
</ul>\n",




/* -------------------------------------------------------------------------- */





                  "normal_vypis=salony-salon-puls" => "






<div id=\"slider_obrazky\">

%%10%%

</div>

<div id=\"slider_popisy\"></div>

<div id=\"slider_triggery\"></div>







</div>



<div id=\"salony_kdo_jsme\">

%%11%%

</div>




<h2>Služby</h2>

<script type=\"text/javascript\">
  $(document).ready(function(){


$('#salony_accordion').accordion({
autoHeight: false,
navigation: true,

animated: 'easeOutExpo'


});



  });
</script>

<div id=\"salony_accordion\">

<h3><a href=\"#\" title=\"\" class=\"salon_kadernictvi\"><!-- --></a></h3>
<div>
%%12%%
</div>

<h3><a href=\"#\" title=\"\" class=\"salon_solarium\"><!-- --></a></h3>
<div>
%%13%%
</div>


<h3><a href=\"#\" title=\"\" class=\"salon_kosmetika\"><!-- --></a></h3>
<div>
%%14%%
</div>

<h3><a href=\"#\" title=\"\" class=\"salon_modelaz_nehtu\"><!-- --></a></h3>
<div>
%%15%%
</div>

<h3><a href=\"#\" title=\"\" class=\"salon_masaze\"><!-- --></a></h3>
<div>
%%16%%
</div>



</div>








<h2>Mapa a adresa</h2>

<img src=\"%%18%%\" alt=\"mapa\" id=\"salony_mapa\" />




",

                  "normal_vypis_oneseriefoto_row=salony-salon-puls" => "<img src=\"%%1%%\" alt=\"%%2%%\" />",





                  "admin_vypis_obsah_sablony=8" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\"><span class=\"fl-l\">Salon Puls</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%5%%<a href=\"%%6%%\" title=\"Upravit\" class=\"editobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit</a>%%7%%</span></li>
%%4%%
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah upraven:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%11%%</span></li>
</ul>\n",




/* -------------------------------------------------------------------------- */





















                  "normal_vypis=salony-salon-pulsline" => "










<div id=\"slider_obrazky\">

%%10%%

</div>

<div id=\"slider_popisy\"></div>

<div id=\"slider_triggery\"></div>







</div>



<div id=\"salony_kdo_jsme\">

%%11%%



</div>




<h2>Služby</h2>

<script type=\"text/javascript\">
  $(document).ready(function(){


$('#salony_accordion').accordion({
autoHeight: false,
navigation: true,

animated: 'easeOutExpo'


});



  });
</script>

<div id=\"salony_accordion\">



<h3><a href=\"#\" title=\"\" class=\"pulsline_kosmetika\"><!-- --></a></h3>
<div>
%%12%%

</div>

<h3><a href=\"#\" title=\"\" class=\"pulsline_galvanizace_pleti\"><!-- --></a></h3>
<div>
%%13%%







</div>

<h3><a href=\"#\" title=\"\" class=\"pulsline_pedikura\"><!-- --></a></h3>
<div>
%%14%%











</div>

<h3><a href=\"#\" title=\"\" class=\"pulsline_modelaz_nehtu\"><!-- --></a></h3>
<div>
%%15%%


















</div>











</div>








<h2>Mapa a adresa</h2>

<img src=\"%%17%%\" alt=\"mapa\" id=\"salony_mapa\" />







",

                  "normal_vypis_oneseriefoto_row=salony-salon-pulsline" => "<img src=\"%%1%%\" alt=\"%%2%%\" />",





                  "admin_vypis_obsah_sablony=9" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\"><span class=\"fl-l\">Salon Pulsline</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%5%%<a href=\"%%6%%\" title=\"Upravit\" class=\"editobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit</a>%%7%%</span></li>
%%4%%
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah upraven:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%11%%</span></li>
</ul>\n",




/* -------------------------------------------------------------------------- */



/*

<div>




<a href=\"#\" title=\"\" class=\"zrusit_oddelovac\">

<span class=\"sprit\" style=\"background-image: url(%%absolutni_url%%partner_vzor_1.png);\"><!-- --></span>
<span class=\"oddelovac\"><!-- --></span>
<span class=\"alternativa\">prvni</span>

</a>

<a href=\"#\" title=\"\">

<span class=\"sprit\" style=\"background-image: url(%%absolutni_url%%partner_vzor_2.png);\"><!-- --></span>
<span class=\"oddelovac\"><!-- --></span>
<span class=\"alternativa\">druhy</span>

</a>

<a href=\"#\" title=\"\">

<span class=\"sprit\" style=\"background-image: url(%%absolutni_url%%partner_vzor_1.png);\"><!-- --></span>
<span class=\"oddelovac\"><!-- --></span>
<span class=\"alternativa\">treti</span>

</a>

<a href=\"#\" title=\"\">

<span class=\"sprit\" style=\"background-image: url(%%absolutni_url%%partner_vzor_2.png);\"><!-- --></span>
<span class=\"oddelovac\"><!-- --></span>
<span class=\"alternativa\">ctvrty</span>

</a>

<a href=\"#\" title=\"\">

<span class=\"sprit\" style=\"background-image: url(%%absolutni_url%%partner_vzor_1.png);\"><!-- --></span>
<span class=\"oddelovac\"><!-- --></span>
<span class=\"alternativa\">paty</span>

</a>




</div>


*/




                  "normal_vypis_posledni=zapati-sprit" => array("poslrozdelovac" => "\n</div>\n",
                                                                "poslrozdelovacposledni" => " class=\"zrusit_oddelovac\""),

                  "normal_vypis_ente_od=zapati-sprit" => array("rozdelovac" => 1,  "rozdelovacposledni" => 0),

                  "normal_vypis_ente_po=zapati-sprit" => array("rozdelovac" => 5,  "rozdelovacposledni" => 5),

                  "normal_vypis_ente_break=zapati-sprit" => array("rozdelovac" => 0, "rozdelovacposledni" => 0),

                  "normal_vypis_begin_poc=zapati-sprit" => array("rozdelovac" => 0, "rozdelovacposledni" => 1),

                  "normal_vypis_ente=zapati-sprit" => array("rozdelovac" => "\n</div><div>\n",
                                                            "rozdelovacposledni" => " class=\"zrusit_oddelovac\"",
                                                            ),

                  "normal_vypis=zapati-sprit" => "
  <a href=\"%%17%%\" title=\"%%18%%\"%%rozdelovacposledni%%%%poslrozdelovacposledni%%>
    <span class=\"sprit\" style=\"background-image: url(%%11%%);\"><!-- --></span>
    <span class=\"oddelovac\"><!-- --></span>
    <span class=\"alternativa\">%%18%%</span>
  </a>
%%rozdelovac%%%%poslrozdelovac%%",









/*






                  %%prvnicoda%%%%rozdelovac%%                  <p%%rozdelovacposledni%%>
                    <a href=\"%%11%%\" title=\"%%12%%\" style=\"background-image: url(%%15%%);\"%%13%%><!-- --></a>
                  </p>\n%%poslednicoda%%



*/
















                  "admin_vypis_obsah_sablony=10" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\"><span class=\"fl-l\">%%13%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%5%%<a href=\"%%6%%\" title=\"Upravit obsah\" class=\"editobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit obsah</a>%%7%%</span></li>
%%4%%
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah přidán:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah upraven:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\"><span class=\"block w-150\" style=\"height: 94px; background: url(%%10%%) no-repeat right top;\"></span></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%12%%</span></li>
</ul>\n",














/* -------------------------------------------------------------------------- */

                  );

/* -------------------------------------------------------------------------- */

  return $result;
?>
