    <div class="clear"></div>

    <div class="block_titleline">
      <h1>Přihlásit se</h1>

      <div class="block_search">
        <div class="field"><input type="text" class="w_def_text" title="Hledat"></div>
        <input type="submit" class="button" value="Hledat">
      </div>
    </div>

    <div class="block_breadcrumbs">
      <ul>
        <li><a href="{$weburl}">Home</a></li>
        <li>Přihlásit se</li>
      </ul>
    </div>

    <div class="h_line"></div>
  </header>
  <!-- End Head -->
  <div class="separator_1"></div>
{loop="$prihlasovaci_formular_out"}
  {$value}
{/loop}

{if="!$prihlasovaci_formular_send"}
{$prihlasovaci_formular}
{/if}