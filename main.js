const menuBtn = document.getElementById("menu-btn");
const navLinks = document.getElementById("nav-links");
const menuBtnIcon = menuBtn.querySelector("i");

menuBtn.addEventListener("click", (e) => {
  navLinks.classList.toggle("open");

  const isOpen = navLinks.classList.contains("open");
  menuBtnIcon.setAttribute("class", isOpen ? "ri-close-line" : "ri-menu-line");
});

navLinks.addEventListener("click", (e) => {
  navLinks.classList.remove("open");
  menuBtnIcon.setAttribute("class", "ri-menu-line");
});

const scrollRevealOption = {
  distance: "50px",
  origin: "bottom",
  duration: 1000,
};

ScrollReveal().reveal(".header__image img", {
  ...scrollRevealOption,
  origin: "right",
});
ScrollReveal().reveal(".header__content h1", {
  ...scrollRevealOption,
  delay: 500,
});
ScrollReveal().reveal(".header__content p", {
  ...scrollRevealOption,
  delay: 1000,
});
ScrollReveal().reveal(".header__links", {
  ...scrollRevealOption,
  delay: 1500,
});

ScrollReveal().reveal(".steps__card", {
  ...scrollRevealOption,
  interval: 500,
});

ScrollReveal().reveal(".service__image img", {
  ...scrollRevealOption,
  origin: "left",
});
ScrollReveal().reveal(".service__content .section__subheader", {
  ...scrollRevealOption,
  delay: 500,
});
ScrollReveal().reveal(".service__content .section__header", {
  ...scrollRevealOption,
  delay: 1000,
});
ScrollReveal().reveal(".service__list li", {
  ...scrollRevealOption,
  delay: 1500,
  interval: 500,
});

ScrollReveal().reveal(".experience__card", {
  duration: 1000,
  interval: 500,
});

// ScrollReveal().reveal(".download__image img", {
//   ...scrollRevealOption,
//   origin: "right",
// });
// ScrollReveal().reveal(".download__content .section__header", {
//   ...scrollRevealOption,
//   delay: 500,
// });
// ScrollReveal().reveal(".download__content p", {
//   ...scrollRevealOption,
//   delay: 1000,
// });
// ScrollReveal().reveal(".download__links", {
//   ...scrollRevealOption,
//   delay: 1500,
// });

//Slideshow
document.addEventListener("DOMContentLoaded", function() {
    let slideIndex = 0;
    const slides = document.querySelectorAll(".slide");

    function showSlides() {
        // Hide all slides
        slides.forEach(slide => slide.style.display = "none");

        // Increment index, reset if at the end
        slideIndex = (slideIndex + 1) % slides.length;
        
        // Display current slide
        slides[slideIndex].style.display = "block";
    }

    // Initial call and interval setting
    showSlides();
    setInterval(showSlides, 5000); // Change slide every 5 seconds
});

// Cart Data Structure
let cart = {};

// Show/Hide Cart Side Panel
function openCart() {
    document.getElementById('cartSidePanel').classList.add('open');
}

function closeCart() {
    document.getElementById('cartSidePanel').classList.remove('open');
}

// Add to Cart Functionality
function addToCart(productID, productName, productPrice, maxQuantity) {
    if (!cart[productID]) {
        cart[productID] = { name: productName, price: productPrice, quantity: 1, maxQuantity: maxQuantity };
    } else if (cart[productID].quantity < maxQuantity) {
        cart[productID].quantity++;
    }
    renderCart();
    openCart();
}

// Update Quantity
function updateQuantity(productID, change) {
  if (cart[productID]) {
      cart[productID].quantity += change;
      if (cart[productID].quantity <= 0) {
          delete cart[productID];
      } else if (cart[productID].quantity > cart[productID].maxQuantity) {
          cart[productID].quantity = cart[productID].maxQuantity;
      }
      localStorage.setItem('cart', JSON.stringify(cart));
      renderCart();
  }
}

// Render Cart
function renderCart() {
    const cartItemsContainer = document.getElementById('cartItems');
    cartItemsContainer.innerHTML = '';
    for (const [productID, item] of Object.entries(cart)) {
        const itemElement = document.createElement('div');
        itemElement.classList.add('cart-item');
        itemElement.innerHTML = `
            <span>${item.name}</span>
            <span>${(item.price * item.quantity).toFixed(2)} KES</span>
            <button class="counter" onclick="updateQuantity('${productID}', -1)">-</button>
            <span>${item.quantity}</span>
            <button class="counter" onclick="updateQuantity('${productID}', 1)">+</button>
        `;

        function countItems() {
            let itemCount = 0;
            for (const item of Object.values(cart)) {
                itemCount += item.quantity;
            }
            return itemCount;
        }

        document.getElementById('itemCount').innerHTML = countItems();
        cartItemsContainer.appendChild(itemElement);
    }
}

// Place Order
function placeOrder() {
    if (Object.keys(cart).length === 0) {
        alert('Your cart is empty!');
        return;
    }
    alert('Order placed!');
    cart = {};
    localStorage.removeItem('cart');
    renderCart();
    closeCart();
}

renderCart();

// Event to open cart when the cart icon is clicked
document.querySelector('.icon-cart').addEventListener('click', openCart);
