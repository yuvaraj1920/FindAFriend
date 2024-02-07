<?php
$errcpswd="";
$errfname="";
$errgovid="";
$errlname="";
$errloc="";
$errmail="";
$errphn="";
$errpswd="";
$erruname="";
$verifymsg="";
$unameexist="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $flag = 0;
    if(empty($_POST["fname"])){
        $errfname="this field cannot be empty";
        $flag = 1;
    }
    if(empty($_POST["uname"])){
        $erruname="this field cannot be empty";
        $flag = 1;
    }
    if(empty($_POST["pswd"])){
        $errpswd="this field cannot be empty";
        $flag = 1;
    }
    if(empty($_POST["cnfrmpswd"])){
        $errcpswd="this field cannot be empty";
        $flag = 1;
    }
    else if($_POST["pswd"] != $_POST["cnfrmpswd"]){
        $errcpswd="this must be same as password";
        $flag = 1;
    }
    if(empty($_POST["mail"])){
        $errmail="this field cannot be empty";
        $flag = 1;
    }
    if(empty($_POST["phnnum"])){
        $errphn="this field cannot be empty"; 
        $flag = 1;
    }
    if(empty($_POST["govid"])){
        $errgovid="this field cannot be empty";
        $flag = 1;
    }
    if(empty($_POST["location"])){
        $errloc="this field cannot be empty";
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
        $flag1 = 0;
        $c_username = $_POST["uname"];
        $query0 = "select * from users where username = '$c_username'";
        $result = mysqli_query($conn, $query0);
        if(mysqli_num_rows($result) > 0){
            $unameexist="username already taken";
        }
        else{
        $query1 = "insert into users values('$n_user','$n_pswd')";
        $result = mysqli_query($conn, $query1);
        if(!$result){
        $flag1 = 1;
        }
        $n_fname = $_POST["fname"];
        $n_lname = $_POST["lname"];
        $n_mail = $_POST["mail"];
        $n_phnnum = $_POST["phnnum"];
        $n_govrnid = $_POST["govid"];
        $loc = $_POST["location"];
        $query2 = "insert into user_details values('$n_user', '$n_fname', '$n_lname', '$n_mail', '$n_phnnum', '$n_govrnid', '$loc')";
        $result = mysqli_query($conn, $query2);
        if(!$result){
        $flag1 = 1;
        }
        if($flag == 0){
            session_start();
            $_SESSION['username'] = $n_user;
            $_SESSION['password'] = $n_pswd;
            header("Location:mainpage.php");
        }
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
            .box{
                margin-top:50px;
                margin-left:150px;
                margin-right:150px;
                padding:20px;
                display:flex;
                flex-direction:row;
                gap:50px;
                border:1px solid rgba(255, 166, 0, 0.58);
                border-radius:10px;
                background-color:rgba(255, 166, 0, 0.38);
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
                padding-left:10px;
                color:black;
                font-weight:bold;
            }
            .register{
                margin-left:40%;
                margin-top:20px;
                border:1px solid rgba(255, 166, 0, 0.78);
                background-color:rgba(255, 166, 0, 0.78);
                border-radius:5px;
                height:40px;
                width:200px;
                font-size:20px;
            }
            span{
                color:red;
            }
            .check,input,select,button{
                border:1px solid black;
                border-radius:5px;
                height:30px;
                width:200px;
                background-color:gray:
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
                <div>
            <table>
                <tr>
                    <td>FirstName<span>*</span></td>
                    <td><input type="text" name="fname"></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="empty"><?php echo $errfname;?></td>
                  </tr>
                <tr>
                    <td>LastName</td>
                    <td><input type="text" name="lname"></td> 
                </tr>
                <tr>
                <td></td>
                  <td class="empty"><?php echo $errlname;?></td>
                  </tr>
                <tr>
                    <td>UserName<span>*</span></td>
                    <td><input type="text" name="uname" id="usname" placeholder="enter an unique username"></td>  
                </tr>
                <!-- <tr>
                    <td></td>
                    <td><span class="check" onclick="verify()">Verify</span></td>
                </tr> -->
                <tr>
                <td></td>
                <td class="empty"><?php echo $erruname.$unameexist;?></td>
                  </tr>
                <tr>
                    <td>Password<span>*</span></td>
                    <td><input type="password" name="pswd"></td>   
                </tr>
                <tr>
                <td></td>
                <td class="empty"><?php echo $errpswd;?></td>
                  </tr>
                <tr>
                    <td>ConfirmPassword<span>*</span></td>
                    <td><input type="password" name="cnfrmpswd"></td>    
                </tr>
                <tr>
                <td></td>
                <td class="empty"><?php echo $errcpswd;?></td>
                </tr>
        </table>
                
        </div>
        <div>
                  <table>
                  <tr>
                    <td>Mail<span>*</span></td>
                    <td><input type="text" name="mail"></td>   
                </tr>
                <tr>
                <td></td>
                <td class="empty"><?php echo $errmail;?></td>
                  </tr>
                <tr>
                    <td>Phone Number<span>*</span></td>
                    <td><select>
                        <option value="+91" selected>+91</option>
                        <option value="+1">+1</option>
                        <option value="+39">+39</option>
                        <option value="+52">+52</option>
                        <option value="+61">+61</option>
                     </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="text" name="phnnum"></td> 
                </tr>
                <tr>
                <td></td>
                <td class="empty"><?php echo $errphn;?></td>
                  </tr>
                <tr>
                    <td>Government issued id proof<span>*</span></td>
                    <td>
                    <select>
                        <option value="Aadhar Card" selected>Aadhar Card</option>
                        <option value="Pan card">Pan card</option>
                        <option value="Driving license">Driving license</option>
                        <option value="Passport">Passport</option>
                     </select>
                  </td>
               </tr>
                <tr>    
                    <td></td>
                    <td><input type="text" name="govid"></td>  
                </tr>
                <tr>
                <td></td>
                <td class="empty"><?php echo $errgovid;?></td>
                  </tr>
                <tr>
                    <td>Location<span>*</span></td>
                    <td><input type="text" name="location"></td>    
                </tr>
                <tr>
                <td></td>
                <td class="empty"><?php echo $errloc;?></td>
                  </tr>
            </table>
            </div>
         </div>
            <button class="register">REGISTER</button>
            </form>
      </body>
     </html>
