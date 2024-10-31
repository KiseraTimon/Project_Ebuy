<?php
// Database connection
require ('database.php');

// Query to get all makes and brands
$brandquery = "SELECT * FROM brands";
$brandresult = mysqli_query($conn, $brandquery);

// Query to get all models
$modelquery = "SELECT * FROM models";
$modelresult = mysqli_query($conn, $modelquery);

// Store models in an array
$modelsbybrand = [];
while ($row = mysqli_fetch_assoc($modelresult)) {
    $modelsbybrand[$row['brandname']][] = $row['model'];
}

// Initialize selected brand and models
$selectedBrand = '';
$selectedModels = [];
?>

<div class="search">
  <form method="GET" action="../pages/stock.php">
    <div class="entry">
      <input type="text" name="keyword" placeholder="Search by keyword">
    </div>
    <button type="button" onclick="toggleAdvSearch();">Advanced Search</button>
    <div class="advsearch" style="display: none;">
      <div class="entry">
        <select name="make" id="make" onchange="change();">
          <option value="">Select make</option>
          <?php
          while ($row = mysqli_fetch_assoc($brandresult)) {
              $selected = ($row['brand'] == $selectedBrand) ? 'selected' : '';
              // Store brandID and brandname in option value
              echo '<option value="'.$row['brand'].'" '.$selected.'>'.$row['brand'].'</option>';
          }
          ?>
        </select>
        <select name="model" id="model">
          <option value="">Select model</option>
          <!--Script to populate models based on selected brand-->
          <script>
            document.getElementById('make').addEventListener('change', function() {
                var selectedBrand = this.value;
                var models = <?php echo json_encode($modelsbybrand); ?>;
                var modelDropdown = document.getElementById('model');
                modelDropdown.innerHTML = '<option value="">Select model</option>';
                if (selectedBrand in models) {
                    models[selectedBrand].forEach(function(model) {
                        var option = document.createElement('option');
                        option.value = model;
                        option.text = model;
                        modelDropdown.add(option);
                    });
                }
            });
          </script>
        </select>
      </div>
      <div class="entry">
        <select name="category">
          <option value="">Select category</option>
          <option value="Sedan">Sedan</option>
          <option value="SUV">SUV</option>
          <option value="Coupe">Coupe</option>
          <option value="Compact">Compact</option>
          <option value="Convertible">Convertible</option>
          <option value="Hatchback">Hatchback</option>
          <option value="Estate">Estate</option>
          <option value="Sports">Sports</option>
          <option value="Pick-up">Pick-up</option>
          <option value="Van">Van</option>
          <option value="Muscle">Muscle</option>
          <option value="Motorcycle">Motorcycle</option>
        </select>
      </div>
      <div class="entry">
        <input type="number" name="minyear" placeholder="Min Year" min="2000">
        <input type="number" name="maxyear" placeholder="Max Year" min="2000" max="">
      </div>
      <div class="entry">
        <input type="number" name="minprice" placeholder="Min Price" min="0">
        <input type="number" name="maxprice" placeholder="Max Price" min="0">
      </div>
      <div class="entry">
        <input type="number" name="minmileage" placeholder="Min Mileage">
        <input type="number" name="maxmileage" placeholder="Max Mileage">
      </div>
      <div class="entry">
        <input type="number" name="mincc" placeholder="Min engine capacity">
        <input type="number" name="maxcc" placeholder="Max engine capacity">
      </div>
      <div class="entry">
        <select name="availability">
          <option value="">Select availability</option>
          <option value="Available">Available</option>
          <option value="Sold">Sold</option>
          <option value="Reserved">Reserved</option>
          <option value="Import">Import</option>
          <option value="Showcase">Showcase</option>
        </select>
        <select name="fueltype">
          <option value="">Select fuel type</option>
          <option value="Petrol">Petrol</option>
          <option value="Diesel">Diesel</option>
          <option value="Petrol/Electric">Petrol/Electric</option>
          <option value="Diesel/Electric">Diesel/Electric</option>
          <option value="Electric only">Electric only</option>
          <option value="Hydrogen">Hydrogen</option>
          <option value="LPG">LPG</option>
        </select>
      </div>
      <div class="entry">
        <select name="drivetrain">
          <option value="">Select drivetrain</option>
          <option value="2WD (Front-biased)">2WD (Front-biased)</option>
          <option value="2WD (Rear-biased)">2WD (Rear-biased)</option>
          <option value="AWD">AWD</option>
        </select>
        <select name="transmission">
          <option value="">Select transmission</option>
          <option value="Automatic">Automatic</option>
          <option value="Manual">Manual</option>
          <option value="CVT">CVT</option>
        </select>
      </div>
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
