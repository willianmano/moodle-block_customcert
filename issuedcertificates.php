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
 * Custom certificate block - All issued certificates page
 *
 * @package    block_customcert
 * @copyright  2018 Willian Mano http://conecti.me
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(__DIR__ . '/../../config.php');

require_login();

$context = context_system::instance();

$url = new moodle_url('/blocks/customcert/issuedcertificates.php');
$PAGE->set_context($context);
$PAGE->set_url($url);
$PAGE->set_title(get_string('issuedcertificates', 'block_customcert'));
$PAGE->set_pagelayout('standard');

// Add the page nav to breadcrumb.
$PAGE->navbar->add(get_string('issuedcertificates', 'block_customcert'));

$output = $PAGE->get_renderer('block_customcert');

echo $output->header();
echo $output->heading(get_string('issuedcertificates', 'block_customcert'));
echo $output->container_start('customcert-issuedcertificates');

$page = new \block_customcert\output\issuedcertificates_page();

echo $output->render($page);

echo $output->container_end();

echo $OUTPUT->footer();
