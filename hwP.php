<?php

session_start();

if(isset($_POST['submit']))
{   
  $host = "localhost";
  $user = "root";
  $password = "";
  $database = "myDB";
  
  $conn = mysqli_connect($host,$user,$password,$database) or die("Connection Failed!");
  
   //error handling
    $errors = array();
    
    $user_name = $_POST['username'];
    $full_name = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

 if(!(ctype_alpha($user_name))){
        $errors[] = "<b> Username must contains only letters </b>";
    }

//Check the terms to password
  if($password === $user_name
        || strlen($password)<6 
        || strlen($password)>10 
        || !(preg_match('`[A-Z]`',$password)) 
        || !(preg_match('`[a-z]`',$password))
        || !(preg_match('`[0-9]`',$password)) 
    ){
        $errors[] = "<b> Password should be 6-10 length <br>
         Atleast one small letter and one captital letter and one digit <br> Should not the same of user-name </b>";
    }
     if(!($password === $confirm_password))
    {
        $errors[] = "<b> Password's doesn't match! </b>";
    }

  if(empty($errors) == true)
    {
    
     $res = "INSERT INTO userdetails(UserName, FirstName, email, password) VALUES ('$user_name','$full_name','$email','$password')";
        mysqli_query($conn,$res) or die("Couldn't Insert the data, please check database connection");

        echo "Signed Up Successfully!";
 }else{
        foreach($errors as $error){
            echo "$error <br><br>";
        }
        
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<title>Sign Up Page</title>
</head>

<body>
  
    <h1><b>Sign Up </b></h1>
    
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >

      
        <input type="text" placeholder="Username" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>"required>
        <br><br>
        <input type="text" placeholder="Fullname" name="fullname" value="<?php echo isset($_POST['fullname']) ? $_POST['fullname'] : ''; ?>"required>
        <br><br>
        <input type="email" placeholder="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
        <br><br>
        <input type="password" placeholder="Password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>" required>
        <br><br>
        <input type="password" placeholder="Confirm_password" name="confirm_password" value="<?php echo isset($_POST['confirm_password']) ? $_POST['confirm_password'] : ''; ?>" required>
        <br><br>        
        <input type="checkbox" required>
        <label for="check" name="check">I agree to website agreement</label>
        <br><br>
        <button type="submit" name="submit">Login</button>
        <br>

    </form>

</body>
</html>
    
    
    
    
    
    
