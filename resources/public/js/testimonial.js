// testimonialll
let currentIndex = 0;
const slides = document.querySelectorAll('.testimonial-slide');
let slideInterval;

// Function to show slide at the specified index
function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.remove('active');
        if (i === index) {
            slide.classList.add('active');
        }
    });
}

// Initial slide display
showSlide(currentIndex);

// Auto-slide function
function startAutoSlide() {
    slideInterval = setInterval(() => {
        currentIndex = (currentIndex + 1) % slides.length;
        showSlide(currentIndex);
    }, 4000); // Adjust the interval time as needed
}

// Manual navigation functions
function prevSlide() {
    clearInterval(slideInterval); // Stop auto-slide on manual change
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    showSlide(currentIndex);
    startAutoSlide(); // Restart auto-slide after manual change
}

function nextSlide() {
    clearInterval(slideInterval); // Stop auto-slide on manual change
    currentIndex = (currentIndex + 1) % slides.length;
    showSlide(currentIndex);
    startAutoSlide(); // Restart auto-slide after manual change
}

// cart
function submitOrder() {
    Swal.fire({
        title: 'Order Submitted!',
        text: 'Your order has been submitted successfully.',
        icon: 'success',
        confirmButtonText: 'OK',
        customClass: {
            confirmButton: 'custom-swal-button'
        },
        html: '<p style="font-size: 14px; margin-top: 10px;"><a href="/home" style="color: #b19361; text-decoration: none;">Continue Shopping</a></p>'
    }).then(() => {
        // Clear the cart cookie
        document.cookie = "cart=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;";

        // Clear other related cookies (like discount if applicable)
        document.cookie = "discount=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
    });
}


// subscribe button
document.getElementById("SUBSCRIBE").onclick = function(event) {
    event.preventDefault(); // Prevents the default form submission
    const emailInput = document.getElementById("emailInput").value;
    const subscribeMessage = document.getElementById("subscribeMessage");
    const errorMessage = document.getElementById("errorMessage");

    if (emailInput === "") {
        // Show error message if email input is empty
        errorMessage.style.display = "block";
        subscribeMessage.style.display = "none"; // Hide success message if shown before
    } else {
        // Show success message if email input is filled
        errorMessage.style.display = "none";
        subscribeMessage.style.display = "block";
        document.getElementById("SUBSCRIBE").innerText = "Subscribed!"; // Optional: changes button text
    }
}



// cart
// Listen for changes in quantity inputs
document.querySelectorAll('.quantity-input').forEach(input => {
    input.addEventListener('change', function() {
        const quantity = parseInt(this.value);
        const price = parseFloat(this.getAttribute('data-price'));
        const id = this.getAttribute('data-id');

        // Update the total for this item
        const newTotal = (quantity * price).toFixed(2);
        document.getElementById(`total-${id}`).textContent = `$${newTotal}`;

        // Update the quantity in the cart cookie via AJAX
        updateCartQuantity(id, quantity);
        
        // Recalculate cart subtotal and total dynamically
        updateCartTotals();
    });
});

// Function to update cart quantity in the server cookie using AJAX
function updateCartQuantity(productId, quantity) {
    fetch('/cart/update', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ product_id: productId, quantity: quantity })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Cart updated successfully');
        } else {
            console.error('Error updating cart:', data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

// Function to update the cart subtotal and total
function updateCartTotals() {
    let subtotal = 0;

    document.querySelectorAll('.quantity-input').forEach(input => {
        const quantity = parseInt(input.value);
        const price = parseFloat(input.getAttribute('data-price'));
        subtotal += quantity * price;
    });

    document.getElementById('subtotal-amount').textContent = `$${subtotal.toFixed(2)}`;

    const shipping = 50.00; // Assume fixed shipping cost
    const total = subtotal + shipping;
    document.getElementById('total-amount').textContent = `$${total.toFixed(2)}`;
}

// Select all forms with the 'add-to-cart-form' class
document.querySelectorAll('.add-to-cart-form').forEach(form => {
    form.addEventListener('submit', function(event) {
        event.preventDefault(); 

        const formData = new FormData(this);

        fetch('/cart/add', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // console.log("AJAX response:", data);
            if (data.success) {
                showFlashMessage("Added successfully");
                document.getElementById('cart-count').textContent = data.cartCount;
                updateCartView(); // Refresh header cart view
            } else {
                alert('There was an issue adding the item to the cart.');
            }
        })
        .catch(error => console.error('Error:', error));
    });
});

// Function to get the cart count from the cookie
function getCartCountFromCookie() {
    const cartCookie = document.cookie.replace(/(?:(?:^|.*;\s*)cart\s*\=\s*([^;]*).*$)|^.*$/, "$1");
    if (!cartCookie) return 0;

    try {
        const cart = JSON.parse(decodeURIComponent(cartCookie));
        return Object.values(cart).reduce((count, item) => count + item.quantity, 0);
    } catch (error) {
        console.error('Error parsing cart cookie:', error);
        return 0;
    }
}

document.querySelectorAll('.delete-item-form').forEach(form => {
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        const row = this.closest('tr'); 

        fetch('/cart/remove', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                row.remove();
                updateCartView();
            } else {
                alert('There was an issue removing the item from the cart.');
            }
        })
        .catch(error => console.error('Error:', error));
    });
});

function updateCartView() {
    console.log("Updating cart view...");
    fetch('/cart/view') 
        .then(response => response.json())
        .then(data => {
            console.log("Cart data received:", data);
            const cartList = document.querySelector('.offcanvas-cart');
            if (!cartList) return;

            cartList.innerHTML = '';

            // Use Object.values() to convert data.cartItems to an array
            Object.values(data.cartItems).forEach(item => {
                const price = parseFloat(item.price) || 0; // Convert to number or default to 0
                const cartItemHTML = `
                    <li class="offcanvas-cart-item-single">
                        <div class="offcanvas-cart-item-block">
                            <a href="#" class="offcanvas-cart-item-image-link">
                                <img src="${data.dir}/${encodeURIComponent(item.image_url)}" alt="${item.name}" class="offcanvas-cart-image">
                            </a>
                            <div class="offcanvas-cart-item-content">
                                <a href="#" class="offcanvas-cart-item-link">${item.name}</a>
                                <div class="offcanvas-cart-item-details">
                                    <span class="offcanvas-cart-item-details-quantity">${item.quantity} x </span>
                                    <span class="offcanvas-cart-item-details-price">$${price.toFixed(2)}</span>
                                </div>
                            </div>
                        </div>
                        <div class="offcanvas-cart-item-delete text-right">
                            <form class="delete-item-form" data-product-id="${item.id}" action="/cart/remove" method="POST">
                                <input type="hidden" name="product_id" value="${item.id}">
                                <button type="submit" class="offcanvas-cart-item-delete"><i class="fa fa-trash-o"></i></button>
                            </form>
                        </div>
                    </li>
                `;
                cartList.insertAdjacentHTML('beforeend', cartItemHTML);
            });

            attachDeleteEventHandlers();
            updateSubtotal();
        })
        .catch(error => console.error('Error updating cart view:', error));
}

function updateSubtotal() {
    fetch('/cart/calculateTotals')
        .then(response => response.json())
        .then(data => {
            console.log("Subtotal data received:", data);

            // Check if subtotal is defined in the response
            if (data && typeof data.subtotal !== 'undefined') {
                const subtotalElement = document.querySelector('.offcanvas-cart-total-price-value');
                if (subtotalElement) {
                    subtotalElement.textContent = `$${parseFloat(data.subtotal).toFixed(2)}`;
                }
            } else {
                console.error("Subtotal is missing or undefined in response:", data);
            }
        })
        .catch(error => console.error('Error updating subtotal:', error));
}


function attachDeleteEventHandlers() {
    document.querySelectorAll('.delete-item-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            const productId = this.dataset.productId; 
            const headerCartItem = this.closest('.offcanvas-cart-item-single');
            const mainCartRow = document.querySelector(`tr[data-product-id="${productId}"]`);

            fetch('/cart/remove', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateCartView();
                    document.getElementById('cart-count').textContent = data.cartCount;

                    // Remove the deleted item from the main cart view if present
                    if (mainCartRow) {
                        mainCartRow.remove();
                    }
                    // Remove the deleted item from the header cart view if present
                    if (headerCartItem) {
                        headerCartItem.remove();
                    }
                } else {
                    alert('There was an issue removing the item from the cart.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
}

function showFlashMessage(message) {
    const flashMessage = document.getElementById('flash-message');
    flashMessage.textContent = message;
    flashMessage.style.display = 'block';
    flashMessage.style.opacity = '1';

    // Hide after 3 seconds
    setTimeout(() => {
        flashMessage.style.opacity = '0';
        setTimeout(() => flashMessage.style.display = 'none', 300); // Hide completely after fade-out
    }, 3000);
}


document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('cart-count').textContent = getCartCountFromCookie();
    startAutoSlide();
    attachDeleteEventHandlers();

    const submitOrderButton = document.getElementById('submitOrderBtn');
    const orderForm = document.getElementById('orderForm');

    if (submitOrderButton && orderForm) {
        submitOrderButton.addEventListener('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Your Order has been submitted successfully!',
                icon: 'success',
                confirmButtonText: 'Continue Shopping'
            }).then((result) => {
                if (result.isConfirmed) {
                    orderForm.submit();
                }
            });
        });
    }

});



