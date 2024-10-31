// Variable to keep track of the current image index
let currentSlide = 0;

// Get all images from the img-showcase and img-select sections
const imgShowcase = document.querySelector('.img-showcase');
const imgSelect = document.querySelectorAll('.img-select .small-img img');

// Function to show the selected image
function showImg(index) {
  currentSlide = index; // Update current slide index
  updateImage(); // Display the selected image
}

// Function to navigate through images with next/previous buttons
function plusSlides(n) {
  currentSlide += n; // Update current slide index by n (-1 or 1)
    if (currentSlide >= imgSelect.length) {
    currentSlide = 0; // Loop back to the first image
    } else if (currentSlide < 0) {
    currentSlide = imgSelect.length - 1; // Loop back to the last image
    }
  updateImage(); // Display the new image
}

// Function to update the displayed image based on currentSlide index
function updateImage() {
    imgShowcase.innerHTML = `<img src="${imgSelect[currentSlide].src}" alt="Vehicle Image">`;
}

// Add event listeners to thumbnails for clicking functionality
imgSelect.forEach((img, index) => {
    img.addEventListener('click', () => showImg(index));
});
