<?php

function execute($sql) {
    global $dbConn;
    return mysqli_query($dbConn, $sql);
}

function getRows($sql) {
    $rs = execute($sql);

    $rows = [];

    while ( $row = mysqli_fetch_assoc($rs) ) {
        $rows[] = $row;
    }

    return $rows;
}

function getRow($sql) {
    $rows = getRows($sql);

    if ( isset($rows[0]) ) {
        return $rows[0];
    }

    return [];
}

function getRowValue($sql) {
    $row = getRow($sql);

    foreach ( $row as $val ) {
        return $val;
    }

    return null;
}

function jsAlert($msg) {
    echo "<script> alert('{$msg}'); </script>";
}

function jsHistoryBack() {
    echo "<script> history.back(); </script>";
    exit;
}

function jsLocationReplace($url) {
    echo "<script> location.replace('{$url}'); </script>";
    exit;
}

function jsLocationHref($msg) {
    echo "<script> location.href = '{$url}'; </script>";
    exit;
}

function isLogined() {
    return isset($_SESSION['loginedMemberInfo']);
}

function getLastInsertId() {
    return getRowValue("SELECT LAST_INSERT_ID()");
}