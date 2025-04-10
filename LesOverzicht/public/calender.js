document.addEventListener('DOMContentLoaded', function() {
    const calendar = document.getElementById('calendar');
    const addLessonBtn = document.getElementById('addLessonBtn');
    const lessonFormContainer = document.getElementById('lessonFormContainer');
    const closeFormBtn = document.getElementById('closeFormBtn');
    const navHamburger = document.querySelector('.nav-hamburger');
    const navbarNav = document.querySelector('.navbar-nav');
    const openReservationModalBtn = document.getElementById('openReservationModal');

    // Data injected via PHP
    const daysInMonth = 30; // Or dynamically calculate based on month
    const lesData = JSON.parse(document.getElementById('lesData').textContent);
    const reserveringData = JSON.parse(document.getElementById('reserveringData').textContent);

    // Hamburger menu toggle
    navHamburger.addEventListener('click', function() {
        navbarNav.classList.toggle('active');
    });

    // Show lesson form
    addLessonBtn.addEventListener('click', function() {
        lessonFormContainer.style.display = 'block';
    });

    // Close lesson form
    closeFormBtn.addEventListener('click', function() {
        lessonFormContainer.style.display = 'none';
    });

    // Show reservation modal
    openReservationModalBtn.addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('reservationModal'));
        modal.show();
    });

    // Clear calendar content
    calendar.innerHTML = '';

    // Build calendar
    for (let i = 1; i <= daysInMonth; i++) {
        const dayDiv = document.createElement('div');
        dayDiv.className = 'day';
        dayDiv.innerHTML = `<div>${i}</div>`;

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

    // Handle reservation form submit
    const reservationForm = document.getElementById('reservationForm');
    reservationForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const data = {
            voornaam: document.getElementById('voornaam').value,
            tussenvoegsel: document.getElementById('tussenvoegsel').value,
            achternaam: document.getElementById('achternaam').value,
            nummer: document.getElementById('nummer').value,
            lesId: document.getElementById('les').value,
            datum: document.getElementById('datum').value,
            tijd: document.getElementById('tijd').value,
            opmerking: document.getElementById('opmerking').value
        };

        fetch('reservering_verwerken.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Reservering succesvol!');
                bootstrap.Modal.getInstance(document.getElementById('reservationModal')).hide();
            } else {
                alert('Fout: ' + data.message);
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    });

    // Handle lesson form submit
    const lessonForm = document.getElementById('lessonForm');
    lessonForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const data = {
            naam: document.getElementById('lesNaam').value,
            datum: document.getElementById('lesDatum').value,
            tijd: document.getElementById('lesTijd').value,
            beschikbaarheid: document.getElementById('lesBeschikbaarheid').value,
            minAantalPersonen: document.getElementById('lesMinAantalPersonen').value,
            maxAantalPersonen: document.getElementById('lesMaxAantalPersonen').value,
            prijs: document.getElementById('lesPrijs').value
        };

        fetch('add_lesson.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Les succesvol toegevoegd!');
                bootstrap.Modal.getInstance(document.getElementById('lessonModal')).hide();
            } else {
                alert('Fout: ' + data.message);
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    });
});
