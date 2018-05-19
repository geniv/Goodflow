          <div class="row tcz_nadpisy">
            <div class="col-lg-12">
              <h2>{@Odkazy@}</h2>
            </div>
          </div>
<div id="obal_odkazy">
  {loop="$db->rawQuery('SELECT idlink_category, languages_has_links_category.name name FROM links_category
                        JOIN languages_has_links_category USING(idlink_category)
                        JOIN languages USING(idlanguage)
                        WHERE languages.code=?
                        ORDER BY languages_has_links_category.name ASC', array($current_language))"}
  <h3>{$value->name}</h3>
  <ul>
  {loop="$crate->getListLinks($value->idlink_category)"}
    <li>
      <a href="{$value->url}" title="{$value->name}" target="_blank">
        <span class="obal_obrazek">
          <img src="{$weburl}img/links/{$value->picture}" alt="{$value->name}" onerror="this.src='{$weburl}img/links/no-img.png'" class="img-thumbnail" />
        </span>
        <span>
          <strong>{$value->name}</strong>
          <em>{$value->url}</em>
        </span>
      </a>
    </li>
  {emptyloop}
    <li class="alert alert-info text-center">
      <p>{@Žádný odkaz@}</p>
    </li>
  {/loop}
  </ul>
  {/loop}
</div>
