<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $this->config->item('site_title'); ?></title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="<?php echo $this->config->item('meta_desc');?>" name="description" />
	<meta content="<?php echo $this->config->item('meta_key');?>" name="keywords" />
	<meta content="<?php echo $this->config->item('meta_author');?>" name="author" />

	<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/app.css');?>" rel="stylesheet">
	<link rel="shortcut icon" href="<?php echo base_url('assets/img/icon.png');?>" title="Favicon" />
	<?php echo $map['js']; ?>
</head>
<body>
	<section id="logo">
		<a href="#"><img src="assets/img/logo_pkpsorong.png" alt="" /></a>
	</section>
	
	<section class="container-fluid">
		<section class="row">
			<?php echo $map['html']; ?>
		</section>
	</section>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>