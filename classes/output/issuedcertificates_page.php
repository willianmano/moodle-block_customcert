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
 * Custom certificate block - map raking page
 *
 * @package    block_customcert
 * @copyright  2018 Willian Mano http://conecti.me
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace block_customcert\output;

defined('MOODLE_INTERNAL') || die();

use block_customcert\customcertlib;
use renderable;
use templatable;
use renderer_base;

/**
 * Issued certificates page renderable class.
 *
 * @package    block_customcert
 * @copyright  2018 Willian Mano http://conecti.me
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class issuedcertificates_page implements renderable, templatable {

    /** @var array certificates. */
    protected $certificates;

    /**
     * Constructor.
     *
     * @param int $groupid The group id
     *
     * @return void
     */
    public function __construct() {
        $this->certificates = customcertlib::get_certificates_withcourseinfo();
    }

    /**
     * Export the data.
     *
     * @param renderer_base $output
     *
     * @return array
     */
    public function export_for_template(renderer_base $output) {
        $certificates = [];

        if (count($this->certificates) > 0) {
            foreach ($this->certificates as $certificate) {
                $certificates[] = [
                    'id' => $certificate->id,
                    'cmid' => $certificate->cmid,
                    'code' => $certificate->code,
                    'coursename' => $certificate->coursename,
                    'name' => $certificate->name,
                    'category' => $certificate->category,
                    'credits' => $certificate->credits,
                    'year' => date('Y', $certificate->timecreated)
                ];
            }
        }

        return ['certificates' => $certificates];
    }
}
