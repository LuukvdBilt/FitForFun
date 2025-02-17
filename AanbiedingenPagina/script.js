// de foutmelding:
window.addEventListener('error', function() {
    alert('Er is een fout opgetreden bij het laden van de pagina. Probeer het later opnieuw.');
    window.location.href = 'Homepagina/index.html';
});

//een fout veroorzaken
//nonExistentFunction();