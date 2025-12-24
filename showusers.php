<?php include "library.php"; ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    background:#fff;
    width:900px;
    padding:30px;
    border-radius:10px;
    box-shadow:0 10px 30px rgba(0,0,0,0.3);
}

.header{
    text-align:center;
    margin-bottom:20px;
}

.logo{
    width:90px;
}

h2{
    color:#6b1f1f;
    margin:10px 0;
}

.select-box{
    display:flex;
    gap:10px;
    color: white;
    margin-bottom:20px;
}

select, button, input{
    padding:10px;
    border-radius:5px;
    border:1px solid #ccc;
    font-size:14px;
}

button{
    background:#6b1f1f;
    color:#fff;
    border:none;
    cursor:pointer;
}

button:hover{
    background:#4a1414;
}

.section{
    display:block;
    margin-top:20px;
    color: white;
}

table{
    width:100%;
    border-collapse:collapse;
}

th, td{
    padding:10px;
    border:1px solid #ccc;
    text-align:left;
}

th{
    background:#6b1f1f;
    color:#fff;
}

.form-box{
    max-width:400px;
}

    </style>
</head>
<body>
    <!-- VIEW BOOKS -->
    <div id="viewBooks" class="section">
        <h3>ALL USERS</h3>
        <table>
            <tr>
                <th>User name</th>
                <th>Email</th>
                <th>Records</th>
            </tr>
            <?php
                $obj=new Library();
                if($obj->connect_db("localhost","root","","elib"))
                {
                    $obj->showusers();
                }
                $obj->close_db();
            ?>
        </table>
        <br>
        <center>
            <a href="admin.php"><button style="background-color: gold;">Back to Home</button></a>
        </center>
    </div>
</body>
</html>