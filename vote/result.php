<?php
   ini_set('display_errors', 'Off');
   date_default_timezone_set('Asia/Tokyo');
?>

<html>
<head><title>Listing All Data</title>
  <link rel="stylesheet" href="../default.css" type="text/css" />
  <meta http-equiv="Content-Type" content="text/htmll charset=utf8"/>
</head>
<body>
<div id="main">
<h1>データベース設計論<br/>DBアプリケーションサンプル<br/>（リンクによる検索)</h1>
<div id="description">
投票結果です。<br>
<a href='vote_form.php'>投票ページに戻る</a>
</div>

<?php

if(! $db = new PDO("sqlite:vote.db")){
  die("DB Connection Failed.");
}

$sql = "SELECT c.name, count(vote) FROM candidates c LEFT OUTER JOIN votes v ON c.id = v.vote GROUP BY c.id";
$stmt = $db->prepare($sql);
$stmt -> execute();
print "<table border=1>\n";
while($cols = $stmt->fetch(PDO::FETCH_NUM)){
  print "<tr><td width='100'>$cols[0]</a></td><td>";
  for($i=0;$i<$cols[1];$i++){
    print "<font color='FF0000'>*</color>";
  }
  print "<font size='-2'>($cols[1]票)</font></td></tr>";
}
print "</table>";
?>

</div>
</body>
</html>
