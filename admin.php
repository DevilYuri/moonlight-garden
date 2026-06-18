<?php
// ============================================
// АДМИН-ПАНЕЛЬ MOONLIGHT GARDEN
// ============================================

session_start();

// Авторизация
if (isset($_POST['password']) && $_POST['password'] === 'admin123') {
    $_SESSION['admin'] = true;
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit;
}

$isAdmin = isset($_SESSION['admin']);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель | Moonlight Garden</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Montserrat', system-ui, -apple-system, sans-serif;
            background: #0a0a1a;
            color: #ffffff;
            padding: 20px;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
        }
        
        /* Шапка */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        h1 {
            color: #f8d56b;
            font-size: 28px;
            border-bottom: 2px solid #f8d56b;
            display: inline-block;
            padding-bottom: 5px;
        }
        
        .logo-small {
            font-size: 24px;
            display: inline-block;
            margin-right: 10px;
        }
        
        /* Кнопки */
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-block;
            cursor: pointer;
            border: none;
        }
        
        .btn-logout {
            background: #f8d56b;
            color: #000;
        }
        
        .btn-logout:hover {
            background: #ffea9e;
            transform: translateY(-2px);
        }
        
        .btn-site {
            background: #1a1a2e;
            color: #fff;
            border: 1px solid #f8d56b;
            margin-left: 10px;
        }
        
        .btn-site:hover {
            background: #2a2a3e;
        }
        
        .btn-add {
            background: #f8d56b;
            color: #000;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }
        
        .btn-add:hover {
            background: #ffea9e;
        }
        
        /* Статистика */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #1a1a2e, #0f0f1f);
            padding: 20px;
            border-radius: 15px;
            border: 1px solid rgba(248, 213, 107, 0.2);
            text-align: center;
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-3px);
            border-color: rgba(248, 213, 107, 0.5);
        }
        
        .stat-number {
            font-size: 42px;
            font-weight: bold;
            color: #f8d56b;
        }
        
        .stat-label {
            font-size: 14px;
            opacity: 0.7;
            margin-top: 8px;
        }
        
        /* Вкладки */
        .tabs {
            display: flex;
            gap: 5px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        
        .tab {
            padding: 12px 24px;
            background: #1a1a2e;
            cursor: pointer;
            border-radius: 10px 10px 0 0;
            transition: all 0.3s;
            font-weight: 500;
        }
        
        .tab:hover {
            background: #252540;
        }
        
        .tab.active {
            background: #f8d56b;
            color: #000;
        }
        
        /* Контент вкладок */
        .tab-content {
            display: none;
            background: #1a1a2e;
            padding: 25px;
            border-radius: 0 15px 15px 15px;
        }
        
        .tab-content.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Таблицы */
        .table-wrapper {
            overflow-x: auto;
            margin-top: 20px;
        }
        
        table {
            width: 100%;
            background: #0a0a1a;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
        }
        
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #2a2a3e;
        }
        
        th {
            background: #f8d56b;
            color: #000;
            font-weight: 600;
        }
        
        tr:hover {
            background: rgba(248, 213, 107, 0.05);
        }
        
        /* Статусы */
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .status-new {
            background: #ff9800;
            color: #000;
        }
        
        .status-confirmed {
            background: #4caf50;
            color: #fff;
        }
        
        .status-cancelled {
            background: #f44336;
            color: #fff;
        }
        
        /* Формы */
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #f8d56b;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            background: #0a0a1a;
            border: 1px solid #333;
            border-radius: 8px;
            color: #fff;
            font-size: 14px;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #f8d56b;
        }
        
        /* Список новостей в админке */
        .news-item {
            background: #0a0a1a;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            border-left: 3px solid #f8d56b;
            transition: all 0.3s;
        }
        
        .news-item:hover {
            background: #0f0f20;
        }
        
        .news-title {
            font-weight: bold;
            color: #f8d56b;
            margin-bottom: 8px;
        }
        
        .news-date {
            font-size: 12px;
            opacity: 0.6;
            margin-bottom: 8px;
        }
        
        .news-text {
            font-size: 13px;
            opacity: 0.8;
            line-height: 1.5;
        }
        
        /* Статус-селект */
        .status-select {
            padding: 6px 12px;
            border-radius: 6px;
            background: #0a0a1a;
            color: #fff;
            border: 1px solid #f8d56b;
            cursor: pointer;
        }
        
        /* Сообщения */
        .message {
            padding: 10px;
            border-radius: 8px;
            margin-top: 10px;
        }
        
        .message-success {
            background: rgba(76, 175, 80, 0.2);
            color: #4caf50;
            border: 1px solid #4caf50;
        }
        
        .message-error {
            background: rgba(244, 67, 54, 0.2);
            color: #f44336;
            border: 1px solid #f44336;
        }
        
        /* Логин форма */
        .login-box {
            max-width: 400px;
            margin: 100px auto;
            background: #1a1a2e;
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            border: 1px solid rgba(248, 213, 107, 0.3);
        }
        
        .login-box h2 {
            color: #f8d56b;
            margin-bottom: 20px;
        }
        
        .login-box input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            background: #0a0a1a;
            border: 1px solid #333;
            border-radius: 8px;
            color: #fff;
        }
        
        .login-box button {
            width: 100%;
            padding: 12px;
            background: #f8d56b;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }
        
        .login-box .hint {
            font-size: 12px;
            opacity: 0.5;
            margin-top: 15px;
        }
        
        /* Адаптив */
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            th, td {
                padding: 8px 10px;
                font-size: 12px;
            }
            
            .tab {
                padding: 8px 16px;
                font-size: 12px;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
        
        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <?php if (!$isAdmin): ?>
            <!-- ФОРМА ВХОДА -->
            <div class="login-box">
                <div style="font-size: 48px; margin-bottom: 15px;">🌙</div>
                <h2>Админ-панель</h2>
                <h2 style="font-size: 18px; color: #fff;">MOONLIGHT GARDEN</h2>
                <form method="POST">
                    <input type="password" name="password" placeholder="Введите пароль" autofocus>
                    <button type="submit">Войти</button>
                </form>
                <div class="hint">🔑 Пароль: admin123</div>
            </div>
        <?php else: ?>
            <!-- АДМИН-ПАНЕЛЬ -->
            <div class="header">
                <div>
                    <span class="logo-small">🌙</span>
                    <h1>Админ-панель MOONLIGHT GARDEN</h1>
                </div>
                <div>
                    <a href="index.php" class="btn btn-site">🏠 На сайт</a>
                    <a href="?logout=1" class="btn btn-logout">🚪 Выйти</a>
                </div>
            </div>
            
            <!-- СТАТИСТИКА -->
            <div class="stats-grid" id="stats">
                <div class="stat-card">
                    <div class="stat-number" id="statTotalBookings">—</div>
                    <div class="stat-label">Всего бронирований</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="statTodayBookings">—</div>
                    <div class="stat-label">Броней сегодня</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="statTotalGuests">—</div>
                    <div class="stat-label">Постоянных гостей</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="statTotalTables">—</div>
                    <div class="stat-label">Всего столиков</div>
                </div>
            </div>
            
            <!-- ВКЛАДКИ -->
            <div class="tabs">
                <div class="tab active" data-tab="bookings">📋 Бронирования</div>
                <div class="tab" data-tab="guests">👥 Постоянные гости</div>
                <div class="tab" data-tab="news">📰 Управление новостями</div>
            </div>
            
            <!-- ВКЛАДКА: БРОНИРОВАНИЯ -->
            <div id="bookings" class="tab-content active">
                <h3 style="margin-bottom: 15px; color: #f8d56b;">📋 Список всех бронирований</h3>
                <div class="table-wrapper">
                    <table id="bookingsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Имя</th>
                                <th>Телефон</th>
                                <th>Дата</th>
                                <th>Гостей</th>
                                <th>Столик</th>
                                <th>Статус</th>
                                <th>Действие</th>
                                <th>Создано</th>
                            </tr>
                        </thead>
                        <tbody id="bookingsTbody">
                            <tr><td colspan="9" style="text-align: center;">⏳ Загрузка...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- ВКЛАДКА: ГОСТИ -->
            <div id="guests" class="tab-content">
                <h3 style="margin-bottom: 15px; color: #f8d56b;">👥 Топ постоянных гостей</h3>
                <div class="table-wrapper">
                    <table id="guestsTable">
                        <thead>
                            <tr>
                                <th>Имя</th>
                                <th>Телефон</th>
                                <th>Количество визитов</th>
                                <th>Последний визит</th>
                            </tr>
                        </thead>
                        <tbody id="guestsTbody">
                            <tr><td colspan="4" style="text-align: center;">⏳ Загрузка...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- ВКЛАДКА: НОВОСТИ -->
            <div id="news" class="tab-content">
                <h3 style="margin-bottom: 15px; color: #f8d56b;">➕ Добавить новость</h3>
                
                <!-- Форма добавления новости -->
                <div style="background: #0a0a1a; padding: 20px; border-radius: 15px; margin-bottom: 30px;">
                    <form id="addNewsForm">
                        <div class="form-group">
                            <label>📌 Заголовок новости</label>
                            <input type="text" id="newsTitle" placeholder="Например: Открытие летнего сезона" required>
                        </div>
                        <div class="form-group">
                            <label>📝 Текст новости</label>
                            <textarea id="newsContent" rows="4" placeholder="Подробное описание события..." required></textarea>
                        </div>
                        <div class="form-group">
                            <label>📅 Дата мероприятия</label>
                            <input type="date" id="newsDate" required>
                        </div>
                        <button type="submit" class="btn-add">➕ Опубликовать новость</button>
                    </form>
                    <div id="newsMessage"></div>
                </div>
                
                <!-- Список существующих новостей -->
                <h3 style="margin-bottom: 15px; color: #f8d56b;">📋 Текущие новости</h3>
                <div id="newsList"></div>
            </div>
        <?php endif; ?>
    </div>
    
    <?php if ($isAdmin): ?>
    <script>
        // ============================================
        // ФУНКЦИИ ДЛЯ ЗАГРУЗКИ ДАННЫХ
        // ============================================
        
        // Загрузка статистики
        async function loadStats() {
            try {
                const response = await fetch('http://localhost/moonlight-garden/api/stats.php');
                const data = await response.json();
                if (data.success) {
                    document.getElementById('statTotalBookings').textContent = data.total_bookings || 0;
                    document.getElementById('statTodayBookings').textContent = data.today_bookings || 0;
                    document.getElementById('statTotalGuests').textContent = data.total_guests || 0;
                    document.getElementById('statTotalTables').textContent = data.total_tables || 0;
                }
            } catch (error) {
                console.error('Ошибка загрузки статистики:', error);
            }
        }
        
        // Загрузка бронирований
        async function loadBookings() {
            try {
                const response = await fetch('http://localhost/moonlight-garden/api/get_bookings.php');
                const data = await response.json();
                const tbody = document.getElementById('bookingsTbody');
                
                if (data.success && data.bookings && data.bookings.length > 0) {
                    tbody.innerHTML = data.bookings.map(booking => `
                        <tr>
                            <td>${booking.id}</td>
                            <td><strong>${escapeHtml(booking.guest_name)}</strong></td>
                            <td>${booking.phone}</td>
                            <td>${booking.visit_date}</td>
                            <td>${booking.guests_count}</td>
                            <td>${booking.table_id ? 'Стол ' + booking.table_id : '—'}</td>
                            <td><span class="status-badge status-${booking.status}">${getStatusText(booking.status)}</span></td>
                            <td>
                                <select class="status-select" data-id="${booking.id}" onchange="updateStatus(${booking.id}, this.value)">
                                    <option value="new" ${booking.status === 'new' ? 'selected' : ''}>🟠 Новое</option>
                                    <option value="confirmed" ${booking.status === 'confirmed' ? 'selected' : ''}>🟢 Подтверждено</option>
                                    <option value="cancelled" ${booking.status === 'cancelled' ? 'selected' : ''}>🔴 Отменено</option>
                                </select>
                            </td>
                            <td>${booking.created_at || '—'}</td>
                        </tr>
                    `).join('');
                } else {
                    tbody.innerHTML = '<tr><td colspan="9" style="text-align: center;">😔 Нет бронирований</td></tr>';
                }
            } catch (error) {
                console.error('Ошибка загрузки броней:', error);
                document.getElementById('bookingsTbody').innerHTML = '<tr><td colspan="9" style="text-align: center;">❌ Ошибка загрузки</td></tr>';
            }
        }
        
        // Загрузка гостей
        async function loadGuests() {
            try {
                const response = await fetch('http://localhost/moonlight-garden/api/guests.php');
                const data = await response.json();
                const tbody = document.getElementById('guestsTbody');
                
                if (data.success && data.guests && data.guests.length > 0) {
                    tbody.innerHTML = data.guests.map(guest => `
                        <tr>
                            <td><strong>${escapeHtml(guest.name)}</strong></td>
                            <td>${guest.phone}</td>
                            <td style="text-align: center;"><span style="color: #f8d56b; font-weight: bold;">${guest.total_visits}</span></td>
                            <td>${guest.last_visit || '—'}</td>
                        </tr>
                    `).join('');
                } else {
                    tbody.innerHTML = '<tr><td colspan="4" style="text-align: center;">😔 Нет постоянных гостей</td></tr>';
                }
            } catch (error) {
                console.error('Ошибка загрузки гостей:', error);
                document.getElementById('guestsTbody').innerHTML = '<tr><td colspan="4" style="text-align: center;">❌ Ошибка загрузки</td></tr>';
            }
        }
        
        // Загрузка новостей в админку
        async function loadNewsAdmin() {
            try {
                const response = await fetch('http://localhost/moonlight-garden/api/get_news.php');
                const data = await response.json();
                const newsList = document.getElementById('newsList');
                
                if (data.success && data.news && data.news.length > 0) {
                    newsList.innerHTML = data.news.map(news => `
                        <div class="news-item">
                            <div class="news-title">📌 ${escapeHtml(news.title)}</div>
                            <div class="news-date">📅 ${news.event_date}</div>
                            <div class="news-text">${escapeHtml(news.content.substring(0, 200))}${news.content.length > 200 ? '...' : ''}</div>
                        </div>
                    `).join('');
                } else {
                    newsList.innerHTML = '<div style="text-align: center; padding: 30px;">📭 Новостей пока нет</div>';
                }
            } catch (error) {
                console.error('Ошибка загрузки новостей:', error);
                document.getElementById('newsList').innerHTML = '<div style="text-align: center; padding: 30px;">❌ Ошибка загрузки</div>';
            }
        }
        
        // ============================================
        // ВСПОМОГАТЕЛЬНЫЕ ФУНКЦИИ
        // ============================================
        
        function getStatusText(status) {
            const statuses = {
                'new': 'Новое',
                'confirmed': 'Подтверждено',
                'cancelled': 'Отменено'
            };
            return statuses[status] || status;
        }
        
        function escapeHtml(str) {
            if (!str) return '';
            return str
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#39;');
        }
        
        // Обновление статуса бронирования
        async function updateStatus(id, status) {
            try {
                const response = await fetch('http://localhost/moonlight-garden/api/update_status.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: id, status: status })
                });
                const result = await response.json();
                if (result.success) {
                    showToast('✅ Статус бронирования обновлён!', 'success');
                    loadStats();
                    loadBookings();
                } else {
                    showToast('❌ Ошибка: ' + result.message, 'error');
                }
            } catch (error) {
                console.error('Ошибка:', error);
                showToast('❌ Ошибка соединения', 'error');
            }
        }
        
        // Уведомления (Toast)
        function showToast(message, type) {
            const toast = document.createElement('div');
            toast.style.cssText = `
                position: fixed;
                bottom: 20px;
                right: 20px;
                background: ${type === 'success' ? '#4caf50' : '#f44336'};
                color: white;
                padding: 12px 24px;
                border-radius: 8px;
                z-index: 9999;
                animation: slideInRight 0.3s ease;
                font-size: 14px;
            `;
            toast.textContent = message;
            document.body.appendChild(toast);
            setTimeout(() => {
                toast.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
        
        // Добавление стилей для анимации уведомлений
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideInRight {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOutRight {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
        
        // ============================================
        // ПЕРЕКЛЮЧЕНИЕ ВКЛАДОК
        // ============================================
        
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', () => {
                // Убираем активные классы
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
                
                // Добавляем активный класс
                tab.classList.add('active');
                const tabId = tab.dataset.tab;
                document.getElementById(tabId).classList.add('active');
                
                // Загружаем данные в зависимости от вкладки
                if (tabId === 'guests') {
                    loadGuests();
                } else if (tabId === 'news') {
                    loadNewsAdmin();
                }
            });
        });
        
        // ============================================
        // ДОБАВЛЕНИЕ НОВОСТИ
        // ============================================
        
        document.getElementById('addNewsForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const formData = {
                title: document.getElementById('newsTitle').value,
                content: document.getElementById('newsContent').value,
                event_date: document.getElementById('newsDate').value
            };
            
            if (!formData.title || !formData.content || !formData.event_date) {
                showToast('⚠️ Заполните все поля!', 'error');
                return;
            }
            
            const msgDiv = document.getElementById('newsMessage');
            msgDiv.innerHTML = '<div class="message" style="background: rgba(248,213,107,0.2);">⏳ Публикация...</div>';
            
            try {
                const response = await fetch('http://localhost/moonlight-garden/api/add_news.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(formData)
                });
                
                const result = await response.json();
                
                if (result.success) {
                    msgDiv.innerHTML = '<div class="message message-success">✅ Новость успешно опубликована!</div>';
                    document.getElementById('addNewsForm').reset();
                    loadNewsAdmin();
                    showToast('✅ Новость добавлена!', 'success');
                    setTimeout(() => msgDiv.innerHTML = '', 3000);
                } else {
                    msgDiv.innerHTML = '<div class="message message-error">❌ Ошибка: ' + result.message + '</div>';
                    showToast('❌ Ошибка публикации', 'error');
                }
            } catch (error) {
                console.error('Ошибка:', error);
                msgDiv.innerHTML = '<div class="message message-error">❌ Ошибка соединения с сервером</div>';
                showToast('❌ Ошибка соединения', 'error');
            }
        });
        
        // ============================================
        // АВТООБНОВЛЕНИЕ (каждые 30 секунд)
        // ============================================
        
        loadStats();
        loadBookings();
        loadGuests();
        loadNewsAdmin();
        
        setInterval(() => {
            loadStats();
            loadBookings();
        }, 30000);
    </script>
    <?php endif; ?>
</body>
</html>