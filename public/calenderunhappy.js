document.addEventListener('DOMContentLoaded', async function() {
    const calendarEl = document.getElementById('calendar');

    try {
        // Laad lessen vanuit de API
        const response = await fetch('api/get_lessons.php');
        const lessons = await response.json();

        // Als er geen lessen zijn, doorsturen naar de foutpagina
        if (lessons.length === 0) {
            window.location.href = 'error.php';
            return; // Stop verdere uitvoering
        }

        // Initialize calendar
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            headerToolbar: {
                start: 'title',
                center: '',
                end: 'today prev,next'
            },
            events: lessons, // Gebruik de geladen lessen
            selectable: true,
            select: function(info) {
                const title = prompt("Voer de naam van de les in:");
                if (title) {
                    addLesson(title, info.startStr, info.endStr);
                }
            },
            eventClick: function(info) {
                if (confirm("Wil je deze les reserveren?")) {
                    reserveLesson(info.event.id);
                }
            }
        });

        calendar.render();

        // Week navigation
        document.getElementById('prevWeek').addEventListener('click', () => calendar.prev());
        document.getElementById('nextWeek').addEventListener('click', () => calendar.next());
    } catch (error) {
        console.error("Fout bij het laden van de kalender:", error);
        // Stuur alleen door naar error.php als er een ernstige fout optreedt
        if (!window.location.href.includes('error.php')) {
            window.location.href = 'error.php';
        }
    }
});

async function addLesson(title, start, end) {
    try {
        const response = await fetch('api/add_lesson.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ title, start, end })
        });
        const result = await response.json();
        alert(result.message);
        window.location.reload(); // Ververs de pagina na toevoegen
    } catch (error) {
        alert("Fout: " + error.message);
    }
}

async function reserveLesson(lessonId) {
    try {
        const response = await fetch('api/reserve.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ lesson_id: lessonId })
        });
        const result = await response.json();
        alert(result.message);
    } catch (error) {
        alert("Fout: " + error.message);
    }
}