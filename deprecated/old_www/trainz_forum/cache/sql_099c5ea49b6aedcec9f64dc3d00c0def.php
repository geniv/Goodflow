<?php

/* SELECT forum_id, forum_name, parent_id, forum_type, left_id, right_id FROM pb_forums ORDER BY left_id ASC */

$expired = (time() > 1206967690) ? true : false;
if ($expired) { return; }

$this->sql_rowset[$query_id] = array (
  0 => 
  array (
    'forum_id' => '1',
    'forum_name' => 'Pro nováčky',
    'parent_id' => '0',
    'forum_type' => '0',
    'left_id' => '1',
    'right_id' => '6',
  ),
  1 => 
  array (
    'forum_id' => '2',
    'forum_name' => 'Nevím jak na to!?',
    'parent_id' => '1',
    'forum_type' => '1',
    'left_id' => '2',
    'right_id' => '3',
  ),
  2 => 
  array (
    'forum_id' => '48',
    'forum_name' => 'Časté problémy',
    'parent_id' => '1',
    'forum_type' => '1',
    'left_id' => '4',
    'right_id' => '5',
  ),
  3 => 
  array (
    'forum_id' => '3',
    'forum_name' => 'První dojmy',
    'parent_id' => '0',
    'forum_type' => '0',
    'left_id' => '7',
    'right_id' => '16',
  ),
  4 => 
  array (
    'forum_id' => '4',
    'forum_name' => 'Trainz v. 1.1.1 + SP4',
    'parent_id' => '3',
    'forum_type' => '1',
    'left_id' => '8',
    'right_id' => '9',
  ),
  5 => 
  array (
    'forum_id' => '5',
    'forum_name' => 'Trainz Railroad Simulator 2004',
    'parent_id' => '3',
    'forum_type' => '1',
    'left_id' => '10',
    'right_id' => '11',
  ),
  6 => 
  array (
    'forum_id' => '6',
    'forum_name' => 'Trainz Railroad Simulator 2006',
    'parent_id' => '3',
    'forum_type' => '1',
    'left_id' => '12',
    'right_id' => '13',
  ),
  7 => 
  array (
    'forum_id' => '7',
    'forum_name' => 'Trainz Classics',
    'parent_id' => '3',
    'forum_type' => '1',
    'left_id' => '14',
    'right_id' => '15',
  ),
  8 => 
  array (
    'forum_id' => '14',
    'forum_name' => 'Pro hráce',
    'parent_id' => '0',
    'forum_type' => '0',
    'left_id' => '17',
    'right_id' => '24',
  ),
  9 => 
  array (
    'forum_id' => '24',
    'forum_name' => 'Jízda v Trainz',
    'parent_id' => '14',
    'forum_type' => '1',
    'left_id' => '18',
    'right_id' => '19',
  ),
  10 => 
  array (
    'forum_id' => '25',
    'forum_name' => 'HW nároky na hru, sestavy PC, doporučená nastavení',
    'parent_id' => '14',
    'forum_type' => '1',
    'left_id' => '20',
    'right_id' => '21',
  ),
  11 => 
  array (
    'forum_id' => '26',
    'forum_name' => 'Nemůžete najít a nebo nevíte kde stáhnout objekty?',
    'parent_id' => '14',
    'forum_type' => '1',
    'left_id' => '22',
    'right_id' => '23',
  ),
  12 => 
  array (
    'forum_id' => '8',
    'forum_name' => 'CD Projekt: Uživatelská podpora',
    'parent_id' => '0',
    'forum_type' => '0',
    'left_id' => '25',
    'right_id' => '32',
  ),
  13 => 
  array (
    'forum_id' => '9',
    'forum_name' => 'Trainz Railroad Simulator 2004 (nebo starší)',
    'parent_id' => '8',
    'forum_type' => '1',
    'left_id' => '26',
    'right_id' => '27',
  ),
  14 => 
  array (
    'forum_id' => '10',
    'forum_name' => 'Trainz Railroad Simulator 2006',
    'parent_id' => '8',
    'forum_type' => '1',
    'left_id' => '28',
    'right_id' => '29',
  ),
  15 => 
  array (
    'forum_id' => '11',
    'forum_name' => 'Trainz Classics',
    'parent_id' => '8',
    'forum_type' => '1',
    'left_id' => '30',
    'right_id' => '31',
  ),
  16 => 
  array (
    'forum_id' => '15',
    'forum_name' => 'Zkušení hráči',
    'parent_id' => '0',
    'forum_type' => '0',
    'left_id' => '33',
    'right_id' => '66',
  ),
  17 => 
  array (
    'forum_id' => '39',
    'forum_name' => 'Obrázky a videa',
    'parent_id' => '15',
    'forum_type' => '0',
    'left_id' => '34',
    'right_id' => '51',
  ),
  18 => 
  array (
    'forum_id' => '40',
    'forum_name' => 'Obrázky',
    'parent_id' => '39',
    'forum_type' => '0',
    'left_id' => '35',
    'right_id' => '46',
  ),
  19 => 
  array (
    'forum_id' => '19',
    'forum_name' => 'Česká republika',
    'parent_id' => '40',
    'forum_type' => '1',
    'left_id' => '36',
    'right_id' => '39',
  ),
  20 => 
  array (
    'forum_id' => '44',
    'forum_name' => 'Ozubnicová, lanová a horská dráha',
    'parent_id' => '19',
    'forum_type' => '1',
    'left_id' => '37',
    'right_id' => '38',
  ),
  21 => 
  array (
    'forum_id' => '42',
    'forum_name' => 'Slovensko',
    'parent_id' => '40',
    'forum_type' => '1',
    'left_id' => '40',
    'right_id' => '43',
  ),
  22 => 
  array (
    'forum_id' => '45',
    'forum_name' => 'Ozubnicová, lanová a hroská draha',
    'parent_id' => '42',
    'forum_type' => '1',
    'left_id' => '41',
    'right_id' => '42',
  ),
  23 => 
  array (
    'forum_id' => '43',
    'forum_name' => 'Zahraničí',
    'parent_id' => '40',
    'forum_type' => '1',
    'left_id' => '44',
    'right_id' => '45',
  ),
  24 => 
  array (
    'forum_id' => '41',
    'forum_name' => 'Video',
    'parent_id' => '39',
    'forum_type' => '0',
    'left_id' => '47',
    'right_id' => '50',
  ),
  25 => 
  array (
    'forum_id' => '46',
    'forum_name' => 'Videa ze hry',
    'parent_id' => '41',
    'forum_type' => '1',
    'left_id' => '48',
    'right_id' => '49',
  ),
  26 => 
  array (
    'forum_id' => '20',
    'forum_name' => 'Tvorba a úprava map',
    'parent_id' => '15',
    'forum_type' => '1',
    'left_id' => '52',
    'right_id' => '53',
  ),
  27 => 
  array (
    'forum_id' => '21',
    'forum_name' => 'Tvorba objektů',
    'parent_id' => '15',
    'forum_type' => '1',
    'left_id' => '54',
    'right_id' => '57',
  ),
  28 => 
  array (
    'forum_id' => '47',
    'forum_name' => '[MHD] Městská hromadná doprava',
    'parent_id' => '21',
    'forum_type' => '1',
    'left_id' => '55',
    'right_id' => '56',
  ),
  29 => 
  array (
    'forum_id' => '49',
    'forum_name' => 'Autorské dílny',
    'parent_id' => '15',
    'forum_type' => '1',
    'left_id' => '58',
    'right_id' => '59',
  ),
  30 => 
  array (
    'forum_id' => '28',
    'forum_name' => 'Konverze objektů',
    'parent_id' => '15',
    'forum_type' => '1',
    'left_id' => '60',
    'right_id' => '61',
  ),
  31 => 
  array (
    'forum_id' => '22',
    'forum_name' => 'Plánky a textury pro tvůrce objektu',
    'parent_id' => '15',
    'forum_type' => '1',
    'left_id' => '62',
    'right_id' => '63',
  ),
  32 => 
  array (
    'forum_id' => '23',
    'forum_name' => 'Použití příkazů (jeď do...), tvorba scénářů a práce se skripty',
    'parent_id' => '15',
    'forum_type' => '1',
    'left_id' => '64',
    'right_id' => '65',
  ),
  33 => 
  array (
    'forum_id' => '17',
    'forum_name' => 'Zprávy ze zahraničí',
    'parent_id' => '0',
    'forum_type' => '0',
    'left_id' => '67',
    'right_id' => '70',
  ),
  34 => 
  array (
    'forum_id' => '27',
    'forum_name' => 'Recenze zahraničních objektů',
    'parent_id' => '17',
    'forum_type' => '1',
    'left_id' => '68',
    'right_id' => '69',
  ),
  35 => 
  array (
    'forum_id' => '16',
    'forum_name' => 'Skutečný svět',
    'parent_id' => '0',
    'forum_type' => '0',
    'left_id' => '71',
    'right_id' => '80',
  ),
  36 => 
  array (
    'forum_id' => '29',
    'forum_name' => 'Společenské akce',
    'parent_id' => '16',
    'forum_type' => '1',
    'left_id' => '72',
    'right_id' => '73',
  ),
  37 => 
  array (
    'forum_id' => '30',
    'forum_name' => 'Modelová železnice',
    'parent_id' => '16',
    'forum_type' => '1',
    'left_id' => '74',
    'right_id' => '77',
  ),
  38 => 
  array (
    'forum_id' => '31',
    'forum_name' => '1:22,5 G',
    'parent_id' => '30',
    'forum_type' => '1',
    'left_id' => '75',
    'right_id' => '76',
  ),
  39 => 
  array (
    'forum_id' => '32',
    'forum_name' => 'Skutečná železnice',
    'parent_id' => '16',
    'forum_type' => '1',
    'left_id' => '78',
    'right_id' => '79',
  ),
  40 => 
  array (
    'forum_id' => '12',
    'forum_name' => 'Help for you in foreign languages',
    'parent_id' => '0',
    'forum_type' => '0',
    'left_id' => '81',
    'right_id' => '84',
  ),
  41 => 
  array (
    'forum_id' => '13',
    'forum_name' => 'English (and other languages) forum about Trainz',
    'parent_id' => '12',
    'forum_type' => '1',
    'left_id' => '82',
    'right_id' => '83',
  ),
  42 => 
  array (
    'forum_id' => '18',
    'forum_name' => 'Ostatní',
    'parent_id' => '0',
    'forum_type' => '0',
    'left_id' => '85',
    'right_id' => '98',
  ),
  43 => 
  array (
    'forum_id' => '33',
    'forum_name' => 'Hydepark',
    'parent_id' => '18',
    'forum_type' => '1',
    'left_id' => '86',
    'right_id' => '87',
  ),
  44 => 
  array (
    'forum_id' => '38',
    'forum_name' => 'Pískoviště',
    'parent_id' => '18',
    'forum_type' => '1',
    'left_id' => '88',
    'right_id' => '89',
  ),
  45 => 
  array (
    'forum_id' => '34',
    'forum_name' => 'Technická správa',
    'parent_id' => '18',
    'forum_type' => '1',
    'left_id' => '90',
    'right_id' => '91',
  ),
  46 => 
  array (
    'forum_id' => '35',
    'forum_name' => 'Mimo mísu',
    'parent_id' => '18',
    'forum_type' => '1',
    'left_id' => '92',
    'right_id' => '93',
  ),
  47 => 
  array (
    'forum_id' => '36',
    'forum_name' => 'Dílna JediTrainz Team',
    'parent_id' => '18',
    'forum_type' => '1',
    'left_id' => '94',
    'right_id' => '95',
  ),
  48 => 
  array (
    'forum_id' => '37',
    'forum_name' => 'Trainz Klub',
    'parent_id' => '18',
    'forum_type' => '1',
    'left_id' => '96',
    'right_id' => '97',
  ),
);
?>