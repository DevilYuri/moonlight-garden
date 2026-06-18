async function loadNews() {
    const container = document.getElementById('newsContainer');
    if (!container) return;
    try {
        const res = await fetch('http://localhost/moonlight-garden/api/get_news.php');
        const data = await res.json();
        if (data.success && data.news.length) {
            container.innerHTML = data.news.map((n, i) => `<div class="news-card"><div class="news-icon">${['🌟','✨','💃','🎭','👑','🌸','🎤'][i%7]}</div><div class="news-content"><div class="news-date">📅 ${n.event_date.split('-').reverse().join('.')}</div><div class="news-title">${escapeHtml(n.title)}</div><div class="news-text">${escapeHtml(n.content.substring(0, 150))}${n.content.length > 150 ? '...' : ''}</div><div class="news-badge">⭐ Популярно</div></div></div>`).join('');
        } else container.innerHTML = '<div style="text-align:center; padding:40px;">Скоро здесь появятся новости! 🌙</div>';
    } catch(e) { container.innerHTML = '<div style="text-align:center; padding:40px;">Ошибка загрузки новостей</div>'; }
}
function escapeHtml(str) { return str.replace(/[&<>]/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;'})[m]); }
document.addEventListener('DOMContentLoaded', loadNews);