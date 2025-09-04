/* Home Page Specific JavaScript */

// Navbar glassmorphism scroll effect
document.addEventListener('DOMContentLoaded', function() {
  const header = document.querySelector('.header');
  
  if (header) {
    window.addEventListener('scroll', function() {
      if (window.scrollY > 100) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });
  }
});

// Typed.js animation for multiple text effect
document.addEventListener('DOMContentLoaded', function() {
  // Check if the multiple-text element exists (only on home page)
  const multipleTextElement = document.querySelector(".multiple-text");
  
  if (multipleTextElement) {
    var typed = new Typed(".multiple-text", {
      strings: ["Web Designer", "App Developer", "Problem Solver", "Freelancer", "Data Analyst"],
      typeSpeed: 80,
      backSpeed: 80,
      backDelay: 1500,
      loop: true
    });
    
    // Track typing animation start (if cookies accepted)
    if (window.cookieConsent && window.cookieConsent.isEnabled()) {
      window.cookieConsent.track('typed_animation_started', {
        strings: ["Web Designer", "App Developer", "Problem Solver", "Freelancer", "Data Analyst"]
      });
    }
  }
});

// Skills animation when section comes into view
document.addEventListener('DOMContentLoaded', () => {
  const skillsSection = document.getElementById('skills');
  const bars = document.querySelectorAll('.skill-per');

  // Only run if skills section exists
  if (skillsSection && bars.length > 0) {
    const observer = new IntersectionObserver((entries, obs) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          bars.forEach(bar => {
            const pct = bar.getAttribute('data-per');
            bar.style.width = pct; // triggers the CSS transition
          });
          obs.unobserve(skillsSection);
        }
      });
    }, { threshold: 0.3 }); // 30% of the section visible

    observer.observe(skillsSection);
  }
});
