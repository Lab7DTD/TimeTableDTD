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
        parent::construct();
        $this->xml = simplexml_load_file(DATAPATH."TimeTable.xml");

        foreach ($this->xml->days->day as $day) {
            $record = stdClass();
            $record->dayofweek = (string) $day['dayofweek'];
            $record->bookings = array();


            foreach($day->booking as $booking) {

                array_push($record->bookings, new Booking($booking));

            }

            array_push($this->days, $record);

        }

        foreach ($this->xml->periods->period as $period) {
            $record = stdclass();
            $record->timeslot = (string) $period['timeslot'];
            $record->bookings = array();

            foreach($period->booking as $booking) {

                array_push($record->bookings, new Booking(($booking)));

            }

            array_push($this->periods, $record);

        }

        foreach ($this->xml->courses->session as $session) {
            $record = stdClass();
            $record->title = $session->title;
            $record->period = $session->period;
            $record->timeslot = (string) $period['timeslot'];
            $record->day = (string) $period['day'];
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
        (   "Monday"    => "Monday",
            "Tuesday"   => "Tuesday",
            "Wednesday" => "Wednesday",
            "Thursday"  => "Thursday",
            "Friday"    => "Friday");
    }
    function getTimeslots() {
        return array
        (   "8:30"   => "8:30",
            "9:30"   => "9:30",
            "10:30"  => "10:30",
            "11:30"  => "11:30",
            "12:30"  => "12:30",
            "1:30"   => "1:30",
            "2:30"   => "2:30",
            "3:30"   => "3:30",
            "4:30"   => "4:30");
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
        parent::construct();

        $this->day = (isset($booking['day'])) ? (string) $booking['day'] : null;
        $this->type = (isset($booking['type'])) ? (string) $booking['type'] : null;
        $this->timeslot = (isset($booking['timeslot']))? (string) $booking['timeslot'] : null;
        $this->cname = (isset($booking->course['cname'])) ? (string) $booking->course['cname'] : null;
        $this->instructor = (string) $booking->instructor;
        $this->building = (isset($booking->room['building'])) ? (string) $booking->room['building'] : null;
        $this->roomNum = (string) $booking->room['roomNum'];

    }
}