
<?php

$postnum = count($_REQUEST);
if($postnum > 0){
  if($_REQUEST['name'] == ""){
    echo '<font color=red>';
    echo '<title>Chat - Error101</title>';
    echo '<h3 color="red">Error</h3><br>';
    echo '<label color="red">"Your Name" is required, Please input your name.</title><br>';
    echo '</font>';
  }else{
         $url = "logput.php?name=".$_REQUEST['name']."&inout=in";
         echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
  }
}else{
  echo '<title>Chat - Login</title>';
}
?>

<h1>Chat</h1><br>
<form class="" action="wc101.php">
Your Name
 <input type="text" name="name" value=""><br>
 <input type="submit" value="Login">
</form>
