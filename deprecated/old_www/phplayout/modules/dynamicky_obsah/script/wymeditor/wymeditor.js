var dialog_width = 550;
var dialog_height = 300;
var dialog_left = (document.body.clientWidth / 2) - (dialog_width / 2);
var dialog_top = (document.body.clientHeight / 2) - (dialog_height / 2);

jQuery(function()
{
    jQuery('.wymeditor').wymeditor(
    {
      lang: 'cs',
      skin: 'default',
      stylesheet: 'modules/dynamicky_obsah/dynamicky_obsah.css',
      logoHtml: '<a href="#" id="napoveda_wym" class="napoveda_wym_pozice" title="Nápověda k WYM editoru">Nápověda k WYM editoru</a>',

      containersItems: [
      {
        'name': 'P',
        'title': 'Paragraph',
        'css': 'wym_containers_p'
      },
/*
      {
      'name': 'H1',
      'title': 'Heading_1',
      'css': 'wym_containers_h1'
      },

      {
      'name': 'H2',
      'title': 'Heading_2',
      'css': 'wym_containers_h2'
      },
*/
      {
      'name': 'H3',
      'title': 'Heading_3',
      'css': 'wym_containers_h3'
      },
/*
      {
      'name': 'H4',
      'title': 'Heading_4',
      'css': 'wym_containers_h4'
      },

      {
      'name': 'H5',
      'title': 'Heading_5',
      'css': 'wym_containers_h5'
      },

      {
      'name': 'H6',
      'title': 'Heading_6',
      'css': 'wym_containers_h6'
      },

      {
      'name': 'PRE',
      'title': 'Preformatted',
      'css': 'wym_containers_pre'
      },

      {
      'name': 'BLOCKQUOTE',
      'title': 'Blockquote',
      'css': 'wym_containers_blockquote'
      },

      {
      'name': 'TH',
      'title': 'Table_Header',
      'css': 'wym_containers_th'
      }
*/
      ],

      classesItems: [
      {
        'name': 'mensi_odsazeni',
        'title': 'Menší odsazení nad (nadpis)',
        'expr': 'h3'
      },

      {
        'name': 'display-none',
        'title': 'Skrýt element',
        'expr': 'p, h3'
      },
/*
      {
        'name': 'hidden-note',
        'title': 'PARA: Hidden note',
        'expr': 'p[@class!=\"important\"]'
      },

      {
        'name': 'important',
        'title': 'PARA: Important',
        'expr': 'p[@class!=\"hidden-note\"]'
      },

      {
        'name': 'border',
        'title': 'IMG: Border',
        'expr': 'img'
      },

      {
        'name': 'special',
        'title': 'LIST: Special',
        'expr': 'ul, ol'
      }
*/
      ],

      dialogFeatures: "menubar=no,titlebar=no,toolbar=no,resizable=no,width="+dialog_width+",height="+dialog_height+",top="+dialog_top+",left="+dialog_left+"",
      dialogFeaturesPreview: "menubar=no,titlebar=no,toolbar=no,resizable=no,scrollbars=yes,width="+dialog_width+",height="+dialog_height+",top="+dialog_top+",left="+dialog_left+"",

      postInit: function(wym)
      {
/*
            jQuery.extend(WYMeditor.STRINGS['cs'], {
                'Wrap': 'Wrap'
            });

            var html = "<li class='wym_tools_wrap'>"
                     + "<a href='#'"
                     + " title='Vložit definovaný prvek'"
                     + " style='background-image:"
                     + " url(script/wymeditor/skins/default/vlozit_definovany_prvek.png)'>"
                     + "Vložit definovaný prvek"
                     + "</a></li>";

            jQuery(wym._box)
            .find(wym._options.toolsSelector + wym._options.toolsListSelector)
            .append(html);

            html = "<li class='wym_tools_unwrap'>"
                     + "<a href='#'"
                     + " title='Zrušit definovaný prvek'"
                     + " style='background-image:"
                     + " url(script/wymeditor/skins/default/zrusit_definovany_prvek.png)'>"
                     + "Zrušit definovaný prvek"
                     + "</a></li>";

            jQuery(wym._box)
            .find(wym._options.toolsSelector + wym._options.toolsListSelector)
            .append(html);

            html = "<body class='wym_dialog wym_dialog_wrap'"
               + " onload='WYMeditor.INIT_DIALOG(" + WYMeditor.INDEX + ")'"
               + ">"
               + "<form>"
               + "<fieldset>"
               + "<input type='hidden' class='wym_dialog_type' value='"
               + "Wrap"
               + "' />"
               + "<legend>Wrap</legend>"
               + "<div class='row'>"
               + "<label>Type</label>"
               + "<select class='wym_select_inline_element'>"
               + "<option selected value='abbr'>Abbreviation</option>"
               + "<option value='acronym'>Acronym</option>"
               + "<option value='cite'>Citation, reference</option>"
               + "<option value='code'>Code</option>"
               + "<option value='del'>Deleted content</option>"
               + "<option value='ins'>Inserted content</option>"
               + "<option value='span'>Generic</option>"
               + "</select>"
               + "</div>"
               + "<div class='row'>"
               + "<label>Title</label>"
               + "<input type='text' class='wym_title' value='' size='40' />"
               + "</div>"
               + "<div class='row row-indent'>"
               + "<input class='wym_submit wym_submit_wrap' type='button'"
               + " value='{Submit}' />"
               + "<input class='wym_cancel' type='button'"
               + "value='{Cancel}' />"
               + "</div>"
               + "</fieldset>"
               + "</form>"
               + "</body>";

            jQuery(wym._box)
            .find('li.wym_tools_wrap a').click(function() {
                wym.dialog( 'Wrap', null, html );
                return(false);
            });

            jQuery(wym._box)
            .find('li.wym_tools_unwrap a').click(function() {
                wym.unwrap();
                return(false);
            });

        var rules = [
          { name: '.mensi_odsazeni_styl',
            css: 'background-color: #f99;' },
          { name: '.dc_creator',
            css: 'background-color: #9f9;' },
          { name: '.dc_title',
            css: 'background-color: #9ff;' },
          { name: '.foaf_Person',
            css: 'background-color: #69c;' },
          { name: '.foaf_name',
            css: 'background-color: #99c;' },
          { name: '.foaf_homepage',
            css: 'background-color: #c9c;' },
          { name: '.foaf_mbox',
            css: 'background-color: #c6c;' },
          { name: '.foaf_phone',
            css: 'background-color: #c3c;' }
        ];
        wym.addCssRules( wym._doc, rules);
*/
/*
        //construct the button's html 1
        var html1 = "<li class='wym_tools_newbutton1'>"
                 + "<a name='NewButton' title='Vložit absolutní url' href='#'"
                 + " style='background-image:"
                 + " url(script/wymeditor/skins/default/vlozit_definovany_prvek.png)'>"
                 + "Vložit absolutní url"
                 + "</a></li>";

        //add the button to the tools box
        jQuery(wym._box)
        .find(wym._options.toolsSelector + wym._options.toolsListSelector)
        .append(html1);

        //handle click event
        jQuery(wym._box)
        .find('li.wym_tools_newbutton1 a').click(function() {
            //do something
            //wym.insert('@@1@@');
            //wym.wrap('@@', '@@');
            //wym.container('element'); - prehodi na standardni text - ale vyhodi ostatni elementy - pro obnoveni ostatnich elementu je potreba klapnout na jiny vlastni definovany prvek
            //wym.container('@@1@@');
            wym.status("Vložit absolutní url");
            //wym.paste('@@1@@');
            return(false);
        });


        //construct the button's html 2
        var html2 = "<li class='wym_tools_newbutton2'>"
                 + "<a name='NewButton' title='tlacitko2' href='#'"
                 + " style='background-image:"
                 + " url(script/wymeditor/skins/default/vlozit_definovany_prvek.png)'>"
                 + "Do html2"
                 + "</a></li>";

        //add the button to the tools box
        jQuery(wym._box)
        .find(wym._options.toolsSelector + wym._options.toolsListSelector)
        .append(html2);

        //handle click event
        jQuery(wym._box)
        .find('li.wym_tools_newbutton2 a').click(function() {
            //do something
            wym.insert('<em>ahjo wole :D</em>');
            wym.status("Vkládám text Ahoj..");
            //wym.paste('Lorem ipsum dolor sit amet, consectetuer adipiscing elit.');
            return(false);
        });

        //construct the button's html 3
        var html3 = "<li class='wym_tools_newbutton2'>"
                 + "<a name='NewButton' title='tlacitko3' href='#'"
                 + " style='background-image:"
                 + " url(script/wymeditor/skins/default/vlozit_definovany_prvek.png)'>"
                 + "Do html3"
                 + "</a></li>";

        //add the button to the tools box
        jQuery(wym._box)
        .find(wym._options.toolsSelector + wym._options.toolsListSelector)
        .append(html3);

        //handle click event
        jQuery(wym._box)
        .find('li.wym_tools_newbutton2 a').click(function() {
            //do something
            //wym.wrap('@@', '@@');
            wym.insert('@@1@@');
            wym.status("Vkládám absoutni url...");
            //wym.paste('Lorem ipsum dolor sit amet, consectetuer adipiscing elit.');
            return(false);
        });
*/
        //wym.resizable(); /* bud resizable nebo fullscreen - vzdycky muze byt pouzito jen jedno */
        wym.fullscreen();
        wym.hovertools();
      },

      //handle click event on dialog's submit button
      postInitDialog: function( wym, wdw )
      {

        //wdw is the dialog's window
        //wym is the WYMeditor instance

        var body = wdw.document.body;

        jQuery( body )
          .find('input.wym_submit_wrap')
          .click(function()
          {
              var tag   = jQuery(body).find('.wym_select_inline_element').val();
              var title = jQuery(body).find('.wym_title').val();

              wym.wrap( '<' + tag + ' title="' + title + '">', '</' + tag + '>' );
              wdw.close();
          });

        //postInitDialog is executed when the dialog is ready

        //'wym' is the WYMeditor instance
        //'wdw' is the dialog's window

        var body = wdw.document.body;

        //add a select box populated with predefined values to the dialog

        //construct the string with the needed controls
        var selectLink = "<div class='row row-indent'>"
        + "<select class='wym_select_link'>"
        + "<option selected value='@@1@@'>"
        + "Absolutní url<\/option>"
        + "<option value='Kavárna jantar http://www.kavarnajantar.cz/'>"
        + "Kavárna jantar<\/option>"
        + "<option value='Uvítací list @@1@@'>"
        + "Sekce: Uvítací list<\/option>"
        + "<option value='O čajovně @@1@@o-cajovne'>"
        + "Sekce: O čajovně<\/option>"
        + "<option value='Galerie @@1@@galerie'>"
        + "Sekce: Galerie<\/option>"
        + "<option value='Online nabídník @@1@@online-nabidnik'>"
        + "Sekce: Online nabídník<\/option>"
        + "<option value='Návštěvní kniha @@1@@navstevni-kniha'>"
        + "Sekce: Návštěvní kniha<\/option>"
        + "<\/select>"
        + "<input class='wym_choose' type='button'"
        + " value='{Choose}' />"
        + "<\/div>";

        var selectLinkImg = "<div class='row row-indent'>"
        + "<select class='wym_select_link'>"
        + "<option selected value='@@1@@'>"
        + "Absolutní url<\/option>"
        + "<\/select>"
        + "<input class='wym_choose' type='button'"
        + " value='{Choose}' />"
        + "<\/div>";

        //the {Choose} string will automagically be localized
        //by replaceStrings()

        //add the controls to the dialog
        jQuery(body)
            .filter('.wym_dialog_link').find('fieldset').eq(0)
            .prepend(wym.replaceStrings(selectLink));

        jQuery(body)
            .filter('.wym_dialog_image').find('fieldset').eq(0)
            .prepend(wym.replaceStrings(selectLinkImg));

        //bind a function which will populate the URL and title fields
        //when the user clicks on the wym_choose button
        jQuery(body)
            .find('.wym_choose')
            .click(function()
            {
              var myval = jQuery(body).find('.wym_select_link').val();

              //get the URL and the title
              jQuery(body)
                  .find('.wym_href')
                  .val(myval.substring(myval.lastIndexOf(' ') + 1));
              jQuery(body)
                  .find('.wym_title')
                  .val(myval.substr(0, myval.lastIndexOf(' ')));

              jQuery(body)
                  .find('.wym_src')
                  .val(myval.substring(myval.lastIndexOf(' ') + 1));
              jQuery(body)
                  .find('.wym_alt')
                  .val(myval.substr(0, myval.lastIndexOf(' ')));
            });
      }

    });
});
