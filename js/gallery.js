let slideIndex = 0, slideInterval;
function initGallery() {
    const slides = document.querySelectorAll('.gallery-slide');
    const dots = document.querySelector('.gallery-nav');
    if (!slides.length) return;
    slides.forEach((_, i) => { const dot = document.createElement('span'); dot.className = 'gallery-dot'; dot.onclick = () => showSlide(i); dots.appendChild(dot); });
    function showSlide(n) { slideIndex = (n + slides.length) % slides.length; slides.forEach((s, i) => s.classList.toggle('active', i === slideIndex)); document.querySelectorAll('.gallery-dot').forEach((d, i) => d.classList.toggle('active', i === slideIndex)); }
    document.querySelector('.gallery-prev')?.addEventListener('click', () => showSlide(slideIndex - 1));
    document.querySelector('.gallery-next')?.addEventListener('click', () => showSlide(slideIndex + 1));
    showSlide(0);
    slideInterval = setInterval(() => showSlide(slideIndex + 1), 5000);
    document.querySelector('.gallery-container')?.addEventListener('mouseenter', () => clearInterval(slideInterval));
    document.querySelector('.gallery-container')?.addEventListener('mouseleave', () => { slideInterval = setInterval(() => showSlide(slideIndex + 1), 5000); });
}
document.addEventListener('DOMContentLoaded', initGallery);