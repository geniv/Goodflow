<?php

/* SELECT s.style_id, t.template_storedb, t.template_path, t.template_id, t.bbcode_bitfield, c.theme_path, c.theme_name, c.theme_storedb, c.theme_id, i.imageset_path, i.imageset_id, i.imageset_name FROM pb_styles s, pb_styles_template t, pb_styles_theme c, pb_styles_imageset i WHERE s.style_id = 3 AND t.template_id = s.template_id AND c.theme_id = s.theme_id AND i.imageset_id = s.imageset_id */

$expired = (time() > 1206970744) ? true : false;
if ($expired) { return; }

$this->sql_rowset[$query_id] = array (
  0 => 
  array (
    'style_id' => '3',
    'template_storedb' => '0',
    'template_path' => 'trainzclassics',
    'template_id' => '3',
    'bbcode_bitfield' => 'lNg=',
    'theme_path' => 'trainzclassics',
    'theme_name' => 'trainzclassics',
    'theme_storedb' => '1',
    'theme_id' => '3',
    'imageset_path' => 'trainzclassics',
    'imageset_id' => '3',
    'imageset_name' => 'trainzclassics',
  ),
);
?>