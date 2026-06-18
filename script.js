let slideIndex = 0;
        const slides = document.querySelectorAll('.gallery-slide');
        const dots = document.querySelectorAll('.gallery-dot');
        
        function showSlide(n) {
            if (n >= slides.length) slideIndex = 0;
            if (n < 0) slideIndex = slides.length - 1;
            
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            
            slides[slideIndex].classList.add('active');
            dots[slideIndex].classList.add('active');
        }
        
        function nextSlide() {
            showSlide(slideIndex += 1);
        }
        
        function prevSlide() {
            showSlide(slideIndex -= 1);
        }
        
        document.querySelector('.gallery-next').addEventListener('click', nextSlide);
        document.querySelector('.gallery-prev').addEventListener('click', prevSlide);
        
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                showSlide(slideIndex = index);
            });
        });
        let slideInterval = setInterval(nextSlide, 5000);
        
        const galleryContainer = document.querySelector('.gallery-container');
        galleryContainer.addEventListener('mouseenter', () => {
            clearInterval(slideInterval);
        });
        
        galleryContainer.addEventListener('mouseleave', () => {
            slideInterval = setInterval(nextSlide, 5000);
        });
        const modal = document.getElementById('bookingModal');
        const openModalBtns = document.querySelectorAll('.open-modal-btn');
        const closeBtn = document.querySelector('.close');
        
        openModalBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                modal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            });
        });
        
        closeBtn.onclick = function() {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        }
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Спасибо за бронирование! Мы свяжемся с вами в ближайшее время.');
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
            this.reset();
        });
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
        window.addEventListener('scroll', () => {
            const moon = document.querySelector('.moon');
            const scrollValue = window.scrollY;
            moon.style.transform = `translateY(${scrollValue * 0.3}px)`;
        });
        function createPetals() {
            const container = document.getElementById('petalsContainer');
            const petalCount = 50; 
            container.innerHTML = '';
            
            for (let i = 0; i < petalCount; i++) {
                const petal = document.createElement('div');
                const petalType = Math.floor(Math.random() * 3) + 1;
                petal.classList.add('petal', `type${petalType}`);
                const startX = Math.random();
                const drift = Math.random() * 0.4 - 0.2; 
                const rotation = Math.random() * 3; 
                const duration = Math.random() * 15 + 15; 
                const delay = Math.random() * 15; 
                const opacity = Math.random() * 0.5 + 0.3; 
                
                petal.style.setProperty('--random-x', startX);
                petal.style.setProperty('--random-drift', drift);
                petal.style.setProperty('--rotation', rotation);
                petal.style.animationDuration = `${duration}s`;
                petal.style.animationDelay = `${delay}s`;
                petal.style.setProperty('--opacity', opacity);
                
                container.appendChild(petal);
            }
        }

        window.addEventListener('load', () => {
            createPetals();
            setInterval(createPetals, 30000);
        });
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.nav-menu').classList.toggle('active');
        });
        
        document.querySelectorAll('.nav-menu a').forEach(link => {
            link.addEventListener('click', () => {
                document.querySelector('.nav-menu').classList.remove('active');
            });
        });