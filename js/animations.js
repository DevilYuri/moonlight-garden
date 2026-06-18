function createPetals() {
    const container = document.getElementById('petalsContainer');
    if (!container) return;
    container.innerHTML = '';
    for (let i = 0; i < 40; i++) {
        const petal = document.createElement('div');
        petal.classList.add('petal');
        petal.style.cssText = `position:absolute; left:${Math.random()*100}%; top:${Math.random()*100}%; width:8px; height:8px; background:#f8d56b; border-radius:50%; opacity:${Math.random()*0.5}; animation:falling ${Math.random()*10+10}s linear infinite; animation-delay:${Math.random()*10}s;`;
        container.appendChild(petal);
    }
}
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });
}
function initMobileMenu() {
    const toggle = document.querySelector('.menu-toggle');
    const menu = document.querySelector('.nav-menu');
    if (toggle && menu) toggle.onclick = () => menu.classList.toggle('active');
}
window.addEventListener('load', () => { createPetals(); initSmoothScroll(); initMobileMenu(); });