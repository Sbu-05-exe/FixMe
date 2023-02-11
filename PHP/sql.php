<?php
     require_once("config.php");  

     function isUsernameUnique($username) {
          //connect to DB
          $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to database");

          //query
          $upperUsername = strtoupper($username);
          $uniqueUsernameSQL = "SELECT * FROM Users WHERE UPPER(username) = '$upperUsername'";
          
          //run query
          $result = mysqli_query($conn, $uniqueUsernameSQL);
               
          // close the connection
          mysqli_close($conn);
          return empty(mysqli_fetch_array($result));
     } // this function has been tested and works
    
     function isEmailUnique($email, $table) {
          //connect to DB
          $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to database");
       
          //query
     
          $upperEmail = strtoupper($email); // making query case insensitive
          $uniqueUsernameSQL = "SELECT * FROM Users WHERE UPPER(email) = '$upperEmail'";
        
          //run query
          $result = mysqli_query($conn, $uniqueUsernameSQL);

          // close the connection
          mysqli_close($conn);          
          return empty(mysqli_fetch_array($result));
     } // this function has been tested and works

     function isUniqueDeviceName($name) {
          //connect to DB
          $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to database");
       
          //query
          $upperName = strtoupper($name); // making query case insensitive
          $uniqueName = "SELECT * FROM Users WHERE UPPER(email) = '$upperName'";
        
          //run query
          $result = mysqli_query($conn, $uniqueName);

          // close the connection
          mysqli_close($conn);
          
          return empty(mysqli_fetch_array($result));
     }

     function insertNewDevice($userid, $name, $brand, $category, $picture, $model) {
          
          $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to databse");

          $insertNewDeviceSQL = "INSERT INTO devices (userid, name, brand, category, image, model) VALUES ($userid, '$name', '$brand', '$category', '$picture', '$model')";

          mysqli_query($conn, $insertNewDeviceSQL) or die(mysqli_error($conn));
          mysqli_close($conn);
     } // this function has been tested and works

     function updateDevice($deviceid, $name, $brand,$category,$picture, $model) {

          $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to databse");

          // Update device table device table 
           $updateDeviceTableSql = "UPDATE devices SET name = '$name', brand = '$brand', category = '$category', model = '$model', image = '$picture'
                                   WHERE deviceID = $deviceid; ";

          mysqli_query($conn, $updateDeviceTableSql) or die(mysqli_error($conn));
          mysqli_close($conn);
     }

     function deleteDevice($deviceid) {
          $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to databse");

            $isQueuedSQL = "select COUNT(*)          
            from ctrls.repairjobs
            INNER JOIN ctrls.devices
            ON repairjobs.deviceID = devices.deviceID
            WHERE repairjobs.deviceID = $deviceid;";

            $QueueResult = mysqli_query($conn, $isQueuedSQL);
            $isQueued = mysqli_fetch_array($QueueResult)[0];

            //check if device is in progress or waiting 
            if($isQueued != 0){
                //device in progress
                //ALERT(cant delete this yet)
                echo "<script> alert(\"You can't delete a device that has been repaired!'\"); </script>";
            }
            else{
                //device must be finished
                //delete
                $Deref = "UPDATE ctrls.devices
                SET deleted = 'yes'
                WHERE deviceID =  $deviceid";

                mysqli_query($conn, $Deref) or die(mysqli_error($conn));
            }
            
            
          mysqli_close($conn);        
     }

     function createRepairJob($userid,$deviceid,$description,$difficulty,$etc,$timestamp) {
          $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to databse");

          // Create new repairJob from device table
          $newrepairJobSQL = "INSERT INTO repairjobs (userID, deviceID, description, difficulty, status, etc, inspectionFee, date) 
                              VALUES ($userid, $deviceid, '$description','$difficulty', 'queued', $etc, 100, '$timestamp');" ;
          
          mysqli_query($conn, $newrepairJobSQL) or die(mysqli_error($conn));
          mysqli_close($conn);        
     }

     function assignJob ($repairjobid, $techid){
          $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to databse");

          $newjobgroupsql = "INSERT INTO jobgroup (repairjobID, technicianID)
                          VALUES ($repairjobid,$techid);";

          mysqli_query($conn, $newjobgroupsql) or die(mysqli_error($conn));

          $updaterepairjobsql = "UPDATE repairjobs SET status = 'assigned' WHERE repairJobID = $repairjobid; ";

          mysqli_query($conn,  $updaterepairjobsql) or die(mysqli_error($conn));
          mysqli_close($conn); 
     }

     function getRepairJobFromTimestamp($userId, $deviceId, $timestamp) {
          $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to databse");


          $getRepairJobSQL = "SELECT * FROM ctrls.repairjobs 
          WHERE userID = $userId AND deviceID = deviceId 
          ORDER BY date DESC";

          $result = mysqli_query($conn,  $getRepairJobSQL) or die(mysqli_error($conn));

          $row = mysqli_fetch_array($result);

          mysqli_close($conn);

          // echo print_r($row);
          return $row["repairJobID"];

     }

     function insertNewNotification($repairJobId, $status) {
          $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to databse");

          // Create new repairJob from device table
          $newrepairJobSQL = "INSERT INTO notifications (repairJobid, status, notificationdate)
          VALUES ($repairJobId, '$status', NOW())";
          
          mysqli_query($conn, $newrepairJobSQL) or die(mysqli_error($conn));
          mysqli_close($conn);    
     }

     function updateUser($userid, $firstname, $lastname, $email) {
          $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to databse");

          // Create new repairJob from device table
          $updateUserDetailsSQL = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', email = '$email'
                                   WHERE userID = $userid";

          mysqli_query($conn, $updateUserDetailsSQL) or die(mysqli_error($conn));
          mysqli_close($conn);        
          
     } // this function has been tested and works

     
     function getDeviceId($userid, $devicename) {
          $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to databse");

          // Create new repairJob from device table
          // echo "getting device id";
          $getDeviceIdSQL = "SELECT deviceID FROM devices WHERE userID=$userid AND name='$devicename'";
          echo var_dump($getDeviceIdSQL); 

          $result = mysqli_query($conn, $getDeviceIdSQL) or die(mysqli_error($conn));

          $row = mysqli_fetch_array($result);

          $id = $row['deviceID'];
          mysqli_close($conn);   

          return $id;
          
     } 

     function createTechnician ($username, $password, $firstname, $lastname, $email, $salary, $experience){
          $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to databse");

          //sql query using collected values
          $usersql = "INSERT INTO Users (firstName, lastName, userName, password, userType, email) 
          VALUES ('$firstname', '$lastname', '$username', '$password', 'technician','$email')";

          $userIDQuery = "SELECT userID FROM Users WHERE userName = '$username'";

          //run  query
          mysqli_query($conn,$usersql) or die(mysqli_error($conn));

           //run the userID query
           $result = mysqli_query($conn, $userIDQuery) or die(mysqli_error($conn));
           //get the query result
           $row = mysqli_fetch_array($result);

           $userID = $row['userID'];
           //sql to add new technician to technicians table
           $techsql = "INSERT INTO technician (Salary, Picture, userID, Experience,startdate) 
           VALUES ($salary,\"\",$userID,'$experience',CURRENT_TIMESTAMP)";

          mysqli_query($conn,$techsql) or die(mysqli_error($conn));

          mysqli_close($conn);

     }

     function addparts ($price, $name, $repairjobid,$type){
          $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to databse");

          $addpartssql = "INSERT INTO parts (Price, Name, repairJobID, type) VALUES($price, '$name',$repairjobid,'$type');";
          $needspartsquery = "UPDATE repairjobs SET needsparts = 1 WHERE repairJobID = $repairjobid ";

          //run  query
          mysqli_query($conn,$addpartssql) or die(mysqli_error($conn));
          mysqli_query($conn,$needspartsquery) or die(mysqli_error($conn));

          mysqli_close($conn);

     }

     function deleteRows ($table,$id){
          $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to databse");

          if($table == 'user'){
              $deleteusersql = "DELETE FROM users WHERE userID = $id;";
               //run  query
               mysqli_query($conn,$deleteusersql) or die(mysqli_error($conn));
          }elseif($table == 'technician'){
               //sql querys
               $deletejobgroupsql = "DELETE FROM technician WHERE TechnicianID = $id;";
               $getuserIDsql = "SELECT userID FROM technician WHERE TechnicianID = $id";
               $deletetechniciansql = "DELETE FROM technician WHERE TechnicianID = $id;";


               //run the userID query
               $userIDresult = mysqli_query($conn, $getuserIDsql) or die(mysqli_error($conn));
               //get the query result
               $row = mysqli_fetch_array($userIDresult);

               $userID = $row['userID'];
               //sql query
               $deletetechuserql = "DELETE FROM users WHERE userID = $userID;";
               //run  query
               mysqli_query($conn,$deletejobgroupsql) or die(mysqli_error($conn));
               //run  query
               mysqli_query($conn,$deletetechniciansql) or die(mysqli_error($conn));
               //run  query
               mysqli_query($conn,$deletetechuserql) or die(mysqli_error($conn)); 
               
          }/* elseif($table == 'repairjob'){
               $getuserIDsql = "SELECT userID FROM technician WHERE repairJobID = $id";
               $deleterepairjobsql = "DELETE FROM repairjobs WHERE repairJobID = $id;";


               //run  query
               mysqli_query($conn,$deleterepairjobsql) or die(mysqli_error($conn));
          }elseif($table == 'orders'){
               $deletepartsql = "DELETE FROM parts WHERE TechnicianID = $id;";
          } */
          mysqli_close($conn);
     }
     
     function updaterepairjob ($repairjobid,$status,$etc, $repairFee){
          $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Failed to connect to databse");

          $updaterepairjob = "UPDATE repairjobs set status = '$status', etc = $etc, repairFee = $repairFee WHERE repairJobID = $repairjobid;";

          mysqli_query($conn,$updaterepairjob) or die(mysqli_error($conn));

          mysqli_close($conn);
     }
     


?>

