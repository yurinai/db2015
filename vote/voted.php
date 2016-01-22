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

<?php
  
$vote = $_POST['vote'];
if(isset($_POST['name'])){
  $name = $_POST['name'];
}
else{
  $name = "anonymous";
}

$time = time();

if(! $db = new PDO("sqlite:vote.db")){
  die("DB Connection Failed.");
}

$sql = "INSERT INTO votes(vote,name,time) values('$vote','$name','$time');";
$stmt = $db->prepare($sql);
$stmt -> execute();

 
?>
投票ありがとうございました。
<a href="result.php">集計結果ページ</a>
</div>
</body>
</html>
