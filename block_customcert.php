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
 * Custom certificate ranking block definition
 *
 * @package    block_customcert
 * @copyright  2018 Willian Mano http://conecti.me
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Custom certificate block definition class
 *
 * @copyright  2018 Willian Mano http://conecti.me
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_customcert extends block_base {

    /**
     * Sets the block title
     *
     * @return void
     *
     * @throws coding_exception
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_customcert');
    }

    /**
     * Defines where the block can be added
     *
     * Restricting where the blocks can appear on the site (Frontpage and My Learning page only).
     *
     * @return array
     */
    public function applicable_formats() {
        return array(
            'all' => true,
            'course-view' => false,
            'site' => false,
            'mod' => false
        );
    }

    /**
     *
     * Multiple instances of the block.
     *
     * Allowing multiple instance of the block to appear throughtout the site pages.
     */
    public function instance_allow_multiple() {
        return true;
    }

    /**
     * Creates the blocks main content
     *
     * @return string
     *
     * @throws coding_exception
     * @throws moodle_exception
     */
    public function get_content() {
        $this->content = new stdClass;
        $this->content->text = '';
        $this->content->footer = '';

        $renderable = new \block_customcert\output\block();

        $renderer = $this->page->get_renderer('block_customcert');

        $this->content->text = $renderer->render($renderable);

        $this->content->footer .= html_writer::tag('p',
            html_writer::link(
                new moodle_url(
                    '/blocks/customcert/issuedcertificates.php'
                ),
                get_string('allissuedcertificates', 'block_customcert'),
                array('class' => 'btn btn-default')
            )
        );

        return $this->content;
    }
}
