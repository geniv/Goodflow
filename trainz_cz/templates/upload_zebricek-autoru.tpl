          <div class="row tcz_nadpisy">
            <div class="col-lg-12">
              <h2>{$menu->getVariable('name')}</h2>
            </div>
          </div>
          <div class="clearfix vypisy_top">
            <div class="col-lg-4 col-lg-offset-4">
              <ol>
                {loop="$db->rawQuery('SELECT login, alias, author, COUNT(iduser) + COUNT(author) pocet FROM downloads _d
                                      LEFT JOIN users _u USING(iduser)
                                      WHERE
                                      _d.confirmed=1 AND
                                      _d.visible=1 AND
                                      _d.deleted IS NULL
                                      GROUP BY iduser, author
                                      ORDER BY pocet DESC, COALESCE(login, author) ASC')"}
                <li{if="$counter1 == 9"} class="oddelovac"{/if}>
                  <a href="{$weburl}download/autor/{$value->login}{$value->author}">{if="$value->author"}{$value->author}{else}{$value->login}{if="$value->alias"} ($value->alias){/if}{/if}</a>
                  <span class="badge pull-right">{$value->pocet} {$core::getCzechPlural($value->pocet, array('objekt', 'objekty', 'objektů'))}</span>
                  <span class="konec_obtekani"></span>
                </li>
                {/loop}
              </ol>
            </div>
          </div>
