<?php
require_once '../../config/db.php';

class DeptController {
    public function getDepartments() {
        try {
            $db = new Database();
            $pdo = $db->connect();
            $stmt = $pdo->query("SELECT id, short_name, full_name FROM departments");
            $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return ['success' => true, 'departments' => $departments];
        } catch (Exception $e) {
            return ['success' => false, 'error' => 'Failed to fetch departments', 'details' => $e->getMessage()];
        }
    }
}
