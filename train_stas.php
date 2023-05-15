<?php include('server.php'); ?>
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
				      <li class="nav-item active">
				        <a class="nav-link" href="train_stas.php">Train Schedule</a>
				      </li>
				      <li class="nav-item">
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
				      <li class="nav-item active">
				        <a class="nav-link" href="train_stas.php">Train Schedule</a>
				      </li>
				      <li class="nav-item">
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
	<form action="train_stas.php" method="post">
		<h1>Train Schedule: <?php if (isset($_POST['train_no'])) echo $_POST['train_no']; ?></h1>
		<div class="contain">
			<label>Enter train Number:</label>
			<input type="text" name="train_no" value="<?php if (isset($_POST['train_no'])) echo $_POST['train_no']; ?>" class="label">
			<button type="submit" name="submit" class="btn">Submit</button><br><br>
	 	</div>

		<?php
			if(isset($_POST["submit"])){
				$train_no=mysqli_real_escape_string($conn,$_POST['train_no']);
				$query="SELECT `SN`,`Station_Name`, `Route_Number`, `Arrival_time`, `Departure_Time`, `Distance`, `Station_Code` FROM `train_schedule` WHERE `Train_No`=$train_no";
				$q="SELECT * FROM train_info WHERE Train_No=$train_no";
				$r=mysqli_query($conn,$q);
				$result=mysqli_query($conn,$query);
				if(!$r||mysqli_num_rows($r)==0){
						echo "<h3>Please enter valid train number.</h3>";
					}
					else{
						echo "<div style='padding:20px; width:50%; background-color:' class='container jumbotron'>";
						echo '<table> 

						<th> Train Number </th> 
						<th> Train Name </th>
						<th> From Station </th>
						<th> Destination Status </th>';
						while ($row = mysqli_fetch_assoc($r))
						{ 
						echo '<tr> 
						<td>'.$row['Train_No'].'</td>
						<td>'.$row['Train_Name'].'</td>
						<td>'.$row['Source_Station_Name'].'</td>
						<td>'.$row['Destination_Station_Name'].'</td> 
						</tr>'; 
						}
						echo '</table>';
						echo "</div>";
						echo "<br>";
						echo '<table> 
						<th> S.N. </th> 
						<th> Station Code </th>
						<th> Station Name </th>
						<th> Route Number </th>
						<th> Arrival Time </th>
						<th> Departure Time </th>
						<th> Distance </th>';
						while ($row = mysqli_fetch_assoc($result))
						{ 
						echo '<tr> 
						<td>'.$row['SN'].'</td>
						<td>'.$row['Station_Code'].'</td>
						<td>'.$row['Station_Name'].'</td>
						<td>'.$row['Route_Number'].'</td> 
						<td>'.$row['Arrival_time'].'</td>
						<td>'.$row['Departure_Time'].'</td>
						<td>'.$row['Distance'].'</td>
						</tr>'; 
						}
						echo '</table>';
					}
			}


		?>
		
	</form>
	
	<div style="margin-top:65px">
	<?php include('footer.php'); ?>
	</div>
</body>
</html
