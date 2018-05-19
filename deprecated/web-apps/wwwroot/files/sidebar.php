        <div class="content_right">
          <div class="article">
            <form action="index.php" method="post">
              <table width="100%">
                <tr>
                  <td valign="top" align="left">Meno: </td>
                  <td valign="top" align="left"><input type="text" name="name" value="" /></td>
                </tr>
                <tr>
                  <td valign="top" align="left">Heslo: </td>
                  <td valign="top" align="left"><input type="password" name="password" /></td>
                </tr>
                <tr>
                  <td valign="top" align="left"></td>
                  <td valign="top" align="left"><input type="submit" name="action" value="Prihlásiť" /></td>
                </tr>
              </table>
            </form>
          </div>
          <div class="article">
            <h2>Aktuálne projekty</h2>
            <ul class="list">
              <li>&raquo;&nbsp;<a class="link" href="<?php print(URL); ?>projekt.php?nazov=mailto" title="Mailto" target="_self">Mailto</a></li>
            </ul>
          </div>
          <div class="article">
            <h2>Anketa</h2>
            <?php
                $voting_action = mysql_query(" SELECT * FROM voting ");
                $voting        = mysql_fetch_assoc($voting_action);
            ?>
            <h3><?php print($voting["question"]); ?></h3>
            <ul class="list">
            <?php
                $pocet_a = mysql_num_rows(mysql_query(" SELECT * FROM voting_zoznam WHERE odpoved='a' "));
                $pocet_b = mysql_num_rows(mysql_query(" SELECT * FROM voting_zoznam WHERE odpoved='b' "));
            ?>
              <li>&nbsp;&nbsp;<a class="link" href="<?php print(URL); ?>hlasuj.php?odpoved=a" title="<?php print($voting["answer_a"]); ?>" target="_self"><?php print($voting["answer_a"]); ?></a> <span class="time">(<?php print($pocet_a); ?>)</span><br /><img src="<?php print(URL); ?>images/a.png" width="<?php print($pocet_a); ?>" height="3" border="0" alt="<?php print($voting["answer_a"]); ?>" /></li>
              <li>&nbsp;&nbsp;<a class="link" href="<?php print(URL); ?>hlasuj.php?odpoved=b" title="<?php print($voting["answer_b"]); ?>" target="_self"><?php print($voting["answer_b"]); ?></a> <span class="time">(<?php print($pocet_b); ?>)</span><br /><img src="<?php print(URL); ?>images/b.png" width="<?php print($pocet_b); ?>" height="3" border="0" alt="<?php print($voting["answer_b"]); ?>" /></li>
            </ul>
          </div>
          <div class="article">
            <h2>Kam ďalej</h2>
              <ul class="list">
                <li>&raquo;&nbsp;<a class="link" href="<?php print(URL); ?>index.php" title="Domov" target="_self">Domov</a></li>
                <li>&raquo;&nbsp;<a class="link" href="<?php print(URL); ?>projekty.php" title="Projekty" target="_self">Projekty</a></li>
                <li>&raquo;&nbsp;<a class="link" href="<?php print(URL); ?>" title="Pridajte sa" target="_self">Pridajte sa</a></li>
                <li>&raquo;&nbsp;<a class="link" href="<?php print(URL); ?>" title="Kontakty" target="_self">Kontakty</a></li>
                <li>&raquo;&nbsp;<a class="link" href="http://www.facebook.com/profile.php?id=1840875877&ref=profile" title="Facebook" target="_self">Martin Kravec - Facebook</a></li>
              </ul>
          </div>
          <div class="article">
            <h2>Oficiálne príručky</h2>
              <ul class="list">
                <li>&raquo;&nbsp;<a class="link" href="http://www.php.net/" title="PHP" target="_self" rel="nofollow">PHP</a></li>
                <li>&raquo;&nbsp;<a class="link" href="http://dev.mysql.com/doc/refman/5.1/en/" title="MySQL" target="_self" rel="nofollow">MySQL</a></li>
                <li>&raquo;&nbsp;<a class="link" href="http://www.w3.org/TR/xhtml1/" title="XHTML" target="_self" rel="nofollow">XHTML</a></li>
              </ul>
          </div>
        </div>
