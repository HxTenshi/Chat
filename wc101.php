<?php
require('./function.php');
require('./header.php');


$postnum = count($_REQUEST);
if($postnum > 0){
  $mysql = new ChatSQL();
  $user = new User();
  $log = $user->Login($_REQUEST['name'],$_REQUEST['pass']);
  if($log !== ""){
echo <<< EOT
      <font color=red>
        <title>Chat - Error101</title>
        <h3>Error</h3><br>
        <label>{$log}</label><br>
      </font>
EOT;

  }else{

echo <<< EOT
    <script language="JavaScript">
      function hogehoge(){
        document.autojump.submit();
      }
    </script>
    <form name="autojump" action="wc201.php" method="POST">
      <input type="hidden" name="loginid" value={$user->loginid}>
      <input type="hidden" name="password" value={$user->password}>
      <input type="submit" value="">
    </form>
    //<body onload="setTimeout( 'hogehoge()', 0 )">
EOT;
  }
}else{
  echo '<title>Chat - Login</title>';
}

echo <<< EOT
<h1>Chat</h1><br>
<form class="" action="wc101.php" method="POST">
  LoginID
  <input type="text" name="name" value=""><br>
  Password
  <input type="text" name="pass" value=""><br>
  <input type="submit" value="Login">
</form>
EOT;


require('./end.php');
?>
