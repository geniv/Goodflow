<?php
/**
 * This file is part of GameQ.
 *
 * GameQ is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * GameQ is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * $Id: gamespy3.php,v 1.5 2009/03/07 16:35:18 tombuskens Exp $
 */

  namespace classes\GameQ\Protocol;

  use classes\GameQ\Protocol;

/**
 * Gamespy 3 Protocol
 *
 * @author         Tom Buskens <t.buskens@deviation.nl>
 * @version        $Revision: 1.5 $
 */
class Minecraft extends gamespy4 {
    protected $name = "minecraft";
    protected $name_long = "Minecraft";

    protected $port = 25565;
}
?>
