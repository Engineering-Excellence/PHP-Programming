<!-- 이것은 HTML 주석입니다. -->
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>Insert title here</title>
</head>

<body>
<marquee>안녕 PHP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</marquee>
<br/>
<?php
/* ~ 부터 ~ 까지 주석 */
// 이것도 주석이고요
#  이것도 주석입니다.
echo "안녕 PHP<br/>";
print "또 안녕 PHP<br/>";

//	상수 정의 : define("상수이름", 값);
define("PIE", 3.141592);
echo "PIE = " . PIE . "<br/>";                // PHP의 문자열 연결 연산자 : "."

$PI = 3.14;
$radius = 7;
$circumference = $PI * 2 * $radius;

//	php는 큰따옴표 안의 변수는 변수로 인식된다. 변수 뒤에 반드시 1칸 이상의 빈칸을 둬야 한다.
echo "반지름이 $radius 인 원의 둘레는 $circumference 입니다.<br/>";
echo "반지름이 " . $radius . "인 원의 둘레는 " . $circumference . "입니다.<br/>";
echo "반지름이 ", $radius, "인 원의 둘레는 ", $circumference, "입니다.<br/>";        // ","도 문자열 연결을 한다.

//	php는 작은따옴표 안의 변수는 문자열로 인식된다.
echo '반지름이 $radius 인 원의 둘레는 $circumference 입니다.<br/>';

$name = "Jone";
//	$$변수명 : 변수에 저장된 내용을 변수명으로 사용할 수 있다.
$$name = "Registered user";
print $name . "<br/>";
print $$name . "<br/>";
print $Jone . "<br/>";
?>
</body>

</html>
