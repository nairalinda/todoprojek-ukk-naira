<?php
include 'config.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $task_id = $_GET['id'];
    $status = $_GET['status'];

    // Upadate status tugas utama
    $query ="UPDATE tasks SET taskstatus = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $task_id);
    $success = $stmt->execute();

    // Update status tugas utama
    if ($success) {
    $query_subtasks ="UPDATE subtasks SET status = ? WHERE taks_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $task_id);
    $stmt->execute();
    }

    echo json_encode(value: ["success" => $success]);
} else {
    echo json_encode(value: ["success" => false]);
}
?>
