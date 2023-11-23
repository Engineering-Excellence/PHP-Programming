<?php
include '../../config/11_db.inc.php';

//	DB 연결을 가져오는 함수
function getLink()
{
    $link = mysqli_connect(HOST, USER, PASSWORD);        // MySQL 서버에 접속한다.
    if (!$link) {
// 			mysqli_errno() : 최근에 실행된 MySQL 작업으로 발생한 에러 번호를 리턴한다.
// 			mysqli_error() : 최근에 실행된 MySQL 작업으로 발생한 에러 메시지를 리턴한다.
        die("연결실패!! " . mysqli_errno($link) . " : " . mysqli_error($link) . "<br/>");
        return;
    }
    mysqli_select_db($link, DBNAME);                        // MySQL 데이터베이스를 선택한다.
    mysqli_query($link, "set names utf8");                        // PHP와 MySQL간 한글 깨짐을 방지한다.
    return $link;
}

//	DB를 닫아주는 함수
function dbClose($link): void
{
    mysqli_close($link);                                    // MySQL 서버에 접속을 끊는다.
}

//	DB에 저장된 전체 레코드의 개수를 알아내는 함수
function getTotalCount()
{
    $link = getLink();                                    // DB에 연결한다.
    $query = "SELECT COUNT(*) FROM MEMO";                // 쿼리를 만든다.
    $result = mysqli_query($query, $link);                // 쿼리를 실행해 결과를 얻어온다.
    $row = mysqli_fetch_array($result);                    // 쿼리의 실행 결과를 $row에 배열로 저장한다.
    $totalCount = $row[0];
    dbClose($link);                                        // DB 접속을 해제한다.
    return $totalCount;                                    // 결과를 리턴한다.
}

//	화면에 표시할 한 페이지 분량의 글 목록을 얻어 리턴하는 함수
function selectList($query): mysqli_result|bool
{
    $link = getLink();
    $result = mysqli_query($query, $link);
    dbClose($link);
    return $result;
}