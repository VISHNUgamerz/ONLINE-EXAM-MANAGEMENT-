<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "cee_db";

try {
    $conn = new PDO("mysql:host={$host};dbname={$db};", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["answerId"])) {
    $answerId = $_GET["answerId"];

    try {
        $stmt = $conn->prepare("CALL examat_id(?, @exam_ans)");
        $stmt->bindParam(1, $answerId, PDO::PARAM_STR);
        $stmt->execute();

        $result = $conn->query("SELECT @exam_ans AS exam_ans");
        $row = $result->fetch(PDO::FETCH_ASSOC);
        if ($row && isset($row["exam_ans"])) {
            echo "Answer: " . $row["exam_ans"];
        } else {
            echo "Answer not found";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request";
}

// Close the database connection
$conn = null;
?>
