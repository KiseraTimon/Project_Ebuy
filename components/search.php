<?php
// Database connection
require ('database.php');

// Query to get all categories
$categoryQuery = "SELECT * FROM categories";
$categoryResult = mysqli_query($conn, $categoryQuery);

// Query to get all subcategories and organize them by categoryID
$subcategoryQuery = "SELECT * FROM subcategories";
$subcategoryResult = mysqli_query($conn, $subcategoryQuery);

$subcategoriesByCategory = [];
while ($row = mysqli_fetch_assoc($subcategoryResult)) {
    $subcategoriesByCategory[$row['categoryID']][] = $row['subcat'];
}

// Initialize selected category and subcategories
$selectedCategory = '';
$selectedSubcategories = [];
?>

<div class="search">
  <form method="GET" action="../pages/stock.php">
    <div class="entry">
      <input type="text" name="keyword" placeholder="Search by keyword">
    </div>
    <button type="button" onclick="toggleAdvSearch();">Advanced Search</button>
    <div class="advsearch" style="display: none;">
      <div class="entry">
        <!-- Category Dropdown -->
        <select name="category" id="category" onchange="changeCategory();">
          <option value="">Select category</option>
          <?php
          while ($row = mysqli_fetch_assoc($categoryResult)) {
              $selected = ($row['categoryID'] == $selectedCategory) ? 'selected' : '';
              echo '<option value="'.$row['categoryID'].'" '.$selected.'>'.$row['category'].'</option>';
          }
          ?>
        </select>

        <!-- Subcategory Dropdown -->
        <select name="subcategory" id="subcategory">
          <option value="">Select subcategory</option>
          <!-- Script to populate subcategories based on selected category -->
          <script>
            document.getElementById('category').addEventListener('change', function() {
                var selectedCategoryID = this.value;
                var subcategories = <?php echo json_encode($subcategoriesByCategory); ?>;
                var subcategoryDropdown = document.getElementById('subcategory');
                subcategoryDropdown.innerHTML = '<option value="">Select subcategory</option>';
                if (selectedCategoryID in subcategories) {
                    subcategories[selectedCategoryID].forEach(function(subcat) {
                        var option = document.createElement('option');
                        option.value = subcat;
                        option.text = subcat;
                        subcategoryDropdown.add(option);
                    });
                }
            });
          </script>
        </select>
      </div>

      <!--Price Range-->
      <div class="entry">
        <input type="number" name="minprice" placeholder="Min Price" min="0">
        <input type="number" name="maxprice" placeholder="Max Price" min="0">
      </div>

      <!--Condition & Availability-->
      <div class="entry">
        <select name="status">
          <option value="">Condition</option>
          <option value="New">New</option>
          <option value="Used">Used</option>
          <option value="Refurbished">Refurbished</option>
        </select>

        <select name="availability">
        <option value="Available">Available</option>
          <option value="Sold">Sold</option>
          <option value="Reserved">Reserved</option>
          <option value="Import">Import</option>
          <option value="Showcase">Showcase</option>
        </select>
      </div>

      <!--Tags-->
      <div class="entry">
      <select name="tags">
          <option value="">Tags</option>
          <option value="Popular">Popular</option>
          <option value="Trending">Trending</option>
          <option value="Bestseller">Bestseller</option>
          <option value="Discount">Discount</option>
          <option value="New arrivals">New arrivals</option>
        </select>
      </div>

      <!--Rating-->
      <div class="entry">
        <select name="rating">
          <option value="">Consumer rating</option>
          <option value="5">5 stars</option>
          <option value="4">4 stars & up</option>
          <option value="3">3 stars & up</option>
          <option value="2">2 stars & up</option>
          <option value="1">1 star & up</option>
        </select>
      </div>


      <!--Submit Button-->
      <div class="entry">
        <input type="submit" class="btn" />
      </div>
    </div>
  </form>
</div>

<!-- Script to toggle advsearch on button click -->
<script>
  function toggleAdvSearch() {
      var advsearch = document.querySelector('.advsearch');
      if (advsearch.style.display === 'none') {
          advsearch.style.display = 'block';
      } else {
          advsearch.style.display = 'none';
      }
  }
</script>
