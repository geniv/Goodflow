
{* {$configure.session.expire}, {date="d.m.Y H:i:s",$authTime}, {date="Y-m-d H:i:s",$expireTime} *}
  <nav>
    <ul>
      {loop="$web->getMenu(0)"}
       <li>
         <a href="{$weburl}{$value->allurl}"{if="$value->active"} class="current"{/if} title="">
           <i class="{$value->icon}"></i>
           {$value->name}
         </a>
       </li>
       {/loop}
    </ul>
  </nav><!--NAV ENDS HERE-->
  
  
  <aside>
    
    <div class="user">
      <img src="images/admin_{$spravce->getIdentity()->getId()}.png" alt="Esthetics Admin"/>
      {$spravce->getIdentity()->getData('login')}
      <p>doplnit sem něco</p>
    </div>

    <ul class="main-nav">
      {loop="$web_submenu->getMenu()"}
      <li>
        <p class="nav-top-item current">{$value->name_blok}</p>
        <ul>
          {loop="$value->submenu" as $v}
          <li><a href="{$weburl}{$menu_sekce}/{$v->allurl}"{if="$v->active"} class="active"{/if} title="">{$v->name}</a></li>
          {else}
          <li><a href="{$weburl}{$menu_sekce}"{if="$value->active"} class="active"{/if} title="">{$value->name_sekce}</a></li>
          {/loop}
        </ul>
      </li>
      {/loop}
    </ul>

  </aside><!--ASIDE ENDS HERE-->

  <div class="main">


{$index_content}
{*
   <div class="box _50">
    <div class="box-header">
      Full Calendar
    </div>
    <div class="box-content">
      <div id="calendar"></div>
    </div>
  </div> <!--CALENDAR ENDS HERE-->
*}

   <div class="box _100">
    <div class="box-header">
      Globální informace
    </div>
    <div class="box-content padd-10 no-padd-btm">
      <p>poslední aktualizace: {date="d.m.Y H:i:s"}<br />nastavená expirace: {$configure.session.expire}<br />vygenerováno: {$vygenerovano}</p>
    </div>
  </div>



{*
  <div class="box _50">
    <div class="box-header">
      Chatting Layout
      <i class="icon-remove-sign close" title="Close"></i>
      <i class="icon-minus-sign minimize" title="Minimize/Maximize"></i>
      </div>
    <div class="box-content  padd-10">
      <ul class="messages">
          <li class="incoming">
            <a href="#">
              <img src="images/user.jpg" />
            </a>
            <div class="message_area">
            <span class="arow"></span>
            <div class="message_info">
              <span class="sender">Akshay</span><span class="says">says :</span><span class="time">3 hours ago</span>
            </div>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vel est enim, vel eleifend felis. Ut volutpat, leo eget euismod scelerisque, eros purus lacinia velit, nec rhoncus mi dui eleifend orci.
            </div>
          </li>
          
          <li class="outgoing">
            <a href="#">
              <img src="images/user.jpg" />
            </a>
            <div class="message_area">
            <span class="arow"></span>
            <div class="message_info">
              <span class="sender">Akshay</span><span class="says">says :</span><span class="time">3 hours ago</span>
            </div>
              Ipsum dolor sit amet, consectetur adipiscing elit. Nam vel est enim, vel eleifend felis. Ut volutpat, leo eget euismod scelerisque, eros purus lacinia velit, nec rhoncus mi dui eleifend orci.<br/> <br/> Nam vel est enim, vel eleifend felis. Ut volutpat, leo eget euismod scelerisque, eros purus lacinia velit, nec rhoncus
            </div>
          </li>
          
          <li class="incoming">
            <a href="#">
              <img src="images/user.jpg" />
            </a>
            <div class="message_area">
            <span class="arow"></span>
            <div class="message_info">
              <span class="sender">Akshay</span><span class="says">says :</span><span class="time">3 hours ago</span>
            </div>
              leo eget euismod scelerisque, eros purus lacinia velit, nec rhoncus mi dui eleifend orci.
            </div>
          </li>
          
          <li>
            <input type="text" class="_75" placeholder="Message to Akshay" />
            <div class="float_r">
            <input type="reset" class="grey" />
            <input type="submit" value="Send" />
            </div>
          </li>
         
      </ul>
    </div>
  </div>  <!--MESSAGES ENDS HERE-->
*}

{*
  <div class="box _100">
    <div class="box-header">
      Dynamic Table Example
      <i class="icon-remove-sign close" title="Close"></i>
      <i class="icon-minus-sign minimize" title="Minimize/Maximize"></i>
      </div>
    <div class="box-content">
      <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dynamic">
                <thead>
                <tr>
                <th>Rendering engine<span class="sorting" style="display: block;"></span></th>
                <th>Browser</th>
                <th>Platform(s)</th>
                <th>Engine version</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                <td>Trident</td>
                <td>Internet
                Explorer 4.0</td>
                <td>Win 95+</td>
                <td class="center">4</td>
                </tr>
                <tr>
                <td>Trident</td>
                <td>Internet
                Explorer 5.0</td>
                <td>Win 95+</td>
                <td class="center">5</td>
                </tr>
                <tr>
                <td>Trident</td>
                <td>Internet
                Explorer 5.5</td>
                <td>Win 95+</td>
                <td class="center">5.5</td>
                </tr>
                <tr>
                <td>Trident</td>
                <td>Internet
                Explorer 6</td>
                <td>Win 98+</td>
                <td class="center">6</td>
                </tr>
                <tr>
                <td>Trident</td>
                <td>Internet Explorer 7</td>
                <td>Win XP SP2+</td>
                <td class="center">7</td>
                </tr>
                <tr>
                <td>Trident</td>
                <td>AOL browser (AOL desktop)</td>
                <td>Win XP</td>
                <td class="center">6</td>
                </tr>
                <tr>
                <td>Gecko</td>
                <td>Firefox 1.0</td>
                <td>Win 98+ / OSX.2+</td>
                <td class="center">1.7</td>
                </tr>
                <tr>
                <td>Gecko</td>
                <td>Firefox 1.5</td>
                <td>Win 98+ / OSX.2+</td>
                <td class="center">1.8</td>
                </tr>
                <tr>
                <td>Gecko</td>
                <td>Firefox 2.0</td>
                <td>Win 98+ / OSX.2+</td>
                <td class="center">1.8</td>
                </tr>
                <tr>
                <td>Gecko</td>
                <td>Firefox 3.0</td>
                <td>Win 2k+ / OSX.3+</td>
                <td class="center">1.9</td>
                </tr>
                <tr>
                <td>Gecko</td>
                <td>Camino 1.0</td>
                <td>OSX.2+</td>
                <td class="center">1.8</td>
                </tr>
                <tr>
                <td>Gecko</td>
                <td>Camino 1.5</td>
                <td>OSX.3+</td>
                <td class="center">1.8</td>
                </tr>
                <tr>
                <td>Gecko</td>
                <td>Netscape 7.2</td>
                <td>Win 95+ / Mac OS 8.6-9.2</td>
                <td class="center">1.7</td>
                </tr>
                <tr>
                <td>Gecko</td>
                <td>Netscape Browser 8</td>
                <td>Win 98SE+</td>
                <td class="center">1.7</td>
                </tr>
                <tr>
                <td>Gecko</td>
                <td>Netscape Navigator 9</td>
                <td>Win 98+ / OSX.2+</td>
                <td class="center">1.8</td>
                </tr>
                <tr>
                <td>Gecko</td>
                <td>Mozilla 1.0</td>
                <td>Win 95+ / OSX.1+</td>
                <td class="center">1</td>
                </tr>
                <tr>
                <td>Gecko</td>
                <td>Mozilla 1.1</td>
                <td>Win 95+ / OSX.1+</td>
                <td class="center">1.1</td>
                </tr>
                <tr>
                <td>Gecko</td>
                <td>Mozilla 1.2</td>
                <td>Win 95+ / OSX.1+</td>
                <td class="center">1.2</td>
                </tr>
                <tr>
                <td>Gecko</td>
                <td>Mozilla 1.3</td>
                <td>Win 95+ / OSX.1+</td>
                <td class="center">1.3</td>
                </tr>
                <tr>
                <td>Gecko</td>
                <td>Mozilla 1.4</td>
                <td>Win 95+ / OSX.1+</td>
                <td class="center">1.4</td>
                </tr>
                <tr>
                <td>Gecko</td>
                <td>Mozilla 1.5</td>
                <td>Win 95+ / OSX.1+</td>
                <td class="center">1.5</td>
                </tr>
                <tr>
                <td>Gecko</td>
                <td>Mozilla 1.6</td>
                <td>Win 95+ / OSX.1+</td>
                <td class="center">1.6</td>
                </tr>
                <tr>
                <td>Gecko</td>
                <td>Mozilla 1.7</td>
                <td>Win 98+ / OSX.1+</td>
                <td class="center">1.7</td>
                </tr>
                <tr>
                <td>Gecko</td>
                <td>Mozilla 1.8</td>
                <td>Win 98+ / OSX.1+</td>
                <td class="center">1.8</td>
                </tr>
                <tr>
                <td>Gecko</td>
                <td>Seamonkey 1.1</td>
                <td>Win 98+ / OSX.2+</td>
                <td class="center">1.8</td>
                </tr>
                <tr>
                <td>Gecko</td>
                <td>Epiphany 2.20</td>
                <td>Gnome</td>
                <td class="center">1.8</td>
                </tr>
                <tr>
                <td>Webkit</td>
                <td>Safari 1.2</td>
                <td>OSX.3</td>
                <td class="center">125.5</td>
                </tr>
                <tr>
                <td>Webkit</td>
                <td>Safari 1.3</td>
                <td>OSX.3</td>
                <td class="center">312.8</td>
                </tr>
                <tr>
                <td>Webkit</td>
                <td>Safari 2.0</td>
                <td>OSX.4+</td>
                <td class="center">419.3</td>
                </tr>
                <tr>
                <td>Webkit</td>
                <td>Safari 3.0</td>
                <td>OSX.4+</td>
                <td class="center">522.1</td>
                </tr>
                <tr>
                <td>Webkit</td>
                <td>OmniWeb 5.5</td>
                <td>OSX.4+</td>
                <td class="center">420</td>
                </tr>
                <tr>
                <td>Webkit</td>
                <td>iPod Touch / iPhone</td>
                <td>iPod</td>
                <td class="center">420.1</td>
                </tr>
                <tr>
                <td>Webkit</td>
                <td>S60</td>
                <td>S60</td>
                <td class="center">413</td>
                </tr>
                <tr>
                <td>Presto</td>
                <td>Opera 7.0</td>
                <td>Win 95+ / OSX.1+</td>
                <td class="center">-</td>
                </tr>
                <tr>
                <td>Presto</td>
                <td>Opera 7.5</td>
                <td>Win 95+ / OSX.2+</td>
                <td class="center">-</td>
                </tr>
                <tr>
                <td>Presto</td>
                <td>Opera 8.0</td>
                <td>Win 95+ / OSX.2+</td>
                <td class="center">-</td>
                </tr>
                <tr>
                <td>Presto</td>
                <td>Opera 8.5</td>
                <td>Win 95+ / OSX.2+</td>
                <td class="center">-</td>
                </tr>
                <tr>
                <td>Presto</td>
                <td>Opera 9.0</td>
                <td>Win 95+ / OSX.3+</td>
                <td class="center">-</td>
                </tr>
                <tr>
                <td>Presto</td>
                <td>Opera 9.2</td>
                <td>Win 88+ / OSX.3+</td>
                <td class="center">-</td>
                </tr>
                <tr>
                <td>Presto</td>
                <td>Opera 9.5</td>
                <td>Win 88+ / OSX.3+</td>
                <td class="center">-</td>
                </tr>
                <tr>
                <td>Presto</td>
                <td>Opera for Wii</td>
                <td>Wii</td>
                <td class="center">-</td>
                </tr>
                <tr>
                <td>Presto</td>
                <td>Nokia N800</td>
                <td>N800</td>
                <td class="center">-</td>
                </tr>
                <tr>
                <td>Presto</td>
                <td>Nintendo DS browser</td>
                <td>Nintendo DS</td>
                <td class="center">8.5</td>
                </tr>
                <tr>
                <td>KHTML</td>
                <td>Konqureror 3.1</td>
                <td>KDE 3.1</td>
                <td class="center">3.1</td>
                </tr>
                <tr>
                <td>KHTML</td>
                <td>Konqureror 3.3</td>
                <td>KDE 3.3</td>
                <td class="center">3.3</td>
                </tr>
                <tr>
                <td>KHTML</td>
                <td>Konqureror 3.5</td>
                <td>KDE 3.5</td>
                <td class="center">3.5</td>
                </tr>
                <tr>
                <td>Tasman</td>
                <td>Internet Explorer 4.5</td>
                <td>Mac OS 8-9</td>
                <td class="center">-</td>
                </tr>
                <tr>
                <td>Tasman</td>
                <td>Internet Explorer 5.1</td>
                <td>Mac OS 7.6-9</td>
                <td class="center">1</td>
                </tr>
                <tr>
                <td>Tasman</td>
                <td>Internet Explorer 5.2</td>
                <td>Mac OS 8-X</td>
                <td class="center">1</td>
                </tr>
                <tr>
                <td>Misc</td>
                <td>NetFront 3.1</td>
                <td>Embedded devices</td>
                <td class="center">-</td>
                </tr>
                <tr>
                <td>Misc</td>
                <td>NetFront 3.4</td>
                <td>Embedded devices</td>
                <td class="center">-</td>
                </tr>
                <tr>
                <td>Misc</td>
                <td>Dillo 0.8</td>
                <td>Embedded devices</td>
                <td class="center">-</td>
                </tr>
                <tr>
                <td>Misc</td>
                <td>Links</td>
                <td>Text only</td>
                <td class="center">-</td>
                </tr>
                <tr>
                <td>Misc</td>
                <td>Lynx</td>
                <td>Text only</td>
                <td class="center">-</td>
                </tr>
                <tr>
                <td>Misc</td>
                <td>IE Mobile</td>
                <td>Windows Mobile 6</td>
                <td class="center">-</td>
                </tr>
                <tr >
                <td>Misc</td>
                <td>PSP browser</td>
                <td>PSP</td>
                <td class="center">-</td>
                </tr>
                <tr class="gradeU">
                <td>Other browsers</td>
                <td>All others</td>
                <td>-</td>
                <td class="center">-</td>
                </tr>
                </tbody>
                </table>
    </div>
  </div>
*}

  </div><!--SHORTABLECONTENT-ENDS-->

  </div><!--MAIN ENDS-->