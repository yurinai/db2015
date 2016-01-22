<html>
<head><title>Listing All Data</title>
  <link rel="stylesheet" href="../default.css" type="text/css" />
  <meta http-equiv="Content-Type" content="text/htmll charset=utf8"/>
</head>
<body>
<div id="main">
<h1>データベース設計論<br/>DBアプリケーションサンプル<br/>（リンクによる検索)</h1>
<div id="description">
簡単な検索アプリケーションです。フォームを使わずにリンク先をたどるとURLに書かれたパラメタで検索を行います。
</div>

<?php

if(! $db = new PDO("sqlite:university_utf8.db")){
  die("DB Connection Failed.");
}

$sql = "SELECT csid,name FROM courses";
$stmt = $db->prepare($sql);
$stmt -> execute();
print "<table>\n";
while($cols = $stmt->fetch(PDO::FETCH_NUM)){
  print "<tr><td><a href=querybylink2.php?course=$cols[0]>$cols[1]</a></td></tr>\n";
}
print "</table>";
?>

</div>
</body>
</html>
