<?php
include '../../config/12_db.inc.php';

//	방명록 작성에 필요한 각종 함수를 정의해 놓는다.

//	DB에 연결하는 함수
function getLink()
{
    $link = mysqli_connect(HOST, USER, PASSWORD);        // MySQL에 연결
    if (!$link) {
        die("연결 실패!! " . mysqli_errno($link) . " : " . mysqli_error($link) . "<br/>");
        return;
    }
    mysqli_select_db($link, DB);                            // DB 연결(선택)
    mysqli_query("set names utf8");                        // MySQL 한글 깨짐 방지
    return $link;
}

//	DB의 연결을 해제하는 함수
function dbClose($link): void
{
    mysqli_close($link);
}

//	페이지 작업에 관련된 정보를 계산하는 함수
function pageInfo($currentPage, $pageSize): array
{
    $totalCount = selectCount();                                    // 부모글의 전체 개수
//		echo "전체 부모 글 개수 : " . $totalCount;
    $totalPage = (int)(($totalCount - 1) / $pageSize) + 1;            // 전체 페이지 개수
//		현재 화면에 출력될 페이지 번호는 전체 페이지 개수를 넘어갈 수 없다.
    $currentPage = min($currentPage, $totalPage);
    $startNo = ($currentPage - 1) * $pageSize;                        // 페이지에 출력할 시작 글번호
//		$endNo = $startNo + $pageSize - 1;								// 페이지에 출력할 끝 글번호, 오라클 용
    $startPage = (int)(($currentPage - 1) / 10) * 10 + 1;            // 페이지 이동 하이퍼링크 시작 페이지 번호
    $endPage = $startPage + 9;                                        // 페이지 이동 하이퍼링크 끝 페이지 번호
    $endPage = min($endPage, $totalPage);
//		계산된 페이지 작업 관련 정보를 배열에 넣어서 리턴한다.
    $pageInfo = array();
    $pageInfo["pageSize"] = $pageSize;
    $pageInfo["currentPage"] = $currentPage;
    $pageInfo["totalCount"] = $totalCount;
    $pageInfo["totalPage"] = $totalPage;
    $pageInfo["startNo"] = $startNo;
    $pageInfo["startPage"] = $startPage;
    $pageInfo["endPage"] = $endPage;
    return $pageInfo;
}

//	부모글 전체의 개수를 얻어오는 함수
function selectCount()
{
    $link = getLink();                                                // DB에 연결
    $query = "SELECT COUNT(*) FROM " . TBNAME;                        // 쿼리 작성
    $result = mysqli_query($link, $query);                            // 쿼리 실행
    $row = mysqli_fetch_array($result);                                // 쿼리 실행 결과를 인덱스 연관 배열로 저장
    $totalCount = $row[0];                                            // 전체 부모 글 개수 저장
    dbClose($link);                                                    // DB 연결 해제
    return $totalCount;                                                // 전체 부모 글 개수 리턴
}

//	한 페이지 분량의 부모글을 얻어오는 함수
function selectList($startNo, $pageSize): mysqli_result|bool
{
    $link = getLink();
    $query = "SELECT * FROM " . TBNAME . " ORDER BY IDX DESC LIMIT " . $startNo . ", " . $pageSize;
    $result = mysqli_query($link, $query);
    dbClose($link);
    return $result;
}

// 	부모글을 저장하는 함수
function insert($name, $password, $subject, $content): mysqli_result|bool
{
    $link = getLink();
    $query = "INSERT INTO " . TBNAME . "(name, password, subject, content)
                VALUES ('" . $name . "', '" . $password . "', '" . $subject . "', '" . $content . "')";
// 		echo $query;
    $result = mysqli_query($link, $query);
    dbClose($link);
    return $result;
}

// 	조회수를 증가시키는 함수
function hitIncrement($idx): mysqli_result|bool
{
    $link = getLink();
    $query = "update " . TBNAME . " set hit = hit + 1 where idx = " . $idx;
// 		echo $query;
    $result = mysqli_query($link, $query);
    dbClose($link);
    return $result;
}

//	해당 글번호의 글 1건을 얻어오는 함수
function selectByIdx($idx): false|array|null
{
    $link = getLink();
    $query = "SELECT * FROM " . TBNAME . " WHERE IDX = " . $idx;
// 		echo $query;
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);            // 얻은 글 1건을 인덱스 연관 배열로 저장
    dbClose($link);
    return $row;
}


// ========================================================================================================

//	댓글을 댓글 DB에 저장하는 함수
function insertComment($ref, $name, $password, $content): mysqli_result|bool
{
    $link = getLink();
    $query = "INSERT INTO " . TBNAME . "(ref, name, password, content)
                VALUES (" . $ref . ", '" . $name . "', '" . $password . "', '" . $content . "')";
//		echo $query;
    $result = mysqli_query($link, $query);
    dbClose($link);
    return $result;
}

//	해당 글의 댓글 목록 전체를 얻어오는 함수
function selectListComment($idx): mysqli_result|bool
{
    $link = getLink();
    $query = "SELECT * FROM " . TBNAME . " WHERE REF = " . $idx . " ORDER BY IDX DESC";
//		echo $query;
    $result = mysqli_query($link, $query);
    dbClose($link);
    return $result;
}
