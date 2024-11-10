// Store separate slideIndex for each card
var slideIndices = {};

// Function to navigate slides
function plusSlides(n, cardId) {
    if (!slideIndices[cardId]) {
        slideIndices[cardId] = 1; // Initialize if not set
    }
    showSlides(slideIndices[cardId] += n, cardId);
}

// Function to show the appropriate slide
function showSlides(n, cardId) {
    var i;
    var card = document.getElementById("card-" + cardId); // Get the specific card container
    var slides = card.getElementsByClassName("slides"); // Get only the slides for that card

    // If current index exceeds the number of slides, reset to the first one
    if (n > slides.length) { slideIndices[cardId] = 1 }
    if (n < 1) { slideIndices[cardId] = slides.length }

    // Hide all slides in this card
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    // Show the current slide
    slides[slideIndices[cardId] - 1].style.display = "block";
}

// Initialize each card's first image on load
document.querySelectorAll('.cardimage').forEach((card, index) => {
    var cardId = index + 1;
    slideIndices[cardId] = 1;  // Initialize each card's slide index
    showSlides(1, cardId); // Show the first image for each card
});

// Card content onclick function
function viewer(productID) {
    window.location.href = `/pages/viewer.php?productID=${productID}`;
}
