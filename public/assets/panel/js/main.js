"use strict";

// navbar vars

const sidebar = document.querySelector("nav");
const sidebarToggle = document.querySelector(".sidebar-toggle");

sidebarToggle.addEventListener("click", () => {
  sidebar.classList.toggle("close");
});

const modeToggle = document.querySelector(".mode-toggle");
modeToggle.addEventListener("click", function () {
  let dataTheme = window.localStorage.getItem("data-theme");
  if (!dataTheme)
    window.localStorage.setItem("data-theme", "dark");
  else {
    dataTheme === "dark" ? window.localStorage.setItem("data-theme", "light") : window.localStorage.setItem("data-theme", "dark");
  }
  document.body.classList.toggle("theme-light");
  document.body.classList.toggle("theme-dark");
});

let dataTheme = window.localStorage.getItem("data-theme");
if (dataTheme) {
  if (dataTheme === "dark") {
    document.body.classList.remove('theme-light');
    document.body.classList.add('theme-dark');
  } else {
    document.body.classList.remove('theme-dark');
    document.body.classList.add('theme-light');
  }
}
