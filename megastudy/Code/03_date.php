<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>Insert title here</title>
</head>

<body>
<?php
//	echo date_default_timezone_get()."<br/>";	// php.ini 파일에 설정된 기본 타임존을 얻어온다.
//	$today = getdate();							// getdate() : 컴퓨터 시스템의 날짜 및 시간을 연관 배열 형태로 얻어온다.
//	echo print_r($today)."<br/>";				// print_r(배열) : 배열의 내용을 출력한다.

date_default_timezone_set("Asia/Seoul");    // php 기본 타임존을 변경한다.
//	echo date_default_timezone_get()."<br/>";	// php.ini 파일에 설정된 기본 타임존을 얻어온다.
//	$today = getdate();							// getdate() : 컴퓨터 시스템의 날짜 및 시간을 연관 배열 형태로 얻어온다.
//	echo var_dump($today)."<br/>";				// var_dump(배열) : 배열의 내용을 출력한다.

//	년
echo date("Y") . "<br/>";                        // 년도 4자리
echo date("y") . "<br/>";                        // 년도 2자리
echo date("L") . "<br/>";                        // 윤년은 1, 평년은 0

//	월
echo date("n") . "<br/>";                        // 월, 1~12
echo date("m") . "<br/>";                        // 월, 01~12
echo date("M") . "<br/>";                        // 월, 영어로 3자
echo date("F") . "<br/>";                        // 월, 영어로 풀네임
echo date("t") . "<br/>";                        // 월, 마지막 날짜

//	일
echo date("j") . "<br/>";                        // 일, 1~30
echo date("d") . "<br/>";                        // 일, 01~30
echo date("D") . "<br/>";                        // 요일, 영어로 3자
echo date("l") . "<br/>";                        // 요일, 영어로 3자
echo date("w") . "<br/>";                        // 요일, 일(0) ~ 토(6)
echo date("z") . "<br/>";                        // 현재 년도의 지나온 날짜
echo date("W") . "<br/>";                        // 현재 년도의 지나온 주짜

echo date("Y-m-d") . "<br/>";
echo date("M d Y F") . "<br/>";

//	시간
echo date("a") . "<br/>";                        // am/pm
echo date("A") . "<br/>";                        // AM/PM
echo date("g") . "<br/>";                        // 12시각 1~12
echo date("h") . "<br/>";                        // 12시각 01~12
echo date("G") . "<br/>";                        // 24시각 0~23
echo date("H") . "<br/>";                        // 24시각 00~23
echo date("i") . "<br/>";                        // 분 00~60
echo date("s") . "<br/>";                        // 초 00~60

echo date("Y년 m월 d일 D H:i:s") . "<br/>";
$week = array("일", "월", "화", "수", "목", "금", "토");
echo date("Y년 m월 d일 " . $week[date("w")] . " H:i:s") . "<br/>";
?>
</body>

</html>
