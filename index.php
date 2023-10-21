<?php
session_start();
include('db.php');

?>



<!DOCTYPE html>
<html>

<head>
	<title>Task Tracker</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<style>
        /* Centered container */
        .centered-container {
            display: flex;
			flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
		.message-box {
            width: 500px;
            background-color: #FEF0D6; /* Yellow background color */
            padding: 20px;
            text-align: center;
			margin: 10px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5);
            /* border: 1px solid #cccc99; */
        }
		.header {
			display: flex;
			background: #68B37F;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5);
		}
		body {
			background-repeat: no-repeat;
			background-size: cover;
  			background-image: url('https://img.freepik.com/free-photo/business-desktop-with-office-elements_23-2148196626.jpg?w=1380&t=st=1697882152~exp=1697882752~hmac=b6fefa926f93bc5f7370e5b8f494f4ae37fc078ed710d61aa37c67a9e2b5e1a5');
		}
		#list{
			background: white;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5);
		}
		h1{
			color: white;
		}
		.thead {
			background-color: #8BC39F;
		}
</style>

<body>

	<?php
	if (!isset($_SESSION['username'])) {
		?>
		<div class="centered-container">
			<div style="color: #389E5D;font-size: 50px; font-weight: bold">Oops...</div>
			<div class="message-box">
				Your session has expired. <br>Please <a href="loginlol.php">Log In</a> again or <a href="register.php">Register</a> an account.</div>
		</div>
					<?php
	} else {
	?>
	<div class="header mb-5 p-2 px-4 d-flex justify-content-between"><?php
	echo "<h1>Welcome, " . $_SESSION['u_f_name'] . "</h1>";
		?>
			<div class="px-3 pt-2">
				<div class="row">
					<div class="col">
							<a type="button" href="logout.php" class="btn btn-light">Log Out</a>
					</div>
				</div>
			</div>
	</div>

	<div class="d-flex justify-content-center">
		<div class="d-flex flex-column w-75 p-4" id="list">
		<?= date("l, d M Y")?>
			<div class="d-flex justify-content-between">
				<div>
				<h3><b>My To-Do List     </b><i class="fa fa-list-alt" aria-hidden="true"></i></h3>
				</div>
				<span>
					<a href='#' class='btn btn-success mr-3 addtask' data-bs-toggle='modal' data-bs-target='#add<?= $id ?>' title='Add'>
					<i class="fa fa-plus" aria-hidden="true"></i></a>
				</span>
			</div>
				<hr>
				<table class="table table-bordered table-striped table-hover" id="myTable">
					<thead>
						<tr>
							<th scope="col" style="width: 50%;">Task</th>
        					<th scope="col" style="width: 15%;">Updated Date</th>
							<th scope="col" style="width: 10%;">Due Date</th>
       						<th scope="col" style="width: 10%;">Status</th>
        					<th scope="col" style="width: 10%;">Manage</th>
						</tr>
					</thead>

					<?php
					$get_data = "SELECT * FROM task_user order by 1 desc";
					$run_data = mysqli_query($con, $get_data);
					while ($row = mysqli_fetch_array($run_data)) {
						$u_f_name = $row['u_f_name'] ?? '';
						$u_l_name = $row['u_l_name'] ?? '';
					?>

						<tr>
							<td class='text-center'><?= $sl ?></td>
							<td class='text-left'><?= $u_f_name ?> <?= $u_l_name ?></td>
							<td class='text-center'><?= $sl ?></td>
							<td class='text-center'><?= $sl ?></td>
							<td class='text-center'>
								<span>
									<a href='#' class='btn btn-warning mr-3 edituser' data-bs-toggle='modal' data-bs-target='#edit<?= $id ?>' title='Edit'>
									<i class='fa fa-pencil-square-o fa-lg'></i></a>
								</span>
								<span>
									<a href='#' class='btn btn-danger deleteuser' data-bs-toggle='modal' data-bs-target='#delete<?= $id ?>' aria-hidden='true' title='Delete'>
									<i class='fa fa-trash-o fa-lg'></i>
									</a>
								</span>

							</td>
						</tr>
					<?php
					}
					?>
				</table>
				<form method="post" action="export.php">
					<input type="submit" name="export" class="btn btn-success" value="Export Data" />
				</form>
			</div>

			<?php
			$get_data = "SELECT * FROM task_user";
			$run_data = mysqli_query($con, $get_data);

			while ($row = mysqli_fetch_array($run_data)) {

				$name = $row['u_f_name'] ?? '';
				$name2 = $row['u_l_name'] ?? '';
			?>
				<!-- Modal Delete -->
				<div id='delete<?= $id ?>' class='modal fade' role='dialog'>
					<div class='modal-dialog'>
						<div class='modal-content'>
							<div class='modal-header'>
								<h4 class='modal-title text-center'>Are you sure?</h4>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class='modal-body text-center'>
								<a href='delete.php?id=<?= $id ?>' class='btn btn-danger'>Yes, King</a>
							</div>
						</div>
					</div>
				</div>

				<!-- Modal Edit Mahasiswa -->
				<div id='edit<?= $id ?>' class='modal fade' role='dialog'>
					<div class='modal-dialog'>
						<div class='modal-content'>
							<div class='modal-header'>
								<h4 class='modal-title text-center'>Edit your Data</h4>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>

							<div class='modal-body'>
								<form action='edit.php?id=<?= $id ?>' method='post' enctype='multipart/form-data'>
									<div class="container">


										<div class='row'>
											<div class='col-md-6'>
												<label for='inputEmail4'>Student Id.</label>
												<input type='text' class='form-control' name='card_no' placeholder='Enter 12-digit Student Id.' maxlength='12' value='<?= $card ?>' required>
											</div>
											<div class='col-md-6'>
												<label for='inputPassword4'>Prodi</label>
												<input type='prodi' class='form-control' name='user_prodi' placeholder='Enter Prodi' maxlength='20' value='<?= $prodi ?>' required>
											</div>
										</div>

										<div class='row'>
											<div class='col-md-6'>
												<label for='firstname'>First Name</label>
												<input type='text' class='form-control' name='user_first_name' placeholder='Enter First Name' value='<?= $name ?>'>
											</div>
											<div class='col-md-6'>
												<label for='lastname'>Last Name</label>
												<input type='text' class='form-control' name='user_last_name' placeholder='Enter Last Name' value='<?= $name2 ?>'>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 pt-1 pb-1">
												<label>Image</label>
												<input type='file' name='image' class='form-control'>
												<img class="pt-1" src='upload_images/<?= $image ?>' style='width:50px; height:50px'>
											</div>
										</div>
									</div>
									<div class='modal-footer'>
										<input type='submit' name='submit' class='btn btn-info btn-large' value='Submit'>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

			<?php
			}
			?>
		</div>
	</div>
		<?php
	} 
	?>
</body>

</html>