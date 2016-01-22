<html>
<head><title>Listing All Data</title>
  <link rel="stylesheet" href="../default.css" type="text/css" />
  <meta http-equiv="Content-Type" content="text/htmll charset=utf8"/>
</head>
<body>
<div id="main">
<h1>データベース設計論<br/>DBアプリケーションサンプル<br/>（検索)</h1>
<div id="description">
簡単な投票アプリケーションです。
</div>
<h2>投票フォーム</h2>
<?php

if(! $db = new PDO("sqlite:vote.db")){
  die("DB Connection Failed.");
}

$sql = "SELECT id,name FROM candidates";
$stmt = $db->prepare($sql);
$stmt -> execute();
?>

<form action="voted.php" method="post">
誰か一人を選択して投票してください。
<table>
<?php
while($cols = $stmt->fetch(PDO::FETCH_NUM)){
  print "<tr><td><input type='radio' name='vote' value='$cols[0]'>$cols[1]</td></tr>";
}
?>
</table>
お名前（任意）：<input type="text" name="name">
<input type="submit" value="選択">
</form>
</div>
</body>
</html>
