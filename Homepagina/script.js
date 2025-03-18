// btncard href

const navLinks = document.querySelectorAll('.nav-link-Home');
navLinks.forEach(navLink => {
    navLink.addEventListener('click', function(){
        window.location.href = 'index.php';
        alert('U bevindt zich al plaats op de Homepagina');
    });    
});

const btnCards = document.querySelectorAll('.btncard');

btnCards.forEach((btn, index) => {
    btn.addEventListener('click', () => {
        if (index === 0) {
            window.location.href = '../AanbiedingenPagina/aanbiedingen.php';
        } else if (index === 1) {
            window.location.href = 'lessen.php';
        } else if (index === 2) {
            window.location.href = 'contact.php';
        } else if (index === 3) {
            window.location.href = 'about.php';
        }
    });
});