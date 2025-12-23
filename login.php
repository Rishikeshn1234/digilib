<?php include "library.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>GM University E-Library | Login</title>
<style>
*{
    box-sizing:border-box;
    font-family:Segoe UI, sans-serif;
}
body{
    margin:0;
    height:100vh;
    background:linear-gradient(135deg,#6b1f1f,#4a1414);
    display:flex;
    justify-content:center;
    align-items:center;
}
.card{
    background:#ffffff;
    width:350px;
    padding:30px;
    border-radius:10px;
    text-align:center;
    box-shadow:0 10px 30px rgba(0,0,0,0.3);
}
.logo{
    width:90px;
    margin-bottom:10px;
}
h2{
    color:#6b1f1f;
    margin-bottom:20px;
}
input{
    width:100%;
    padding:10px;
    margin:8px 0;
    border:1px solid #ccc;
    border-radius:5px;
}
input:focus{
    outline:none;
    border-color:#d4a24c;
}
button{
    width:100%;
    padding:10px;
    margin-top:10px;
    background:#6b1f1f;
    color:white;
    border:none;
    border-radius:5px;
    font-size:16px;
    cursor:pointer;
}
button:hover{
    background:#4a1414;
}
p{
    margin-top:15px;
    font-size:14px;
}
a{
    color:#d4a24c;
    text-decoration:none;
}
a:hover{
    text-decoration:underline;
}
</style>
</head>
<body>

<div class="card">
    <img src="gmulogo.jpg" class="logo">
    <h2>GM University E-Library</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="text" name="uname" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="submit" value="submit" type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register</a></p>
</div>
</body>
</html>

<?php
$obj=new Library();
if(isset($_POST['submit']))
{
    $name=$_POST['uname'];
    $password=$_POST['password'];

    $name=filter_var($name,FILTER_SANITIZE_SPECIAL_CHARS);
    $password=filter_var($password,FILTER_SANITIZE_SPECIAL_CHARS);
    
    if($name==="admin123" && $password==="123456")
    {
        echo "<script>";
        echo "window.location.href='admin.php'";
        echo "</script>";
    }
    else
    {
        if($obj->connect_db("localhost","root","","elib"))
        {
            if($obj->login())
            {
                echo "<script>";
                echo "alert('Login successful')";
                echo "window.location.href='user.php'";
                echo "</script>";
            }
            else
            {
                echo "<script>";
                echo "alert('Invalied username or password or something went wrong')";
                echo "</script>";
            }
        }
        else
        {
            echo "<script>";
            echo "alert('Connection failed')";
            echo "</script>";
        }
        $obj->close_db();
    }

}
?>