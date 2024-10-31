// PHP array for images from hidden input
const images = JSON.parse(document.getElementById('images-data').value);

// Start with first image
let currentIndex = 1;

// Main displaying image
const mainImage = document.getElementById('first');

// Image row (container for thumbnails)
const imgRow = document.querySelector('.imgrow');

// Thumbnail images
const thumbnailElements = document.querySelectorAll('.thumbnails img');

// Function to display an image based on index
function showImage(index) {
    if (index >= 0 && index < images.length) {
        currentIndex = index;

        // Updating the main image
        mainImage.src = '/inventory/' + images[currentIndex];

        // Calculate scroll position based on the thumbnail width
        const thumbnail = thumbnailElements[currentIndex];
        const thumbnailWidth = thumbnail.offsetWidth + parseInt(window.getComputedStyle(thumbnail).marginRight);
        const rowScrollPosition = thumbnail.offsetLeft - (imgRow.offsetWidth / 2) + (thumbnailWidth / 2);

        // Scroll the thumbnail row (imgRow) without scrolling the page
        imgRow.scrollTo({ left: rowScrollPosition, behavior: 'smooth' });

        // Update the thumbnail opacity
        thumbnailElements.forEach((thumb, i) => {
            thumb.classList.toggle('in-view', i === currentIndex);
        });
    }
}

// Function for previous button
function prevImg() {
    let newIndex = currentIndex - 1;
    if (newIndex < 0) {
        // Looping to last image
        newIndex = images.length - 1;
    }
    showImage(newIndex);
}

// Function for next button
function nextImg() {
    let newIndex = currentIndex + 1;
    if (newIndex >= images.length) {
        newIndex = 0; // Loop back to the first image
    }
    showImage(newIndex);
}

// Function to display image when clicking a thumbnail
function showImg(imgIndex) {
    showImage(imgIndex);
}

// Thumbnail event listeners
thumbnailElements.forEach((thumbnail, index) => {
    thumbnail.addEventListener('click', () => showImg(index));
});

// Intersection Observer to handle fade-in and fade-out effects
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            // Add in/out view when in view
            entry.target.classList.add('in-view');
        } else {
            // Remove in/out view when out of view
            entry.target.classList.remove('in-view');
        }
    });
}, {
    // Scrolling container
    root: document.querySelector('.imgrow'),
    // 50% visibility for scrolling
    threshold: 0.5
});

// Observe each thumbnail
thumbnailElements.forEach(image => {
    observer.observe(image);
});


// Script for tabs
// Function to handle tab selection
function selecttab(event, tabName) {
    // Hide all tab content by default
    var i, tabContent;
    tabContent = document.querySelectorAll(".tabs > div:not(.btns)");
    for (i = 0; i < tabContent.length; i++) {
        tabContent[i].style.display = "none";
    }

    // Show the clicked tab content
    document.querySelector("." + tabName).style.display = "block";

    // Remove active state from all buttons
    var tabButtons = document.querySelectorAll(".btns button");
    for (i = 0; i < tabButtons.length; i++) {
        tabButtons[i].classList.remove("active");
    }

    // Add active state to the clicked button
    event.currentTarget.classList.add("active");

    // Prevent the page from scrolling when a tab is selected
    event.preventDefault();
}

// Make "Performance" tab active by default on page load
window.onload = function() {
    // Hide all tab content except for "Performance"
    var tabContent = document.querySelectorAll(".tabs > div:not(.btns)");
    for (var i = 0; i < tabContent.length; i++) {
        tabContent[i].style.display = "none";
    }
    
    // Show the "Performance" tab content by default
    document.querySelector(".performancestats").style.display = "block";
    
    // Set the first button (Performance) as active
    document.querySelector(".btns button").classList.add("active");
};

// Fullscreen function
function fullscreen() {
    const imgHolder = document.querySelector('.imgholder');
    const imgRow = document.querySelector('.imgrow'); // Thumbnail row

    // Hide the imgrow when entering fullscreen
    imgRow.style.display = 'none';

    if (imgHolder.requestFullscreen) {
        imgHolder.requestFullscreen();
    } else if (imgHolder.mozRequestFullScreen) { // Firefox
        imgHolder.mozRequestFullScreen();
    } else if (imgHolder.webkitRequestFullscreen) { // Chrome, Safari, Opera
        imgHolder.webkitRequestFullscreen();
    } else if (imgHolder.msRequestFullscreen) { // IE/Edge
        imgHolder.msRequestFullscreen();
    }

    // Event listener to detect exit from fullscreen
    document.addEventListener('fullscreenchange', exitHandler);
    document.addEventListener('webkitfullscreenchange', exitHandler);
    document.addEventListener('mozfullscreenchange', exitHandler);
    document.addEventListener('MSFullscreenChange', exitHandler);

    // Add event listener for keyboard navigation when in fullscreen
    document.addEventListener('keydown', handleKeyDown);
}

// Function to handle keyboard arrow key presses for image navigation
function handleKeyDown(e) {
    if (e.key === 'ArrowLeft') {
        prevImg(); // Move to the previous image
    } else if (e.key === 'ArrowRight') {
        nextImg(); // Move to the next image
    }
}

// Function to restore the page after exiting fullscreen
function exitHandler() {
    const imgRow = document.querySelector('.imgrow');

    if (!document.fullscreenElement && !document.webkitFullscreenElement && !document.mozFullScreenElement && !document.msFullscreenElement) {
        // Show the imgrow again after exiting fullscreen
        imgRow.style.display = 'grid';

        // Remove the keyboard event listener after exiting fullscreen
        document.removeEventListener('keydown', handleKeyDown);
    }
}

//Function to toggle favourites


// // Function to toggle the favorites status
// function toggleFavourites(element) {
//     // Get the item ID from the data-id attribute
//     var itemId = element.getAttribute('data-id');
    
//     // Check if this item is already in favorites (using localStorage as an example)
//     var favourites = JSON.parse(localStorage.getItem('favourites')) || [];

//     if (favourites.includes(itemId)) {
//         // If it's already a favorite, remove it
//         favourites = favourites.filter(function(id) {
//             return id !== itemId;
//         });
//         element.classList.remove('favorited'); // Optional: to visually unmark the bookmark
//         element.title = "Add to favourites";
//     } else {
//         // If not a favorite, add it
//         favourites.push(itemId);
//         element.classList.add('favorited'); // Optional: to visually mark the bookmark
//         element.title = "Remove from favourites";
//     }

//     // Save the updated favorites back to localStorage
//     localStorage.setItem('favourites', JSON.stringify(favourites));
// }

// // Function to initialize the favorites status when the page loads
// function initializeFavourites() {
//     var favourites = JSON.parse(localStorage.getItem('favourites')) || [];
//     document.querySelectorAll('.material-symbols-outlined').forEach(function(element) {
//         var itemId = element.getAttribute('data-id');
//         if (favourites.includes(itemId)) {
//             element.classList.add('favorited'); // Mark as favorited
//             element.title = "Remove from favourites";
//         }
//     });
// }

// // Call the initialize function when the page loads
// window.onload = initializeFavourites;
