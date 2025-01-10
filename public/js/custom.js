function searchTable() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("search-table");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those that don't match the search query
  for (i = 1; i < tr.length; i++) {  // Start from 1 to avoid filtering the header row
    tr[i].style.display = "none";    // Initially hide the row
    tdCountry = tr[i].getElementsByTagName("td")[1];  // Get the country column
    tdUni = tr[i].getElementsByTagName("td")[2];      // Get the university column
    if (tdCountry || tdUni) {
      if (tdCountry && tdCountry.innerHTML.toUpperCase().indexOf(filter) > -1 || 
          tdUni && tdUni.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";   // If match found, show the row
      }
    } 
  }
}

function removeCallout(url) {
  url = url.split( '?' )[0];
  window.location.replace(url)
}

$(document).ready(function () {
	$('#sidebarCollapse').on('click', function () {
		$('#sidebar').toggleClass('active');
		$('.to-hide').toggle();
		$('[data-toggle="tooltip"]').tooltip();
	});
});

// $("#menu-toggle").click( function(e) {
// 	e.preventDefault();
// 	$("#wrapper").toggleClass("menuDisplayed");
// });

$('#password, #confirm_password').on('keyup', function () {
  if ($('#password').val() == $('#confirm_password').val()) {
    $('#sign-up-btn').prop('disabled', false);
    $('#sign-up-btn').css('cursor', 'pointer');
    $('#confirm_password').css('border', '1px solid green');
    $('#password').css('border', '1px solid green');
  } else {
    $('#sign-up-btn').prop('disabled', true);
    $('#sign-up-btn').css('cursor', 'not-allowed');
    $('#confirm_password').css('border', '1px solid red');
    $('#password').css('border', '1px solid red');
  }
});

function showPassword() {
		var newPassword = document.getElementById('password');
		var confirmPassword = document.getElementById('confirm_password');
		if (newPassword.type === "password") {
			newPassword.type = "text";
			confirmPassword.type = "text";
		}else{
			newPassword.type = "password";
			confirmPassword.type = "password";
		}
	}


// Function to show the dropdown
        function showDropdown() {
            document.getElementById('dropdown').style.display = 'block';
            filterItems();
        }

        // Function to filter items based on input and apply limit
        function filterItems() {
            const input = document.getElementById('search').value.toLowerCase();
            const items = document.querySelectorAll('.dropdown-item');
            let visibleCount = 0; // Counter for visible items
            const limit = 5; // Set the limit of items to display

            items.forEach(item => {
                if (item.textContent.toLowerCase().includes(input) && visibleCount < limit) {
                    item.style.display = ''; // Show the item
                    visibleCount++; // Increment the visible item count
                } else {
                    item.style.display = 'none'; // Hide items beyond the limit
                }
            });
        }

        // Function to select an item
        function selectItem(value) {
            document.getElementById('search').value = value;
            document.getElementById('dropdown').style.display = 'none';
        }

        // Hide dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!document.getElementById('search').contains(event.target) && 
                !document.getElementById('dropdown').contains(event.target)) {
                document.getElementById('dropdown').style.display = 'none';
            }
        });



// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("cancel")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
        