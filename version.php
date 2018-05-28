<?php
// This file is part of Ranking block for Moodle - http://moodle.org/
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
 * Custom certificate block version details
 *
 * @package    block_customcert
 * @copyright  2018 Willian Mano http://conecti.me
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 // This line protects the file from being accessed by a URL directly.
 defined('MOODLE_INTERNAL') || die();

 // This is the version of the plugin.
 $plugin->version = 2018052500;

 // This is the version of Moodle this plugin requires.
 $plugin->requires = 2017111300;

// The component name.
 $plugin->component = 'block_customcert';

 // This is the named version.
 $plugin->release = '1.0.0';

 // This is a stable release.
 $plugin->maturity = MATURITY_STABLE;

// This is a list of plugins, this plugin depends on (and their versions).
$plugin->dependencies = [
    'mod_customcert' => 2017111301
];
