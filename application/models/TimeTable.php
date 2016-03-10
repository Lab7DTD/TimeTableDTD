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
    //Days of the week dropdown list
    protected $daysofweek = array();
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
            $this->days[$record->day] = $record;

            // Will need to add booking object after class contructor is created
        }

        foreach ($this->xml->periods->period as $period) {
            $record = stdclass();
            $record->timeslot = (string) $period['timeslot'];
            $this->periods[$record->period] = $record;
        }

        foreach ($this->xml->courses->session as $session) {
            $record = stdClass();
            $record->title = $session->title;
            $record->period = $session->period;
            $record->timeslot = (string) $period['timeslot'];
            $record->day = (string) $period['day'];
            $this->courses[$record->session] = $record;
        }
    }

}

// Booking class contructor goes here