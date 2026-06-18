class Toast {
    static show(message, type = 'info') {
        let container = document.getElementById('toastContainer');
        if (!container) {
            container = document.createElement('div');
            container.id = 'toastContainer';
            container.style.cssText = 'position:fixed; bottom:20px; right:20px; z-index:1000;';
            document.body.appendChild(container);
        }
        const toast = document.createElement('div');
        toast.style.cssText = `background:#1a1a2e; border-left:4px solid ${type === 'success' ? '#4caf50' : type === 'error' ? '#f44336' : '#f8d56b'}; padding:12px 20px; margin-top:10px; border-radius:8px; color:white; animation:slideInRight 0.3s ease;`;
        toast.innerHTML = message;
        container.appendChild(toast);
        setTimeout(() => { toast.remove(); }, 3000);
    }
}