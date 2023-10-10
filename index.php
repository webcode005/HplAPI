<?php 

include "db.php";
header('Access-Control-Allow-Origin:*');
header("Content-Type:application/json");


$s_query = $conn->query("SELECT * FROM `complaint` ORDER BY `complaint`.`id` DESC");

if ($s_query->num_rows > 0) {

    $complain_record = array();
    while ($s_row = $s_query->fetch_assoc()) {

        $complain_record[] = $s_row;
      //  print_r($complain_record);

    }

    echo json_encode(['status' => 'true', 'data' => $complain_record, 'result' => 'found']);
} else {
    echo json_encode(['status' => 'true', 'data' => 'No data Found!', 'result' => 'not']);
  }
?>