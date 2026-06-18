let tablesState = { tables: [], selectedTableId: null, currentDate: new Date().toISOString().split('T')[0] };
async function loadTables(date) {
    tablesState.currentDate = date;
    tablesState.selectedTableId = null;
    try {
        const res = await fetch(`http://localhost/moonlight-garden/api/get_tables.php?date=${date}`);
        const data = await res.json();
        if (data.success) { tablesState.tables = data.tables; renderTablesGrid(); updateSubmitButton(); }
    } catch(e) { Toast.show('Ошибка загрузки столиков', 'error'); }
}
function renderTablesGrid() {
    const container = document.getElementById('tablesGrid');
    if (!container) return;
    const regular = tablesState.tables.filter(t => !t.is_vip);
    const vip = tablesState.tables.filter(t => t.is_vip);
    let html = `<div style="display:flex; justify-content:space-between; margin-bottom:15px;"><span>🟢 Свободно: ${regular.filter(t=>t.is_available).length + vip.filter(t=>t.is_available).length}</span><span>🔴 Занято: ${regular.filter(t=>!t.is_available).length + vip.filter(t=>!t.is_available).length}</span></div>`;
    html += `<div style="margin-bottom:10px;"><span style="color:#f8d56b;">✨ ОБЫЧНЫЕ</span></div><div class="tables-grid">`;
    regular.forEach(t => html += renderTableCard(t));
    html += '</div>';
    if (vip.length) html += `<div style="margin:15px 0 10px;"><span style="color:#ff9ec6;">👑 VIP СТОЛИКИ</span></div><div class="tables-grid vip-grid">${vip.map(t => renderTableCard(t, true)).join('')}</div>`;
    container.innerHTML = html;
}
function renderTableCard(t, isVip) {
    const canSelect = t.is_available;
    return `<div class="table-card ${t.is_available ? 'available' : 'booked'} ${tablesState.selectedTableId === t.id ? 'selected' : ''} ${isVip ? 'vip-card' : ''}" onclick="${canSelect ? `selectTable(${t.id}, ${t.capacity})` : ''}">
        <div class="table-number">${isVip ? '💎' : '🪑'} Стол ${t.number}</div>
        <div class="table-name">${t.name || ''}</div>
        <div class="table-capacity">👥 до ${t.capacity} чел</div>
        <div class="table-status status-${t.is_available ? 'available' : 'booked'}">${t.is_available ? 'Свободен' : 'Занят'}</div>
        ${isVip ? '<div class="vip-badge">VIP</div>' : ''}
    </div>`;
}
async function selectTable(tableId, capacity) {
    const table = tablesState.tables.find(t => t.id === tableId);
    if (!table || !table.is_available) { Toast.show('Столик уже забронирован!', 'warning'); return; }
    tablesState.selectedTableId = tableId;
    if (window.guestsCount > capacity) window.guestsCount = capacity;
    if (typeof updateGuestsDisplay === 'function') updateGuestsDisplay();
    renderTablesGrid();
    if (typeof updateSubmitButton === 'function') updateSubmitButton();
    if (typeof updateSelectedTableInfo === 'function') updateSelectedTableInfo(table);
    Toast.show(`Выбран столик ${table.number} (до ${capacity} чел)`, 'success');
    setTimeout(() => document.querySelector('.modal-tab[data-tab="form"]')?.click(), 300);
}
function updateSubmitButton() {
    const btn = document.querySelector('#bookingForm .form-submit');
    if (btn) { btn.disabled = !tablesState.selectedTableId; btn.textContent = tablesState.selectedTableId ? '✨ ПОДТВЕРДИТЬ БРОНЬ ✨' : '🪑 СНАЧАЛА ВЫБЕРИТЕ СТОЛИК'; }
}
function updateSelectedTableInfo(table) {
    const container = document.getElementById('selectedTableInfo');
    if (container) container.innerHTML = `<div class="selected-table-info">🍽️ Столик ${table.number} — ${table.name || ''}<br><small>${table.description || ''}</small><br>👥 Максимум: ${table.capacity} чел</div>`;
}
window.selectTable = selectTable;