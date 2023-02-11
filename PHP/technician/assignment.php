<?php
    require_once("../secure.php");
    require_once("../config.php");
    require_once("../sql.php"); 
    require_once("../validation.php");

    isUserTypeTechnician();
	if(isset($_REQUEST['submit'])){
		//vlaues for repairjobID and TchnicianID 
		$jobId = $_REQUEST['job-id'];
		$techId = $_REQUEST['technician-id'];
		//function to execute assginment of repair job
		assignJob ($jobId, $techId);
		insertNewNotification($jobId, 'assigned');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../../css/main.css" rel="stylesheet"/>
    <link href="../../css/register.css" rel="stylesheet"/>
    <link href="../../css/dashboard.css" rel="stylesheet"/>
    <link href="../../css/technician.css" rel="stylesheet"/>
    <link href="../../css/table.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" integrity="sha512-8bHTC73gkZ7rZ7vpqUQThUDhqcNFyYi2xgDgPDHc+GXVGHXq+xPjynxIopALmOPqzo9JZj0k6OqqewdGO3EsrQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>FixMe | Assignment </title>
</head>
<body>
	<header></header>
    <main id="technician-dashboard">          
    <nav class="menu">
            <a href="index.php"><i class="home icon big"></i></a><br>
            <a href="profile.php"><i class="user circle icon big"></i></a><br>
            <a href="tasks.php"><i class="tasks icon big"></i></a><br>
            <a href="assignment.php"><i class="clipboard outline icon big"></i></a>
    </nav>
    <div class="content-section column-container">
            <div class="top-banner">
                <h2>Welcome <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'] ?> </h2>
				<div class="spacer"></div>
					<div class="options">
						<h3>Technician</h3>
						<!-- <i class="angle down"></i> -->
						<a href="user"></a>
						&nbsp;
					</div>
                    <!--<input type="submit" name="logout" value="logout"  method="POST">-->
                    <a class="icon" href="../../php/logout.php"><i class="sign out alternate icon big"></i></a><br>
            </div>  
            <div class="row-container" >
                <section class="select-repair-job">
                	<h2>Select Repair Job</h2>
            	<table id="repair-job-table" class="view-table">
                		<thead>
	                		<tr>
	                			<th>
	                				Job No.
	                			</th>
	                			<th>
	                				Name
	                			</th>
	                			<th> Category</th>
	                			<th> Difficulty</th>
	                			<th> Job Status</th>
	                		</tr>
                		</thead>

                		<tbody>
                			<?php
                			 $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Could not establish database connection");

                			 $repairJobsSQL = "SELECT * FROM userS as U, devices as D, repairJobS as R 
                			 		WHERE  U.userID = d.userID AND R.deviceID = d.deviceID
                			 		AND status='queued'";

                			 	$repairJobIDs = [];
                			 $result = mysqli_query($conn, $repairJobsSQL) or die(mysqli_error($conn));

                			 while ($row = mysqli_fetch_array($result)) {

                			 	array_push($repairJobIDs, $row["repairJobID"]);
                			 	$selected = "selectable";

	                			echo "<tr class=\" " . $selected . "\">";

	                            echo "<td>" . $row["repairJobID"] . "</td>";
	                            echo "<td>" . $row["name"] . "</td>";
	                            echo "<td>" . $row["category"] . "</td>";
	                            echo "<td>" . $row["difficulty"] . "</td>";
	                            echo "<td>" . $row["status"] . "</td>";
	                            echo "</tr class=\"selectable\">";
                			 }

                			mysqli_close($conn);
                			?>
                		</tbody>
                		
                	</table>
                </section>
                <section class="select-technician">
                	<h2>Select a technician</h2>
                	 <table id="technician-table" class="view-table">
                		<thead>
	                		<tr>
	                			<th>Id</th>
	                			<th>Name and Surname</th>
	                			<th>Expertise</th>
                                <th>Jobs Assigned</th>
	                		</tr>
                		</thead>

                		<tbody>
                			<?php

                             //Connecting to the DB
                			 $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Could not establish database connection");

                             //Query for returning technicians
                			$findtechsql ="SELECT TechnicianID, firstname, lastname, experience, enddate FROM technician INNER JOIN users ON technician.userID = users.userID
											WHERE enddate is null;";

                            //running query for tech query
							$techresult = mysqli_query($conn,$findtechsql) or die(mysqli_error($conn));
                            
                            //init Var array
							$technicianIDs = [];

                            //for every technician found do the following
							while($techrow = mysqli_fetch_array($techresult))
                            {
								$selected = "";
								array_push($technicianIDs, $techrow["TechnicianID"]);

                                //sql that uses the techs ID find the number of active jobs they're assigned to 
                                $assignedJobsSQL = "select COUNT(jobgroup.repairJobID) , jobgroup.TechnicianID , repairjobs.status
                                                from ctrls.jobgroup 
                                                INNER JOIN ctrls.repairjobs on repairjobs.repairJobID = jobgroup.repairJobID
                                                where TechnicianID = \"" . $techrow["TechnicianID"] . "\"
                                                group by TechnicianID
                                                having not repairjobs.status = \"done\" or not repairjobs.status = \"paid\";";
                                
                                //running sql query
                                $jobresult = mysqli_query($conn, $assignedJobsSQL) or die(mysqli_error($conn));

                                //returning result of the query
                                $jobsrow = mysqli_fetch_array($jobresult);

                                //init var
                                $jobs = "";

                                //jobs query should only return 1 row and we only need to use the first column
                                if(isset($jobsrow[0])){ //if not == 0
                                    $jobs = $jobsrow[0];
                                }else{                  //if == 0 ----> would return null so we use 0 instead
                                    $jobs = "0";
                                }
                                 

                                //echo to create table row for every iteration of the loop
							    echo "
							        <tr class=\"selectable\" >
				                         <td>".$techrow['TechnicianID']."</td>
						                 <td>". $techrow['firstname'] . ' ' . $techrow['lastname']."</td>
						                 <td>".$techrow['experience']."</td>
                                         <td>".$jobs."</td>
						            </tr>";
							}

                            //close sql conn
                			mysqli_close($conn);

                			?>
                		</tbody>
                		
                	</table>
                </section>

                <section  class="assign-form ">
					<form id="assign-repair-job-form" class="update-form" action="" method="post">
						<h2>Assign Repair Job</h2>
                		<table>
                			<tr>
                				<td>
                					<label for="job-id">Job ID:</label>
                				</td>
                				<td>
								<input id="job-id" type="text" name="job-id" readonly>

                					<!-- <select name="job-id" id="job-id">
                						<option selected hidden> Select a Repair JobID</option>
                						<?php
                							// foreach ($repairJobIDs as $id) {
                							// 	echo "<option value='$id'>$id</option>";
                							// } 
                						?>
                					</select> -->
                				</td>
                			</tr>
                			<tr>
                				<td>	
                					<label for="technician-id">
                						Technician ID:
                					</label>
                				</td>
                				<td>
									<input id="technician-id" name="technician-id" type="text" readonly>
                					<!-- <select name="technician-id" id="technician-id">
                						<option selected hidden> Select a RepairJob ID</option>
										<?php
                							// foreach ($technicianIDs as $id) {
                							// 	echo "<option value='$id'>$id</option>";
                							// } 
                						?>
                					</select> -->
                				</td>
                			</tr>
                			<tr>
                				<td colspan="2">
			                		<input style="width:100%" type="submit" name="submit" value="Assign">
                				</td>
                			</tr>
                		</table>
                	</form>
                </section>
            </div>
	</main>
	<footer></footer>
	
</body>
</html>

<script src="../../js/assign-repair.js"></script>
