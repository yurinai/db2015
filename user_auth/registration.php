<?php
   ini_set('display_errors', 'Off');
   date_default_timezone_set('Asia/Tokyo');
?>
<?php
    if(!$db = new PDO("sqlite:users.db")){
       header("HTTP/1.1 301 Moved Permanently");
       header("Location: regist.php?err=0");//DBの問題      
       exit;
   }

   if(!$_POST['login'] ||!$_POST['name'] || !$_POST['password'] || !$_POST['password2']){
       header("HTTP/1.1 301 Moved Permanently");
       header("Location: regist.php?err=1");//入力足りない      
       exit;
   } 
   elseif($_POST['password']!=$_POST['password2']){
       header("HTTP/1.1 301 Moved Permanently");
       header("Location: regist.php?err=2");//パスワード不一致
       exit;      
   }
   else{
     $login = $_POST['login'];
     $name = mb_convert_encoding($_POST['name'], "UTF-8", "auto");
     $password = sha1($_POST['password']);

     $sql = "SELECT count(*) FROM users WHERE id = '$login';"; //既に登録されているか確認する
     print $sql;
     $stmt = $db -> prepare($sql);
     $flag = $stmt -> execute();
     if(!$flag){
       header("HTTP/1.1 301 Moved Permanently");
       header("Location: regist.php?err=3");//問合せ失敗
       exit;      
     }
     $cols = $stmt->fetch(PDO::FETCH_NUM);
     if($cols[0]>0){ //既に登録されているので上書きする
       $sql = "UPDATE users SET name = '$name', password='$password' where id='$login';";
     }//ユーザ情報を登録
     else{
       $sql = "INSERT INTO users VALUES('$login','$name','$password');"; 
     }
     $stmt = $db -> prepare($sql);
     $flag = $stmt -> execute();
     if(!$flag){
       header("HTTP/1.1 301 Moved Permanently");
       header("Location: regist.php?err=3");//問合せ失敗
       exit;      
     }
     else{
       //ログインしちゃう
       session_start();
       $_SESSION['S_USERID']=$login;
       header("HTTP/1.1 301 Moved Permanently");
       header("Location: home.php");
       exit;            
     }
   }
?>