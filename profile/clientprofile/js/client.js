function tabselect(event, tabName) {
    event.preventDefault();

    // Remove the active class from all links
    var tabLinks = document.querySelectorAll("nav ul li a");
    tabLinks.forEach(link => {
        link.classList.remove("active-link");
    });

    // Hide all tab contents
    var tabContents = document.getElementsByClassName("tab-content");
    for (var i = 0; i < tabContents.length; i++) {
        tabContents[i].style.display = "none";
    }

    // Show the selected tab content
    document.getElementById(tabName).style.display = "block";

    // Add active class to the clicked link
    event.target.classList.add("active-link");
}

// Function to set the default active tab
function setDefaultTab() {
    const defaultTab = 'favourites'; // Set this to the default tab ID
    document.querySelector(`nav ul li a[onclick*="${defaultTab}"]`).classList.add("active-link");
    document.getElementById(defaultTab).style.display = "block";
}

// Call the function to set the default tab when the page loads
window.onload = setDefaultTab;

// Password toggle
function showpassword()
{
    var x = document.querySelector('input[name="password"]');
    if(x.type === "password")
    {
        x.type = "text";
    }
    else
    {
        x.type = "password";
    }
}

//Test form JS
function addTest() {
// Create a modal overlay for dim background effect
const overlay = document.createElement('div');
overlay.classList.add('modal-overlay');
document.body.appendChild(overlay);

// Show the test form
const testForm = document.getElementById('testform');
testForm.style.display = 'block';

// Hide the form and overlay when clicked outside
overlay.addEventListener('click', () => {
    testForm.style.display = 'none';
    document.body.removeChild(overlay);
});

// Hide on escape key press
document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        testForm.style.display = 'none';
        document.body.removeChild(overlay);
    }
});
}