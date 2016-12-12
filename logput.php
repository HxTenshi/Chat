
<?php

$postnum = count($_REQUEST);
if($postnum > 0){
  $inout = "";
  if (array_key_exists('inout', $_REQUEST)){
    $inout = $_REQUEST['inout'];
  }
  $name = $_REQUEST['name'];
  $text = "";
  if (array_key_exists('text', $_REQUEST)){
    $text = $_REQUEST['text'];
  }
$log = "";
  if($inout == "in"){
    $text = $name." Login.";
    $log = "SysOP,".$text.",".date('Y-M-D h:i:s');
  }else if($inout == "out"){
      $text = $name." Logout.";
      $log = "SysOP,".$text.",".date('Y-M-D h:i:s');
  }else{
    $log = $name.",".$text.",".date('Y-M-D h:i:s');
  }

  if($name == ""){
    $name="SysOP";
  }else{
  }
  error_log($log."\n", 3, "chatlog.log");

  if($inout == "out")
  {
    echo '<meta http-equiv="refresh" content="0;URL=wc101.php">';
  }else{
    echo '<meta http-equiv="refresh" content="0;URL=wc201.php?name='.$name.'">';
  }
}else{
  echo '<meta http-equiv="refresh" content="0;URL=wc101.php">';
}
