<?php
  require_once('setdb.php');
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Registration Form</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  </head>
  <body>

    <div >
      <?php
      $supply_num = $tin = $email = '';
      $errors = array('supplynum'=>'','tin'=>'','email'=>'','password'=>'','repassword'=>'');

       if (isset($_POST['create'])) {

         //check supply number
         if (empty($_POST['supplynum'])) {
           $errors['supplynum'] = "A supply Number is Required";
         }else {
           $supply_num = $_POST['supplynum'];
           if (!preg_match('/^$|^[0-9]{12}$/' , $supply_num)) {
             $errors['supplynum'] = "Supply number must be 12 digits";
           }
         }

         //check tin
         if (empty($_POST['tin'])) {
           $errors['tin'] = "A TIN is Required";
         }else {
           $tin = $_POST['tin'];
           if (!preg_match('/^$|^[0-9]{9}$/' , $tin)) {
             $errors['tin'] = "TIN must be 9 digits";
           }
         }

         //check Email
         if (empty($_POST['email'])) {
           $errors['email'] = "An email/Username is Required!";
         }else {
           $email = $_POST['email'];
           if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
             $errors['email'] = "invalid type of email";
           }
         }

         //check password validation
         if (empty($_POST['password'])) {
           $errors['password'] = "A password is Required";
         }else {
           $password = $_POST['password'];
           if (!preg_match('^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$^' , $password)) {
             $errors['password'] = "Password must contain at least 8 digits with a capital,a lower case letter and a number";
           }
         }

         //vallidate the password
         $repassword = $_POST['repassword'];
         if($password != $repassword){
         $errors['repassword'] = "passwords doesn't match";
         }else{
            $sql = "INSERT INTO useraccounts (supplynum,tin,email,password) VALUES ('$supply_num','$tin','$email','$password')";
            $result = mysqli_query($conn,$sql);

            //chech if is added to db
            if ($result) {
              echo "successfully added to db";
            }else {
              echo 'error'.mysqli_error($conn);
            }
            $sql = "INSERT INTO useraccounts (supplynum,tin,email,password,repassword) VALUES ('$supply_num','$tin','$email','$password')";
            $conn->close();
          }

     }

       ?>

    </div>
    <div>


      <form action="index.php"  method="post" id="register-form">
      <div class="container">
        <div class="row">
          <div class="col-sm-3">
          <h1>Registration</h1>
          <p>Fill Up The Form</p>
          <hr class="mb-3">

          <label for="supplynum"><b>Supply Number</b></label>
          <input class="form-control" id="supplynum" type="text" name="supplynum" value="<?php echo htmlspecialchars($supply_num); ?>" required>
          <div class="red-text"><?php echo $errors['supplynum']; ?></div>

          <label for="tin"><b>TIN</b></label>
          <input class="form-control" id="tin" type="text" name="tin" value="<?php echo htmlspecialchars($tin); ?>" required>
          <div class="red-text"><?php echo $errors['tin']; ?></div>

          <label for="email"><b>Email</b></label>
          <input class="form-control" id="email" type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
          <div class="red-text"><?php echo $errors['email']; ?></div>

          <label for="password"><b>Password</b></label>
          <input class="form-control" id="password" type="password" name="password" required>
          <div class="red-text"><?php echo $errors['password']; ?></div>

          <label for="repassword"><b>Repeat Password</b></label>
          <input class="form-control" id="repassword" type="password" name="repassword" required>
          <div class="red-text"><?php echo $errors['repassword']; ?></div>

          <hr class="mb-3">
          <input class="btn btn-primary" type="submit" name="create" value="Register">
          </div>
        </div>
      </div>
    </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
    <script src="script.js"></script>
  </body>
</html>
