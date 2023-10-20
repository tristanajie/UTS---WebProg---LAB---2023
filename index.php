<?php
session_start();
include('db.php');

?>

<!DOCTYPE html>
<html>

<head>
	<title>Student Crud Operation</title>
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

<body>

	<?php
	if (!isset($_SESSION['level'])) {
	?>
		<div class="p-3 mb-2 bg-warning text-dark">Mohon login terlebih dahulu.</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col">
					<a type="button" href="loginlol.php" class="btn btn-primary">Log in</a>
					<a type="button" href="register.php" class="btn btn-primary">Register</a>
					<?php
					if (isset($_SESSION['level'])) {
					?>
						<a type="button" href="loginlol.php" class="btn btn-primary">Log out</a>
					<?php
					}
					?>
				</div>
			</div>
		</div>
		<?php
	} else {
		if ($_SESSION['level'] == "admin") {
			echo "<h1>Welcome, " . $_SESSION['u_f_name'] . "</h1>";
		?>
			<div class="container-fluid pt-2">
				<div class="row">
					<div class="col">
						<?php
						if (isset($_SESSION['level'])) {
						?>
							<a type="button" href="logout.php" class="btn btn-primary">Log out</a>
						<?php
						}
						?>
					</div>
				</div>
			</div>

			<div class="container">
				<h3><b>SIMPLE STUDENT DATABASE</b></h3>
				<hr>
				<table class="table table-bordered table-striped table-hover" id="myTable">
					<thead>
						<tr>
							<th class="text-center" scope="col">No.</th>
							<th class="text-center" scope="col">Name</th>
							<th class="text-center" scope="col">Student ID.</th>
							<th class="text-center" scope="col">Prodi</th>
							<th class="text-center" scope="col">View</th>
							<th class="text-center" scope="col">Edit</th>
							<th class="text-center" scope="col">Delete</th>
						</tr>
					</thead>

					<?php
					$get_data = "SELECT * FROM mahasiswa order by 1 desc";
					$run_data = mysqli_query($con, $get_data);
					$i = 0;
					while ($row = mysqli_fetch_array($run_data)) {
						$sl = ++$i;
						$id = $row['id'];
						$u_card = $row['u_card'];
						$u_f_name = $row['u_f_name'];
						$u_l_name = $row['u_l_name'];
						$u_prodi = $row['u_prodi'];
						$image = $row['image'];
					?>

						<tr>
							<td class='text-center'><?= $sl ?></td>
							<td class='text-left'><?= $u_f_name ?> <?= $u_l_name ?></td>
							<td class='text-left'><?= $u_card ?></td>
							<td class='text-left'><?= $u_prodi ?></td>

							<td class='text-center'>
								<span>
									<a href='#' class='btn btn-success mr-3 profile' data-bs-toggle='modal' data-bs-target='#view<?= $id ?>' title='Profile'><i class='fa fa-address-card-o' aria-hidden='true'></i></a>
								</span>

							</td>

							<td class='text-center'>
								<span>
									<a href='#' class='btn btn-warning mr-3 edituser' data-bs-toggle='modal' data-bs-target='#edit<?= $id ?>' title='Edit'><i class='fa fa-pencil-square-o fa-lg'></i></a>
								</span>
							</td>

							<td class='text-center'>
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
			$get_data = "SELECT * FROM mahasiswa";
			$run_data = mysqli_query($con, $get_data);

			while ($row = mysqli_fetch_array($run_data)) {
				$id = $row['id'];
				$card = $row['u_card'];
				$name = $row['u_f_name'];
				$name2 = $row['u_l_name'];
				$prodi = $row['u_prodi'];
				$time = $row['uploaded'];
				$image = $row['image'];
			?>
				<!-- Modal Delete -->
				<div id='delete<?= $id ?>' class='modal fade' role='dialog'>
					<div class='modal-dialog'>
						<div class='modal-content'>
							<div class='modal-header'>
								<h4 class='modal-title text-center'>Are you sure about that m8??</h4>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class='modal-body text-center'>
								<a href='delete.php?id=<?= $id ?>' class='btn btn-danger'>Delete</a>
							</div>
						</div>
					</div>
				</div>

				<!-- Modal View -->
				<div class='modal fade' id='view<?= $id ?>' tabindex='-1' role='dialog' aria-labelledby='userViewModalLabel' aria-hidden='true'>
					<div class='modal-dialog'>
						<div class='modal-content'>
							<div class='modal-header'>
								<h5 class='modal-title' id='exampleModalLabel'>Profile <i class='fa fa-user-circle-o' aria-hidden='true'></i></h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</button>
							</div>
							<div class='modal-body'>
								<div class='container' id='profile'>
									<div class='row'>
										<div class='col-sm-6'>
											<img src='upload_images/<?= $image ?>' alt='' style='width: 150px; height: 150px;'><br>
											Uploaded : <?= $time ?>
										</div>
										<div class='col-sm-6'>
											<h3 class='text-primary'><?= $name . " " . $name2 ?></h3>
											<h3 class='text-primary'>Student ID : <?= $card ?></h3>
											<h3 class='text-primary'>Prodi : <?= $prodi ?></h3>
											<p class='text-secondary'>
										</div>

										<br />
										</p>
									</div>
								</div>
							</div>
							<div class='modal-footer'>
								<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
							</div>
						</div>
						</form>
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


		<?php
		} else {
			// student page
			echo "<h1>welcome, " . $_SESSION['u_f_name'] . "</h1>";

		?>
			<div class="container-fluid pt-2">
				<div class="row">
					<div class="col">
						<?php
						if (isset($_SESSION['level'])) {
						?>
							<a type="button" href="logout.php" class="btn btn-primary">Log out</a>
						<?php
						}
						?>
					</div>
				</div>
			</div>
			<?php

			$id = $_SESSION['id'];
			$get_data = "SELECT * FROM mahasiswa WHERE id = $id";
			$run_data = mysqli_query($con, $get_data);
			$data = mysqli_fetch_assoc($run_data);
			$id = $data['id'];
			$card = $data['u_card'];
			$name = $data['u_f_name'];
			$name2 = $data['u_l_name'];
			$prodi = $data['u_prodi'];
			$time = $data['uploaded'];
			$image = $data['image'];
			// echo "<pre>";
			// var_dump($data);
			// echo "</pre>";
			?>
<div class="container mx-auto">
    <div class="row">
        <div class="col">
            <p>ID : <?= $data['id'] ?></p>
        </div>
        <div class="col">
            <p>Student ID : <?= $data['u_card'] ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p>Nama : <?= $data['u_f_name'] . " " . $data['u_l_name'] ?></p>
        </div>
        <div class="col">
            <p>Prodi : <?= $data['u_prodi'] ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col">
			<p>Image : </p>
            <p><img src="upload_images/<?= $data['image'] ?>" style="height: 300px;width: 300px;" alt=""></p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p>Uploaded : <?= $data['uploaded'] ?></p>
        </div>
    </div>
	<div class="row">
		<div class="col-1">
			<a href='#' class='btn btn-warning mr-3 edituser d-flex justify-content-center' style="max-width: 100px; margin: 0 auto;" data-bs-toggle='modal' data-bs-target='#edit<?= $id ?>' title='Edit Profile'><i class='fa fa-pencil-square-o fa-lg'></i></a>
		</div>
		<div class="col-1">
			<a href='#' class='btn btn-danger deleteuser d-flex justify-content-center' style="max-width: 100px; margin: 0 auto;" data-bs-toggle='modal' data-bs-target='#delete<?= $id ?>' aria-hidden='true' title='Delete Account'><i class='fa fa-trash-o fa-lg'></i></a>
		</div>
	</div>
</div>
			<!-- Delete -->
			<div id='delete<?= $id ?>' class='modal fade' role='dialog'>
				<div class='modal-dialog'>
					<div class='modal-content'>
						<div class='modal-header'>
							<h4 class='modal-title text-center'>Are you sure about that m8??</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class='modal-body text-center'>
							<a href='delete.php?id=<?= $id ?>' class='btn btn-danger'>Delete</a>
						</div>
					</div>
				</div>
			</div>
			<!-- Edit -->
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
	}
	?>
</body>

</html>