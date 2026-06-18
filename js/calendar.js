let calendarState = { currentDate: new Date(), selectedDate: new Date().toISOString().split('T')[0] };
function renderCalendar() {
    const container = document.getElementById('calendarGrid');
    if (!container) return;
    const year = calendarState.currentDate.getFullYear(), month = calendarState.currentDate.getMonth();
    const firstDay = new Date(year, month, 1), lastDay = new Date(year, month + 1, 0);
    let startWeekday = firstDay.getDay() || 7;
    let html = `<div class="calendar-header"><button class="calendar-nav-btn" onclick="changeMonth(-1)">◀</button><h3>${getMonthName(month)} ${year}</h3><button class="calendar-nav-btn" onclick="changeMonth(1)">▶</button></div><div class="calendar-grid">`;
    ['Пн','Вт','Ср','Чт','Пт','Сб','Вс'].forEach(day => html += `<div class="calendar-weekday">${day}</div>`);
    let dayCount = 1;
    for (let i = 1; i <= 42; i++) {
        if (i < startWeekday || dayCount > lastDay.getDate()) html += '<div class="calendar-day empty"></div>';
        else {
            const date = `${year}-${String(month+1).padStart(2,'0')}-${String(dayCount).padStart(2,'0')}`;
            html += `<div class="calendar-day ${date === calendarState.selectedDate ? 'selected' : ''}" onclick="selectDate('${date}')">${dayCount}</div>`;
            dayCount++;
        }
    }
    container.innerHTML = html + '</div>';
}
async function selectDate(date) {
    calendarState.selectedDate = date;
    document.getElementById('bookingDate').value = date;
    renderCalendar();
    if (typeof loadTables === 'function') await loadTables(date);
    document.querySelector('.modal-tab[data-tab="tables"]')?.click();
    Toast.show(`Выбрана дата: ${date.split('-').reverse().join('.')}`, 'success');
}
function changeMonth(delta) { calendarState.currentDate.setMonth(calendarState.currentDate.getMonth() + delta); renderCalendar(); }
function getMonthName(month) { return ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'][month]; }
function initCalendar() { calendarState.selectedDate = new Date().toISOString().split('T')[0]; renderCalendar(); }
document.addEventListener('DOMContentLoaded', initCalendar);
window.selectDate = selectDate;
window.changeMonth = changeMonth;