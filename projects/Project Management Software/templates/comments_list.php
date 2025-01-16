<?php
if (empty($comments)): ?>
    <p class="text-muted">No comments yet</p>
<?php else:
    foreach ($comments as $comment): ?>
        <div class="comment" style="margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
            <p>
                <strong><?php echo htmlspecialchars($comment['user_name']); ?></strong>
                <span style="color: #666; font-size: 0.9em;">
                    <?php echo date('Y-m-d H:i', strtotime($comment['created_at'])); ?>
                    <?php if ($comment['is_edited']): ?>
                        (edited)
                    <?php endif; ?>
                </span>
            </p>
            
            <div class="comment-content">
                <?php echo htmlspecialchars($comment['content']); ?>
            </div>

            <?php if (!$comment['is_system_generated'] && 
                     ($comment['user_id'] === $_SESSION['user']['id'] || 
                      $_SESSION['user']['is_admin'])): ?>
                <div style="margin-top: 5px;">
                    <?php if ($comment['user_id'] === $_SESSION['user']['id']): ?>
                        <form method="POST" action="../api/update_comment.php" style="display: inline;">
                            <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                            <input type="hidden" name="current_content" 
                                   value="<?php echo htmlspecialchars($comment['content']); ?>">
                            <button type="submit" class="btn btn-sm btn-secondary">Edit</button>
                        </form>
                    <?php endif; ?>
                    
                    <form method="POST" action="../api/delete_comment.php" style="display: inline;">
                        <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                        <button type="submit" class="btn btn-sm btn-danger" 
                                onclick="return confirm('Are you sure?');">Delete</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach;
endif; ?>