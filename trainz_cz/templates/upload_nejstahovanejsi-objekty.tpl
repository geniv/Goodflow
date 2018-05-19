          <div class="row tcz_nadpisy">
            <div class="col-lg-12">
              <h2>{$menu->getVariable('name')}</h2>
            </div>
          </div>
          <div class="clearfix vypisy_top">
            <div class="col-lg-10 col-lg-offset-1">
              <ol>
{loop="$db->rawQuery('SELECT _lhd.name, _tc.name cdp_name, _tc.counter FROM trainz_cdp _tc
                      JOIN downloads_has_trainz_cdp USING(idtrainz_cdp)
                      JOIN languages_has_downloads _lhd USING(iddownload)
                      WHERE idlanguage=1 AND counter>1
                      ORDER BY counter DESC, _lhd.name ASC
                      LIMIT 0,30')"}
                <li{if="$counter1 == 9"} class="oddelovac"{/if}>
                  <p>{$value->name}, [{$value->cdp_name}]</p>
                  <span class="badge pull-right">{$value->counter}x</span>
                  <span class="konec_obtekani"></span>
                </li>
{emptyloop}
                <li>Žádný objekt</li>
{/loop}
              </ol>
            </div>
          </div>
