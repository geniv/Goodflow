<?php

/* SELECT m.*, u.user_colour, g.group_colour, g.group_type FROM (pb_moderator_cache m) LEFT JOIN pb_users u ON (m.user_id = u.user_id) LEFT JOIN pb_groups g ON (m.group_id = g.group_id) WHERE m.display_on_index = 1 AND m.forum_id IN (2, 48, 4, 5, 6, 7, 24, 25, 26, 9, 10, 11, 20, 21, 49, 28, 22, 23, 27, 29, 30, 32, 13, 33, 38, 34, 35, 36, 37) */

$expired = (time() > 1206970744) ? true : false;
if ($expired) { return; }

$this->sql_rowset[$query_id] = array (
);
?>