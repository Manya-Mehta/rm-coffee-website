<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");

require "db.php";

session_start();

$product_to_price = [
    1 => 250,
    2 => 250,
    3 => 250,
    4 => 250,
    5 => 250,
    6 => 250,
    7 => 250,
    8 => 3800,
    9 => 2000,
    10 => 650,
    11 => 2500,
    12 => 470,
    13 => 470,
    14 => 800,
    15 => 650,
    16 => 650,
    17 => 700,
];


if(!isset($_SESSION["user_id"])) {
    echo json_encode([
        "success" => false,
        "message" => "Login First!"
    ]);
}
else {
$data = json_decode(file_get_contents("php://input"), true);

$add_product = "
    INSERT INTO carts_products (user_id, product_id)
    VALUES (?, ?)";
$stmt = $conn->prepare($add_product);
$stmt->bind_param("ii", $_SESSION["user_id"], $data["product_id"]);

$add_cart_info = "
    INSERT INTO carts (user_pid, total_amount)
    VALUES(?, ?)
    ON DUPLICATE KEY UPDATE
    total_amount = total_amount + VALUES(total_amount),
    total_items = total_items + 1";

try {
    if ($stmt->execute()) {
        $stmt = $conn->prepare($add_cart_info);
        $stmt->bind_param(
            "ii",
            $_SESSION["user_id"],
            $product_to_price[$data["product_id"]]
        );

        try {
            if ($stmt->execute()) {
                echo json_encode([
                    "message" => "Item added to cart!",
                    "success" => true,
                ]);
            } else {
                echo json_encode([
                    "message" => "Failed to add the item",
                    "success" => false,
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                "message" => "Caught exception: " . $e->getMessage(),
                "success" => false,
            ]);
        }
    }
} catch (Exception $e) {
    echo json_encode([
        "message" => "Caught exception: " . $e->getMessage(),
        "success" => false,
    ]);
}
$stmt->close();
$conn->close();
}
?>
