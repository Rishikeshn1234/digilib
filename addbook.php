<?php include "library.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GM University E-Library | Add Book</title>

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

.container{
    background:#ffffff;
    width:420px;
    padding:30px;
    border-radius:10px;
    box-shadow:0 10px 30px rgba(0,0,0,0.3);
}

h2{
    color:#6b1f1f;
    text-align:center;
    margin-bottom:20px;
}

input{
    width:100%;
    padding:10px;
    margin-top:10px;
    border-radius:5px;
    border:1px solid #ccc;
    font-size:14px;
}

input:focus{
    outline:none;
    border-color:#d4a24c;
}

button{
    width:100%;
    padding:10px;
    margin-top:15px;
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

.back-btn{
    background:gold;
    color:black;
    margin-top:10px;
}
</style>
</head>

<body>

<div class="container">

    <h2>Add New Book</h2>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="text" name="book" placeholder="Book Name" required>
        <input type="text" name="author" placeholder="Author" required>
        <input type="text" name="category" placeholder="Category" required>
        <input type="text" name="link" placeholder="Book Link" required>

        <button type="submit" name="add_book">Add Book</button>
    </form>

    <a href="admin.php">
        <button class="back-btn">Back to Admin Panel</button>
    </a>

</div>

</body>
</html>
<?php
if(isset($_POST['add_book']))
{
    $obj=new Library();
    if($obj->connect_db("localhost","root","","elib"))
    {
        if($obj->addbook())
        {
            echo "<script>";
            echo "alert('Book was successfully added to the database')";
            echo "</script>";
        }
        else
        {
            echo "<script>";
            echo "alert('Unable to add something went wrong')";
            echo "</script>";
        }
    }
    $obj->close_db();
}
?>
