<?php include "library.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>GM University E-Library | Search Books</title>

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
    align-items:flex-start;
    padding:40px 0;
}

.container{
    background:#ffffff;
    width:900px;
    padding:35px;
    border-radius:12px;
    box-shadow:0 15px 35px rgba(0,0,0,0.35);
}

h2{
    text-align:center;
    color:#6b1f1f;
    margin-bottom:30px;
}

/* Sections */
.section{
    margin-bottom:40px;
}

.section h3{
    color:#6b1f1f;
    margin-bottom:15px;
}

/* Search box */
.form-box{
    max-width:450px;
    margin:0 auto;
    background:#f9f9f9;
    padding:25px;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

input{
    width:100%;
    padding:10px;
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
    margin-top:15px;
    padding:12px;
    background:#6b1f1f;
    color:#fff;
    border:none;
    border-radius:6px;
    font-size:15px;
    cursor:pointer;
}

button:hover{
    background:#4a1414;
}

/* Tables */
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

.quiz-btn{
    background:#d4a24c;
    color:black;
}

.quiz-btn:hover{
    background:#b88b3c;
}

.back-btn{
    margin-top:20px;
    background:gold;
    color:black;
}
</style>
</head>

<body>

<div class="container">

    <h2>GM University E-Library</h2>

    <!-- SEARCH BOOK -->
    <div class="section">
        <div class="form-box">
            <h3>Search Book</h3>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="text" name="search" placeholder="Book / Author / Category" required>
                <button type="submit" name="search_book">Search</button>
            </form>
        </div>
    </div>

    <!-- TAKE QUIZ -->
    <div class="section">
        <div class="form-box">
            <h3>Take Quiz</h3>
            <p style="font-size:14px;color:#555;">
                Test your knowledge and improve your learning.
            </p>
            <a href="quiz.php">
                <button class="quiz-btn">Start Quiz</button>
            </a>
        </div>
    </div>

    <!-- SEARCH RESULTS -->
    <?php if(isset($_POST['search_book'])) { ?>
    <div class="section">
        <h3>Search Results</h3>
        <table>
            <tr>
                <th>Book</th>
                <th>Author</th>
                <th>Category</th>
                <th>Link</th>
            </tr>
            <?php
                $obj2=new Library();
                if($obj2->connect_db("localhost","root","","elib"))
                {
                    $obj2->searchbook();
                }
                $obj2->close_db();
            ?>
        </table>
    </div>
    <?php } ?>

    <!-- ALL BOOKS -->
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
                $obj=new Library();
                if($obj->connect_db("localhost","root","","elib"))
                {
                    $obj->showbooks();
                }
                $obj->close_db();
            ?>
        </table>
    </div>

    <center>
        <a href="login.php">
            <button class="back-btn">Back to Dashboard</button>
        </a>
    </center>

</div>

</body>
</html>
