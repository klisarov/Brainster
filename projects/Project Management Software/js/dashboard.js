import { Api } from './modules/api.js';
import { Modal } from './modules/modal.js';

class Dashboard {
    constructor() {
        this.initializeEventListeners();
    }

    initializeEventListeners() {
        // kreiranje na proekt
        const createProjectForm = document.getElementById('createProjectForm');
        if (createProjectForm) {
            createProjectForm.addEventListener('submit', this.handleCreateProject);
        }

        // kopcinja 
        const taskButtons = document.querySelectorAll('.view-task-btn');
        taskButtons.forEach(button => {
            button.addEventListener('click', () => this.handleViewTask(button.dataset.id));
        });
    }

    async handleCreateProject(event) {
        event.preventDefault();
        const formData = new FormData(event.target);
        const data = Object.fromEntries(formData);

        try {
            const response = await fetch('api/create_project.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            
            if (result.success) {
                location.reload();
            } else {
                alert('Failed to create project');
            }
        } catch (error) {
            alert('Error creating project');
        }
    }

    async handleViewTask(taskId) {
        try {
            const response = await fetch(`api/get_task.php?id=${taskId}`);
            const result = await response.json();
            
            if (result.success) {
                document.getElementById('taskDetails').innerHTML = result.html;
                Modal.show('taskModal');
            }
        } catch (error) {
            alert('Error loading task');
        }
    }
}

new Dashboard();