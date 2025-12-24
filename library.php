<?php
class Library
{
    private $conn;

    //Function to connect to the database
    public function connect_db($server,$root,$password,$database)
    {
        $this->conn=new mysqli($server,$root,$password,$database);
        if($this->conn->connect_error)
        {
            return false;
            die('Unable to connect to the database');
        }
        else
        {
            return true;
        }
    }

    //Function to close the connection
    public function close_db()
    {
        if($this->conn)
        {
            $this->conn->close();
        }
    }

    //Function to look after the registration
    public function register()
    {
        $uname=$_POST['uname'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        $email=$_POST['email'];

        $uname=filter_var($uname,FILTER_SANITIZE_SPECIAL_CHARS);
        $password=filter_var($password,FILTER_SANITIZE_SPECIAL_CHARS);
        $cpassword=filter_var($cpassword,FILTER_SANITIZE_SPECIAL_CHARS);
        $email=filter_var($email,FILTER_SANITIZE_EMAIL);

        if($password!==$cpassword)
        {
            return false;
        }
        else
        {
            $sql="SELECT * FROM users WHERE uname='$uname'";
            $result=$this->conn->query($sql);
            if($result->num_rows>0)
            {
                return false;
            }
            else
            {
                $sql="INSERT INTO users(uname,password,email,c_time) VALUES('$uname','$password','$email',NOW())";
                if($this->conn->query($sql))
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
    }

    //Function to look after login
    public function login()
    {
        $uname=$_POST['uname'];
        $password=$_POST['password'];
        
        $uname=filter_var($uname,FILTER_SANITIZE_SPECIAL_CHARS);
        $password=filter_var($password,FILTER_SANITIZE_SPECIAL_CHARS);
        
        $sql="SELECT * FROM users WHERE uname='$uname' AND password='$password'";
        $result=$this->conn->query($sql);
        if($result->num_rows>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    //Function to show all existing users to admin
    public function showusers()
    {
        $sql="SELECT uname,email,c_time FROM users";
        $result=$this->conn->query($sql);
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            {
                echo "<tr>";
                echo "<td>".$row['uname']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['c_time']."</td>";
                echo "</tr>";
            }
        }
        else
        {
            echo "<script>";
            echo "alert('No records found')";
            echo "</script>";
        }
    }

    //Function to show books
    public function showbooks()
    {
        $sql="SELECT * FROM books";
        $result=$this->conn->query($sql);
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            {
                echo "<tr>";
                echo "<td>".$row['book']."</td>";
                echo "<td>".$row['author']."</td>";
                echo "<td>".$row['category']."</td>";
                echo "<td><a href='".$row['link']."'>Downlode/View</a></td>";
                echo "</tr>";
            }
        }
        else
        {
            echo "<script>";
            echo "alert('No records found')";
            echo "</script>";
        }
    }

    //Function to add books
    public function addbook()
    {
        $book=$_POST['book'];
        $book=filter_var($book,FILTER_SANITIZE_SPECIAL_CHARS);
        $author=$_POST['author'];
        $author=filter_var($author,FILTER_SANITIZE_SPECIAL_CHARS);
        $category=$_POST['category'];
        $category=filter_var($category,FILTER_SANITIZE_SPECIAL_CHARS);
        $link=$_POST['link'];
        $link=filter_var($link,FILTER_SANITIZE_SPECIAL_CHARS);
        $sql="SELECT * FROM books WHERE book='$book'";
        $result=$this->conn->query($sql);
        if($result->num_rows>0)
        {
            return false;
        }
        else
        {
            $sql="INSERT INTO books(book,author,category,link) VALUES('$book','$author','$category','$link')";
            if($this->conn->query($sql))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }

    //Function to delete book
    public function deletebook()
    {
        $book=$_POST['book'];
        $book=filter_var($book,FILTER_SANITIZE_SPECIAL_CHARS);
        $sql="SELECT book FROM books WHERE book='$book'";
        $result=$this->conn->query($sql);
        if($result->num_rows>0)
        {
            $sql="DELETE FROM books WHERE book='$book'";
            if($this->conn->query($sql))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    //Function to search books
    public function searchbook()
    {
        $search=$_POST['search'];
        $search=filter_var($search,FILTER_SANITIZE_SPECIAL_CHARS);
        $sql="SELECT * FROM books WHERE book='$search' OR author='$search' OR category='$search'";
        $result=$this->conn->query($sql);
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            {
                echo "<tr>";
                echo "<td>".$row['book']."</td>";
                echo "<td>".$row['author']."</td>";
                echo "<td>".$row['category']."</td>";
                echo "<td><a href='".$row['link']."'>Downlode/View</a></td>";
                echo "</tr>";
            }
        }
        else
        {
            echo "<script>";
            echo "alert('No Books found')";
            echo "</script>";
        }

    }
}
?>