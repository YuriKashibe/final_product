<?php
//$_SESSION使うよ！
session_start();

//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";
include "funcs.php";
sschk();

//1.POSTデータ取得
$name            = filter_input( INPUT_POST, "name" );
$lid             = filter_input( INPUT_POST, "lid" );
$lpw             = filter_input( INPUT_POST, "lpw" );
$arr_preferences = $_POST['preferences'];

$str_preferences = "";

for($i=0;$i<count($arr_preferences);$i++){
    if($i == 0){
    $str_preferences .= $arr_preferences[$i];
    }
    else{
    $str_preferences .= " " . $arr_preferences[$i];
    }
}

$kanri_flg       = filter_input( INPUT_POST, "kanri_flg" );
$life_flg        = filter_input( INPUT_POST, "life_flg" );
$id              = filter_input( INPUT_POST, "id" );

//2.DB接続します
$pdo = db_conn();

//3.データ登録SQL作成
if($lpw==""){
    if($kanri_flg==""){
        $sql = "UPDATE gs_user_table SET name=:name, lid=:lid, preferences=:str_preferences, life_flg=:life_flg WHERE id=:id";
    }else{
        $sql = "UPDATE gs_user_table SET name=:name, lid=:lid, preferences=:str_preferences, kanri_flg=:kanri_flg, life_flg=:life_flg WHERE id=:id";
    }
}else{
    if($kanri_flg==""){
        $sql = "UPDATE gs_user_table SET name=:name, lid=:lid, lpw=:lpw, preferences=:str_preferences, life_flg=:life_flg WHERE id=:id";
    }else{
        $sql = "UPDATE gs_user_table SET name=:name, lid=:lid, lpw=:lpw, preferences=:str_preferences, kanri_flg=:kanri_flg, life_flg=:life_flg WHERE id=:id";
    }
}
//4.SQL
$stmt = $pdo->prepare($sql);
//5.Bind変数へ代入
if($lpw!=""){
    $stmt->bindValue(':lpw', password_hash($lpw, PASSWORD_DEFAULT), PDO::PARAM_STR);
}
if($kanri_flg!=""){
    $stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);
}
$stmt->bindValue(':name', $name, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':str_preferences', $str_preferences, PDO::PARAM_STR);
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//6.データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    $stmt = $pdo->prepare("select * from gs_user_table where id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
    $status = $stmt->execute();

    //SQL実行時にエラーがある場合STOP
    if($status==false){
        sql_error($stmt);
    }

    //抽出データ数を取得
    $val = $stmt->fetch();
    $_SESSION["name"]        = $val['name'];
    $_SESSION["prefecture"]  = $val['prefecture'];
    $_SESSION["city"]        = $val['city'];
    $_SESSION["preferences"] = $val['preferences'];
    $_SESSION["kanri_flg"]   = $val['kanri_flg'];
    redirect("profile_detail.php");
    exit;
}
