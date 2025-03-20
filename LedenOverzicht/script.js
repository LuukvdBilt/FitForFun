function toggleSearch() {
    var searchInput = document.getElementById('searchInput');
    searchInput.style.display = (searchInput.style.display === 'none' || searchInput.style.display === '') ? 'inline' : 'none';
}

function searchTable() {
    var input = document.getElementById("searchInput");
    var filter = input.value.toUpperCase();
    var table = document.querySelector("table");
    var tr = table.getElementsByTagName("tr");
    var found = false;

    // loop through table rows, skip header
    for (var i = 1; i < tr.length; i++) {
        var td = tr[i].getElementsByTagName("td")[2]; // Achternaam column
        if (td) {
            var txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
                found = true;
            } else {
                tr[i].style.display = "none";
            }
        }
    }

    var noResultsAlert = document.getElementById("noResultsAlert");
    noResultsAlert.style.display = found ? "none" : "block";
}