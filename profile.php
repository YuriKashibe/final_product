<?php
session_start();

//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";
include "funcs.php";
sschk();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styling2.css">
    <title>Profile</title>
</head>

<body>
    <div class="profile_container">
        <img class="logo" src="images/logo2.png" alt="ロゴ">
        <h2>Profile Details</h2>
        <p class="profile_message">
            <?php echo h($_SESSION["name"]); ?>さん<br>
            あなたのことをもう少し教えてください！
        </p>
        <form class="profile_form" action="profile_act.php" method="post">
            <dl>
                <dt>都道府県:</dt>
                <dd>
                    <select name="prefecture">
                        <option value="Hokkaido">北海道</option>
                        <option value="Aomori">青森県</option>
                        <option value="Akita">秋田県</option>
                        <option value="Iwate">岩手県</option>
                        <option value="Yamagata">山形県</option>
                        <option value="Miyagi">宮城県</option>
                        <option value="Fukushima">福島県</option>
                        <option value="Ibaraki">茨城県</option>
                        <option value="Tochigi">栃木県</option>
                        <option value="Gunma">群馬県</option>
                        <option value="Saitama">埼玉県</option>
                        <option value="Kanagawa">神奈川県</option>
                        <option value="Chiba">千葉県</option>
                        <option value="Tokyo">東京都</option>
                        <option value="Yamanashi">山梨県</option>
                        <option value="Nagano">長野県</option>
                        <option value="Niigata">新潟県</option>
                        <option value="Toyama">富山県</option>
                        <option value="Ishikawa">石川県</option>
                        <option value="Fukui">福井県</option>
                        <option value="Gifu">岐阜県</option>
                        <option value="Shizuoka">静岡県</option>
                        <option value="Aichi">愛知県</option>
                        <option value="Mie">三重県</option>
                        <option value="Shiga">滋賀県</option>
                        <option value="Kyoto">京都府</option>
                        <option value="Osaka">大阪府</option>
                        <option value="Hyogo">兵庫県</option>
                        <option value="Nara">奈良県</option>
                        <option value="Wakayama">和歌山県</option>
                        <option value="Tottori">鳥取県</option>
                        <option value="Shimane">島根県</option>
                        <option value="Okayama">岡山県</option>
                        <option value="Hiroshima">広島県</option>
                        <option value="Yamaguchi">山口県</option>
                        <option value="Tokushima">徳島県</option>
                        <option value="Kagawa">香川県</option>
                        <option value="Ehime">愛媛県</option>
                        <option value="Kochi">高知県</option>
                        <option value="Fukuoka">福岡県</option>
                        <option value="Saga">佐賀県</option>
                        <option value="Nagasaki">長崎県</option>
                        <option value="Kumamoto">熊本県</option>
                        <option value="Oita">大分県</option>
                        <option value="Miyazaki">宮崎県</option>
                        <option value="Kagoshima">鹿児島県</option>
                        <option value="Okinawa">沖縄県</option>
                    </select>
                </dd>
            <dt>市区町村:</dt>
            <dd><input class="text_area" type="text" name="city" placeholder="Enter City Name" /></dd>
            <dt>生年月日:</dt>
            <dd><input type="date" name="birthday" min="1900-01-01", max="2022-12-31"></dd>
            <dt>性別：</dt>
            <dd>
            <div class="gender_radiobox">
                <input id="radio1" class="gender_radiobutton" name="gender" type="radio" value="male" />
                <label class="gender_label" for="radio1">男</label>
                <input id="radio2" class="gender_radiobutton" name="gender" type="radio" value="female" />
                <label class="gender_label" for="radio2">女</label>
                <input id="radio3" class="gender_radiobutton" name="gender" type="radio" value="other" />
                <label class="gender_label" for="radio3">その他/登録したくない</label>
            </div>
            </dd>
            </dl>
            <div class="profile_button"><input class="profile_submit" type="submit" value="Continue" /></div>
        </form>
    </div>

</body>
</html>
