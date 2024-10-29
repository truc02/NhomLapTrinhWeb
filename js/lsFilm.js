document.addEventListener('DOMContentLoaded', function() {
    const seatTable = document.getElementById('seat_table');
    const selectedSeatsList = document.getElementById('select_seat_list');
    const selectedSeats = new Set();

    seatTable.addEventListener('click', function(e) {
        if (e.target.tagName === 'TD') {
            const row = e.target.dataset.row;
            const seat = e.target.dataset.seat;
            const seatId = `${row}${seat}`;

            if (e.target.classList.contains('not-booked')) {
                e.target.classList.remove('not-booked');
                e.target.classList.add('booked');
                selectedSeats.add(seatId);
            } else if (e.target.classList.contains('booked')) {
                e.target.classList.remove('booked');
                e.target.classList.add('not-booked');
                selectedSeats.delete(seatId);
            }

            updateSelectedSeatsList();
        }
    });

    function updateSelectedSeatsList() {
        if (selectedSeats.size === 0) {
            selectedSeatsList.textContent = 'Chưa có ghế nào được chọn';
        } else {
            const seatArray = Array.from(selectedSeats).sort();
            selectedSeatsList.textContent = `Ghế đã chọn: ${seatArray.join(', ')}`;
        }
    }
});
