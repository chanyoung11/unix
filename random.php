<?php
$foods = [
    ["name"=>"김치찌개","type"=>"한식","place"=>"집밥","people"=>1],
    ["name"=>"된장찌개","type"=>"한식","place"=>"집밥","people"=>2],
    ["name"=>"불고기","type"=>"한식","place"=>"외식","people"=>2],
    ["name"=>"짬뽕","type"=>"중식","place"=>"외식","people"=>1],
    ["name"=>"짜장면","type"=>"중식","place"=>"외식","people"=>1],
    ["name"=>"탕수육","type"=>"중식","place"=>"외식","people"=>2],
    ["name"=>"초밥","type"=>"일식","place"=>"외식","people"=>1],
    ["name"=>"라멘","type"=>"일식","place"=>"외식","people"=>1],
    ["name"=>"규동","type"=>"일식","place"=>"집밥","people"=>1],
    ["name"=>"파스타","type"=>"양식","place"=>"집밥","people"=>1],
    ["name"=>"스테이크","type"=>"양식","place"=>"외식","people"=>2],
    ["name"=>"피자","type"=>"양식","place"=>"외식","people"=>3],
    ["name"=>"오므라이스","type"=>"일식","place"=>"집밥","people"=>1],
    ["name"=>"순두부찌개","type"=>"한식","place"=>"외식","people"=>1],
    ["name"=>"비빔밥","type"=>"한식","place"=>"집밥","people"=>1],
    ["name"=>"부대찌개","type"=>"한식","place"=>"외식","people"=>2],
    ["name"=>"우동","type"=>"일식","place"=>"외식","people"=>1],
    ["name"=>"리조또","type"=>"양식","place"=>"집밥","people"=>1],
    ["name"=>"샐러드","type"=>"양식","place"=>"집밥","people"=>1],
    ["name"=>"볶음밥","type"=>"중식","place"=>"집밥","people"=>1]
];

$result = null;

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $people = (int)$_POST["people"];
    $type = $_POST["type"];
    $place = $_POST["place"];

    $filtered = array_filter($foods, function($food) use($people,$type,$place){
        return ($food["people"] <= $people)
            && ($food["type"] == $type)
            && ($food["place"] == $place);
    });

    $result = count($filtered) > 0
        ? $filtered[array_rand($filtered)]["name"]
        : "조건에 맞는 음식이 없습니다!";
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>음식 추천</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <div class="nav-title">청년 생활 통합 서비스</div>
    <div class="nav-links">
        <a href="index.html">홈</a>
        <a href="honeyTip.html">자취 꿀팁</a>
        <a href="youthpolicy.html">정책 안내</a>
    </div>
</div>

<div class="container">
    <h1 class="section-title">🍽 음식 추천 서비스</h1>

    <div class="card">
        <form method="POST">
            <label>함께 먹는 인원</label>
            <select name="people" required>
                <option value="1">1명</option>
                <option value="2">2명</option>
                <option value="3">3명 이상</option>
            </select>

            <label>음식 종류</label>
            <select name="type" required>
                <option value="한식">한식</option>
                <option value="중식">중식</option>
                <option value="일식">일식</option>
                <option value="양식">양식</option>
            </select>

            <label>집밥 / 외식</label><br>
            <input type="radio" name="place" value="집밥" required> 집밥
            <input type="radio" name="place" value="외식"> 외식

            <br><br>
            <button class="btn" type="submit">추천받기</button>
        </form>
    </div>

    <?php if($result !== null): ?>
    <div class="card">
        <h3>추천 메뉴</h3>
        <p><?= $result ?></p>
    </div>
    <?php endif; ?>
</div>

</body>
</html>