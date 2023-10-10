<?php 

include "db.php";
header('Access-Control-Allow-Origin:*');
header("Content-Type:application/json");

if (isset($_GET['key'])) 
{
    $key = mysqli_real_escape_string($conn, $_GET['key']);
    
    
    $checkRow = mysqli_query($conn,"SELECT status FROM `api_token` WHERE token='$key' LIMIT 1");

    $count = mysqli_num_rows($checkRow);

    if ($count === 1) 
    {
        
        // fetch complaint data

        
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


    } else {
        echo json_encode(['status' => 'false', 'data' => 'Please Provide Valid API Key!']);
    }
    

} 
else {
    echo json_encode(['status' => 'false', 'data' => 'Please Provide API Key!']);
}

?>