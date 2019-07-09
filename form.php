<html>
<head>
<style>
.error {color: #FF0000;}
</style>

<?php include 'nav.php'  ?>
</head>
<body>  

<?php

// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $daysErr = "";
$name = $email = $gender = $comment = $days = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }
    
  if (empty($_POST["days"])) {
    $daysErr = "Days is required";
  } else {
    $days = test_input($_POST["days"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if ($days<=-1) {
      $daysErr = "Invalid number"; 
    }
    }
    }   

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div class="inline">
  <br><br>
<h2 style="text-align: left;">Itinerary Subbmission</h2>
<h4>Share Your Travel Experience</h4>

<p><span class="error">* required field</span></p>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

  Name: <input type="text" name="name" placeholder="Enter your name" value="<?php echo $name;?>" >
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>

  E-mail: <input type="text" name="email" placeholder="Enter your valid email " value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>  

  Days: <input type="number" name="days" placeholder="Number of days to travel" value="<?php echo $days;?>">
  <span class="error">* <?php echo $daysErr;?></span>
  <br><br>

  Itinerary/Message: <textarea name="comment" rows="5" cols="40" placeholder="share your intinerary to help other"><?php echo $comment;?></textarea>
  <br><br>

  Gender:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>

  <input type="submit" name="submit" value="Submit">  
</form>

</div>

<?php

if(isset($_POST['submit'])) {
$name = $_POST['name'];
$email = $_POST['email'];
$days = $_POST['days'];
$message = $_POST['comment'];
// mail(to, subject, message)
$email = mail("bijaya.shrestha408@gmail.com", "Sender name:".$name, "days:".$days."From:" . $email. $message,);
if($email) {
echo "Subbmission of your Itinerary to admin is successfully Sent.";
} else {
echo "Subbmission Failed deu to some issue!!!!.";
}
}

?>


</body>
</html>