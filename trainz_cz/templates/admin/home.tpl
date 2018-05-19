<div class="mws-stat-container clearfix">
  <p class="mws-stat">
    <span class="mws-stat-icon icol32-box"></span>
    <span class="mws-stat-content count_downloads preloader">
      <span class="mws-stat-title">Objektů/map</span>
      <span class="mws-stat-value"></span>
    </span>
  </p>
  <p class="mws-stat">
    <span class="mws-stat-icon icol32-photos"></span>
    <span class="mws-stat-content count_slideshows preloader">
      <span class="mws-stat-title">Screenshotů</span>
      <span class="mws-stat-value"><!--  --></span>
    </span>
  </p>
  <p class="mws-stat">
    <span class="mws-stat-icon icol32-newspaper"></span>
    <span class="mws-stat-content count_news preloader">
      <span class="mws-stat-title">Novinek</span>
      <span class="mws-stat-value"><!--  --></span>
    </span>
  </p>
  <p class="mws-stat">
    <span class="mws-stat-icon icol32-link"></span>
    <span class="mws-stat-content count_links preloader">
      <span class="mws-stat-title">Odkazů</span>
      <span class="mws-stat-value"><!--  --></span>
    </span>
  </p>
  <p class="mws-stat">
    <span class="mws-stat-icon icol32-bricks"></span>
    <span class="mws-stat-content count_trainz_kuid preloader">
      <span class="mws-stat-title">Kuidů</span>
      <span class="mws-stat-value"><!--  --></span>
    </span>
  </p>
  <p class="mws-stat">
    <span class="mws-stat-icon icol32-folders-explorer"></span>
    <span class="mws-stat-content count_downloads_category preloader">
      <span class="mws-stat-title">Kategorií</span>
      <span class="mws-stat-value"><!--  --></span>
    </span>
  </p>
  <p class="mws-stat">
    <span class="mws-stat-icon icol32-three-tags"></span>
    <span class="mws-stat-content count_trainz_versions preloader">
      <span class="mws-stat-title">Trainz verzí</span>
      <span class="mws-stat-value"><!--  --></span>
    </span>
  </p>
  <p class="mws-stat">
    <span class="mws-stat-icon icol32-group"></span>
    <span class="mws-stat-content count_users preloader">
      <span class="mws-stat-title">Uživatelů</span>
      <span class="mws-stat-value"><!--  --></span>
    </span>
  </p>
  <p class="mws-stat">
    <span class="mws-stat-icon icol32-group-error"></span>
    <span class="mws-stat-content count_authors preloader">
      <span class="mws-stat-title">Nepřiřazených uživatelů</span>
      <span class="mws-stat-value"><!--  --></span>
    </span>
  </p>
  <p class="mws-stat">
    <span class="mws-stat-icon icol32-drive-disk"></span>
    <span class="mws-stat-content file_size_files preloader">
      <span class="mws-stat-title">Velikost objektů/map</span>
      <span class="mws-stat-value"><!--  --></span>
    </span>
  </p>
  <p class="mws-stat">
    <span class="mws-stat-icon icol32-picture-save"></span>
    <span class="mws-stat-content file_size_img_download preloader">
      <span class="mws-stat-title">Velikost náhledů objektů/map</span>
      <span class="mws-stat-value"><!--  --></span>
    </span>
  </p>
  <p class="mws-stat">
    <span class="mws-stat-icon icol32-picture-save"></span>
    <span class="mws-stat-content file_size_img_slideshow preloader">
      <span class="mws-stat-title">Velikost screenshotů</span>
      <span class="mws-stat-value"><!--  --></span>
    </span>
  </p>
  <p class="mws-stat">
    <span class="mws-stat-icon icol32-database-save"></span>
    <span class="mws-stat-content db_size preloader">
      <span class="mws-stat-title">Velikost databáze</span>
      <span class="mws-stat-value"><!--  --></span>
    </span>
  </p>
</div>
<div class="grid_8 mws-panel mws-vzkaznik mws-tree-navigace-noaddbtn">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky" title="Vzkazy za posledních 24 hodin">Vzkazník</span>
    <span class="idpolozky" title="Kdo byl online za posledních {$global_configure.admin.shoutboardUserOnline} minut">Online: <em class="online_user">-- nikdo --</em></span>
  </div>
  <div class="mws-panel-body no-padding clearfix">
    {code}
      $history = (isset($uri['subblock']) ? $uri['subblock'] : null);
    {/code}
    <div class="chat_historie">
      <h4>Historie vzkazů podle data</h4>
      {loop="$db->rawQuery('SELECT DATE(added) datum, COUNT(added) pocet
                            FROM shoutboards
                            GROUP BY DATE(added)
                            ORDER BY added ASC')"}
      <a href="{$weburl_admin}home/{$value->datum}" class="btn btn-small{if="isset($uri.subblock) && $uri.subblock == $value->datum"} active{/if}">{$core::getCzechDate($value->datum)} ({$value->pocet})</a>
      {emptyloop}
      <div class="prispevek zadny_prispevek">Žádné vzkazy</div>
      {/loop}
    </div>
    <div class="chat_obal">
{if="$history"}
      {loop="$db->rawQuery('SELECT idshoutboard, login, alias, avatar, _r.name role, message, _s.added FROM shoutboards _s
                            JOIN users USING(iduser)
                            JOIN roles _r USING(idrole)
                            WHERE DATE(_s.added)=?
                            ORDER BY _s.added ASC', array($history))"}
      <div class="prispevek {$counter1 % 2 == 0 ? 'lichy_prispevek' : 'sudy_prispevek'}">
        <div class="levy_blok">
          <img src="{$weburl}img/avatars/{$value->avatar}" alt="" onerror="this.src='{$weburl}img/avatars/no-profile-img.png'" />
        </div>
        <div class="pravy_blok">
          <p class="autor">{$value->login}{if="$value->alias"} ({$value->alias}){/if}&nbsp;&nbsp;[{$value->role}]</p>
          <p class="datum">{$core::getCzechDateTime($value->added)}</p>
          <div class="zprava">{$value->message}</div>
        </div>
        {if="in_array($user->getId(), array(1, 2))"}<a href="javascript:deleteMessage({$value->idshoutboard})" class="smazat_vzkaz" onclick="return confirm('Opravdu chcete smazat tento vzkaz?')">Smazat vzkaz</a>{/if}
      </div>
      {emptyloop}
      <div class="prispevek zadny_prispevek">Žádný vzkaz</div>
      {/loop}
    </div><!-- /chat_obal -->
{else}
      <div class="chat_content">
        {loop="$db->rawQuery('SELECT idshoutboard, login, alias, avatar, _r.name role, message, _s.added FROM shoutboards _s
                              JOIN users USING(iduser)
                              JOIN roles _r USING(idrole)
                              WHERE _s.added >= (NOW() - INTERVAL ? DAY)
                              ORDER BY _s.added ASC', array(1))"}
        <div class="prispevek {$counter1 % 2 == 0 ? 'lichy_prispevek' : 'sudy_prispevek'}">
          <div class="levy_blok">
            <img src="{$weburl}img/avatars/{$value->avatar}" alt="" onerror="this.src='{$weburl}img/avatars/no-profile-img.png'" />
          </div>
          <div class="pravy_blok">
            <p class="autor">{$value->login}{if="$value->alias"} ({$value->alias}){/if}&nbsp;&nbsp;[{$value->role}]</p>
            <p class="datum">{$core::getCzechDateTime($value->added)}</p>
            <div class="zprava">{$value->message}</div>
          </div>
        </div>
        {emptyloop}
        <div class="prispevek zadny_prispevek">Žádný vzkaz</div>
        {/loop}
      </div>
    </div><!-- /chat_obal -->
    <form method="post" autocomplete="off" class="mws-form">
      <div class="mws-button-row">
        <textarea name="message" class="ajax_message autosize"></textarea>
        <input type="button" name="chat_button" value="Odeslat" class="btn btn-small btn-primary btn-primary18 chatsendbutton" onclick="sendMessage('.chat_content');" ondblclick="return false;" disabled /> <a href="#" onclick="return getListMessages('.chat_content', true);" ondblclick="return false;" class="btn btn-small">Obnovit chat</a>
      </div>
    </form>
{/if}
  </div>
</div>