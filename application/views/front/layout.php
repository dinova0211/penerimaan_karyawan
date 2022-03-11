<!DOCTYPE html>
<html lang="en">
	<?php  $this->load->view('front/include/head') ?>
	<body data-spy="scroll" data-target="#site-navbar" data-offset="200">
		<?php  $this->load->view('front/include/nav') ?>
		<!-- END nav -->
		
		<?php  $this->load->view('front/include/header') ?>
		<!-- END section -->
		

		<?php  $this->load->view('front/include/footer') ?>
		<!-- Modal -->
		<?php  $this->load->view('front/include/modal') ?>

		<!-- END Modal -->

		<!-- loader -->
		<?php  $this->load->view('front/include/loader') ?>

		<?php  $this->load->view('front/include/script') ?>
	</body>
</html>