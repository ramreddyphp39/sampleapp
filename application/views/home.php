<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<div>

</div>
<div>
<?php echo "Welcome ".$this->session->userdata('username');?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo site_url('user/logout')?>" >logout</a>




</div>
<div>
</div>
</body>
</html>