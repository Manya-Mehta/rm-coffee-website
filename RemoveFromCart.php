<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

require "db.php";
session_start();

$data = json_decode(file_get_contents("php://input"), true);

$delete_product = "DELETE FROM carts_products WHERE cart_product_id = ?";
$stmt = $conn->prepare($delete_product);
$stmt->bind_param("i", $data["product_cart_id"]);

    if ($stmt->execute()) {
        $subtract_amount = "UPDATE carts SET total_amount = ? WHERE user_pid = ?";
        $stmt = $conn->prepare($subtract_amount);
        $stmt->bind_param("ii", $data['product_amount'], $_SESSION['user_id']);
        if($stmt->execute()) {
            echo json_encode([
                "message" => $data['product_amount'],
                "success" => true,
            ]);
        }
    } else {
        echo json_encode([
            "message" => "Failed to delete the item",
            "success" => false,
        ]);
    }
$stmt->close();
$conn->close();

?>
