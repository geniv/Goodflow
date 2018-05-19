          <div class="row tcz_nadpisy">
            <div class="col-lg-12">
              <h2>{@Registrace autora@}</h2>
            </div>
          </div>
          <p>{@Autoři se mohou zaregistrovat a mají pak možnost nahrávat své objekty/mapy či screenshoty.@}</p>
          <p>{@Po úspěšné registraci dojde autorovi email s jeho přístupovými údaji. Žádost o registraci bude předložena administrátorům a po schválení dojde autorovi email s tím, že jeho žádost byla potvrzena a může se již přihlásit do upload sekce. Před samotným nahráváním objektů/map či screenshotů musí ještě autor ověřit svůj email, poté už má přístup k nahrávání.@}</p>
          <p>{@Samotný proces nahrávání pak probíhá stylem, že autor nahraje své objekty/mapy nebo screenshoty a ty pak administrátoři schválí nebo zamítnou.@}</p>
<br />
{code}//<?
$registrationForm = classes\TplForm::compile('
    <div class="form-group">
      <label for="inputLogin" class="col-lg-3 control-label">Login</label>
      <div class="col-lg-9">
        {text:login|$|placeholder|:|Login|,|class|:|form-control required|,|id|:|inputLogin|,|data-content|:|<strong>Povinné pole!</strong><br /><strong>Minimální délka loginu: 3 znaky!</strong>|,|maxlength|:|45|@|filled|:|Musí být vyplněn Login!|,|minlength|:|Minimální délka loginu musí být %s znaky!|:|3}
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-3 control-label">Heslo</label>
      <div class="col-lg-9">
        {password:hash|$|placeholder|:|Heslo|,|class|:|form-control required|,|id|:|inputPassword|,|data-content|:|<strong>Povinné pole!</strong><br /><strong>Minimální délka hesla: 6 znaků!</strong>|,|maxlength|:|45|@|filled|:|Musí být vyplněno Heslo!|,|minlength|:|Minimální délka hesla musí být %s znaků!|:|6}
      </div>
    </div>
    <div class="form-group">
      <label for="inputPasswordAgain" class="col-lg-3 control-label">Heslo znovu</label>
      <div class="col-lg-9">
        {password:hash_kontrola|$|placeholder|:|Heslo znovu|,|class|:|form-control required|,|id|:|inputPasswordAgain|,|data-content|:|<strong>Povinné pole!</strong><br /><strong>Hesla musí být totožná!</strong>|,|maxlength|:|45|@|filled|:|Musí být vyplněno Heslo znovu!|,|equalinput|:|Hesla musí být totožná!|:|hash|,|minlength|:|Minimální délka hesla musí být %s znaků!|:|6}
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-3 control-label">Email</label>
      <div class="col-lg-9">
        {text:email|$|placeholder|:|Email|,|class|:|form-control required|,|id|:|inputEmail|,|data-content|:|<strong>Povinné pole!</strong><br /><strong>Email musí mít správný tvar!</strong>|,|maxlength|:|100|@|filled|:|Musí být vyplněn Email!|,|email|:|Email musí mít správný tvar!}
      </div>
    </div>
    <div class="form-group">
      <label for="inputJmeno" class="col-lg-3 control-label">Jméno</label>
      <div class="col-lg-9">
        {text:alias|$|placeholder|:|Jméno|,|class|:|form-control|,|id|:|inputJmeno|,|data-content|:|Nepovinné pole.<br />Jméno se pak zobrazuje u screenshotů na úvodní straně a u objektů/map v závorce.<br />Doporučujeme vyplnit.|,|maxlength|:|50}
      </div>
    </div>
    <div class="form-group">
      <label for="inputDuvod" class="col-lg-3 control-label">Důvod</label>
      <div class="col-lg-9">
        {text:reason|$|placeholder|:|Důvod registrace|,|class|:|form-control required|,|id|:|inputDuvod|,|data-content|:|<strong>Povinné pole!</strong><br />Napište důvod, proč se chcete registrovat.|,|maxlength|:|50|@|filled|:|Musí být vyplněn důvod!}
      </div>
    </div>
    <div class="form-group upload_registrovatse">
      <div class="col-lg-offset-3 col-lg-9">
        {submit:;Registrovat|$|class|:|btn btn-primary}
      </div>
    </div>
', array('autocomplete' => 'off', 'class' => 'form-horizontal'))->setReturnValues($_POST, array('hash', 'hash_kontrola'))->setAutoHide(true)->setSubmitBlocker(false);
  $registrationForm->addRule('login', 'pattern', 'Login musí mít validní formát!', '[a-zA-Z0-9]{3,45}');
  $registrationForm_render = $registrationForm->render();
{/code}
{if="$registrationForm->isSubmitted()"}
  {if="$registrationForm->isValid()"}
    {code}
      $_values = $registrationForm->getValues();
      $cv = classes\ContentValues::init($_values)
          ->remove('hash_kontrola')
          ->remove($registrationForm->getSubmittedBy())
          ->put('hash', $core::getCleverHash($_values['login'], $_values['hash']))
          ->put('idrole', 1)
          ->putDate('added');
      $id_user = $db->insert('users', $cv);
      if ($id_user > 0) {
        // poslani emailu uzivatelovy
        classes\Emailer::factory(classes\Emailer::HTML)
            ->addTo($_values['email'])
            ->setFrom('admin@trainz.cz')
            ->setSubject('Registrace do autorské sekce Trainz.cz')
            ->setMessageArgs('Dobrý den,<br /><br />Vaše žádost o registraci do autorské sekce Trainz.cz byla předložena administrátorům ke schválení. Po schválení se budete moct přihlásit.<br /><br />Vaše přihlašovací údaje:<br />----------------------------<br />Login: %s<br />Heslo: %s<br />Email: %s<br />Jméno: %s<br />----------------------------<br /><br />Jakmile bude Vaše registrace schválena/zamítnuta, tak Vám dojde potvrzovací email.<br /><br />Děkujeme Vám za registraci.<br />--<br />Trainz.cz', $_values['login'], $_values['hash'], $_values['email'], $_values['alias'] ?: "-- nevyplněno --")
            ->send();

        // notifikace pro admina
        $crate->addNotification($id_user, null, $crate::TYPE_REGISTRATION, $id_user, null, $_values['login'], $_values['email']); // prenaseni loginu a emailu

        $msg = '
<div class="alert alert-success">
  <p><strong>Registrace proběhla úspěšně!</strong></p>
</div>
<div class="alert alert-info">
  <p>Na zadanou emailovou adresu byly zaslány přihlašovací údaje.</p>
  <p>Vaše registrace bude předložena administrátorům ke schválení.</p>
  <p>Po schválení se budete moct přihlásit.</p>
</div>';
      } else {
        $msg = '
<div class="alert alert-danger">
  <h4>Nastala tato chyba:</h4>
  <ul>
    <li>
      <p>Byl zadán existující Email nebo Login!</p>
    </li>
  </ul>
</div>';
      }
    {/code}
{$msg}
    {else}
<div class="alert alert-danger">
  <h4>Nastaly tyto chyby:</h4>
  <ul>
      {loop="$registrationForm->getErrors()"}
    <li>
      <p>{$value}</p>
    </li>
      {/loop}
  </ul>
</div>
<br />
  {/if}
{/if}
<div class="row">
  <div class="col-lg-5 col-lg-offset-1 div-validate">
{$registrationForm_render}
  </div>
</div>
<br />