{code}//<?
  $count_download = $db->query('downloads', 'COUNT(iddownload) pocet', 'iduser=? AND confirmed=1 AND deleted IS NULL', array($upload_user->getId()))->getFirst()->pocet;
  $count_slideshow = $db->query('slideshows', 'COUNT(idslideshow) pocet', 'iduser=? AND confirmed=1', array($upload_user->getId()))->getFirst()->pocet;

  //~ $count_confirm_download = $db->query('downloads', 'COUNT(iddownload) pocet', 'confirmed=1 AND visible=1 AND deleted IS NULL AND iduser=?', array($upload_user->getId()))->getFirst()->pocet;
  //~ $count_confirm_slideshow = $db->query('slideshows', 'COUNT(idslideshow) pocet', 'confirmed=1 AND iduser=?', array($upload_user->getId()))->getFirst()->pocet;

  $download_counter = $db->rawQuery('SELECT SUM(counter) pocet FROM downloads
                                    JOIN downloads_has_trainz_cdp USING(iddownload)
                                    JOIN trainz_cdp USING(idtrainz_cdp)
                                    WHERE deleted IS NULL AND iduser=?', array($upload_user->getId()))->getFirst()->pocet;

  $register = classes\Core::getCzechDate($db->query('users', 'added', 'iduser=?', array($upload_user->getId()))->getFirst()->added);
{/code}
<div class="obal_upload_home">
  <div class="well well-sm">
    <ul class="list-group ">
      <li class="list-group-item">
        <h4>Vítejte v upload sekci stránek Trainz.cz</h4>
      </li>
    </ul>
    <ul class="list-group ">
      <li class="list-group-item">
        <span class="badge">{$count_download}</span>
        Celkový počet Vašich objektů / map
      </li>
      <li class="list-group-item">
        <span class="badge">{$count_slideshow}</span>
        Celkový počet Vašich screenshotů
      </li>
    </ul>
{/*
    <ul class="list-group ">
      <li class="list-group-item">
        <span class="badge">{$count_confirm_download}</span>
        Celkový počet Vašich schválených objektů / map
      </li>
      <li class="list-group-item">
        <span class="badge">{$count_confirm_slideshow}</span>
        Celkový počet Vašich schválených screenshotů
      </li>
    </ul>
*/}
    <ul class="list-group ">
      <li class="list-group-item">
        <span class="badge">{$download_counter ?: 0}x</span>
        Vaše objekty / mapy byly celkově staženy
      </li>
    </ul>
    <ul class="list-group ">
      <li class="list-group-item">
        <span class="badge">{$register}</span>
        Jste registrován od
      </li>
    </ul>
  </div>
</div>