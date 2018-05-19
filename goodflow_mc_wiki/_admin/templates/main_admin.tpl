
    <div id="obal">
      <p>ahoj svete, toto je uptra brutalni admin rozhranni!</p>
přihlášen jako uživatel: <strong>{$user_identity->getData('login')}</strong>
      <nav>
{$html::ul()->add($index_menu)->setDepth(4)}
      </nav>
<div>{$index_content}</div>

<br />
{$configure.session.expire}, {date="d.m.Y H:i:s",$authTime}, {date="Y-m-d H:i:s",$expireTime}
    </div>
  
