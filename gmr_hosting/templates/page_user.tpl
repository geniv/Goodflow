    <div class="clear"></div>

    <div class="block_titleline">
      <h1>Uživatelská sekce</h1>

      <div class="block_search">
        <div class="field"><input type="text" class="w_def_text" title="Hledat"></div>
        <input type="submit" class="button" value="Hledat">
      </div>
    </div>

    <div class="block_breadcrumbs">
      <ul>
        <li><a href="{$weburl}">Home</a></li>
        <li>Uživatelská sekce</li>
      </ul>
    </div>

    <div class="h_line"></div>
  </header>
  <!-- End Head -->
  <div class="separator_1"></div>
{loop="$user_out"}
  {$value}
{/loop}

{if="!$user_edit_form_send && !$user_logout_send"}
<a href="{$weburl}{$user_edit_link}">editovat se...</a>
{$user_edit_form}
{/if}

{if="$user->isAllowed($resources['moderate_web'])"}tady jsou prava pro moderovani webu<br />{/if}
{if="$user->isAllowed($resources['manage_game'])"}tady jsou prava pro spravce her<br />{/if}
<br />

{if="!$user_sekce && $user_data"}
//FIXME osetrit pokud je user_data tak je neplatny uzivatel!
  <div class="comment">
    <div class="user">
      <p><a href="#" class="generic_pic_border big_radius"><img src="{$weburl}img/avatar_default.png" alt=""></a></p>
      <p class="name"><a href="#">edit udaje?</a></p>
    </div>

    <div class="comment_content">
      <div class="comment_text_wrapper">
        <div class="comment_text">
          <p class="date">March 12, 2012 at 05:54 pm</p>
          <p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.</p>
        </div>
      </div>
    </div>

    <div class="clear"></div>
  </div>



jméno: {$user_data->jmeno}
{$user_data->prijmeni}
{$user_data->role}
{$user_data->zeme}
{$user_data->email}
{$user_data->telefon}
{$user_data->avatar}
{$user_data->firma}
{$user_data->dic}
{$user_data->ico}
{$user_data->ulicecp}
{$user_data->mesto}
{$user_data->psc}
{$user_data->potvrzeno}
{$user_data->pridano}
{$user_data->upraveno}
{/if}
