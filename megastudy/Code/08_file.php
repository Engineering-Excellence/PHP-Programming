<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>Insert title here</title>
</head>

<body>
<?php
//	$배열명 = file("파일명")					// 지정된 경로의 파일을 읽어 배열에 저장해 준다.
$dataArray = file("../data/08_file.txt");
// 	print_r($dataArray); echo "<br/>";
// 	var_dump($dataArray);
//	count($배열명) : 배열에 저장된 데이터의 개수를 얻어온다.
// 	for($i=0 ; $i<count($dataArray) ; $i++) {
// 		echo $dataArray[$i]."<br/>";
// 	}
$sum = 0;
foreach ($dataArray as $data) {
    echo "파일에서 줄단위로 읽은 데이터 : " . $data . "<br/>";
// 		$배열명 = explode("구분자", "문자열") 	// 구분자를 이용해 문자열을 나눠 배열에 저장한다.
    $d = explode(" ", $data);
    $d[4] = 0;                                // 합계를 구하는 기억장소의 초기치는 0으로 한다.
    for ($i = 1; $i < 4; $i++) {
//			echo "d[".$i."] = ".$d[$i]."<br/>";
        $d[4] += $d[$i];
    }
    $sum += $d[4];
    echo $d[0] . "님의 총점은 " . $d[4] . "점 입니다.<br/>";
}
echo "전체 총점은 " . $sum . "점 입니다.<br/>";
?>
</body>

</html>