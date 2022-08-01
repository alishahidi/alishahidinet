"use strict";

// navbar vars

const nav = document.querySelector(".mobile-nav");
const navMenuBtn = document.querySelector(".nav-menu-btn");
const navCloseBtn = document.querySelector(".nav-close-btn");


const navToggle = () => {
  nav.classList.toggle("active");
}

navMenuBtn.addEventListener("click", navToggle);
navCloseBtn.addEventListener("click", navToggle);


const themeBtn = document.querySelectorAll('.theme-btn');

[...themeBtn].map(btn => {
  btn.addEventListener('click', function () {
    let dataTheme = window.localStorage.getItem("data-theme");
    if(!dataTheme)
      window.localStorage.setItem("data-theme", "dark");
    else{
      dataTheme === "dark" ? window.localStorage.setItem("data-theme", "light") : window.localStorage.setItem("data-theme", "dark");
    }
    document.body.classList.toggle('theme-light');
    document.body.classList.toggle('theme-dark');
    [...themeBtn].map(btn1 => {
      btn1.classList.toggle('light');
      btn1.classList.toggle('dark');
    })
  })
})

let dataTheme = window.localStorage.getItem("data-theme");
if(dataTheme){
  if(dataTheme === "dark"){
    document.body.classList.remove('theme-light');
    document.body.classList.add('theme-dark');
    [...themeBtn].map(btn1 => {
      btn1.classList.remove('light');
      btn1.classList.add('dark');
    })
  }else{
    document.body.classList.remove('theme-dark');
    document.body.classList.add('theme-light');
    [...themeBtn].map(btn1 => {
      btn1.classList.remove('dark');
      btn1.classList.add('light');
    })
  }
}
