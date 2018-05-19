<?php
/*
 * openttdconfig.php
 *
 * Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use classes\Form,
      classes\Html,
      classes\HtmlPage,
      classes\Filesystem,
      classes\Language,
      classes\Core;
//TODO pro verejneou praci pouzivat sessionove ukladani souboru, rewrite
  class OpenTTDconfig {
    const VERSION = 2.11;

    const CONFIG_DIR = 'configs'; //adresar konfigu

    const T_BOOL = 'bool';  //true/false
    const T_TEXT = 'string'; //text
    const T_TEXTAREA = 'textarea';  //dlouhy text
    const T_INT = 'int';  //cislo
    const T_RANGE = 'range';  //rozsah cisel
    const T_SELECT = 'select';  //vyber hodnot
    //TODO jeste jeden typ na pridavani volitelnych textu

    private static $path, $weburl;

    public static function setPath($path = NULL, $weburl = NULL) {
      self::$path = $path;
      self::$weburl = $weburl;  //url webu
    }

    private static function getConfig() {
      $conf = array('misc' => array('display_opt' => array(self::T_TEXTAREA, NULL, 'SHOW_TOWN_NAMES|SHOW_STATION_NAMES|SHOW_SIGNS|FULL_ANIMATION|FULL_DETAIL|WAYPOINTS', _('display_opt')),
                                    'news_ticker_sound' => array(self::T_BOOL, NULL, true, _('Whether or not to play sounds when a news item appears along the status bar. This is a client-setting only.')),
                                    'fullscreen' => array(self::T_BOOL, NULL, false, _('Sets, whether OpenTTD is supposed to run in fullscreen-mode. This is a client-setting only.')),
                                    //~ 'graphicsset' => array(self::T_TEXT, NULL, '', _('graphicsset')),
                                    //~ 'soundset' => array(self::T_TEXT, NULL, '', _('soundset')),
                                    //~ 'musicset' => array(self::T_TEXT, NULL, '', _('musicset')),
                                    //~ 'soundsset' => array(self::T_TEXT, NULL, '', _('soundsset')),
                                    //~ 'videodriver' => array(self::T_TEXT, NULL, '', _('videodriver')),
                                    //~ 'musicdriver' => array(self::T_TEXT, NULL, '', _('musicdriver')),
                                    //~ 'sounddriver' => array(self::T_TEXT, NULL, '', _('sounddriver')),
                                    //~ 'blitter' => array(self::T_TEXT, NULL, '', _('blitter')),
                                    'language' => array(self::T_TEXT, NULL, 'english.lng', _('The language file to use for strings in the game. This is a client-setting only. See the lang directory for possible files, filename is the one to use. filename is case sensitive.')),
                                    'resolution' => array(self::T_TEXT, NULL, '640,480', _('The resolution the game will run in. This is a client-setting only. Where x and y represent a linear length in pixels.')),
                                    'screenshot_format' => array(self::T_SELECT, array('' => '', 'bmp' => _('bmp'), 'png' => _('png'), 'pcx' => _('pcx')), '', _('The format to use when taking screenshots. This is a client-setting only. "BMP" is the default setting')),
                                    'savegame_format' => array(self::T_SELECT, array('' => _('<empty> - Will use the best setting for your system (usually zlib, if support has been compiled in, otherwise none).'), 'memory' => _('memory - Unknown, does not appear to work.'), 'lzo' => _('lzo - Use lzo compression, does not appear to work.'), 'zlib' => _('zlib - Use zlib compression. This is only available if you have the game compiled with zlib support.'), 'none' => _('none - Use no compression.')), '', _('The save game format to use. This is a client-setting only. This should only be used for testing only, as the best option for your system will be selected by default.')),
                                    'rightclick_emulate' => array(self::T_BOOL, NULL, false, _('Enables right click emulation on systems that do not have a right mouse button. To use this press ctrl and then click (or hold) the left mouse button to perform actions as if you are clicking the right mouse button. This is a client-setting only. On OS X if you have an extended Macintosh keyboard the command key is used to instead of the ctrl key.')),
                                    //~ 'small_font' => array(self::T_TEXT, NULL, '', _('small_font')),
                                    //~ 'medium_font' => array(self::T_TEXT, NULL, '', _('medium_font')),
                                    //~ 'large_font' => array(self::T_TEXT, NULL, '', _('large_font')),
                                    //~ 'small_size' => array(self::T_TEXT, NULL, '', _('small_size')),
                                    //~ 'medium_size' => array(self::T_TEXT, NULL, '', _('medium_size')),
                                    //~ 'large_size' => array(self::T_TEXT, NULL, '', _('large_size')),
                                    //~ 'small_aa' => array(self::T_TEXT, NULL, '', _('small_aa')),
                                    //~ 'medium_aa' => array(self::T_TEXT, NULL, '', _('medium_aa')),
                                    //~ 'large_aa' => array(self::T_TEXT, NULL, '', _('large_aa')),
                                    //~ 'sprite_cache_size' => array(self::T_INT, NULL, 64, _('sprite_cache_size')),
                                    //~ 'player_face' => array(self::T_INT, NULL, '', _('player_face')),
                                    //~ 'transparency_options' => array(self::T_TEXT, NULL, '', _('transparency_options')),
                                    //~ 'transparency_locks' => array(self::T_TEXT, NULL, '', _('transparency_locks')),
                                    //~ 'invisibility_options' => array(self::T_INT, NULL, '', _('invisibility_options')),
                                    //~ 'keyboard' => array(self::T_TEXT, NULL, '', _('keyboard')),
                                    //~ 'keyboard_caps' => array(self::T_TEXT, NULL, '', _('keyboard_caps')),
                                    ),
                    'music' => array (//'custom_1' => array(self::T_TEXT, NULL, '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', _('custom_1')),
                                      //'custom_2' => array(self::T_TEXT, NULL, '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', _('custom_2')),
                                      'effect_vol' => array(self::T_RANGE, array(0, 127, 1), 127, _('volume effect')),
                                      'music_vol' => array(self::T_RANGE, array(0, 127, 1), 127, _('music volume')),
                                      'playing' => array(self::T_BOOL, NULL, true, _('launch music')),
                                      //'playlist' => array(self::T_INT, NULL, 0, _('playlist')),
                                      'shuffle' => array(self::T_BOOL, NULL, false, _('This setting defines whether or not the music tracks will be played on a random order.')),
                                      'extmidi' => array(self::T_TEXT, NULL, 'timidity', _('external midi player'))
                                      ),
                    'win32' => array (//'display_hz' => array(self::T_INT, NULL, 0, _('display_hz')),
                                      //~ 'force_full_redraw' => array(self::T_BOOL, NULL, false, _('force_full_redraw')),
                                      //~ 'fullscreen_bpp' => array(self::T_INT, NULL, 8, _('fullscreen_bpp')),
                                      //~ 'window_maximize' => array(self::T_BOOL, NULL, true, _('window_maximize')),
                                      ),
                    'difficulty' => array('competitor_speed' => array(self::T_SELECT, array(_('very slow'), _('slow'), _('medium'), _('fast'), _('very fast')), 2, _('If competitors are set to greater than zero then, competitor speed sets the speed at which the AI competitors will build.')),
                                          'construction_cost' => array(self::T_SELECT, array(_('low'), _('medium'), _('high')), 1, _('Sets the cost of construction in the game.')),
                                          'diff_level' => array(self::T_SELECT, array(_('easy-mode'), _('normal-mode'), _('hard-mode'), _('custom')), 0, _('Sets the pre-defined difficulty levels in the game.')),
                                          'disasters' => array(self::T_SELECT, array(_('off - no disasters occur'), _('on - disasters occur occasionally')), 1, _('Sets whether disasters off or on for a new map.')),
                                          'economy' => array(self::T_SELECT, array(_('steady - smaller, more frequent changes'), _('fluctuating - larger, less frequent changes')), 1, _('Sets the economic condition for a new map.')),
                                          'initial_interest' => array(self::T_SELECT, array(2 => _('2% interest'), _('3% interest'), _('4% interest')), 2, _('Sets the initial interest charged on loans for a new map.')),
                                          'line_reverse_mode' => array(self::T_SELECT, array(_('at end of line, and at stations'), _('at end of line only')), 0, _('Sets conditions where trains can reverse direction.')),
                                          'max_loan' => array(self::T_RANGE, array(100000, 500000, 50000), 200000, _('Sets the maximum initial loan for a new game. Always in British Pounds. Changing the currency under the [locale] section or in the Game options window will modify the maximum loan amount by the exchange rate of the chosen currency. The maximum loan amount will increase over time if inflation is on in the [economy] section.')),
                                          'max_no_competitors' => array(self::T_RANGE, array(0, 14, 1), 2, _('Sets the number AI competitors in the game.')),
                                          'number_industries' => array(self::T_SELECT, array(_('none'), _('very low'), _('low'), _('normal'), _('high')), 3, _('Sets the frequency of industries for a new map.')),
                                          'industry_density' => array(self::T_RANGE, array(0, 5, 1), 5, _('industry density')),
                                          'number_towns' => array(self::T_SELECT, array(_('very low'), _('low'), _('normal'), _('high'), _('custom')), 2, _('Sets the number of towns created on a new map. The custom setting is modified by the custom_town_number setting in the [game_creation] section.')),
                                          'quantity_sea_lakes' => array(self::T_SELECT, array(_('very low'), _('low'), _('medium'), _('high')), 1, _('Sets the quantity of water features on a new map.')),
                                          'subsidy_multiplier' => array(self::T_SELECT, array(_('1.5x the normal rate'), _('2.0x the normal rate'), _('3.0x the normal rate'), _('4.0x the normal rate')), 1, _('Sets the bonus multiplier for subsidies offered in the game.')),
                                          'terrain_type' => array(self::T_SELECT, array(_('very flat'), _('flat'), _('hilly'), _('mountainous')), 0, _('Sets the terrain type for generating a new map.')),
                                          'town_council_tolerance' => array(self::T_SELECT, array(_('permissive'), _('tolerant'), _('hostile')), 1, _('Sets the city council\'s attitude toward area restructuring in the game. A player rated "poor" or worse by the council will not be allowed to place stations or demolish town roads, bridges or buildings. The less tolerant the council is set to be, the faster their rating will fall due to the demolition of town assets (including trees on otherwise open land). The council\'s rating will improve over time by effectively moving freight, mail and people to and from stations in the town\'s area of control.')),
                                          'vehicle_breakdowns' => array(self::T_SELECT, array(_(' none (no breakdowns regardless of the condition of the vehicle)'), _('reduced'), _('normal')), 2, _('Sets the frequency which vehicles break down in the game.')),
                                          'vehicle_costs' => array(self::T_SELECT, array(_('low'), _('medium'), _('high')), 0, _('Sets the running (maintenance) costs level for all vehicles.')),
                                          ),
                    //'gameopt' => array('diff_custom = 2,2,1,3,300,2,0,2,0,1,2,0,1,0,0,0,0,0'), viz: http://wiki.openttd.org/Diff_custom
                    'game_creation' => array ('town_name' => array(self::T_SELECT, array('english' => 'english', 'french' => _('french'), 'german' => _('german'), 'american' => _('american'), 'latin' => _('latin'), 'silly' => _('silly'), 'swedish' => _('swedish'), 'dutch' => _('dutch'), 'finnish' => _('finnish'), 'polish' => _('polish'), 'slovakish' => _('slovakish'), 'norwegian' => _('norwegian'), 'hungarian' => _('hungarian'), 'austrian' => _('austrian'), 'romanian' => _('romanian'), 'czech' => _('czech'), 'swiss' => _('swiss'), 'danish' => _('danish'), 'turkish' => _('turkish'), 'italian' => _('italian'), 'catalan' => _('catalan')), 'english', _('Town name')),
                                              'landscape' => array(self::T_SELECT, array('temperate' => _('Temperate'), 'arctic' => _('Sub-arctic'), 'tropic' => _('Sub-tropical'), 'toyland' => _('Toyland')), 'temperate', _('There are 4 climates, Temperate, Sub-tropical, Sub-arctic and Toyland, each with its own landscape. Apart from a different set of graphics for the buildings and scenery, each one has a different set of vehicles and industries. Most vehicles are shared between climates, and Sub-arctic and Sub-tropical climates have an identical set of vehicles. The climate also affects characteristics of the game such as requirements for towns to grow, and growth-rate.')),
                                              'snow_line' => array(self::T_INT, NULL, 56, _('indicates the snowline level.')),
                                              'snow_line_height' => array(self::T_RANGE, array(2, 13, 1), 7, _('This setting allows you to determine at what "altitude" snow will appear.')),
                                              'starting_year' => array(self::T_INT, NULL, 1950, _('starting year [yyyy]')),
                                              'land_generator' => array(self::T_SELECT, array(_('Original'), _('Terra Genesis Perlin (TGP)')), 1, _('This specifies the land generation system that you use, either the Original or Terra Genesis Perlin (TGP).')),
                                              'oil_refinery_limit' => array(self::T_RANGE, array(12, 48, 1), 32, _('This option determines the maximum allowed distance (in tiles) from the edge of the map for an Oil Refinery.')),
                                              'tgen_smoothness' => array(self::T_SELECT, array(_('very smooth'), _('smooth'), _('rough'), _('very rough')), 1, _('Sets the smoothness')),
                                              'variety' => array(self::T_SELECT, array(_('none'), _('very low'), _('low'), _('medium'), _('high'), _('very high')), 0, _('This sets the variety of distribution. See Variety_distribution for more info.')),
                                              'generation_seed' => array(self::T_RANGE, array(0, 4294967295, 1), 1330935289, _('generation_seed')),
                                              'tree_placer' => array(self::T_SELECT, array(_('none tree placing'), _('original'), _('improved tree placing')), 2, _('Tree placer')),
                                              //~ 'heightmap_rotation' => array(self::T_RANGE, array(0, 1, 1), 0, _('heightmap_rotation')),
                                              //~ 'se_flat_world_height' => array(self::T_RANGE, array(0, 15, 1), 1, _('se_flat_world_height')),
                                              'map_x' => array(self::T_RANGE, array(6, 11, 1), 9, _('The Map size X determines the size and shape of your map. Your map must be a rectangle with sides of lengths in powers of 2, up to a limit of 2048 tiles in each direction. OpenTTD allows you to select the Map size in the map generation window. A large map gives you more space to spread out, but a smaller map will take less memory. Therefore, newer and faster computers will be able to handle a larger map with more efficiency whereas a smaller map will be best suited to older computers.')),
                                              'map_y' => array(self::T_RANGE, array(6, 11, 1), 9, _('The Map size Y determines the size and shape of your map. Your map must be a rectangle with sides of lengths in powers of 2, up to a limit of 2048 tiles in each direction. OpenTTD allows you to select the Map size in the map generation window. A large map gives you more space to spread out, but a smaller map will take less memory. Therefore, newer and faster computers will be able to handle a larger map with more efficiency whereas a smaller map will be best suited to older computers.')),
                                              'water_borders' => array(self::T_RANGE, array(0, 15, 1), 15, _('Bitset of the borders that are water by creating an new game')),
                                              'custom_town_number' => array(self::T_INT, NULL, 1, _('The custom setting is modified by the custom_town_number.'), 'number_towns=4'),
                                              'custom_sea_level' => array(self::T_RANGE, array(2, 90, 1), 2, _('custom_sea_level')),
                                              ),
                    'vehicle' => array ('disable_elrails' => array(self::T_BOOL, NULL, false, _('Disables electrified railways. The electric trains will run on normal tracks when this setting is active and electrified railways are not available for purchase.')),
                                        'dynamic_engines' => array(self::T_BOOL, NULL, false, _('When enabled, this Engine Pool feature allows multiple NewGRF vehicle sets to exist side-by-side. Without this feature, the maximum number of different vehicles is severely limited and vehicle sets of the same type will overwrite each others vehicles and functions. Note: using multiple vehicle sets side-by-side might result in very high or very low purchase and running costs for vehicles. Mixing wagons and trains from different train sets might result in graphical errors')),
                                        'extend_vehicle_life' => array(self::T_RANGE, array(0, 100, 1), 0, _('Extends every vehicles live by x years. takes values between 0 and 100')),
                                        'freight_trains' => array(self::T_RANGE, array(1, 255, 1), 1, _('The weight of freight trains is multiplied by the multiplier set here to simulate very heavy trains for more realism.')),
                                        'mammoth_trains' => array(self::T_BOOL, NULL, true, _('You can build extremely long trains, aka mammoth trains.')),
                                        'max_aircraft' => array(self::T_RANGE, array(0, 5000, 100), 200, _('Set the amount of aircraft that a player can have.')),
                                        'max_roadveh' => array(self::T_RANGE, array(0, 5000, 100), 500, _('Set the amount of road vehicles that a player can have.')),
                                        'max_ships' => array(self::T_RANGE, array(0, 5000, 100), 300, _('Set the amount of ships that a player can have.')),
                                        'max_trains' => array(self::T_RANGE, array(0, 5000, 100), 500, _('Set the amount of trains that a player can have.')),
                                        'never_expire_vehicles' => array(self::T_BOOL, NULL, false, _('Old vehicles will stay in the vehicle list for you to choose and never become obsolete, so you can now run a Kirby with a Chiamera next to it! When enabling this setting in a running game, vehicles already disappeared from the list will not come back for purchase.')),
                                        'plane_crashes' => array(self::T_SELECT, array(_('none'), _('reduced'), _('normal')), 2, _('Set the probability of plane crashes. They can be disabled if this setting is set to \'none\'.')),
                                        'plane_speed' => array(self::T_SELECT, array(1 => _('1/1'), _('1/2'), _('1/3'), _('1/4')), 4, _('Set the speed of aircraft in relation to rail, road and water vehicles. In plain TTD, the aircraft traveled at 1/4th of ground speed.')),
                                        'road_side' => array(self::T_SELECT, array('left' => _('left'), 'right' => _('right')), 'left', _('Road side')),
                                        'servint_aircraft' => array(self::T_RANGE, array(0, 800, 1), 150, _('The default service interval when a new aircraft is built., 0=disable, min 5'), 'servint_aircraft=0||>5'),
                                        'servint_ispercent' => array(self::T_BOOL, NULL, false, _('When this switch is on the service intervals are considered to be in percents of the max. reliability rather than days. For example, if an engine has the max reliability of 80% and you set the service interval to 10% then it will go to depot at 72%.')),
                                        'servint_roadveh' => array(self::T_RANGE, array(0, 800, 1), 150, _('The default service interval when a new road vehicle is built.'), 'servint_roadveh=0||>5'),
                                        'servint_ships' => array(self::T_RANGE, array(0, 800, 1), 360, _('The default service interval when a new ship is built.'), 'servint_ships=0||>5'),
                                        'servint_trains' => array(self::T_RANGE, array(0, 800, 1), 150, _('The default service interval when a new train is built.'), 'servint_trains=0||>5'),
                                        'train_acceleration_model' => array(self::T_SELECT, array(_('default'), _('realistic')), 1, _('Select the default or a more realistic acceleration calculation for trains. With this setting set to realistic, trains will travel faster up hill, but slower through tight corners. This option has been renamed from Enable realistic acceleration for trains.')),
                                        'train_slope_steepness' => array(self::T_RANGE, array(0, 10, 1), 3, _('Sets the steepness of slopes, trains will slow down more on slopes if this setting is set to a higher value. It only applies if the realistic acceleration model is selected.')),
                                        'wagon_speed_limits' => array(self::T_BOOL, NULL, true, _('Some NewGRF\'s have wagon speed limits to make them more realistic, this option will enable/disable them.')),
                                        //~ 'roadveh_acceleration_model' => array(self::T_INT, NULL, 0, _('roadveh_acceleration_model')),
                                        //~ 'roadveh_slope_steepness' => array(self::T_INT, NULL, 7, _('roadveh_slope_steepness')),
                                        //~ 'smoke_amount' => array(self::T_INT, NULL, 1, _('smoke_amount')),
                                        //~ 'max_train_length' => array(self::T_INT, NULL, 7, _('max_train_length')),
                                        ),
                    'construction' => array('autoslope' => array(self::T_BOOL, NULL, true, _('This patch makes the terraforming restrictions far less severe and allows you to terraform under objects, where you normally would need to remove the object first.')),
                                            'build_on_slopes' => array(self::T_BOOL, NULL, true, _('Normally you can only build tracks and roads on slopes parallel to the incline, with this setting enabled you can build nearly everything on a slope with foundations being built automatically.')),
                                            'extra_dynamite' => array(self::T_BOOL, NULL, false, _('The town’s attitude is more lenient towards you removing their property.')),
                                            'freeform_edges' => array(self::T_BOOL, NULL, true, _('With this enabled, the map doesn\'t require to have water all around it and allows you to terraform the map\'s edges just as any place elsewhere. Selecting this feature also provides an extra set of buttons in the map generator to select the type of egde (water/freeform) for each side of the map.')),
                                            'longbridges' => array(self::T_BOOL, NULL, true, _('Allows you to build very long bridges, much longer than before.')),
                                            'raw_industry_construction' => array(self::T_SELECT, array(_('none'), _('as other industries'), _('prospecting')), 0, _('This setting will enable you to purchase and either prospect or place industries which create raw materials.')),
                                            'road_stop_on_competitor_road' => array(self::T_BOOL, NULL, true, _('It will be possible to build drive-through road stops on roads owned by competitor companies.')),
                                            'road_stop_on_town_road' => array(self::T_BOOL, NULL, true, _('It will be possible to build drive-through road stops on town owned roads.')),
                                            'signal_side' => array(self::T_BOOL, NULL, true, _('Whether signals are shown on the side that road vehicles drive on or the opposite.')),
                                            'extra_tree_placement' => array(self::T_SELECT, array(_('none'), _('only in rain forests'), _('everywhere')), 2, _('With this option, you can enable/disable the in-game generation of trees.')),
                                            'industry_platform' => array(self::T_RANGE, array(0, 4, 1), 1, _('Set how much space to an industrial country must be at least flat.')),
                                            'command_pause_level' => array(self::T_SELECT, array(_('no options'), _('all non-construction opportunities'), _('landscape modifications'), _('all features')), 1, _('This option lets you specify which options are allowed during a game break.')),
                                            //~ 'terraform_per_64k_frames' => array(self::T_RANGE, array(0, 1073741824, 1), 4194304, _('terraform_per_64k_frames')),
                                            //~ 'terraform_frame_burst' => array(self::T_RANGE, array(0, 1073741824, 1), 4096, _('terraform_frame_burst')),
                                            //~ 'clear_per_64k_frames' => array(self::T_RANGE, array(0, 1073741824, 1), 4194304, _('clear_per_64k_frames')),
                                            //~ 'clear_frame_burst' => array(self::T_RANGE, array(0, 1073741824, 1), 4096, _('clear_frame_burst')),
                                            'max_bridge_length' => array(self::T_RANGE, array(1, 2048, 1), 64, _('The maximum length of a bridge that will be build.')),
                                            'max_tunnel_length' => array(self::T_RANGE, array(1, 2048, 1), 64, _('The maximum length of a tunnel that will be build.')),
                                            ),
                    'station' => array ('adjacent_stations' => array(self::T_BOOL, NULL, true, _('Holding the Ctrl key while building a station directly adjacent to another one will create new station instead of merging the new tile(s) with the existing station.')),
                                        //~ 'always_small_airport' => array(self::T_BOOL, NULL, false, _('always_small_airport')),
                                        'distant_join_stations' => array(self::T_BOOL, NULL, true, _('Holding the Ctrl key while building a station pops up a dialog asking to merge the station with an existing station within the catchment area or creating a new station.')),
                                        'join_stations' => array(self::T_BOOL, NULL, true, _('Stations built next to each other will be joined as long as the station spread is not too high.')),
                                        'modified_catchment' => array(self::T_BOOL, NULL, true, _('Changes the catchment areas to be more realistically sized. With this setting enabled, the catchment area of a station tile varies depending on what "type" of station tile it is. For example, train stations have a larger catchment area than bus stations and airports have even larger catchment areas. With airports, the size of the catchment area even varies with the type of airport, with the Intercontinental Airport having the largest area.')),
                                        'nonuniform_stations' => array(self::T_BOOL, NULL, true, _('Enables you to join stations together at different angles, so you can for instance have two vertical tracks and three horizontal tracks.')),
                                        'station_spread' => array(self::T_RANGE, array(4, 64, 1), 12, _('How spread out a station can be from one end to the other. If you draw a square round a station, this is the maximum size of any side of the square in tiles.')),
                                        'never_expire_airports' => array(self::T_BOOL, NULL, false, _('Airports may have an expiry year, similar to engines. Expired airports can\'t be built any more. With this option enabled, airports never expire.')),
                                        ),
                    'economy' => array ('allow_shares' => array(self::T_BOOL, NULL, false, _('Allows you to enable or disable the ability to buy shares from competitors. You also have to wait for the company to get old enough before buying 25% or a full take over. This age is about 6 years old.')),
                                        'allow_town_roads' => array(self::T_BOOL, NULL, true, _('When disabled, towns don\'t build roads by themselves. In order for towns to grow, you have to provide the roads yourself (somewhat like SimCity, but without the zoning and stuff).')),
                                        'bribe' => array(self::T_BOOL, NULL, true, _('Allows you to bribe the local authority so that they increase your rating, if you are caught though you will be fined and won\'t be able to bribe them for a while.')),
                                        'dist_local_authority' => array(self::T_RANGE, array(5, 60, 1), 20, _('dist local authority')),
                                        'exclusive_rights' => array(self::T_BOOL, NULL, true, _('Allows you to disable the purchase of exclusive transport rights in towns. Useful (to disable?) in multiplayer games.')),
                                        'give_money' => array(self::T_BOOL, NULL, true, _('Allows you to donate money to other companies.')),
                                        'inflation' => array(self::T_BOOL, NULL, true, _('Controls whether inflation is on or off. If inflation is on, the prices of everything will increase as you progress. To balance this increase, the maximum loan available to you will increase every few years.')),
                                        'initial_city_size' => array(self::T_RANGE, array(1, 10, 1), 2, _('Set how much larger a newly founded city is compared to a town.')),
                                        'larger_towns' => array(self::T_RANGE, array(0, 255, 1), 4, _('Set how many of the towns will become cities. Cities are larger towns which are allowed to grow faster (see also next setting).')),
                                        'mod_road_rebuild' => array(self::T_BOOL, NULL, false, _('Enable if towns should remove useless pieces of road to clean up dead ends.')),
                                        'multiple_industry_per_town' => array(self::T_BOOL, NULL, false, _('This setting allows you to build two or more industries of the same type on land that comes under the jurisdiction of one town.')),
                                        'same_industry_close' => array(self::T_BOOL, NULL, false, _('Industries of the same type can be built close to each other with this patch on, it could cause problems though as you may end up with ten industries of one type in one small area of your map.')),
                                        'smooth_economy' => array(self::T_BOOL, NULL, true, _('Changes in production will happen more frequently and by smaller percentages.')),
                                        'station_noise_level' => array(self::T_BOOL, NULL, false, _('With this activated, the number of airports which can be placed in the vicinity of a town is not fixed anymore. Instead it depends upon the noise level of the airports, their distance to the town centre and the town\'s attitude.')),
                                        'town_growth_rate' => array(self::T_SELECT, array(_('None'), _('Slow'), _('Normal'), _('Fast'), _('Very fast')), 2, _('Select how fast towns should grow. You can also completely disable town growth.')),
                                        'town_layout' => array(self::T_SELECT, array(_('original'), _('better roads'), _('2x2 grid'), _('3x3 grid'), _('random')), 1, _('Select how towns should build their roads. You can choose between the original algorithm, an improved algorithm, a 2x2 grid, a 3x3 grid or random. The random setting picks one of the four option randomly for each town. This option has been renamed from Select town road layout in 0.6.3.')),
                                        //~ 'town_noise_population' => array(self::T_TEXT, NULL, '800,2000,4000', _('town_noise_population')),
                                        //~ 'found_town' => array(self::T_INT, NULL, 0, _('found_town')),
                                        //~ 'feeder_payment_share' => array(self::T_INT, NULL, 75, _('feeder_payment_share')),
                                        //~ 'town_noise_population[0]' => array(self::T_INT, NULL, 800, _('town_noise_population[0]')),
                                        //~ 'town_noise_population[1]' => array(self::T_INT, NULL, 2000, _('town_noise_population[1]')),
                                        //~ 'town_noise_population[2]' => array(self::T_INT, NULL, 4000, _('town_noise_population[2]')),
                                        //~ 'allow_town_level_crossings' => array(self::T_BOOL, NULL, true, _('allow_town_level_crossings')),
                                        //~ 'fund_roads' => array(self::T_BOOL, NULL, true, _('fund_roads')),
                                        ),
                    'pf' => array('forbid_90_deg' => array(self::T_BOOL, NULL, false, _('Disallows trains and ships from making sharp 90 degree turns. The NPF or YAPF pathfinder for trains needs to be enabled for this option to work for trains.')),
                                  //~ 'npf.npf_buoy_penalty' => array(self::T_RANGE, array(0, 100000, 1), 200, _('npf_buoy_penalty')),
                                  //~ 'npf.npf_crossing_penalty' => array(self::T_RANGE, array(0, 100000, 1), 300, _('npf.npf_crossing_penalty')),
                                  //~ 'npf.npf_max_search_nodes' => array(self::T_RANGE, array(500, 100000, 1), 10000, _('npf_max_search_nodes')),
                                  //~ 'npf.npf_rail_curve_penalty' => array(self::T_RANGE, array(0, 100000, 1), 1, _('npf_rail_curve_penalty')),
                                  //~ 'npf.npf_rail_depot_reverse_penalty' => array(self::T_RANGE, array(0, 100000, 1), 5000, _('npf_rail_depot_reverse_penalty')),
                                  //~ 'npf.npf_rail_firstred_exit_penalty' => array(self::T_RANGE, array(0, 100000, 1), 10000, _('npf_rail_firstred_exit_penalty')),
                                  //~ 'npf.npf_rail_firstred_penalty' => array(self::T_RANGE, array(0, 100000, 1), 1000, _('npf_rail_firstred_penalty')),
                                  //~ 'npf.npf_rail_lastred_penalty' => array(self::T_RANGE, array(0, 100000, 1), 1000, _('npf_rail_lastred_penalty')),
                                  //~ 'npf.npf_rail_pbs_cross_penalty' => array(self::T_RANGE, array(0, 100000, 1), 300, _('npf_rail_pbs_cross_penalty')),
                                  //~ 'npf.npf_rail_pbs_signal_back_penalty' => array(self::T_RANGE, array(0, 100000, 1), 1500, _('npf_rail_pbs_signal_back_penalty')),
                                  //~ 'npf.npf_rail_slope_penalty' => array(self::T_RANGE, array(0, 100000, 1), 100, _('npf_rail_slope_penalty')),
                                  //~ 'npf.npf_rail_station_penalty' => array(self::T_RANGE, array(0, 100000, 1), 100, _('npf_rail_station_penalty')),
                                  //~ 'npf.npf_road_curve_penalty' => array(self::T_RANGE, array(0, 100000, 1), 1, _('npf_road_curve_penalty')),
                                  //~ 'npf.npf_road_drive_through_penalty' => array(self::T_RANGE, array(0, 100000, 1), 800, _('npf_road_drive_through_penalty')),
                                  //~ 'npf.npf_water_curve_penalty' => array(self::T_RANGE, array(0, 100000, 1), 25, _('npf_water_curve_penalty')),
                                  //~ 'opf.pf_maxdepth' => array(self::T_RANGE, array(4, 255, 1), 48, _('pf_maxdepth')),
                                  //~ 'opf.pf_maxlength' => array(self::T_RANGE, array(64, 65535, 1), 4096, _('pf_maxlength')),
                                  //~ 'path_backoff_interval' => array(self::T_RANGE, array(1, 255, 1), 20, _('path_backoff_interval')),
                                  'pathfinder_for_roadvehs' => array(self::T_RANGE, array(1, 2, 1), 2, _('Select the pathfinding algorithm for road vehicles. YAPF is the default and recommended setting, but you can still select the older pathfinders.')),
                                  //~ 'pathfinder_for_ships' => array(self::T_RANGE, array(0, 2, 1), 0, _('pathfinder_for_ships')),
                                  //~ 'pathfinder_for_trains' => array(self::T_RANGE, array(1, 2, 1), 2, _('pathfinder_for_trains')),
                                  //~ 'reserve_paths' => array(self::T_BOOL, NULL, false, _('reserve_paths')),
                                  //~ 'roadveh_queue' => array(self::T_BOOL, NULL, true, _('roadveh_queue')),
                                  //~ 'wait_for_pbs_path' => array(self::T_RANGE, array(2, 255, 1), 30, _('wait_for_pbs_path')),
                                  //~ 'wait_oneway_signal' => array(self::T_RANGE, array(2, 255, 1), 15, _('wait_oneway_signal')),
                                  //~ 'wait_twoway_signal' => array(self::T_RANGE, array(2, 255, 1), 41, _('wait_twoway_signal')),
                                  //~ 'yapf.disable_node_optimization' => array(self::T_BOOL, NULL, false, _('yapf.disable_node_optimization')),
                                  //~ 'yapf.max_search_nodes' => array(self::T_RANGE, array(500, 1000000, 1), 10000, _('yapf.max_search_nodes')),
                                  //~ 'yapf.rail_crossing_penalty' => array(self::T_RANGE, array(0, 1000000, 1), 300, _('yapf.rail_crossing_penalty')),
                                  //~ 'yapf.rail_curve45_penalty' => array(self::T_RANGE, array(0, 1000000, 1), 100, _('yapf.rail_curve45_penalty')),
                                  //~ 'yapf.rail_curve90_penalty' => array(self::T_RANGE, array(0, 1000000, 1), 600, _('yapf.rail_curve90_penalty')),
                                  //~ 'yapf.rail_depot_reverse_penalty' => array(self::T_RANGE, array(0, 1000000, 1), 5000, _('yapf.rail_depot_reverse_penalty')),
                                  //~ 'yapf.rail_doubleslip_penalty' => array(self::T_RANGE, array(0, 1000000, 1), 100, _('yapf.rail_doubleslip_penalty')),
                                  //~ 'yapf.rail_firstred_exit_penalty' => array(self::T_RANGE, array(0, 1000000, 1), 10000, _('yapf.rail_firstred_exit_penalty')),
                                  //~ 'yapf.rail_firstred_penalty' => array(self::T_RANGE, array(0, 1000000, 1), 1000, _('yapf.rail_firstred_penalty')),
                                  //~ 'yapf.rail_firstred_twoway_eol' => array(self::T_BOOL, NULL, true, _('yapf.rail_firstred_twoway_eol')),
                                  //~ 'yapf.rail_lastred_exit_penalty' => array(self::T_RANGE, array(0, 1000000, 1), 10000, _('yapf.rail_lastred_exit_penalty')),
                                  //~ 'yapf.rail_lastred_penalty' => array(self::T_RANGE, array(0, 1000000, 1), 1000, _('yapf.rail_lastred_penalty')),
                                  //~ 'yapf.rail_longer_platform_penalty' => array(self::T_RANGE, array(0, 20000, 1), 800, _('yapf.rail_longer_platform_penalty')),
                                  //~ 'yapf.rail_longer_platform_per_tile_penalty' => array(self::T_RANGE, array(0, 20000, 1), 0, _('yapf.rail_longer_platform_per_tile_penalty')),
                                  //~ 'yapf.rail_look_ahead_max_signals' => array(self::T_RANGE, array(1, 100, 1), 10, _('yapf.rail_look_ahead_max_signals')),
                                  //~ 'yapf.rail_look_ahead_signal_p0' => array(self::T_RANGE, array(-1000000, 1000000, 1), 500, _('yapf.rail_look_ahead_signal_p0')),
                                  //~ 'yapf.rail_look_ahead_signal_p1' => array(self::T_RANGE, array(-1000000, 1000000, 1), -100, _('yapf.rail_look_ahead_signal_p1')),
                                  //~ 'yapf.rail_look_ahead_signal_p2' => array(self::T_RANGE, array(-1000000, 1000000, 1), 5, _('yapf.rail_look_ahead_signal_p2')),
                                  //~ 'yapf.rail_pbs_cross_penalty' => array(self::T_RANGE, array(0, 1000000, 1), 300, _('yapf.rail_pbs_cross_penalty')),
                                  //~ 'yapf.rail_pbs_signal_back_penalty' => array(self::T_RANGE, array(0, 1000000, 1), 1500, _('yapf.rail_pbs_signal_back_penalty')),
                                  //~ 'yapf.rail_pbs_station_penalty' => array(self::T_RANGE, array(0, 1000000, 1), 800, _('yapf.rail_pbs_station_penalty')),
                                  //~ 'yapf.rail_shorter_platform_penalty' => array(self::T_RANGE, array(0, 20000, 1), 4000, _('yapf.rail_shorter_platform_penalty')),
                                  //~ 'yapf.rail_shorter_platform_per_tile_penalty' => array(self::T_RANGE, array(0, 20000, 1), 0, _('yapf.rail_shorter_platform_per_tile_penalty')),
                                  //~ 'yapf.rail_slope_penalty' => array(self::T_RANGE, array(0, 1000000, 1), 200, _('yapf.rail_slope_penalty')),
                                  //~ 'yapf.rail_station_penalty' => array(self::T_RANGE, array(0, 1000000, 1), 3000, _('yapf.rail_station_penalty')),
                                  //~ 'yapf.road_crossing_penalty' => array(self::T_RANGE, array(0, 1000000, 1), 300, _('yapf.road_crossing_penalty')),
                                  //~ 'yapf.road_curve_penalty' => array(self::T_RANGE, array(0, 1000000, 1), 100, _('yapf.road_curve_penalty')),
                                  //~ 'yapf.road_slope_penalty' => array(self::T_RANGE, array(0, 1000000, 1), 200, _('yapf.road_slope_penalty')),
                                  //~ 'yapf.road_stop_penalty' => array(self::T_RANGE, array(0, 1000000, 1), 800, _('yapf.road_stop_penalty')),
                                  //~ 'npf.npf_road_dt_occupied_penalty' => array(self::T_RANGE, array(0, 1000000, 1), 800, _('npf.npf_road_dt_occupied_penalty')),
                                  //~ 'npf.npf_road_bay_occupied_penalty' => array(self::T_RANGE, array(0, 1000000, 1), 1500, _('npf.npf_road_bay_occupied_penalty')),
                                  //~ 'npf.maximum_go_to_depot_penalty' => array(self::T_RANGE, array(0, 1000000, 1), 2000, _('npf.maximum_go_to_depot_penalty')),
                                  //~ 'yapf.road_stop_occupied_penalty' => array(self::T_RANGE, array(0, 1000000, 1), 800, _('yapf.road_stop_occupied_penalty')),
                                  //~ 'yapf.road_stop_bay_occupied_penalty' => array(self::T_RANGE, array(0, 1000000, 1), 1500, _('yapf.road_stop_bay_occupied_penalty')),
                                  //~ 'yapf.maximum_go_to_depot_penalty' => array(self::T_RANGE, array(0, 1000000, 1), 2000, _('yapf.maximum_go_to_depot_penalty')),
                                  //~ 'reverse_at_signals' => array(self::T_BOOL, NULL, false, _('reverse_at_signals')),
                                  ),
                    'order' => array ('gotodepot' => array(self::T_BOOL, NULL, true, _('All vehicles can have a depot in their schedule.')),
                                      'gradual_loading' => array(self::T_BOOL, NULL, true, _('Vehicles will load cargo over a period of time, not full load instantly. If the option to show loading indicators is switched on, this will be reflected correctly.')),
                                      'improved_load' => array(self::T_BOOL, NULL, false, _('An improved loading algorithm, which loads only one vehicle at a time until it\'s completely full, before loading the next vehicle. When disabled, all vehicles in a station are loaded simultaineously, possibly needlessly blocking multiple platforms.')),
                                      'no_servicing_if_no_breakdowns' => array(self::T_BOOL, NULL, false, _('If you have breakdowns set to none and have this switch on, your vehicles will never go to the depot for a service. Even if this setting is enabled, vehicles will still go to depot for auto-renewal and/or replacement if those settings are activated.')),
                                      'selectgoods' => array(self::T_BOOL, NULL, true, _('Cargo will only be generated at a station when a vehicle with the capacity to pick that cargo up has visited the station. Affects station ratings.')),
                                      'serviceathelipad' => array(self::T_BOOL, NULL, true, _('When enabled, helicopters will be serviced automatically each time they arrive at a helipad. This way, you don\'t need to have some airport along the helicopter\'s route for it to service. In previous versions this was located in Stations section.')),
                                      'timetabling' => array(self::T_BOOL, NULL, true, _('Allows you to use timetables for vehicles.')),
                                      ),
                    'gui' => array ('advanced_vehicle_list' => array(self::T_SELECT, array(_('Off'), _('Own company'), _('All companies')), 1, _('The advanced vehicle list allows to place vehicles in groups and perform certain actions on groups, such as replace vehicles and sending to depot.')),
                                    'always_build_infrastructure' => array(self::T_BOOL, NULL, false, _('always build infrastructure')),
                                    'auto_euro' => array(self::T_BOOL, NULL, true, _('auto euro')),
                                    'autosave' => array(self::T_SELECT, array('off' => _('Off'), 'monthly' => _('Every month'), 'quarterly' => _('Every 3 months'), 'half year' => _('Every 6 months'), 'yearly' => _('Every 12 months')), 'yearly', _('The Autosave option allows OpenTTD to automatically save your game at predefined intervals.')),
                                    'autosave_on_exit' => array(self::T_BOOL, NULL, false, _('autosave on exit')),
                                    'autoscroll' => array(self::T_BOOL, NULL, false, _('autoscroll')),
                                    'bridge_pillars' => array(self::T_BOOL, NULL, true, _('bridge pillars')),
                                    'coloured_news_year' => array(self::T_RANGE, array(0, 5000000, 1), 2000, _('Year in which the papers appear in color.')),
                                    //~ 'console_backlog_length' => array(self::T_INT, NULL, 100, _('console_backlog_length')),
                                    //~ 'console_backlog_timeout' => array(self::T_INT, NULL, 100, _('console_backlog_timeout')),
                                    //~ 'cycle_signal_types' => array(self::T_RANGE, array(0, 2, 1), 2, _('cycle_signal_types')),
                                    //~ 'station_numtracks' => array(self::T_INT, NULL, 1, _('station_numtracks')),
                                    //~ 'station_dragdrop' => array(self::T_BOOL, NULL, false, _('station_dragdrop')),
                                    //~ 'persistent_buildingtools' => array(self::T_BOOL, NULL, false, _('persistent_buildingtools')),
                                    //~ 'threaded_saves' => array(self::T_BOOL, NULL, true, _('threaded_saves')),
                                    //~ 'smallmap_land_colour' => array(self::T_TEXT, NULL, '', _('smallmap_land_colour')),
                                    //~ 'timetable_arrival_departure' => array(self::T_BOOL, NULL, true, _('timetable_arrival_departure')),
                                    //~ 'stop_location' => array(self::T_INT, NULL, 2, _('stop_location')),
                                    //~ 'show_date_in_logs' => array(self::T_BOOL, NULL, false, _('show_date_in_logs')),
                                    //~ 'developer' => array(self::T_INT, NULL, 1, _('developer')),
                                    //~ 'hover_delay' => array(self::T_INT, NULL, 2, _('hover_delay')),
                                    //~ 'newgrf_developer_tools' => array(self::T_BOOL, NULL, false, _('newgrf_developer_tools')),
                                    //~ 'ai_developer_tools' => array(self::T_BOOL, NULL, false, _('ai_developer_tools')),
                                    //~ 'newgrf_show_old_versions' => array(self::T_BOOL, NULL, false, _('newgrf_show_old_versions')),
                                    //~ 'statusbar_pos' => array(self::T_RANGE, array(0, 2, 1), 0, _('statusbar_pos')),
                                    //~ 'lost_vehicle_warn' => array(self::T_BOOL, NULL, true, _('lost_vehicle_warn')),
                                    //~ 'disable_unsuitable_building' => array(self::T_BOOL, NULL, true, _('disable_unsuitable_building')),
                                    //~ 'scenario_developer' => array(self::T_BOOL, NULL, false, _('scenario_developer')),
                                    //~ 'network_chat_timeout' => array(self::T_INT, NULL, 20, _('network_chat_timeout')),
                                    //~ 'vehicle_speed' => array(self::T_BOOL, NULL, true, _('vehicle_speed')),
                                    //~ 'autorenew' => array(self::T_BOOL, NULL, false, _('autorenew')),
                                    //~ 'autorenew_months' => array(self::T_INT, NULL, '', _('autorenew_months')),
                                    //~ 'autorenew_money' => array(self::T_INT, NULL, '', _('autorenew_money')),
                                    //~ 'date_format_in_default_names' => array(self::T_RANGE, array(0, 2, 1), 0, _('date_format_in_default_names')),
                                    //~ 'default_rail_type' => array(self::T_RANGE, array(0, 2, 1), 2, _('default_rail_type')),
                                    //~ 'default_signal_type' => array(self::T_RANGE, array(0, 2, 1), 0, _('default_signal_type')),
                                    //~ 'drag_signals_density' => array(self::T_RANGE, array(1, 20, 1), 6, _('drag_signals_density rozestup navestidel')),
                                    //~ 'enable_signal_gui' => array(self::T_BOOL, NULL, false, _('enable_signal_gui')),
                                    //~ 'errmsg_duration' => array(self::T_RANGE, array(0, 20, 1), 5, _('errmsg_duration')),
                                    //~ 'expenses_layout' => array(self::T_BOOL, NULL, true, _('expenses_layout')),
                                    //~ 'keep_all_autosave' => array(self::T_BOOL, NULL, false, _('keep_all_autosave')),
                                    //~ 'left_mouse_btn_scrolling' => array(self::T_BOOL, NULL, false, _('left_mouse_btn_scrolling')),
                                    //~ 'link_terraform_toolbar' => array(self::T_BOOL, NULL, false, _('link_terraform_toolbar')),
                                    //~ 'liveries' => array(self::T_RANGE, array(0, 2, 1), 2, _('liveries')),
                                    //~ 'loading_indicators' => array(self::T_RANGE, array(0, 2, 1), 2, _('loading_indicators')),
                                    //~ 'lost_train_warn' => array(self::T_BOOL, NULL, true, _('lost_train_warn')),
                                    //~ 'max_num_autosaves' => array(self::T_RANGE, array(0, 255, 1), 16, _('max_num_autosaves')),
                                    //~ 'measure_tooltip' => array(self::T_BOOL, NULL, false, _('measure_tooltip')),
                                    //~ 'network_chat_box_height' => array(self::T_RANGE, array(5, 255, 1), 25, _('network_chat_box_height')),
                                    //~ 'network_chat_box_width' => array(self::T_RANGE, array(200, 65535, 1), 700, _('network_chat_box_width')),
                                    //~ 'new_nonstop' => array(self::T_BOOL, NULL, false, _('new_nonstop')),
                                    //~ 'news_message_timeout' => array(self::T_RANGE, array(1, 255, 1), 2, _('news_message_timeout')),
                                    //~ 'order_review_system' => array(self::T_RANGE, array(0, 2, 1), 2, _('order_review_system')),
                                    //~ 'pause_on_newgame' => array(self::T_BOOL, NULL, false, _('pause_on_newgame')),
                                    //~ //'persistent_building_tools = [true | false]', ??
                                    //~ 'population_in_label' => array(self::T_BOOL, NULL, true, _('population_in_label')),
                                    //~ 'prefer_teamchat' => array(self::T_BOOL, NULL, false, _('prefer_teamchat')),
                                    //~ 'quick_goto' => array(self::T_BOOL, NULL, false, _('quick_goto')),
                                    //~ 'reverse_scroll' => array(self::T_BOOL, NULL, false, _('reverse_scroll')),
                                    //~ 'scrollwheel_multiplier' => array(self::T_RANGE, array(1, 15, 1), 5, _('scrollwheel_multiplier')),
                                    //~ 'scrollwheel_scrolling' => array(self::T_RANGE, array(0, 2, 1), 0, _('scrollwheel_scrolling')),
                                    //~ 'semaphore_build_before' => array(self::T_RANGE, array(0, 5000000, 1), 1975, _('semaphore_build_before')),
                                    //~ 'show_finances' => array(self::T_BOOL, NULL, true, _('show_finances')),
                                    //~ 'show_track_reservation' => array(self::T_BOOL, NULL, false, _('show_track_reservation')),
                                    //~ 'smooth_scroll' => array(self::T_BOOL, NULL, false, _('smooth_scroll')),
                                    //~ //'station_drag_drop = [true | false]',
                                    //~ //'station_num_tracks',
                                    //~ 'station_platlength' => array(self::T_RANGE, array(1, 7, 1), 5, _('station_platlength')),
                                    //~ 'station_show_coverage' => array(self::T_BOOL, NULL, true, _('station_show_coverage')),
                                    //~ 'status_long_date' => array(self::T_BOOL, NULL, true, _('status_long_date')),
                                    //~ 'timetable_in_ticks' => array(self::T_BOOL, NULL, false, _('timetable_in_ticks')),
                                    //~ 'toolbar_pos' => array(self::T_RANGE, array(0, 2, 1), 0, _('toolbar_pos')),
                                    //~ 'vehicle_income_warn' => array(self::T_BOOL, NULL, true, _('vehicle_income_warn')),
                                    //~ 'window_snap_radius' => array(self::T_RANGE, array(0, 32, 1), 10, _('window_snap_radius, 0=off'), '0||>=1'),
                                    //~ 'window_soft_limit' => array(self::T_RANGE, array(0, 255, 1), 20, _('window_soft_limit, 0=off'), '0||>=5'),
                                    ),
                    'ai' => array('ai_disable_veh_aircraft' => array(self::T_BOOL, NULL, false, _('Computer cannot build aircraft or airports. This option has been moved from Vehicles section in 0.3.4.')),
                                  'ai_disable_veh_roadveh' => array(self::T_BOOL, NULL, false, _('Computer cannot build road vehicles or roads. This option has been moved from Vehicles section in 0.3.4.')),
                                  'ai_disable_veh_train' => array(self::T_BOOL, NULL, false, _('Computer cannot build trains or rail infrastucture. This option has been moved from Vehicles section in 0.3.4.')),
                                  'ai_disable_veh_ship' => array(self::T_BOOL, NULL, true, _('Computer cannot build ships. This option has been moved from Vehicles section in 0.3.4.')),
                                  'ai_in_multiplayer' => array(self::T_BOOL, NULL, false, _('Enables computer players in multiplayer games. The number of computer players can be set through the difficulty settings window.')),
                                  'ai_max_opcode_till_suspend' => array(self::T_RANGE, array(5000, 250000, 5000), 10000, _('Lower this value if the AI is making the game run slow. Increase this value if you find the AI doing a lot of nothing instead of actually building stuff. Leave value at 10,000 if unsure.')),
                                  ),
                    'locale' => array('currency' => array(self::T_SELECT, array('GBP' => _('United Kingdom	 Pound	 1x'),
                                                                          'USD' => _('United States	 Dollar	 2x'),
                                                                          'EUR' => _('Eurozone	 Euro	 2x'),
                                                                          'YEN' => _('Japan	 Yen	 220x'),
                                                                          'ATS' => _('Austria	 Schilling	 20x'),
                                                                          'BEF' => _('Belgium	 Franc	 59x'),
                                                                          'CHF' => _('Switzerland	 Franc	 2x'),
                                                                          'CZK' => _('Czech Republic	 Koruna	 41x'),
                                                                          'DEM' => _('Germany	 Mark	 3x'),
                                                                          'DKK' => _('Denmark	 Krone	 11x'),
                                                                          'ESP' => _('Spain	 Peseta	 245x'),
                                                                          'FIM' => _('Finland	 Markka	 9x'),
                                                                          'FRF' => _('France	 Franc	 10x'),
                                                                          'GRD' => _('Greece	 Drachma	 500x'),
                                                                          'HUF' => _('Hungary	 Forint	 378x'),
                                                                          'ISK' => _('Iceland	 Krona	 130x'),
                                                                          'ITL' => _('Italy	 Lira	 2850x'),
                                                                          'NLG' => _('Netherlands	 Guilder (Florin)	 3x'),
                                                                          'NOK' => _('Norway	 Kroner	 12x'),
                                                                          'PLN' => _('Poland	 Zloty	 6x'),
                                                                          'RON' => _('Romania	 New Lei	 5x'),
                                                                          'RUR' => _('Russia	 Ruble	 50x'),
                                                                          'SIT' => _('Slovenia	 Tolar	 352x'),
                                                                          'SEK' => _('Sweden	 Krona	 13x'),
                                                                          'YTL' => _('Turkey	 Lira	 3x'),
                                                                          'SKK' => _('Slovakia	 Koruna	 52x'),
                                                                          'BRR' => _('Brazil	 Real	 4x'),
                                                                          'Custom' => _('For a custom currency'),
                                                                          ), 'GBP', _('There are a variety of currencies that you can set as the standard currency of the server.')),
                                      'units' => array(self::T_SELECT, array('metric' => _('Metric'), 'imperial' => _('Imperial'), 'si' => _('SI')), 'imperial', _('Units of distance')),
                                      //~ 'digit_group_separator' => array(self::T_TEXT, NULL, '', _('digit_group_separator')),
                                      //~ 'digit_group_separator_currency' => array(self::T_TEXT, NULL, '', _('digit_group_separator_currency')),
                                      //~ 'digit_decimal_separator' => array(self::T_TEXT, NULL, '', _('digit_decimal_separator')),
                                      ),
                    'network' => array ('autoclean_companies' => array(self::T_BOOL, NULL, false, _('Enable or disable autoclean function. If enabled, companies with no player activity for specified game (autoclean_protected and autoclean_unprotected) time will be destroyed.')),
                                        'autoclean_novehicles' => array(self::T_RANGE, array(0, 240, 1), 0, _('Automatically shut down companies without vehicles after the given amount of months.')),
                                        'autoclean_protected' => array(self::T_RANGE, array(0, 240, 1), 36, _('Automatically remove the password from an inactive company after the given amount of months.')),
                                        'autoclean_unprotected' => array(self::T_RANGE, array(0, 240, 1), 12, _('Automatically shut down inactive companies after the given amount of months.')),
                                        'client_name' => array(self::T_TEXT, NULL, 'Player', _('Defines the name you will have when you play multiplayer. It is considered polite not to leave the name as \'Player\'. It doesn\'t have to be anything special, possibly your nickname, forename, initals, or use your imagination.')),
                                        //~ 'connect_to_ip' => array(self::T_TEXT, NULL, '', _('connect_to_ip')),
                                        'default_company_pass' => array(self::T_TEXT, NULL, '', _('This password will be set to every new company at their establishment.')),
                                        'lan_internet' => array(self::T_SELECT, array(_('internet-visible, advertised on master server list'), _('LAN-only, not advertised.')), 1, _('This setting specifies whether you are running a LAN- or Internet-visible game server. An Internet-visible game will be advertised on the master server browser, allowing online players to join your game easily. Note that, even if you set the game to LAN-only, online players will still be able to join if it is possible to reach server_port from the Internet, by adding it manually to their personal server lists.')),
                                        //~ 'last_host' => array(self::T_TEXT, NULL, '0.0.0.0', _('last_host')),
                                        //~ 'last_port' => array(self::T_INT, NULL, 3979, _('last_port')),
                                        //~ 'no_http_content_downloads' => array(self::T_BOOL, NULL, false, _('no_http_content_downloads')),
                                        //~ 'commands_per_frame' => array(self::T_INT, NULL, 4, _('commands_per_frame')),
                                        //~ 'max_commands_in_queue' => array(self::T_INT, NULL, 32, _('max_commands_in_queue')),
                                        'max_clients' => array(self::T_RANGE, array(2, 255, 1), 10, _('Maximum number of players allowed on the server')),
                                        'max_companies' => array(self::T_RANGE, array(1, 15, 1), 8, _('Maximum number of companies allowed in the game')),
                                        'max_join_time' => array(self::T_RANGE, array(0, 32000, 1), 500, _('Set the maximum amount of time (ticks) a client is allowed to join.')),
                                        'max_spectators' => array(self::T_RANGE, array(0, 255, 1), 10, _('This is how many spectators you allow on your server.')),
                                        'min_active_clients' => array(self::T_RANGE, array(0, 255, 1), 0, _('The game is atomatically paused when the number of active players is less than this amount. This only works with dedicated servers!')),
                                        //~ 'network_id' => array(self::T_TEXT, NULL, '', _('network_id')),
                                        'pause_on_join' => array(self::T_BOOL, NULL, true, _('Specifies whether or not to pause the game while a new client joins.')),
                                        'player_name' => array(self::T_TEXT, NULL, 'Player', _('Defines the name you will have when you play multiplayer. It is considered polite not to leave the name as \'Player\'. It doesn\'t have to be anything special, possibly your nickname, forename, initals, or use your imagination.')),
                                        'rcon_password' => array(self::T_TEXT, NULL, '', _('Configure the dedicated server to accept rcon commands')),
                                        'reload_cfg' => array(self::T_BOOL, NULL, false, _('reload cfg')),
                                        'restart_game_year' => array(self::T_RANGE, array(0, 5000000, 1), 0, _('Config parameter restart_game_year is located in the [NETWORK] section of the OPENTTD.cfg. The value set to this parameter represents the year the server will restart. If the value is set to zero (0) the game will run until it is manually reset. When set, the server will perform a restart on January 1st of value.')),
                                        //~ 'min_players' => array(self::T_INT, NULL, 0, _('min_players')),
                                        'server_advertise' => array(self::T_BOOL, NULL, false, _('This setting may be either true or false. Set it to true if you wish advertise the server to the master server list at http://www.openttd.org/en/servers.')),
                                        'server_bind_ip' => array(self::T_TEXT, NULL, '0.0.0.0', _('IP-address to which the OpenTTD server will bind itself. If you have more than one network connection, you can select the network connection to be used. The default is 0.0.0.0, which means any network connection can be used.')),
                                        'server_lang' => array(self::T_SELECT, array('ANY', 'ENGLISH', 'GERMAN', 'FRENCH', 'BRAZILIAN', 'BULGARIAN', 'CHINESE', 'CZECH', 'DANISH', 'DUTCH', 'ESPERANTO', 'FINNISH', 'HUNGARIAN', 'ICELANDIC', 'ITALIAN', 'JAPANESE', 'KOREAN', 'LITHUANIAN', 'NORWEGIAN', 'POLISH', 'PORTUGUESE', 'ROMANIAN', 'RUSSIAN', 'SLOVAK', 'SLOVENIAN', 'SPANISH', 'SWEDISH', 'TURKISH', 'UKRAINIAN'), 'ANY', _('The language spoken on this server. It is shown by a flag in the server list.')),
                                        'server_name' => array(self::T_TEXT, NULL, '', _('This is the name of your server as shown on the server list.')),
                                        'server_password' => array(self::T_TEXT, NULL, '', _('The password that client has to enter when he/she wants to connect to the server.')),
                                        'server_port' => array(self::T_INT, NULL, 3979, _('Port on which the OpenTTD server runs. The default is 3979. (It use 3978 to contact master server) OpenTTD uses TCP and UDP')),
                                        'server_admin_chat' => array(self::T_BOOL, NULL, true, _('server admin chat')),
                                        'server_admin_port' => array(self::T_INT, NULL, 3977, _('server admin port')),
                                        'admin_password' => array(self::T_TEXT, NULL, '', _('he password clients of the admin interface have to specify in order to be able to use it. A good password should be chosen for security reasons, as the admin interface can be used to control the server (it supports sending RCON commands without any extra check for the RCON password). If no password is set the admin interface isn\'t activated and no listener is started on the port specified in server_admin_port. Even if the listener was started the server would reject any request for that interface as if the password was wrong, making sure the admin interface cannot be used with an empty password.')),
                                        //~ 'bytes_per_frame' => array(self::T_INT, NULL, 8, _('bytes_per_frame')),
                                        //~ 'bytes_per_frame_burst' => array(self::T_INT, NULL, 256, _('bytes_per_frame_burst')),
                                        ),
                     'currency' => array(//~'prefix' => array(self::T_TEXT, NULL, '', _('prefix')),
                                        //~ 'rate' => array(self::T_INT, NULL, 1, _('rate')),
                                        //~ 'separator' => array(self::T_TEXT, NULL, '.', _('separator')),
                                        //~ 'suffix' => array(self::T_TEXT, NULL, ' credits', _('suffix')),
                                        //~ 'to_euro' => array(self::T_INT, NULL, 0, _('prechod to euro')),
                                        ),
                    'company' => array ('engine_renew' => array(self::T_BOOL, NULL, false, _('Vehicles are automatically replaced when they get old, provided that the same vehicle type is still available for purchase.')),
                                        'engine_renew_months' => array(self::T_RANGE, array(-12, 12, 1), 6, _('If autorenew is enabled, a vehicle is automatically renewed the next time it enters a service depot when its age reaches the set amount of months before or after its maximum age.')),
                                        'engine_renew_money' => array(self::T_RANGE, array(0, 2000000, 1), 100000, _('If autorenew is enabled and a vehicle is going to be replaced, the amount money of the player has needs to be more than this value plus the cost of the new vehicle. If the value is, for example, £200,000, a new vehicle costs £10,000 and you have £205,000, the vehicle will not be replaced. Instead, you will get a warning that autorenew has failed on that vehicle.')),
                                        'renew_keep_length' => array(self::T_BOOL, NULL, false, _('renew keep length')),
                                        ),
                    'server_bind_addresses' => array(''),
                    'servers' => array(''),
                    'bans' => array(''),
                    'news_display' => array('acceptance' => array(self::T_SELECT, array('off' => ('Off'), 'summarized' => _('Summarized'), 'full' => _('full')), 'summarized', _('Sometimes conditions around a station change, causing it to accept new cargo or to stop accepting cargo. This is most likely to happen with Passenger, Mail and Goods stations, due to towns being reconstructed.')),
                                            'accident' => array(self::T_SELECT, array('off' => ('Off'), 'summarized' => _('Summarized'), 'full' => _('full')), 'full', _('Information about accidents (e.g. aircraft crashes, train collision, etc) and disasters (e.g. UFO landings)')),
                                            'advice' => array(self::T_SELECT, array('off' => ('Off'), 'summarized' => _('Summarized'), 'full' => _('full')), 'summarized', _('Information about player\'s vehicles (e.g. "Train 1 has too few orders in the schedule").')),
                                            'arrival_other' => array(self::T_SELECT, array('off' => ('Off'), 'summarized' => _('Summarized'), 'full' => _('full')), 'summarized', _('E.g. "First train arrives at..." for competitors\'s stations')),
                                            'arrival_player' => array(self::T_SELECT, array('off' => ('Off'), 'summarized' => _('Summarized'), 'full' => _('full')), 'summarized', _('Arrival of first vehicle at player\'s station')),
                                            'close' => array(self::T_SELECT, array('off' => ('Off'), 'summarized' => _('Summarized'), 'full' => _('full')), 'summarized', _('Closing of industries')),
                                            'company_info' => array(self::T_SELECT, array('off' => ('Off'), 'summarized' => _('Summarized'), 'full' => _('full')), 'summarized', _('New companies being founded, companies being taken over or declared bankrupt.')),
                                            'economy' => array(self::T_SELECT, array('off' => ('Off'), 'summarized' => _('Summarized'), 'full' => _('full')), 'summarized', _('Information about production increase/decrease for industries.')),
                                            'general' => array(self::T_SELECT, array('off' => ('Off'), 'summarized' => _('Summarized'), 'full' => _('full')), 'full', _('General information')),
                                            'new_vehicles' => array(self::T_SELECT, array('off' => ('Off'), 'summarized' => _('Summarized'), 'full' => _('full')), 'summarized', _('Notifications about new vehicles being available.')),
                                            'open' => array(self::T_SELECT, array('off' => ('Off'), 'summarized' => _('Summarized'), 'full' => _('full')), 'summarized', _('Opening of industries')),
                                            'production_nobody' => array(self::T_SELECT, array('off' => ('Off'), 'summarized' => _('Summarized'), 'full' => _('full')), 'summarized', _('Other industry production changes.')),
                                            'production_other' => array(self::T_SELECT, array('off' => ('Off'), 'summarized' => _('Summarized'), 'full' => _('full')), 'summarized', _('Production changes of industries served by competitor(s).')),
                                            'production_player' => array(self::T_SELECT, array('off' => ('Off'), 'summarized' => _('Summarized'), 'full' => _('full')), 'summarized', _('Production changes of industries served by the company.')),
                                            'subsidies' => array(self::T_SELECT, array('off' => ('Off'), 'summarized' => _('Summarized'), 'full' => _('full')), 'summarized', _('Whenever a new subsidy is available or an existing subsidy is withdrawn you\'ll be notified.')),
                                            //~ 'openclose' => array(self::T_SELECT, array('off' => ('Off'), 'summarized' => _('Summarized'), 'full' => _('full')), 'summarized', _('openclose')),
                                            ),
                    'ai_players' => array(''),
                    'version' => array ('version_number' => array(self::T_TEXT, NULL, '1.1.3', _('version number')),
                                        'version_string' => array(self::T_TEXT, NULL, '1138599A', _('version string')),
                                        ),
                    'newgrf' => array(''),  //pridavatelene polozky
                    'newgrf-static' => array(''),
                    );
      return $conf;
    }

//parsrovani a nacitani ini souboru
    private static function loadIniFile($file) {
      $h = new Filesystem($file, Filesystem::MODE_READ);
      $explodefile = explode(PHP_EOL, $h->read());
      $key = NULL;
      $result = array();
      foreach ($explodefile as $row) {
        if (!empty($row)) {
          if ($row[0] == '[') { //vyber klicu
            $key = trim(preg_replace('/\[*\]*/', NULL, $row));
          } else {
            if (!empty($key)) {
              $line = preg_split('/ = | =/', $row, 2);  //explode(' = ', $row, 2);
              $k = trim($line[0]);
              if (!empty($k)) {
                $result[$key][$k] = trim(Core::isFill($line, 1));
              }
            }
          }
        }
      }
      return $result;
    }

//generovani a ukladani ini souboru
    private static function saveIniFile($file, $original, $data) {
      $suma = array_merge($original, $data);

      $func = function($k, $v) { return sprintf('%s = %s', $k, $v); };
      $row = array('');
      foreach ($suma as $group => $values) {
        if (!is_null($values)) {
          $row[] = sprintf('[%s]', $group);
          if (is_array($values)) {
            $r = array_map($func, array_keys($values), $values);
            $row = array_merge($row, $r);
          } else {
            $row[] = $values;
          }
        }
        $row[] = '';
      }
      $complet = implode(PHP_EOL, $row);

      $h = new Filesystem($file, Filesystem::MODE_WRITE);
      $h->write($complet);

      return $h->getState();
    }

    private static function getAdress() {
      return Core::isFill($_GET, self::A_ACTION);
    }

    const P_NEW = 'new';
    const P_LOAD = 'load';
    const P_LIST = 'list';

    const A_ACTION = 'akce';
    const A_ID = 'id';

    public static function getMenu() {
      $adr = self::getAdress();

//var_dump(loadIniFile('openttd.cfg'));
      $result = array(Html::a()->hrefpath('')->setText(_('home')),
                           //->insert(Html::a()->hrefpath('index.php', array(self::A_ACTION => self::P_NEW))->setText(_('new')))
                           //->insert(Html::a()->hrefpath('index.php', array(self::ACTION => self::P_LOAD))->setText(_('load exist')))
                      Html::a()->hrefpath('', array(self::A_ACTION => self::P_LIST))->setText(_('list configs')));
      return $result;
    }

    public static function getContent() {
      $adr = self::getAdress();
      $result = _('entry page :)');

      $mainpath = sprintf('%s/%s', self::$path, self::CONFIG_DIR);

      switch ($adr) {
        case self::P_NEW:
          $result = self::getForm();
        break;

        case self::P_LOAD:
          $id = base64_decode(Core::isFill($_GET, self::A_ID));
          $path = sprintf('%s/%s', $mainpath, $id);
          $inidata = self::loadIniFile($path);
          //var_dump($path, $inidata);
          //print_r($inidata);
          $result = self::getForm($id, $inidata);
        break;

        case self::P_LIST:
          $list = Core::getListFile(array('path' => $mainpath));
          foreach ($list as $item) {
            $row[] = Html::a()->hrefpath('', array(self::A_ACTION => self::P_LOAD, self::A_ID => base64_encode($item)))->setText($item);
          }
          $result = Html::div()->insert(Html::span()->setText(_('here select config file for loading')))->insert($row);
        break;
      }
      return $result;
    }

    private static function getForm($file = 'openttd.cfg', $loadconf = NULL) {
      $f = new Form;
      $f->addGroup('', array('html' => Html::div()->insert(Html::h3()->setText(_('settings')))));
      $f->addText('config_name', array('label' => _('config name'), 'label_span_elem' => 'strong', 'value' => $file, 'returnvalue' => true));

      $conf = self::getConfig();

//TODO popremyslet jestli je vubec nutne delat vytvareni novych... kdyz to stejne bude vychazet zvdycky z nejakoho configu ktery se naklonuje

//TODO mit moznost i pridavat klice? jistych typu?!

      if (!empty($loadconf)) {
        //nacitaci logika
        foreach ($loadconf as $section => $values) {
          //[ '.$section.' ]
          $f->addGroup('', array('html' => Html::div()->insert(Html::h3()->setText($section))));

          $group = array('newgrf', 'preset-');  //slova ktera oshahuje nazev skupiny, pro jiny typ pristupu
          $specialgroup = false;  //specialni skupina je defaultne vypnuta
          foreach ($group as $grp) {
            $specialgroup = (bool) preg_match(sprintf('/%s/', $grp), $section);
            if ($specialgroup) { break; }
          }

          if (!$specialgroup) {
            //vypis klasickych prvku
            foreach ($values as $key => $value) {

              $predef = Core::isFill($conf, $section);
              $item = Core::isFill($predef, $key);

              $name = sprintf('%s[%s]', $section, $key);
              if (!empty($item)) {

                $type = $item[0];
                //FIXME jinak! rozlisovat ulozeni a nacitani!!!
                $val = $item[1];//$value;//(!empty($_POST) ? $value : $item[1]); //value

                $current = (!empty($_POST) ? Core::isFill($_POST[$section], $key) : $value);//$item[2];
                $label = $item[3];

                //nacitani hodnot po skupinach
                switch ($type) {
                  case self::T_BOOL:
                    //$f->addCheckbox($name, array('label' => $label, 'checked' => $current, 'returnvalue' => true));
                    $f->addRadio($name, array('label' => $label, 'label_span_elem' => 'strong', 'value' => array('true' => 'on', 'false' => 'off'), 'selected' => $current, 'returnvalue' => true));
                  break;

                  case self::T_TEXT:
                  case self::T_INT: //TODO asi jen rozdil v typovani!
                    $f->addText($name, array('label' => $label, 'label_span_elem' => 'strong', 'value' => $current, 'returnvalue' => true));
                  break;

                  case self::T_TEXTAREA:
                    $f->addTextArea($name, array('label' => $label, 'label_span_elem' => 'strong', 'cols' => 100, 'rows' => 10, 'value' => $current, 'returnvalue' => true));
                  break;

                  case self::T_RANGE:
                    //$f->addRange($key, array('label' => $label, 'value' => $current, 'min' => $val[0], 'max' => $val[1], 'step' => $val[2], 'returnvalue' => true));
                    $f->addNumber($name, array('label' => $label, 'label_span_elem' => 'strong', 'value' => $current, 'title' => sprintf('<%s-%s>', $val[0], $val[1]), 'min' => $val[0], 'max' => $val[1], 'step' => $val[2], 'returnvalue' => true));
                  break;

                  case self::T_SELECT:
                    $f->addSelect($name, array('label' => $label, 'label_span_elem' => 'strong', 'selected' => $current, 'value' => $val, 'returnvalue' => true));
                  break;

                  default:
                    $f->addTextArea($name);
                    var_dump('chyby: '.$name);
                  break;
                }
              } else {
                //neuvedena moznost v konfigu
                $f->addText($name, array('label' => sprintf('%s', $key), 'self_elem' => Html::em()->setText(_('Není známo podrobnější info')), 'label_span_elem' => 'strong', 'value' => htmlspecialchars($value), 'returnvalue' => true));
              }
            }
          } else {
            //vypis specialnich skupiny

            //slozeni radku a uprava lomitek - defaltne pro linux!
            $func = function($k, $v) { $lom = str_replace('\\', '/', $k);  return sprintf('%s = %s', $lom, $v); };
            $val = implode(PHP_EOL, array_map($func, array_keys($values), $values));

            $f->addTextArea($section, array('value' => $val, 'cols' => 100, 'rows' => 10, 'returnvalue' => true));
          }

        }
      } else {
        //vytvareci logika
        //FIXME melo by asi vychazet ze stavajiciho konfigu, aby se napevno neurcovaly veci ktere se mohou postupec casu menit???
      }

      $f->endGroup()
        ->addSubmit('tl', array('value' => _('save configuration'), 'label_class' => 'submit'));

      if ($f->isSubmitted()) {
        $post = $_POST;

        $file = Core::isFill($post, 'config_name');
        //vyhozeni prebytecnych indexu
        $post['tl'] = NULL;
        $post['config_name'] = NULL;

        $path = sprintf('%s/%s', self::CONFIG_DIR, $file);

        if (self::saveIniFile($path, $loadconf, $post)) {
          echo _('uspesne ulozeno');
          //presmerovani na nove vytvoreniy config
          Core::setRefresh(1, Core::makeUrl(self::$weburl, array('query' => array(self::A_ACTION => self::P_LOAD, self::A_ID => base64_encode($file)))));
        } else {
          echo _('neco se asi pokakalo...');
        }
      }

      return $f;
    }
  }

?>
