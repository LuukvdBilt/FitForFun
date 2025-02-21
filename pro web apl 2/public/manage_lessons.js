document.addEventListener('DOMContentLoaded', async () => {
    const lessonsList = document.getElementById('lessons-list');
    
    try {
        const response = await fetch('api/get_lessons.php');
        const lessons = await response.json();

        lessonsList.innerHTML = lessons.map(lesson => `
            <div class="lesson-card">
                <h3>${lesson.title}</h3>
                <p>Start: ${new Date(lesson.start).toLocaleString()}</p>
                <p>Einde: ${new Date(lesson.end).toLocaleString()}</p>
                <button onclick="deleteLesson(${lesson.id})">Verwijderen</button>
            </div>
        `).join('');
    } catch (error) {
        console.error("Fout bij laden:", error);
    }
});

document.getElementById('addLessonBtn').addEventListener('click', () => {
    window.location.href = 'calendar.html';
});

async function deleteLesson(lessonId) {
    try {
        const response = await fetch('api/delete_lesson.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ lesson_id: lessonId })
        });
        const result = await response.json();
        alert(result.message);
        window.location.reload();
    } catch (error) {
        alert("Fout: " + error.message);
    }
}