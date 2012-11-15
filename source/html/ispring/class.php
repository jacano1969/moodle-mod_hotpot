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
 * Class to represent the source of a HotPot quiz
 * Source type: html_ispring
 *
 * @package   mod-hotpot
 * @copyright 2010 Gordon Bateson <gordon.bateson@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// get parent class
require_once($CFG->dirroot.'/mod/hotpot/source/html/class.php');

/**
 * hotpot_source_html_ispring
 *
 * @copyright 2010 Gordon Bateson
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since     Moodle 2.0
 */
class hotpot_source_html_ispring extends hotpot_source_html {
    // properties of the icon for this source file type
    public $icon = 'mod/hotpot/file/html/ispring/icon.gif';

    // returns hotpot_source object if $filename is a quiz file, or false otherwise

    /**
     * is_quizfile
     *
     * @param xxx $sourcefile
     * @return xxx
     */
    public static function is_quizfile($sourcefile)  {
        if (! preg_match('/\.html?$/', $sourcefile->get_filename())) {
            // wrong file type
            return false;
        }

        if (! $content = $sourcefile->get_content()) {
            // empty or non-existant file
            return false;
        }

        if (! preg_match('/<!--\s*<!DOCTYPE[^>]*>\s*-->/', $content)) {
            // no fancy DOCTYPE workarounds for IE6
            return false;
        }

        // detect <object ...>, <embed ...> and self-closing <script ... /> tags
        if (! preg_match('/<object[^>]*id="presentation"[^>]*>/', $content)) {
            return false;
        }

        if (! preg_match('/<embed[^>]*name="presentation"[^>]*>/', $content)) {
            return false;
        }

        if (! preg_match('/<script[^>]*src="[^">]*fixprompt.js"[^>]*\/>/', $content)) {
            return false;
        }

        return true;
    }

    // returns the introduction text for a quiz

    /**
     * get_entrytext
     *
     * @return xxx
     */
    function get_entrytext()  {
        return '';
    }
} // end class