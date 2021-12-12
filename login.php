<?php




session_start();
include("classes/connect.php");
include("classes/login.php");

// $DB = new Database();
// $sql = "select * from users ";
// $result= $DB->read($sql);
// foreach ($result as $row) {
//     # code...
//     $id=$row['id'];
//     $password =hash('sha1', $row['password']);
//     $sql ="update users set password = '$password' where id='$id' limit 1";
//     $DB->save($sql);



// }




// die;





    $email = "";
    $password = "";
   
    

if ($_SERVER['REQUEST_METHOD'] == 'POST' )
 {

    $login = new Login();
    $result = $login->evaluate($_POST);
    if ($result != "") {
        

        echo "<div style='text-align:center;font-size:12px;background-color:#eee;'>";
        echo "<br> the following errors occured <br><br>";
        echo $result;
        echo "</div>";

    }else 
     {
        header("Location: profile.php");
        die;
    }



    $email = $_POST['email'];
    $password = $_POST['password'];
    
    

    
    

} 


?>
<html>

<head>

    <title>Mybookk | Log in</title>
</head>

<style>
#bar {
    height: 100px;
    background-color: rgb(59, 89, 152);
    color: #d9dfeb;
    padding: 4px;
}

#signup_button {

    background-color: #42b72a;
    width: 70px;
    text-align: center;
    padding: 4px;
    border-radius: 4px;
    float: right;
}

#bar2 {

    background-color: white;
    width: 800px;
    margin: auto;
    margin-top: 50px;
    padding: 10px;
    padding-top: 50px;
    text-align: center;
    font-weight: bold;

}

#text {

    height: 40px;
    width: 300px;
    border-radius: 4px;
    border: solid 1px #ccc;
    padding: 4px;
    font-size: 14px;
}

#button {

    width: 300px;
    height: 40px;
    border-radius: 4px;
    font-weight: bold;
    border: none;
    background-color: rgb(59, 89, 152);
    color: white;
}
</style>

<body style="font-family: tahoma;background-color: #e9ebee;">

    <div id="bar">

        <div style="font-size: 40px;">Halmouch</div>

        <a href="Signup.php" style="color:#d9dfeb; "><div id="signup_button">Signup</div></a>

    </div>

    <div id="bar2">

        <form method="post">
            Log in to Mybook<br><br>

            <input value="<?php echo $email ?>" name="email" type="text" id="text" placeholder="Email"><br><br>
            <input value="<?php echo $password ?>" name="password" type="password" id="text" placeholder="Password"><br><br>

            <input type="submit" id="button" value="Log in">
            <br><br><br>

        </form>
    </div>

</body>


</html>