import './bootstrap';
let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

menu.onclick = () => {
    menu.classList.toglle('bx-x');
    navbar.classList.toglle('active');
}
window.onscroll = () => {
    menu.classList.remove('bx-x');
    navbar.classList.remove('active');
}
const sr = ScrollReveal ({
    disytance: '60px',
    duration: 2500,
    delay: 400,
    reset: true
})
sr.rveal('.text',{delay: 200, origin:'top'})
sr.rveal('.form-container form',{delay: 800, origin:'left'})
sr.rveal('.heading',{delay: 800, origin:'top'})
sr.rveal('.ride-container .box',{delay: 600, origin:'top'})


