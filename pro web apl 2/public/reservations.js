document.addEventListener('DOMContentLoaded', async () => {
    const reservationsList = document.getElementById('reservations-list');
    
    try {
        const response = await fetch('api/get_reservations.php');
        const reservations = await response.json();

        reservationsList.innerHTML = reservations.map(res => `
            <div class="reservation-card">
                <h3>${res.title}</h3>
                <p>${new Date(res.start_time).toLocaleString()}</p>
                <button onclick="cancelReservation(${res.id})">Annuleren</button>
            </div>
        `).join('');
    } catch (error) {
        console.error("Fout bij laden:", error);
    }
});

async function cancelReservation(reservationId) {
    try {
        const response = await fetch('api/cancel_reservation.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ reservation_id: reservationId })
        });
        const result = await response.json();
        alert(result.message);
        window.location.reload();
    } catch (error) {
        alert("Fout: " + error.message);
    }
}