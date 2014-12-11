<html>
<head>
<title>All Users</title>
<link href="http://localhost/ciapp/assets/js/jquery-ui.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://localhost/ciapp/assets/js/jquery.js"></script>
<script type="text/javascript" src="http://localhost/ciapp/assets/js/jquery-ui.js"></script>
<script type="text/javascript">
$(function(){
  $("#search_term").autocomplete({
    source: "http://localhost/ciapp/index.php/user/get_users_auto" // path to the get_birds method
  });
});
</script>
</head>
<body>
<form action="http://localhost/ciapp/index.php/user/search_user" method="post">
    <p> <input type="text" id="search_term" name="search_term" /></p>
    <p><input type="submit" value="Search"/></p>
</form>
    <table border="2">
	
    <tr>
        <th>Username</th>
        <th>Email</th>
        <!--<th>Gender</th>-->
		<th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php
        foreach($result as $row):
    ?>
    <tr>
        <td><?php echo $row->username?></td>
        <td><?php echo $row->email?></td>
        <!--<td><?php //echo $row->gender?></td>-->
		<td><a href="<?php echo site_url('user/edit_user')?>/<?php echo $row->id;?>">Edit</a></td>
		<td><a href="<?php echo site_url('user/delete_user')?>/<?php echo $row->id;?>">Delete</a></td>
    </tr>
    <?php
        endforeach;
    ?>
    </table>
</body>
</html>