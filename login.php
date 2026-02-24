<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

require "db.php";

session_start();

$data = json_decode(file_get_contents("php://input"), true);
$username = $data["username"];
$password = $data["password"];

$retrieve_user = "SELECT * FROM users WHERE (username = ? OR email = ?)";

$stmt = $conn->prepare($retrieve_user);
$stmt->bind_param("ss", $username, $username);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row["password"])) {
            $_SESSION["user_id"] = $row["user_pid"];
            $_SESSION["name"] = $row["name"];
            $_SESSION["username"] = $row["username"];
            echo json_encode([
                "success" => true,
                "message" => "Login Successful!",
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Invalid Credentials!",
            ]);
        }
    } else {
        echo json_encode([
            "message" => "User not found!",
            "success" => false,
        ]);
    }
} else {
    echo "Error retrieving user";
}
?>
