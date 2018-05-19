// pro aktualizaci modulu
$(function(){
  $(".aktualizace_modulu li.stav, .aktualizace_modulu li.stav .aktualni, .aktualizace_modulu li.stav .aktualni_novejsi,  .aktualizace_modulu li.stav .vystraha,  .aktualizace_modulu li.stav .neaktualni, .aktualizace_modulu li.stav .stahnout_modul, .aktualizace_modulu li.stav .nahrat_modul").tooltip({
    position: ['top', 'center'],
    offset: [10, 0]
  });
});

$(function(){
  $(".aktualizace_modulu li.modul").tooltip({
    position: ['center', 'right'],
    offset: [11, -10]
  });
});

// pro captcha obrazky
$(function(){
  $("li.nazev_captcha span.font_existuje, li.nazev_captcha span.font_neexistuje").tooltip({
    position: ['top', 'center'],
    offset: [10, 0]
  });
});
