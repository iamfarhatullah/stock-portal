// function searchTable() {
//   // Declare variables
//   var input, filter, table, tr, td, i, txtValue;
//   input = document.getElementById("searchInput");
//   filter = input.value.toUpperCase();
//   table = document.getElementById("search-table");
//   tr = table.getElementsByTagName("tr");

//   // Loop through all table rows, and hide those that don't match the search query
//   for (i = 1; i < tr.length; i++) {  // Start from 1 to avoid filtering the header row
//     tr[i].style.display = "none";    // Initially hide the row
//     tdCountry = tr[i].getElementsByTagName("td")[1];  // Get the country column
//     tdUni = tr[i].getElementsByTagName("td")[2];      // Get the university column
//     if (tdCountry || tdUni) {
//       if (tdCountry && tdCountry.innerHTML.toUpperCase().indexOf(filter) > -1 ||
//         tdUni && tdUni.innerHTML.toUpperCase().indexOf(filter) > -1) {
//         tr[i].style.display = "";   // If match found, show the row
//       }
//     }
//   }
// }


function searchStockTable() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("search-stock-table");
  tr = table.getElementsByTagName("tr");
  // Loop through all table rows in steps of 4
  for (i = 1; i < tr.length; i += 4) {  // Increment by 4 to process every 4 rows
    // Initially hide the 4 rows
    for (var j = i; j < i + 4 && j < tr.length; j++) {
      tr[j].style.display = "none";
    }
    // Check the first row of the 4-row group (or any of the rows if needed)
    tdProduct = tr[i].getElementsByTagName("td")[1];  // Get the column to search in
    if (tdProduct) {
      if (tdProduct.innerHTML.toUpperCase().indexOf(filter) > -1) {
        // Show all 4 rows if there is a match
        for (var j = i; j < i + 4 && j < tr.length; j++) {
          tr[j].style.display = "";
        }
      }
    }
  }
}


$(document).ready(function () {
  $('#sidebarCollapse').on('click', function () {
    $('#sidebar').toggleClass('active');
    $('.to-hide').toggle();
    $('[data-toggle="tooltip"]').tooltip();
  });
});

// // Function to show the dropdown
// function showDropdown() {
//   document.getElementById('dropdown').style.display = 'block';
//   filterItems();
// }

// // Function to filter items based on input and apply limit
// function filterItems() {
//   const input = document.getElementById('search').value.toLowerCase();
//   const items = document.querySelectorAll('.dropdown-item');
//   let visibleCount = 0; // Counter for visible items
//   const limit = 5; // Set the limit of items to display

//   items.forEach(item => {
//     if (item.textContent.toLowerCase().includes(input) && visibleCount < limit) {
//       item.style.display = ''; // Show the item
//       visibleCount++; // Increment the visible item count
//     } else {
//       item.style.display = 'none'; // Hide items beyond the limit
//     }
//   });
// }

// // Function to select an item
// function selectItem(value) {
//   document.getElementById('search').value = value;
//   document.getElementById('dropdown').style.display = 'none';
// }

// // Hide dropdown when clicking outside
// document.addEventListener('click', function (event) {
//   if (!document.getElementById('search').contains(event.target) &&
//     !document.getElementById('dropdown').contains(event.target)) {
//     document.getElementById('dropdown').style.display = 'none';
//   }
// });