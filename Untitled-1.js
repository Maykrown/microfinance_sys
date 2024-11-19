// script.js

// Initialize the database
const db = {
    employees: [],
    jobs: [],
    skills: [],
    qualifications: []
};

// Function to add employee
function addEmployee(name, email, phone, address) {
    const employee = {
        id: db.employees.length + 1,
        name,
        email,
        phone,
        address
    };
    db.employees.push(employee);
    return employee;
}

// Function to add job
function addJob(title, description, employeeId) {
    const job = {
        id: db.jobs.length + 1,
        title,
        description,
        employeeId
    };
    db.jobs.push(job);
    return job;
}

// Function to add skill
function addSkill(name, employeeId) {
    const skill = {
        id: db.skills.length + 1,
        name,
        employeeId
    };
    db.skills.push(skill);
    return skill;
}

// Function to add qualification
function addQualification(name, employeeId) {
    const qualification = {
        id: db.qualifications.length + 1,
        name,
        employeeId
    };
    db.qualifications.push(qualification);
    return qualification;
}

// Function to display employees
function displayEmployees() {
    const employeesTableBody = document.getElementById('employees-table-body');
    employeesTableBody.innerHTML = '';
    db.employees.forEach(employee => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${employee.id}</td>
            <td>${employee.name}</td>
            <td>${employee.email}</td>
            <td>${employee.phone}</td>
            <td>${employee.address}</td>
        `;
        employeesTableBody.appendChild(row);
    });
}

// Function to display jobs
function displayJobs() {
    const jobsTableBody = document.getElementById('jobs-table-body');
    jobsTableBody.innerHTML = '';
    db.jobs.forEach(job => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${job.id}</td>
            <td>${job.title}</td>
            <td>${job.description}</td>
            <td>${job.employeeId}</td>
        `;
        jobsTableBody.appendChild(row);
    });
}

// Function to display skills
function displaySkills() {
    const skillsTableBody = document.getElementById('skills-table-body');
    skillsTableBody.innerHTML = '';
    db.skills.forEach(skill => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${skill.id}</td>
            <td>${skill.name}</td>
            <td>${skill.employeeId}</td>
        `;
        skillsTableBody.appendChild(row);
    });
}

// Function to display qualifications
function displayQualifications() {
    const qualificationsTableBody = document.getElementById('qualifications-table-body');
    qualificationsTableBody.innerHTML = '';
    db.qualifications.forEach(qualification => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${qualification.id}</td>
            <td>${qualification.name}</td>
            <td>${qualification.employeeId}</td>
        `;
        qualificationsTableBody.appendChild(row);
    });
}

// Add event listeners to buttons
document.addEventListener('DOMContentLoaded', () => {
    // Add employee button
    const addEmployeeButton = document.getElementById('add-employee-button');
    addEmployeeButton.addEventListener('click', () => {
        const name = document.getElementById('employee-name').value;
        const email = document.getElementById('employee-email').value;
        const phone = document.getElementById('employee-phone').value;
        const address = document.getElementById('employee-address').value;
        const employee = addEmployee(name, email, phone, address);
        displayEmployees();
    });

    // Add job button
    const addJobButton = document.getElementById('add-job-button');
    addJobButton.addEventListener('click', () => {
        const title = document.getElementById('job-title').value;
        const description = document.getElementById('job-description').value;
        const employeeId = document.getElementById('job-employee-id').value;
        const job = addJob(title, description, employeeId);
        displayJobs();
    });

    // Add skill button
    const addSkillButton = document.getElementById('add-skill-button');
    addSkillButton.addEventListener('click', () => {
        const name = document.getElementById('skill-name').value;
        const employeeId = document.getElementById('skill-employee-id').value;
        const skill = addSkill(name, employeeId);
        displaySkills();
    });

    // Add qualification button
    const addQualificationButton = document.getElementById('add-qualification-button');
    addQualificationButton.addEventListener('click', () => {
        const name = document.getElementById('qualification-name').value;
        const employeeId = document.getElementById('qualification-employee-id').value;
        const qualification = addQualification(name, employeeId);
        displayQualifications();
    });
});