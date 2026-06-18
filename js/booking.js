let guestsCount = 2;
function initPhoneMask() {
    const phone = document.getElementById('phone');
    if (!phone) return;
    phone.value = '+7 ';
    phone.oninput = function() {
        let digits = this.value.replace(/[^\d]/g, '');
        if (digits.startsWith('7')) digits = digits.substring(1);
        if (digits.startsWith('8')) digits = '7' + digits.substring(1);
        if (digits.length > 10) digits = digits.substring(0, 10);
        let formatted = '+7';
        if (digits.length > 0) formatted += ' ' + digits.substring(0, 3);
        if (digits.length >= 3) formatted += ' ' + digits.substring(3, 6);
        if (digits.length >= 6) formatted += '-' + digits.substring(6, 8);
        if (digits.length >= 8) formatted += '-' + digits.substring(8, 10);
        this.value = formatted;
        this.style.borderColor = digits.length === 10 ? '#4caf50' : '#f44336';
    };
    phone.onkeydown = function(e) { if ((e.key === 'Backspace' || e.key === 'Delete') && this.selectionStart <= 2) e.preventDefault(); };
}
function updateGuestsDisplay() {
    const display = document.getElementById('guestsValue');
    if (display) display.textContent = guestsCount;
    const table = tablesState.tables.find(t => t.id === tablesState.selectedTableId);
    const max = table ? table.capacity : 10;
    document.getElementById('guestsMinus').disabled = guestsCount <= 1;
    document.getElementById('guestsPlus').disabled = guestsCount >= max;
}
function changeGuests(delta) {
    const table = tablesState.tables.find(t => t.id === tablesState.selectedTableId);
    if (!table) { Toast.show('Сначала выберите столик!', 'warning'); return; }
    const newVal = guestsCount + delta;
    if (newVal >= 1 && newVal <= table.capacity) { guestsCount = newVal; updateGuestsDisplay(); }
    else if (newVal > table.capacity) Toast.show(`Столик вмещает до ${table.capacity} гостей`, 'warning');
}
function getCleanPhone() {
    const digits = document.getElementById('phone').value.replace(/[^\d]/g, '');
    return digits.startsWith('7') ? '+' + digits : '+7' + digits;
}
async function submitBooking(name) {
    if (!tablesState.selectedTableId) { Toast.show('Выберите столик!', 'warning'); return false; }
    const phone = getCleanPhone();
    if (phone.length !== 12) { Toast.show('Введите номер полностью (10 цифр)', 'warning'); return false; }
    const table = tablesState.tables.find(t => t.id === tablesState.selectedTableId);
    if (guestsCount > table.capacity) { Toast.show(`Максимум ${table.capacity} гостей`, 'warning'); return false; }
    try {
        const res = await fetch('http://localhost/moonlight-garden/api/save_booking.php', {
            method: 'POST', headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ name, phone, date: tablesState.currentDate, guests: guestsCount, table_id: tablesState.selectedTableId })
        });
        const result = await res.json();
        if (result.success) {
            showSuccessModal(table);
            await loadTables(tablesState.currentDate);
            return true;
        } else { Toast.show(result.message, 'error'); return false; }
    } catch(e) { Toast.show('Ошибка соединения', 'error'); return false; }
}
function showSuccessModal(table) {
    let existing = document.getElementById('successModal');
    if (existing) existing.remove();
    const guestWord = (n => { if (n%10===1 && n%100!==11) return 'гость'; if ([2,3,4].includes(n%10) && ![12,13,14].includes(n%100)) return 'гостя'; return 'гостей'; })(guestsCount);
    const html = `<div id="successModal" class="modal" style="display:block; z-index:1001;"><div class="modal-content" style="max-width:350px; text-align:center;"><div style="font-size:50px;">${table.is_vip ? '👑✨' : '🎉✨'}</div><h2 style="color:#f8d56b;">БРОНЬ ПОДТВЕРЖДЕНА!</h2><p>Столик ${table.number}<br>${table.name || ''}<br>📅 ${tablesState.currentDate.split('-').reverse().join('.')}<br>👥 ${guestsCount} ${guestWord}</p><div style="background:rgba(248,213,107,0.1); padding:12px; border-radius:10px;">📞 Позвоним за 4 часа до брони</div><button onclick="closeSuccessModal()" class="btn" style="margin-top:15px;">✨ ОТЛИЧНО ✨</button></div></div>`;
    document.body.insertAdjacentHTML('beforeend', html);
    document.body.style.overflow = 'hidden';
    document.getElementById('bookingModal').style.display = 'none';
}
function closeSuccessModal() {
    document.getElementById('successModal')?.remove();
    document.body.style.overflow = 'auto';
    document.getElementById('bookingForm')?.reset();
    document.getElementById('phone').value = '+7 ';
    tablesState.selectedTableId = null;
    guestsCount = 2;
    updateGuestsDisplay();
    updateSubmitButton();
    document.getElementById('selectedTableInfo').innerHTML = '';
    document.querySelector('.modal-tab[data-tab="calendar"]')?.click();
    document.getElementById('bookingModal').style.display = 'block';
}
function initBookingForm() {
    initPhoneMask();
    document.getElementById('guestsMinus').onclick = () => changeGuests(-1);
    document.getElementById('guestsPlus').onclick = () => changeGuests(1);
    document.getElementById('bookingForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const name = document.getElementById('name').value.trim();
        if (!name) { Toast.show('Введите имя', 'warning'); return; }
        const btn = e.target.querySelector('.form-submit');
        const original = btn.textContent;
        btn.textContent = '⏳ БРОНИРУЕМ...';
        btn.disabled = true;
        const success = await submitBooking(name);
        if (success) { e.target.reset(); document.getElementById('phone').value = '+7 '; guestsCount = 2; updateGuestsDisplay(); }
        btn.textContent = original;
        btn.disabled = false;
    });
}
document.addEventListener('DOMContentLoaded', initBookingForm);
window.changeGuests = changeGuests;
window.closeSuccessModal = closeSuccessModal;