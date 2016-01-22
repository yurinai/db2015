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

 $csid=$_GET['course'];
 if($csid){
   $sql = "SELECT name FROM courses WHERE csid = '$csid'";
   $stmt = $db -> prepare($sql);
   $stmt -> execute();
   $col = $stmt->fetch(PDO::FETCH_NUM);
   print "選択された授業名：$col[0]";

   $sql=<<<EOM
     SELECT s.stid, s.major, s.name, e.grade 
     FROM enrollments e, students s
     WHERE s.stid = e.stid
       and e.csid = '$csid'
     ORDER BY s.major, s.stid;
EOM;

   $stmt = $db -> prepare($sql);
   $stmt -> execute();

   print "<table border=1>\n";
   print "<tr>";
   print "<th>学籍番号</th>";
   print "<th>学科</th>";
   print "<th>氏名</th>";
   print "<th>成績</th>";
   print "<tr>";
   while($cols = $stmt->fetch(PDO::FETCH_NUM)){
     print "<tr>\n";
     print "<td>$cols[0]</td><td>$cols[1]</td><td>$cols[2]</td><td>$cols[3]</td>\n";
     print "</tr>\n";
   }
   print "</table>\n";
 }
 else{
   print "授業名を選択してください。\n";
 }
?>

</div>
</body>
</html>
