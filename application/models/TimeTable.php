<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 2016-03-09
 * Time: 10:24 AM
 */

class TimeTable extends CI_Model {

    // xml file var
    protected $xml = null;
    // Days facet
    protected $days = array();
    // Period sections facet
    protected $periods = array();
    // Specific course facet
    protected $courses = array();


    public function __construct()
    {
        parent::__construct();
        $this->xml = simplexml_load_file(DATAPATH."TimeTable.xml");

        foreach ($this->xml->days->day as $day) {
            $record = new stdClass();
            $record->dayofweek = (string) $day -> dayofweek;
            $record->bookings = array();


            foreach($day->booking as $booking) {

                array_push($record->bookings, new Booking($booking));

            }

            array_push($this->days, $record);

        }

        foreach ($this->xml->periods->period as $period) {
            $record = new stdclass();
            $record->timeslot = (string) $period['timeslot'];
            $record->bookings = array();

            foreach($period->booking as $booking) {

                array_push($record->bookings, new Booking(($booking)));

            }

            array_push($this->periods, $record);

        }

        foreach ($this->xml->courses->session as $session) {
            $record = new stdClass();
            $record->title = (string) $session->title;
            $record->bookings = array();

            foreach($session->booking as $booking) {

                array_push($record->bookings, new Booking($booking));

            }

            array_push($this->courses, $record);

        }
    }

    public function getDays()
    {
        return $this->days;
    }

    public function getCourses()
    {
        return $this->courses;
    }

    public function getPeriods()
    {
        return $this->periods;
    }

    function getDaysOfWeek() {
        return array
        (   "monday"    => "Monday",
            "tuesday"   => "Tuesday",
            "wednesday" => "Wednesday",
            "thursday"  => "Thursday",
            "friday"    => "Friday");
    }
    function getTimeslots() {
        return array
        (   "830"   => "8:30",
            "930"   => "9:30",
            "1030"  => "10:30",
            "1130"  => "11:30",
            "1230"  => "12:30",
            "130"   => "1:30",
            "230"   => "2:30",
            "330"   => "3:30",
            "430"   => "4:30");
    }

    function getBookingsInDays($day, $timeslot) {

        $records = array();
        foreach($this->days as $findDay) {
            if($findDay->dayofweek == $day) {
                foreach($findDay->bookings as $dayBooked) {
                    if($dayBooked->timeslot == $timeslot) {
                        array_push($records,$dayBooked);
                    }
                }
            }
        }

        return $records;

    }

    function getBookingsInPeriods($day, $timeslot) {

        $records = array();
        foreach($this->periods as $findPeriod) {
            if($findPeriod->timeslot == $timeslot) {
                foreach($findPeriod->bookings as $periodBooked) {
                    if($periodBooked->day == $day) {
                        array_push($records,$periodBooked);
                    }
                }
            }
        }

        return $records;

    }

    function getBookingsInCourses($day, $timeslot) {

        $records = array();
        foreach($this->courses as $findCourse) {
            foreach($findCourse->bookings as $courseBooked) {
                if($courseBooked->day == $day && $courseBooked->timeslot == $timeslot) {
                    array_push($records, $courseBooked);
                }
            }
        }

        return $records;

    }

}

// Booking class contructor goes here
class Booking extends CI_Model {

    public $day = null;
    public $type = null;
    public $timeslot = null;
    public $cname = null;
    public $instructor = '';
    public $building = null;
    public $roomNum = '';


    public function __construct($booking)
    {
        parent::__construct();

        $this->day = (isset($booking['day'])) ? (string) $booking['day'] : null;
        $this->type = (isset($booking['type'])) ? (string) $booking['type'] : null;
        $this->timeslot = (isset($booking['timeslot']))? (string) $booking['timeslot'] : null;
        $this->cname = (isset($booking->course['cname'])) ? (string) $booking->course['cname'] : null;
        $this->instructor = (string) $booking->instructor;
        $this->building = (isset($booking->room['building'])) ? (string) $booking->room['building'] : null;
        $this->roomNum = (string) $booking->room['roomNum'];

    }
}