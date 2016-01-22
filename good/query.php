<?php
   ini_set('display_errors', 'On');
   date_default_timezone_set('Asia/Tokyo');
?>
<html>
<head><title>A sample application which uses image files</title>
  <meta http-equiv="Content-Type" content="text/htmll charset=utf8"/>
  <link rel="stylesheet" href="../default.css" type="text/css" />
</head>
<body>
<div id="main">
<h1>データベース設計論<br/>DBアプリケーションサンプル<br/>（画像ファイルの使用)</h1>
<div id="description">
画像ファイルを使うサンプルです。
</div>

<?php

if(! $db = new PDO("sqlite:yurucharas.db")){
  die("DB Connection Failed.");
}

$sql = "SELECT area FROM Characters";
$stmt = $db->prepare($sql);
$stmt -> execute();
?>

<?php
 $good=$_GET['good'];
 if($good){
    $sql = "update Characters set good = good+1 where id = $good";
    $stmt = $db -> prepare($sql);
    $stmt -> execute();
 }

   $sql = "SELECT id,name,area,photo,good FROM Characters";
   $stmt = $db -> prepare($sql);
   $stmt -> execute();

   print "<table border=1>\n";
   print "<tr>";
   print "<th>ID</th>";
   print "<th>名前</th>";
   print "<th>件名</th>";
   print "<th>画像</th>";
   print "<tr>";
   while($cols = $stmt->fetch(PDO::FETCH_NUM)){
     print "<tr>\n";
     print "<td>$cols[0]</a></td><td>$cols[1]<br><a href='query.php?good=$cols[0]'>イイね！</a> ($cols[4]) </td><td>$cols[2]</td><td width='200px'><img src='img/$cols[3]' width='200px'></td>\n";
     print "</tr>\n";
   }
   print "</table>\n";

?>

</div>
</body>
</html>
