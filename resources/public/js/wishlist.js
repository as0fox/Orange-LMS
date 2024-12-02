function addOrRemoveFromWishlist(id) {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', '/wishlist/addOrRemove/' + id, true);
    xhr.onload = function() {
        console.log(xhr.responseText);
        if (xhr.status === 200) {           
            let response = JSON.parse(xhr.responseText);
            let counter = response.count;
            document.getElementById('wishlist-count').innerText = counter;

            // Toggle the icon based on the wishlist status
            let wishlistIcon = document.getElementById('wishlist-icon-' + id); // Make sure each icon has a unique ID
            if (wishlistIcon) {
                if (response.isInWishlist) {
                    showFlashMessage("Added successfully");
                    wishlistIcon.classList.remove('icon-heart');
                    wishlistIcon.classList.add('fa-solid', 'fa-heart');
                } else {
                    wishlistIcon.classList.remove('fa-solid', 'fa-heart');
                    wishlistIcon.classList.add('icon-heart');
                }
            }
        } else if (xhr.status === 401) {
            // Redirect to login page if not authorized
            window.location.href = '/customers/login';
        } else {
            document.getElementById('wishlist-count').innerText = '!';
        }
    };
    xhr.send();
}

function count() {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', '/wishlist/count/', true);
    xhr.onload = function() { 
        if (xhr.status == 200) {
                let response = JSON.parse(xhr.responseText);
            let counter = response.count;
            document.getElementById('wishlist-count').innerText = counter;
        } else {
            document.getElementById('wishlist-count').innerText = '!!!';
        }
    };
    xhr.send();
}

  window.onload = function() {
    // Fetch wishlist items for the user
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'wishlist/getWishlistProductIds', true);
    xhr.onload = function() {
        if (xhr.status == 200) {
            let response = JSON.parse(xhr.responseText);
            let wishlistProductIds = response.wishlistProductIds;

            // Loop through each product icon and set the correct class if it’s in the wishlist
            wishlistProductIds.forEach(function(productId) {
                let wishlistIcon = document.getElementById('wishlist-icon-' + productId);
                if (wishlistIcon) {
                    wishlistIcon.classList.remove('icon-heart');
                    wishlistIcon.classList.add('fa-solid', 'fa-heart');
                }
            });
        }
    };
    xhr.send();

    // Also, update the wishlist count on page load
    count(); // Assuming count() updates the wishlist count in the UI
};


