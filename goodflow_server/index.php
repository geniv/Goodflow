<?php
/*
 *      index.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 * admin system serveru
 *
 * extensions:
 * https://github.com/Austinb/GameQ.git
 */

require_once 'extensions/GameQ/GameQ.php';
$gq = new GameQ();

//FIXME vyresit prepisovani spl autoloaderu!!! resp jejich vzajemne kryti!!!!

  //load autoload
  require 'loader.php';


//enter~.
//disc - distribuovane kompilovani

  use classes\Html,
      classes\HtmlPage,
      classes\Core,
      classes\Form;

  if (Core::checkPHP()) {
    $weburl = Core::getUrl();

    $page = NULL;

    //Loader::setExceptionDir('extensions');

    //echo hash(Config::HASH_CODE, 'cosik');
//Core::isOpera() || Core::isChrome()
    if (classes\UserAgentString::isBrowser(array('Chrome', 'Android Webkit Browser', 'Firefox', 'Opera'))) {
      Core::enableDebug();

      //TODO do konfigu!! resp jinak! ale ais do konfigu a jiank autorizace!!!
      $users = array(
                      'geniv' => '71e1c5b2c6a187e9c1221c455e99a7c0a05b592f7e9b8c060499babbd6ba2c58',  //t.a
                      'Fugess' => '6a7367ef7970d165bf9a60a16ef4365b2b7670f5064a35438e2ea0049dbdb1dd', //M.
                      'rami.cz' => '5a833dd539688b3a8fbe553be5240425411b6bca461e818a48d86600906c5d7a', //e.r.42
                    );

      if (!isset($_SERVER['PHP_AUTH_USER'])) {
        header('WWW-Authenticate: Basic realm="My Realm admin"');
        header('HTTP/1.0 401 Unauthorized');
        $page = new HtmlPage(HtmlPage::DOCTYPE_STRICT);
        $page->setLanguage(Config::LANG);
        $page->addBody(Html::h1()->setText('... klikl jsi na blbé tlačítko :) ...'));
        echo $page;
        exit;
      } else {

        if ($users[$_SERVER['PHP_AUTH_USER']] == hash(Config::HASH_CODE, $_SERVER['PHP_AUTH_PW'])) {

          $page = new HtmlPage(HtmlPage::DOCTYPE_STRICT);
          $page->setLanguage(Config::LANG)
              ->setUrlPage($weburl)
              ->addMeta('author', 'GoodFlow design')
              ->addMeta('copyright', 'Created by GoodFlow design')
              ->addMeta('description', 'GoodFlow server admin')
              ->loadCSS('styles/global_styles.css')
              ->setTitle('GoodFlow server admin')
              ->loadJavaScript('script/jquery/jquery-1.7.2.min.js')

              ->addJavaScript('
$(document).ready(function() {
  $("#obal_obsah #odkaz_seznam_screen").click(
    function(){
      $(".obal_screen table.seznam_screen").toggle();
    }
  );
});
')


          //->addMeta('author', Config::PROJECT_NAME.' (www.gfdesign.cz)')
          //->addMeta('copyright', 'Created by GoodFlow design')
          //->addMeta('description', $title)
          //->addMeta('robots', 'index, follow')
          //->addMeta('google-site-verification', 'JR_I4kX0Gn7LJexLY4k0YxlLGRE0MkZcpuu85VnFLes')
          //->loadCSS('styles/global_styles.css')
          //->loadCSS('highslide/highslide.css')
          //->loadCSS('highslide/highslide.config.css')
          //->loadCSS(Core::isWebKit() ? 'styles/webkit_styles.css' : NULL)
          //->loadCSS(Core::isOpera() ? 'styles/opera_styles.css' : NULL)
          //->loadConditionalCSS('styles/styles_ie.css', 'IE')
          //->loadConditionalCSS('styles/styles_ie8.css', 'IE=8')
          //->loadConditionalCSS('styles/styles_ie7.css', 'IE=7')
          //->loadConditionalCSS('styles/styles_ie6.css', 'IE=6')
          //->loadJavaScript('script/jquery/jquery-1.6.2.min.js')
          //->loadJavaScript('script/jquery/jquery-ui-1.8.16.custom.min.js')
          //->loadJavaScript('script/jquery/jquery.cycle.all.min.js')
          //->loadJavaScript('highslide/highslide-with-gallery.js')
          //->loadJavaScript('highslide/highslide.config.js')
          //->loadJavaScript('script/jquery/jquery.scrollTo-1.4.2-min.js')
          //->loadJavaScript('script/cufon/cufon.1.09i.js')
          //->loadJavaScript('script/cufon/museo.js')


            ;

            //var_dump($weburl, $page);

    //TODO this have not been in one file, must separe each block menu!

//TODO pred spustenim kontrolovat prava na spusteni!!!!!

          $url_level0 = 'act';
          $url_level1 = 'itm';
          $url_level2 = 'id';
          $url_level3 = 'msg';

          $menuitem = array(
                            'stats' => 'Statistiky her',
                            'logs' => 'Server logy',
                            'conf' => 'Configy',
                            'services' => 'Služby',
                            'screens' => 'Screen',
                            'screens_log' => 'Screen logy',
                            'iptables' => 'IP tabulka',
                            'info' => 'Info o systému',
                            'users' => 'Subdomény',
                            'svn' => 'Subversion',
                            'machine' => 'Správa serveru',
                            // 'testing' => 'Testování',
                            //'manual' => 'Manualové stránky',
                            //'email' => 'Email aliasy',
                            '' => 'GoodFlow server admin',
                            //'' => '',
                            );

          $sel_level0 = Core::isNull($_GET, $url_level0);
          $sel_level1 = Core::isNull($_GET, $url_level1);
          $sel_level2 = Core::isNull($_GET, $url_level2);
          $sel_level3 = Core::isNull($_GET, $url_level3);


          $predefinescreens = array(

/*
                                    'Minecraft' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/minecraft_goodflow_server/minecraft.sh', 'end' => array('send' => 'stop'), 'extra' => array('day' => 'time set 0', 'night' => 'time set 19000', 'toggle weather' => 'toggledownfall',
                                                                                                                                                                                              'geniv→fugess' => 'tp geniv fugess', 'fugess→geniv' => 'tp fugess geniv',
                                                                                                                                                                                              'fugess→faja' => 'tp fugess firegame30', 'faja→fugess' => 'tp firegame30 fugess',
                                                                                                                                                                                              'fugess→cap' => 'tp fugess capasak', 'cap→fugess' => 'tp capasak fugess',
                                                                                                                                                                                              'god on fugess' => 'gamemode fugess 1', 'god off fugess' => 'gamemode fugess 0',
                                                                                                                                                                                              'god on geniv' => 'gamemode geniv 1', 'god off geniv' => 'gamemode geniv 0',
                                                                                                                                                                                              ), 'log' => '/home/gmr/dedicated/minecraft_goodflow_server/server.log'),
*/

                                    'MinecraftSnapshot' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/mc-snapshot/minecraft.sh', 'end' => array('send' => 'stop'), 'extra' => array('day' => 'time set 0', 'night' => 'time set 19000', 'toggle weather' => 'toggledownfall',
                                                                                                                                                                                              'geniv→fugess' => 'tp geniv fugess', 'fugess→geniv' => 'tp fugess geniv',
                                                                                                                                                                                              'fugess→faja' => 'tp fugess firegame30', 'faja→fugess' => 'tp firegame30 fugess',
                                                                                                                                                                                              'fugess→cap' => 'tp fugess capasak', 'cap→fugess' => 'tp capasak fugess',
                                                                                                                                                                                              'god on fugess' => 'gamemode fugess 1', 'god off fugess' => 'gamemode fugess 0',
                                                                                                                                                                                              'god on geniv' => 'gamemode geniv 1', 'god off geniv' => 'gamemode geniv 0',
                                                                                                                                                                                              ), 'log' => '/home/gmr/dedicated/mc-snapshot/server.log', 'type' => 'minecraft', 'qport' => 25200),

                                    'Minecraft' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/mc/minecraft.sh', 'end' => array('send' => 'stop'), 'extra' => array('day' => 'time set 0', 'night' => 'time set 19000', 'toggle weather' => 'toggledownfall',
                                                                                                                                                                                              'geniv→fugess' => 'tp geniv fugess', 'fugess→geniv' => 'tp fugess geniv',
                                                                                                                                                                                              'fugess→faja' => 'tp fugess firegame30', 'faja→fugess' => 'tp firegame30 fugess',
                                                                                                                                                                                              'fugess→cap' => 'tp fugess capasak', 'cap→fugess' => 'tp capasak fugess',
                                                                                                                                                                                              'fugess→houk' => 'tp fugess houk', 'houk→fugess' => 'tp houk fugess',
                                                                                                                                                                                              'god on fugess' => 'gamemode fugess 1', 'god off fugess' => 'gamemode fugess 0',
                                                                                                                                                                                              'god on geniv' => 'gamemode geniv 1', 'god off geniv' => 'gamemode geniv 0',
                                                                                                                                                                                              ), 'log' => '/home/gmr/dedicated/mc/server.log', 'type' => 'minecraft', 'qport' => 25201),

                                    'MinecraftTreeit' => array('cd' => '/home/gmr/dedicated/mc-treeit', 'cmd' => './startserver.sh', 'end' => array('send' => 'stop'), 'extra' => array('day' => 'time set day', 'night' => 'time set night', 'weather' => 'weather clear',
                                                                                                                                                                                              'geniv→fugess' => 'tp geniv fugess', 'fugess→geniv' => 'tp fugess geniv',
                                                                                                                                                                                              'fugess→cap' => 'tp fugess capasak', 'cap→fugess' => 'tp capasak fugess',
                                                                                                                                                                                              'fugess→houk' => 'tp fugess houk', 'houk→fugess' => 'tp houk fugess',
                                                                                                                                                                                              ), 'log' => '/home/gmr/dedicated/mc-treeit/server.log', 'type' => 'minecraft', 'qport' => 25202),

                                    'MinecraftHexxit' => array('cd' => '/home/gmr/dedicated/mc-hexxit', 'cmd' => './launch.sh', 'end' => array('send' => 'stop'), 'extra' => array('day' => 'time set day', 'night' => 'time set night', 'weather' => 'weather clear',
                                                                                                                                                                                              'geniv→fugess' => 'tp geniv fugess', 'fugess→geniv' => 'tp fugess geniv',
                                                                                                                                                                                              'fugess→cap' => 'tp fugess capasak', 'cap→fugess' => 'tp capasak fugess',
                                                                                                                                                                                              'fugess→houk' => 'tp fugess houk', 'houk→fugess' => 'tp houk fugess',
                                                                                                                                                                                              ), 'log' => '/home/gmr/dedicated/mc-hexxit/server.log', 'type' => 'minecraft', 'qport' => 25203),

/*
                                    'MinecraftGMRTekkit' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/mc_gmr_tekkit/minecraft.sh', 'end' => array('send' => 'stop'), 'extra' => array('day' => 'time set 0', 'night' => 'time set 19000', 'toggle weather' => 'toggledownfall',
                                                                                                                                                                                              'geniv→fugess' => 'tp geniv fugess', 'fugess→geniv' => 'tp fugess geniv',
                                                                                                                                                                                              'fugess→faja' => 'tp fugess firegame30', 'faja→fugess' => 'tp firegame30 fugess',
                                                                                                                                                                                              'fugess→cap' => 'tp fugess capasak', 'cap→fugess' => 'tp capasak fugess',
                                                                                                                                                                                              'god on fugess' => 'gamemode fugess 1', 'god off fugess' => 'gamemode fugess 0',
                                                                                                                                                                                              'god on geniv' => 'gamemode geniv 1', 'god off geniv' => 'gamemode geniv 0',
                                                                                                                                                                                              ), 'log' => '/home/gmr/dedicated/mc_gmr_tekkit/server.log'),

                                    'MinecraftGMRNewServer' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/mc_gmr_new_server/minecraft.sh', 'end' => array('send' => 'stop'), 'extra' => array('day' => 'time set 0', 'night' => 'time set 19000', 'toggle weather' => 'toggledownfall',
                                                                                                                                                                                              'geniv→fugess' => 'tp geniv fugess', 'fugess→geniv' => 'tp fugess geniv',
                                                                                                                                                                                              'fugess→faja' => 'tp fugess firegame30', 'faja→fugess' => 'tp firegame30 fugess',
                                                                                                                                                                                              'fugess→cap' => 'tp fugess capasak', 'cap→fugess' => 'tp capasak fugess',
                                                                                                                                                                                              'god on fugess' => 'gamemode fugess 1', 'god off fugess' => 'gamemode fugess 0',
                                                                                                                                                                                              'god on geniv' => 'gamemode geniv 1', 'god off geniv' => 'gamemode geniv 0',
                                                                                                                                                                                              ), 'log' => '/home/gmr/dedicated/mc_gmr_new_server/server.log'),

                                    'MinecraftTekkitLite' => array('cd' => '/home/gmr/dedicated/mc_tekkit_lite', 'cmd' => './launch.sh', 'end' => array('send' => 'stop'), 'extra' => array('day' => 'time set 0', 'night' => 'time set 19000', 'toggle weather' => 'toggledownfall',
                                                                                                                                                                                          'geniv→fugess' => 'tp geniv fugess', 'fugess→geniv' => 'tp fugess geniv',
                                                                                                                                                                                          'fugess→faja' => 'tp fugess firegame30', 'faja→fugess' => 'tp firegame30 fugess',
                                                                                                                                                                                          'fugess→cap' => 'tp fugess capasak', 'cap→fugess' => 'tp capasak fugess',
                                                                                                                                                                                          'god on fugess' => 'gamemode fugess 1', 'god off fugess' => 'gamemode fugess 0',
                                                                                                                                                                                          'god on geniv' => 'gamemode geniv 1', 'god off geniv' => 'gamemode geniv 0',
                                                                                                                                                                                          ), 'log' => '/home/gmr/dedicated/mc_tekkit_lite/server.log'),

                                    'MinecraftVoltz' => array('cd' => '/home/gmr/dedicated/mc_voltz', 'cmd' => './minecraft.sh', 'end' => array('send' => 'stop'), 'extra' => array('day' => 'time set 0', 'night' => 'time set 19000', 'toggle weather' => 'toggledownfall',
                                                                                                                                                                                          'oMushrooMo→fugess' => 'tp oMushrooMo fugess', 'fugess→oMushrooMo' => 'tp fugess oMushrooMo',
                                                                                                                                                                                          'god on fugess' => 'gamemode fugess 1', 'god off fugess' => 'gamemode fugess 0',
                                                                                                                                                                                          ), 'log' => '/home/gmr/dedicated/mc_voltz/server.log'),

                                    'MinecraftTekkitLiteNovy' => array('cd' => '/home/gmr/dedicated/mc_tekkitlite_novy', 'cmd' => './minecraft.sh', 'end' => array('send' => 'stop'), 'extra' => array('day' => 'time set 0', 'night' => 'time set 19000', 'toggle weather' => 'toggledownfall',
                                                                                                                                                                                          'oMushrooMo→fugess' => 'tp oMushrooMo fugess', 'fugess→oMushrooMo' => 'tp fugess oMushrooMo',
                                                                                                                                                                                          'god on fugess' => 'gamemode fugess 1', 'god off fugess' => 'gamemode fugess 0',
                                                                                                                                                                                          ), 'log' => '/home/gmr/dedicated/mc_tekkitlite_novy/server.log', 'type' => 'minecraft', 'qport' => 25565),

                                    'MinecraftTestujuServer' => array('cd' => '/home/gmr/dedicated/mc_test', 'cmd' => './launch.sh', 'end' => array('send' => 'stop'), 'extra' => array('day' => 'time set 0', 'night' => 'time set 19000', 'toggle weather' => 'toggledownfall',
                                                                                                                                                                                          'op fugess' => 'op fugess', 'de-op fugess' => 'deop fugess',
                                                                                                                                                                                          'god on fugess' => 'gamemode 1 fugess', 'god off fugess' => 'gamemode 0 fugess',
                                                                                                                                                                                          ), 'log' => '/home/gmr/dedicated/mc_test/server.log', 'type' => 'minecraft', 'qport' => 25565),

                                    'MinecraftPixelmon' => array('cd' => '/home/gmr/dedicated/mc_pixelmon_pack', 'cmd' => './launch.sh', 'end' => array('send' => 'stop'), 'extra' => array('day' => 'time set 0', 'night' => 'time set 19000', 'toggle weather' => 'toggledownfall',
                                                                                                                                                                                          'op fugess' => 'op fugess', 'de-op fugess' => 'deop fugess',
                                                                                                                                                                                          'god on fugess' => 'gamemode 1 fugess', 'god off fugess' => 'gamemode 0 fugess',
                                                                                                                                                                                          ), 'log' => '/home/gmr/dedicated/mc_pixelmon_pack/server.log', 'type' => 'minecraft', 'qport' => 25565),

                                    'MinecraftTekkitLiteKippix' => array('cd' => '/home/gmr/dedicated/mc_tekkitlite_kippix', 'cmd' => './minecraft.sh', 'end' => array('send' => 'stop'), 'extra' => array('day' => 'time set 0', 'night' => 'time set 19000', 'toggle weather' => 'toggledownfall',
                                                                                                                                                                                          'god on fugess' => 'gamemode fugess 1', 'god off fugess' => 'gamemode fugess 0',
                                                                                                                                                                                          ), 'log' => '/home/gmr/dedicated/mc_tekkitlite_kippix/server.log', 'type' => 'minecraft', 'qport' => 25000),

                                    'MCTekkit' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/mc_tekkit/launch.sh', 'end' => array('send' => 'stop'), 'extra' => array('day' => 'time set 0', 'night' => 'time set 19000', 'toggle weather' => 'toggledownfall',
                                                                                                                                                                                              'geniv→fugess' => 'tp geniv fugess', 'fugess→geniv' => 'tp fugess geniv',
                                                                                                                                                                                              'fugess→faja' => 'tp fugess firegame30', 'faja→fugess' => 'tp firegame30 fugess',
                                                                                                                                                                                              'fugess→cap' => 'tp fugess capasak', 'cap→fugess' => 'tp capasak fugess',
                                                                                                                                                                                              'god on fugess' => 'gamemode fugess 1', 'god off fugess' => 'gamemode fugess 0',
                                                                                                                                                                                              'god on geniv' => 'gamemode geniv 1', 'god off geniv' => 'gamemode geniv 0',
                                                                                                                                                                                              ), 'log' => '/home/gmr/dedicated/mc_tekkit/server.log'),
*/

/*
                                    'KillingFloor1Classsic' => array('cd' => '/home/gmr/dedicated/kf/System', 'cmd' => './ucc-bin server KF-WestLondon.rom?Mutator=MutKFAntiBlocker.MutKFAntiBlocker,KFPatHPLeft.MutPatHPLeft,KFARGChat.KFARGChat,KFCtryTags.CtryTags ini=KillingFloor1Classsic.ini log=KillingFloor1Classsic.log', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloor1Classsic.log', 'type' => 'killingfloor', 'qport' => 7708),

                                    'KillingFloor2Classsic' => array('cd' => '/home/gmr/dedicated/kf/System', 'cmd' => './ucc-bin server KF-WestLondon.rom?Mutator=MutKFAntiBlocker.MutKFAntiBlocker,KFPatHPLeft.MutPatHPLeft,KFARGChat.KFARGChat,KFCtryTags.CtryTags ini=KillingFloor2Classsic.ini log=KillingFloor2Classsic.log', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloor2Classsic.log', 'type' => 'killingfloor', 'qport' => 7710),

                                    'KillingFloor3Story' => array('cd' => '/home/gmr/dedicated/kf/System', 'cmd' => './ucc-bin server KF-RE1-Mansion-Story.rom?Mutator=MutKFAntiBlocker.MutKFAntiBlocker,KFPatHPLeft.MutPatHPLeft,KFARGChat.KFARGChat,KFCtryTags.CtryTags ini=KillingFloor3Story.ini log=KillingFloor3Story.log', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloor3Story.log', 'type' => 'killingfloor', 'qport' => 7712),

                                    'KillingFloor4SP' => array('cd' => '/home/gmr/dedicated/kf/System', 'cmd' => './ucc-bin server KF-WestLondon.rom?Mutator=MutKFAntiBlocker.MutKFAntiBlocker,KFPatHPLeft.MutPatHPLeft,KFARGChat.KFARGChat,KFCtryTags.CtryTags,ServerPerksMut.ServerPerksMut ini=KillingFloor4SP.ini log=KillingFloor4SP.log', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloor4SP.log', 'type' => 'killingfloor', 'qport' => 7714),

                                    'KillingFloor5SPDOOM' => array('cd' => '/home/gmr/dedicated/kf/System', 'cmd' => './ucc-bin server KF-WestLondon.rom?Mutator=MutKFAntiBlocker.MutKFAntiBlocker,KFPatHPLeft.MutPatHPLeft,KFARGChat.KFARGChat,KFCtryTags.CtryTags,ServerPerksMut.ServerPerksMut,ScrnDoom3KF.Doom3Mutator ini=KillingFloor5SPDOOM.ini log=KillingFloor5SPDOOM.log', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloor5SPDOOM.log', 'type' => 'killingfloor', 'qport' => 7716),

                                    'KillingFloor6SPALIEN' => array('cd' => '/home/gmr/dedicated/kf/System', 'cmd' => './ucc-bin server KF-BioticsLab.rom?game=AliensKFGameType.AliensKFGameType?Mutator=MutKFAntiBlocker.MutKFAntiBlocker,KFARGChat.KFARGChat,KFCtryTags.CtryTags,AliensKFExtra.AKFDetailMut,AliensKFServerPerksMut.AliensKFServerPerksMut,AliensKFXenos.MutAliensPath ini=KillingFloor6SPALIEN.ini log=KillingFloor6SPALIEN.log', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloor6SPALIEN.log', 'type' => 'killingfloor', 'qport' => 7728),

                                    'KillingFloor6SPALIEN' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/kf/KillingFloor6SPALIEN.sh', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloor6SPALIEN.log', 'type' => 'killingfloor', 'qport' => 7728),

                                    'KillingFloor7SPDEADSPACE' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/kf/KillingFloor7SPDEADSPACE.sh', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloor7SPDEADSPACE.log', 'type' => 'killingfloor', 'qport' => 7730),



*/




                                    // 'KillingFloorRemoteDatabase' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/kf/RemoteDatabase/run.sh', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/dedicated/kf/RemoteDatabase/Host.log',),

                                    // 'KillingFloor1Classsic' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/kf/KillingFloor1Classsic.sh', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloor1Classsic.log', 'type' => 'killingfloor', 'qport' => 7708),

                                    // 'KillingFloor2Classsic' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/kf/KillingFloor2Classsic.sh', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloor2Classsic.log', 'type' => 'killingfloor', 'qport' => 7710),

                                    'KillingFloor3Story' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/kf/KillingFloor3Story.sh', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloor3Story.log', 'type' => 'killingfloor', 'qport' => 7712),

                                    // 'KillingFloor4Custom' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/kf/KillingFloor4Custom.sh', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloor4Custom.log', 'type' => 'killingfloor', 'qport' => 7714),

                                    // 'KillingFloor5DoomCustom' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/kf/KillingFloor5DoomCustom.sh', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloor5DoomCustom.log', 'type' => 'killingfloor', 'qport' => 7716),

                                    'KillingFloor6Objective' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/kf/KillingFloor6Objective.sh', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloor6Objective.log', 'type' => 'killingfloor', 'qport' => 7728),

                                    'KillingFloor7Private' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/kf/KillingFloor7Private.sh', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloor7Private.log', 'type' => 'killingfloor', 'qport' => 7730),

                                    'KillingFloor8PrivateObjective' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/kf/KillingFloor8PrivateObjective.sh', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloor8PrivateObjective.log', 'type' => 'killingfloor', 'qport' => 7732),

                                    'KillingFloorPavlisekClasssic_do_19_4_2014' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/kf/KillingFloorPavlisekClasssic.sh', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloorPavlisekClasssic.log', 'type' => 'killingfloor', 'qport' => 7708),

                                    'KillingFloorBoobieClasssic_do_16_3_2014' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/kf/KillingFloorBoobieClasssic.sh', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloorBoobieClasssic.log', 'type' => 'killingfloor', 'qport' => 7710),

/*
                                    'KillingFloor8SPSPECIAL' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/kf/KillingFloor8SPSPECIAL.sh', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloor8SPSPECIAL.log', 'type' => 'killingfloor', 'qport' => 7732),




                                    'KillingFloor9SPPrivate' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/kf/KillingFloor9SPPrivate.sh', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloor9SPPrivate.log', 'type' => 'killingfloor', 'qport' => 7734),



                                    'KillingFloor10Whitelist' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/kf/KillingFloor10Whitelist.sh', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloor10Whitelist.log', 'type' => 'killingfloor', 'qport' => 7736),
*/










                                    'chivalry' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/chivalry/start.sh', 'end' => 'kill', 'extra' => '', 'log' => '', 'type' => 'ut3', 'qport' => 33500),

//,ScrnDoom3KF.Doom3Mutator

/*

                                    'KillingFloorOnlyNormal' => array('cd' => '/home/gmr/dedicated/kf/System', 'cmd' => './ucc-bin server KF-WestLondon.rom?Mutator=MutKFAntiBlocker.MutKFAntiBlocker,KFPatHPLeft.MutPatHPLeft,KFARGChat.KFARGChat,KFCtryTags.CtryTags ini=KillingFloorOnlyNormal.ini log=KillingFloorOnlyNormal.log', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloorOnlyNormal.log', 'type' => 'killingfloor', 'qport' => 7714),

                                    'KillingFloorOnlyHard' => array('cd' => '/home/gmr/dedicated/kf/System', 'cmd' => './ucc-bin server KF-WestLondon.rom?Mutator=MutKFAntiBlocker.MutKFAntiBlocker,KFPatHPLeft.MutPatHPLeft,KFARGChat.KFARGChat,KFCtryTags.CtryTags ini=KillingFloorOnlyHard.ini log=KillingFloorOnlyHard.log', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloorOnlyHard.log', 'type' => 'killingfloor', 'qport' => 7716),

                                    'KillingFloorOnlySuicidal' => array('cd' => '/home/gmr/dedicated/kf/System', 'cmd' => './ucc-bin server KF-WestLondon.rom?Mutator=MutKFAntiBlocker.MutKFAntiBlocker,KFPatHPLeft.MutPatHPLeft,KFARGChat.KFARGChat,KFCtryTags.CtryTags ini=KillingFloorOnlySuicidal.ini log=KillingFloorOnlySuicidal.log', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloorOnlySuicidal.log', 'type' => 'killingfloor', 'qport' => 7728),

                                    'KillingFloorOnlyHELLMinLevel5' => array('cd' => '/home/gmr/dedicated/kf/System', 'cmd' => './ucc-bin server KF-WestLondon.rom?Mutator=MutKFAntiBlocker.MutKFAntiBlocker,KFPatHPLeft.MutPatHPLeft,KFARGChat.KFARGChat,KFCtryTags.CtryTags,NoobFilter.NoobFilter ini=KillingFloorOnlyHELLMinLevel5.ini log=KillingFloorOnlyHELLMinLevel5.log', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloorOnlyHELLMinLevel5.log', 'type' => 'killingfloor', 'qport' => 7730),

                                    'KillingFloorOnlyHELL1OnlyLevel6' => array('cd' => '/home/gmr/dedicated/kf/System', 'cmd' => './ucc-bin server KF-WestLondon.rom?Mutator=MutKFAntiBlocker.MutKFAntiBlocker,KFPatHPLeft.MutPatHPLeft,KFARGChat.KFARGChat,KFCtryTags.CtryTags,NoobFilter.NoobFilter ini=KillingFloorOnlyHELL1OnlyLevel6.ini log=KillingFloorOnlyHELL1OnlyLevel6.log', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloorOnlyHELL1OnlyLevel6.log', 'type' => 'killingfloor', 'qport' => 7732),

                                    'KillingFloorOnlyHELL2OnlyLevel6' => array('cd' => '/home/gmr/dedicated/kf/System', 'cmd' => './ucc-bin server KF-WestLondon.rom?Mutator=MutKFAntiBlocker.MutKFAntiBlocker,KFPatHPLeft.MutPatHPLeft,KFARGChat.KFARGChat,KFCtryTags.CtryTags,NoobFilter.NoobFilter ini=KillingFloorOnlyHELL2OnlyLevel6.ini log=KillingFloorOnlyHELL2OnlyLevel6.log', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloorOnlyHELL2OnlyLevel6.log', 'type' => 'killingfloor', 'qport' => 7734),

                                    'KillingFloorPrivate' => array('cd' => '/home/gmr/dedicated/kf/System', 'cmd' => './ucc-bin server KF-WestLondon.rom?Mutator=MutKFAntiBlocker.MutKFAntiBlocker,KFPatHPLeft.MutPatHPLeft,KFARGChat.KFARGChat,KFCtryTags.CtryTags ini=KillingFloorPrivate.ini log=KillingFloorPrivate.log', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloorPrivate.log', 'type' => 'killingfloor', 'qport' => 7736),
*/


                                    //vzot
                                    //'KillingFloorPrivate' => array('cd' => '/home/gmr/dedicated/kf/System', 'cmd' => './ucc-bin server KF-WestLondon.rom?Mutator=MutKFAntiBlocker.MutKFAntiBlocker,KFPatHPLeft.MutPatHPLeft,InformativeScoreboard.ScoreboardMut,KFARGChat.KFARGChat,KFCtryTags.CtryTags ini=KillingFloorPrivate.ini log=KillingFloorPrivate.log', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/.killingfloor/System/KillingFloorPrivate.log', 'type' => 'killingfloor', 'qport' => 7736),



                                    //'Kaillera' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/kaillera-server/kaillerasrv', 'end' => 'kill', 'extra' => '', 'log' => ''),

                                    'Emulinker' => array('cd' => '/home/gmr/dedicated/kaillera-server/emulinker', 'cmd' => './server.sh', 'end' => 'kill', 'extra' => '', 'log' => '/home/gmr/dedicated/kaillera-server/emulinker/emulinker.log'),

                                    'OpenTTD' => array('cd' => '', 'cmd' => '/usr/games/openttd -D -x', 'end' => array('send' => 'quit'), 'extra' => array('say' => array('prompt'), 'stat' => 'status', 'server info' => 'serverinfo', 'pause on' => 'pause', 'pause off' => 'unpause'), 'log' => ''),


                                    //                                                                      ~/dedicated/cs_go/srcds_run -game csgo -usercon +game_type 0 +game_mode 0 +mapgroup mg_bomb_se +map de_dust2_se +maxplayers 8 +servercfgfile server_cc.cfg +hostport 27123 +tv_port 27130
                                    'CSGOClassicCasual1' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/cs_go/srcds_run -game csgo -usercon +game_type 0 +game_mode 0 +mapgroup mg_bomb +map de_dust2 +ip 0.0.0.0 +servercfgfile server_cc1.cfg +hostport 9500 +tv_port 9501', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'csgo', 'qport' => 9500),

                                    // 'CSGOClassicCasual2' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/cs_go/srcds_run -game csgo -usercon +game_type 0 +game_mode 0 +mapgroup mg_bomb +map de_dust2 +ip 0.0.0.0 +servercfgfile server_cc2.cfg +hostport 9508 +tv_port 9509', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'csgo', 'qport' => 9508),

                                    'CSGOClassicCasual3' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/cs_go/srcds_run -game csgo -usercon +game_type 0 +game_mode 0 +mapgroup mg_bomb +map de_dust2 +ip 0.0.0.0 +servercfgfile server_cc3.cfg +hostport 9510 +tv_port 9511', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'csgo', 'qport' => 9510),

                                    'CSGOargymas_testovaci' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/cs_go/srcds_run -game csgo -usercon +game_type 0 +game_mode 0 +mapgroup mg_bomb +map de_dust2 +ip 0.0.0.0 +servercfgfile server_kubas.cfg +hostport 9508 +tv_port 9509 +sm_basepath addons/sourcemod_kubas', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'csgo', 'qport' => 9510),

                                    //                                                                           ~/dedicated/cs_go/srcds_run -game csgo -usercon +game_type 0 +game_mode 1 +mapgroup mg_bomb_se +maxplayers 8 +map de_dust2_se +servercfgfile server_cco.cfg +hostport 27124 +tv_port 27129
                                    'CSGOClassicCompetitive' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/cs_go/srcds_run -game csgo -usercon +game_type 0 +game_mode 1 +mapgroup mg_bomb +ip 0.0.0.0 +map de_dust2 +servercfgfile server_cco.cfg +hostport 9502 +tv_port 9503', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'csgo', 'qport' => 9502),

                                    //                                                    ~/dedicated/cs_go/srcds_run -game csgo -usercon +game_type 1 +game_mode 0 +mapgroup mg_armsrace +maxplayers 8 +map ar_shoots +servercfgfile server_ar.cfg +hostport 9504 +tv_port 9505 +net_public_adr 88.83.251.187
                                    'CSGOArmsRace' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/cs_go/srcds_run -game csgo -usercon +game_type 1 +game_mode 0 +mapgroup mg_armsrace +maxplayers 8 +map ar_shoots +servercfgfile server_ar.cfg +hostport 9504 +tv_port 9505 +ip 0.0.0.0', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'csgo', 'qport' => 9504),

                                    //                                                      ~/dedicated/cs_go/srcds_run -game csgo -usercon +game_type 1 +game_mode 1 +mapgroup mg_demolition +map de_lake +maxplayers 8 +servercfgfile server_dem.cfg +hostport 9506 +tv_port 9507 +net_public_adr 88.83.251.187
                                    'CSGODemolition' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/cs_go/srcds_run -game csgo -usercon +game_type 1 +game_mode 1 +mapgroup mg_demolition +map de_lake +maxplayers 8 +servercfgfile server_dem.cfg +hostport 9506 +tv_port 9507 +ip 0.0.0.0', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'csgo', 'qport' => 9506),



                                    //'CSSource' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/cs_source/css/srcds_run -game cstrike -autoupdate +maxplayers 16 +map de_dust2 -port 20100', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'css', 'qport' => 20100),

                                    'CSSource' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/css/srcds_run -steam_dir steamcmd/ -steamcmd_script steamcmd/steamcmd.sh -console -game cstrike +map de_dust2 -maxplayers 10 -port 20100', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'css', 'qport' => 20100),



                                    'Quake1' => array('cd' => '/home/gmr/dedicated/q1', 'cmd' => './sqpro -dedicated 4 -condebug -mem 32 -port 24500 -noipx +map dm2', 'end' => 'kill', 'extra' => array(), 'log' => ''),

                                    'Quake2' => array('cd' => '/home/gmr/dedicated/q2/quake2', 'cmd' => './quake2 +set dedicated 1 +exec server_dm_1.cfg +set deathmatch 1 +set port 24000', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'quake2', 'qport' => 24000),

                                    'Quake3Arena' => array('cd' => '/home/gmr/dedicated/q3', 'cmd' => './q3ded +exec server_dm.cfg +set net_port 23700', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'quake3', 'qport' => 23700),

                                    'Quake4DM' => array('cd' => '/home/gmr/dedicated/q4', 'cmd' => './quake4-dedicated +set net_port 31300 +exec dm.cfg +set net_ip 88.83.251.187', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'quake4', 'qport' => 31300),
                                    'Quake4TeamDM' => array('cd' => '/home/gmr/dedicated/q4', 'cmd' => './quake4-dedicated +set net_port 31301 +exec teamdm.cfg +set net_ip 88.83.251.187', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'quake4', 'qport' => 31301),
                                    'Quake4Tourney' => array('cd' => '/home/gmr/dedicated/q4', 'cmd' => './quake4-dedicated +set net_port 31302 +exec tourney.cfg +set net_ip 88.83.251.187', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'quake4', 'qport' => 31302),
                                    'Quake4CTF' => array('cd' => '/home/gmr/dedicated/q4', 'cmd' => './quake4-dedicated +set net_port 31303 +exec ctf.cfg +set net_ip 88.83.251.187', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'quake4', 'qport' => 31303),
                                    'Quake4ArenaCTF' => array('cd' => '/home/gmr/dedicated/q4', 'cmd' => './quake4-dedicated +set net_port 31304 +exec arena_ctf.cfg +set net_ip 88.83.251.187', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'quake4', 'qport' => 31304),


                                    'MedalOfHonorAlliedAssaultDM' => array('cd' => '/home/gmr/dedicated/mohaa', 'cmd' => './mohaa_lnxded +exec server.cfg +set net_port 24700 +set dedicated 1 +map dm/mohdm1', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'quake3', 'qport' => 24700),
                                    'MedalOfHonorAlliedAssaultTDM' => array('cd' => '/home/gmr/dedicated/mohaa', 'cmd' => './mohaa_lnxded +exec server_tdm.cfg +set net_port 24701 +set dedicated 1 +map dm/mohdm1', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'quake3', 'qport' => 24701),
                                    'MedalOfHonorAlliedAssaultOBJ' => array('cd' => '/home/gmr/dedicated/mohaa', 'cmd' => './mohaa_lnxded +exec server_obj.cfg +set net_port 24702 +set dedicated 1 +map dm/mohdm1', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'quake3', 'qport' => 24702),
                                    'MedalOfHonorAlliedAssaultRBD' => array('cd' => '/home/gmr/dedicated/mohaa', 'cmd' => './mohaa_lnxded +exec server_rbd.cfg +set net_port 24703 +set dedicated 1 +map dm/mohdm1', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'quake3', 'qport' => 24703),


                                    // puvodni
                                    'NoMoreRoomInHellPrivate' => array('cd' => '/home/gmr/dedicated/nmrih/srcds', 'cmd' => './srcds_nmrih +map nms_gun_store_b4 +ip 0.0.0.0 -port 32900 -insecure -tickrate 100 +exec privateserver.cfg', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'source', 'qport' => 32900),
                                    // 'NoMoreRoomInHell1' => array('cd' => '/home/gmr/dedicated/nmrih/srcds', 'cmd' => './srcds_nmrih +map nmo_cabin +ip 0.0.0.0 -port 32901 -insecure -maxplayers 4 +exec server1.cfg', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'source', 'qport' => 32901),
                                    'NoMoreRoomInHell1' => array('cd' => '/home/gmr/dedicated/nmrih/srcds', 'cmd' => './srcds_nmrih +map nmo_cabin +ip 0.0.0.0 -port 32901 -insecure +exec server1.cfg', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'source', 'qport' => 32901),
                                    'NoMoreRoomInHell2' => array('cd' => '/home/gmr/dedicated/nmrih/srcds', 'cmd' => './srcds_nmrih +map nmo_chinatown +ip 0.0.0.0 -port 32902 -insecure +exec server2.cfg', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'source', 'qport' => 32902),
                                    'NoMoreRoomInHell3' => array('cd' => '/home/gmr/dedicated/nmrih/srcds', 'cmd' => './srcds_nmrih +map nms_isolated +ip 0.0.0.0 -port 32903 -insecure +exec server3.cfg', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'source', 'qport' => 32903),
                                    'NoMoreRoomInHell4' => array('cd' => '/home/gmr/dedicated/nmrih/srcds', 'cmd' => './srcds_nmrih +map nmo_toxteth +ip 0.0.0.0 -port 32904 -insecure +exec server4.cfg', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'source', 'qport' => 32904),
                                    'NoMoreRoomInHell5' => array('cd' => '/home/gmr/dedicated/nmrih/srcds', 'cmd' => './srcds_nmrih +map nms_favela +ip 0.0.0.0 -port 32905 -insecure +exec server5.cfg', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'source', 'qport' => 32905),
                                    'NoMoreRoomInHell6' => array('cd' => '/home/gmr/dedicated/nmrih/srcds', 'cmd' => './srcds_nmrih +map nms_flooded +ip 0.0.0.0 -port 32906 -insecure +exec server6.cfg', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'source', 'qport' => 32906),
                                    'NoMoreRoomInHell7' => array('cd' => '/home/gmr/dedicated/nmrih/srcds', 'cmd' => './srcds_nmrih +map nms_silence +ip 0.0.0.0 -port 32907 -insecure +exec server7.cfg', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'source', 'qport' => 32907),

                                    //'NoMoreRoomInHell_J1n_do_11_12_2013' => array('cd' => '/home/gmr/dedicated/nmrih/srcds', 'cmd' => './srcds_nmrih +map nmo_cabin +ip 0.0.0.0 -port 32910 -insecure +exec server_j1n.cfg +sm_basepath addons/sourcemod_j1n', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'source', 'qport' => 32910),
                                    //'NoMoreRoomInHell_FckingFidjik' => array('cd' => '/home/gmr/dedicated/nmrih/srcds', 'cmd' => './srcds_nmrih +map nmo_cabin +ip 0.0.0.0 -port 32920 -insecure +exec server_fckingfidjik.cfg +sm_basepath addons/sourcemod_fckingfidjik', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'source', 'qport' => 32920),
                                    // 'NoMoreRoomInHell_Axelicek_do_28_2_2014' => array('cd' => '/home/gmr/dedicated/nmrih/srcds', 'cmd' => './srcds_nmrih +map nmo_cabin +ip 0.0.0.0 -port 32910 -insecure +exec axelicek_server.cfg +sm_basepath addons/sourcemod_axelicek', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'source', 'qport' => 32910),
                                    'NoMoreRoomInHell_marionorko_do_21_4_2014' => array('cd' => '/home/gmr/dedicated/nmrih/srcds', 'cmd' => './srcds_nmrih +map nmo_cabin +ip 0.0.0.0 -port 32910 -insecure +exec server_marionorko.cfg +sm_basepath addons/sourcemod_marionorko', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'source', 'qport' => 32910),


                                    //                                                                          ./srcds_run -game left4dead -maxplayers 8 -autoupdate +map l4d_vs_farm01_hilltop -port 24100 +sv_lan 0 +servercfgfile server_1.cfg +ip 0.0.0.0
                                    'Left4DeadVersus' => array('cd' => '/home/gmr/dedicated/l4d/l4d', 'cmd' => './srcds_run -game left4dead -maxplayers 8 -autoupdate +map l4d_vs_farm01_hilltop -port 24100 +sv_lan 0 +exec server_1.cfg +ip 0.0.0.0', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'l4d', 'qport' => 24100),

                                    //'Left4Dead_Sazina_SAD' => array('cd' => '/home/gmr/dedicated/l4d/l4d', 'cmd' => './srcds_run -game left4dead -maxplayers 8 -autoupdate +map l4d_hospital01_apartment -port 24200 +sv_lan 0 +exec server_sazina.cfg +ip 0.0.0.0 +sm_basepath addons/sourcemod_sazina', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'l4d', 'qport' => 24200),


                                    //'Left4DeadCoopNESPOUSTET' => array('cd' => '', 'cmd' => 'SEM MA PRIJIT CESTA', 'end' => 'kill', 'extra' => array(), 'log' => ''),


                                    //'l4d2' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/l4d2/left4dead2/srcds_run -game left4dead2 -autoupdate -maxplayers 14', 'end' => array('send' => 'quit'), 'extra' => array()),
                                    'Left4Dead2_1' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/l4d2_new/srcds_run -console -game left4dead2 -maxplayers 8 +sv_lan 0 +map c1m1_hotel -port 27000 +ip 0.0.0.0', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'l4d2', 'qport' => 27000),

                                    //                                                    ~/dedicated/l4d2/left4dead2/srcds_run -console -game left4dead2 -maxplayers 8 +sv_lan 0 +map c1m1_hotel -port 27501 +servercfgfile server_2.cfg
                                    'Left4Dead2_2' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/l4d2_new/srcds_run -console -game left4dead2 -maxplayers 8 +sv_lan 0 +map c1m1_hotel -port 27001 +servercfgfile server_2.cfg +ip 0.0.0.0', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'l4d2', 'qport' => 27001),

                                    //                                                    ~/dedicated/l4d2/left4dead2/srcds_run -console -game left4dead2 -maxplayers 8 +sv_lan 0 +map c1m1_hotel -port 27502 +servercfgfile server_3.cfg
                                    'Left4Dead2_3' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/l4d2_new/srcds_run -console -game left4dead2 -maxplayers 8 +sv_lan 0 +map c1m1_hotel -port 27002 +servercfgfile server_3.cfg +ip 0.0.0.0', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'l4d2', 'qport' => 27002),

                                    'Left4dead2_4_vs' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/l4d2_new/srcds_run -console -game left4dead2 -maxplayers 8 +sv_lan 0 +map c1m1_hotel -port 27003 +servercfgfile server_4_vs.cfg +ip 0.0.0.0', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'l4d2', 'qport' => 27003),

                                    'Left4dead2_5_coop' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/l4d2_new/srcds_run -console -game left4dead2 -maxplayers 8 +sv_lan 0 +map c1m1_hotel -port 27004 +servercfgfile server_5_coop.cfg +ip 0.0.0.0', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'l4d2', 'qport' => 27004),

                                    'Left4dead2_6_surv' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/l4d2_new/srcds_run -console -game left4dead2 -maxplayers 8 +sv_lan 0 +map c1m1_hotel -port 27005 +servercfgfile server_6_surv.cfg +ip 0.0.0.0', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'l4d2', 'qport' => 27005),

                                    'Left4dead2_7_sca' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/l4d2_new/srcds_run -console -game left4dead2 -maxplayers 8 +sv_lan 0 +map c1m1_hotel -port 27006 +servercfgfile server_7_sca.cfg +ip 0.0.0.0', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'l4d2', 'qport' => 27006),

                                    //                                                          ~/dedicated/l4d2/left4dead2/srcds_run -console -game left4dead2 -maxplayers 8 +sv_lan 0 +map c1m1_hotel -port 27507 +servercfgfile server_pronajem_argymas.cfg
                                    'Left4dead2_argymas_do_1_7_2014' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/l4d2_new/srcds_run -console -game left4dead2 -maxplayers 8 +sv_lan 0 +map c1m1_hotel -port 27507 +tv_port 27607 +servercfgfile server_pronajem_argymas.cfg +ip 0.0.0.0 +sm_basepath addons/sourcemod_argym', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'l4d2', 'qport' => 27507),

                                    'Left4dead2_ReApeR' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/l4d2_new/srcds_run -console -game left4dead2 -maxplayers 8 +sv_lan 0 +map c1m1_hotel -port 27508 +tv_port 27608 +servercfgfile server_pronajem_ReApeR.cfg +ip 0.0.0.0 +sm_basepath addons/sourcemod_ReApeR', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'l4d2', 'qport' => 27508),

                                    'Left4dead2_borgarus_do_19_3_2014' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/l4d2_new/srcds_run -console -game left4dead2 -maxplayers 8 +sv_lan 0 +map c1m1_hotel -port 27509 +tv_port 27609 +servercfgfile server_pronajem_borgarus.cfg +ip 0.0.0.0 +sm_basepath addons/sourcemod_borgarus', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'l4d2', 'qport' => 27509),









                                    'Left4Dead2private' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/l4d2_new/srcds_run -console -game left4dead2 -maxplayers 8 +sv_lan 0 +map c1m1_hotel -port 27500 +ip 0.0.0.0 +tv_port 27501 +servercfgfile server_privat.cfg +sm_basepath addons/sourcemod_zkouska', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'l4d2', 'qport' => 27500),


                                    'OpenArenaDM' => array('cd' => '', 'cmd' => '/usr/games/openarena-server +set dedicated 2 +exec server_dm.cfg +set net_port 31800 +map aggressor', 'end' => array('send' => 'quit'), 'extra' => array(), 'log' => '', 'type' => 'quake3', 'qport' => 31800),
                                    'OpenArenaTDM' => array('cd' => '', 'cmd' => '/usr/games/openarena-server +set dedicated 2  +exec server_tdm.cfg +set net_port 31801 +map aggressor', 'end' => array('send' => 'quit'), 'extra' => array(), 'log' => '', 'type' => 'quake3', 'qport' => 31801),
                                    'OpenArenaTR' => array('cd' => '', 'cmd' => '/usr/games/openarena-server +set dedicated 2  +exec server_tr.cfg +set net_port 31802 +map aggressor', 'end' => array('send' => 'quit'), 'extra' => array(), 'log' => '', 'type' => 'quake3', 'qport' => 31802),
                                    'OpenArenaCTF' => array('cd' => '', 'cmd' => '/usr/games/openarena-server +set dedicated 2  +exec server_ctf.cfg +set net_port 31803 +map aggressor', 'end' => array('send' => 'quit'), 'extra' => array(), 'log' => '', 'type' => 'quake3', 'qport' => 31803),


                                    'WarsowCA' => array('cd' => '/home/gmr/dedicated/warsow', 'cmd' => './wsw_server.x86_64 +exec server.cfg', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'warsow', 'qport' => 32700),
                                    'WarsowDM' => array('cd' => '/home/gmr/dedicated/warsow', 'cmd' => './wsw_server.x86_64 +exec server2.cfg', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'warsow', 'qport' => 32701),
                                    'WarsowCTF' => array('cd' => '/home/gmr/dedicated/warsow', 'cmd' => './wsw_server.x86_64 +exec server3.cfg', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'warsow', 'qport' => 32702),


                                    'Xonotic' => array('cd' => '/home/gmr/dedicated/xonotic/bin/Xonotic', 'cmd' => './server_linux.sh', 'end' => array('send' => 'quit'), 'extra' => array(), 'log' => '', 'type' => 'quake3', 'qport' => 33000),


                                    'Tremulous' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/tremulous/tremded.x86 +set dedicated 2 +exec server.cfg +set net_port 31900', 'end' => array('send' => 'quit'), 'extra' => array(), 'log' => '', 'type' => 'quake3', 'qport' => 31900),



                                    'SeriousSam3' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/ss3/Bin/runSam3_DedicatedServer.sh +prj_uwPort 22400 +prj_strMultiplayerSessionName "[CZ]gmrhosting.cz #1" +gam_ctMaxPlayers 8', 'end' => 'kill', 'extra' => array(), 'log' => ''),

                                    'SeriousSam3DM' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/ss3/bin/runsam3_dedicatedserver.sh +exec /home/gmr/dedicated/ss3/bin/serva-dm.cfg', 'end' => 'kill', 'extra' => array(), 'log' => ''),

/*
                                    'GarrysMod' => array('cd' => '/home/gmr/dedicated/garrysmod/gmodds', 'cmd' => './garrysmod_run.sh', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'gmod', 'qport' => 22000),

*/
                                    'Terraria' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/terraria/terraria.sh', 'end' => array('send' => 'stop'), 'extra' => array('day' => 'time day', 'night' => 'time night', 'restart server' => 'restart',
                                                                                                                                                                            'stat' => 'status', 'settle liquids' => 'settle'), 'log' => ''),

                 'Starbound' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/Starbound/linux64/launch_starbound_server.sh', 'end' => 'kill', 'extra' => array(), 'log' => '/home/gmr/dedicated/Starbound/linux64/starbound_server.log'),


				 'Starbound_bejvic_do_11_4_2014' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/Starbound-bejvic/linux64/launch_starbound_server.sh', 'end' => 'kill', 'extra' => array(), 'log' => '/home/gmr/dedicated/Starbound-bejvic/linux64/starbound_server.log'),



                                    'ZombiePanicSource' => array('cd' => '/home/gmr/dedicated/zombie_panic_source/orangebox', 'cmd' => './srcds_run -console -game zps -secure +map zps_cinema -autoupdate +log on +maxplayers 32 +exec server.cfg -port 20500', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'zps', 'qport' => 20500),

                                    'HalfLife2DM' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/HL2_mp/orangebox/srcds_run -console -game hl2mp +map dm_lockdown +maxplayers 8 -port 22100', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'hl2dm', 'qport' => 22100),

//TODO nejaky udelatko ktere bude kontrolovat jestli problemova hra nepadla a pokud jo tak restart dotycne hry
//$ cd /home/gmr/dedicated/hl &&  while [ 1 ]; do $(  screen ./hlds_run -game svencoop -sport +maxplayers 4 +map abandoned -port 23100 ) ; sleep 5 ; done
//FIXME toto nemuze obshluhovat bash!!!! ale maximalne bash v kombinaci s CRON-em!!!! (cron casove kontroluje a bash pres stranky zadava prikaz reastart!!) tohle bylo za portem -num_edicts 4095
//                                    'SvenCoop48' => array('cd' => '/home/gmr/dedicated/hl', 'cmd' => './hlds_run -game svencoop +maxplayers 8 +map sandstone -num_edicts 3072 -heapsize 131072 -port 23100', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'hldm', 'qport' => 23100),

                                    'SvenCoop48' => array('cd' => '/home/gmr/dedicated/hl', 'cmd' => './hlds_run -game svencoop -num_edicts 3072 -heapsize 131072 -port 23100 +maxplayers 5 +map stadium3', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'hldm', 'qport' => 23100),

                                    'CS2D' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/cs_2d/cs2d_dedicated', 'end' => 'kill', 'extra' => array(), 'log' => ''),

                                    'NaturalSelection' => array('cd' => '/home/gmr/dedicated/hl', 'cmd' => './hlds_run -game ns +exec server.cfg -sport +maxplayers 12 +map ns_eclipse -port 23200', 'end' => array('send' => 'quit'), 'extra' => array(), 'log' => '', 'type' => 'ns', 'qport' => 23200),

                                    'NaturalSelection2' => array('cd' => '/home/gmr/dedicated/ns2', 'cmd' => './server_linux32 -name \"[CZ] gmrhosting.cz #1\" -config_path \"/home/gmr/dedicated/ns2/config\"  -logdir \"/home/gmr/dedicated/ns2\" -mods \"706d242 5fd7a38\" -map ns2_biodome -port 33600 -limit 18', 'end' => array('send' => 'quit'), 'extra' => array(), 'log' => '', 'type' => 'ns2', 'qport' => 33600),







                                    'CS16' => array('cd' => '/home/gmr/dedicated/cs_16', 'cmd' => './hlds_run -game cstrike -sport +maxplayers 10 +map de_dust2 -port 20600', 'end' => array('send' => 'quit'), 'extra' => array(), 'log' => '', 'type' => 'cs16', 'qport' => 20600),

                                    'CSConditionZero' => array('cd' => '/home/gmr/dedicated/cs_zero', 'cmd' => './hlds_run -game czero -sport +maxplayers 10 +map de_inferno_cz', 'end' => array('send' => 'quit'), 'extra' => array(), 'log' => '', 'type' => 'cscz', 'qport' => 21000),

                                    'UnrealTournament' => array('cd' => '/home/gmr/dedicated/UT_GOTY/System', 'cmd' => './ucc-bin server CTF-Face?game=Botpack.CTFGame', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'ut', 'qport' => 28401),


                                    'Ut2k3' => array('cd' => '/home/gmr/dedicated/ut2k3/System', 'cmd' => './ucc-bin server DM-Antalus?game=XGame.xDeathMatch ini=UT2003.ini -nohomedir', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'ut', 'qport' => 28610),


                                    'Ut2k4Onslought' => array('cd' => '/home/gmr/dedicated/ut2k4/System', 'cmd' => './ucc-bin server ONS-Torlan?game=Onslaught.ONSOnslaughtGame ini=UT2004.ini log=UT2004.log', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'ut2004', 'qport' => 28910),
                                    'Ut2k4Assault' => array('cd' => '/home/gmr/dedicated/ut2k4/System', 'cmd' => './ucc-bin server AS-MotherShip?game=UT2k4Assault.ASGameInfo ini=UT2004_as.ini log=UT2004_as.log', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'ut2004', 'qport' => 28912),
                                    'Ut2k4CTF' => array('cd' => '/home/gmr/dedicated/ut2k4/System', 'cmd' => './ucc-bin server CTF-FaceClassic?game=XGame.xCTFGame ini=UT2004_ctf.ini log=UT2004_ctf.log', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'ut2004', 'qport' => 28914),
                                    'Ut2k4BombingRun' => array('cd' => '/home/gmr/dedicated/ut2k4/System', 'cmd' => './ucc-bin server BR-Serenity?game=XGame.xBombingRun ini=UT2004_br.ini log=UT2004_br.log', 'end' => 'kill', 'extra' => array(), 'log' => ''),
                                    'Ut2k4DoubleDomination' => array('cd' => '/home/gmr/dedicated/ut2k4/System', 'cmd' => './ucc-bin server DOM-SunTemple?game=xGame.xDoubleDom ini=UT2004_dd.ini log=UT2004_dd.log', 'end' => 'kill', 'extra' => array(), 'log' => ''),
                                    'Ut2k4DeahtMatch' => array('cd' => '/home/gmr/dedicated/ut2k4/System', 'cmd' => './ucc-bin server DM-Rankin?game=XGame.xDeathMatch ini=UT2004_dm.ini log=UT2004_dm.log', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'ut2004', 'qport' => 28916),
                                    'Ut2k4Invasion' => array('cd' => '/home/gmr/dedicated/ut2k4/System', 'cmd' => './ucc-bin server DM-Antalus?game=SkaarjPack.Invasion ini=UT2004_in.ini log=UT2004_in.log', 'end' => 'kill', 'extra' => array(), 'log' => ''),
                                    'Ut2k4LastManStanding' => array('cd' => '/home/gmr/dedicated/ut2k4/System', 'cmd' => './ucc-bin server DM-Morpheus3?game=BonusPack.xLastManStandingGame ini=UT2004_lms.ini log=UT2004_lms.log', 'end' => 'kill', 'extra' => array(), 'log' => ''),
                                    'Ut2k4Mutant' => array('cd' => '/home/gmr/dedicated/ut2k4/System', 'cmd' => './ucc-bin server DM-Deck17?game=BonusPack.xMutantGame ini=UT2004_mut.ini log=UT2004_mut.log', 'end' => 'kill', 'extra' => array(), 'log' => ''),
                                    'Ut2k4TeamDeathMatch' => array('cd' => '/home/gmr/dedicated/ut2k4/System', 'cmd' => './ucc-bin server DM-Rankin?game=XGame.xTeamGame ini=UT2004_tdm.ini log=UT2004_tdm.log', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'ut2004', 'qport' => 28918),


                                    'JustCause2MP' => array('cd' => '/home/gmr/dedicated/jcmp', 'cmd' => './Jcmp-Server', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'dods', 'qport' => 33650),


                                    'DayOfDefeatSource' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/dods/orangebox/srcds_run -game dod +map dod_anzio -maxplayers 20 -autoupdate +exec server.cfg -port 22700', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'dods', 'qport' => 22700),

                                    'DayOfDefeat' => array('cd' => '/home/gmr/dedicated/dod', 'cmd' => './hlds_run -game dod -sport +maxplayers 10 +map dod_anzio -port 22600', 'end' => array('send' => 'quit'), 'extra' => array(), 'log' => '', 'type' => 'dod', 'qport' => 22600),


                                    //                                                                ./zserv -iwad /home/gmr/dedicated/doom2/DOOMWAD -port 32300
                                    'Doom2_1' => array('cd' => '/home/gmr/dedicated/doom2', 'cmd' => './zserv -iwad /home/gmr/dedicated/doom2/DOOM2.WAD -port 32300', 'end' => 'kill', 'extra' => array(), 'log' => ''),


                                    //#1                                                            $ ./doom3-dedicated +set net_port 31500 +set si_maxplayers 8 +exec server.cfg
                                    'Doom3_1' => array('cd' => '/home/gmr/dedicated/doom3', 'cmd' => './doom3-dedicated +set net_port 31500 +set si_maxplayers 8 +exec server.cfg', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'doom3', 'qport' => 31500),
                                    //# 2                                                           $ ./doom3-dedicated +set net_port 31501 +set si_maxplayers 8 +exec server1.cfg
                                    'Doom3_2' => array('cd' => '/home/gmr/dedicated/doom3', 'cmd' => './doom3-dedicated +set net_port 31501 +set si_maxplayers 8 +exec server1.cfg', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'doom3', 'qport' => 31501),
                                    //# 3                                                           $ ./doom3-dedicated +set net_port 31502 +set si_maxplayers 8 +exec server2.cfg
                                    'Doom3_3' => array('cd' => '/home/gmr/dedicated/doom3', 'cmd' => './doom3-dedicated +set net_port 31502 +set si_maxplayers 8 +exec server2.cfg', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'doom3', 'qport' => 31502),
                                    //# 4                                                             $ ./doom3-dedicated +set net_port 31503 +set si_maxplayers 8 +exec server3.cfg
                                    'Doom3_TDM' => array('cd' => '/home/gmr/dedicated/doom3', 'cmd' => './doom3-dedicated +set net_port 31503 +set si_maxplayers 8 +exec server3.cfg', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'doom3', 'qport' => 31503),
                                    //# 5                                                                 $ ./doom3-dedicated +set net_port 31504 +set si_maxplayers 8 +exec server4.cfg
                                    'Doom3_Tourney' => array('cd' => '/home/gmr/dedicated/doom3', 'cmd' => './doom3-dedicated +set net_port 31504 +set si_maxplayers 8 +exec server4.cfg', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'doom3', 'qport' => 31504),
                                    //# 6                                                                 $ ./doom3-dedicated +set net_port 31505 +set si_maxplayers 8 +exec server5.cfg
                                    'Doom3_LastMan' => array('cd' => '/home/gmr/dedicated/doom3', 'cmd' => './doom3-dedicated +set net_port 31505 +set si_maxplayers 8 +exec server5.cfg', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'doom3', 'qport' => 31505),
                                    //# 7                                                                      $ ./doom3-dedicated +set net_port 31506 +set si_maxplayers 8 +exec server6.cfg
                                    'Doom3_Singleplayer' => array('cd' => '/home/gmr/dedicated/doom3', 'cmd' => './doom3-dedicated +set net_port 31506 +set si_maxplayers 8 +exec server6.cfg', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'doom3', 'qport' => 31506),



                                    //                                                                              $ ./linuxjampded +set dedicated 2 +exec server.cfg +set net_port 32000
                                    'StarWars_JediAcademy1' => array('cd' => '/home/gmr/dedicated/SWJK-JA', 'cmd' => './linuxjampded +set dedicated 2 +exec server.cfg +set net_port 32000', 'end' => array('send' => 'quit'), 'extra' => array(), 'log' => '', 'type' => 'quake3', 'qport' => 32000),
                                    //                                                                              $ ./linuxjampded +set dedicated 2 +exec server1.cfg +set net_port 32001
                                    'StarWars_JediAcademy2' => array('cd' => '/home/gmr/dedicated/SWJK-JA', 'cmd' => './linuxjampded +set dedicated 2 +exec server1.cfg +set net_port 32001', 'end' => array('send' => 'quit'), 'extra' => array(), 'log' => '', 'type' => 'quake3', 'qport' => 32001),
                                    //                                                                              $ ./linuxjampded +set dedicated 2 +exec server2.cfg +set net_port 32002
                                    'StarWars_JediAcademy3' => array('cd' => '/home/gmr/dedicated/SWJK-JA', 'cmd' => './linuxjampded +set dedicated 2 +exec server2.cfg +set net_port 32002', 'end' => array('send' => 'quit'), 'extra' => array(), 'log' => '', 'type' => 'quake3', 'qport' => 32002),
                                    //                                                                              $ ./linuxjampded +set dedicated 2 +exec server3.cfg +set net_port 32003
                                    'StarWars_JediAcademy4' => array('cd' => '/home/gmr/dedicated/SWJK-JA', 'cmd' => './linuxjampded +set dedicated 2 +exec server3.cfg +set net_port 32003', 'end' => array('send' => 'quit'), 'extra' => array(), 'log' => '', 'type' => 'quake3', 'qport' => 32003),
                                    //                                                                              $ ./linuxjampded +set dedicated 2 +exec server4.cfg +set net_port 32004
                                    'StarWars_JediAcademy5' => array('cd' => '/home/gmr/dedicated/SWJK-JA', 'cmd' => './linuxjampded +set dedicated 2 +exec server4.cfg +set net_port 32004', 'end' => array('send' => 'quit'), 'extra' => array(), 'log' => '', 'type' => 'quake3', 'qport' => 32004),
                                    //                                                                              $ ./linuxjampded +set dedicated 2 +exec server5.cfg +set net_port 32005
                                    'StarWars_JediAcademy6' => array('cd' => '/home/gmr/dedicated/SWJK-JA', 'cmd' => './linuxjampded +set dedicated 2 +exec server5.cfg +set net_port 32005', 'end' => array('send' => 'quit'), 'extra' => array(), 'log' => '', 'type' => 'quake3', 'qport' => 32005),




                                    'TeamFortressClassic' => array('cd' => '/home/gmr/dedicated/tfc', 'cmd' => './hlds_run -game tfc -sport +maxplayers 16 +map 2fort -port 20000 -autoupdate', 'end' => array('send' => 'quit'), 'extra' => array(), 'log' => '', 'type' => 'tfc', 'qport' => 20000),

                                    'TeamFortress2_1' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/tf2/srcds_run -game tf +maxplayers 24 +map cp_dustbowl +servercfgfile server.cfg +hostport 9000', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'tf2', 'qport' => 9000),

                                    'TeamFortress2_2' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/tf2/srcds_run -game tf +maxplayers 24 +map cp_dustbowl +servercfgfile server6.cfg +hostport 9006', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'tf2', 'qport' => 9006),

                                    'TeamFortress2_3' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/tf2/srcds_run -game tf +maxplayers 24 +map cp_dustbowl +servercfgfile server7.cfg +hostport 9007', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'tf2', 'qport' => 9007),

                                    'TeamFortress2_4' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/tf2/srcds_run -game tf +maxplayers 24 +map cp_dustbowl +servercfgfile server8.cfg +hostport 9008', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'tf2', 'qport' => 9008),

                                    'TeamFortress2_5' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/tf2/srcds_run -game tf +maxplayers 24 +map cp_dustbowl +servercfgfile server9.cfg +hostport 9009', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'tf2', 'qport' => 9009),

                                    //                                                        ~/dedicated/tf2/orangebox/srcds_run -game tf +maxplayers 32 +map mvm_mannworks +servercfgfile server_mvm.cfg -hostport 27236
                                    'TeamFortress2MvM1' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/tf2/srcds_run -game tf +maxplayers 32 +map mvm_mannworks +servercfgfile server_mvm.cfg +hostport 9001', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'tf2', 'qport' => 9001),

                                    'TeamFortress2MvM2' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/tf2/srcds_run -game tf +maxplayers 32 +map mvm_mannworks +servercfgfile server_mvm2.cfg +hostport 9002', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'tf2', 'qport' => 9002),

                                    'TeamFortress2MvM3' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/tf2/srcds_run -game tf +maxplayers 32 +map mvm_mannworks +servercfgfile server_mvm3.cfg +hostport 9003', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'tf2', 'qport' => 9003),

                                    'TeamFortress2MvM4' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/tf2/srcds_run -game tf +maxplayers 32 +map mvm_mannworks +servercfgfile server_mvm4.cfg +hostport 9004', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'tf2', 'qport' => 9004),

                                    'TeamFortress2MvM5' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/tf2/srcds_run -game tf +maxplayers 32 +map mvm_mannworks +servercfgfile server_mvm5.cfg +hostport 9005', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'tf2', 'qport' => 9005),

                                    'TeamFortress2Halloween' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/tf2/srcds_run -game tf +maxplayers 24 +map plr_hightower_event +servercfgfile server_halloween_event.cfg +hostport 9010 +mapcyclefile mapcycle_hightower_event_247.txt', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'tf2', 'qport' => 9010),

                                    'TeamFortress2HalloweenMix' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/tf2/srcds_run -game tf +maxplayers 24 +map plr_hightower_event +servercfgfile server_halloween_event_mix.cfg +hostport 9011 +mapcyclefile mapcycle_halloween.txt ', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'tf2', 'qport' => 9011),



                                    //~ 'TeamFortress2MvMPrivate' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/tf2/orangebox/srcds_run -game tf +maxplayers 32 +map mvm_mannworks +servercfgfile server_mvm_privat.cfg +hostport 9006', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'tf2', 'qport' => 9006),




                                    'PreyDM' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/prey/preyded +set net_serverDedicated 1 +set net_port 31600 +set sv_punkbuster 1 +exec server.cfg +seta si_map game/dmescher -ip 88.83.251.187', 'end' => array('send' => 'quit'), 'extra' => array(), 'log' => ''), //, 'type' => 'hldm', 'qport' => 23000
                                    'PreyTDM' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/prey/preyded +set net_serverDedicated 1 +set net_port 31601 +set sv_punkbuster 1 +exec server2.cfg +seta si_map game/dmescher -ip 88.83.251.187', 'end' => array('send' => 'quit'), 'extra' => array(), 'log' => ''), //, 'type' => 'hldm', 'qport' => 23000

                                    'NeverwinderNights' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/nwn/nwserver -port 31700', 'end' => array('send' => 'quit'), 'extra' => array(), 'log' => ''), //, 'type' => 'hldm', 'qport' => 23000



                                    'FEAR' => array('cd' => '/home/gmr/dedicated/fear', 'cmd' => './start.sh', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'fear', 'qport' => 22200),


                                    'GTASanAndreasMP' => array('cd' => '/home/gmr/dedicated/samp03', 'cmd' => './samp03svr', 'end' => 'kill', 'extra' => array(), 'log' => '/home/gmr/dedicated/samp03/server_log.txt', 'type' => 'samp', 'qport' => 23600),

                                    'GTAIVMP' => array('cd' => '/home/gmr/dedicated/gta_iv', 'cmd' => './ivmp-svr', 'end' => 'kill'),


                                    'HalfLifeDM' => array('cd' => '/home/gmr/dedicated/hl', 'cmd' => './hlds_run -game valve -sport +port 23000 +maxplayers 10 +map crossfire', 'end' => array('send' => 'quit'), 'extra' => array(), 'log' => '', 'type' => 'hldm', 'qport' => 23000),

                                    'HLDeathmatchClassic' => array('cd' => '/home/gmr/dedicated/hl_dmc', 'cmd' => './hlds_run -game dmc -sport +port 23500 +maxplayers 10 +map dmc_dm3', 'end' => array('send' => 'quit'), 'extra' => array(), 'log' => '', 'type' => 'hldm', 'qport' => 23500),

                                    'AvP2SOQ' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/AvP2/redhat-7.1_libs/startAvP2ded server_1.txt', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'avp2', 'qport' => 25100),

                                    'AvP2SAM' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/AvP2/redhat-7.1_libs/startAvP2ded server_2.txt', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'avp2', 'qport' => 25101),

                                    'AvP2DAM' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/AvP2/redhat-7.1_libs/startAvP2ded server_3.txt', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'avp2', 'qport' => 25102),

                                    'AvP2TAM' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/AvP2/redhat-7.1_libs/startAvP2ded server_4.txt', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'avp2', 'qport' => 25103),

                                    'AvP2OAM' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/AvP2/redhat-7.1_libs/startAvP2ded server_5.txt', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'avp2', 'qport' => 25104),

                                    'AvP2EAM' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/AvP2/redhat-7.1_libs/startAvP2ded server_6.txt', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'avp2', 'qport' => 25105),

                                    'AvP2HAM' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/AvP2/redhat-7.1_libs/startAvP2ded server_7.txt', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'avp2', 'qport' => 25106),


                                    'WolfensteinET' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/wolfenstein/enemy_territory/etded +set vm_game 0 +set sv_pure 1 +set dedicated 2 +net_ip 88.83.251.187 +net_port 21500 +set sv_punkbuster 0 +exec et_server.cfg', 'end' => 'kill', 'extra' => array(), 'log' => ''),
                                    'WolfensteinRTC' => array('cd' => '/home/gmr/dedicated/wolfenstein_rtc', 'cmd' => './wolfded +set dedicated 2 +net_ip 88.83.251.187 +net_port 27889 +set fs_basepath ./ +set com_hunkMegs 64 +set com_zoneMegs 24 +set vm_game 0 +set ttycon 0 +exec server.cfg', 'end' => 'kill', 'extra' => array(), 'log' => ''),

                                    'SoldatDM' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/soldat/soldatserver -c server_dm.ini', 'end' => 'kill', 'extra' => array(), 'log' => ''),
                                    'SoldatTDM' => array('cd' => '', 'cmd' => '/home/gmr/dedicated/soldat/soldatserver -c server_tdm.ini', 'end' => 'kill', 'extra' => array(), 'log' => ''),


                                    'Cod2MP' => array('cd' => '/home/gmr/dedicated/cod2', 'cmd' => './cod2_lnxded +set dedicated 2 +set sv_maxclients 32 +set sv_punkbuster 1 +exec config_mp.cfg +map_rotate +set net_port 30800', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'cod2', 'qport' => 30800),

                                    'Cod4DM' => array('cd' => '/home/gmr/dedicated/cod_mw', 'cmd' => './cod4_lnxded +set sv_pure 1 +set dedicated 2 +set sv_punkbuster 1 +exec server_dm.cfg +map_rotate +set net_port 31000 +set sv_hostname [CZ] GMR server by rami.cz #1 - DM', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'cod4', 'qport' => 31000),
                                    'Cod4TDM' => array('cd' => '/home/gmr/dedicated/cod_mw', 'cmd' => './cod4_lnxded +set sv_pure 1 +set dedicated 2 +set sv_punkbuster 1 +exec server_tdm.cfg +map_rotate +set net_port 31001 +set sv_hostname [CZ] GMR server by rami.cz #2 - TDM', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'cod4', 'qport' => 31001),
                                    'Cod4DOM' => array('cd' => '/home/gmr/dedicated/cod_mw', 'cmd' => './cod4_lnxded +set sv_pure 1 +set dedicated 2 +set sv_punkbuster 1 +exec server_dom.cfg +map_rotate +set net_port 31002 +set sv_hostname [CZ] GMR server by rami.cz #3 - DOM', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'cod4', 'qport' => 31002),
                                    'Cod4HQ' => array('cd' => '/home/gmr/dedicated/cod_mw', 'cmd' => './cod4_lnxded +set sv_pure 1 +set dedicated 2 +set sv_punkbuster 1 +exec server_hq.cfg +map_rotate +set net_port 31003 +set sv_hostname [CZ] GMR server by rami.cz #4 - HQ', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'cod4', 'qport' => 31003),
                                    'Cod4SAB' => array('cd' => '/home/gmr/dedicated/cod_mw', 'cmd' => './cod4_lnxded +set sv_pure 1 +set dedicated 2 +set sv_punkbuster 1 +exec server_sab.cfg +map_rotate +set net_port 31004 +set sv_hostname [CZ] GMR server by rami.cz #5 - SAB', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'cod4', 'qport' => 31004),  //31006
                                    'Cod4SD' => array('cd' => '/home/gmr/dedicated/cod_mw', 'cmd' => './cod4_lnxded +set sv_pure 1 +set dedicated 2 +set sv_punkbuster 1 +exec server_sd.cfg +map_rotate +set net_port 31005 +set sv_hostname [CZ] GMR server by rami.cz #6 - SD', 'end' => 'kill', 'extra' => array(), 'log' => '', 'type' => 'cod4', 'qport' => 31005),

//$ screen node /var/www/gfdesign.cz/html5/nodejs-chat/chat-server.js

                                    );

          $body = Html::elem('div')->id('obal_layout');

          //generation menu
          $menu = Html::elem('ul');
          foreach ($menuitem as $uri => $name) {
            if (!empty($uri)){
              $menu->insert(Html::li()->class($uri == $sel_level0 ? 'aktivni' : null)->insert(Html::a()->hrefpath('', array($url_level0 => $uri))->title($name)->setText($name)));
            }
          }

          //generation content
          $content = Html::elem('div')->id('obal_obsah');
          $nadpish1 = Html::elem('h1')->setText(Core::isFill($menuitem, $sel_level0).' - ');
          $content->insert($nadpish1);

          switch ($sel_level0) {

            default:
              $nadpish1->insert(Html::elem('span')->setText('Informace'));

              //TODO jeste /var/run/reboot-required ??? resp dalsi? z te slozky
              //~ if (file_exists('/var/run/motd')) {
                //~ $text = file_get_contents('/var/run/motd');
                //~ $content->insert(Html::elem('pre')->class('result')->setText($text));
              //~ }

              //TODO pripadne osetreni na neexistenci atd...
              //exec('/etc/update-motd.d/50-landscape-sysinfo && /etc/update-motd.d/90-updates-available && /etc/update-motd.d/91-release-upgrade && /etc/update-motd.d/98-reboot-required', $res); // && /etc/update-motd.d/98-fsck-at-reboot
              exec('/etc/update-motd.d/50-landscape-sysinfo && /usr/lib/update-notifier/update-motd-updates-available && /usr/lib/update-notifier/update-motd-reboot-required', $res);

              exec('cat /var/run/motd', $res1);

              exec('if [ -e /var/run/reboot-required ] ; then cat /var/run/reboot-required ; fi', $res2);

              $content->insert(Html::elem('pre')->class('result')
                        ->setText($res)
                        ->setText('<hr />')
                        ->setText($res1)
                        ->setText($res2)
                        );


              //projet skripty v: /etc/update-motd.d/


            break;

            case 'stats':
              //http://geniv-asus/www/svn/goodflow_server/extensions/GameQ/examples/list.php

              $nadpish1->insert(Html::elem('span')->setText('Přehled'));

              $query_callback = function($val, $key, $data) { //array_walk
                if (isset($val['type'])) {
                  $url = 'www.gfdesign.cz'; //'localhost';
                  $data['result'][] = array(
                                            'id' => $key,
                                            'type' => $val['type'],
                                            'host' => $url.':'.$val['qport']
                                            );
                }
              };

              array_walk($predefinescreens, $query_callback, array('result' => &$servers));

              $result_callback = function($val) { //array_map

                $user_callback = function($val) {
                  return (isset($val['name']) ? $val['name'] : $val['player']);
                };
//FIXME rozlisovat mezi hostport a qport!!!! tyty cisla nejsou vzdycky stejne a hry mazi nimi rozlisuji!!!!!!
                $game_index = array(
                                    'killingfloor' => 'gametype',
                                    'l4d' => 'game_descr',
                                    'l4d2' => 'game_descr',
                                    'tfc' => 'game_descr',
                                    'tf2' => 'game_descr',
                                    'doom3' => 'gamename',
                                    'avp2' => 'gamename',
                                    'fear' => 'gamever',
                                    'csgo' => 'game_descr',
                                    'css' => 'game_descr',
                                    'quake2' => 'mapname',
                                    'quake3' => 'gamename',
                                    'quake4' => 'gamename',
                                    'warsow' => 'gamename',
                                    'minecraft' => 'game_id',
                                    'zps' => 'game_descr',
                                    'hldm' => 'game_descr',
                                    'hl2dm' => 'game_descr',
                                    'ns' => 'game_descr',
                                    'cs16' => 'game_descr',
                                    'ut' => 'gamename',
                                    'ut2004' => 'gamename',
                                    'dod' => 'game_descr',
                                    'dods' => 'game_descr',
                                    'cod2' => 'gamename',
                                    'cod4' => 'gamename',
                                    'source' => 'game_descr',
                                    'gmod' => 'game_descr',
                                    'samp' => 'mapname',
                                    );

                $name_index = array(
                                    'killingfloor' => 'servername',
                                    'l4d' => 'hostname',
                                    'l4d2' => 'hostname',
                                    'tfc' => 'hostname',
                                    'tf2' => 'hostname',
                                    'doom3' => 'si_name',
                                    'avp2' => 'hostname',
                                    'fear' => 'gamever',
                                    'csgo' => 'hostname',
                                    'css' => 'hostname',
                                    'quake2' => 'hostname',
                                    'quake3' => 'sv_hostname',
                                    'quake4' => 'gamename', //TODO opravdu tento index?
                                    'warsow' => 'sv_hostname',
                                    'minecraft' => 'hostname',
                                    'zps' => 'hostname',
                                    'hldm' => 'hostname',
                                    'hl2dm' => 'hostname',
                                    'ns' => 'hostname',
                                    'cs16' => 'hostname',
                                    'ut' => 'hostname',
                                    'ut2004' => 'hostname',
                                    'dod' => 'hostname',
                                    'dods' => 'hostname',
                                    'cod2' => 'sv_hostname',
                                    'cod4' => 'sv_hostname',
                                    'source' => 'hostname',
                                    'gmod' => 'hostname',
                                    'samp' => 'servername',
                                    );

                $playercount_index = array(
                                          'killingfloor' => 'playercount',
                                          'l4d' => 'num_players',
                                          'l4d2' => 'num_players',
                                          'tfc' => 'num_players',
                                          'tf2' => 'num_players',
                                          'doom3' => 'num_players',
                                          'avp2' => 'numplayers',
                                          'fear' => 'numplayers',
                                          'csgo' => 'num_players',
                                          'css' => 'num_players',
                                          'quake2' => 'num_players',
                                          'quake3' => 'num_players',
                                          'quake4' => 'si_numPrivatePlayers',
                                          'warsow' => 'num_players',
                                          'minecraft' => 'numplayers',
                                          'zps' => 'num_players',
                                          'hldm' => 'num_players',
                                          'hl2dm' => 'num_players',
                                          'ns' => 'num_players',
                                          'cs16' => 'num_players',
                                          'ut' => 'numplayers',
                                          'ut2004' => 'numplayers',
                                          'dod' => 'num_players',
                                          'dods' => 'num_players',
                                          'cod2' => 'num_players',
                                          'cod4' => 'num_players',
                                          'source' => 'num_players',
                                          'gmod' => 'num_players',
                                          'samp' => 'num_players',
                                          );

                $maxplayers_index = array(
                                          'killingfloor' => 'maxplayers',
                                          'l4d' => 'max_players',
                                          'l4d2' => 'max_players',
                                          'tfc' => 'max_players',
                                          'tf2' => 'max_players',
                                          'doom3' => 'si_maxplayers',
                                          'avp2' => 'maxplayers',
                                          'fear' => 'maxplayers',
                                          'csgo' => 'max_players',
                                          'css' => 'max_players',
                                          'quake2' => 'maxclients',
                                          'quake3' => 'sv_maxclients',
                                          'quake4' => 'si_maxPlayers',
                                          'warsow' => 'sv_maxclients',
                                          'minecraft' => 'maxplayers',
                                          'zps' => 'max_players',
                                          'hldm' => 'max_players',
                                          'hl2dm' => 'max_players',
                                          'ns' => 'max_players',
                                          'cs16' => 'max_players',
                                          'ut' => 'maxplayers',
                                          'ut2004' => 'maxplayers',
                                          'dod' => 'max_players',
                                          'dods' => 'max_players',
                                          'cod2' => 'sv_maxclients',
                                          'cod4' => 'sv_maxclients',
                                          'source' => 'max_players',
                                          'gmod' => 'max_players',
                                          'samp' => 'max_players',
                                          );

                $version_index = array(
                                      'killingfloor' => 'ServerVersion',
                                      'l4d' => 'version',
                                      'l4d2' => 'version',
                                      'tfc' => 'version',
                                      'tf2' => 'version',
                                      'doom3' => 'version',
                                      'avp2' => 'gamever',
                                      'fear' => 'gamever',
                                      'csgo' => 'version',
                                      'css' => 'version',
                                      'quake2' => 'version',
                                      'quake3' => 'version',
                                      'quake4' => 'version',
                                      'warsow' => 'version',
                                      'minecraft' => 'version',
                                      'zps' => 'version',
                                      'hldm' => 'version',
                                      'hl2dm' => 'version',
                                      'ns' => 'version',
                                      'cs16' => 'version',
                                      'ut' => 'gamever',
                                      'ut2004' => 'gamever',
                                      'dod' => 'version',
                                      'dods' => 'version',
                                      'cod2' => 'shortversion',
                                      'cod4' => 'shortversion',
                                      'source' => 'version',
                                      'gmod' => 'version',
                                      'samp' => 'version',
                                      );

                $result = null;
                if ($val['gq_online']) {
//print_r($val);
                  $type = $val['gq_type'];
//~ var_dump($type, $val);
                  $result = array(
                                    'online' => true,
                                    'port' => $val['gq_port'],
                                    'game' => (isset($game_index[$type]) ? $val[$game_index[$type]] : ''),
                                    'version' => (isset($version_index[$type]) ? $val[$version_index[$type]] : ''),
                                    'name' => (isset($name_index[$type]) ? htmlentities($val[$name_index[$type]]) : ''),
                                    'count' => (isset($playercount_index[$type]) ? $val[$playercount_index[$type]] : null) . '/' . (isset($maxplayers_index[$type]) ? $val[$maxplayers_index[$type]] : null),
                                    'max' => (isset($val['players']) ? htmlentities(implode(', ', array_map($user_callback, $val['players']))) : null),
                                  );

                } else {
                  $result = array(
                                  'online' => false,
                                  );
                }
                return $result;
              };

              $ret = array();
              try {
                //~ require_once 'extensions/GameQ/GameQ.php';
                //~ $gq = new GameQ();

//TESTOVANI+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/*
                $p = array();
                $t = 'ut3';
                $qp = 33499;
                foreach (range($qp, $qp + 2) as $row) {
                  $p[] = array('type' => $t, 'host' => 'www.gfdesign.cz:'.$row);
                }
                $gq->addServers($p)->setOption('timeout', 2);
                print_r($gq->requestData());
                exit;

*/
//TESTOVANI+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//FIXME OMG! stary zapis Html tridy, se z toho asi poseru pri upgradu systemu :|,
//super ale sepsal sjem to za 20 minut pri cekani na EC 76, kua podelany parapet, blbe se na nem sedi :S

                //FIXME vykonove optimalizovat!!!
                $gq->addServers($servers)
                    ->setOption('timeout', 2) // Seconds
                    ;

//~ ->setFilter('normalise')
//~ ->setFilter('sortplayers', 'gq_ping')

                $ret = array_map($result_callback, $gq->requestData());

              } catch (GameQException $e) {
                echo $e;
              }

              //var_dump($ret);
              $table = Html::elem('table')->border(1);
              $tr = Html::elem('tr');
              $td = array(
                          Html::elem('th')->setText('typ hry'),
                          //~ Html::elem('th')->setText('version'),
                          Html::elem('th')->setText('nazev'),
                          Html::elem('th')->setText('qport'),
                          Html::elem('th')->setText('cnt'),
                          Html::elem('th')->setText('hraci'),
                          );
              $table->insert($tr->insert($td));

              foreach ($ret as $key => $row) {
                $tr = Html::elem('tr');
                if ($row['online']) {
                  $td = array(
                              Html::elem('td')->setText($key.' ('.$row['game'].')'),
                              //~ Html::elem('td')->setText($row['version']),
                              Html::elem('td')->setText($row['name']),
                              Html::elem('td')->setText($row['port']),
                              Html::elem('td')->setText($row['count']),
                              Html::elem('td')->setText($row['max']),
                              //Html::elem('td')->setText($row[5]),
                              );
                  $tr->insert($td);
                } else {
                  $tr->insert(Html::elem('th')->colspan(6-1)->setText($key . ' is OFFLINE'));
                }
                $table->insert($tr);
              }

              $content->insert($table);
            break;

            case 'logs':  //sekce s logama
              $res = '';
              $code = -1;

              $nadpish1->insert(Html::elem('span')->setText('Přehled'));

              //TODO meanwhile solit list of path logs, then save in DB
              $listlogs = array('auth' => '/var/log/auth.log',
                                'debug' => '/var/log/debug',
                                'daemon' => '/var/log/daemon.log',
                                'dmesg' => '/var/log/dmesg',
                                'dpkg' => '/var/log/dpkg.log',
                                'kern' => '/var/log/kern.log',
                                'messages' => '/var/log/messages',
                                'syslog' => '/var/log/syslog',

                                'knockd' => '/var/log/knockd.log',

                                'ups' => '/var/log/ups.log',

                                'access' => '/var/log/apache2/access.log',
                                'error' => '/var/log/apache2/error.log',

				'svn' => '/var/log/svn.log',

                                'services' => '/etc/services',

                                'mail_log' => '/var/log/mail.log',
                                'mail_err' => '/var/log/mail.err',


                                'mysql_log' => '/var/log/mysql.log',
                                'mysql_err' => '/var/log/mysql.err',
                                'boot' => '/var/log/boot.log',

                                'history' => '/var/log/apt/history.log',
                                'term' => '/var/log/apt/term.log',

                                'bash_history' => '/home/gmr/.bash_history',

                                //'' => '',
                                );

              foreach ($listlogs as $name => $path) {
                //TODO then replace with DB ID
                //$content->insert();
                //if (file_exists($path)) { //nemuze byt bezezmeny prav!?!
                  $res[] = Html::a()->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => $name))->setText($name)->class($name == $sel_level1 ? 'active' : null);
                //}
              }

              if (!empty($sel_level1)) {  //if get parametr isn't empty
                //$countrow = intval(exec(sprintf('sudo wc -l \'%s\' | awk \'{ print $1 }\'', $listlogs[$sel_level1]), $r, $c));
                $countrow = intval(exec(sprintf('sudo %s/logs.sh wc %s', Config::SCRIPT_DIR, $listlogs[$sel_level1])));

                $res[] = Html::elem('h3')->setText('%s, (%s lines)', array($listlogs[$sel_level1], $countrow));

                if ($countrow > 0) {
                  $rowonpage = 200;  //row on the page
                  $countpages = intval(ceil($countrow / $rowonpage));

                  $sel_level2 = Core::isEmpty($sel_level2, $countpages); //default value

                  $link = null;

                  $minus = $sel_level2 - 1;
                  if ($minus > 0) {
                    $link[] = Html::a()->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => $sel_level1, $url_level2 => $minus))->setText('prev')->class($minus == $sel_level2 ? 'active' : null);
                  }

                  foreach (range(1, $countpages) as $num) {
                    $link[] = Html::a()->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => $sel_level1, $url_level2 => $num))->setText($num)->class($num == $sel_level2 ? 'active' : null);
                  }

                  $plus = $sel_level2 + 1;
                  if ($plus <= $countpages) {
                    $link[] = Html::a()->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => $sel_level1, $url_level2 => $plus))->setText('next')->class($plus == $sel_level2 ? 'active' : null);
                  }

                  $paging = Html::elem('span')->insert($link);
                  $from = ($sel_level2 - 1) * $rowonpage + 1; //from row
                  $to = $sel_level2 * $rowonpage; //to row

                  $res[] = $paging;
                  $res[] = Html::br;
                  $res[] = $from.' - '.$to;

                  //wc -l neco.txt | awk '{ print $1 }'
                  //sed -n "3,5p" od,do

                  //exec(sprintf('sudo %s/logs.sh %s 40', Config::SCRIPT_DIR, $listlogs[$sel_level1]), $return, $code);
                  exec(sprintf('sudo %s/logs.sh list %s %s %s', Config::SCRIPT_DIR, $listlogs[$sel_level1], $from, $to), $return, $code);
                } else {
                  $res[] = 'empty log';
                }

                if ($code == 0) { //if result code is 0
                  $res[] = Html::elem('pre')->setText(implode('<br/>', $return)); //implode array data
                } else {
                  //$res[] = 'chyba opravneni (repair in: <pre>$ sudo visudo</pre>)';
                }
                //$content->insert(Html::elem('div')->class('result')->insert(Html::elem('pre')->setText($res)));
              }
              $content->insert(Html::elem('div')->class('result')->setText($res));
            break;

            case 'conf':
              $res = '';

              $nadpish1->insert(Html::elem('span')->setText('Přehled'));

              //TODO musi tahat z databaze!!!!!!
              $listconf = array('knockd' => '/etc/default/knockd',
                                'apache2' => '/etc/apache2/apache2.conf',
                                'php5' => '/etc/php5/apache2/php.ini',
                                //'' => '',
                                );

              foreach ($listconf as $name => $path) {
                $res[] = Html::a()->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => $name))->setText($name)->class($name == $sel_level1 ? 'active' : null);
              }

              if (!empty($sel_level1)) {
                $res[] = Html::elem('pre')->setText(file_get_contents($listconf[$sel_level1]));
              }

              $content->insert(Html::elem('div')->class('result')->setText($res));
            break;

            case 'services':
              $res = '';

              $nadpish1->insert(Html::elem('span')->setText('Seznam'));

              $res[] = Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'status'))->title('status')->setText('status');
              $res[] = Html::br;

              $sel_level1 = Core::isEmpty($sel_level1, 'list'); //default value

              switch ($sel_level1) {
                case 'list':
                  exec(sprintf('%s/services.sh %s', Config::SCRIPT_DIR, 'list'), $return, $code);

//TODO pripadne dodat nebezpecne aplikace nebezpecne pro stabilitu systemu
                  $block = array(
                                  'apache2',
                                  //'ssh'
                                  );

                  if ($code == 0) {
                    foreach ($return as $row) {
                      //var_dump($row, is_executable($row));

                      if (is_executable($row)) {
                        $basename = basename($row);
                        $disable = !in_array($basename, $block);

                        $res[] = Html::elem('span')->setText($basename)->insert(array(
                                                                                      ($disable ? Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'restart', $url_level2 => $basename))->setText('restart') : null),
                                                                                      ($disable ? Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'stop+start', $url_level2 => $basename))->setText('stop + start') : null),
                                                                                      ($disable ? Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'start', $url_level2 => $basename))->setText('start') : null),
                                                                                      ($disable ? Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'stop', $url_level2 => $basename))->setText('stop') : null),
                                                                                      Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'status', $url_level2 => $basename))->setText('status')
                                                                                      ));
                        $res[] = Html::br;
                      }
                    }
                  }
                break;

                case 'status':
                  exec(sprintf('%s/services.sh %s "%s"', Config::SCRIPT_DIR, $sel_level1, $sel_level2), $return, $code);

                  if ($code == 0) {
                    foreach ($return as $row) {
                      $res[] = Html::elem('span')->setText($row);
                      $res[] = Html::br;
                    }
                  }
                break;

                case 'start':
                case 'stop':
                case 'stop+start':
                case 'restart':
                  exec(sprintf('%s/services.sh %s "%s"', Config::SCRIPT_DIR, $sel_level1, $sel_level2), $return, $code);

                  if ($code == 0) {
                    $res[] = implode(Html::br, $return);

                    Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                  }
                break;
              }

              $content->insert(Html::elem('div')->class('result')->setText($res));
            break;

            case 'screens': //sekce se screen
              $res = '';

              $listen_timeout = 5;
//TODO moznost predvolby typu spusteni
              $nadpish1->insert(Html::elem('span')->setText('Přehled'));

              //TODO prozatim pridat pevne odkazy na spusteni pokusnych screen-u, to pak bude v DB!

//TODO co to bude v databazi tak to musi umet kategorizovat, vice instanci jedne hry a ruzne typy spusteni nad screenou

              //$res[] = Html::elem('a')->href('')->title('add')->setText('add')->onalert('bude v budoucnu'); //, array($url_level0 => $sel_level0, $url_level1 => 'add')
              //$res[] = Html::br;

              $sel_level1 = Core::isEmpty($sel_level1, 'list'); //default value

              //tady byl seznam screenu

              ksort($predefinescreens); //serazeni podle klicu

//TODO umoznit pridavat screeny do skupin?? a pridelovat uzivatelum"!!!!!

//TODO odstranovani zombie procesu: $ screen -wipe
//$ sudo screen -wipe www-data/

              //var_dump($sel_level1);

//$ sudo screen -r www-data/
//$ sudo screen -ls www-data/

              $code = -1;

             //var_dump(Core::getUrl(array('query' => array($url_level0 => $sel_level0))));//, Core::makeUrl('', ))
              switch ($sel_level1) {
                case 'list':
                  exec(sprintf('%s/screens.sh %s %s', Config::SCRIPT_DIR, $sel_level1, $sel_level2), $return, $code);

                  //Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                break;

                case 'kill':
                  exec(sprintf('%s/screens.sh %s %s', Config::SCRIPT_DIR, $sel_level1, $sel_level2), $return, $code);

                  Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                break;
//FIXME pri sposteni musi dorzovat unikatnost procesu!!!! jak pres php tak pres screen!!!
//TODO dat: $ ps aux | grep -v grep | grep './hlds_i686 -game svencoop -sport +maxplayers 4 +map abandoned -port 23100'


                case 'add':
                  $randname = Core::getUniqText($sel_level2.'_');
                  $arr = $predefinescreens[$sel_level2];

                  //exec(sprintf('%s/screens.sh "%s" "%s" "%s" "%s"', Config::SCRIPT_DIR, $sel_level1, $randname, $arr['cmd'], $arr['cd']), $return, $code);

                  //spousteni zaroven s logovanim
                  $path = sprintf('%s/%s', Config::BASE_DIR, Config::LOG_DIR);
                  exec(sprintf('%s/screens.sh "%s" "%s" "%s" "%s" "%s" "%s"', Config::SCRIPT_DIR, 'add+listen', $randname, $arr['cmd'], $path, $listen_timeout, $arr['cd']), $return, $code);

//FIXME u KF (nejen pro KF) rozlisovat jestli spostet s multiscreenem nebo bez!!!!

                  Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                break;

                case 'send':
                  $separe = explode('||', $sel_level2);
                  $pid = $separe[0];
                  $msg = $predefinescreens[$separe[1]]['end']['send'];
                  exec(sprintf('%s/screens.sh %s %s %s', Config::SCRIPT_DIR, $sel_level1, $pid, $msg), $return, $code);

                  Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                break;

                case 'send_msg':  //TODO udelat komplexnejsi...!
                  $frm = new Form();
                  $frm->addText('message', array('label' => 'Message:'))
                      ->addSubmit('send', array('value' => 'Send message'));
                  $res[] = Html::elem('a')->hrefpath('',array($url_level0 => $sel_level0))->class('log_back')->setText('zpět na výpis');
                  $res[] = $frm;

                  if ($frm->isSubmitted()) {
                    $values = $frm->getValues();
                    exec(sprintf('%s/screens.sh %s %s "%s"', Config::SCRIPT_DIR, 'send', $sel_level2, $values['message']), $return, $code);

                    Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                  }
                break;

                case 'send_extra':
                  list($pid, $name) = explode('||', $sel_level2);

                  $idx = base64_decode($sel_level3);
                  $msg = $predefinescreens[$name]['extra'][$idx];

                  exec(sprintf('%s/screens.sh %s %s "%s"', Config::SCRIPT_DIR, 'send', $pid, $msg), $return, $code);
                  if ($code == 0) {
                    $res[] = implode('', $return);
                  }

                  Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                break;

                case 'listen':
                  $path = sprintf('%s/%s/%s.log', Config::BASE_DIR, Config::LOG_DIR, $sel_level2);
//TODO tady bude input na zadavani prikazu do konzole??!
                  exec(sprintf('%s/screens.sh %s %s "%s" %s', Config::SCRIPT_DIR, $sel_level1, $sel_level2, $path, $listen_timeout), $return, $code);
                break;

                case 'listen_log':
                  $path = sprintf('%s/%s/%s.log', Config::BASE_DIR, Config::LOG_DIR, $sel_level2);
//FIXME pri prilis velikych souborech havaruje
                  $res[] = Html::elem('span')->class('last_update')->setText('Last update: '.date('d.m.Y H:i:s', filemtime($path)));
                  $res[] = Html::elem('a')->hrefpath('',array($url_level0 => $sel_level0))->class('log_back')->setText('zpět na výpis');
                  $res[] = Html::elem('pre')->setText(file_get_contents($path));
                break;

                case 'extern_log':
                  $path = $predefinescreens[$sel_level2]['log'];
                  if (file_exists($path)) {
                    //TODO umoznit i komplikovanejsi cesty logu ktere nemaji vzdy stejne jmeno, nebo proste posledni upravovany log
                    $res[] = Html::elem('span')->class('last_update')->setText('Last update: '.date('d.m.Y H:i:s', filemtime($path)));
                    $res[] = Html::elem('a')->hrefpath('',array($url_level0 => $sel_level0))->class('log_back')->setText('zpět na výpis');
                    $res[] = Html::elem('pre')->setText(file_get_contents($path));
                  } else {
                    $res[] = "sorry ale log neexistuje!";
                  }
                break;
              }

              $run_games = array();
              if ($code == 0 || $code == 1) {
                $filtr_game = function($value) { return (!empty($value) && $value[0] == '	'); };
                $games = array_filter($return, $filtr_game);

                //preg_match('/\.[a-zA-Z0-9\_]+\_/', $row, $matches);
                //    $screenname = substr($matches[0], 1, -1);

                $prepare_name =function($value) {
                  preg_match('/\.[a-zA-Z0-9\_]+\_/', $value, $matches);
                  return substr($matches[0], 1, -1);
                };

                $run_games = array_map($prepare_name, $games);
              }

              //generovani menu
              $screen_menu = Html::elem('table')->class('seznam_screen');
              $poc = 0;
              $wrap = 4;  //zalomit po
              $row = null;
              foreach ($predefinescreens as $name => $command) {
                if (($poc % $wrap) == 0) {  //detekuje kazny N-ty radek
                  $row = Html::elem('tr');  //vytvoreni noveho radku
                  $screen_menu->insert($row); //vlozeni tohoto radku do screen menu
                }
                //$screen_menu->insert(Html::elem('li')->insert(Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'add', $url_level2 => $name))->title($command['cmd'])->setText($name)->onconfirm('Opravdu se má spustit proces: %s ?', $name)));
                //->class(in_array($name, $run_games) ? 'aktivni' : null)
                //vkladani polozek do aktivniho radku
                $row->insert(Html::elem('td')->insert(
                  !in_array($name, $run_games) ?
                    Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'add', $url_level2 => $name))->title($command['cmd'])->setText($name)->onconfirm('Opravdu se má spustit proces: %s ?', $name)
                    :
                    //TODO doresit skrivani menu her...
                    Html::elem('a')->href('#'.$name)->insert(Html::elem('span')->title($command['cmd'])->setText($name))
                    //Html::elem('span')->title($command['cmd'])->setText($name)
                ));
                $poc++;
              }
              $res[] = $screen_menu;

              //var_dump($return, $code);

              //$res[] = Html::elem('a')->href('')->setText('pokuss')->onclick('alert(prompt(\'necuc vole\'));');
              //var_dump($_GET, $_POST);

              if ($code == 0 || $code == 1) { //if result code is 0 or 1?
                $poc = 0;
                //var_dump($predefinescreens);

                $screen_obsah = Html::elem('ul')->class('vypis_screen');
                foreach ($return as $row) {
                  if (!empty($row) && $row[0] == '	') {
                    //var_dump($row);

                    //preg_match('/[0-9]+\.[a-zA-Z0-9\_]+/', $row, $matches);
                    //$rowid = $matches[0];
                    //var_dump($rowid);

                    //screen name
                    preg_match('/\.[a-zA-Z0-9\_]+\_/', $row, $matches);
                    $screenname = substr($matches[0], 1, -1); //vyparsrovane jmeno screeny
                    //var_dump($matches, $screenname);
                    $predef = $predefinescreens[$screenname];
                    //var_dump($predefinescreens[$screenname]);
//var_dump($predef);
                    //full process name
                    preg_match('/[a-zA-Z0-9\_\.]+/', $row, $matches);
                    $fullname = $matches[0];
                    //var_dump($matches, $fullname);

//FIXME je tu chybka v praznem indexu!!!!! opravit!!!
                    //zjistovani PID procesu
                    preg_match('/[0-9]+\./', $row, $matches);
                    $pid = substr($matches[0], 0, -1);
                    //var_dump($pid);

                    $path = sprintf('%s/%s/%s.log', Config::BASE_DIR, Config::LOG_DIR, $fullname);

                    $extra = $predef['extra'];
                    //var_dump($extra);

                    $log = Core::isFill($predef, 'log');
//var_dump($log);
                    $ext = null;
                    if (!empty($extra)) {
                      $ext = Html::elem('span')->class('pridavne_odkazy');
                      foreach ($extra as $k => $r) {
                        if (is_array($r)) {
                          //var_dump($r[0]);
                          //TODO z JS preneaset hodnoty do php z promptu?! vyresit posilani dat primo z odkazu pres get... popripadne sifrovane a nebo rovnou pres post!
                        } else {//$url_level2 => 'send',
                          $ext->insert(Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'send_extra', $url_level2 => $pid.'||'.$screenname, $url_level3 => base64_encode($k)))->setText($k));
                        }
                      }
                    }

                    $screen_obsah->insert(Html::elem('li')->id($screenname)->insert(Html::elem('p')->setText('['.($poc < 9 ? '0' : '').($poc + 1).'] ~ '.$row))->insert(
                                                          Html::elem('span')->class('hlavni_odkazy')->insert(
                                                                      array(
                                                                        //Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'attach', 'id' => $rowid))->setText('attache'),
                                                                        //($predef['end'] == 'kill' ? Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'kill', $url_level2 => $pid))->setText('kill') : NULL),
                                                                        Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'kill', $url_level2 => $pid))->setText('kill')->onconfirm('Opravdu chceš killnout proces: %s ?', $fullname),
                                                                        (is_array($predef['end']) ? Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'send', $url_level2 => $pid.'||'.$screenname))->setText('send kill')->onconfirm('Opravdu chceš zaslat kill procesu: %s ?', $fullname) : NULL),
                                                                        (!file_exists($path) ? Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'listen', $url_level2 => $fullname))->setText('listen on') : null),
                                                                        (file_exists($path) ? Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'listen_log', $url_level2 => $fullname))->setText('listen log') : null),
                                                                        (!empty($log) ? Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'extern_log', $url_level2 => $screenname))->setText('extern log') : null),
                                                                        Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'send_msg', $url_level2 => $fullname))->setText('send message'))

                                                                      ))->insert($ext)
                                          );

                    $poc++;
                  }
                }

                $res[] = $screen_obsah;

                if ($code == 0 || $poc == 0) {
                  $res[] = implode('<br/>', $return); //implode array data
                  //TODO dale pro stylovani upravit nasledujici (pokud je prazdne ul a je: No Sockets found in /var/run/screen/S-www-data.):
                  //$screen_obsah->insert(Html::elem('li')->insert(Html::elem('p')->setText($row)
                }
              }

              $add = null;
              if ($sel_level1 == 'list') {
                $add = Html::a()->href('#')->onclick('return false;')->setText('Spustit screen')->id('odkaz_seznam_screen');
              }

              $content->insert($add)->insert(Html::elem('div')->class('obal_screen')->setText($res));
            break;

            case 'screens_log':  //section for list and manage all logs
              $res = '';

              $nadpish1->insert(Html::elem('span')->setText('Přehled'));
//TODO moznost sotru :S
              $path = sprintf('%s/%s', Config::BASE_DIR, Config::LOG_DIR);
              $list = Core::getListFile(array('path' => $path, 'full' => true, 'sort' => array(Core::LIST_SORT_MTIME, Core::LIST_SORT_DESC)));
              foreach ($list as $row) {
                $name = basename($row);
                $res[] = Html::elem('span')
                              ->setText($name)
                              ->setText(' - modify: %s', date('d.m.Y H:i:s', filemtime($row)))
                              ->setText(' - size: %s', Core::getFileSize($row)) //FIXME opravit pokud je soubor 0 tak aby neco zobrazil! treba '0'
                              ->insert(array(
                                              Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'list', $url_level2 => $name))->setText('list'),
                                              Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'delete', $url_level2 => $name))->setText('delete')->onconfirm('opravdu smazat %s?', $name)
                                      ));
                $res[] = Html::br;
              }

              switch ($sel_level1) {
                case 'list':
                  $file = sprintf('%s/%s', $path, $sel_level2);
                  $res = Html::elem('span')->setText('file: %s, last modify: %s', array($sel_level2, date('d.m.Y H:i:s', filemtime($file))))->insert(Html::elem('pre')->setText(file_get_contents($file)));
                break;

                case 'delete':
                  $file = sprintf('%s/%s', $path, $sel_level2);
                  if (file_exists($file)) {
                    if (unlink($file)) {
                      $res = 'smazano';

                      Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                    }
                  }
                break;
              }


              //TODO dodelat obsluhu odkazu

              $content->insert(Html::elem('div')->class('result')->setText($res));
            break;

            case 'iptables':  //print contents iptables
              $res = '';

              $nadpish1->insert(Html::elem('span')->setText('Přehled'));

              $res[] = Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'all'))->setText('all connection');
              $res[] = Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'active'))->setText('active connection');


              //$res[] = Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'add'))->setText('add');
              $res[] = Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'flush'))->onconfirm('opradu vyprazdnit?')->setText('flush');

              //$res[] = Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'disableall'))->setText('disable all');

              //~ $res[] = Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'disable22'))->setText('disable 22');
              // $res[] = Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'enable22'))->setText('enable 22');

              $ip = $_SERVER['REMOTE_ADDR'];
              $haship = base64_encode($ip);
              $res[] = Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'enable22for', $url_level2 => $haship))->setText('enable 22 pro %s', $ip);
              $res[] = Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'disable22for', $url_level2 => $haship))->setText('disable 22 pro %s', $ip);

              //~ $res[] = Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'enableups', $url_level2 => $haship))->setText('enable UPS pro %s', $ip);
              //~ $res[] = Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'disable22for', $url_level2 => $haship))->setText('disable 22 pro %s', $ip);

              $res[] = Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'list'))->setText('list iptables');

              $res[] = Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'addip'))->setText('manualni pridani IP adresy');

//TODO komentare k pravidlum: $ iptables -A INPUT -j DROP -p tcp --dport 22 -m comment --comment "limit ssh access"


              $protocols = array('tcp' => 'Tcp', 'udp' => 'Udp', 'all' => 'All');
              $targets = array('DROP' => 'Zahodit' , 'ACCEPT' => 'Příjmout', 'REJECT' => 'odmítnout');
              $directions = array('INPUT' => 'Příchozí', 'OUTPUT' => 'Odchozí');

              //TODO casem dodelat...
              /*
               * iptables -A INPUT
               * iptables --append
               * iptables -I INPUT
               * iptables --insert
               * iptables -D INPUT <X>
               * iptables --delete
               * iptables -F INPUT
               *
               * --sport (source)
               * --dport (destination)
               *
               * $ sudo iptables -L -n -v
               *
               * sudo iptables -F
               * sudo iptables -X
               *
               * http://ipset.netfilter.org/iptables.man.html
               * http://www.linuxexpres.cz/praxe/sprava-linuxoveho-serveru-linuxovy-firewall-zaklady-iptables-1
               *
               */
// enableipportfor--disableipportfor + enableportfor--disableportfor
              $sel_level1 = Core::isEmpty($sel_level1, 'all'); //default value

              switch ($sel_level1) {
                case 'all':
                case 'active':
                  exec(sprintf('sudo %s/iptables.sh %s', Config::SCRIPT_DIR, $sel_level1), $return, $code);
                  if ($code == 0) {
                    $res[] = Html::elem('pre')->setText($return);
                  }
                break;

                case 'list':
                  exec(sprintf('sudo %s/iptables.sh %s', Config::SCRIPT_DIR, $sel_level1), $return, $code);
                  if ($code == 0) {
                    //$target = array('ACCEPT', 'DROP', 'QUEUE', 'RETURN');
                    $chain = array('INPUT', 'FORWARD', 'OUTPUT');
                    $curchain = null;
                    $protocol = 'tcp'; //TODO zatim jen TCP
                    $r = array();
                    foreach ($return as $row) {
                      $head = explode(' ', $row);
                      if (!empty($head[1]) && in_array($head[1], $chain)) {
                        $curchain = $head[1];
                      }

                      $_r = $row;

                      preg_match('/([[:digit:]]{1,3}\.){3}[[:digit:]]{1,3}/', $row, $ip);
                      if (!empty($ip)) {
                        $ip = $ip[0];

                        preg_match('/ACCEPT/', $row, $accept);

                        //TODO zatim bude umet jen mazat ACCEPT
                        if (!empty($accept[0]) && $accept[0] == 'ACCEPT') {
                          preg_match('/dpt\:[[:digit:]]{1,6}/', $row, $dpt);

                          $dpt = substr($dpt[0], 4);
                          //zatim bude umet mazat jen destination porty
                          $hash = base64_encode(sprintf('%s::%s::%s::%s', $curchain, $ip, $protocol, $dpt));

                          $_r .= ' ~ '.Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'delete', $url_level2 => $hash))->onconfirm('opradu smazat toto pravidlo?')->setText('smazat pravidlo');
                        }
                      }

                      $r[] = $_r;
                    }

                    $res[] = Html::elem('pre')->setText($r);
                  }
                break;

                case 'delete':
                  $dehash = base64_decode($sel_level2);
                  $ex = explode('::', $dehash);

                  $chain = $ex[0];
                  $ip = $ex[1];
                  $protocol = $ex[2];
                  $port = $ex[3]; //dport!

                  if (!empty($ip)) {
                    exec(sprintf('sudo %s/iptables.sh delete "%s" "%s" "%s" "%s"', Config::SCRIPT_DIR, $chain, $ip, $protocol, $port), $return, $code);
                    if ($code == 0) {
                      $res[] = implode(Html::br, $return);

                      Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                    }
                  }

                break;

                case 'flush':
                //case 'disableall':
                case 'enable22':
                case 'disable22':
                  exec(sprintf('sudo %s/iptables.sh %s', Config::SCRIPT_DIR, $sel_level1), $return, $code);
                  if ($code == 0) {
                    $res[] = implode(Html::br, $return);

                    Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                  }
                break;

                case 'enable22for':
                case 'disable22for':
                  $dehaship = base64_decode($sel_level2);
                  exec(sprintf('sudo %s/iptables.sh %s %s', Config::SCRIPT_DIR, $sel_level1, $dehaship), $return, $code);
                  if ($code == 0) {
                    $res[] = implode(Html::br, $return);

                    Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                  }
                break;

                case 'enableups':
                  $dehaship = base64_decode($sel_level2);
                  $_port = 15178;
                  exec(sprintf('sudo %s/iptables.sh enableipportfor %s %s', Config::SCRIPT_DIR, $dehaship, $_port), $return, $code);
                  if ($code == 0) {
                    $res[] = implode(Html::br, $return);

                    Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                  }
                break;

                case 'addip': //manualni otvirani 22 pro danou IP adresu
                  $f = new Form;
                  $f->addText('ip', array('value' => $_SERVER['REMOTE_ADDR']))
                    ->addSubmit('send', array('value' => 'vložit'));

                  $res[] = $f;

                  if ($f->isSubmitted()) {
                    $p = $f->getValues();

                    exec(sprintf('sudo %s/iptables.sh %s "%s"', Config::SCRIPT_DIR, 'enable22for', $p['ip']), $return, $code);
                    if ($code == 0) {
                      $res[] = implode(Html::br, $return);

                      Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                    }

                  }
                break;

//TODO dopsat: add/edit/del, dodalat akutne!!!!
                case 'add':
                  $f = new Form;
                  $f
                    ->addSelect('target', array('value' => $targets))
                    ->addSelect('direction', array('value' => $directions))
                    ->addSelect('protocol', array('value' => $protocols))
                    ->addText('port', array('label' => 'Port: ', 'placeholder' => 'port / rozsah: port1:portN'))

                    ->addText('source_ip', array('label' => 'source IP: '))
                    ->addText('dest_ip', array('label' => 'destination IP: '))

                    //->addText('source_ip', array('value' => 'od IP'))
                    //->addText('start_port', array('value' => 'od IP'))
                    //->addText('end_ip', array('value' => 'do IP'))

                    ->addSubmit('send', array('value' => 'vložit'));

                  $res[] = $f;
//TODO dodelat!!!!
                  if ($f->isSubmitted()) {
                    var_dump($f->getValues());

                    //TODO prikaz do iptables sh kde prijde ke zpracovani!

                    //Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                  }
                break;

                case 'edit':
                  //Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                break;

                case 'del':
                  //Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                break;
              }

              $content->insert(Html::elem('div')->class('result')->setText($res));
            break;

            case 'info':  //print info about system
              $res = '';
              //$content->insert(Html::elem('h2')->setText('Informace o zátěži a využití systemových prostředků'));
              $nadpish1->insert(Html::elem('span')->setText('Přehled'));
//TODO loging load system: sys_getloadavg each ~1 minute?

              //php read system load
              $load = sys_getloadavg();
              //var_dump($load);

              $res[] = Html::elem('span')->setText('Last 1 minute: %s', $load[0]);
              $res[] = Html::br;
              $res[] = Html::elem('span')->setText('Last 5 minute: %s', $load[1]);
              $res[] = Html::br;
              $res[] = Html::elem('span')->setText('Last 15 minute: %s', $load[2]);


              $res[] = Html::br;
              $cpu = 4;
              $res[] = Html::elem('span')->setText('Master load: %s%% ze %s%%', array(round(($load[0] / $cpu) * 100, 2), $cpu * 100));


              //$res[] = Html::elem('br');
              $res[] = Html::br;
              $res[] = Html::br;

              exec(sprintf('sudo %s/info.sh', Config::SCRIPT_DIR), $return, $code);
//TODO do seznamu procesu pridal kill -9 !!!!!!!!!!!!!!!!!
              if ($code == 0) {
                $pre = NULL;
                foreach ($return as $row) {

                  preg_match('/\:{[a-zA-Z]+}/', $row, $matches);
                  //var_dump($matches);
                  if (!empty($matches)) {
                    $res[] = Html::elem('strong')->setText('Print info from application: %s', substr($matches[0], 2, -1));
                    //$res[] = Html::elem('br');
                    $res[] = Html::br;

                    $pre = Html::elem('pre');
                    $res[] = $pre;
                  } else {
                    if (!empty($row)) {
                      $pre->setText(htmlspecialchars(trim($row)));
                    }
                  }

                }

              }

              //var_dump($return, $code);

              $content->insert(Html::elem('div')->class('result')->setText($res));
            break;

            case 'users':
              $res = '';

              $nadpish1->insert(Html::elem('span')->setText('Seznam'));

              $sel_level1 = Core::isEmpty($sel_level1, 'list'); //default value

              $res[] = Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'add'))->setText('add');

              $res[] = Html::br;

//Html::elem('meter')->title('toto je: %s a taky: %s', array('super', 'ficura'));

              switch ($sel_level1) {
                case 'list':
                  exec(sprintf('sudo %s/users.sh %s', Config::SCRIPT_DIR, $sel_level1), $return, $code);

                  if ($code == 0) {

//TODO upozornovani ma email??
//TODO email alisy na emaily!
//TODO prohlihka filesystemu pres web na kazdeho uzivatele aby bylo videt modifikace a filesize!

                    //$res[] = 'user   space   quota   limit   grace   files   quota   limit   grace';
                    //$res[] = Html::br;

                    foreach ($return as $index => $user) {
                      $row = Html::elem('span');

                      if (($index % 2) == 0) {
                        //TODO muze mit za nasledek delsi nacitani stranky!!
                        $link = exec(sprintf('%s/users.sh getlink "%s"', Config::SCRIPT_DIR, $user), $return, $code);
//FIXME dat do kupy zobrazovani prosvihleho grant limitu!!!
                        //user
                        $res[] = $row
                              ->setText($user)
                              ->setText('(link: '.$link.')')
                              ->insert(array(
                                              Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'edit', $url_level2 => $user))->setText('edit'),
                                              Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'del', $url_level2 => $user))->setText('delete')->onconfirm('opravdu smazat uživatele: %s?', $user),
//TODO menit text podle stavu!
                                              Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'changesftp', $url_level2 => $user))->setText('disable sftp')->onconfirm('opravdu zmenit stav sftp: %s?', $user),
                                              Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'changewww', $url_level2 => $user))->setText('disable www')->onconfirm('opravdu zmenit stav www: %s?', $user)
                                      ));
                      } else {
                        //quota
                        //$row->setText($user);

                        $quotasplit = preg_split('/[\s]*[ ][\s]*/', $user);
                        $diff_size = Core::getDifferenceDate('now', intval($quotasplit[4]), 'zbývá: %d dní a %h:%i:%s');
                        $diff_count = Core::getDifferenceDate('now', intval($quotasplit[8]), 'zbývá: %d dní a %h:%i:%s');
//TODO spravne vyslovovani dni??
//TODO spravny format cisel s pocatecni nulou?
                        $row->setText('size: ')->insert(Html::elem('meter')->value(intval($quotasplit[1]))->high($quotasplit[2])->max($quotasplit[3])->title('%s / (%s | %s)', array($quotasplit[1], $quotasplit[2], $quotasplit[3]))->setText($quotasplit[1]))->setText(!empty($quotasplit[4]) ? sprintf('(size grace to: %s)', $diff_size) : null);
                        $row->setText('files: ')->insert(Html::elem('meter')->value(intval($quotasplit[5]))->high($quotasplit[6])->max($quotasplit[7])->title('%s / (%s | %s)', array($quotasplit[5], $quotasplit[6], $quotasplit[7]))->setText($quotasplit[5]))->setText(!empty($quotasplit[8]) ? sprintf('(count grace to: %s)', $diff_count) : null);

                        $res[] = $row;
                        $res[] = Html::br;
                      }

                    }
                  }
                break;

                case 'changesftp':
                case 'changewww':
                  //TODO enable/dibable sftp, enable/disable web
                break;

                case 'add':
                  $frm = new Form;
                  $frm->addText('subdomain', array('label' => 'jmeno subdomény:', 'required' => true))
                      ->addPassword('pass', array('label' => 'heslo:', 'required' => true))
                      ->addNumber('fsoft', array('label' => 'soft size (MB)', 'value' => 5))
                      ->addNumber('fhard', array('label' => 'hadr size (MB)', 'value' => 10))
                      ->addNumber('csoft', array('label' => 'count soft', 'value' => 1000))
                      ->addNumber('chart', array('label' => 'count hard', 'value' => 2000))
                      ->addSubmit('add', array('value' => 'add'));
                  $res[] = $frm;

                  if ($frm->isSubmitted()) {
                    $values = $frm->getValues();

                    exec(sprintf('sudo %s/users.sh %s "%s" "%s" %s %s %s %s', Config::SCRIPT_DIR, $sel_level1, $values['subdomain'], $values['pass'], $values['fsoft'], $values['fhard'], $values['csoft'], $values['chart']), $return, $code);

                    if ($code == 0) {
                      $res[] = implode(Html::br, $return);
                      Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                    }
                  }
                break;

                case 'edit':
                  if (!empty($sel_level2)) {
                    $user = $sel_level2;

                    //load quotas
                    $quota = exec(sprintf('sudo %s/quotas.sh getuser "%s"', Config::SCRIPT_DIR, $user), $r, $c);
                    $quotasplit = preg_split('/[\s]*[ ][\s]*/', $quota);
                    //load symlink name
                    $link = exec(sprintf('%s/users.sh getlink "%s"', Config::SCRIPT_DIR, $user), $return, $code);

                    $frm = new Form;
                    $frm->addText('subdomain', array('label' => 'nové jméno subdomény (nové jméno symlinku):', 'value' => $link))
                        ->addPassword('sftppass', array('label' => sprintf('nove heslo pro sftp %s:', $user)))
                        ->addPassword('mysqlpass', array('label' => sprintf('nove heslo pro mysql %s:', $user)))
                        ->addNumber('fsoft', array('label' => 'soft size', 'value' => ($quotasplit[2] / 1024)))
                        ->addNumber('fhard', array('label' => 'hadr size', 'value' => ($quotasplit[3] / 1024)))
                        ->addNumber('csoft', array('label' => 'count soft', 'value' => $quotasplit[6]))
                        ->addNumber('chart', array('label' => 'count hard', 'value' => $quotasplit[7]))
                        ->addSubmit('edit', array('value' => 'edit'));
                    $res[] = $frm;

                    if ($frm->isSubmitted()) {
                      $values = $frm->getValues();

                      if (!empty($values['subdomain']) && $link != $values['subdomain']) {
                        exec(sprintf('sudo %s/users.sh editlink "%s" "%s"', Config::SCRIPT_DIR, $user, $values['subdomain']), $return, $code);

                        if ($code == 0) {
                          $res[] = implode(Html::br, $return);
                          Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                        }
                      } else
                      if (!empty($values['sftppass'])) {
                        exec(sprintf('sudo %s/users.sh editsftp "%s" "%s"', Config::SCRIPT_DIR, $user, $values['sftppass']), $return, $code);

                        if ($code == 0) {
                          $res[] = implode(Html::br, $return);
                          Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                        }
                      } else
                      if (!empty($values['mysqlpass'])) {
                        exec(sprintf('sudo %s/users.sh editmysql "%s" "%s"', Config::SCRIPT_DIR, $user, $values['mysqlpass']), $return, $code);

                        if ($code == 0) {
                          $res[] = implode(Html::br, $return);
                          Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                        }
                      } else {
                        exec(sprintf('sudo %s/users.sh editquota "%s" %s %s %s %s', Config::SCRIPT_DIR, $user, $values['fsoft'], $values['fhard'], $values['csoft'], $values['chart']), $return, $code);

                        if ($code == 0) {
                          $res[] = implode(Html::br, $return);
                          Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                        }
                      }
                    }
                  }
                break;

                case 'del':
                  if (!empty($sel_level2)) {
                    exec(sprintf('sudo %s/users.sh %s "%s"', Config::SCRIPT_DIR, $sel_level1, $sel_level2), $return, $code);

                    if ($code == 0) {
                      $res[] = implode(Html::br, $return);

                      Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                    }
                  }
                break;

                //TODO lock/unlock???
              }

              $content->insert(Html::elem('div')->class('result')->setText($res));
            break;

            case 'svn': // ovladani svnka
              $res = '';

              $nadpish1->insert(Html::elem('span')->setText('Ovládání'));

              $frm = new Form;
              $frm->addText('path', array('label' => 'jmeno a adresa svn:', 'required' => true))
                  ->addSubmit('add', array('value' => 'add'));
              $res[] = $frm;

              if ($frm->isSubmitted()) {
                $values = $frm->getValues();

                exec(sprintf('sudo %s/svn_repo_add.sh "%s"', Config::SCRIPT_DIR, $values['path']), $return, $code);

                if ($code == 0) {
                  $res[] = implode(Html::br, $return);

                  Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                }
              }

              exec('ls -Rd /var/www/www/svn/*/* | cut -d"/" -f6-', $return, $code);
              if ($code == 0) {
                $list = Html::elem('ul');
                foreach ($return as $path) {
                  $row = Html::elem('li');
                  $a = Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'del', $url_level2 => $path))->onconfirm('opravdu víte co děláte?')->setText('smazat repozitar');
                  $row->setText('<strong>' . $path . '</strong> - (<i>svn checkout svn://gfdesign.cz/' . $path . ' NAZEV</i>) ' . $a);

                  $list->insert($row);
                }
                $res[] = $list;
              }

              $content->insert(Html::elem('div')->class('result')->setText($res));
            break;

            case 'machine':
              $res = '';

              $nadpish1->insert(Html::elem('span')->setText('Ovládání'));

              $isrunshuthown_restart = (bool) exec(sprintf('%s/screens.sh isshutdown_restart', Config::SCRIPT_DIR), $return, $code);
              $isrunshuthown_off = (bool) exec(sprintf('%s/screens.sh isshutdown_off', Config::SCRIPT_DIR), $return, $code);
//TODO pridat planovany restart > 5 min + nejste nejak z toho dostavat ty informace!!!
              $minute = 5;

              if ($isrunshuthown_restart) {
                $res[] = Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'cancelrestart'))->onconfirm('opravdu víte co děláte?')->setText('zrušit restart (vypnutí)');
                $res[] = sprintf('restart bezi do ... %s minut bude proveden restart!!', $minute);
              } else {
                $res[] = Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'restart'))->onconfirm('opravdu víte co děláte?')->setText('restart stroje');
              }

              if ($isrunshuthown_off) {
                $res[] = Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'cancelrestart'))->onconfirm('opravdu víte co děláte?')->setText('zrušit vypnutí (restart)');
                $res[] = sprintf('vypnutí bezi do ... %s minut bude provedeno vypnutí!!', $minute);
              } else {
                $res[] = Html::elem('a')->hrefpath('', array($url_level0 => $sel_level0, $url_level1 => 'off'))->onconfirm('opravdu víte co děláte?')->setText('vypnutí stroje');
              }
//TODO zjisteni jestli je restart je jen overeni souboru v /proc!!!
              switch ($sel_level1) {
                case 'restart':
                  exec(sprintf('sudo %s/screens.sh shutdown_restart %s', Config::SCRIPT_DIR, $minute), $return, $code);

                  $res[] = 'zapinam restart!';

                  Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                break;

                case 'off':
                  exec(sprintf('sudo %s/screens.sh shutdown_off %s', Config::SCRIPT_DIR, $minute), $return, $code);

                  $res[] = 'zapinam vypínání!';

                  Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                break;

                case 'cancelrestart':
                  exec('sudo killall shutdown');
                  //exec('sudo killall shutdown');

                  $res[] = 'zastavuji restart!';

                  Core::setRefresh(1, Core::getUrl(array('query' => array($url_level0 => $sel_level0))));
                break;
              }

              $content->insert(Html::elem('div')->class('result')->setText($res));
            break;

            case 'manual':
              //TODO zapisnik kde se napridava informace ktere se budu na nejake konkterni subdomene zobrazovat (neco jako manualove stranky)
              $res = '';

              $res[] = 'tady bdue sprava manualovych stranek';

              //TODO tady se bude generovat do databaze a pak na jine domene to bude prolinkovane z jine domeny na tuto databazi

              $content->insert(Html::elem('div')->class('result')->setText($res));
            break;
          }

          $body->insert(Html::div()->id('zahlavi')->insert(Html::p()->insert(Html::a()->hrefpath('')->title('GoodFlow server')->setText('GoodFlow server')))->insert($menu))->insert($content);
          $page->addBody($body);
        } else {
          $page = new HtmlPage(HtmlPage::DOCTYPE_STRICT);
          $page->setLanguage(Config::LANG);
          $page->addBody(Html::h1()->setText('... tupě ses přihlásil :) ...'));
        }

      }


    } else {
      $page = new HtmlPage(HtmlPage::DOCTYPE_STRICT);
      $page->setLanguage(Config::LANG);
      $page->addBody(Html::h1()->setText('... pustil jsi tupý browser ... chá chá :) ...'));


    }
    echo $page;
  }

?>
