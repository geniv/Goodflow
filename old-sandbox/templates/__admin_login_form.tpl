
{$f = $form::get()}
{$f->addText('login')
    ->setRequired('Je nutne vyplnit login')
  ->addPassword('hash')
    ->setRequired('Je nutne vyplnit heslo')
  ->addSubmit('tl', null, _('Přihlásit'))}

{if="$f->isSubmitted()"}
  {if="$f->isValid()"}
    {code}
      $val = $f->getValues(); // nacteni hodnot
      $user->login($val['login'], $val['hash']);  // predani udaju na uzivatele

      if ($user->isLoggedIn()) {
        $out = 'prihlaseno .. cekejte na presmarovani<br />';
      } else {
        $out = 'sorry blbe loginy..';
      }

    {/code}
    {$out}
  {else}
    {loop="$f->getErrors()"}
      chyba {$key+1}: {$value} :D HA-HA<br />
    {/loop}
  {/if}
{/if}

{if="$user->isLoggedIn()"}
  {$core::setRefresh(1, $admin_url)}
  pokud to nejde kilkej <a href="{$admin_url}">sem</a>
{/if}