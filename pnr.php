<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<title>TRAIN SCHEDULE</title>
	<link rel="stylesheet" type="text/css" href="style2.css">
	<?php
			$conn=mysqli_connect("localhost","root","soumyajha126","registration");
			$train_no="";
		?>	
</head>
<body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
		   <nav class="navbar sticky-top navbar-expand-sm navbar-dark bg-dark">
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>
			  <?php if(isset($_SESSION['username'])): ?>	
				  <div class="collapse navbar-collapse" id="navbarText">
				    <ul class="navbar-nav mr-auto">
				      <li class="nav-item">
				        <a class="nav-link" href="index.php">Book Tickets<span class="sr-only">(current)</span></a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" href="train_stas.php">Train Schedule</a>
				      </li>
				      <li class="nav-item active">
				        <a class="nav-link" href="pnr.php">PNR Enquiry</a>
				      </li>
				    </ul>		   
						<span class="navbar-text" class="nav-item">
						    Welcome <strong><?php echo $_SESSION['username']; ?></strong>
						</span>
					    <span class="navbar-text" class="nav-item">
					      <a class="nav-link" href="index.php?logout='1'">Logout</a>
					    </span>
				<?php endif ?>
				<?php if(!isset($_SESSION['username'])): ?>
					<div class="collapse navbar-collapse" id="navbarText">
				    <ul class="navbar-nav mr-auto">
				      <li class="nav-item">
				        <a class="nav-link" href="index.php">Book Tickets<span class="sr-only">(current)</span></a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" href="train_stas.php">Train Schedule</a>
				      </li>
				      <li class="nav-item active">
				        <a class="nav-link" href="pnr.php">PNR Enquiry</a>
				      </li>
				    </ul>	
				    <span class="navbar-text" class="nav-item">
				      <a class="nav-link" href="register.php">Register</a>
				    </span>
				    <span class="navbar-text" class="nav-item">
				      <a class="nav-link" href="login.php">Login</a>
				    </span>
				<?php endif ?>
			  </div>
			</nav>
	<form action="pnr.php" method="post">
		<h1>BOOKING DETAILS: <?php if (isset($_POST['pnr'])) echo $_POST['pnr']; ?></h1>
		<div class="contain">
			<label>Enter PNR Number:</label>
			<input type="text" name="pnr" value="<?php if (isset($_POST['pnr'])) echo $_POST['pnr']; ?>" class="label">
			<button type="submit" name="submit" class="btn">Submit</button><br><br>
	 	</div>
	 </form>
	 <?php
			$conn=mysqli_connect('localhost','root','soumyajha126','registration');
			if(isset($_POST["submit"])){
				$pnr=$_POST['pnr'];
				$query="SELECT * FROM pass_details WHERE B_id=$pnr";
				$q1="SELECT * FROM pass_details2 WHERE B_id=$pnr";
				$result=mysqli_query($conn,$query);
				$r1=mysqli_query($conn,$q1);
						
						echo '<h1 style="margin-top: 0px; color:#e91e63;"><b>JOURNEY DETAILS</b></h1>';
						echo '<table style="margin-top: 0px;"> 

						<th> PNR NUMBER </th> 
						<th> Train Number </th>
						<th> Amount Paid Per Person</th>
						<th> Date of Journey </th>';
						while ($row = mysqli_fetch_assoc($result))
						{ 
						$y=$row['Class'];
						$y1=$row['Success'];
						echo '<tr> 
						<td>'.$row['B_id'].'</td>
						<td>'.$row['Train_No'].'</td>
						<td>'.$row['Fare'].'</td> 
						<td>'.$row['Journey_date'].'</td>
						</tr>'; 
						}
						echo '</table>';
						
						echo "<br>";

					echo '<h1 style="margin-top: 40px; color:#e91e63;"><b>PASSENGER DETAILS</b></h1>';
						echo '<table class="container" style="margin-top: 0px;"> 

						<th> Passenger Name </th> 
						<th> Age </th>
						<th> Gender </th>
						<th> Class</th>
						<th> Status of Booking</th>';
						while ($row1 = mysqli_fetch_assoc($r1))
						{ 
						echo '<tr> 
						<td>'.$row1['name'].'</td>
						<td>'.$row1['gender'].'</td>
						<td>'.$row1['age'].'</td>
						<td>'.$y.'</td>
						<td>'.$y1.'</td>
						</tr>'; 
						}
						echo '</table>';
						echo "<br>";
					}
		?>
		<div style="margin-top:65px;">
		<?php include('footer.php'); ?>
		</div>
</body>
</html>