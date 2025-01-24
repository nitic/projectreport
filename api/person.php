<?php
session_start();
require_once '../config/database.php';

/* Person Table */

/*=============================================================================================
ฟังก์ชัน CRUD
==============================================================================================*/

// สร้างข้อมูลใหม่
function insert($data) {
    global $pdo;
    try {
        $sql = "INSERT INTO person (fullname, position, email, phone) VALUES (:fullname, :position, :email, :phone)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        return ['status' => 'success', 'id' => $pdo->lastInsertId()];
    } catch (PDOException $e) {
        return ['status' => 'error', 'message' => $e->getMessage()];
    }
}

// อ่านข้อมูลทั้งหมดหรือเฉพาะบุคคล
function get($id = null) {
    global $pdo;
    try {
        if ($id) {
            $sql = "SELECT * FROM person WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT * FROM person";
            $stmt = $pdo->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return ['status' => 'success', 'data' => $result];
    } catch (PDOException $e) {
        return ['status' => 'error', 'message' => $e->getMessage()];
    }
}

// อัปเดตข้อมูล
function update($id, $data) {
    global $pdo;
    try {
        $sql = "UPDATE person SET fullname = :fullname, position = :position, email = :email, phone = :phone WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $data['id'] = $id;
        $stmt->execute($data);
        return ['status' => 'success', 'message' => 'Person updated'];
    } catch (PDOException $e) {
        return ['status' => 'error', 'message' => $e->getMessage()];
    }
}

// ลบข้อมูล
function delete($id) {
    global $pdo;
    try {
        $sql = "DELETE FROM person WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return ['status' => 'success', 'message' => 'Person deleted'];
    } catch (PDOException $e) {
        return ['status' => 'error', 'message' => $e->getMessage()];
    }
}


/*=============================================================================================
การจัดการ Routing 
==============================================================================================*/

$requestMethod = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$id = array_shift($request);

    switch ($requestMethod) {
        case 'GET':
            echo json_encode(get($id));
            break;
        case 'POST':
            $input = json_decode(file_get_contents('php://input'), true);
            echo json_encode(['id' => insert($input)]);
            break;
        case 'PUT':
            $input = json_decode(file_get_contents('php://input'), true);
             echo json_encode(update($id, $input));
            break;
        case 'DELETE':
            echo json_encode(delete($id));
            break;
    }




?>
