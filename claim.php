<?php
$room =$_POST['room'];

if(strlen($room)>20 or strlen($room)>20)
{
    $message = "Please choose a name between 2 to 20 charectrs";
    echo '<script language = "javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/chatroom";';
    echo '</script>';

}
else if(!ctype_alnum(($room)))
{
    $message = "Please choose a alphanumeric roomname";
    echo '<script language = "javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/chatroom";';
    echo '</script>';    
}
else 
{
    include 'db_connect.php';
}

$sql ="SELECT * FROM `rooms` WHERE roomname = '$room'";
$result= mysqli_query($conn,$sql);
if($result)
{
    if (mysqli_num_rows($result)>0)
    {
        $message = "Room Already Exist";
        echo '<script language = "javascript">';
        echo 'alert("'.$message.'");';
        echo 'window.location="http://localhost/chatroom";';
        echo '</script>'; 
    }
    else
    {
        $sql = "INSERT INTO `rooms` (`roomname`, `stime`) VALUES( '$room', CURRENT_TIMESTAMP)";
        if (mysqli_query($conn,$sql))
        {
            $message = "Your Room is Ready You can Chat Now";
            echo '<script language = "javascript">';
            echo 'alert("'.$message.'");';
            echo 'window.location="http://localhost/chatroom/main.php?roomname='.$room.'";';
            echo '</script>';  
        }

    }
}
else
{
    echo "Error :" . mysqli_error($conn);
}
?>