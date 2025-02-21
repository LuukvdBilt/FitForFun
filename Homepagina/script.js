// btncard href
const navLink = document.querySelector('.nav-link-Home');

navLink.addEventListener('click', function(){
    window.location.href = 'index.php';
    alert('U bevindt zich al plaats op de Homepagina');
});


const btnCards = document.querySelectorAll('.btncard');

btnCards.forEach((btn, index) => {
    btn.addEventListener('click', () => {
        if (index === 0) {
            window.location.href = 'aanbiedingen.php';
        } else if (index === 1) {
            window.location.href = 'lessen.php';
        }
    });
});
