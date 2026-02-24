<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

require "db.php";
session_start();

$retrieve_user = "
    SELECT c.cart_product_id, c.product_id, p.price, p.name, p.image_url
    FROM carts_products c
    LEFT JOIN products p ON c.product_id = p.product_pid
    WHERE c.user_id = ?";

$stmt = $conn->prepare($retrieve_user);
$stmt->bind_param("i", $_SESSION["user_id"]);

$query_result = [];
if ($stmt->execute()) {
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $each_row = [
            "cart_product_id" => $row["cart_product_id"],
            "product_id" => $row["product_id"],
            "price" => $row["price"],
            "name" => $row["name"],
            "image_url" => $row["image_url"],
        ];
        $query_result[] = $each_row;
    }
    $retrieve_cart = "SELECT * FROM carts WHERE user_pid = ?";
    $stmt = $conn->prepare($retrieve_cart);
    $stmt->bind_param("i", $_SESSION["user_id"]);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $carts_info = [
                "total_amount" => $row["total_amount"],
                "total_items" => $row["total_items"],
            ];
            $response = [
                "items" => $query_result,
                "cart_info" => $carts_info
            ];
        }
    }
    echo json_encode($response);
} else {
    echo "Error retrieving user";
}
?>
