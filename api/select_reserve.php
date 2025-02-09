<?php 
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header('Content-Type: application/json; charset=UTF-8');
header("Access-Control-Allow-Credentials: true");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db_connect.php';

//クラスの生成
$obj = new db_connect();
if($_SERVER['REQUEST_METHOD'] === 'GET') {
    $year_month = $_GET['currentDate'];
    $sql = 'SELECT * 
                FROM 
                    T_RESERVE 
                WHERE 
                    DATE_FORMAT(date, "%Y-%m") = :year_month
                AND(
                    T_1 IS NOT NULL OR
                    T_2 IS NOT NULL OR
                    T_3 IS NOT NULL OR
                    T_4 IS NOT NULL OR
                    T_5 IS NOT NULL OR
                    T_6 IS NOT NULL OR
                    T_7 IS NOT NULL OR
                    T_8 IS NOT NULL OR
                    T_9 IS NOT NULL
                )
    ';
    try{
        $params = [':year_month' => $year_month];
        $result = $obj->select($sql, $params);
        echo json_encode($result);
    } catch(Exception $e){
        echo "データ検索に失敗しました。" . $e->getMessage();
    }
}
?>