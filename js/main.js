document.addEventListener('DOMContentLoaded', () => {
    if (typeof loadNews === 'function') loadNews();
    if (typeof initCalendar === 'function') initCalendar();
    if (typeof loadTables === 'function') loadTables(new Date().toISOString().split('T')[0]);
    if (typeof initBookingForm === 'function') initBookingForm();
    if (typeof initMobileMenu === 'function') initMobileMenu();
    if (typeof initSmoothScroll === 'function') initSmoothScroll();
});