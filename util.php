<?php
// LẤY GIÁ TRỊ TỪ MẢNG BẰNG KEY TRUYỀN VÀO, NẾU K CÓ TRẢ VỀ DEFAULT
function getArrayByKey($arrays, $key, $default = null)
{
    if (array_key_exists($key, $arrays)) {
        return $arrays[$key];
    }
    return $default;
}

// HIỂN THỊ LOẠI SẢN PHẨM THEO TYPE 
function displayFashionType($type, $default = null)
{
    switch ($type) {
        case 1:
            return 'Áo nữ';
        case 2:
            return 'Đầm nữ';
        default:
            return $default;
    }
}
