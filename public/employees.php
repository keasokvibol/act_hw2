
<?php

require_once __DIR__ . '/includes/db.php';

$pageTitle = "Manage Employees";

try {
    $stmt = $pdo->query(
        "SELECT
            e.id,
            e.employee_name,
            e.email,
            d.department_name
         FROM employees e
         LEFT JOIN departments d ON e.department_id = d.id
         ORDER BY e.id"
    );

    $employees = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log('Failed to load employees: ' . $e->getMessage());
    $employees = [];
    $errorMessage = 'Unable to load employees. Please try again later.';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?> - IQA Office</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>IQA Office Management System</h1>
        <p>Employee Management</p>
    </header>

    <main>
        <p><a href="index.php">← Back to Dashboard</a></p>

        <h2>Manage Employees</h2>
        <p>View and manage office employees.</p>

        <h3>Employee List</h3>

        <?php if (isset($errorMessage)): ?>
            <p><?php echo htmlspecialchars($errorMessage); ?></p>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee Name</th>
                    <th>Email</th>
                    <th>Department</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($employees)): ?>
                    <tr>
                        <td colspan="4">No employee records found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($employees as $employee): ?>
                        <tr>
                            <td><?php echo htmlspecialchars((string) $employee['id']); ?></td>
                            <td><?php echo htmlspecialchars($employee['employee_name']); ?></td>
                            <td><?php echo htmlspecialchars($employee['email'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($employee['department_name'] ?? 'Unassigned'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </main>

    <footer>
        <p>© VIBOL 2026 - IQA Office Management System</p>
    </footer>
</body>
</html>
