<?php
//	function 함수명([인수, ...]) {			// 함수의 머리
//		함수가 실행할 문장;					// 함수의 몸체
//		...;
//		return 값;
//	}

function total(): int
{
    $sum = 0;
    for ($i = 1; $i <= 100; $i++) {
        $sum += $i;
    }
    return $sum;                        // return을 만나면 함수를 호출한 곳으로 값을 가지고 되돌아간다.
}

?>