<?php
require_once('../util.php');
require_once('../DBProvider.php');

// LẤY DANH SÁCH SẢN PHẨM 
 // Lấy keyword từ ô tìm kiếm 
$keyword = getArrayByKey($_GET, 'keyword');
if ($keyword) {
  $selectProduct = "SELECT * FROM `products` WHERE `name` LIKE '%$keyword%'";
} else {
  $selectProduct = "SELECT * FROM `products`";
}
$products = DBProvider::executeQuery($selectProduct);

// XỬ LÝ DỮ LIỆU SAU KHI SUBMIT FORM
if (isset($_POST['btn-submit'])) {

  $name = getArrayByKey($_POST, 'name');
  $amount = getArrayByKey($_POST, 'amount');
  $image = getArrayByKey($_POST, 'image');
  $code = getArrayByKey($_POST, 'code');
  $quantity = getArrayByKey($_POST, 'quantity');
  $type = getArrayByKey($_POST, 'type');

  if ($name && $amount && $code && $quantity && $image && $type) {
    // nếu có id => đang chỉnh sửa
    if ($id && $id != "") {
      $sql = "UPDATE `products` SET `name`='$name',`amount`= $amount, `image` = '$image', `type` = '$type', `code` = '$code', `quantity` = '$quantity' WHERE `id` = $id";
    } else {
      $sql = "INSERT INTO `products`( `name`, `amount`, `image`, `type`, `code`, `quantity`) VALUES ('$name', $amount, '$image', $type, '$code', $quantity)";
    }
    
    DBProvider::executeQuery($sql);
    if ($id && $id != "") {
      header('Location: /products/index.php');
      exit;
    }
  }
   
  // VALIDATION FORM 
  $errorName = !$name ? 'Tên sản phẩm không được bỏ trống ! ' : null;
  $errorAmount = !$amount ? 'Giá sản phẩm không được bỏ trống !' : null;
  $errorCode = !$code ? 'Mã sản phẩm không được bỏ trống !' : null;
  $errorQuantity = !$quantity ? 'Số lượng sản phẩm không được bỏ trống !' : null;
  $errorImage = !$image ? 'Tải ảnh sản phẩm  !' : null;
  $errorType= !$type?'Chọn loại sản phẩm !' :null;
 
}
// LẤY ID SẢN PHẨM VÀ TÌM SẢN PHẨM CẦN CẬP NHẬP 
$id = getArrayByKey($_GET, 'id');
if ($id) {
  $data = DBProvider::executeQuery("SELECT * FROM `products` WHERE `products`.`id` = $id");
  // chuyen data thanh array
  $data = $data->fetch_assoc();
}
?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <title>Hello Fashion!</title>
</head>

<body>
  <div class="jumbotron " style="padding: 0.2% 8%;"> 
  <h1 class="text-center text-danger m-3"> ----- QUẢN LÝ KHO SẢN PHẨM ----- </h1>
    <div class="card "  >
      <div class="card-header bg-success text-center " >
       <h2><?php echo isset($data) ? 'Chỉnh sửa' : 'Thêm mới' ?> sản phẩm</h2> 
      </div>
      <div class="card-body">

      <!-- // FORM ----------------- -->
        <form action="index.php<?php echo isset($data) ? '?id=' . $id : '' ?>" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Mã sản phẩm </label>
            <input value="<?php echo isset($data) ? $data['code'] : '' ?>" type="text" class="form-control" name="code">
            <?php
            if($errorCode)
              echo "<span class='help-block text-danger'>$errorCode</span>"
            ?>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Tên sản phẩm </label>
            <input value="<?php echo isset($data) ? $data['name'] : '' ?>" type="text" class="form-control" name="name">
            <?php
            if( $errorName)
              echo "<span class='help-block text-danger'>$errorName</span>"
            ?>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Giá sản phẩm</label>
            <input value="<?php echo isset($data) ? $data['amount'] : '' ?>" type="number" class="form-control" name="amount">
            <?php
            if($errorAmount)
              echo "<span class='help-block text-danger'>$errorAmount</span>"
            ?>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Số lượng  sản phẩm</label>
            <input value="<?php echo isset($data) ? $data['quantity'] : '' ?>" type="number" class="form-control" name="quantity">
            <?php
            if($errorQuantity)
              echo "<span class='help-block text-danger'>$errorQuantity</span>"
            ?>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Ảnh sản phẩm </label>
            <input value="<?php echo isset($data) ? $data['image'] : '' ?>" type="text" class="form-control" name="image">
            <?php
            if($errorImage)
              echo "<span class='help-block text-danger'>$errorImage</span>"
            ?>
          </div>
          <div class="form-group">
          <label for="">Loại sản phẩm </label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="type" id="exampleRadios1" value="1" <?php echo isset($data) && $data['type'] == 1 ? 'checked' : '' ?>>
            <label class="form-check-label" for="exampleRadios1">
              Áo nữ
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="type" id="exampleRadios2" value="2" <?php echo isset($data) && $data['type'] == 2 ? 'checked' : '' ?>>
            <label class="form-check-label" for="exampleRadios2">
              Đầm nữ
            </label>
          </div>
          <?php
            if($errorType)
              echo "<span class='help-block text-danger'>$errorType</span>"
            ?>
          </div>
          <button type="submit" class="btn btn-success" name="btn-submit">submit </button>
        </form>
      </div>
    </div>

    <!-- // SEARCH ----------------- -->
    <hr>
    <form action="" method="get">
      <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6">
          <div class="input-group mb-3">
            <input type="text" class="form-control" value="<?php echo $keyword ?>" placeholder="Nhập tên sản phẩm cần tìm" name="keyword">
            <div class="input-group-append">
              <button class="btn btn-outline-primary ml-1" type="submit" id="button-addon2">Tìm kiếm</button>
              <div>  <a href="/products/index.php" class="btn btn-success ml-3">Tất cả sản phẩm </a></div>  
            </div>
          </div>
        </div>
      </div>
    </form>


    <!-- TABLE -------------------  -->
    <hr>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">STT</th>
          <th scope="col">Tên sản phẩm</th>
          <th scope="col">Giá sản phẩm</th>
          <th scope="col">Mã sản phẩm</th>
          <th scope="col">Số lượng</th>
          <th scope="col">Loại sản phẩm</th>
          <th scope="col">Hình ảnh</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php
        // HIỂN THỊ DANH SÁCH SẢN PHẨM LÊN TABLE
        if ($products->num_rows > 0) {
          $stt = 1;
          while ($product = $products->fetch_assoc()) { 
            $name = getArrayByKey($product, 'name');
            $amount =number_format(getArrayByKey($product, 'amount')) ;
            $code = getArrayByKey($product, 'code');
            $quantity = getArrayByKey($product, 'quantity');
            $image = getArrayByKey($product, 'image');
            $type = getArrayByKey($product, 'type');
            $displayType = displayFashionType($type);
            $id = getArrayByKey($product, 'id');
            echo "
          <tr>
          <th scope='row'> $stt </th>
          <td>$name</td>
          <td>$amount VND</td>
          <td>$code</td>
          <td>$quantity </td>
          <td>$displayType</td>
          <td><img width='75' height='auto' src='/images/$image' alt='$name'></td>
          <td>
            <a href='index.php?id=$id' class='btn btn-success btn-sm'>Sửa</a>
            <a href='delete.php?id=$id' class='btn btn-danger btn-sm'>Xoá</a>
          </td>
        </tr>
          ";
            $stt++;
          }
        }
        ?>
      </tbody>
    </table>
  </div>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
</body>

</html>