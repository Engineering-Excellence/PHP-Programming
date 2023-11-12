<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>Insert title here</title>
</head>

<body>
<?php
$players = array("Jone", "Barbara", "Bill", "Nancy", "홍길동", "임꺽정");

//	foreach : 배열의 내용 전체에 대한 작업을 할 경우 사용하는 반복문
//	배열을 입력받고 입력받은 배열의 항목을 기준으로 반복적으로 소스를 실행한다.

//	foreach(배열명 as 변수명) {
//		소스 코드;
//		...;
//	}
$i = 0;
echo "선수들<br/>";
foreach ($players as $value) {
    $i = $i + 1;
    echo $i . "." . $value . "<br/>";
}

//	foreach(배열명 as 키변수 => 변수명) {
//		소스 코드;
//		...;
//	}
foreach ($players as $key => $value) {
    echo $key . "." . $value . "<br/>";
}

//	배열 생성시 시작 인덱스를 지정할 수 있다.
$people = array(1 => array("name" => "Jone", "age" => 28), array("name" => "Barbara", "age" => 67));

//	foreach 반복에서 배열의 값을 수정하려면 "&(번지, 참조)"연산자를 사용한다.
foreach ($people as &$value) {
    print_r($value);
    echo "<br/>";
//		관계(비교) 연산자
//		>(크다, 초과), >=(크거나 같다, 이상), <(작다, 미만), <=(작거나 같다, 이하), ==(같다), !=(같지 않다)
    if ($value["age"] >= 35) {
        $value["name"] = "홍길동";
        $value["age guoup"] = "old";
    } else {
        $value["name"] = "임꺽정";
        $value["age guoup"] = "young";
    }
}

print_r($people);
?>
</body>

</html>