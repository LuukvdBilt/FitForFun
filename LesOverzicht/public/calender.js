<<<<<<< HEAD
document.addEventListener('DOMContentLoaded', function() {
    const calendar = document.getElementById('calendar');
    const addLessonBtn = document.getElementById('addLessonBtn');
    const lessonFormContainer = document.getElementById('lessonFormContainer');
    const closeFormBtn = document.getElementById('closeFormBtn');
    const navHamburger = document.querySelector('.nav-hamburger');
    const navbarNav = document.querySelector('.navbar-nav');
    const openReservationModalBtn = document.getElementById('openReservationModal');

    addLessonBtn.addEventListener('click', function() {
        lessonFormContainer.style.display = 'block';
    });

    closeFormBtn.addEventListener('click', function() {
        lessonFormContainer.style.display = 'none';
    });

    navHamburger.addEventListener('click', function() {
        navbarNav.classList.toggle('active');
    });

    openReservationModalBtn.addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('reservationModal'));
        modal.show();
    });

    // Clear existing content
    calendar.innerHTML = '';

    // Create days of the month
    const daysInMonth = 30; // Example: 30 days in a month
    const lesData = <?php echo json_encode($resultLes->fetch_all(MYSQLI_ASSOC)); ?>;
    const reserveringData = <?php echo json_encode($resultReservering->fetch_all(MYSQLI_ASSOC)); ?>;

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

    // Modaal functionaliteit voor reservering
    const reservationForm = document.getElementById('reservationForm');
    reservationForm.addEventListener('submit', function(event) {
        event.preventDefault();

        // Haal de formuliergegevens op
        const voornaam = document.getElementById('voornaam').value;
        const tussenvoegsel = document.getElementById('tussenvoegsel').value;
        const achternaam = document.getElementById('achternaam').value;
        const nummer = document.getElementById('nummer').value;
        const lesId = document.getElementById('les').value;
        const datum = document.getElementById('datum').value;
        const tijd = document.getElementById('tijd').value;
        const opmerking = document.getElementById('opmerking').value;

        // Voer hier je AJAX-verzoek uit om de gegevens naar de server te sturen
        // Bijvoorbeeld met fetch API
        fetch('reservering_verwerken.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                voornaam: voornaam,
                tussenvoegsel: tussenvoegsel,
                achternaam: achternaam,
                nummer: nummer,
                lesId: lesId,
                datum: datum,
                tijd: tijd,
                opmerking: opmerking,
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Reservering succesvol!');
                // Sluit het modaal venster
                const modal = bootstrap.Modal.getInstance(document.getElementById('reservationModal'));
                modal.hide();
            } else {
                alert('Er is een fout opgetreden: ' + data.message);
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    });

    // Modaal functionaliteit voor les toevoegen
    const lessonForm = document.getElementById('lessonForm');
    lessonForm.addEventListener('submit', function(event) {
        event.preventDefault();

        // Haal de formuliergegevens op
        const lesNaam = document.getElementById('lesNaam').value;
        const lesDatum = document.getElementById('lesDatum').value;
        const lesTijd = document.getElementById('lesTijd').value;
        const lesBeschikbaarheid = document.getElementById('lesBeschikbaarheid').value;
        const lesMinAantalPersonen = document.getElementById('lesMinAantalPersonen').value;
        const lesMaxAantalPersonen = document.getElementById('lesMaxAantalPersonen').value;
        const lesPrijs = document.getElementById('lesPrijs').value;

        // Voer hier je AJAX-verzoek uit om de gegevens naar de server te sturen
        // Bijvoorbeeld met fetch API
        fetch('add_lesson.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                naam: lesNaam,
                datum: lesDatum,
                tijd: lesTijd,
                beschikbaarheid: lesBeschikbaarheid,
                minAantalPersonen: lesMinAantalPersonen,
                maxAantalPersonen: lesMaxAantalPersonen,
                prijs: lesPrijs,
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Les succesvol toegevoegd!');
                // Sluit het modaal venster
                const modal = bootstrap.Modal.getInstance(document.getElementById('lessonModal'));
                modal.hide();
            } else {
                alert('Er is een fout opgetreden: ' + data.message);
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    });
=======
document.addEventListener('DOMContentLoaded', function() {
    const calendar = document.getElementById('calendar');
    const addLessonBtn = document.getElementById('addLessonBtn');
    const lessonFormContainer = document.getElementById('lessonFormContainer');
    const closeFormBtn = document.getElementById('closeFormBtn');
    const navHamburger = document.querySelector('.nav-hamburger');
    const navbarNav = document.querySelector('.navbar-nav');
    const openReservationModalBtn = document.getElementById('openReservationModal');

    addLessonBtn.addEventListener('click', function() {
        lessonFormContainer.style.display = 'block';
    });

    closeFormBtn.addEventListener('click', function() {
        lessonFormContainer.style.display = 'none';
    });

    navHamburger.addEventListener('click', function() {
        navbarNav.classList.toggle('active');
    });

    openReservationModalBtn.addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('reservationModal'));
        modal.show();
    });

    // Clear existing content
    calendar.innerHTML = '';

    // Create days of the month
    const daysInMonth = 30; // Example: 30 days in a month
    const lesData = <?php echo json_encode($resultLes->fetch_all(MYSQLI_ASSOC)); ?>;
    const reserveringData = <?php echo json_encode($resultReservering->fetch_all(MYSQLI_ASSOC)); ?>;

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

    // Modaal functionaliteit voor reservering
    const reservationForm = document.getElementById('reservationForm');
    reservationForm.addEventListener('submit', function(event) {
        event.preventDefault();

        // Haal de formuliergegevens op
        const voornaam = document.getElementById('voornaam').value;
        const tussenvoegsel = document.getElementById('tussenvoegsel').value;
        const achternaam = document.getElementById('achternaam').value;
        const nummer = document.getElementById('nummer').value;
        const lesId = document.getElementById('les').value;
        const datum = document.getElementById('datum').value;
        const tijd = document.getElementById('tijd').value;
        const opmerking = document.getElementById('opmerking').value;

        // Voer hier je AJAX-verzoek uit om de gegevens naar de server te sturen
        // Bijvoorbeeld met fetch API
        fetch('reservering_verwerken.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                voornaam: voornaam,
                tussenvoegsel: tussenvoegsel,
                achternaam: achternaam,
                nummer: nummer,
                lesId: lesId,
                datum: datum,
                tijd: tijd,
                opmerking: opmerking,
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Reservering succesvol!');
                // Sluit het modaal venster
                const modal = bootstrap.Modal.getInstance(document.getElementById('reservationModal'));
                modal.hide();
            } else {
                alert('Er is een fout opgetreden: ' + data.message);
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    });

    // Modaal functionaliteit voor les toevoegen
    const lessonForm = document.getElementById('lessonForm');
    lessonForm.addEventListener('submit', function(event) {
        event.preventDefault();

        // Haal de formuliergegevens op
        const lesNaam = document.getElementById('lesNaam').value;
        const lesDatum = document.getElementById('lesDatum').value;
        const lesTijd = document.getElementById('lesTijd').value;
        const lesBeschikbaarheid = document.getElementById('lesBeschikbaarheid').value;
        const lesMinAantalPersonen = document.getElementById('lesMinAantalPersonen').value;
        const lesMaxAantalPersonen = document.getElementById('lesMaxAantalPersonen').value;
        const lesPrijs = document.getElementById('lesPrijs').value;

        // Voer hier je AJAX-verzoek uit om de gegevens naar de server te sturen
        // Bijvoorbeeld met fetch API
        fetch('add_lesson.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                naam: lesNaam,
                datum: lesDatum,
                tijd: lesTijd,
                beschikbaarheid: lesBeschikbaarheid,
                minAantalPersonen: lesMinAantalPersonen,
                maxAantalPersonen: lesMaxAantalPersonen,
                prijs: lesPrijs,
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Les succesvol toegevoegd!');
                // Sluit het modaal venster
                const modal = bootstrap.Modal.getInstance(document.getElementById('lessonModal'));
                modal.hide();
            } else {
                alert('Er is een fout opgetreden: ' + data.message);
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    });
>>>>>>> 13a619e0830d919375331b36a17d7db2dbc968d9
});