<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <meta name="author" content="GMR hosting, www.gmrhosting.cz, www.gfdesign.cz" />
      <title>{$title}</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta name="description" content="{@Oficiální stránky Trainz Railroad Simulator@}" />
      <meta name="robots" content="index, follow" />
      <meta name="viewport" content="width=device-width" />
      <meta name="keywords" content="trainz, trainz cz, trainz.cz, train, czech trainz, trainz railroad simulator, trainz simulator, gmax, 3dsmax, cs trainz, cz trainz, TS12" />
{if="isset($upload_uri['block']) && $upload_uri['block'] == 'slideshows'"}
      <meta http-equiv="pragma" content="no-cache">
      <meta http-equiv="expires" content="0">
      <meta http-equiv="cache-control" content="no-cache">
{/if}
      <!-- favicon.ico -->
      <link rel="stylesheet" type="text/css" href="{$weburl}css/reset.css" />
      <link rel="stylesheet" type="text/css" href="{$weburl}css/bootstrap.css" />
      <link rel="stylesheet" type="text/css" href="{$weburl}css/main.css" />
      {loop="$menu->getCSS()"}<link rel="stylesheet" type="text/css" href="{$weburl}{$value}" />\n      {/loop}
      <script src="{$weburl}js/modernizr-2.6.2.min.js"></script>
  </head>
  <body>
    <div id="fb-root"></div>
    <span id="body_top"><!-- modre pozadi v oblasti zahlavi --></span>
    <div id="obal_layout">
    <!--[if lte IE 8]>
      <p class="chromeframe">Používáte <strong>zastaralý</strong> prohlížeč. <a href="http://browsehappy.com/">Aktualizujte svůj prohlížeč</a> nebo <a href="http://www.google.com/chromeframe/?redirect=true">aktivujte Google Chrome Frame</a>.</p>
    <![endif]-->
      <noscript>
        <p class="chromeframe">Váš prohlížeč nemá povolený javascript nebo ho nepodporuje!<br />Bez javascriptu nebudou stránky správně fungovat!</p>
      </noscript>

      <header>
        <h1><a href="{$weburl}" title="{$title}" id="trainznazev">{$title}</a></h1>
{compile_file="menu.tpl"}
      </header>
{compile_file="language.tpl"}
      <div id="obal_obsah">
        <span id="body_obsah_top"><!-- skryti pozadi obsahu v oblasti zahlavi --></span>
        <div id="obsah">
{include="$menu->getTplAddress('_', (isset($uri.page) && $uri.page == 'novinky' ? array('novinky') : null))"}
        </div>
      </div>
    </div>{/* {$weburl_admin}({$current_language}) */}
    <div id="zapati">
      <p>Created by <a href="http://www.gfdesign.cz/" title="GMR hosting, www.gmrhosting.cz, www.gfdesign.cz">GMR</a></p>
    </div>
    <script src="{$weburl}js/jquery-1.10.2.min.js"></script>
    <script src="{$weburl}js/bootstrap.min.js"></script>
    <script src="{$weburl}js/plugins.js"></script>

    {loop="$menu->getJS(null, true)"}<script src="{$weburl}{$value}"></script>\n    {/loop}
    {loop="isset($upload_menu) ? $upload_menu->getJS() : array()"}<script src="{$weburl}{$value}"></script>\n    {/loop}

    <script>$('#hid_scr').val(JSON.stringify({availWidth:screen.availWidth,availHeight:screen.availHeight,availTop:screen.availTop,availLeft:screen.availLeft,pixelDepth:screen.pixelDepth,colorDepth:screen.colorDepth,width:screen.width,height:screen.height}));</script>
    {if="isset($uri['page']) && in_array($uri['page'], array('upload', 'download'))"}<script type="text/javascript">

      function downloadCDP(id, ret, reckon) {
        $.post('{$weburl}ajax.php', {'type': 'download_cdp', 'id': id, 'reckon': reckon}, function(data) {
          var jdata = jQuery.parseJSON(data);
          if (Object.keys(jdata).length > 0) {  // pokud jsou validni data
            if (ret) {
              $(ret+id).html(jdata.counter+'x');
            }
            window.location = '{$weburl}down.php?name='+jdata.name+'&path='+jdata.path;
          } else {
            window.location = '{$weburl}';  //illegal cdp
          }
        });
        return false;
      }

    {if="$uri['page'] == 'upload' && isset($uri['block']) && $uri['block'] == 'downloads'"}
{code}
//~ var_dump($_POST);
//~ var_dump($uri);
//~ var_dump($upload_uri);

  $version = '[]';
  $cdp_file = '[]';
  $kuid_cdp = '[]';
  $kuid_cdp_plain = '[]';

  // pri pridavani
  if (isset($upload_uri['action']) && $upload_uri['action'] == 'add') {
    $version = isset($_POST['version']) ? json_encode($_POST['version']) : '[]';
    $kuid_cdp = isset($_POST['kuid_cdp']) ? json_encode($_POST['kuid_cdp']) : '[]';
    $kuid_cdp_plain = isset($_POST['kuid_cdp_plain']) ? json_encode($_POST['kuid_cdp_plain']) : '[]';
  }

  // pri uprave
  if (isset($upload_uri['action']) && $upload_uri['action'] == 'update' &&
    isset($upload_uri['id']) && is_numeric($upload_uri['id'])) {
    $iddownload = $upload_uri['id'];

    $cdp = $db->rawQuery('SELECT idtrainz_cdp, name FROM trainz_cdp
                          JOIN downloads_has_trainz_cdp USING(idtrainz_cdp)
                          WHERE iddownload=?', array($iddownload));

    $cdp_file_db = array();
    $version_db = array();
    $kuid_cdp_db = array();
    foreach ($cdp as $v) {
      $cdp_file_db[] = $v;
      $c = $db->rawQuery('SELECT idtrainz_version FROM trainz_versions
                          JOIN trainz_cdp_has_trainz_versions USING(idtrainz_version)
                          WHERE idtrainz_cdp=?', array($v->idtrainz_cdp))->getAllRows();
      $version_db[] = $c;

      $c = $db->rawQuery('SELECT idtrainz_kuid FROM trainz_kuids
                          JOIN trainz_cdp_has_trainz_kuids _tchtk USING(idtrainz_kuid)
                          WHERE _tchtk.idtrainz_cdp=?', array($v->idtrainz_cdp))->getAllRows();
      $kuid_cdp_db[] = $c;
    }

    $cdp_file = json_encode($cdp_file_db);
    $version = isset($_POST['version']) ? json_encode($_POST['version']) : json_encode($version_db);
    $kuid_cdp = isset($_POST['kuid_cdp']) ? json_encode($_POST['kuid_cdp']) : json_encode($kuid_cdp_db);
    $kuid_cdp_plain = isset($_POST['kuid_cdp_plain']) ? json_encode($_POST['kuid_cdp_plain']) : '[]';
  }
{/code}


    $(function() {
      $('.jenom-cisla').numberMask();

      $('.kuid_input').numberMask({pattern:/^[\-0-9\:]+$/});

      initValidation();

      $('.kuid_input').keyup(function() {
        $('.kuid_format').html(typKuidu(this.value) + ' <em>→</em> '+ (isKuid(this.value) ? '<i class="icon-ok-sign"></i>' : '<i class="icon-remove-sign"></i>'));
      });

      var data_cdp_file = {$cdp_file};
      var data_version = {$version};
      var data_kuid_cdp = {$kuid_cdp};
      var data_kuid_cdp_plain = {$kuid_cdp_plain};

      var selectFormat = function(item) { return item.value; };
      var ajaxData = function (term, page) { return {type: 'select_trainz_kuids', value: term}; };
      var ajaxResults = function (data, page) { return {results: data}; };
      var initSelect = function(element, callback) {
          if (element.val() !== '') {
            $.post('{$weburl}ajax.php', {'type': 'init_select_trainz_kuids', 'value': element.val()}, function(data) {
              callback(jQuery.parseJSON(data));
            });
          }
        };

      var poc = 0;
      function addCDP() {
        $('.download_cdp').append('<div class="row'+poc+' file_oddil"><ul class="list-group">'+
          '<li class="panel-heading clearfix">Oddíl #'+(poc + 1) + (poc > 0 ? '<a href="javascript:removeCDP('+poc+')" class="btn btn-primary btn-xs pull-right odebrat_oddil"><i class="icon-remove-sign"></i> Odebrat Oddíl #'+(poc + 1)+'</a>' : '') + '</li>'+
          '<li class="list-group-item">'+
            '<div class="form-group">'+
              '<label class="col-lg-2 control-label">Soubor</label>'+
              '<div class="col-lg-10">'+
                '<input type="file" name="cdp['+poc+']" id="soubor'+poc+'" class="filestyle" />'+
                '<span class="help-block">Povinné pole. Zde vložte soubor (*.cdp, *.zip, *.rar, apod.)</span>'+
              '</div>'+
            '</div>'+
            (data_cdp_file[poc] ?
            '<div class="form-group">'+
              '<label class="col-lg-2 control-label">Nahraný soubor</label>'+
              '<div class="col-lg-10">'+
                '<a href="#" onclick="return downloadCDP('+data_cdp_file[poc].idtrainz_cdp+', null, false)" class="btn btn-default">'+data_cdp_file[poc].name+'</a>'+
                '<span class="help-block">Zde můžete stáhnout aktuálně přiřazený soubor.</span>'+
              '</div>'+
            '</div>' : '')+
            '<div class="form-group">'+
              '<label class="col-lg-2 control-label">Trainz verze</label>'+
              '<div class="col-lg-10">'+
                '<select name="version['+poc+'][]" class="upload-select2" multiple>{loop="$crate->getArrayListTrainzVersion()"}<option value="{$key}"'+(in_array({$key}, data_version[poc]) ? ' selected' : '')+'>{$value}</option>{/loop}</select>'+
                '<span class="help-block">Zde můžete kliknutím do pole vybrat neomezený počet Trainz verzí z databáze.</span>'+
              '</div>'+
            '</div>'+
            '<div class="form-group">'+
              '<label class="col-lg-2 control-label">Kuid (databáze)</label>'+
              '<div class="col-lg-10">'+
                '<input type="hidden" name="kuid_cdp['+poc+'][]" class="upload-kuid-select2" value="'+(data_kuid_cdp[poc] ? data_kuid_cdp[poc] : '')+'"/>'+
                '<span class="help-block">Zde můžete kliknutím do pole vybrat neomezený počet kuidů z databáze, které jsou obsaženy v souboru.</span>'+
              '</div>'+
            '</div>'+
            '<div class="form-group posledni-form-group">'+
              '<label class="col-lg-2 control-label">Kuid (přidat nový)</label>'+
              '<div class="col-lg-10 clearfix">'+
                '<textarea name="kuid_cdp_plain['+poc+']" class="kuid_input_plain defined-265 autosize form-control" onkeyup="javascript:validateKuid(this.value, \'.kuid_dyn_kontrola_'+poc+'\')" placeholder="xxxxx:yyyyy(:zzz)">'+(data_kuid_cdp_plain[poc] ? data_kuid_cdp_plain[poc] : '')+'</textarea><div class="kuid_dyn_kontrola_'+poc+' custom-label-2 defined-265">Formát: &lt;kuid(2):(-)xxxxx:yyyyy(:zzz)&gt;</div>'+
                '<span class="help-block clrb">Zde můžete zadat neomezený počet kuidů, které jsou obsaženy v souboru.<br />Každý nový kuid musí být na novém řádku!<br />Prázdné řádky se vyhodnocují jako špatné zadání!<br />Kuid musí mít správný formát! Pouze čísla, dvojtečky a mínusy!<ul><li><em>xxxxx:yyyyy</em> pro <em>&lt;kuid:xxxxx:yyyyy&gt;</em></li><li><em>xxxxx:yyyyy:zzz</em> pro <em>&lt;kuid2:xxxxx:yyyyy:zzz&gt;</em></li></ul></span>'+
              '</div>'+
            '</div>'+
          '</li>'+
        '</ul>'+
      '</div>');
         poc++;
         initValidation();
        $(":file").filestyle({buttonText: "Vybrat soubor", classButton: "btn btn-primary", classInput: "form-control btn-file"});
        $("select.upload-select2").select2();

        $("input.upload-kuid-select2").select2({
          minimumInputLength: 3,
          multiple: true,
          ajax: {
              url: '{$weburl}ajax.php',
              type: 'POST',
              data: ajaxData,
              results: ajaxResults
            },
            initSelection: initSelect,
            formatSelection: selectFormat,
            formatResult: selectFormat
        });
      }

      $("input.upload-kuid-dependency-select2").select2({
        minimumInputLength: 3,
        multiple: true,
        ajax: {
            url: '{$weburl}ajax.php',
            type: 'POST',
            data: ajaxData,
            results: ajaxResults
          },
          initSelection: initSelect,
          formatSelection: selectFormat,
          formatResult: selectFormat
      });

      $('.add_cdp').click(function() {  // nabindovani hrefu na funkci
        addCDP();
        $.jGrowl("Byl přidán Oddíl #"+poc+"!", {position: 'bottom-right'});
        return false;
      });

      if (data_version.length == 0) { // pridani jedne cdp polozky
        addCDP();
      }

      for (var k in data_version) { // naklikani podle vracenych poctu
        addCDP();
      }

      $('.ajax_downloads_name').keyup(function() {  // ajax kontrola download duplicity
        var patr = /[0-9]{1}/;
        var m = patr.exec($(this).attr('name'));  // identifikace jednotlivych indexu elementu
        $.post('{$weburl}ajax.php', {'type': 'unique_download_name', 'value': $('.ajax_downloads_name').serialize(), 'value_id': m[0], 'act': '{if="isset($upload_uri.action)"}{$upload_uri.action ?: 'null'}{else}null{/if}', 'id': {if="isset($upload_uri.id)"}{$upload_uri.id ?: 'null'}{else}null{/if}}, function(data) {
          $('.result_ajax_name'+m[0]).html(data);
        });
      });
    });
    {/if}
    </script>{/if}
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-17828373-3']);
      _gaq.push(['_trackPageview']);
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/cs_CZ/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <script type="text/javascript">
      window.___gcfg = {lang: 'cs'};

      (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/platform.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
      })();
    </script>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
  </body>
</html>