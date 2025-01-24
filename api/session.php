<?php
session_start();

if (isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'success', 'message' => 'User is logged in', 'user_id' => $_SESSION['user_id']]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'User is not logged in']);
}
?>
