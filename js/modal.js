const modal = document.getElementById('bookingModal');
document.querySelectorAll('.open-modal-btn').forEach(btn => btn.onclick = () => { modal.style.display = 'block'; document.body.style.overflow = 'hidden'; });
document.querySelector('.close')?.addEventListener('click', () => { modal.style.display = 'none'; document.body.style.overflow = 'auto'; });
window.onclick = (e) => { if (e.target === modal) { modal.style.display = 'none'; document.body.style.overflow = 'auto'; } };
document.querySelectorAll('.modal-tab').forEach(tab => {
    tab.onclick = () => {
        document.querySelectorAll('.modal-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.modal-tab-content').forEach(c => c.classList.remove('active'));
        tab.classList.add('active');
        document.getElementById(`tab${tab.dataset.tab.charAt(0).toUpperCase() + tab.dataset.tab.slice(1)}`).classList.add('active');
    };
});