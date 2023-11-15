<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>Insert title here</title>
</head>

<body>
<form action="05_result2.php" method="post" onsubmit="return true;">
    이름 : <input type="text" name="name"/><br/>
    암호 : <input type="password" name="password"/><br/>
    나이 : <input type="text" name="age"><br/>
    성별 : <input type="radio" name="gender" value="1">남자
    <input type="radio" name="gender" checked value="2">여자<br/>
    <!-- checkbox의 name 속성은 반드시 배열 형태로(뒤에 []를 붙어서) 작성해야 한다. -->
    취미 : <input type="checkbox" name="hobby[]" value="술먹기"/>술먹기
    <input type="checkbox" name="hobby[]" value="잠자기"/>잠자기
    <input type="checkbox" name="hobby[]" value="공부하기"/>공부하기<br/>
    소개 : <textarea rows="5" cols="50" name="comment"></textarea><br/>
    연령대 :
    <select name="area">
        <option>10대</option>
        <option selected="selected">20대</option>
        <option>30대</option>
        <option>40대</option>
        <option>50대</option>
    </select><br/>
    <input type="submit" value="전송"/>
</form>

<?php
$a = 5;
$b = 3;

//	문자열은 산술 연산시 0으로 취급되어 계산된다. "."이 "+", "-"보다 연산의 우선 순위가 높다.
echo "a + b = $a + $b <br/>";                    // a + b = 5 + 3
echo "a + b = " . $a + $b . "<br/>";                // 3
echo "a + b = " . ($a + $b) . "<br/>";                // a + b = 8

echo "a - b = $a - $b <br/>";                    // a - b = 5 - 3
echo "a - b = " . $a - $b . "<br/>";                // -3
echo "a - b = " . ($a - $b) . "<br/>";                // a + b = 2

echo "a * b = $a * $b <br/>";                    // a * b = 5 * 3
echo "a * b = " . $a * $b . "<br/>";                // a * b = 15

//	자바스크립트와 PHP는 정수끼리의 연산 결과가 실수가 나오므로 결과를 정수로 원하면 캐스팅 해줘야 한다.
echo "a / b = $a / $b <br/>";                    // a / b = 5 / 3
echo "a / b = " . $a / $b . "<br/>";                // a / b = 1.6666666666667
echo "a / b = " . (int)($a / $b) . "<br/>";            // a / b = 1

echo "a % b = $a % $b <br/>";                    // a % b = 5 % 3
echo "a % b = " . $a % $b . "<br/>";                // a % b = 2
?>
</body>

</html>