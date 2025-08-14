/*===== MENU SHOW =====*/
const showMenu = (toggleId, navId) => {
  const toggle = document.getElementById(toggleId),
        nav    = document.getElementById(navId);
  if (toggle && nav) {
    toggle.addEventListener('click', () => {
      nav.classList.toggle('show');
    });
  }
};
showMenu('nav-toggle','nav-menu');

/*===== SCROLL ACTIVE LINK =====*/
const sections = document.querySelectorAll('section[id]');
function scrollActive() {
  const scrollY = window.pageYOffset;
  sections.forEach(current => {
    const sectionHeight = current.offsetHeight;
    const sectionTop    = current.offsetTop - 50;
    const sectionId     = current.getAttribute('id');
    const link          = document.querySelector('.nav__menu a[href*=' + sectionId + ']');
    if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
      link.classList.add('active-link');
    } else {
      link.classList.remove('active-link');
    }
  });
}
window.addEventListener('scroll', scrollActive);

/*===== HEADER SHADOW & SHRINK ON SCROLL =====*/
window.addEventListener('scroll', () => {
  const header = document.getElementById('header');
  if (window.scrollY > 50) {
    header.style.boxShadow = '0 1px 6px rgba(0,0,0,0.1)';
    header.style.height    = '3.5rem';
  } else {
    header.style.boxShadow = 'none';
    header.style.height    = '3rem';
  }
});

/*===== TYPED JS =====*/
document.addEventListener('DOMContentLoaded', () => {
  new Typed('.home__title-color + span', {
    strings: ['Web Developer','Problem Solver','Tech Enthusiast'],
    typeSpeed: 100,
    backSpeed: 50,
    backDelay: 2000,
    loop: true
  });
});

/*===== SCROLLREVEAL ANIMATION =====*/
document.addEventListener('DOMContentLoaded', () => {
  const sr = ScrollReveal({
    origin: 'top',
    distance: '60px',
    duration: 1500,
    reset: false
  });
  sr.reveal('.home__data, .about__img, .skills__container, .contact__form', { interval: 200 });
  sr.reveal('.home__img, .about__text, .work__img', { interval: 200, origin: 'right' });
});
