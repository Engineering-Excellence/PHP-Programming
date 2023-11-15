<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>Insert title here</title>
    <script type="text/javascript"></script>
</head>

<body>
<?php
//	echo("<script>alert('이름이 입력되지 않았습니다.')</script>");
// 	if(isset($_POST["name"])) {
// 		echo "이름이 입력되지 않았습니다.<br/>";
// 		echo("<script>alert('이름이 입력되지 않았습니다.')</script>");
// 	} else {
// 		echo "이름이 입력 되었습니다.<br/>";
// 	}

$name = $_POST["name"];
echo "이름 : " . $name . "<br/>";
$password = $_POST["password"];
echo "암호 : " . $password . "<br/>";
$age = $_POST['age'];
echo "나이 : " . $age . "<br/>";
echo "내년 나이 : " . ($age + 1) . "<br/>";
$gender = $_POST["gender"];
// 	if($gender == 1) {
// 		echo "성별 : 남자<br/>";
// 	} else {
// 		echo "성별 : 여자<br/>";
// 	}

//	삼항(조건) 연산자 : 조건식 ? 조건이 참일 경우 실행할 문장 : 조건이 거짓일 경우 실행할 문장
echo "성별 : " . ($gender == 1 ? "남자" : "여자") . "<br/>";

echo "취미 : ";
if (isset($_POST["hobby"])) {
    $hobby = $_POST["hobby"];
// 		print_r($hobby)
    foreach ($hobby as $value) {
        echo $value . " ";
    }
} else {
    echo "없음";
}
echo "<br/>";

$comment = $_POST['comment'];
//	nl2br(변수) : 변수에 저장된 내용중 줄바꿈 문자(\n)를 <br/> 태그로 변환시킨다.
echo "소개 : " . nl2br($comment) . "<br/>";

$area = $_POST["area"];
echo "연령대 : " . $area . "<br/>";
?>
<a href="05_form2.php">돌아가기</a>
<input type="button" value="location.href='form1.php'" onclick="location.href='form1.php'">
<input type="button" value="history.back()" onclick="history.back();">
<input type="button" value="history.go(-1)" onclick="history.go(-1);">
</body>

</html>