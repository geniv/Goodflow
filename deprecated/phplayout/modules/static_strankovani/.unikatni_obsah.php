<?php

  $result = array(//get strankovani
                  "set_get_str_1" => "str",  //str, action

//typ zobrazeni: lowclassic, fullclassic, lowgroups, fullgroups, once, cuting, selpage, center, paginate, text
                  "set_typ_vypisu_1" => "lowclassic",

                  "set_active_pole_prechodu_1" => false,

                  //typ => maximalni/konecna mez (X >= poctu stran, kde 0 == neomezene)
                  "set_pole_prechodu_typu_1" => array("fullclassic" => 15, //1-15
                                                      "lowclassic" => 20, //16-20
                                                      "center" => 30, //21-30
                                                      "once" => 0), //31-inf

                  //lowclassic
                  "normal_lowclassic_prvni_1" => 2,

                  "normal_lowclassic_prostredni_1" => 3, //liche!

                  "normal_lowclassic_posledni_1" => 2,

                  "normal_lowclassic_prev_1" => "<a href=\"%%1%%\" title=\"Předchozí strana\">Předchozí strana</a> ",

                  "normal_lowclassic_current_1" => "%%1%%",

                  "normal_lowclassic_page_1" => "<a href=\"%%1%%\" title=\"Strana %%2%%\">%%2%%</a>",

                  "normal_lowclassic_sep_1" => ", ",

                  "normal_lowclassic_dot_1" => " ... ",

                  "normal_lowclassic_next_1" => " <a href=\"%%1%%\" title=\"Další strana\">Další strana</a>",


                  //fullclassic
                  "normal_fullclassic_prev_1" => "<a href=\"%%1%%\" title=\"Předchozí strana\">Předchozí strana</a> ",

                  "normal_fullclassic_current_1" => "%%1%%",

                  "normal_fullclassic_page_1" => "<a href=\"%%1%%\" title=\"Strana %%2%%\">%%2%%</a>",

                  "normal_fullclassic_sep_1" => ", ",

                  "normal_fullclassic_next_1" => " <a href=\"%%1%%\" title=\"Další strana\">Další strana</a>",


                  //lowgroups
                  "normal_lowgroups_prvni_1" => 2,

                  "normal_lowgroups_prostredni_1" => 3, //liche!

                  "normal_lowgroups_posledni_1" => 2,

                  "normal_lowgroups_sep_1" => " ",

                  "normal_lowgroups_dot_1" => " ... ",

                  "normal_lowgroups_prev_1" => "<a href=\"%%1%%\" title=\"Předchozí strana\">Předchozí strana</a> ",

                  "normal_lowgroups_current_1" => "[%%1%%..%%2%%] ",

                  "normal_lowgroups_page_1" => "<a href=\"%%1%%\">[%%2%%..%%3%%]</a> ",

                  "normal_lowgroups_next_1" => " <a href=\"%%1%%\" title=\"Další strana\">Další strana</a>",


                  //fullgroups
                  "normal_fullgroups_prev_1" => "<a href=\"%%1%%\" title=\"Předchozí strana\">Předchozí strana</a> ",

                  "normal_fullgroups_current_1" => "[%%1%%..%%2%%] ",

                  "normal_fullgroups_page_1" => "<a href=\"%%1%%\">[%%2%%..%%3%%]</a> ",

                  "normal_fullgroups_next_1" => " <a href=\"%%1%%\" title=\"Další strana\">Další strana</a>",


                  //once
                  "normal_once_prev_1" => "<a href=\"%%1%%\" title=\"Předchozí strana\">Předchozí strana</a> ",

                  "normal_once_current_1" => "%%1%%",

                  "normal_once_next_1" => " <a href=\"%%1%%\" title=\"Další strana\">Další strana</a>",


                  //cuting
                  "normal_cuting_vysek_1" => 7, //licha cisla

                  "normal_cuting_prev_1" => "<a href=\"%%1%%\" title=\"Předchozí strana\">Předchozí strana</a> ",

                  "normal_cuting_current_1" => "%%1%%",

                  "normal_cuting_page_1" => "<a href=\"%%1%%\" title=\"Strana %%2%%\">%%2%%</a>",

                  "normal_cuting_sep_1" => ", ",

                  "normal_cuting_dot_1" => " ... ",

                  "normal_cuting_next_1" => " <a href=\"%%1%%\" title=\"Další strana\">Další strana</a>",


                  //selpage
                  "normal_selpage_prev_1" => "<a href=\"%%1%%\" title=\"Předchozí strana\">Předchozí strana</a> ",

                  "normal_selpage_select_begin_1" => "<select onchange=\"document.location.href='%%1%%'+this.value\">",

                  "normal_selpage_select_1" => "<option value=\"%%2%%\"%%1%%>%%2%%</option>",

                  "normal_selpage_select_end_1" => "</select>",

                  "normal_selpage_next_1" => " <a href=\"%%1%%\" title=\"Další strana\">Další strana</a>",


                  //center
                  "normal_center_prev_1" => "<a href=\"%%1%%\" title=\"Předchozí strana\">Předchozí strana</a> ",

                  "normal_center_count_1" => 9, //liche!

                  "normal_center_sep_1" => ", ",

                  "normal_center_current_1" => "%%1%%",

                  "normal_center_page_1" => "<a href=\"%%1%%\" title=\"Strana %%2%%\">%%2%%</a>",

                  "normal_center_next_1" => " <a href=\"%%1%%\" title=\"Další strana\">Další strana</a>",


                  //paginate
                  "normal_paginate_1" => "
  <link type=\"text/css\" href=\"%%1%%%%2%%/script/css/style.css\" rel=\"stylesheet\" />
  <script type=\"text/javascript\" src=\"%%1%%%%2%%/script/jquery.paginate.js\"></script>
  <script type=\"text/javascript\">
    $(function() {
      $('#jquerystrankovani').paginate({
        count: %%4%%,
        start: %%3%%,
        display: 10,
        border: true,
        border_color: '#BEF8B8',
        text_color: '#68BA64',
        background_color: '#E3F2E1',
        border_hover_color: '#68BA64',
        text_hover_color: 'black',
        background_hover_color : '#CAE6C6',
        rotate: false,
        images: false,
        mouse: 'press',
        onChange: function(page){
          document.location.href='%%1%%%%5%%'+page;
        }
      });
    });
  </script>

  <div id=\"jquerystrankovani\"></div>
                  ",

                  //text
                  "normal_text_1" => "<a href=\"#%%1%%\">%%1%%</a>",

                  "normal_text_sep_1" => ", ",



                  "normal_strankovani_1" => "<div id=\"strankovani\">
  <span id=\"info_strana\">Strana %%2%% z %%3%%</span>
  <span id=\"urceni_strany\">%%1%%</span>
</div>",

                  );

  return $result;
?>
