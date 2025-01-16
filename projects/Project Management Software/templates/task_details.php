<?php
?>
<div class="task-details">
    <h4><?php echo htmlspecialchars($task['title']); ?></h4>
    <p><?php echo htmlspecialchars($task['description']); ?></p>
    
    <div class="mb-3">
        <strong>Created by:</strong> <?php echo htmlspecialchars($task['creator_name']); ?><br>
        <strong>Assigned to:</strong> 
        <?php echo $task['assignee_name'] ? htmlspecialchars($task['assignee_name']) : 'Unassigned'; ?><br>
        <strong>Status:</strong> 
        <?php
        $userLevel = $_SESSION['user']['level'];
        $isAssigned = $task['assignee_id'] === $_SESSION['user']['id'];

        // odreduva dostapni statusi zavisno od nivoto na korisnikot
        $allowedStatuses = array();
        if ($userLevel === 'Senior') {
            $allowedStatuses = array('To Do', 'In Progress', 'QA', 'Done');
        } elseif ($userLevel === 'Mid' && $isAssigned) {
            $allowedStatuses = array('In Progress', 'QA', 'Done');
        } elseif ($userLevel === 'Junior' && $isAssigned) {
            $allowedStatuses = array('In Progress', 'QA');
        }

        if (!empty($allowedStatuses)): ?>
            <form method="POST" action="../api/update_task_status.php">
                <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                <select name="status" class="form-control" onchange="this.form.submit()">
                    <?php foreach ($allowedStatuses as $status): ?>
                        <option value="<?php echo $status; ?>" 
                                <?php if ($task['status'] === $status) echo 'selected'; ?>>
                            <?php echo $status; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        <?php else: ?>
            <?php echo $task['status']; ?>
        <?php endif; ?>
    </div>

    <hr>
    <h5>Comments</h5>
    <div id="comments-list">
        <?php include 'comments_list.php'; ?>
    </div>

    <?php
    // proverka dali korisnikot moze da komentira
    $canComment = false;
    if ($userLevel === 'Senior') {
        $canComment = true;
    } elseif ($userLevel === 'Mid') {
        $canComment = $isAssigned || $task['assignee_level'] === 'Junior';
    } elseif ($userLevel === 'Junior') {
        $canComment = $isAssigned;
    }

    if ($canComment): ?>
        <form method="POST" action="../api/add_comment.php">
            <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
            <div class="mb-3">
                <textarea name="content" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Comment</button>
        </form>
    <?php endif; ?>
</div> 
