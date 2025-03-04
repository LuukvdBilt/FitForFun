document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');

    // Initialize calendar (happy scenario)
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridWeek',
        headerToolbar: {
            start: 'title',
            center: '',
            end: 'today prev,next'
        },
        events: lessons, // Gebruik de lessen uit PHP
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