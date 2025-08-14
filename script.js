
var typed = new Typed(".multiple-text", {
  strings: ["Web Designer", "App Developer", "Problem Solver", "Freelancer","Data Analyist"],
  typeSpeed: 80,
  backSpeed: 80,
  backDelay: 1500,
  loop: true
});


  let menuIcon = document.querySelector("#menu-icon");
  let navbar = document.querySelector(".navbar");
  
  menuIcon.onclick = () => {
    menuIcon.classList.toggle("bx-x");
    navbar.classList.toggle("active");
  };
  

  document.querySelectorAll(".navbar a").forEach((link) =>
    link.addEventListener("click", () => {
      menuIcon.classList.remove("bx-x");
      navbar.classList.remove("active");
    })
  );
  document.querySelectorAll('.skill-per').forEach(el => {
      el.style.width = el.getAttribute('data-per');
    });
    // highlight nav link on scroll
const sections = document.querySelectorAll('section[id]');
const navLinks = document.querySelectorAll('.navbar a');

window.addEventListener('scroll', () => {
  const scrollY = window.pageYOffset;
  sections.forEach(sec => {
    const top    = sec.offsetTop - 80;       // adjust for header height
    const height = sec.offsetHeight;
    const id     = sec.getAttribute('id');

    if (scrollY >= top && scrollY < top + height) {
      navLinks.forEach(link => {
        link.classList.toggle(
          'active',
          link.getAttribute('href') === `#${id}`
        );
      });
    }
  });
});
// script.js

document.addEventListener('DOMContentLoaded', () => {
  const skillsSection = document.getElementById('skills');
  const bars          = document.querySelectorAll('.skill-per');


  const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        bars.forEach(bar => {
          const pct = bar.getAttribute('data-per');
          bar.style.width = pct;     // triggers the CSS transition
        });
        obs.unobserve(skillsSection);
      }
    });
  }, { threshold: 0.3 });  // 30% of the section visible

  observer.observe(skillsSection);
});
