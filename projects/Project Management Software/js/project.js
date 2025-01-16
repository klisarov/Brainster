import { Api } from './modules/api.js';
import { Modal } from './modules/modal.js';

class Project {
    constructor() {
        this.initializeEventListeners();
    }

    initializeEventListeners() {
        const createTaskForm = document.getElementById('createTaskForm');
        if (createTaskForm) {
            createTaskForm.addEventListener('submit', this.handleCreateTask);
        }

        // dodavanje na clen
        const addMemberForm = document.getElementById('addMemberForm');
        if (addMemberForm) {
            addMemberForm.addEventListener('submit', this.handleAddMember);
        }

        // promena na status
        const statusSelects = document.querySelectorAll('.task-status-select');
        statusSelects.forEach(select => {
            select.addEventListener('change', (e) => 
                this.handleStatusChange(e.target.dataset.taskId, e.target.value));
        });

        // komentari
        const commentForm = document.getElementById('commentForm');
        if (commentForm) {
            commentForm.addEventListener('submit', this.handleAddComment);
        }
    }

    async handleCreateTask(event) {
        event.preventDefault();
        const formData = new FormData(event.target);

        try {
            const response = await fetch('api/create_task.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            
            if (result.success) {
                location.reload();
            } else {
                alert('Failed to create task');
            }
        } catch (error) {
            alert('Error creating task');
        }
    }

    async handleAddMember(event) {
        event.preventDefault();
        const formData = new FormData(event.target);

        try {
            const response = await fetch('api/add_team_member.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            
            if (result.success) {
                location.reload();
            } else {
                alert('Failed to add member');
            }
        } catch (error) {
            alert('Error adding member');
        }
    }

    async handleStatusChange(taskId, newStatus) {
        try {
            const response = await fetch('api/update_task_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `task_id=${taskId}&status=${newStatus}`
            });
            const result = await response.json();
            
            if (result.success) {
                location.reload();
            } else {
                alert('Failed to update status');
            }
        } catch (error) {
            alert('Error updating status');
        }
    }

    async handleAddComment(event) {
        event.preventDefault();
        const formData = new FormData(event.target);

        try {
            const response = await fetch('api/add_comment.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            
            if (result.success) {
                location.reload();
            } else {
                alert('Failed to add comment');
            }
        } catch (error) {
            alert('Error adding comment');
        }
    }
}

new Project();