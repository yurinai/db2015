<?php
   ini_set('display_errors', 'Off');
   date_default_timezone_set('Asia/Tokyo');
?>

<html>
<head>
 <meta http-equiv="Content-Type" 
            content="text/html; charset=utf8">

  <title>DB Design : Group Works</title>
  <link rel="stylesheet" href="default.css" type="text/css" />
</head>
<body>
<div id="main">
<h1>ユーザ認証プログラムのサンプル</h1>
<div id="description">
ユーザ認証プログラムのサンプルです。
</div>

<?php
   session_start();
   if($_SESSION["S_USERID"]){     
     $login= $_SESSION["S_USERID"];
   }
   else{
       header("HTTP/1.1 301 Moved Permanently");
       header("Location: index.php");
       exit;            
   }

    if(! $db = new PDO("sqlite:users.db")){
      print "DB接続に失敗しました<br>";
    }
    else{
      $sql = "select name from users where id='$login'";
      $stmt = $db -> prepare($sql);
      $flag = $stmt -> execute();
      if(!$flag){
         print "<div id=warning>問合せ失敗…</div>";
      }
      $cols = $stmt->fetch(PDO::FETCH_NUM);
      print "ログイン中：$cols[0]さん <a href=logout.php>[LOGOUT]</a><br>";
    }
?>
</div>
</body>
</html>


