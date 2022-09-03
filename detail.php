<?php
//１．PHP
//select.phpの[PHPコードだけ！]をマルっとコピーしてきます。
//※SQLとデータ取得の箇所を修正します。
$id = $_GET["id"];

include("funcs.php");

//1.  DB接続します
$pdo = db_conn();

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_plan_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}else{
    $row = $stmt->fetch(); // 1つのデータを取り出して $rowに格納
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <link rel="stylesheet" href="css/style.css">
  <style>div{font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php"></a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="plan_update_act.php">
  <div class="jumbotron">
   <fieldset>
    <legend style="font-size: 25px"><?=$row["plan"]?></legend>
     <p><img src="images/<?=$row["image"]?>"></p>
     <p>所要時間：<?=$row["duration"]?></p>
     <p>場所：<?=$row["place"]?></p>
     <p>概要：<?=$row["summary"]?></p>
     <p>タグ：<?=$row["tags"]?></p>
     <p>URL：<a href="<?=$row["URL"]?>"><?=$row["URL"]?></a></p>
    <!-- idを隠して送信 -->
    <input type="hidden" name="id" value="<?=$row["id"]?>">
    <!-- idを隠して送信 -->
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>




