<?php include "library.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GM University E-Library | View Books</title>

<style>
*{
    box-sizing:border-box;
    font-family:Segoe UI, sans-serif;
}

body{
    margin:0;
    min-height:100vh;
    background:linear-gradient(135deg,#6b1f1f,#4a1414);
    display:flex;
    justify-content:center;
    align-items:center;
}

.container{
    background:#ffffff;
    width:900px;
    padding:30px;
    border-radius:10px;
    box-shadow:0 10px 30px rgba(0,0,0,0.3);
}

h2{
    color:#6b1f1f;
    text-align:center;
    margin-bottom:20px;
}

.section{
    margin-top:30px;
}

.form-box{
    max-width:400px;
    margin-bottom:30px;
}

input, button{
    width:100%;
    padding:10px;
    margin-top:10px;
    border-radius:5px;
    border:1px solid #ccc;
    font-size:14px;
}

button{
    background:#6b1f1f;
    color:white;
    border:none;
    cursor:pointer;
}

button:hover{
    background:#4a1414;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
}

th, td{
    padding:10px;
    border:1px solid #ccc;
    text-align:left;
}

th{
    background:#6b1f1f;
    color:white;
}

.back-btn{
    background:gold;
    color:black;
    margin-top:20px;
}
</style>
</head>

<body>

<div class="container">

    <h2>GM University E-Library</h2>

    <!-- SEARCH BOOK -->
    <div class="section form-box">
        <h3>Search Book</h3>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="text" name="search" placeholder="Book / Author / Category" required>
            <button type="submit" value="search" name="search_book">Search</button>
        </form>
    </div>

     <!-- VIEW BOOKS -->
    <div class="section">
        <h3>SEARCH BOOKS</h3>

        <table>
            <tr>
                <th>Book</th>
                <th>Author</th>
                <th>Category</th>
                <th>Link</th>
            </tr>
                    <?php
if(isset($_POST['search_book']))
{
    $obj2=new Library();
    if($obj2->connect_db("localhost","root","","elib"))
    {
        $obj2->searchbook();
    }
    else
    {
        echo "<script>";
        echo "alert('Unable to connect to database')";
        echo "</script>";
    }
    $obj2->close_db();
}
?>
</table>


    <!-- VIEW BOOKS -->
    <div class="section">
        <h3>All Books</h3>

        <table>
            <tr>
                <th>Book</th>
                <th>Author</th>
                <th>Category</th>
                <th>Link</th>
            </tr>

            <?php
            $obj = new Library();
            if ($obj->connect_db("localhost","root","","elib"))
                {

                if (isset($_POST['search_book'])) {
                    $obj->searchbook();
                } else {
                    $obj->showbooks();
                }
            }
            $obj->close_db();
            ?>
        </table>

        <center>
            <a href="admin.php">
                <button class="back-btn">Back to Admin Panel</button>
            </a>
        </center>
    </div>

</div>

</body>
</html>