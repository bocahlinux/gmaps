<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Peta Sebaran Alumni STMIK Palangka Raya</title>

	<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/font-awesome.min.css');?>" media="all" rel="stylesheet" />
	<?php echo $map['js']; ?>
</head>
<body>

<div class="container">
	<div class="page-header" style="margin-top: 50px;">
		<blockquote>
			<a href="<?php echo base_url('welcome');?>" class="btn btn-primary">Input Data</a>
		</blockquote>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			<legend>Peta Sebaran Alumni STMIK Palangka Raya</legend>
			<?php echo $map['html']; ?>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
<script type="text/javascript">
	var top_url = '<?php echo base_url();?>';
	function showModal(id) {
		var temp_url = top_url+'welcome/modal/'+id
		$('#mod_title').html('Daftar Alumni');
		$('#isi').html('<center><i class="fa fa-circle-o-notch fa-spin fa-fw"></i> Loading data, please wait...</center>');
		$('#isi').load(temp_url);
		$('#myModal').modal();
		}
</script>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="mod_title"></h4>
			</div>
			<div class="modal-body">
				<div id="isi"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
</body>
</html>