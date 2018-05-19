<?php

/* SELECT m.*, u.user_colour, g.group_colour, g.group_type FROM (pb_moderator_cache m) LEFT JOIN pb_users u ON (m.user_id = u.user_id) LEFT JOIN pb_groups g ON (m.group_id = g.group_id) WHERE m.display_on_index = 1 AND m.forum_id IN (2, 48, 4, 5, 6, 7) */

$expired = (time() > 1206970684) ? true : false;
if ($expired) { return; }

$this->sql_rowset[$query_id] = array (
);
?>