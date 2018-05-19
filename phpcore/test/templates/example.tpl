A: {$promennaA}
B: <p>{$promennaB}</p>
C: <i>{$promennaC}</i>
ternar 1: {#true ? "ahoj" : "neahoj"}
ternar 2: {#false ? "ahoj" : "neahoj"}
ternar 3: {$promennaB ? "ahoj" : "neahoj"}
ternar 4: {$active ? 'class="active"' : 'class="inactive"'}
pocet pismen (ignoruje UTF-8): {$pokusText|strlen}
pocet pismen (neignoruje UTF-8): {$pokusText|mb_strlen:'UTF-8'}
nekolik pismen: {$pokusText|substr:0,6}
nekolik pismen: {$pokusText|mb_substr:0,6,'UTF-8'}
prazdny radek vypoctu: {$a = 2}{$a = $a + 2}{$a}
nekorektne: {$promennaPole}
index pole: {$promennaPole.a},{$promennaPole.c}
konstanta 1: {#PHP_VERSION#}
konstanta 2: {#PHP_OS#}
konstanta 3: {#true#}
konstanta 4: {#PHP_VERSION|strlen|round|count}
neparsovani: {noparse}ahoj {#PHP_VERSION#} se neparsuje{/noparse}
neparsovani2: {noparse}{{loginForm.input.\$valid}}{/noparse}
podminka 1: {if="$promennaPole.a==1"}pole.a==1{/if}
podminka 2:{if="$promennaPole.a==2"}pole.a==1{/if}
podminka 3: {if="$promennaPole.a==1"}pole.a==2{else}pole.a!=2{/if}
podminka 4: {if="$promennaPole.a==2"}pole.a==2{else}pole.a!=2{/if}
podminka 5: {if="$promennaPole.a==3"}je a 3{elseif="$promennaPole.a==2"}je a 2{elseif="$promennaPole.a==1"}je a 1{else}je a neco jineho{/if}
podminka 6: {if="$promennaPole.a|is_string"}True{else}False{/if}
podminka 7: {if="$promennaPole.a|!is_string"}True{else}False{/if}
html: {$html::div()->setText('ahoj svete!')}
html objekt: {$htmlObjekt->id('ahoj')->setText('textik')}
loop:
pole: {loop="$promennaPole"}{$key}->{$value},{/loop}
pole obracene: {loop="$promennaPole|array_reverse"}{$key}->{$value},{/loop}
prazdne pole: {loop="$prazdnePole"}{$key}, {$value}{emptyloop}zadna polozka{/loop}
pokusna podminka: {if="true"}ano{else}ne{/if}
podminka a loop1: {if="false"}{loop="array()"}...{/loop}{else}prazdne{/if}
podminka a loop2: {loop="array()"}...{emptyloop},,,{/loop}
podminka a loop3: {loop="array(1)"}...{emptyloop}prazdne{/loop}
podminka a loop4: {loop="array(1, 2, 3)"}{if="$value == 2"}...{else},,,{/if}{emptyloop}prazdne{/loop}
podminka a loop5: {loop="array()"}...{emptyloop}prazdne{/loop}
podminka a loop6: {loop="array()"}{if="$value == 2"}...{else},,,{/if}{emptyloop}prazdne{/loop}
pole break: {loop="$promennaPole"}{if="$key=='b'"}{break}{/if}{$key}->{$value},{/loop}
pole vlastni value: {loop="$promennaPole" as $val}{$key}={$val},{/loop}
pole vlastni klic a value: {loop="$promennaPole" as $k => $v}{$poc=$counter1+1}{$counter1})[{$poc}]# {$k}={$v},{/loop}
multi pole 1: {loop="$multiPole"}[{$key}] ({loop="$value"}{$value}, {/loop}){/loop}
multi pole 2: {loop="$multiPole"}[{$counter1} - {$key}] ({loop="$value"}{$counter2} - {$value}, {/loop}){/loop}
pole z funkce 1: {loop="range(5,10)" as $i}{$counter1 % 2 + 1}: {$i},{/loop}
pole z funkce 2: {loop="range(5,10)|array_reverse" as $i}{$counter1 % 2 + 1}: {$i},{/loop}
pole z pole 1: {loop="$multiPole.b"}{$value},{/loop}
pole z pole 2: {loop="$multiPole.b|array_reverse"}{$value},{/loop}
funkce print_r 1: {$promennaPole|print_r:true}
funkce print_r 2: {function="print_r($promennaPole, true)"}
timestamp: {function="strtotime('now')"}
datum 1: {date=""}
datum 2: {date="d.m.Y"}
datum 3: {date="d.m.Y H:i:s",strtotime('+1 day')}
datum 4: {function="date('d-m-Y')"}
datum 5: {date="d.m.Y H:i:s",'+1 day'|strtotime}
datum 6: {date_str=""}
datum 7: {date_str="d.m.Y H:i:s"}
datum 8: {date_str="d.m.Y H:i:s",'+1 day'}
datum 9: {date_str="",'now'}
datum10: {$cas = array('vyprsi' => array('ted' => '1 hour'))}{date="",'+'.$cas.vyprsi.ted|strtotime}
datum11: {date_str="",'+'.$cas.vyprsi.ted}
preklad 1: {@prekladany test@}
preklad 2.1: {@otevrene okno|otevrena okna|1@}
preklad 2.2: {@otevrene okno|otevrena okna|2@}
komentar:{* koment *}
komentar2:{/* dalsi super komentar */}
vlozeno: {include="paticka"}
{code}
  $ax = 1;
  $bx = 2;
  $cx = $ax + $bx;
{/code}
vypocet z code: {$cx}
include funkce: {include="$pokus::getPath()"}
kompilace: {compile="$code"}