<<<<<<< HEAD
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.buttonfirstpage').addEventListener('click', function() {
        window.location.href = '../AanbiedingenPagina/aanbiedingen.php';
    });
=======
// btncard href
// test
>>>>>>> f57d5144e69dff1444db3c36b4b6caacfb425cc7

    document.querySelectorAll('.btnbasics').forEach(function(button) {
        button.addEventListener('click', function() {
            if (button.textContent.includes('Aanbiedingen')) {
                window.location.href = '../AanbiedingenPagina/aanbiedingen.php';
            } else if (button.textContent.includes('Learn More')) {
                window.location.href = '../Geplande-lessen/index.php';
            } else if (button.textContent.includes('Get Started')) {
                window.location.href = '../AccountsOverzicht/login.php';
            } else if (button.textContent.includes('Follow Us')) {
                window.location.href = 'https://www.facebook.com/FitForFun';
            }
        });
    });
});