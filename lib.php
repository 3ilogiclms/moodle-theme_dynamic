<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Library functions for the Dynamic theme
 *
 * @package   theme_dynamic
 * @copyright 2010 Caroline Kennedy of Synergy Learning
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Dynamic theme post process function for CSS
 * @param string $css Incoming CSS to process
 * @param stdClass $theme The theme object
 * @return string The processed CSS
 */
function dynamic_process_css($css, $theme) {

    if (!empty($theme->settings->regionwidth)) {
        $regionwidth = $theme->settings->regionwidth;
    } else {
        $regionwidth = null;
    }
    $css = dynamic_set_regionwidth($css, $regionwidth);

    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = dynamic_set_customcss($css, $customcss);

    // Set the link color
    if (!empty($theme->settings->linkcolor)) {
        $linkcolor = $theme->settings->linkcolor;
    } else {
        $linkcolor = null;
    }
    $css = dynamic_set_linkcolor($css, $linkcolor);


    // Set the blockheadercolor
    if (!empty($theme->settings->blockheadercolor)) {
        $blockheadercolor = $theme->settings->blockheadercolor;
    } else {
        $blockheadercolor = null;
    }
    $css = dynamic_set_blockheadercolor($css, $blockheadercolor);

    // Set the blockheaderbg
    if (!empty($theme->settings->blockheaderbg)) {
        $blockheaderbg = $theme->settings->blockheaderbg;
    } else {
        $blockheaderbg = null;
    }
    $css = dynamic_set_blockheaderbg($css, $blockheaderbg);

    // Set the menubg
    if (!empty($theme->settings->menubg)) {
        $menubg = $theme->settings->menubg;
    } else {
        $menubg = null;
    }
    $css = dynamic_set_menubg($css, $menubg);

    // Set the menubg
    if (!empty($theme->settings->menulinkhover)) {
        $menulinkhover = $theme->settings->menulinkhover;
    } else {
        $menulinkhover = null;
    }
    $css = dynamic_set_menulinkhover($css, $menulinkhover);

    // Set the menubg
    if (!empty($theme->settings->menucolor)) {
        $menucolor = $theme->settings->menucolor;
    } else {
        $menucolor = null;
    }
    $css = dynamic_set_menucolor($css, $menucolor);


    // Set the menucolorhover
    if (!empty($theme->settings->menucolorhover)) {
        $menucolorhover = $theme->settings->menucolorhover;
    } else {
        $menucolorhover = null;
    }
    $css = dynamic_set_menucolorhover($css, $menucolorhover);

    // Set the menucolorhover
    if (!empty($theme->settings->footerbg)) {
        $footerbg = $theme->settings->footerbg;
    } else {
        $footerbg = null;
    }
    $css = dynamic_set_footerbg($css, $footerbg);

    return $css;
}

/**
 * Sets the region width variable in CSS
 *
 * @param string $css
 * @param mixed $regionwidth
 * @return string
 */
function dynamic_set_regionwidth($css, $regionwidth) {
    $tag = '[[setting:regionwidth]]';
    $doubletag = '[[setting:regionwidthdouble]]';
    $leftmargintag = '[[setting:leftregionwidthmargin]]';
    $rightmargintag = '[[setting:rightregionwidthmargin]]';
    $replacement = $regionwidth;
    if (is_null($replacement)) {
        $replacement = 240;
    }
    $css = str_replace($tag, $replacement . 'px', $css);
    $css = str_replace($doubletag, ($replacement * 2) . 'px', $css);
    $css = str_replace($rightmargintag, ($replacement * 3 - 5) . 'px', $css);
    $css = str_replace($leftmargintag, ($replacement + 5) . 'px', $css);
    return $css;
}

/**
 * Sets the custom css variable in CSS
 *
 * @param string $css
 * @param mixed $customcss
 * @return string
 */
function dynamic_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (is_null($replacement)) {
        $replacement = '';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Adds the JavaScript for the colour switcher to the page.
 *
 * The colour switcher is a YUI moodle module that is located in
 *     theme/dynamic/yui/dynamic/dynamic.js
 *
 * @param moodle_page $page 
 */
function dynamic_initialise_colourswitcher(moodle_page $page) {
    user_preference_allow_ajax_update('theme_dynamic_chosen_colour', PARAM_ALPHA);
    $page->requires->yui_module('moodle-theme_dynamic-colourswitcher', 'M.theme_dynamic.initColourSwitcher', array(array('div' => '#colourswitcher')));
}

/**
 * Gets the colour the user has selected, or the default if they have never changed
 *
 * @param string $default The default colour to use, normally red
 * @return string The colour the user has selected
 */
function dynamic_get_colour($default = 'red') {
    return get_user_preferences('theme_dynamic_chosen_colour', $default);
}

/**
 * Checks if the user is switching colours with a refresh (JS disabled)
 *
 * If they are this updates the users preference in the database
 *
 * @return bool
 */
function dynamic_check_colourswitch() {
    $changecolour = optional_param('dynamiccolour', null, PARAM_ALPHA);
    if (in_array($changecolour, array('red', 'green', 'blue', 'orange'))) {
        return set_user_preference('theme_dynamic_chosen_colour', $changecolour);
    }
    return false;
}

/**
 * Sets the link color variable in CSS
 *
 */
function dynamic_set_linkcolor($css, $linkcolor) {
    $tag = '[[setting:linkcolor]]';
    $replacement = $linkcolor;
    if (is_null($replacement)) {
        $replacement = '#2d83d5';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the link color variable in CSS
 *
 */
function dynamic_set_footerbg($css, $footerbg) {
    $tag = '[[setting:footerbg]]';
    $replacement = $footerbg;
    if (is_null($replacement)) {
        $replacement = '#5b0f01';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the font color of block header variable in CSS
 *
 */
function dynamic_set_blockheadercolor($css, $blockheadercolor) {
    $tag = '[[setting:blockheadercolor]]';
    $replacement = $blockheadercolor;
    if (is_null($replacement)) {
        $replacement = '#32529a';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the font color of block header variable in CSS
 *
 */
function dynamic_set_blockheaderbg($css, $blockheaderbg) {
    $tag = '[[setting:blockheaderbg]]';
    $replacement = $blockheaderbg;
    if (is_null($replacement)) {
        $replacement = '#32529a';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the font color of block header variable in CSS
 *
 */
function dynamic_set_menubg($css, $menubg) {
    $tag = '[[setting:menubg]]';
    $replacement = $menubg;
    if (is_null($replacement)) {
        $replacement = '#000000';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the Background color of Menu Link Hover variable in CSS
 *
 */
function dynamic_set_menulinkhover($css, $menulinkhover) {
    $tag = '[[setting:menulinkhover]]';
    $replacement = $menulinkhover;
    if (is_null($replacement)) {
        $replacement = '#5b0f01';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the font color of Menu Link variable in CSS
 *
 */
function dynamic_set_menucolor($css, $menucolor) {
    $tag = '[[setting:menucolor]]';
    $replacement = $menucolor;
    if (is_null($replacement)) {
        $replacement = '#ffffff';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the font color of Menu Link variable in CSS
 *
 */
function dynamic_set_menucolorhover($css, $menucolorhover) {
    $tag = '[[setting:menucolorhover]]';
    $replacement = $menucolor;
    if (is_null($replacement)) {
        $replacement = '#000000';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}
