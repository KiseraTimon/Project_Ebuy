<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sellers Portal - eCommerce</title>
    <!-- Link to the external CSS file -->
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Welcome to the Sellers' Portal</h1>
    </header>

    <div class="container">
        <!-- Navigation -->
        <div class="menu">
            <a href="#" onclick="showSection('dashboard')">Dashboard</a>
            <a href="#" onclick="window.location.href='assets/php/addproducts.php'">Add Product</a>
            <a href="#" onclick="showSection('products-list')">View Products</a>
            <a href="#" onclick="showSection('orders')">Orders</a>
        </div>

        
        <div id="dashboard" class="section active">
            <h2>Dashboard</h2>
            <p>Welcome, Seller! This is your dashboard. you can see an overview of your store's performance.</p>
        </div>

        <div id="add-product" class="section">
            <h2>Add New Product</h2>
            <form>
                <div class="form-group">
                    <label for="product-name">Product Name:</label>
                    <input type="text" id="product-name" name="product-name" required>
                </div>
                <div class="form-group">
                    <label for="product-category">Category:</label>
                    <select id="product-category" name="product-category">
                        <option value="electronics">Electronics</option>
                        <option value="clothing">Clothing</option>
                        <option value="books">Books</option>
                        <option value="home-goods">Home Goods</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="product-price">Price (KSh):</label>
                    <input type="number" id="product-price" name="product-price" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="product-description">Description:</label>
                    <textarea id="product-description" name="product-description" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="product-image">Product Image: </label>
                    <input type="file" id="product-image" name="product-image" accept="image/*" required>
                </div>
                <input type="submit" value="Add Product">
            </form>
        </div>

        <div id="products-list" class="section">
            <h2>Products List</h2>
            <table>
                <tr>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
                <tr>
                    <td>Sample Product 1</td>
                    <td>Electronics</td>
                    <td>2000</td>
                    <td>A high-quality electronic product.</td>
                    <td><button>Edit</button> <button>Delete</button></td>
                </tr>
                <!-- Add more product rows here -->
            </table>
        </div>

        <div id="orders" class="section">
            <h2>Manage Orders</h2>
            <p>Here you can see and manage the orders placed by customers for your products.</p>
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                <tr>
                    <td>001</td>
                    <td>Sample Product </td>
                    <td>Ravine</td>
                    <td>Delievered</td>
                    <td><button>View</button> <button>Update Status</button></td>
                </tr>
                <!-- Add more order rows here -->
            </table>
        </div>
    </div>

    <!-- JavaScript to manage sections -->
    <script>
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => section.classList.remove('active'));
            document.getElementById(sectionId).classList.add('active');
        }
    </script>
</body>
</html>