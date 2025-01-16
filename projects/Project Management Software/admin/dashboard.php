<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user']) || !$_SESSION['user']['is_admin']) {
    header('Location: ../auth/login.php');
    exit;
}

$sql = "SELECT * FROM users WHERE is_approved = 0";
$stmt = $conn->query($sql);
$pendingUsers = $stmt->fetchAll();

$sql = "SELECT * FROM users WHERE id != " . $_SESSION['user']['id'];
$stmt = $conn->query($sql);
$allUsers = $stmt->fetchAll();

$sql = "SELECT projects.*, users.name as team_lead_name 
        FROM projects 
        LEFT JOIN users ON projects.team_lead_id = users.id";
$stmt = $conn->query($sql);
$allProjects = $stmt->fetchAll();

$sql = "SELECT * FROM users WHERE level = 'Senior' AND is_team_lead = 1";
$stmt = $conn->query($sql);
$teamLeads = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - ManageTasks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Pending User Approvals</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pendingUsers as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['name']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo $user['level']; ?></td>
                                <td>
                                    <form style="display: inline" method="POST" action="api/approve_user.php">
                                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                    </form>
                                    <form style="display: inline" method="POST" action="api/reject_user.php">
                                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <h5>User Management</h5>
                <button class="btn btn-primary" onclick="document.getElementById('createUserForm').style.display='block'">
                    Create User
                </button>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Team Lead</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allUsers as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['name']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo $user['level']; ?></td>
                                <td>
                                    <?php if ($user['level'] === 'Senior'): ?>
                                        <form method="POST" action="api/toggle_team_lead.php">
                                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                            <input type="checkbox" name="is_team_lead" value="1" 
                                                   <?php echo $user['is_team_lead'] ? 'checked' : ''; ?>
                                                   onchange="this.form.submit()">
                                        </form>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <form method="POST" action="api/delete_user.php" style="display: inline"
                                          onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <h5>Project Management</h5>
                <button class="btn btn-primary" onclick="document.getElementById('createProjectForm').style.display='block'">
                    Create Project
                </button>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Team Lead</th>
                            <th>Deadline</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allProjects as $project): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($project['title']); ?></td>
                                <td><?php echo htmlspecialchars($project['team_lead_name']); ?></td>
                                <td><?php echo $project['deadline']; ?></td>
                                <td>
                                    <a href="../project.php?id=<?php echo $project['id']; ?>" 
                                       class="btn btn-info btn-sm">View</a>
                                    <form method="POST" action="api/delete_project.php" style="display: inline"
                                          onsubmit="return confirm('Are you sure you want to delete this project?');">
                                        <input type="hidden" name="project_id" value="<?php echo $project['id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="createUserForm" style="display: none;" class="card mb-4">
            <div class="card-header">
                <h5>Create New User</h5>
                <button type="button" class="btn-close" 
                        onclick="document.getElementById('createUserForm').style.display='none'"></button>
            </div>
            <div class="card-body">
                <form method="POST" action="api/create_user.php">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Level</label>
                        <select name="level" class="form-control" required>
                            <option value="Junior">Junior</option>
                            <option value="Mid">Mid</option>
                            <option value="Senior">Senior</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create User</button>
                </form>
            </div>
        </div>
        <div id="createProjectForm" style="display: none;" class="card mb-4">
            <div class="card-header">
                <h5>Create New Project</h5>
                <button type="button" class="btn-close" 
                        onclick="document.getElementById('createProjectForm').style.display='none'"></button>
            </div>
            <div class="card-body">
                <form method="POST" action="api/create_project.php">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Requirements</label>
                        <textarea name="requirements" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Estimated Completion Date</label>
                        <input type="date" name="estimated_completion" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deadline</label>
                        <input type="date" name="deadline" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Team Lead</label>
                        <select name="team_lead_id" class="form-control" required>
                            <option value="">Select Team Lead</option>
                            <?php foreach ($teamLeads as $lead): ?>
                                <option value="<?php echo $lead['id']; ?>">
                                    <?php echo htmlspecialchars($lead['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Project</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>