<?php
	// Destroying All Sessions
	if($this->session->sess_destroy()) 
	{
		$this->load->view('controller/login');
	}
?>