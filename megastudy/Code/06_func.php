<?php
//	절대 경로 : 드라이브의 root 디렉토리(폴더) 부터 파일이 위치한 곳 까지의 경로
//	C:\\xampp\\htdocs\\0321\\function\\function.php
//	jsp는 반드시 경로 구분시 "\\"를 써야 하고 php는 "\\"나 "\"나 관계 없다.
//	C:/xampp/htdocs/0321/function/function.php
//	상대 경로 : 현재 php 파일이 위치한 디렉토리 부터 파일이 위치한 곳 까지의 경로
//	./function/function.php
//	"." : 현재 php 파일이 있는 디렉토리
//	".." : 현재 php 파일이 있는 디렉토리의 바로 상위 디렉토리

include './function/function.php';
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>Insert title here</title>
</head>

<body>
1~100의 합계는 : <?= total() ?>
</body>

</html>