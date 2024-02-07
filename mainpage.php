<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
 if(isset($_SESSION['username'])){
$c_user = $_SESSION['username'];
$sloc=$_POST["sdate"];
$dloc=$_POST["ddate"];
$loc=$_POST["loc"];
$int1=$_POST["interest1"];
$int2=$_POST["interest2"];
$sdate=$_POST["fdate"];
$edate=$_POST["tdate"];
$gender="male";
$budget=$_POST["budget"];
$interestone=$_POST["interest1"];
$interesttwo=$_POST["interest2"];
$servername="127.0.0.1";
$username="root";
$password="Ganesh@7081";
$database="findAfriend";
$conn = mysqli_connect($servername, $username, $password, $database);
$response = "";
$history = "";
$query0_1 = "select * from matches where username = '".$c_user."'";
$result0_1= mysqli_query($conn, $query0_1);
if(mysqli_num_rows($result0_1) == 0){
    if((!empty($sloc) && !empty($dloc)) || (!empty($loc)) || (!empty($int1) && !empty($int2))){
    $query0_2 = "insert into matches values('$c_user','$sloc', '$dloc', '$interestone', '$interesttwo','$sdate','$edate',$budget,'$loc')";
    $result0_2= mysqli_query($conn, $query0_2);
    }
    else{
        $response = "LET US KNOW YOUR PREFERENCES";
    }
}
else{
    $result1 = "";
    $flag = 0;
    $startloc = "";
    $endloc = "";
    $loc="";
    $interest1 = "";
    $interest2 = "";
    $counter = 0;
    while($data = mysqli_fetch_assoc($result0_1)){
     $type = "travel partner";
     if($data['start_location'] !=null){
     $startloc = $data['start_location'];
     }
     if($data['destination_location'] !=null){
     $endloc = $data['destination_location'];
     }
     if($data['location'] !=null){
     $loc=$data['location'];
     }
     if($data['interest1'] !=null){
     $interest1=$data['interest1'];
     }
     if($data['interest2'] !=null){
     $interest2=$data['interest2'];
     }
    }
     if($counter == 0){
     $history = $history."<tr><td>S.NO</td><td>start location</td><td>destination</td><td>explore location</td><td>interests1</td><td>interests2</td></tr>";    
     }
     $history = $history."<tr><td>".$counter."</td><td>".$type."</td><td>".$startloc."</td><td>".$endloc."</td><td>".$loc."</td><td>".$interest1."</td><td>".$interest2."</td></tr>";     
 if((!empty($sloc) && !empty($dloc)) && (!empty($loc)) && (!empty($int1) || !empty($int2))){
    $query1 = "select username from matches where (start_location='$sloc' and destination_location = '$dloc' and username != '".$c_user."') and (location='$loc' and username != '".$c_user."') and (interest1='$int1' or interest2='$int2' and username != '".$c_user."')";
    $result1 = mysqli_query($conn, $query1);
}
else if((!empty($sloc) && !empty($dloc)) || ((!empty($loc)) && (!empty($int1) || !empty($int2)))){
    $query1 = "select username from matches where start_location='$sloc' and destination_location = '$dloc' and username != '".$c_user."'";
    $result1 = mysqli_query($conn, $query1);
}
else if(((!empty($sloc) && !empty($dloc)) && (!empty($int1) || !empty($int2)))){
    $query1 = "select username from matches where ((start_location='$sloc' and destination_location = '$dloc' and username != '".$c_user."') and (interest1='$int1' or interest2='$int2' and username != '".$c_user."'))";
    $result1 = mysqli_query($conn, $query1);
}
else{
    $flag = 1;
    $response = "LET US KNOW YOUR PREFERENCES";
}
if(!empty($result1) && mysqli_num_rows($result1) > 0){
    $count = 0;
   while($user = mysqli_fetch_assoc($result1)){
    $query1_2 = "select lastname, mail, phonenumer from user_details where username = '".$user['username']."'";
    $result1_2 = mysqli_query($conn, $query1_2);
    $type = "travel partner";
    if($count == 0){
        $response = $response."<tr><td>S.NO</td><td>PARTNER TYPE</td><td>NAME</td><td>MAIL</td><td>PHONE NUMBER</td></tr>";    
        }
    while($r = mysqli_fetch_assoc($result1_2)){
        $resulttable="resulttable";
      $response = $response."<tr class=".$resulttable."><td>".$count."</td><td>".$type."</td><td>".$r['lastname']."</td><td>".$r['mail']."</td><td>".$r['phonenumer']."</td></tr>"; 
    } 
    $count = $count + 1;
   }
}
else{
    if($flag == 0){
    $query2_2 = "update matches SET start_location='".$sloc."', destination_location='".$dloc."', interest1='".$int1."',interest2='".$int2."',startDate='".$sdate."',endDate='".$edate."',budget='".$budget."',location='".$loc."' where username = '".$c_user."'";
    $result2 = mysqli_query($conn, $query2_2);
    $response = "YOUR INTERESTS ARE SAVED, WE WILL LET YOU IF ANY MATCHES ARE FOUND";
    }
}
 }
}
else{
    header("Location:homepage.html");
}
}
else{
    if(isset($_SESSION['username'])){
        $history = "";
        $c_user = $_SESSION['username'];
        $servername="127.0.0.1";
        $username="root";
        $password="Ganesh@7081";
        $database="findAfriend";
        $conn = mysqli_connect($servername, $username, $password, $database);
        $response = "";
        $query0_1 = "select * from matches where username = '".$c_user."'";
        $result0_1= mysqli_query($conn, $query0_1);
        if(mysqli_num_rows($result0_1) > 0){
           $found = false;
           $startloc = "";
           $endloc = "";
           $loc="";
           $interest1 = "";
           $interest2 = "";
           $flag = 0;
           $counter = 0;
           while($data = mysqli_fetch_assoc($result0_1)){
            $type = "travel partner";
            if($data['start_location'] !=null){
            $startloc = $data['start_location'];
            }
            else{
            $flag = 1;
            }
            if($data['destination_location'] !=null){
            $endloc = $data['destination_location'];
            }
            else{
            $flag = 1;
            }
            if($data['location'] !=null){
            $loc=$data['location'];
            }
            if($data['interest1'] !=null){
            $interest1=$data['interest1'];
            }
            if($data['interest2'] !=null){
            $interest2=$data['interest2'];
            }
            // if($counter == 0){
            $history = "<tr><td>S.NO</td><td>start location</td><td>destination</td><td>explore location</td><td>interests1</td><td>interests2</td></tr>";    
            // }
            $history = $history."<tr><td>".$counter."</td><td>".$type."</td><td>".$startloc."</td><td>".$endloc."</td><td>".$loc."</td><td>".$interest1."</td><td>".$interest2."</td></tr>";     
           }
           if($flag == 0){
           while($found != true){
            $response = "YOUR INTERESTS ARE SAVED, WE WILL LET YOU IF ANY MATCHES ARE FOUND";
            $query1 = "select username from matches where start_location='$startloc' and destination_location = '$endloc' and username != '".$c_user."'";
            $result1 = mysqli_query($conn, $query1);
            if(mysqli_num_rows($result1) > 0){
                $count = 0;
               while($user = mysqli_fetch_assoc($result1)){
                $query1_2 = "select lastname, mail, phonenumer from user_details where username = '".$user['username']."'";
                $result1_2 = mysqli_query($conn, $query1_2);
                $type = "travel partner";
                if($count == 0){
                    $response = "";
                    $response = $response."<tr><td>S.NO</td><td>PARTNER TYPE</td><td>NAME</td><td>MAIL</td><td>PHONE NUMBER</td></tr>";    
                    }
                while($r = mysqli_fetch_assoc($result1_2)){
                    $resulttable="resulttable";
                  $response = $response."<tr class=".$resulttable."><td>".$count."</td><td>".$type."</td><td>".$r['lastname']."</td><td>".$r['mail']."</td><td>".$r['phonenumer']."</td></tr>"; 
                } 
                $count = $count + 1;
               }
                  $found = true;
            }
           }
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
            .shape{
                border:2px solid rgba(255, 166, 0, 0.223);
                border-radius:3px;
                height:30px;
                width:200px;
                /* background-color:gray; */
             }  
             input:hover{
                border:1px solid black;
             }
            #budget{
                width:150px;
            }
            .title{
                border:1px solid rgba(255, 166, 0, 0.48);
                background-color:rgba(255, 166, 0, 0.48);
                /* text-align:center; */
                font-size:20px;
                height:30px;
                width:100%;
                padding:20px;
                padding-bottom:40px;
            }
            /* body{*/
                /* background-color:rgba(255, 166, 0, 0.223); */
            /*} */
            .container{
                /* position: absolute; */
                padding:10px;
                display: grid;
                grid-template-areas:   'a b b b'
                                       'a b b b'
                                       'a b b b'
                                       'a c c c'
                                       'a c c c'
                                       'd d d d'
                                       'd d d d';
                grid-gap: 10px;
                height: 100%;
                /* width:90%; */

                /* background-image:url("https://www.meetmindful.com/wp-content/uploads/2015/05/hiking-couple-nature-climbing.jpg");
                background-size: cover;
                position: relative;
                background-position: center; */
            }
            .box{
                border:1px solid rgba(255, 166, 0, 0.223);
                background-color:rgba(255, 166, 0, 0.113);
                padding:10px;
                /* height: 100%; */
            }
            .resulttable{
                border:1px solid rgba(255, 166, 0, 0.223);
                background-color:rgba(255, 166, 0, 0.113);
                padding:20px;
            }
            #a{
                background-color:rgba(255, 166, 0, 0.113);
                grid-area:a; 
                width:22vw;
            }
            #b{
                /* margin:10px; */
                border:none;
                grid-area:b;
                width: 75vw;
            }
            #c{
                /* margin:10px; */
                border:none;
                grid-area:c;
            }
            #d{
                grid-area:d;
            }
            table{
                height: 90%; 
                width:100%;
            }
            tr{
                font-size:20px;
                padding-top:40px;
            }
            .table1{
               color:black;
               font-weight:bold;
            }
            .table2{
                width:80%;
            }
            .footer{
                margin-top:30px;
                position: relative;
                border:1px solid rgba(255, 166, 0, 0.48);
                background-color: rgba(255, 166, 0, 0.48);
                color:aliceblue;
                height:30px;
            }
            .names{
                font-size: 30px;
                font-weight:bold;
                /* color:rgba(255, 166, 0); */
            }
            #clear{
                color:rgb(226, 137, 34);
                font-size:15px;
                font-weight: bold;
                border: none;
                background: none;
            }
            #apply{
                margin-left:65%;
                border:1px solid rgba(226, 136, 34, 0.767);
                border-radius:5px;
                background-color: rgb(226, 137, 34);
                height:30px;
                font-weight: bold;
                color: antiquewhite;
                width:100px;
            }
            #apply:hover{
                color: black;
                background-color: antiquewhite;
            }
            #login{
                float: right;
                border:1px solid rgba(226, 136, 34, 0.7);
                border-radius:5px;
                background-color: rgba(226, 136, 34, 0.5);
                height:40px;
                font-weight: bold;
                color: antiquewhite;
                width:100px;
                margin-right: 100px;
            }
            #login:hover{
                color: black;
                background-color: antiquewhite;
            }
            #title{
                font-size:30px;
                font-weight: bold;
            }
            #find{
                margin-left:40%;
                border:1px solid rgb(226, 137, 34);
                border-radius:3px;
                background-color: rgb(226, 137, 34);
                height:35px;
                font-size: 20px;
                /* font-weight: bold; */
                color: antiquewhite;
                width:100px;
            }
            #find:hover{
                color: black;
                background-color: antiquewhite;
            }
            #response,#histor{
                margin:10px;
                padding:10px;
                /* border:1px solid black; */
                border-collapse: collapse;
                width:80%; 
                height:10px;
            }
            .rowbottom{
                border:1px solid black;
            }
        </style>
    </head>
    <body>
        <div class="title">
           <span id="title"> FIND @ FRIEND </span>
           <button onclick="login()" id="login">PROFILE</button>
        </div>
        <div class="container">
            <div class="box" id="a">
                <table>
                    <tr  class="table1">
                        <td>FILTERS</td>
                        <td><button onclick="clear()" id="clear">CLEAR</button></td> 
                    </tr>
                    <form action="" method="POST">
                    <tr  class="table1">
                        <td>From Date</td>
                    </tr>
                    <tr>
                        <td><input type="date" name="fdate"  class="shape"></td>
                    </tr>
                    <tr class="table1">
                        <td>To Date</td>
                    </tr>
                    <tr>
                        <td><input type="date" name="tdate"  class="shape"></td>
                    </tr>
                    <tr class="table1">
                        <td>Gender</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" value="Male" name="mgender">male</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" value="Female" name="fgender">female</td>
                    </tr>
                    <tr class="table1">
                        <td>Budget</td>
                    </tr>
                    <tr>
                        <td><span>50$</span><input type="range" name="budget" min="1000" max="50000" id="budget"  class="shape"><span>500$</span></td>
                    </tr>
                </table>
                <!-- <button id="apply" onclick="filter()">APPLY</button> -->
            </div>
            <div class="box" id="b">
               <!-- <span class="names"><span> -->
                <table class="table2">
                    <tr>
                        <td>Travel Partner</td>
                        <td><input type="text" name="sdate" placeholder="FROM" class="shape"><sup>From</sup></td>
                        <td><input type="text" name="ddate" placeholder="DESTINATION" class="shape"><sup>To</sup></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Explore Partner</td>
                        <td><input type="text" name="loc" placeholder="Location" class="shape"></td>
                    </tr>
                    <tr>
                        <td>Interests</td>
                        <td><input type="text" name="interest1" placeholder="enter your interest" class="shape"></td>
                    </tr>
                    <tr>
                        <td>Interests</td>
                        <td><input type="text" name="interest2" placeholder="enter your interest" class="shape"></td>
                    </tr>
                </table>
                <button id="find" >FIND</button>
            </form>
            </div>
            <div class="box" id="c">
              <h1 class="names">Matching Profiles</h1>
              <table id="response">
                  
              </table>
            </div>
            <div class="box" id="d">
              <h1 class="names">Your Saved Preferences</h1>
              <table id="histor">
              <tr><td>S.NO</td><td>start location</td><td>destination</td><td>explore location</td><td>interests1</td><td>interests2</td></tr>

              </table>    
           </div> 
        </div>
    </body>
     <script>
          var history = document.getElementById("histor");
              history.innerHTML = <?= json_encode($response) ?>;
            var info = document.getElementById("response");
              info.innerHTML = <?= json_encode($response) ?>;
          
    </script> 
</html>