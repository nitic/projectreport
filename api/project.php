<?php
session_start();
require_once '../config/database.php';

/* Project Table */

/*=============================================================================================
ฟังก์ชัน CRUD
==============================================================================================*/

// สร้างข้อมูลใหม่
function insert($data) {
    global $pdo;
    try {
        $sql = "INSERT INTO project (project_name, project_detail, project_strategic, project_type, project_status, 
        implement_date, project_location, project_person, project_objectives, plan_status, budget_cash, budget_kind, 
        budget_source, budget_received, budget_pay, budget_plan, budget_output, budget_code, participants, output_type, output_result, 
        output_satisfaction, success_indicators, outcomes, impacts, problems, solution, work_continued, report_analysis, 
        report_file, file_upload, created_by) VALUES (:project_name, :project_detail, :project_strategic, 
        :project_type, :project_status, :implement_date, :project_location, :project_person, :project_objectives, 
        :plan_status, :budget_cash, :budget_kind, :budget_source, :budget_received, :budget_pay, :budget_plan, :budget_output, 
        :budget_code, :participants, :output_type, :output_result, :output_satisfaction, :success_indicators, :outcomes, 
        :impacts, :problems, :solution, :work_continued, :report_analysis, :report_file, :file_upload, :created_by)";
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
            $sql = "SELECT * FROM project WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT * FROM project";
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
        $sql = "UPDATE project SET project_name = :project_name, project_detail = :project_detail, 
        project_strategic = :project_strategic, project_type = :project_type, project_status = :project_status, 
        implement_date = :implement_date, project_location = :project_location, project_person = :project_person, 
        project_objectives = :project_objectives, plan_status = :plan_status, budget_cash = :budget_cash, 
        budget_kind = :budget_kind, budget_source = :budget_source, budget_received = :budget_received, 
        budget_pay = :budget_pay, budget_plan = :budget_plan, budget_output = :budget_output, budget_code = :budget_code,  
        participants = :participants, output_type = :output_type, output_result = :output_result, output_satisfaction = :output_satisfaction, 
        success_indicators = :success_indicators, outcomes = :outcomes, impacts = :impacts, problems = :problems, solution = :solution, 
        work_continued = :work_continued, report_analysis = :report_analysis, report_file = :report_file, file_upload = :file_upload, 
        created_by = :created_by WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $data['id'] = $id;
        $stmt->execute($data);
        return ['status' => 'success', 'message' => 'project updated'];
    } catch (PDOException $e) {
        return ['status' => 'error', 'message' => $e->getMessage()];
    }
}

// ลบข้อมูล
function delete($id) {
    global $pdo;
    try {
        $sql = "DELETE FROM project WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return ['status' => 'success', 'message' => 'project deleted'];
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
            echo json_encode(insert($input));
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
