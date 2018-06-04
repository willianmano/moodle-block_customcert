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
 * Custom certificate local lib.
 *
 * @package    block_customcert
 * @copyright  2018 Willian Mano http://conecti.me
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_customcert;

defined('MOODLE_INTERNAL') || die();

/**
 * Custom certificate main utillity class
 *
 * @package    block_customcert
 * @copyright  2018 Willian Mano http://conecti.me
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class customcertlib {
    /**
     * Return an array with the issued user certificates
     *
     * @return array
     *
     * @throws \dml_exception
     */
    public static function get_certificates($limit = null) {
        global $DB, $USER;

        $sql = "SELECT ci.id, cm.id as cmid, ci.code, co.fullname as coursename, c.name, ci.timecreated
                FROM {customcert_issues} ci
                INNER JOIN {customcert} c ON c.id = ci.customcertid
                INNER JOIN {course_modules} cm ON cm.instance = c.id
                INNER JOIN {modules} m ON cm.module = m.id
                INNER JOIN {course} co ON co.id = cm.course
                WHERE ci.userid = :userid AND m.name = 'customcert'
                ORDER BY ci.timecreated DESC";

        $params['userid'] = $USER->id;

        if ($limit) {
            $sql .= " LIMIT {$limit}";
        }

        return $DB->get_records_sql($sql, $params);
    }

    /**
     * Return an array with the issued user certificates
     *
     * @return array
     *
     * @throws \dml_exception
     */
    public static function get_certificates_withcourseinfo($limit = null) {
        global $DB, $USER;

        $sql = "SELECT
                  ci.id,
                  cm.id as cmid,
                  ci.code,
                  co.fullname as coursename,
                  cc.name as category,
                  gg.finalgrade as grade,
                  c.name,
                  ci.timecreated
                FROM {customcert_issues} ci
                INNER JOIN {customcert} c ON c.id = ci.customcertid
                INNER JOIN {course_modules} cm ON cm.instance = c.id
                INNER JOIN {modules} m ON cm.module = m.id
                INNER JOIN {course} co ON co.id = cm.course
                INNER JOIN {course_categories} cc ON cc.id = co.category
                LEFT JOIN {grade_items} gi ON (gi.courseid = co.id AND gi.itemtype = 'course')
                LEFT JOIN {grade_grades} gg ON gg.itemid = gi.id
                WHERE ci.userid = :userid AND m.name = 'customcert' AND co.visible = 1
                ORDER BY ci.timecreated DESC";

        $params['userid'] = $USER->id;

        if ($limit) {
            $sql .= " LIMIT {$limit}";
        }

        return $DB->get_records_sql($sql, $params);
    }


}
