<?php
require_once('_theme_functions.php');
require_once('_main_paths.php');
require_once('_image_functions.php');

global $picsroot;

global $OldTheme;
global $ClassicTheme;
global $NewTheme;
global $PlainTheme;
global $Q3Theme;
global $ValveTheme;
$OldTheme = 'oldtheme';
$ClassicTheme = 'classictheme';
$GreenTheme = 'greentheme';
$PlainTheme = 'plaintheme'; //FIXME: Not used currently
$Q3Theme = 'q3theme';
$ValveTheme = 'valvetheme';

# FIXME: Default to Classic theme for now
global $DefaultTheme;
$DefaultTheme = $ClassicTheme;

global $Themes;
$Themes = array($OldTheme => new cTheme('old', 'Old theme', 'themes/old/style.css', $picsroot.'themes/old/theme-preview.jpg', true,
                             array('quarklogo' => new cImage($picsroot.'themes/old/quark_logo.gif', 'QuArK Logo', '320', '65')
                                  ,'php'       => new cImage($picsroot.'smlbanners/php-power-white.gif', 'Powered by PHP', '88', '31')
                                  ,'validhtml' => new cImage('http://www.w3.org/Icons/valid-html401-blue', 'Valid HTML 4.01 Transitional', '88', '31')
                                  ,'validcss'  => new cImage('http://jigsaw.w3.org/css-validator/images/vcss-blue', 'Valide CSS!', '88', '31'))
                             )
               ,$ClassicTheme => new cTheme('classic', 'Classic theme', 'themes/classic/style.css', $picsroot.'themes/classic/theme-preview.jpg', true,
                                 array('quarklogo'   => new cImage($picsroot.'themes/classic/quark_logo.gif', 'QuArK Logo', '320', '65')
                                      ,'downloadnow' => new cImage($picsroot.'download_button2.gif', 'Download button', '88', '32')
                                      ,'instapoll'   => new cImage($picsroot.'themes/classic/instapoll.gif', '', '0', '5'))
                                 )
               ,$GreenTheme => new cTheme('green', 'Green theme', 'themes/green/style.css', $picsroot.'themes/green/theme-preview.jpg', true,
                               array('quarklogo'   => new cImage($picsroot.'themes/green/quark_logo.png', 'QuArK Logo', '320', '65')
                                    ,'downloadnow' => new cImage($picsroot.'download_button3.gif', 'Download button', '88', '32'))
                             )
               ,$PlainTheme => new cTheme('plain', 'Plain theme', 'themes/plain/style.css', $picsroot.'themes/plain/theme-preview.jpg', false,
                               array('quarklogo' => new cImage($picsroot.'themes/plain/quark_logo.png', 'QuArK Logo', '320', '65'))
                               )
               ,$Q3Theme => new cTheme('q3', 'Quake 3 theme', 'themes/q3/style.css', $picsroot.'themes/q3/theme-preview.jpg', true,
                            array('quarklogo'   => new cImage($picsroot.'themes/q3/quark_logo.png', 'QuArK Logo', '320', '65')
                                 ,'downloadnow' => new cImage($picsroot.'download_button2.gif', 'Download button', '88', '32')
                                 ,'php'         => new cImage($picsroot.'smlbanners/php-power-black.png', 'Powered by PHP', '88', '31')
                                 ,'down'        => new cImage($picsroot.'themes/q3/down.gif', 'down', '12', '16', 'style="padding-left: 4px;"')
                                 ,'downright'   => new cImage($picsroot.'themes/q3/downright.gif', 'downright', '12', '16', 'style="padding-left: 4px;"')
                                 ,'right'       => new cImage($picsroot.'themes/q3/right.gif', 'right', '12', '16', 'style="padding-left: 4px;"')
                                 ,'instapoll'   => new cImage($picsroot.'themes/q3/instapoll.gif', '', '0', '5'))
                            )
               ,$ValveTheme => new cTheme('valve', 'Valve theme', 'themes/valve/style.css', $picsroot.'themes/valve/theme-preview.jpg', true,
                               array('quarklogo'   => new cImage($picsroot.'themes/valve/quark_logo.png', 'QuArK Logo', '380', '96')
                                    ,'downloadnow' => new cImage($picsroot.'download_button2.gif', 'Download button', '88', '32')
                                    ,'php'         => new cImage($picsroot.'smlbanners/php-power-black.png', 'Powered by PHP', '88', '31')
                                    ,'down'        => new cImage($picsroot.'themes/q3/down.gif', 'down', '12', '16', 'style="padding-left: 4px;"')
                                    ,'downright'   => new cImage($picsroot.'themes/q3/downright.gif', 'downright', '12', '16', 'style="padding-left: 4px;"')
                                    ,'right'       => new cImage($picsroot.'themes/q3/right.gif', 'right', '12', '16', 'style="padding-left: 4px;"')
                                    ,'instapoll'   => new cImage($picsroot.'themes/q3/instapoll.gif', '', '0', '5'))
                            )
               );
?>
