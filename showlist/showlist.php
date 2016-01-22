<html>
<head><title>Listing All Data</title>
  <link rel="stylesheet" href="../default.css" type="text/css" />
  <meta http-equiv="Content-Type" content="text/htmll charset=utf8"/>
</head>
<body>
<div id="main">
<h1>データベース設計論<br/>DBアプリケーションサンプル<br/>（一覧表示)</h1>
<div id="description">
単にテーブルの中身を全部表示するサンプルです。
</div>
<?php

if(! $db = new PDO("sqlite:test.db")){
  die("DB Connection Failed.");
}

$sql = "SELECT id,name FROM test";
$stmt = $db->prepare($sql);
$stmt -> execute();

print "<table border=1>\n";
while($cols = $stmt->fetch(PDO::FETCH_NUM)){
  print "<tr>";
  foreach($cols as $ele){
    print "<td>$ele</td>";
  }
  print "</tr>\n";
}
print "</table>\n";

?>
</div>
</body>
</html>
