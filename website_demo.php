<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.banner{text-align: center;}
h2 {text-align: center;}
h4 {text-align: center;}

body {
  background: black; 
  color: white;
  font-family: Arial;
}

* {
  box-sizing: border-box;
}

form.example input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  width: 80%;
  background: #f1f1f1;
}

form.example button {
  float: left;
  width: 20%;
  padding: 10px;
  background: #f90;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none;
  cursor: pointer;
}

form.example button:hover {
  background: #0b7dda;
}

form.example::after {
  content: "";
  clear: both;
  display: table;
}
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}
.open-button-form {
  color: white;
  position: fixed;
  bottom: 500px;
  left: 250px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}
/* The popup form - hidden by default */
.table-popup {
  display: none;
  position: fixed;
  bottom: 300px;
  left: 250px;
  
  /*bottom: 0;*/
  /*right: 15px;*/
  /*border: 3px solid #f1f1f1;*/
  /*z-index: 9;*/
}




/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: #f90;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

hr {
    width: 50%;
    text-align: center;
}


</style>
</head>
<body>

<?php
// define variables and set to empty values";
if ($_SERVER["REQUEST_METHOD"] == "POST") {   
    $userin = ($_POST["userinput"]);
    $userin1 = ($_POST["userinput_login"]);
    $userin2 = ($_POST["userinput_pass"]);
    $userinlema = ($_POST["userinlema"]);
    // echo $userin1;
    $Operation = ($_POST["Operation"]);
    // $Operation1 = ($_POST["Operation1"]);
}



function insert_input($data) {
  $result = preg_split("/[\s,]+/", $data); 
  foreach ($result as &$value) {
    if (preg_match('/([\d+XYxy]):(\d+)-\d+/i',$value,$matches)) {
      $short_converted = chr . $matches[1] . "_" .$matches[2];
      if ( $converted == "" ) {
        $converted = $short_converted;
      } else {
        $converted = $converted . "\n" .$short_converted;
      }
      file_put_contents("test.txt",$converted);
    } elseif($value = "\n") {
      //$value is string
      continue;
    } else {
      $mutation_ptErr = "Invalid SNPs"; 
    }
  }
  unset($value);  // good practice: destroy reference
  return $mutation_ptErr;
}

?>


<!--<div style="height: 200px; width: 50%; background-color: black; position:fixed; top:140px; left:450px" id="blocking"></div>-->

<div id="banner" class ="banner">
<img alt="Logo" src="/images/logo.jpg" width="400px">
</div>

<form id="myform" class="example" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="margin:auto;max-width:300px" method="post">
  <input type="text" name="userinput" placeholder="Search.." id="userinput">
  <button type="submit" id="mybutton"><i class="fa fa-search"></i></button>
  <br>
  <label for="SQL Operation">Choose SQL Operation</label>
  <select name="Operation", id="Operation">
    <option value="Void">Void</option>
    <option value="Select" id="dis1">Select</option>
    <option value="Insert" id="dis2">Insert</option>
    <option value="Update" id="dis3">Update</option>
    <option value="Delete" id="dis4">Delete</option>
    <option value="Contribute">Contribute</option>
    <option value="Predict">Predict</option>
    <option value="Search for Professors">Search for Professors</option>
    <option value="Search for Programs">Search for Programs</option>
  </select>
  <br>
  <!--options for contribution and inferring-->
  <!--<label for="SQL Operation">Feeling Lucky?</label>-->
  <!--<select name="Operation", id="Operation">-->

  <!--</select>    -->
  <!--</br>-->
  
</form>

<button class="open-button-form" onclick="openForm2()" style="color:grey;">Table Info</button>
<div class="table-popup" id="myForm2">
  <form action="/action_page.php" class="table-container">
    <h4 style="color:grey;">Table Info</h4>
    Notice: <br>
    <br>
    Professor Format: name,expertise (_ in case of none)
    <br>
    Program Format: uniname,college,major,gpa (_ in case of none) 
    <br>    
    Insert Format: (data,data,data) [one at each time]
    <br>
    Update Format: UniName = "xxx" where UniID = 1
    <br>
    Delete Format: UniID = 1
    <br>
    Select Format: UniName = " "
    <br>
    Contribute Format: (GRE, GPA, Schoolname, #ofPublication, Gender, Phd_flag, Resultname) 
    <br>
    (Predict Format: GRE, GPA, Schoolname, #ofPublication, Gender, Phd_flag)
    <br>
    Varchar: data: "a"
    <br>
    Universities: (UniID(varchar), UniName(varchar), Location(varchar))
    <button type="button" class="btn cancel" onclick="closeForm2()">Close</button>
  </form>
</div>


<!--the login form-->
<!--<button class="open-button" onclick="openForm()">Open Form</button>-->
<!--<div class="form-popup" id="myForm">-->
<!--  <form class="form-container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">-->
<!--    <h2 style="color:black;">Login</h2>-->

<!--    <label for="email" style="color:black;"><b>Email</b></label>-->
<!--    <input type="text" placeholder="Enter Email" name="userinput_login" required>-->
<!--    <input type="text" placeholder="Enter Email" name="userinput_pass" required>-->

    <!--<label for="psw" style="color:black;"><b>Password</b></label>-->
    <!--<input type="password" placeholder="Enter Password" name="psw" required>-->

    
<!--    <button type="submit" class="btn">Login</button>-->
<!--    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>-->
    
<!--  </form>-->
<!--</div>-->


<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}
function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
function openForm2() {
  document.getElementById("myForm2").style.display = "block";
}
function closeForm2() {
  document.getElementById("myForm2").style.display = "none";
}
function disappear(){
  document.getElementById("dis1").style.display = "none";
  document.getElementById("dis2").style.display = "none";
  document.getElementById("dis3").style.display = "none";
  document.getElementById("dis4").style.display = "none";
}

</script>

<!--output the result from inferring-->
<!--<h2 id="out4infer"> placeholder </h2>-->


<?php
// echo "<h2>Your Output:</h2>"; 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
echo "<CENTER>$userin</CENTER>";
// echo "<CENTER>$Operation</CENTER>";

$servername = "localhost";
$username = "pandaexpress_perspectivestudent";
$password = "ckhdzxlrhzjl";
$dbname = "pandaexpress_GradHub";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

//login
if (isset($_POST['userinput_login']) && isset($_POST['userinput_pass'])) {
        //query for userID
        $sql = "select * from UserInfo where UserID = "."'".$userin1."'";
        
        $result = $conn->query($sql);
        
      if ($result->num_rows > 0) {
      // output data of each row
        while($row = $result->fetch_assoc()) {
            
            if($row['Password'] != $userin2)
            {
                echo "<script>alert('Invalid password');</script>";
            }
            
            else
            {
                if($row['Power'] == '0')
                {
                    echo "<script>alert('Logged in as a user'); disappear();</script>";
                }                    
                else
                {
                    echo "<script>alert('Logged in as a superuser');</script>";                    
                }
                echo "<script>document.getElementById('userinput').style.display = 'none';</script>";                    
            }            
        }
        
      }        
        
        else
        {
              echo "<script>alert('Invalid UserID');</script>";
        }

        
}




if($Operation == "Insert"){
    $sql = "INSERT INTO Universities(UniID, UniName, Location) Values $userin";
    // echo $sql;
    if ($conn->multi_query($sql) === TRUE) {
        echo "New records inserted successfully";
    } else {
        echo "Error inserting record: " . $sql . "<br>" . $conn->error;
    }
}
if($Operation == "Delete"){
    $sql = "DELETE FROM Universities Where $userin";
    // echo $sql;
    if ($conn->query($sql) === TRUE) {
       echo "Record deleted successfully";
    } else {
       echo "Error deleting record: " . $conn->error;
    }
}
if ($Operation == "Update"){
    $sql = "UPDATE Universities set $userin";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
if ($Operation == "Select"){
  $sql = "SELECT * from Universities where $userin";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
  // output data of each row
    while($row = $result->fetch_assoc()) {
      echo $row["UniID"]. " ". $row["UniName"]. " ". $row["Location"]. " ". "<br>";
    } 
  } else {
      
  }
}


// Insert operation on Record table

if($Operation == "Contribute"){
    
    $sql = "INSERT INTO Record(GRE, GPA, School, Publication, Gender, Phd, Result) Values $userin";
    // echo $sql;
    if ($conn->multi_query($sql) === TRUE) {
        echo "New records inserted successfully";
    } else {
        echo "Error inserting record: " . $sql . "<br>" . $conn->error;
    }
}


//Prediction 
if ($Operation == "Predict"){
  $sql = "SELECT * from Record";
//   echo $sql;
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
  // output data of each row
    while($row = $result->fetch_assoc()) {
        $temp = $row["GRE"]. " ". $row["GPA"]. " ". $row["School"]. " ". $row["Publication"]. " ". $row["Gender"]. " ". $row["Phd"]. " ". $row["Result"]. " "."\n";
        //write the dataset into samples.txt 
        $myfile = fopen("samples.txt", "a+") or die("Unable to open file!");
        fwrite($myfile, $temp);
        fclose($myfile);
        //remember to purge the txt file in python
    } 
  } else {
    // echo "0 results";
  }
    //Put the user input info into inpu.txt
    //$temp2 = $userin["GRE"]. " ". $userin["GPA"]. " ". $userin["School"]. " ". $userin["Publication"]. " ". $userin["Gender"]. " ". $userin["PhD"]. "\n";
    $myfile2 = fopen("input.txt", "w") or die("Unable to open file!");
        fwrite($myfile2, $userin);
        fclose($myfile2);
    $command = escapeshellcmd('python infer.py');
    $output = shell_exec($command);
    $result = fopen("result.txt", "r") or die("Unable to open file!");
    #fread($result,filesize("result.txt"));
    $result_str = fgets($result);
    if (preg_match('/\[(.*)\]/',$result_str,$matches)) {
        echo  "<h2><center>You can apply for: $matches[1]</center></h2>";
    }
    fclose($result);

}

if ($Operation == "Search for Programs"){
    //Data parsing
    $pattern = "/[-\s,]/";
    $components = preg_split($pattern, $userin);
    //university argument  
    if($components[0] != "_"){
        $sql1 = "uni.UniName=". "'".$components[0]."'";
    }
    else{
        $sql1 = "True";
    }
    
    //college argument
    if($components[1] != "_"){
        $sql2 = "col.ColName=". "'".$components[1]."'";
    }
    else{
        $sql2 = "True";
    }

    //major argument
    if($components[2] != "_"){
        $sql3 = "prog.MajorName=". "'".$components[2]."'";
    }
    else{
        $sql3 = "True";
    }
    
    //GPA argument
    if($components[3] != "_"){
        $sql4 = "prog.GPAbar<=".$components[3];
    }
    else{
        $sql4 = "True";
    }
    
    $sql = "SELECT uni.UniName as uni_name, prog.MajorName as major, prog.GPAbar as gpa, prog.GREbar as gre, prog.URL as url
            from Universities uni join Program prog on uni.UniID = prog.UniID join Colleges col on col.UniID = uni.UniID
            where ".$sql1." and ".$sql2." and ".$sql3." and ".$sql4.";";

    
    //concatenate sql query 
    // $sql = "select * from Universities;";
    $result = $conn->query($sql);
   if ($result->num_rows > 0) {
   // output data of each row
     echo "<hr>";
     $cols = " University | "." GPA Bar |"." GRE Bar |"." Major |"." Website ";
     echo "<h3><center>$cols</center></h3>";
     while($row = $result->fetch_assoc()) {
      $prompt = $row['uni_name']. " | ". $row['gpa']. " | ". $row['gre']. " | ". $row['major']. " | ". $row['url'];
      echo "<p3><center>$prompt</center></p3>";
    //   echo $row["UniName"];
    
     } 
   }
   else {
      echo("doesn't exist a school like that -_-");
   }    

}


if ($Operation == "Search for Professors"){
    //Data parsing
    $pattern = "/[-\s,]/";
    $components = preg_split($pattern, $userin);
    //university argument  
    if($components[0] != "_"){
        $sql1 = "ProfName like ". "'".$components[0]."%'";
    }
    else{
        $sql1 = "True";
    }
    
    //college argument
    if($components[1] != "_"){
        $sql2 = "FieldOfExpertise=". "'".$components[1]."'";
    }
    else{
        $sql2 = "True";
    }
    
    $sql = "SELECT *
            from Professor
            where ".$sql1." and ".$sql2.";";

    
    //concatenate sql query 
    // $sql = "select * from Universities;";
    $result = $conn->query($sql);
   if ($result->num_rows > 0) {
   // output data of each row
    echo "<hr>";
    $cols = " Name | "." Institute | "." Expertise ";
    echo "<h3><center>$cols</center></h3>";
    while($row = $result->fetch_assoc()) {
     $prompt = $row['ProfName']. " | ". $row['Institute']. " | ". $row['FieldOfExpertise'];
     echo "<p3><center>$prompt</center></p3>";
    
     } 
   }
   else {
      echo("doesn't exist a professor like that -_-");
   }    
}


// echo "Connected successfully";
// $sql = "SELECT * FROM Loser";
// $result = $conn->query($sql);
// if ($result->num_rows > 0) {
//   // output data of each row
//   while($row = $result->fetch_assoc()) {
//     echo "id: " . $row["id"]. " - Name: " . $row["Kehang Chang"]. " " . "<br>";
//   }
// } else {
//   echo "0 results";
// }
$conn->close();

}
?>
</body>
</html> 
