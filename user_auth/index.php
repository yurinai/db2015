<?php
   ini_set('display_errors', 'Off');
   date_default_timezone_set('Asia/Tokyo');
   session_start();
   if (isset($_SESSION["S_USERID"])){    //既にログインしている
     header("HTTP/1.1 301 Moved Permanently");
     header("Location: home.php");
     exit;
   }
   elseif(isset($_POST['login']) && isset($_POST['password'])){//ログイン情報が入力された
     if(! $db = new PDO("sqlite:users.db")){ //
        print "<div id=warning>DB connection is failed.</div>";
        goto end;
     }

     $login = $_POST['login'];
     $password = sha1($_POST['password']);

     $sql = "SELECT password FROM users WHERE id = '$login';"; //パスワード情報を取得
     $stmt = $db -> prepare($sql);
     $flag = $stmt -> execute();
     $cols = $stmt->fetch(PDO::FETCH_NUM);

     if($cols[0]==$password){//認証成功
       $_SESSION = array();
       $_SESSION["S_USERID"]=$login;
       header("HTTP/1.1 301 Moved Permanently");
       header("Location: home.php");
       exit;
     }
     else{
       header("HTTP/1.1 301 Moved Permanently");
       header("Location: index.php?failed=true");//ログインし直し      
       exit;
     }
   }
?>
<html>
<head>
 <meta http-equiv="Content-Type" 
            content="text/html; charset=utf8">

  <title>DB Appli Sample : User Authentication </title>
  <link rel="stylesheet" href="default.css" type="text/css" />
</head>
<body>
<div id="main">
<h1>ユーザ認証プログラムのサンプル</h1>
<div id="description">
ユーザ認証プログラムのサンプルです。
アカウント名：chiemi パスワード：test でログインできます。<br>
アカウントを新規に作成することもできます。お試しあれ。
</div>

<form action="index.php" method="post">
<div align="center">
アカウント：<input type="text" name="login" size="40"><br>
パスワード：<input type="password" name ="password" size="40"><br>
<input type="submit" value="LOGIN">
</div>
</form>

まだアカウントを作っていない人は<a href="regist.php">【アカウント登録】</a>


<?php

   if(isset($_GET['failed'])){ //ログインに失敗している
      print "<div id=warning>Login failed.</div>";
      goto end;
   }

end:
?>
</div>
</body>
</html>