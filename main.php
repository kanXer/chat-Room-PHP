<?php
$roomname = $_GET['roomname'];

include 'db_connect.php';

$sql ="SELECT * FROM `rooms` WHERE roomname = '$roomname'";
$result= mysqli_query($conn,$sql);
if($result)
{
    if (mysqli_num_rows($result) == 0)
    {
        $message = "Room Doesn't Exist Try to Create new one";
        echo '<script language = "javascript">';
        echo 'alert("'.$message.'");';
        echo 'window.location="http://localhost/chatroom";';
        echo '</script>'; 
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
.anyclass {
    height: 350px;
    overflow-y: scroll;
}
</style>
</head>
<body>

    <h2>Chat Messages</h2>

    <div class="container">
        <div class="anyclass">
            <img src="/w3images/bandmember.jpg" alt="Avatar" style="width:100%;">
            <p>Hello. How are you today?</p>
            <span class="time-right">11:00</span>
        </div>
    </div>
    <input type="text" name="messageinp" id="messageinp">
    <button class="btn" type="submit" name="submit" id="submitmsg">Send</button>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">

    setInterval(runFunction, 1000);
    function runFunction()
    {
        $.post("htcont.php", {room:'<?php echo $roomname ?>'},
        function(data,status)
        {
            document.getElementsByClassName("anyclass")[0].innerHTML = data;
        })
    }
    // Get the input field
var input = document.getElementById("messageinp");

// Execute a function when the user presses a key on the keyboard
input.addEventListener("keyup", function(event) {
  // If the user presses the "Enter" key on the keyboard
  event.preventDefault();
  if (event.keyCode === 13) {
    // Cancel the default action, if needed
    // Trigger the button element with a click
    document.getElementById("submitmsg").click();
  }
});
    $("#submitmsg").click(function(){
        var clientmsg = $("#messageinp").val();
        $.post("postmsg.php", {text: clientmsg, room : '<?php echo $roomname?>', ip : '<?php echo $_SERVER['REMOTE_ADDR']?>'},
        function(data,status){
            document.getElementsByClassName('container')[0],innerHTML =data;})
            $("#messageinp").val("");
        return false;
    }); 
</script>
</body>
</html>