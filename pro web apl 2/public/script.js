document.addEventListener('DOMContentLoaded', function () {
    let calendarEl = document.getElementById('calendar');

    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridWeek',
        events: 'api/get_lessons.php',
        selectable: true,
        select: function (info) {
            openModal();
            document.getElementById('lessonStart').value = info.startStr.replace('T', ' ');
            document.getElementById('lessonEnd').value = info.endStr.replace('T', ' ');
        },
        eventClick: function (info) {
            let confirmReserve = confirm("Wil je deze les reserveren?");
            if (confirmReserve) {
                reserveLesson(info.event.id);
            }
        }
    });

    calendar.render();

    // Week navigation
    document.getElementById('prevWeek').addEventListener('click', () => {
        calendar.prev();
    });

    document.getElementById('nextWeek').addEventListener('click', () => {
        calendar.next();
    });
});

// Modal functions
function openModal() {
    document.getElementById('lessonModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('lessonModal').style.display = 'none';
}

async function addLesson() {
    let title = document.getElementById('lessonTitle').value;
    let start = document.getElementById('lessonStart').value;
    let end = document.getElementById('lessonEnd').value;

    if (!title || !start || !end) {
        alert("Vul alle velden in!");
        return;
    }

    try {
        let response = await fetch('api/add_lesson.php', {
            method: 'POST',
            body: JSON.stringify({ title, start, end }),
            headers: { 'Content-Type': 'application/json' }
        });

        let result = await response.json();
        if (result.error) throw new Error(result.error);
        alert(result.message);
        closeModal();
        window.location.reload(); // Refresh the page
    } catch (error) {
        alert("Fout bij toevoegen van les: " + error.message);
    }
}

async function reserveLesson(lessonId) {
    try {
        let response = await fetch('api/reserve.php', {
            method: 'POST',
            body: JSON.stringify({ lesson_id: lessonId }),
            headers: { 'Content-Type': 'application/json' }
        });

        let result = await response.json();
        if (result.error) throw new Error(result.error);
        alert(result.message);
    } catch (error) {
        alert("Fout bij reserveren: " + error.message);
    }
}