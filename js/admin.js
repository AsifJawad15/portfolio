/* Admin Panel Specific JavaScript */

// Admin-specific functionality can be added here
document.addEventListener('DOMContentLoaded', function() {
  
  // Confirmation for delete actions
  const deleteLinks = document.querySelectorAll('a[href*="delete"]');
  deleteLinks.forEach(link => {
    link.addEventListener('click', function(e) {
      if (!confirm('Are you sure you want to delete this item?')) {
        e.preventDefault();
      }
    });
  });

  // Form validation helpers
  const forms = document.querySelectorAll('form');
  forms.forEach(form => {
    form.addEventListener('submit', function(e) {
      const requiredFields = form.querySelectorAll('[required]');
      let isValid = true;
      
      requiredFields.forEach(field => {
        if (!field.value.trim()) {
          field.style.borderColor = '#ff4444';
          isValid = false;
        } else {
          field.style.borderColor = '';
        }
      });
      
      if (!isValid) {
        e.preventDefault();
        alert('Please fill in all required fields.');
      }
    });
  });

  // Auto-hide success/error messages
  const messages = document.querySelectorAll('.success, .error');
  messages.forEach(message => {
    setTimeout(() => {
      message.style.opacity = '0';
      setTimeout(() => {
        message.style.display = 'none';
      }, 300);
    }, 5000);
  });

});
