
<?php

require_once __DIR__ . '/includes/db.php';

$pageTitle = "Manage Departments";

try {
    $stmt = $pdo->query(
        "SELECT id, department_name, description
         FROM departments
         ORDER BY id"
    );
    $departments = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log('Failed to load departments: ' . $e->getMessage());
    $departments = [];
    $errorMessage = 'Unable to load departments. Please try again later.';
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
        <p>Department Management</p>
    </header>

    <main>
        <p><a href="index.php">← Back to Dashboard</a></p>

        <h2>Manage Departments</h2>
        <p>View and manage office departments.</p>

        <h3>Department List</h3>

        <?php if (isset($errorMessage)): ?>
            <p><?php echo htmlspecialchars($errorMessage); ?></p>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Department Name</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($departments)): ?>
                    <tr>
                        <td colspan="3">No departments found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($departments as $department): ?>
                        <tr>
                            <td><?php echo htmlspecialchars((string) $department['id']); ?></td>
                            <td><?php echo htmlspecialchars($department['department_name']); ?></td>
                            <td><?php echo htmlspecialchars($department['description'] ?? ''); ?></td>
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
