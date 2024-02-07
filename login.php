<?php
$erruname = "";
$errpswd = "";
$errmsg = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
   
    if(empty($_POST["uname"])){
        $erruname="this field cannot be empty";
        $flag = 1;
    }
    if(empty($_POST["pswd"])){
        $errpswd="this field cannot be empty";
        $flag = 1;
    }
    $servername = "127.0.0.1";
    $username = "root";
    $password = "Ganesh@7081";
    $database = "findAfriend";
    $conn = mysqli_connect($servername, $username, $password, $database);
    if($flag == 0){ 
        $n_user = $_POST["uname"];
        $n_pswd = $_POST["pswd"];
        $query0 = "select * from users where username = '$n_user' and password = '$n_pswd'";
        $result = mysqli_query($conn, $query0);
        if(mysqli_num_rows($result) == 1){
            session_start();
            $_SESSION['username'] = $n_user;
            $_SESSION['password'] = $n_pswd;
            header("Location:mainpage.php");
        }
        else{
            $errmsg = "incorrect username or password";
        }
}
}
?>
<html>
    <head>
        <style>
            *{
                margin:0px;
                padding:0px;
            }
            body{
                background-color:rgba(255, 166, 0, 0.223);
            }
           
            .title{
                border:1px solid rgba(255, 166, 0, 0.58);
                background-color:rgba(255, 166, 0, 0.58);
                text-align:center;
                font-size:30px;
                height:50px;
                padding:30px;
            }
            td{
                font-size:20px;
                padding:5px;
                color:black;
                font-weight:bold;
            }
            .login{
                margin-left:40%;
                margin-top:20px;
                border:1px solid rgba(255, 166, 0, 0.78);
                background-color:rgba(255, 166, 0, 0.78);
                border-radius:5px;
                height:40px;
                width:200px;
                font-size:20px;
            }
            input,button{
                border:1px solid black;
                border-radius:5px;
                height:30px;
                width:200px;
                background-color:gray;
            }
            .empty{
                font-size:15px;
                color:red;
            }
            </style>
</head>
<body>
    <div class="title">
        <p> FIND 'A' FRIEND</p>
        </div>
        <form action="" method="POST">
            <div class="box">
                <h1>LOGIN</h1>
            <table>
                <tr>
                    <td></td>
                    <td class="empty"><?php echo $errmsg; ?></td>
                </tr>
                <tr>
                    <td>UserName</td>
                    <td><input type="text" name="uname" id="usname"></td>  
                </tr>
                <tr>
                    <td></td>
                <td class="empty"><?php echo $erruname;?></td>
                  </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="pswd"></td>
                </tr>
                <tr>
                    <td></td>
                <td class="empty"><?php echo $errpswd;?></td>
                  </tr>
             </table>
             </div>
               <button class="login">LOGIN</button>
            </form>
      </body>
     </html>
