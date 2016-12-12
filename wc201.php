
<?php

$postnum = count($_REQUEST);
if($postnum > 0){
  if($_REQUEST['name'] == ""){
    echo '<meta http-equiv="refresh" content="0;URL=wc101.php';
  }else{
  }
}else{
}
?>
<title>Chat</title>
<form class="" action="logput.php">
  <?php echo '<label>'.$_REQUEST['name'].'</label>' ?>
  <input type="hidden" name="name" value="<?php echo $_REQUEST['name'] ?>">
  <input type="text" name="text" value="">
  <input type="submit" value="Write">
</form>

<hr>
<input type="button" value="Refresh" onclick=window.location.reload()>
<br>

<?php
 $fp = fopen("chatlog.log","r");
if($fp){}
else{
  exit();
}
$logarray;
 while(($line = fgets($fp)) !== false)
 {
   $log = explode(",",$line);
   $logarray[] = $log[0]."\t".$log[1]."<font color=gray size=1>(".$log[2].")</font>";
 }
 fclose($fp);

 $count = count($logarray);
 for($i=$count-1;$i>=0;$i--)
 {
   if($i<$count-15)break;
   echo $logarray[$i];
   echo "<br><hr><br>";
 }
?>

 <form action="logput.php">
   <input type="hidden" name="name" value="<?php echo $_REQUEST['name'] ?>">
   <input type="hidden" name="inout" value="out">
  <a href="wc301.php" target="_blank">History</a>
  <input type="submit" name="" value="Logout">
</form>
