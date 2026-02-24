<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

require "db.php";
session_start();

$delete_all = "DELETE FROM carts_products WHERE user_id = ?";

$stmt = $conn->prepare($delete_all);
$stmt->bind_param("i", $_SESSION["user_id"]);

if ($stmt->execute()) {
    $delete_from_cart = "DELETE FROM carts WHERE user_pid = ?";
    $stmt = $conn->prepare($delete_from_cart);
    $stmt->bind_param("i", $_SESSION["user_id"]);
    if ($stmt->execute()) {
        echo json_encode([
            "success" => true,
            "message" => "Checkout successful!",
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Something went wrong!",
        ]);
    }
} else {
    echo json_encode([
        "success" => false,
        "message" => "Something went wrong!",
    ]);
}

?>
