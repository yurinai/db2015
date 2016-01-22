<?php
   ini_set('display_errors', 'Off');
   date_default_timezone_set('Asia/Tokyo');
?>
<?php
    if(!$db = new PDO("sqlite:users.db")){
       header("HTTP/1.1 301 Moved Permanently");
       header("Location: regist.php?err=0");//DB‚Ì–â‘è      
       exit;
   }

   if(!$_POST['login'] ||!$_POST['name'] || !$_POST['password'] || !$_POST['password2']){
       header("HTTP/1.1 301 Moved Permanently");
       header("Location: regist.php?err=1");//“ü—Í‘«‚è‚È‚¢      
       exit;
   } 
   elseif($_POST['password']!=$_POST['password2']){
       header("HTTP/1.1 301 Moved Permanently");
       header("Location: regist.php?err=2");//ƒpƒXƒ[ƒh•sˆê’v
       exit;      
   }
   else{
     $login = $_POST['login'];
     $name = mb_convert_encoding($_POST['name'], "UTF-8", "auto");
     $password = sha1($_POST['password']);

     $sql = "SELECT count(*) FROM users WHERE id = '$login';"; //Šù‚É“o˜^‚³‚ê‚Ä‚¢‚é‚©Šm”F‚·‚é
     print $sql;
     $stmt = $db -> prepare($sql);
     $flag = $stmt -> execute();
     if(!$flag){
       header("HTTP/1.1 301 Moved Permanently");
       header("Location: regist.php?err=3");//–â‡‚¹Ž¸”s
       exit;      
     }
     $cols = $stmt->fetch(PDO::FETCH_NUM);
     if($cols[0]>0){ //Šù‚É“o˜^‚³‚ê‚Ä‚¢‚é‚Ì‚Åã‘‚«‚·‚é
       $sql = "UPDATE users SET name = '$name', password='$password' where id='$login';";
     }//ƒ†[ƒUî•ñ‚ð“o˜^
     else{
       $sql = "INSERT INTO users VALUES('$login','$name','$password');"; 
     }
     $stmt = $db -> prepare($sql);
     $flag = $stmt -> execute();
     if(!$flag){
       header("HTTP/1.1 301 Moved Permanently");
       header("Location: regist.php?err=3");//–â‡‚¹Ž¸”s
       exit;      
     }
     else{
       //ƒƒOƒCƒ“‚µ‚¿‚á‚¤
       session_start();
       $_SESSION['S_USERID']=$login;
       header("HTTP/1.1 301 Moved Permanently");
       header("Location: home.php");
       exit;            
     }
   }
?>