<?php include "library.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>GM University E-Library | Admin Dashboard</title>

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
    padding:40px;
    border-radius:12px;
    box-shadow:0 15px 35px rgba(0,0,0,0.35);
}

.header{
    text-align:center;
    margin-bottom:35px;
}

.logo{
    width:100px;
}

.header h2{
    color:#6b1f1f;
    margin:10px 0 5px;
}

.header p{
    color:#555;
    font-size:14px;
}

.dashboard{
    display:grid;
    grid-template-columns: repeat(2, 1fr);
    gap:25px;
}

.card{
    background:#f9f9f9;
    border-radius:10px;
    padding:25px;
    text-align:center;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    transition:transform 0.2s, box-shadow 0.2s;
}

.card:hover{
    transform:translateY(-5px);
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

.card h3{
    margin-bottom:15px;
    color:#6b1f1f;
}

.card a{
    text-decoration:none;
}

.card button{
    padding:12px 20px;
    background:#6b1f1f;
    color:#fff;
    border:none;
    border-radius:6px;
    font-size:15px;
    cursor:pointer;
}

.card button:hover{
    background:#4a1414;
}

.footer{
    text-align:center;
    margin-top:30px;
}

.logout{
    background:gold;
    color:black;
}
</style>
</head>

<body>

<div class="container">

    <div class="header">
        <img src="gmulogo.jpg" class="logo" alt="GM University Logo">
        <h2>GM University E-Library</h2>
        <p>Administrator Dashboard</p>
    </div>

    <div class="dashboard">

        <div class="card">
            <h3>View Users</h3>
            <a href="showusers.php">
                <button>Open</button>
            </a>
        </div>

        <div class="card">
            <h3>View Books</h3>
            <a href="viewbooks.php">
                <button>Open</button>
            </a>
        </div>

        <div class="card">
            <h3>Add Book</h3>
            <a href="addbook.php">
                <button>Open</button>
            </a>
        </div>

        <div class="card">
            <h3>Delete Book</h3>
            <a href="deletebook.php">
                <button>Open</button>
            </a>
        </div>


    </div>

</div>

</body>
</html>
