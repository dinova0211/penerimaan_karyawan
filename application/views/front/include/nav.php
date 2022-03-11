<nav class="navbar navbar-expand-lg navbar-dark site_navbar bg-dark site-navbar-light" id="site-navbar">
	<div class="container">
		<a class="navbar-brand" href="index.html"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#site-nav" aria-controls="site-nav" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="oi oi-menu"></span> Menu
		</button>

		<div class="collapse navbar-collapse" id="site-nav">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item <?php if($this->uri->segment(2) == "pages"){echo "active";}?>"><a href="<?php echo base_url('front/pages');?>#section-home" class="nav-link <?php if($this->uri->segment(2) == "pages"){echo "active";}?>">Home</a></li>
				 
				
				<li class="nav-item" <?php if($this->uri->segment(2) == "login"){echo "active";}?>><a href="<?php echo base_url('login');?>" class="nav-link <?php if($this->uri->segment(2) == "login"){echo "active";}?>">Login</a></li>
			</ul>
		</div>
	</div>
</nav>