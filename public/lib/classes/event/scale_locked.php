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
 * Scale locked event.
 *
 * @package    core
 * @copyright  2026 Franziska Hübler
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

/**
 * Scale locked event.
 *
 * @package    core
 * @copyright  2026 Franziska Hübler
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class scale_locked extends base {
    /**
     * Init method, set basic properties for the event.
     *
     * @return void
     */
    protected function init(): void {
        $this->data['objecttable'] = 'scale';
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name(): string {
        return get_string('eventscalelocked', 'core_grades');
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description(): string {
        if ($this->courseid) {
            return "The user with id '$this->userid' locked the custom scale with id '$this->objectid'" .
                    " from the course with the id '" . $this->courseid . "'.";
        }

        return "The user with id '$this->userid' locked the standard scale with id '$this->objectid'.";
    }

    /**
     * Returns relevant URL.
     *
     * @return \moodle_url
     */
    public function get_url(): \moodle_url {
        $url = new \moodle_url('/grade/edit/scale/index.php');
        if ($this->courseid) {
            $url->param('id', $this->courseid);
        }
        return $url;
    }

    /**
     * Used for mapping events on restore
     *
     * @return array
     */
    public static function get_objectid_mapping(): array {
        return ['db' => 'scale', 'restore' => 'scale'];
    }
}
