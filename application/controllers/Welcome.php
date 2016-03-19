<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//$this->load->view('welcome_message');
		$this->data['pagebody']   = 'home';
		$this->data['days'] = $this->TimeTable->getDays();
		$this->data['periods'] = $this->TimeTable->getPeriods();
		$this->data['courses'] = $this->TimeTable->getCourses();
		$this->data['day_dropdown'] = form_dropdown('day', $this->TimeTable->getDaysOfWeek());
		$this->data['time_dropdown'] = form_dropdown('time', $this->TimeTable->getTimeslots());
		$this->render();
	}

	public function search()
	{
		// don't know how to do this...
		//$this->index();
		$error = false;
		$day = $this->input->post('day');
		$time = $this->input->post('timeslot');
		$this->data['days'] = $this->TimeTable->getDays();
		$this->data['periods'] = $this->TimeTable->getPeriods();
		$this->data['courses'] = $this->TimeTable->getCourses();
		$this->data['day_dropdown'] = form_dropdown('day', $this->TimeTable->getDaysOfWeek());
		$this->data['time_dropdown'] = form_dropdown('time', $this->TimeTable->getTimeslots());
		$days = $this->TimeTable->getBookingsInDays($day, $time);
		$periods = $this->TimeTable->getBookingsInPeriods($day, $time);
		$courses = $this->TimeTable->getBookingsInCourses($day, $time);
		$check = array();
		$this->data['pagebody'] = "home";
		if (count($days) != 1) {
			$this->data['error'] = "ERROR: By Days has more/less bookings returned than 1";
			$error = true;
		}
		if (count($periods) != 1) {
			$this->data['error'] = "ERROR: By Periods has more/less bookings returned than 1";
			$error = true;
		}
		if (count($courses) != 1) {
			$this->data['error'] = "ERROR: By Courses has more/less bookings returned than 1";
			$error = true;
		}
		if (!$error) {
			$result = array();
			foreach ($days[0] as $key => $info) {
				if (isset($info))
					$result[$key] = $info;
				array_push($check, $info);
			}
			foreach ($periods[0] as $key => $info) {
				if (isset($info))
					$result[$key] = $info;
				array_push($check, $info);
			}
			foreach ($courses[0] as $key => $info) {
				if (isset($info))
					$result[$key] = $info;
				array_push($check, $info);
			}
			$check = array_filter(array_unique($check));
			if (count($check) != 8 || count($result) != 8) {
				$this->data['error'] = "ERROR: All three bookings returned are not the same";
				$error = true;
			}
		}
		if ($error) {
			$this->data['results'] = "";
			$this->data['bingo'] = "";
			$this->render();
			return;
		} else {
			$this->data['error'] = "";
			$this->data['bingo'] = "Bingo";
			$this->data['results'] = "Day: " . $result['day']
					. " Time: " . $result['time']
					. " Type: " . $result['type']
					. " Course: " . $result['course']
					. " Instructor: " . $result['first_name'] . " " . $result['last_name']
					. " Building: " . $result['building']
					. " Room: " . $result['number'];
			$this->render();
		}
	}
}
