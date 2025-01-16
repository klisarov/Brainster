<?php
session_start();
require_once 'config/database.php';

if (!isset($_SESSION['user']) || !isset($_GET['id'])) {
    header('Location: dashboard.php');
    exit;
}

$user = $_SESSION['user'];
$projectId = (int)$_GET['id'];

// zema informacii za proektot
$sql = "SELECT * FROM projects WHERE id = '$projectId'";
$result = mysqli_query($conn, $sql);
$project = mysqli_fetch_assoc($result);

if (!$project) {
    header('Location: dashboard.php');
    exit;
}

// proverka dali korisnikot ima dozvola
$sql = "SELECT COUNT(*) as count FROM teams 
        WHERE project_id = '$projectId' AND user_id = '" . $user['id'] . "'";
$result = mysqli_query($conn, $sql);
$teamMember = mysqli_fetch_assoc($result)['count'] > 0;

$isTeamLead = ($user['is_team_lead'] === '1' && $project['team_lead_id'] === $user['id']);

if (!$teamMember && !$isTeamLead && !$user['is_admin']) {
    header('Location: dashboard.php');
    exit;
}

// zema clenovi na tim
$sql = "SELECT u.* FROM users u 
        INNER JOIN teams t ON u.id = t.user_id 
        WHERE t.project_id = '$projectId'";
$result = mysqli_query($conn, $sql);
$teamMembers = [];
while ($row = mysqli_fetch_assoc($result)) {
    $teamMembers[] = $row;
}

// zema zadaci
$sql = "SELECT t.*, c.name as creator_name, a.name as assignee_name, 
               a.level as assignee_level 
        FROM tasks t 
        LEFT JOIN users c ON t.creator_id = c.id 
        LEFT JOIN users a ON t.assignee_id = a.id 
        WHERE t.project_id = '$projectId'";
$result = mysqli_query($conn, $sql);
$allTasks = [];
while ($row = mysqli_fetch_assoc($result)) {
    $allTasks[] = $row;
}

$statusOptions = ['To Do', 'In Progress', 'QA', 'Done'];

// grupira zadaci spored status
$tasksByStatus = [];
foreach ($statusOptions as $status) {
    $tasksByStatus[$status] = [];
}
foreach ($allTasks as $task) {
    $tasksByStatus[$task['status']][] = $task;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($project['title']); ?> ManageTasks</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Project Details</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Title:</strong> <?php echo htmlspecialchars($project['title']); ?></p>
                        <p><strong>Description:</strong> <?php echo htmlspecialchars($project['description']); ?></p>
                        <p><strong>Requirements:</strong> <?php echo htmlspecialchars($project['requirements']); ?></p>
                        <p><strong>Deadline:</strong> <?php echo date('Y-m-d', strtotime($project['deadline'])); ?></p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5>Team Members</h5>
                    </div>
                    <div class="card-body">
                        <?php if ($isTeamLead): ?>
                            <form method="POST" action="api/add_team_member.php" class="mb-3">
                                <input type="hidden" name="project_id" value="<?php echo $projectId; ?>">
                                <div class="mb-3">
                                    <label>Add Member:</label>
                                    <select name="user_id" class="form-control" required>
                                        <option value="">Select User</option>
                                        <?php
                                        $sql = "SELECT * FROM users 
                                               WHERE id NOT IN (
                                                   SELECT user_id FROM teams 
                                                   WHERE project_id = '$projectId'
                                               ) AND is_approved = '1'";
                                        $result = mysqli_query($conn, $sql);
                                        while ($availableUser = mysqli_fetch_assoc($result)): 
                                        ?>
                                            <option value="<?php echo $availableUser['id']; ?>">
                                                <?php echo htmlspecialchars($availableUser['name']); ?> 
                                                (<?php echo $availableUser['level']; ?>)
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Member</button>
                            </form>
                        <?php endif; ?>

                        <ul class="list-group">
                            <?php foreach ($teamMembers as $member): ?>
                                <li class="list-group-item">
                                    <?php echo htmlspecialchars($member['name']); ?> 
                                    (<?php echo $member['level']; ?>)
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <?php if ($isTeamLead || $user['level'] === 'Senior'): ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Create New Task</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="api/create_task.php">
                                <input type="hidden" name="project_id" value="<?php echo $projectId; ?>">
                                <div class="mb-3">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label>Assign To</label>
                                    <select name="assignee_id" class="form-control">
                                        <option value="">Select Member</option>
                                        <?php 
                                        foreach ($teamMembers as $member):
                                            $canAssign = false;
                                            if ($isTeamLead) {
                                                $canAssign = true;
                                            } elseif ($user['level'] === 'Senior') {
                                                $canAssign = $member['level'] !== 'Senior';
                                            } elseif ($user['level'] === 'Mid') {
                                                $canAssign = $member['level'] === 'Junior';
                                            }
                                            if ($canAssign):
                                        ?>
                                            <option value="<?php echo $member['id']; ?>">
                                                <?php echo htmlspecialchars($member['name']); ?> 
                                                (<?php echo $member['level']; ?>)
                                            </option>
                                        <?php 
                                            endif;
                                        endforeach; 
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Create Task</button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <?php foreach ($tasksByStatus as $status => $tasks): ?>
                        <div class="col-md-3">
                            <div class="task-column">
                                <h5><?php echo htmlspecialchars($status); ?></h5>
                                <?php foreach ($tasks as $task): ?>
                                    <div class="task-card">
                                        <h6><?php echo htmlspecialchars($task['title']); ?></h6>
                                        <?php if ($task['assignee_name']): ?>
                                            <small>Assigned to: 
                                                <?php echo htmlspecialchars($task['assignee_name']); ?>
                                            </small>
                                        <?php endif; ?>
                                        <form method="GET" class="mt-2">
                                            <input type="hidden" name="id" value="<?php echo $projectId; ?>">
                                            <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                                            <button type="submit" class="btn btn-sm btn-info">View Details</button>
                                        </form>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <?php
        // pecati informacii za zadaca ako se dobie id za zadaca
        if (isset($_GET['task_id'])):
            $taskId = (int)$_GET['task_id'];
            
            $sql = "SELECT t.*, c.name as creator_name, a.name as assignee_name, 
                           a.level as assignee_level 
                    FROM tasks t 
                    LEFT JOIN users c ON t.creator_id = c.id 
                    LEFT JOIN users a ON t.assignee_id = a.id 
                    WHERE t.id = '$taskId'";
            $result = mysqli_query($conn, $sql);
            $task = mysqli_fetch_assoc($result);
            
            if ($task):
                // zema komentari
                $sql = "SELECT c.*, u.name as user_name, u.level as user_level 
                        FROM comments c 
                        LEFT JOIN users u ON c.user_id = u.id 
                        WHERE c.task_id = '$taskId' 
                        ORDER BY c.created_at ASC";
                $result = mysqli_query($conn, $sql);
                $comments = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $comments[] = $row;
                }
        ?>
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Task Details
                            <a href="project.php?id=<?php echo $projectId; ?>" 
                               class="btn btn-sm btn-secondary float-end">Close</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php include 'templates/task_details.php'; ?>
                    </div>
                </div>
        <?php
            endif;
        endif;
        ?>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
