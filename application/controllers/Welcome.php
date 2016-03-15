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

	public function search() {
		// don't know how to do this...
		$this->index();
	}
}
