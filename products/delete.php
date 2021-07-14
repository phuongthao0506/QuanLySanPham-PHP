<?php
require_once ('../util.php');
require_once ('../DBProvider.php');
$id = getArrayByKey($_GET, 'id');
if($id) {
    DBProvider::executeQuery("DELETE FROM `products` WHERE `products`.`id` = $id");
}
// quay lai trang chinh
header('Location: /products/index.php');
exit;
?>