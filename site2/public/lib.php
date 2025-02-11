<?php

// DB 실행 함수 (Prepared Statement 적용)
function execute($sql, $params = []) {
    global $dbConn;
    $stmt = $dbConn->prepare($sql);

    if ($stmt === false) {
        die('SQL PREPARE ERROR: ' . $dbConn->error);
    }

    if (!empty($params)) {
        $stmt->bind_param(...$params);
    }

    $stmt->execute();
    return $stmt;
}

// 다중 결과 가져오기 (배열 반환)
function getRows($sql, $params = []) {
    $stmt = execute($sql, $params);
    $result = $stmt->get_result();
    
    if (!$result) {
        return [];
    }

    return $result->fetch_all(MYSQLI_ASSOC);
}

// 단일 행 가져오기
function getRow($sql, $params = []) {
    $rows = getRows($sql, $params);
    return $rows[0] ?? [];
}

// 단일 값 가져오기
function getRowValue($sql, $params = []) {
    $row = getRow($sql, $params);
    return reset($row);
}

// 안전한 alert() 메시지
function jsAlert($msg) {
    $msg = htmlspecialchars($msg, ENT_QUOTES, 'UTF-8');
    echo "<script> alert('{$msg}'); </script>";
}

// 안전한 history.back()
function jsHistoryBack() {
    echo "<script> history.back(); </script>";
    exit;
}

// 안전한 location.replace()
function jsLocationReplace($url) {
    echo "<script> location.replace('{$url}'); </script>";
    exit;
}

// 로그인 여부 확인 (보안 강화)
function isLogined() {
    return isset($_SESSION['loginedMemberInfo']) && is_array($_SESSION['loginedMemberInfo']);
}

// 마지막 삽입된 ID 가져오기
function getLastInsertId() {
    global $dbConn;
    return $dbConn->insert_id;
}
