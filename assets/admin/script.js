
function toggleSection(sectionId) {
  const section = document.getElementById(sectionId);
  const parentLi = section.parentElement;

  if (parentLi.classList.contains("open")) {
    parentLi.classList.remove("open");
  } else {
    document
      .querySelectorAll(".sidebar ul li")
      .forEach((li) => li.classList.remove("open"));
    parentLi.classList.add("open");
  }
}

function toggleUserDropdown() {
  const dropdown = document.getElementById("user-dropdown");
  dropdown.classList.toggle("open");
}

function toggleForm(formId) {
  const forms = document.querySelectorAll(".content-body > div");
  forms.forEach((form) => {
    if (form.id === formId) {
      form.classList.remove("hidden");
    } else {
      form.classList.add("hidden");
    }
  });
}

// Render all records by default
document.addEventListener("DOMContentLoaded", () => {
  document.getElementById("buses-table").classList.remove("hidden");
  document.getElementById("packages-table").classList.remove("hidden");
  document.getElementById("tours-table").classList.remove("hidden");
});
function toggleSidebar() {
  const sidebar = document.querySelector(".sidebar");
  sidebar.classList.toggle("open");
}

// Function to toggle the sidebar
function toggleSidebar() {
  const sidebar = document.querySelector(".sidebar");
  const isSidebarOpen = sidebar.classList.contains("open");

  if (isSidebarOpen) {
    sidebar.classList.remove("open");
    localStorage.setItem("sidebarState", "closed");
  } else {
    sidebar.classList.add("open");
    localStorage.setItem("sidebarState", "open");
  }
}

// Function to close the sidebar
function closeSidebar() {
  const sidebar = document.querySelector(".sidebar");
  sidebar.classList.remove("open");
  localStorage.setItem("sidebarState", "closed");
}

// Load the sidebar state from localStorage when the page loads
document.addEventListener("DOMContentLoaded", () => {
  const sidebarState = localStorage.getItem("sidebarState");
  const sidebar = document.querySelector(".sidebar");

  if (sidebarState === "open") {
    sidebar.classList.add("open");
  } else {
    sidebar.classList.remove("open");
  }
});
