<?php 

	require "Database/connect.php";

	if(isset($_REQUEST['id']))
	{
		$id = (int)$_REQUEST['id'];
		$oneData = $con->findOne(['_id'=>$id]);
		$name = $oneData['name'];
		$email = $oneData['email'];
		$dob = $oneData['dob'];
		$gender = $oneData['gender'];
		$userImage = (string)$oneData['userimage'];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>MongoDB CRUD Operation</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="js/jquery.min.js"></script>
</head>
<body>
<div class="container-fluid">
	<div class="row">

		<!-- Campaign Page Heading -->
		<div class="col-12 mt-3 heading">
			<h1 class="mx-3 my-2">CRUD Application with PHP</h1>
			<p class="mx-3">Create.Read.Update.Delete in MongoDB Database</p>
			<hr>
		</div>

		<!-- Members Enrollment Form -->
		<div class="col-md-4 col-sm-12">
		<div class="form-box mt-2">
			<h2 class="text-primary form-heading">Create & Update from here</h2>
			<hr class="mt-3 mb-4">
			<form id="myInputForm" autocomplete="off">
				<label>User Profile Image: </label>
				<input type="file" name="upload_image" id="profile_image">
				<div class="form-group">
					<label for="fname">Firstname: &nbsp;</label>
					<input type="text" name="txt_fname" id="fname" class="form-control" required="">
				</div>
				<div class="form-group">
					<label for="lname">Lastname: &nbsp;</label>
					<input type="text" name="txt_lname" id="lname" class="form-control" required="">
				</div>
				<div class="form-group">
					<label for="email">Email: </label>
					<input type="text" name="txt_email" id="email" class="form-control" required="">
				</div>
				<div class="form-group">
					<label for="DOB">Date of Birth: </label>
					<input type="date" name="txt_date" id="DOB" class="form-control" required="">
				</div>
				<div class="form-group mt-3">
					<label>Select your Gender: </label>
					&nbsp; &nbsp;
					<input type="radio" id="radioInput" name="rdo_gender" value="Male"> Male
					&nbsp;
					<input type="radio" id="radioInput" name="rdo_gender" value="Female"> Female
					&nbsp;
					<input type="radio" id="radioInput" name="rdo_gender" value="Other"> Other
				</div>
				<div class="form-group mt-2">
					<button type="submit" name="btn_submit" id="submit" class="form-control btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
		</div>

		<!-- Enrolled Members List -->
		<div class="col-md-8 col-sm-12">
		<div class="table-box mt-2">
			<h2 class="text-primary form-heading">Existing Members List</h2>
			<hr class="mt-3 mb-4">
			<table class="table table-striped text-center">
				<thead class="table-dark text-white">
					<tr>
						<th>Profile Image</th>
						<th>Name</th>
						<th>Email</th>
						<th>Date of Birth</th>
						<th>Gender</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody id="table-response">
					
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		var id = "<?php echo $id; ?>";
		if(id != null)
		{
			let name = "<?php echo $name; ?>";
			let gender = "<?php echo $gender; ?>";
			let nameArray = name.split(" ");
			let fname = String(nameArray.slice(0, 1));
			let lname = String(nameArray.slice(1, 3));
			
			$('input[name=txt_fname]').val(fname);
			$('input[name=txt_lname').val(lname);
			$('input[name=txt_email]').val('<?php echo $email; ?>');
			$('input[name=txt_date]').val('<?php echo $dob; ?>');
			$('input[type=radio][name=rdo_gender][value='+gender+']').attr("checked","");

			$("#myInputForm").attr("id", "myUpdateForm");
			$("#submit").html("Update");	
		}

		$("#myUpdateForm").on("submit", function(e){
		    e.preventDefault();
			var formData = new FormData(this);
			formData.append('id', id);

		    $.ajax({
		        url:"Database/update.php",
		        type:"POST",
		        data: formData,
		        processData:false,
		        contentType:false,
		        success:function(res){
		        	     	$("tbody").load("Database/table.php");
		                	document.getElementById("profile_image").value="";
		                	document.getElementById("fname").value="";
		                	document.getElementById("lname").value="";
		                	document.getElementById("email").value="";
		                	document.getElementById("DOB").value="";
		                	var radio = document.querySelector('input[type=radio][name=rdo_gender]:checked');
		                	radio.checked=false;
		                	$("#myUpdateForm").attr("id", "myInputForm");
							$("#submit").html("Submit");
							location.href="index.php";
		            	},
		        });
		});
	});
</script>
<script src="main.js"></script>
</body>
</html>


