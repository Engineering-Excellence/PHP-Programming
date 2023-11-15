<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>Insert title here</title>
</head>

<body>
<?php
$name = $_POST["name"];
//	strlen() : 괄호안의 변수에 저장된 문자의 개수를 출력한다.
echo strlen($name) . "<br/>";
//	trim() : 괄호안의 변수에 저장된 불필요한 빈칸을 제거한다.
echo strlen(trim($name)) . "<br/>";
if (strlen(trim($name)) > 0) {
    echo $name . "님 안녕하세요<br/>";
} else {
    echo "<script>";
    echo "alert('이름이 입력되지 않았습니다!!');";
    echo "location='05_form3.php';";
    echo "</script>";
}
?>
<a href="05_form3.php">돌아가기</a>
</body>

</html>