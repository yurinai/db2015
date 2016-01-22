<?php
   ini_set('display_errors', 'Off');
   date_default_timezone_set('Asia/Tokyo');
?>
<html>
<head><title>A sample application which uses image files</title>
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

<form action="query.php" method="post">
  <select name="area">県名を選んでね： 

<?php
while($cols = $stmt->fetch(PDO::FETCH_NUM)){
  print "<option value=$cols[0]>$cols[0]";
}
?>

 </select>
<input type="submit" value="選択">
</form>

<?php
 $area=$_POST['area'];
 if($area){
   print "選択された県：$area";

   $sql = "SELECT id,name,area,photo FROM Characters WHERE area = '$area'";
EOM;

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
     print "<td>$cols[0]</td><td>$cols[1]</td><td>$cols[2]</td><td width='200px'><img src='img/$cols[3]' width='200px'></td>\n";
     print "</tr>\n";
   }
   print "</table>\n";
 }
 else{
   print "県名を選択してください。\n";
 }
?>

</div>
</body>
</html>
