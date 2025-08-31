/* Common Navigation and UI JavaScript for all pages */

// Mobile menu toggle functionality
document.addEventListener('DOMContentLoaded', function() {
  let menuIcon = document.querySelector("#menu-icon");
  let navbar = document.querySelector(".navbar");
  
  if (menuIcon && navbar) {
    menuIcon.onclick = () => {
      menuIcon.classList.toggle("bx-x");
      navbar.classList.toggle("active");
    };

    // Close mobile menu when clicking on nav links
    document.querySelectorAll(".navbar a").forEach((link) =>
      link.addEventListener("click", () => {
        menuIcon.classList.remove("bx-x");
        navbar.classList.remove("active");
        
        // Track navigation clicks (if cookies accepted)
        if (window.cookieConsent && window.cookieConsent.isEnabled()) {
          window.cookieConsent.track('navigation_click', {
            page: link.getAttribute('href'),
            text: link.textContent
          });
        }
      })
    );
  }

  // Initialize skill progress bars on page load (for static display)
  document.querySelectorAll('.skill-per').forEach(el => {
    el.style.width = el.getAttribute('data-per');
  });

  // Highlight active navigation link on scroll (for single page applications)
  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('.navbar a');

  if (sections.length > 0 && navLinks.length > 0) {
    window.addEventListener('scroll', () => {
      const scrollY = window.pageYOffset;
      sections.forEach(sec => {
        const top = sec.offsetTop - 80; // adjust for header height
        const height = sec.offsetHeight;
        const id = sec.getAttribute('id');

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
  }
});
