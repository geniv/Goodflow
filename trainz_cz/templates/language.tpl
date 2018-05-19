      <ul id="language_change">{loop="$language->getListLanguage()"}
        <li id="langicon_{$key}">
          <a href="{$weburl}{$lang_url}/{$key}"{$current_language == $key ? ' class="active"' : ''}>{$translate.lang_code.$key}</a>
        </li>      {/loop}
      </ul>