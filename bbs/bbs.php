<html>
<head>
  <title>BBS by using SQLite</title>
  <link rel="stylesheet" href="bbs.css" type="text/css" />
  <meta http-equiv="Content-Type" content="text/htmll charset=utf8"/>
</head>
<body>
<div id="main">
<h1>データベース設計論<br/>DBアプリケーションサンプル<br/>（掲示板)</h1>
<div id="description">
このサンプルプログラムでは，フォームからの投稿ができるようになっています。
投稿されたメッセージがあればINSERT文で挿入し，メッセージ一覧を投稿時間の
新しいもの順に並べて表示しています。
</div>
<form action="bbs.php" method="post">
<div align="center">
<textarea name="message" rows="4" cols="80"></textarea>
<input type="submit" value="投稿">
</div>
</form>


<?php

 date_default_timezone_set('asia/tokyo');

if(! $db = new PDO("sqlite:bbs.db")){
  die("DB Connection Failed.");
}

$message = $_POST['message'];

if($message){
  $now = time();
  $sql = "INSERT INTO bbs(time,message) values($now,'$message')";
  $stmt = $db -> prepare($sql);
  $flag = $stmt -> execute();
  if(!$flag){
    die("Data Insertion Failed.");
  }
}

$sql = "SELECT id,time,message FROM bbs ORDER BY time DESC";
$stmt = $db->prepare($sql);
$stmt -> execute();

print "<table class=bss border=1>\n";
while($cols = $stmt->fetch(PDO::FETCH_NUM)){
  $date = date("y/m/d H:i",$cols[1]);
  print "<tr><td class=msg><div id=message>$cols[2]</div>";
  print "        <div id=date>$date</div></td></tr>";
  print "</tr>\n";
}
print "</table>\n";

?>
</body>
</html>
