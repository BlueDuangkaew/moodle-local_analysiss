<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin version and other meta-data are defined here.
 *
 * @package     local_analysiss
 * @copyright   2024 Kadpon Duangkaew (Blue) <kduangka@cmkl.ac.th>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 require_once('../../config.php');

 require_login();
 
 
 $context = context_system::instance();
 $PAGE->set_context($context);
 $PAGE->set_url(new moodle_url('/local/analysiss/index.php'));
 $PAGE->set_pagelayout('standard');
 $PAGE->set_title($SITE->fullname);
 $PAGE->set_heading(get_string('pluginname', 'local_analysiss'));
 $PAGE->requires->css('/local/analysiss/style.css');

 $result = $DB->get_records("user_info_data", array()); // get all records in mdl_user table

 foreach ($result as $record) {

    if ($record->fieldid == 1) {
        //Get ages
        $ages[] = $record->data;
    }
    elseif ($record->fieldid == 2) {
        //Get gender
        $gender[] = $record->data;
    }
    elseif ($record->fieldid == 3) {
        //Get edu
        $education[] = $record->data;
    }
    elseif ($record->fieldid == 4) {
        //Get ethnic
        $ethnic[] = $record->data;
    }

 } 

 $templatecontext = [
    'firstname' => $USER->firstname,
    'lastname' => $USER->lastname,
    'ages' => $ages,
    'gender' => $gender,
    'education' => $education,
    'ethnic' => $ethnic,
 ];

 echo $OUTPUT->header();

 echo $OUTPUT->render_from_template('local_analysiss/graph', $templatecontext);

 echo $OUTPUT->footer();