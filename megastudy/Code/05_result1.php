<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>Insert title here</title>
</head>

<body>
<?php
//	form.html에서 넘어오는 내용을 받아보자
//	isset(변수명) : 괄호 안의 변수가 존재하면 true, 존재하지 않으면 false를 리턴한다.
if (isset($_POST["name"])) {
    echo '$_POST["name"] = ' . $_POST["name"] . "<br/>";
} else {
    echo "POST 방식으로 넘어오는 name이 없습니다.<br/>";
}
if (isset($_GET["name"])) {
    echo '$_GET["name"] = ' . $_GET["name"] . "<br/>";
} else {
    echo "GET 방식으로 넘어오는 name이 없습니다.<br/>";
}

$name = $_POST["name"];
$j1 = $_POST["j1"];
$j2 = $_POST["j2"];
echo $name . "님의 주민등록번호는 " . $j1 . "-" . $j2 . "입니다.<br/>"
?>
<a href="05_form1.html">돌아가기</a>
</body>

</html>