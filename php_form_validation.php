<!DOCTYPE html>
<html lang="en-US">
<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="php_form_validation.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">  
    <link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500&display=swap" rel="stylesheet">
<style>
    .error {color: #FF0000;}
</style>
</head>

<body>
<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";    
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
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

  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL";
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
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
    <div class="container">
        <div class="form-container" id="order-now">
            <h2>PHP Form Validation</h2>
            <form id="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
                <div class="form-field">
                    <label class="label-block" id="name-label" for="name">Name<span class="error">* <?php echo $nameErr;?></span></label>
                    <input class="edit-input" id="name" type="text" name="name" value="<?php echo $name;?>">
                    
                </div>
                
                <div class="form-field">
                    <label class="label-block" id="email-label" for="email">e-mail<span class="error">* <?php echo $emailErr;?></span></label>
                    <input class="edit-input" id="email" type="text" name="email" value="<?php echo $email;?>">
                    
                </div>
                
                <div class="form-field">
                    <label class="label-block" id="website-label" for="website">Website<span class="error"><?php echo $websiteErr;?></span></label>
                    <input class="edit-input" id="website" type="text" name="website" value="<?php echo $website;?>">
                    
                </div>
                
                <div class="form-field">
                    <label class="label-block" id="label-comment" for="comment">Comment</label> 
                    <textarea class="edit-input especial" id="comment" name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
                </div>
                
                <div class="form-field">
                    <fieldset>
                        <legend>Gender<span class="error">* <?php echo $genderErr;?></span></legend>
                        
                        <p><label class="radio-label" for="radio1">
                        <input id="radio1" type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">
                        Female</label></p>    
                            
                        <p><label class="radio-label" for="radio2">
                        <input id="radio2" type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">
                        Male</label></p>    
                            
                        <p><label class="radio-label" for="radio3">
                        <input id="radio3" type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">
                        Other</label></p>        
                            
                        
                    </fieldset>    
                </div>
                
                <div class="form-field">
                    <input class="edit-input especial" type="submit" id="submit" value="Submit"/>  
                </div>
            </form>
    
        

            <div class="invoice">
                <div id="invoice">
                    <h3>Output</h3>
                    <h4>Name:</h4>
                    <?php echo $name;?>
                    <h4>e-mail:</h4>
                    <?php echo $email;?>
                    <h4>Website:</h4>
                    <?php echo $website;?>
                    <h4>Comment:</h4>
                    <?php echo $comment;?>
                    <h4>Gender:</h4>
                    <?php echo $gender;?>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
