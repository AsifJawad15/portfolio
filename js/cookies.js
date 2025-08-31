// Cookie Consent Management
// Handles cookie banner display and user consent

document.addEventListener('DOMContentLoaded', function() {
    // Check if user has already made a choice about cookies
    if (!getCookie('cookieConsent')) {
        showCookieBanner();
    }
});

function showCookieBanner() {
    // Create cookie banner element
    const cookieBanner = document.createElement('div');
    cookieBanner.id = 'cookie-banner';
    cookieBanner.className = 'cookie-banner';
    
    cookieBanner.innerHTML = `
        <div class="cookie-content">
            <div class="cookie-text">
                <i class='bx bx-cookie'></i>
                <span>We use cookies to enhance your browsing experience and analyze website traffic. By accepting, you help us improve our services.</span>
            </div>
            <div class="cookie-buttons">
                <button onclick="acceptCookies()" class="cookie-btn accept-btn">
                    <i class='bx bx-check'></i> Accept
                </button>
                <button onclick="declineCookies()" class="cookie-btn decline-btn">
                    <i class='bx bx-x'></i> Decline
                </button>
            </div>
        </div>
    `;
    
    // Add banner to the page
    document.body.appendChild(cookieBanner);
    
    // Animate banner appearance
    setTimeout(() => {
        cookieBanner.classList.add('show');
    }, 500);
}

function acceptCookies() {
    // Set cookie consent
    setCookie('cookieConsent', 'accepted', 365);
    
    // Enable analytics or other cookie-dependent features
    enableAnalytics();
    
    // Hide banner
    hideCookieBanner();
    
    // Show thank you message
    showNotification('Thank you! Cookies enabled for enhanced experience.', 'success');
}

function declineCookies() {
    // Set cookie consent (minimal essential cookies only)
    setCookie('cookieConsent', 'declined', 365);
    
    // Hide banner
    hideCookieBanner();
    
    // Show info message
    showNotification('Cookies declined. Some features may be limited.', 'info');
}

function hideCookieBanner() {
    const banner = document.getElementById('cookie-banner');
    if (banner) {
        banner.classList.add('hide');
        setTimeout(() => {
            banner.remove();
        }, 300);
    }
}

function enableAnalytics() {
    // Enable Google Analytics, tracking, or other analytics
    // This is where you would initialize analytics code
    console.log('Analytics enabled - User accepted cookies');
    
    // Example: Enable session tracking
    sessionStorage.setItem('analyticsEnabled', 'true');
    
    // You can add Google Analytics, Facebook Pixel, etc. here
    // gtag('config', 'GA_MEASUREMENT_ID');
}

function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.innerHTML = `
        <i class='bx ${type === 'success' ? 'bx-check-circle' : 'bx-info-circle'}'></i>
        <span>${message}</span>
    `;
    
    // Add to page
    document.body.appendChild(notification);
    
    // Show notification
    setTimeout(() => notification.classList.add('show'), 100);
    
    // Hide notification after 4 seconds
    setTimeout(() => {
        notification.classList.add('hide');
        setTimeout(() => notification.remove(), 300);
    }, 4000);
}

// Cookie utility functions
function setCookie(name, value, days) {
    const expires = new Date();
    expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
    document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/;SameSite=Lax`;
}

function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function deleteCookie(name) {
    document.cookie = name + '=; Max-Age=-99999999; path=/';
}

// Optional: Add function to reset cookie preferences (for testing or user settings)
function resetCookiePreferences() {
    deleteCookie('cookieConsent');
    location.reload();
}

// Track user preferences for enhanced features
function isAnalyticsEnabled() {
    return getCookie('cookieConsent') === 'accepted';
}

// Enhanced user activity tracking (only if cookies accepted)
function trackUserActivity(action, data = {}) {
    if (isAnalyticsEnabled()) {
        // Track user actions, page views, etc.
        const activityData = {
            action: action,
            timestamp: new Date().toISOString(),
            page: window.location.pathname,
            ...data
        };
        
        // Store in localStorage for analytics
        const activities = JSON.parse(localStorage.getItem('userActivities') || '[]');
        activities.push(activityData);
        
        // Keep only last 50 activities
        if (activities.length > 50) {
            activities.splice(0, activities.length - 50);
        }
        
        localStorage.setItem('userActivities', JSON.stringify(activities));
        
        console.log('Activity tracked:', activityData);
    }
}

// Export functions for use in other scripts
window.cookieConsent = {
    accept: acceptCookies,
    decline: declineCookies,
    reset: resetCookiePreferences,
    isEnabled: isAnalyticsEnabled,
    track: trackUserActivity
};
