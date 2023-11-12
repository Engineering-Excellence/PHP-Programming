<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>Insert title here</title>
</head>

<body>
<?php
//	배열이란 같은 이름으로 여러개의 기억장소를 만들어 사용하는 것을 말한다.
$array1 = array(1, 2, 3);                    // 배열 선언시 초기화
print_r($array1);                            // 배열의 모든 내용을 인덱스와 함께 출력한다.
echo "<br/>";
var_dump($array1);                            // 배열의 모든 내용을 인덱스, 자료형과 함께 출력한다.
echo "<br/>";

//	$array2 = array();							// 빈 배열을 선언한다.
$array2[0] = 1;
$array2[1] = 2;
$array2[2] = "사장님 나빠요!!";
print_r($array2);
echo "<br/>";
var_dump($array2);
echo "<br/>";

$array2[1] = 222;
$array2[3] = 444;
print_r($array2);
echo "<br/>";

//	연관배열 : 배열의 첨자 역할을 하는 키 값을 사용한다. "키" => 값
$array3 = array("name" => "Jone", "age" => 28);
print_r($array3);
echo "<br/>";
echo $array3["name"] . "<br/>";

//	$array4 = array();
$array4["name"] = "Jone";
$array4["age"] = 28;
print_r($array4);
echo "<br/>";

if ($array3 == $array4) {
    echo "같다.<br/>";
} else {
    echo "다르다.<br/>";
}
?>
</body>

</html>