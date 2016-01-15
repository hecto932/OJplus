<?php 
	//CSRF
    $data['name'] = $this->security->get_csrf_token_name();
    $data['hash'] = $this->security->get_csrf_hash();
	$this->load->view('partials/header',$data); 
?>
	
	<?php echo $content_for_layout; ?>

<?php 
	$this->load->view('partials/footer'); 
?>
