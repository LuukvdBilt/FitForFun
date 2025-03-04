document.addEventListener('DOMContentLoaded', function() {
    const calendar = document.getElementById('calendar');

    // Clear existing content
    calendar.innerHTML = '';

    // Create days of the month
    const daysInMonth = 30; // Example: 30 days in a month
    for (let i = 1; i <= daysInMonth; i++) {
        const dayDiv = document.createElement('div');
        dayDiv.className = 'day';
        dayDiv.innerHTML = `<div>${i}</div>`;

        // Add events from PHP data
        // Assuming you have PHP data embedded in JavaScript variables
        const lesData = <?php echo json_encode($resultLes->fetch_all(MYSQLI_ASSOC)); ?>;
        const reserveringData = <?php echo json_encode($resultReservering->fetch_all(MYSQLI_ASSOC)); ?>;

        lesData.forEach(les => {
            if (new Date(les.Datum).getDate() === i) {
                const eventDiv = document.createElement('div');
                eventDiv.className = 'event';
                eventDiv.innerText = `Les: ${les.Naam} at ${les.Tijd}`;
                dayDiv.appendChild(eventDiv);
            }
        });

        reserveringData.forEach(reservering => {
            if (new Date(reservering.Datum).getDate() === i) {
                const eventDiv = document.createElement('div');
                eventDiv.className = 'event';
                eventDiv.innerText = `Reservering: ${reservering.Voornaam} ${reservering.Achternaam} at ${reservering.Tijd}`;
                dayDiv.appendChild(eventDiv);
            }
        });

        calendar.appendChild(dayDiv);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const navHamburger = document.querySelector('.nav-hamburger');
        const navbarNav = document.querySelector('.navbar-nav');
    
        navHamburger.addEventListener('click', function() {
            navbarNav.classList.toggle('active');
        });
    });
    
});