class TaskModel {
    public function getUsersWithTasks($sortBy = null) {
        $orderClause = '';

        // Define sorting logic
        if ($sortBy === 'prioritylow') {
            $orderClause = 'ORDER BY priority ASC';
        } elseif ($sortBy === 'priorityhigh') {
            $orderClause = 'ORDER BY priority DESC';
        } elseif ($sortBy === 'prioritymed') {
            $orderClause = 'ORDER BY priority = "Medium" DESC';
        }

        // Fetch data from the database
        $query = "SELECT username, email, task_id, title, due_date, reminder, priority, category, completed_task, flag, task_created_at 
                  FROM users_tasks $orderClause";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
