<!DOCTYPE html>
<?php
	require_once 'validate.php';
	require 'name.php';
?>
<html lang = "en">
	<head>
		<title>My Apartment Admin</title>
		<meta charset = "utf-8" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0" />
		<link rel = "stylesheet" type = "text/css" href = "../css/bootstrap.css " />
		<link rel = "stylesheet" type = "text/css" href = "../css/style.css" />
	</head>
<body>
	<nav style = "background-color:rgba(0, 0, 0, 0.1);" class = "navbar navbar-default">
		<div  class = "container-fluid">
			<div class = "navbar-header">
				<a class = "navbar-brand" >My Apartment Booking</a>
			</div>
			<ul class = "nav navbar-nav pull-right ">
				<li class = "dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class = "glyphicon glyphicon-user"></i> <?php echo $name;?></a>
					<ul class="dropdown-menu">
						<li><a href="logout.php"><i class = "glyphicon glyphicon-off"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
	<div class = "container-fluid">	
		<ul class = "nav nav-pills">
			<li><a href = "home.php">Home</a></li>
			<li><a href = "account.php">Accounts</a></li>
			<li><a href = "book.php">Booking</a></li>
			<li><a href = "apartment.php">Apartment</a></li>			
		</ul>	
	</div>
	<br />
	<div class = "container-fluid">
		<div class = "panel panel-default">
			<div class = "panel-body">
				<div class = "alert alert-info">Edit Your Info For Apartment</div>
				<br />
				<div class = "col-md-4">
					<?php
						$query = $conn->query("SELECT * FROM `apartments` WHERE `Apartment_id` = '$_REQUEST[Apartment_id]'") or die(mysqli_error());
						$fetch = $query->fetch_array();
					?>
					<form method = "POST" enctype = "multipart/form-data">
						<div class = "form-group">
							<label>Apartment Name </label>
							<select class = "form-control" required = required name = "Apartment_name">
								<option value = "">Choose an option</option>
								<option value = "Azuri" <?php if($fetch['Apartment_name'] == "Azuri"){echo "selected";}?>>Azuri</option>
								<option value = "Ocean View" <?php if($fetch['Apartment_name'] == "Ocean View"){echo "selected";}?>>Ocean View</option>
								<option value = "Illea" <?php if($fetch['Apartment_name'] == "Illea"){echo "selected";}?>>Illea</option>
								<option value = "Evaco" <?php if($fetch['Apartment_name'] == "Evaco"){echo "selected";}?>>Evaco</option>
								<option value = "Anahita" <?php if($fetch['Apartment_name'] == "Anahita"){echo "selected";}?>>Anahita</option>
							</select>
						</div>
						<div class = "form-group">
							<label>Price </label>
							<input type = "number" min = "0" max = "999999999" value = "<?php echo $fetch['price']?>" class = "form-control" name = "price" />
						</div>
						<div class = "form-group">
							<label>Photo </label>
							<div id = "preview" style = "width:150px; height :150px; border:1px solid #000;">
								<img src = "../photo/<?php echo $fetch['photo']?>" id = "lbl" width = "100%" height = "100%"/>
							</div>
							<input type = "file" required = "required" id = "photo" name = "photo" />
						</div>
						<br />
						<div class = "form-group">
							<button name = "edit_apartment" class = "btn btn-warning form-control"><i class = "glyphicon glyphicon-edit"></i> Save Changes</button>
						</div>
					</form>
					<?php require_once 'edit_query_apartment.php'?>
				</div>
			</div>
		</div>
	</div>
	<br />
	<br />
</body>
<script src = "../js/jquery.js"></script>
<script src = "../js/bootstrap.js"></script>
<script type = "text/javascript">
	$(document).ready(function(){
		$pic = $('<img id = "image" width = "100%" height = "100%"/>');
		$lbl = $('<center id = "lbl">[Photo]</center>');
		$("#photo").change(function(){
			$("#lbl").remove();
			var files = !!this.files ? this.files : [];
			if(!files.length || !window.FileReader){
				$("#image").remove();
				$lbl.appendTo("#preview");
			}
			if(/^image/.test(files[0].type)){
				var reader = new FileReader();
				reader.readAsDataURL(files[0]);
				reader.onloadend = function(){
					$pic.appendTo("#preview");
					$("#image").attr("src", this.result);
				}
			}
		});
	});
</script>
</html>