<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

require "db.php";

$data = json_decode(file_get_contents("php://input"), true);
$name = $data["name"];
$email = $data["email"];
$username = $data["username"];
$contact = $data["contact"];
$password = $data["password"];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$check_if_exists = "SELECT * FROM users WHERE username = ? OR email = ?";

$stmt = $conn->prepare($check_if_exists);
$stmt->bind_param("ss", $username, $email);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        if ($row["username"] == $username) {
            echo json_encode([
                "message" => "Username already exists!",
                "success" => false,
            ]);
        } elseif ($row["email"] == $email) {
            echo json_encode([
                "message" => "Email already exists!",
                "success" => false,
            ]);
            exit();
        }
    }
            $insert_user =
                "INSERT INTO users (name, email, username, contact, password) VALUES (?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($insert_user);
            $stmt->bind_param(
                "sssss",
                $name,
                $email,
                $username,
                $contact,
                $hashed_password
            );

                if ($stmt->execute()) {
                    echo json_encode([
                        "message" => "Sign up Successful!",
                        "success" => true,
                    ]);
                } else {
                    echo json_encode([
                        "message" => "Sign up Failed!",
                        "success" => false,
                    ]);
                }
            $stmt->close();
            $conn->close();
} else {
    echo json_encode([
        "message" => "Server Error!",
        "success" => false,
    ]);
}

?>
