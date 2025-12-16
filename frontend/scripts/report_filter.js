document.addEventListener('DOMContentLoaded', () => {
    const roomSelect = document.querySelector('select[name="room"]');
    const statusSelect = document.querySelector('select[name="status"]');
    const reportCards = document.querySelectorAll('.report-content-card');

    function filterReports() {
        const roomValue = roomSelect.value;
        const statusValue = statusSelect.value;

        reportCards.forEach(card => {
            const cardRoom = card.dataset.room;
            const cardStatus = card.dataset.status;

            let show = true;

            // Room check
            if (roomValue !== 'all') {
                if (roomValue === 'classroom') {
                    // Check if roomName matches classroom pattern
                    if (!/^[A-E]-0[0-9]-0[0-9]$/.test(cardRoom)) show = false;
                } else if (roomValue === 'lecture') {
                    // Check if roomName matches lecture pattern (Audi)
                    if (!/^Audi[1-9] @ Level[1-7]$/.test(cardRoom)) show = false;
                }
            }

            // status check
            if (statusValue !== 'all' && cardStatus !== statusValue) show = false;

            card.style.display = show ? 'flex' : 'none';
        });
    }

    roomSelect.addEventListener('change', filterReports);
    statusSelect.addEventListener('change', filterReports);

    filterReports(); // Initial filter
});