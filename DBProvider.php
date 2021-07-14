<?php
class DBProvider {

    public static function executeQuery($sql)
    {
        include ('config.inc');    
        // Tạo kết nối CSDL
        $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, 3306);
        if ( mysqli_connect_errno() ){
            printf("Connect failed: %s", mysqli_connect_error());
            exit();
        }

        // Thiết lập font Unicode
        if (!(mysqli_query($mysqli,"set names `utf8`"))){
           die("mysqli_query: " . $mysqli);
        }       
      
        //Thực thi câu truy vấn 
        if ($result = $mysqli->query($sql)){
            return $result;
        }
        //Đóng kết nối CSDL
        $mysqli->close();
    }
}