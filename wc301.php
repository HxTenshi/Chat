
<title>Chat - History</title>
<h1>Chat History</h1>
<input type="button" value="Refresh" onclick=window.location.reload()><br>

<?php
 $fp = fopen("chatlog.log","r");
if($fp){}
else{
  exit();
}
$logarray;// = ["a","i","w"];
 while(($line = fgets($fp)) !== false)
 {
   $log = explode(",",$line);
   $logarray[] = $log[0]."\t".$log[1]."<font color=gray size=1>(".$log[2].")</font>";
 }
 fclose($fp);

 $count = count($logarray);
 for($i=0;$i<$count;$i++)
 {
   echo $logarray[$i];
   echo "<br><hr><br>";
 }
?>

<input type="button" value="Refresh" onclick=window.location.reload()>
<input type="button" value="Close" onclick=window.close()>
