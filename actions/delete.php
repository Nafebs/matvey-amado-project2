<?php
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ids'])) {
    try {
        $db = Database::getInstance()->getConnection();
        $ids = explode(",", $_POST['ids']);

        if (!empty($ids)) {
            $placeholders = implode(',', array_fill(0, count($ids), '?'));
            $stmt = $db->prepare("DELETE FROM students WHERE id IN ($placeholders)");
            $stmt->execute($ids);
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Нет выбранных учеников"]);
        }
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
}
?>
