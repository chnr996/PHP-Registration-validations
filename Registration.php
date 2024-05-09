<?php 
$name= $email=$adress=$phone=$password=$confirm_password="";
$name_err=$email_err=$address_err=$phone_err=$password_err=$confirm_password_err="";
$address = "";
$address_err = "";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST["name"])){
        $name_err="Please enter your name";
    } else{
        $name=test_input($_POST["name"]);
        if(!preg_match("/^[a-zA-Z]*$/",$name)){
            $name_err="only leters and space allowed.";
        }
    }
    
if (empty($_POST["email"])) {
    $email_err = "Please enter your email address.";
} else {
    $email = test_input($_POST["email"]);
   
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    }
}

    if (empty($_POST["address"])) {
        $address_err = "Please enter your address.";
    } else {
        $address = test_input($_POST["address"]);
    }
    if(empty($_POST["phone"])){
        $phone_err="Please enter your Phone number";
    } else{
        $phone=test_input($_POST["phone"]);
        if(!preg_match("/^\d{10,13}$/",$phone)){
            $phone_err="invalied phone number,phone number must be between 10 to 13 digits";
        }
        if (empty($_POST["password"])) {
            $password_err = "Please enter a password.";
        } else {
            $password = test_input($_POST["password"]);
            // Check if password meets complexity requirements
            if (strlen($password) < 8) {
                $password_err = "Password must be at least 8 characters long.";
            } elseif (!preg_match("/[A-Za-z]/", $password) || !preg_match("/\d/", $password) || !preg_match("/[^A-Za-z\d]/", $password)) {
                $password_err = "Password must contain at least one letter, one number, and one special character.";
            }
        }
       
       

        
        if (empty($_POST["confirm_password"])) {
            $confirm_password_err = "Please confirm password.";
        } else {
            $confirm_password = test_input($_POST["confirm_password"]);
            if ($password != $confirm_password) {
                $confirm_password_err = "Password did not match.";
            }
        }
        }
    }
   
function test_input($data){
    $data=trim($data);
    $data=stripcslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2 class="mb-4">Registration Form</h2>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?php echo $name; ?>">
          <span class="invalid-feedback"><?php echo $name_err; ?></span>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?php echo $email; ?>">
          <span class="invalid-feedback"><?php echo $email_err; ?></span>
        </div>
        <div class="form-group">
    <label for="address">Address:</label>
    <input type="text" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" id="address" name="address" value="<?php echo $address; ?>">
    <span class="invalid-feedback"><?php echo $address_err; ?></span>
</div>

        <div class="form-group">
          <label for="phone">Phone Number:</label>
          <input type="tel" class="form-control <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>" id="phone" name="phone" value="<?php echo $phone; ?>">
          <span class="invalid-feedback"><?php echo $phone_err; ?></span>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" id="password" name="password">
          <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
          <label for="confirm_password">Confirm Password:</label>
          <input type="password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" id="confirm_password" name="confirm_password">
          <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
