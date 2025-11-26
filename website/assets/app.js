function addMemberRow() {
    const container = document.getElementById('members-container');
    if (!container) return;

    const div = document.createElement('div');
    div.className = 'member-row';
    div.innerHTML = `
        <input type="text" name="member_name[]" placeholder="Nom du membre">
        <input type="email" name="member_email[]" placeholder="Email du membre">
    `;
    container.appendChild(div);
}

function addTaskRow() {
    const container = document.getElementById('tasks-container');
    if (!container) return;

    const div = document.createElement('div');
    div.className = 'task-row';
    div.innerHTML = `
        <input type="text" name="task_title[]" placeholder="Titre de la tâche">
        <input type="email" name="task_assigned_to[]" placeholder="Email de la personne responsable (facultatif)">
    `;
    container.appendChild(div);
}

function toggleInviteLink() {
    const box = document.getElementById('invite-link-box');
    if (!box) return;

    if (box.style.display === 'none' || box.style.display === '') {
        box.style.display = 'block';
    } else {
        box.style.display = 'none';
    }
}