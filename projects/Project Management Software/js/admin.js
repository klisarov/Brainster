import { Api } from './modules/api.js';
import { Modal } from './modules/modal.js';

class Admin {
    constructor() {
        this.initializeEventListeners();
    }

    initializeEventListeners() {
        // kopcinja za potvrda na clen
        document.querySelectorAll('.approve-btn').forEach(btn => {
            btn.addEventListener('click', () => this.handleApproveUser(btn.dataset.userId));
        });

        document.querySelectorAll('.reject-btn').forEach(btn => {
            btn.addEventListener('click', () => this.handleRejectUser(btn.dataset.userId));
        });

        // team lead
        document.querySelectorAll('.team-lead-toggle').forEach(toggle => {
            toggle.addEventListener('change', (e) => 
                this.handleTeamLeadToggle(e.target.dataset.userId, e.target.checked));
        });

        // kopcinja za brisenje
        document.querySelectorAll('.delete-user-btn').forEach(btn => {
            btn.addEventListener('click', () => this.handleDeleteUser(btn.dataset.userId));
        });

        document.querySelectorAll('.delete-project-btn').forEach(btn => {
            btn.addEventListener('click', () => this.handleDeleteProject(btn.dataset.projectId));
        });
    }

    async handleApproveUser(userId) {
        if (!confirm('Are you sure you want to approve this user?')) return;

        try {
            const response = await fetch('api/approve_user.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `user_id=${userId}`
            });
            const result = await response.json();
            
            if (result.success) {
                location.reload();
            }
        } catch (error) {
            alert('Error approving user');
        }
    }

    async handleRejectUser(userId) {
        if (!confirm('Are you sure you want to reject this user?')) return;

        try {
            const response = await fetch('api/reject_user.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `user_id=${userId}`
            });
            const result = await response.json();
            
            if (result.success) {
                location.reload();
            }
        } catch (error) {
            alert('Error rejecting user');
        }
    }

    async handleTeamLeadToggle(userId, isTeamLead) {
        try {
            const response = await fetch('api/toggle_team_lead.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `user_id=${userId}&is_team_lead=${isTeamLead}`
            });
            const result = await response.json();
            
            if (!result.success) {
                alert(result.message);
                location.reload();
            }
        } catch (error) {
            alert('Error updating team lead status');
        }
    }

    async handleDeleteUser(userId) {
        if (!confirm('Are you sure you want to delete this user?')) return;

        try {
            const response = await fetch('api/delete_user.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `user_id=${userId}`
            });
            const result = await response.json();
            
            if (result.success) {
                location.reload();
            } else {
                alert(result.message || 'Failed to delete user');
            }
        } catch (error) {
            alert('Error deleting user');
        }
    }

    async handleDeleteProject(projectId) {
        if (!confirm('Are you sure you want to delete this project?')) return;

        try {
            const response = await fetch('api/delete_project.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `project_id=${projectId}`
            });
            const result = await response.json();
            
            if (result.success) {
                location.reload();
            }
        } catch (error) {
            alert('Error deleting project');
        }
    }
}

new Admin();