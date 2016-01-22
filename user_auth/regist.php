<?php
   ini_set('display_errors', 'Off');
   date_default_timezone_set('Asia/Tokyo');
?>
<html>
<head>
 <meta http-equiv="Content-Type" 
            content="text/html; charset=utf8">

  <title>DB App Samples : User Authentication </title>
  <link rel="stylesheet" href="default.css" type="text/css" />
</head>
<body>
<div id="main">
<h1>アカウント登録</h1>

<form action="registration.php" method="post">
<div id=warning>
<?php
   if($_GET['err']){
      $errno=$_GET['err'];
      $err_message= array("DBに接続できませんでした","入力していない項目があります","パスワードが不一致です","登録に失敗しました");
      print $err_message[$errno]; 
   }

   if($_GET['id']){
     $id = $_GET['id'];
     if(! $db = new PDO("sqlite:users.db")){
       print "DB接続に失敗しました<br>";
     }
     else{
       $sql = "select name from users where id='$id'";
       $stmt = $db -> prepare($sql);
       $flag = $stmt -> execute();
       if(!$flag){
          print "<div id=warning>問合せ失敗…</div>";
       }
       else{
         $cols = $stmt->fetch(PDO::FETCH_NUM);
         $name = $cols[0];
       }
    }

   }

?>
</div>
<div align="center">
<table style="width:500px;">
<tr><td align="right">アカウント：</td><td>
<?php
 print "<input type='text' name='login' size='40' value='$id'>";
?>
</td></tr>
<tr><td align="right">氏名：</td><td>
<?php
 print "<input type='text' name='name' size='40' value='$name'>";
?>
</td></tr>
<tr><td align="right">パスワード：</td><td><input type="password" name ="password" size="20"><br>
<input type="password" name ="password2" size="20">（確認のため同じものを入力）</td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="登録"></td></tr>
</table>
入力情報を間違えないように注意してくださいね<br>
<a href="home.php">[戻る]</a>
</div>
</form>
</div>
</body>
</html>