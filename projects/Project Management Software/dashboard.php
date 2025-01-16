<?php
session_start();
require_once 'config/database.php';

if (!isset($_SESSION['user'])) {
    header('Location: auth/login.php');
    exit;
}

$user = $_SESSION['user'];

// gi zema proektite na korisnikot
if ($user['is_team_lead']) {
    $sql = "SELECT * FROM projects WHERE team_lead_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user['id']]);
} else {
    $sql = "SELECT p.* FROM projects p, teams t 
            WHERE p.id = t.project_id AND t.user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user['id']]);
}
$projects = $stmt->fetchAll();

// gi zema zadacite na korisnikot
$sql = "SELECT t.*, p.title as project_title 
        FROM tasks t, projects p 
        WHERE t.project_id = p.id AND t.assignee_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$user['id']]);
$assignedTasks = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - ManageTasks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h2>My Projects</h2>
                <?php if ($user['is_team_lead']): ?>
                    <form method="POST" action="project.php">
                        <button type="button" class="btn btn-primary mb-3" 
                                onclick="document.getElementById('createProjectForm').style.display='block'">
                            Create Project
                        </button>
                    </form>
                <?php endif; ?>

                <?php foreach ($projects as $project): ?>
                    <div class="project-card">
                        <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                        <p><?php echo htmlspecialchars($project['description']); ?></p>
                        <p>Deadline: <?php echo date('Y-m-d', strtotime($project['deadline'])); ?></p>
                        <a href="project.php?id=<?php echo $project['id']; ?>" 
                           class="btn btn-primary">View Project</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <h2>My Tasks</h2>
                <?php foreach ($assignedTasks as $task): ?>
                    <div class="task-card">
                        <h4><?php echo htmlspecialchars($task['title']); ?></h4>
                        <p>Project: <?php echo htmlspecialchars($task['project_title']); ?></p>
                        <p>Status: <?php echo $task['status']; ?></p>
                        <form method="GET" action="project.php" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $task['project_id']; ?>">
                            <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                            <button type="submit" class="btn btn-info">View Task</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div id="createProjectForm" style="display: none;" class="mt-4">
            <h3>Create New Project</h3>
            <form method="POST" action="api/create_project.php">
                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label>Requirements</label>
                    <textarea name="requirements" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label>Estimated Completion</label>
                    <input type="date" name="estimated_completion" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Deadline</label>
                    <input type="date" name="deadline" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Create Project</button>
                <button type="button" class="btn btn-secondary" 
                        onclick="document.getElementById('createProjectForm').style.display='none'">
                    Cancel
                </button>
            </form>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html> 