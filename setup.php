<?php
require('./function.php');

$mysql = new ChatSQL();
$mysql->CreateTable();


echo <<< EOT
<html>
  <head>
  </head>
  <body>
  テーブルの作成に成功
  </body>
</html>
EOT;
 ?>
