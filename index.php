<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(102248682, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/102248682" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>MOONLIGHT GARDEN - Женский клуб</title>
    
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/components.css">
    
    <style>
        /* Дополнительные стили для компактности */
        .modal-content {
            max-width: 550px !important;
            width: 90% !important;
            margin: 5% auto !important;
            max-height: 85vh;
            overflow-y: auto;
            padding: 20px !important;
        }
        
        .modal-tabs {
            display: flex;
            gap: 5px;
            margin-bottom: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .modal-tab {
            padding: 8px 15px;
            font-size: 12px;
        }
        
        .tables-grid {
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 10px;
            max-height: 300px;
        }
        
        .table-card {
            padding: 8px;
        }
        
        .table-number {
            font-size: 14px;
        }
        
        .table-name {
            font-size: 9px;
        }
        
        .calendar-grid {
            gap: 3px;
        }
        
        .calendar-day {
            padding: 6px;
            font-size: 11px;
        }
        
        #bookingForm input, #bookingForm select {
            padding: 10px;
            margin-bottom: 10px;
            font-size: 14px;
        }
        
        .guests-selector {
            margin: 10px 0;
            padding: 8px;
        }
        
        .guests-btn {
            width: 32px;
            height: 32px;
            font-size: 16px;
        }
        
        .guests-value {
            font-size: 16px;
            min-width: 35px;
        }
        
        .form-submit {
            padding: 12px;
            font-size: 14px;
        }
        
        .selected-table-info {
            padding: 8px;
            margin-bottom: 12px;
            font-size: 13px;
        }
        
        .modal-title {
            font-size: 20px;
            margin-bottom: 15px;
        }
        
        .close {
            top: 10px;
            right: 15px;
            font-size: 24px;
        }
        
        @media (max-width: 550px) {
            .modal-content {
                width: 95% !important;
                margin: 10% auto !important;
                padding: 15px !important;
            }
            .tables-grid {
                grid-template-columns: repeat(auto-fill, minmax(85px, 1fr));
            }
            .modal-tab {
                padding: 6px 12px;
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Фоновые элементы -->
    <div class="moonlight-bg">
        <div class="stars"></div>
        <div class="moon"></div>
    </div>
    <div class="petals-container" id="petalsContainer"></div>
    
    <div class="container">
        <!-- Шапка -->
        <header>
            <a href="#" class="logo">MOONLIGHT</a>
            <button class="menu-toggle">☰</button>
            <nav class="nav-menu">
                <a href="#about">О КЛУБЕ</a>
                <a href="#events">МЕРОПРИЯТИЯ</a>
                <a href="#gallery">ГАЛЕРЕЯ</a>
                <a href="#news">НОВОСТИ</a>
                <a href="#contacts">КОНТАКТЫ</a>
            </nav>
        </header>
        
        <!-- Hero секция -->
        <section class="hero">
            <h1 class="club-name">MOONLIGHT GARDEN</h1>
            <h2 class="club-subtitle">ЖЕНСКИЙ КЛУБ</h2>
            <p class="club-slogan">МЕСТО, ГДЕ НОЧЬ РАСКРЫВАЕТ СВОЮ МАГИЮ</p>
            <button class="btn open-modal-btn">ЗАБРОНИРОВАТЬ СТОЛИК</button>
        </section>
        
        <!-- Секция "О нас" -->
        <section id="about" class="section">
            <div class="flowers flower-1"></div>
            <div class="flowers flower-2"></div>
            
            <h2 class="section-title">О НАС</h2>
            <div class="about-content">
                <div class="about-text">
                    <p>MOONLIGHT GARDEN — это не просто клуб, а настоящий женский оазис, где каждая гостья становится частью волшебной лунной сказки.</p>
                    
                    <p>Наш сад, украшенный живыми цветами и хрустальными люстрами, создаёт атмосферу таинственности и роскоши. Здесь вы найдёте уютные беседки, утопающие в плетистых розах, и зеркальные водоёмы, отражающие звёздное небо.</p>
                    
                    <p>Каждый вечер наши флористы создают свежие цветочные композиции, а парфюмеры наполняют воздух тонкими ароматами ночных цветов. Особое внимание мы уделяем деталям — от хрустальных бокалов до меню, выполненного в виде старинного свитка.</p>
                    
                    <button class="btn btn-secondary open-modal-btn">ЗАБРОНИРОВАТЬ СТОЛИК</button>
                </div>
                <div class="about-image">
                    <img src="dan.gif" alt="gifka">
                </div>
            </div>
        </section>
        
        <!-- Секция "Лунный ритуал" -->
        <section id="events" class="section" style="background: rgba(10,10,26,0.7);">
            <h2 class="section-title">ЛУННЫЙ РИТУАЛ</h2>
            <div class="event-content">
                <div class="cocktail-container">
                    <div class="cocktail"></div>
                </div>
                <div class="event-text">
                    <p>Изюминка MOONLIGHT GARDEN – <span class="event-highlight">«Лунный ритуал»</span> ✧☽</p>
                    
                    <p>Каждую полночь в клубе проходит волшебное шоу: под таинственные мелодии в зале мягко гаснет свет, и над танцполом «восходит» огромная светящаяся луна. В этот момент бармены готовят <span class="event-highlight">фирменный коктейль «Luna Mist»</span> с дымящимся эффектом, который подают только избранным гостьям.</p>
                    
                    <p>А ещё – в «лунном саду» спрятаны <span class="event-highlight">золотые билеты</span>, дающие право на VIP-обслуживание, персональный стол или даже свидание с загадочным незнакомцем...</p>
                    
                    <p>Хотите узнать, что скрывает ночь? <span class="event-highlight">Ждём вас в MOONLIGHT GARDEN!</span></p>
                    
                    <button class="btn open-modal-btn">ЗАБРОНИРОВАТЬ УЧАСТИЕ</button>
                </div>
            </div>
        </section>
        
        <!-- Галерея -->
        <section id="gallery" class="gallery-section">
            <h2 class="section-title">ИНТЕРЬЕРЫ</h2>
            <div class="gallery-container">
                <div class="gallery-slide active">
                    <img src="fu.jpg" alt="Интерьер клуба" class="gallery-img">
                    <p class="gallery-caption">Главный зал с танцполом под светящейся луной</p>
                </div>
                <div class="gallery-slide">
                    <img src="did.jpg" alt="Лунный сад" class="gallery-img">
                    <p class="gallery-caption">Наш лучший диджей</p>
                </div>
                <div class="gallery-slide">
                    <img src="vip.jpg" alt="VIP зона" class="gallery-img">
                    <p class="gallery-caption">VIP зона для особых гостей</p>
                </div>
                <div class="gallery-slide">
                    <img src="vod.jpg" alt="Барная стойка" class="gallery-img">
                    <p class="gallery-caption">Барная стойка с фирменными коктейлями</p>
                </div>
                <div class="gallery-slide">
                    <img src="coc.jpg" alt="коктейли" class="gallery-img">
                    <p class="gallery-caption">Фирменные коктейли</p>
                </div>
                
                <button class="gallery-prev">❮</button>
                <button class="gallery-next">❯</button>
            </div>
            
            <div class="gallery-nav">
                <span class="gallery-dot active"></span>
                <span class="gallery-dot"></span>
                <span class="gallery-dot"></span>
                <span class="gallery-dot"></span>
                <span class="gallery-dot"></span>
            </div>
        </section>
        
        <!-- НОВОСТИ -->
        <section id="news" class="section">
            <h2 class="section-title">📰 НОВОСТИ И СОБЫТИЯ</h2>
            <div id="newsContainer" class="news-grid"></div>
        </section>
        
        <!-- Контакты -->
        <section id="contacts" class="contacts-section">
            <h2 class="section-title">КОНТАКТЫ</h2>
            <div class="contacts-grid">
                <div class="contact-card">
                    <h3 class="contact-title">Связь с нами</h3>
                    <div class="contact-info">
                        <div class="contact-item">
                            <span class="contact-icon">📞</span>
                            <a href="tel:+79771234567" class="contact-link">+7 (977) 123-45-67</a>
                        </div>
                        <div class="contact-item">
                            <span class="contact-icon">📞</span>
                            <a href="tel:+74957654321" class="contact-link">+7 (495) 765-43-21</a>
                        </div>
                        <div class="contact-item">
                            <span class="contact-icon">✉️</span>
                            <a href="mailto:moonlightgarden@support.ru" class="contact-link">moonlight@support.ru</a>
                        </div>
                        <div class="contact-item">
                            <span class="contact-icon">📱</span>
                            <a href="https://t.me/moonlight_garden" target="_blank" class="contact-link">@moonlight_garden</a>
                        </div>
                    </div>
                </div>
                <div class="contact-card">
                    <h3 class="contact-title">Режим работы</h3>
                    <div class="contact-info">
                        <div class="contact-item">
                            <span class="contact-icon">⏳</span>
                            <span>Пн-Чт: 20:00 - 04:00</span>
                        </div>
                        <div class="contact-item">
                            <span class="contact-icon">✨</span>
                            <span>Пт-Сб: 20:00 - 06:00</span>
                        </div>
                        <div class="contact-item">
                            <span class="contact-icon">📞</span>
                            <a href="tel:+79779876543" class="contact-link">+7 (977) 987-65-43</a>
                        </div>
                    </div>
                </div>
                
                <div class="contact-card">
                    <h3 class="contact-title">Навигация</h3>
                    <div class="contact-info">
                        <div class="contact-item">
                            <span class="contact-icon">🌙</span>
                            <a href="#about" class="contact-link">О клубе</a>
                        </div>
                        <div class="contact-item">
                            <span class="contact-icon">🍸</span>
                            <a href="#events" class="contact-link">Мероприятия</a>
                        </div>
                        <div class="contact-item">
                            <span class="contact-icon">📷</span>
                            <a href="#gallery" class="contact-link">Галерея</a>
                        </div>
                        <div class="contact-item">
                            <span class="contact-icon">📰</span>
                            <a href="#news" class="contact-link">Новости</a>
                        </div>
                        <div class="contact-item">
                            <span class="contact-icon">☎️</span>
                            <a href="#contacts" class="contact-link">Контакты</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <!-- КОМПАКТНОЕ МОДАЛЬНОЕ ОКНО БРОНИРОВАНИЯ -->
    <div id="bookingModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 class="modal-title">🌙 ВЫБОР СТОЛИКА</h2>
            
            <div class="modal-tabs">
                <div class="modal-tab active" data-tab="calendar">📅 ДАТА</div>
                <div class="modal-tab" data-tab="tables">🪑 СТОЛИК</div>
                <div class="modal-tab" data-tab="form">📝 ДАННЫЕ</div>
            </div>
            
            <div class="modal-tab-content active" id="tabCalendar">
                <div id="calendarGrid"></div>
                <input type="hidden" id="bookingDate">
            </div>
            
            <div class="modal-tab-content" id="tabTables">
                <div id="tablesGrid"></div>
            </div>
            
            <div class="modal-tab-content" id="tabForm">
                <div id="selectedTableInfo"></div>
                <form id="bookingForm">
                    <input type="text" id="name" placeholder="👤 Ваше имя" required>
                    <input type="tel" id="phone" placeholder="📞 +7 (___) ___-__-__" required>
                    <div class="guests-selector">
                        <button type="button" class="guests-btn" id="guestsMinus">−</button>
                        <span class="guests-value" id="guestsValue">2</span>
                        <button type="button" class="guests-btn" id="guestsPlus">+</button>
                    </div>
                    <button type="submit" class="form-submit" disabled>🪑 СНАЧАЛА ВЫБЕРИТЕ СТОЛИК</button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- ПОДКЛЮЧЕНИЕ JS ФАЙЛОВ -->
    <script src="js/toast.js"></script>
    <script src="js/animations.js"></script>
    <script src="js/gallery.js"></script>
    <script src="js/modal.js"></script>
    <script src="js/calendar.js"></script>
    <script src="js/tables.js"></script>
    <script src="js/booking.js"></script>
    <script src="js/news.js"></script>
    <script src="js/main.js"></script>
</body>
</html>