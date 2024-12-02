document.addEventListener("DOMContentLoaded", function () {
    const detailsLinks = document.querySelectorAll(".details-link");
    detailsLinks.forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault();
            const orderId = this.getAttribute("href").split("/").pop();

            fetch(`/order/details/${orderId}`)
                .then(response => response.json())
                .then(data => {
                    // Check if data has order details
                    if (data.order && data.order.length > 0) {
                        const order = data.order[0];

                        // Populate order details in the modal header
                        document.querySelector("#orderDetailsModalLabel").textContent = `Order #${order.order_id}`;

                        // Populate customer information
                        const customerInfoTable = document.querySelector("#customerInfoTable");
                        customerInfoTable.innerHTML = `
                            <tr><th>Name</th><td>${order.customer_name}</td></tr>
                            <tr><th>Email</th><td>${order.customer_email}</td></tr>
                            <tr><th>Address</th><td>${order.customer_address}</td></tr>
                        `;

                        // Populate order information
                        const orderInfoTable = document.querySelector("#orderInfoTable");
                        orderInfoTable.innerHTML = `
                            <tr><th>Order ID</th><td>${order.order_id}</td></tr>
                            <tr><th>Status</th><td>${order.status}</td></tr>
                            <tr><th>Total Price</th><td>$${order.order_total_price}</td></tr>
                            <tr><th>Order Date</th><td>${order.order_date}</td></tr>
                        `;

                        // Populate product details
                        const productDetailsTable = document.querySelector("#productDetailsTable tbody");
                        productDetailsTable.innerHTML = "";  // Clear previous entries
                        data.order.forEach(item => {
                            productDetailsTable.innerHTML += `
                            <tr>
                                <td>${item.product_name}</td>
                                <td>${item.description}</td>
                                <td>$${item.product_price}</td>
                                <td>${item.quantity}</td>
                                <td>$${(item.product_price * item.quantity).toFixed(2)}</td>
                                <td><img src="/public/images/product/${item.image_url}" alt="${item.product_name}" class="img-fluid" style="width:50px; height:50px;"></td>
                            </tr>
                        `;
                        
                        });

                        // Show the modal
                        $('#orderDetailsModal').modal('show');
                    } else {
                        console.error("Order data not found.");
                    }
                })
                .catch(error => console.error("Error fetching order details:", error));
        });
    });
});
