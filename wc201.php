<?php

require('./function.php');
require('./header.php');

$postnum = count($_REQUEST);
if($postnum === 0){
  echo '<meta http-equiv="refresh" content="0;URL=wc101.php>';
}
$user = new User();
$log = $user->Login($_REQUEST['loginid'],$_REQUEST['password']);

if($log !== ""){
  echo '<meta http-equiv="refresh" content="0;URL=wc101.php>';
}

echo('チャットにログイン');

require('./end.php');
?>
