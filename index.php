<?php
session_start();

require_once"./includes/connect.php";
if (isset($_POST['login'])) {
    $user=$_POST['username'];
    $pass=sha1($_POST['password']);
    if (!empty($user) && !empty($pass)){
            $sql="SELECT * FROM employees WHERE (username='$user' || phone='$user') AND password='$pass'";
            $query=mysqli_query($conn,$sql);     
            if ($fet=mysqli_fetch_array($query)) {
                $_SESSION['status']= 1;
                $_SESSION['id']=$fet['id'];
                $_SESSION['type']=$fet['type'];
                $names = '&nbsp;' . $fet['firstname']. '&nbsp;'.$fet['lastname'];
                $_SESSION['quickName'] = ($fet['gender']=='Male')?'Mr'.$names:'Mrs'.$names;
                if ($fet['type']==='Admin') {
                    header('location:./admin.php');
                }
                if ($fet['type']==='Normal-employee') {
                    header('location:./user/user.php');
                } 
            }
            else{
                session_destroy();
                $out="<b class='error'>Invalid username or password</b>";
            }
    }
    else{
        $out= "<b class='error'>Please fill all fields</b>";
    }
}
?>




<!DOCTYPE html>
<html >
  <head>
    
    <title>Login</title>
    <link rel="shortcut icon" type="image/png" href="images/a.png"> 
        <link rel="stylesheet" href="css/as.css"> 
        
  </head>
  <body>


<?php
if (isset($_SESSION['status'])  && $_SESSION['status'] == 1){
?>
<?php
    }
?>

    <div class="container">

  <div id="login-form">

    <h3>Payroll M.S</h3>

    <fieldset>

      <form action="" method="POST">

            <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg']."<br>";
        session_destroy();
    }
    ?>
        <input type="text" class="form-control" placeholder=" email or phone" name="username"></br></br>
        <input type="password" class="form-control" placeholder="Password" name="password">  
        <a href="includes/admin.php"><input type="submit" value="Login" name="login"></a>
        <footer class="clearfix">



        </footer>
        <?php
if (isset($out)) {
    echo $out;
}
?>

      </form>

    </fieldset>

  </div> <!-- end login-form -->

</div>



    
    
    
    
    
  </body>
</html>
