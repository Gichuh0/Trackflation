<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Independent, economic &amp; financial data in real time on-chain | TrackFlation</title>
    <meta name="description" content="TrackFlation is a platform that provides independent, economic, and financial data in real-time on-chain. It offers tools for indexing, pricing, and resources to help users understand and navigate economic trends.">
    <meta name="keywords" content="TrackFlation, economic data, financial data, real-time data, on-chain data, indexes, pricing, resources">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/papaparse@5.4.1/papaparse.min.js"></script>
    <!-- amCharts for interactive map -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">   
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body class="bg-black text-white font-sans">
   <header class="bg-gray-800 p-4">
    <div class="container mx-auto flex items-center justify-between">
        <nav class="flex items-center w-full">
            <a href="#Home" class="text-white text-lg font-semibold mr-8">TrackFlation</a>
            <div class="flex space-x-4 flex-1">
                <a href="#Home" class="text-gray-300 hover:text-white">Home</a>
                <a href="#Features" class="text-gray-300 hover:text-white">Features</a>
                <a href="#Dashboard" class="text-gray-300 hover:text-white">Dashboard</a>
                <a href="#Resources" class="text-gray-300 hover:text-white">Resources</a>
                <a href="#About" class="text-gray-300 hover:text-white">About</a>
            </div>
                     <?php if (isset($_SESSION['user'])): ?>
              <div class="ml-8 flex items-center space-x-3">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                  <span class="text-blue-300 font-semibold bg-gray-900/80 px-3 py-1 rounded-full shadow">
                      <?php
                      require_once 'dbconn.php';
                      $stmt = $conn->prepare("SELECT fname FROM users WHERE email = ?");
                      $stmt->bind_param("s", $_SESSION['user']);
                      $stmt->execute();
                      $stmt->bind_result($fname);
                      $stmt->fetch();
                      $stmt->close();
                      echo "Welcome, " . htmlspecialchars($fname);
                      ?>
                  </span>
                  <a href="logout.php" class="text-blue-400 hover:text-blue-200 text-sm font-semibold px-3 py-1 rounded transition">Logout</a>
              </div>
          <?php else: ?>
              <a href="signin.php" class="ml-8 px-4 py-2 rounded-lg font-semibold bg-gradient-to-r from-blue-600 to-blue-400 text-white hover:from-blue-700 hover:to-blue-500 shadow transition">
                  Sign In
              </a>
          <?php endif; ?>
        </nav>
    </div>
   </header>

   <section class="text-center bg-light py-5">  
    <section id="Home" class="bg-gradient-to-r from-blue-50 to-blue-100 py-20 rounded-2xl shadow-lg mb-8">
      <div class="container mx-auto px-6 flex flex-col-reverse md:flex-row items-center justify-between">
        <div class="md:w-1/2 text-center md:text-left animate-fade-in">
          <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 mb-4 drop-shadow">
            Stay Ahead of Inflation | Visualize It Like Never Before
          </h1>
          <p class="text-lg md:text-xl text-blue-800 mb-6">
            Track, compare, and understand inflation trends across time and regions with real-time, interactive data visualizations.
          </p>
          <a href="#Dashboard" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-full text-lg font-semibold hover:bg-blue-700 transition duration-300 shadow">
            View Dashboard
          </a>
        </div>
        <div class="md:w-1/2 mb-10 md:mb-0 flex justify-center">
          <img src="1.png" alt="Inflation Chart" class="gallery-item">
        </div>
      </div>
    </section>

<style>
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }
  .animate-fade-in {
    animation: fadeIn 1s ease-in-out;
  }
</style>

<section id="Features" class="bg-white py-16">
  <div class="container mx-auto px-4 text-center">
    <h2 class="text-4xl font-bold text-blue-800 mb-10">Features</h2>
    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">

      <!-- Feature 1: Real-time Inflation Data -->
      <a href="#Dashboard" class="block bg-gray-100 p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300 animate-fade-in hover:bg-blue-50">
        <div class="bg-gray-100 p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300 animate-fade-in">
          <div class="flex justify-center mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#2563eb" class="bi bi-graph-up-arrow drop-shadow" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M0 0h1v15h15v1H0zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5"/>
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-blue-700">Real-time Inflation Data</h3>
          <p class="text-gray-600">Access live economic data pulled directly from reliable sources like the World Bank API.</p>
        </div>
      </a>

      <!-- Feature 2: Interactive Charts -->
      <a href="features.html#charts-demo" class="block bg-gray-100 p-6 rounded-xl shadow-md hover:shadow-xl transition">
        <div class="bg-gray-100 p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300 animate-fade-in hover:bg-blue-50">
          <div class="flex justify-center mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#2563eb" class="bi bi-bar-chart drop-shadow" viewBox="0 0 16 16">
              <path d="M4 11H2v3h2zm5-4H7v7h2zm5-5v12h-2V2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1z"/>
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-blue-700">Interactive Charts</h3>
          <p class="text-gray-600">Explore inflation trends visually with intuitive, responsive graphs powered by Chart.js.</p>
        </div>
      </a>

      <!-- Feature 3: Customizable Dashboards -->
      <a href="features.html#dashboard-custom" class="block bg-gray-100 p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300 animate-fade-in hover:bg-blue-50">
        <div class="bg-gray-100 p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300 animate-fade-in">
          <div class="flex justify-center mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#2563eb" class="drop-shadow" viewBox="0 0 512 406.52">
              <path d="M512 0v339.71H336.77v34.2h51.21v32.61H122.93v-32.61h54.85v-34.2H0V0h512zM60.73 251.43h342.85v15.07H60.73v-15.07zm0-40.23H279.5v15.07H60.73V211.2zm334.59-84.15 58.05.2c-.05 15.9-6.28 31.12-17.31 42.28a59.295 59.295 0 0 1-8.49 7.1l-32.25-49.58zm-5.95-11.83-3.1-63.73c-.06-1.26.89-2.33 2.11-2.39.36-.02.78-.04 1.25-.05.39-.02.81-.02 1.25-.03 17.05-.19 32.69 6.45 44.38 17.5 11.69 11.05 19.42 26.52 20.64 43.99.08 1.26-.84 2.35-2.07 2.44l-62.08 4.56c-1.22.08-2.29-.86-2.37-2.12-.01-.06-.01-.11-.01-.17zm1.45-61.64 2.88 59.2 57.56-4.22c-1.62-15.33-8.64-28.88-19.01-38.68-10.89-10.3-25.46-16.48-41.33-16.3h-.1zm-8.4 70.74 31.12 55.36c-9.46 5.61-20.2 8.57-31.12 8.57-34.38 0-62.25-28.63-62.25-63.93 0-31.73 22.65-58.65 53.21-63.26l9.04 63.26zM204.76 55.94l-4.96-6.31c-.78-1.09-1.02-2.12-.7-3.07.84-2.56 3.86-2.31 5.95-2.17 5.94.43 19.95.56 23.01.68 2.24.16 3.55 1.84 3.17 4.05-.62 3.09-3.47 17.97-4.49 23.62-.36 1.96-.95 4.51-3.42 4.7-1 .08-1.94-.4-2.82-1.41l-4.95-6.32-2.3-2.92-30.93 20.03c-.39 7.79-6.83 13.99-14.72 13.99-8.14 0-14.74-6.6-14.74-14.74 0-.33.01-.66.03-.98l-17.1-12.35a14.583 14.583 0 0 1-8.41 2.64c-4.26 0-8.09-1.81-10.78-4.7L87.93 86.05c.06.5.08 1.01.08 1.53 0 8.14-6.6 14.74-14.73 14.74-8.14 0-14.74-6.6-14.74-14.74s6.6-14.74 14.74-14.74c2.95 0 5.69.87 8 2.36l31.55-16.91c1.12-7.02 7.21-12.39 14.55-12.39 8.14 0 14.74 6.6 14.74 14.74 0 .32-.01.65-.03.98l17.1 12.35a14.68 14.68 0 0 1 8.41-2.64c3.7 0 7.08 1.37 9.67 3.62l28.11-18.21-.62-.8zm6.78 38.03h20.32c1.17 0 2.13.96 2.13 2.13v78.95c0 1.17-.96 2.13-2.13 2.13h-20.32c-1.16 0-2.13-.96-2.13-2.13V96.1c0-1.17.96-2.13 2.13-2.13zm-49.47 27.06h20.32c1.17 0 2.13.96 2.13 2.13v51.89c0 1.17-.96 2.13-2.13 2.13h-20.32c-1.17 0-2.13-.96-2.13-2.13v-51.89c0-1.17.96-2.13 2.13-2.13zm-49.48-27.06h20.33c1.17 0 2.12.96 2.12 2.13v78.95c0 1.17-.96 2.13-2.12 2.13h-20.33c-1.16 0-2.12-.96-2.12-2.13V96.1c0-1.17.95-2.13 2.12-2.13zm-49.48 31.42h20.33c1.17 0 2.12.97 2.12 2.13v47.53c0 1.17-.96 2.13-2.12 2.13H63.11c-1.16 0-2.12-.96-2.12-2.13v-47.53c0-1.17.95-2.13 2.12-2.13zM15.28 296.18h481.37V15.28H15.28v280.9z"/>
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-blue-700">Customizable Dashboards</h3>
          <p class="text-gray-600">Adjust country filters, year ranges, and views to make the dashboard work for your needs.</p>
        </div>
      </a>

      <!-- Feature 4: Historical Comparisons -->
      <a href="features.html#historical" class="block bg-gray-100 p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300 animate-fade-in hover:bg-blue-50">
        <div class="bg-gray-100 p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300 animate-fade-in">
          <div class="flex justify-center mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#2563eb" class="drop-shadow" viewBox="0 0 122.88 102.72">
              <g>
                <path d="M65.61,20.91v72.74h35.63c0.38,0,0.68,0.31,0.68,0.69v7.7c0,0.38-0.31,0.69-0.68,0.69H22.84 c-0.38,0-0.69-0.31-0.69-0.69v-7.7c0-0.38,0.31-0.69,0.69-0.69h35.63l0-72.71c-3.1-1.08-5.56-3.53-6.64-6.63H29.3v3.43 c0,0.38-0.31,0.68-0.68,0.68h-5.78c-0.38,0-0.69-0.31-0.69-0.68v-3.43h-5.73c-0.44,0-0.8-0.31-0.8-0.68V7.84 c0-0.38,0.36-0.69,0.8-0.69h35.43C53.33,2.99,57.31,0,61.99,0c4.68,0,8.66,2.99,10.14,7.16h35.53c0.44,0,0.8,0.31,0.8,0.69v5.78 c0,0.38-0.36,0.68-0.8,0.68h-6.46v3.43c0,0.38-0.31,0.68-0.68,0.68h-5.78c-0.38,0-0.69-0.31-0.69-0.68v-3.43H72.16 C71.09,17.38,68.67,19.81,65.61,20.91L65.61,20.91z M99.66,22.3l22.91,40.48c0.2,0.35,0.29,0.73,0.28,1.1h0.02c0,0.05,0,0.1,0,0.15 c0,9.64-11.35,17.46-25.35,17.46c-13.85,0-25.1-7.65-25.34-17.15c-0.04-0.16-0.06-0.34-0.06-0.51c0-0.44,0.14-0.86,0.37-1.2 l23.43-40.43c0.59-1.02,1.89-1.37,2.91-0.78C99.2,21.65,99.48,21.95,99.66,22.3L99.66,22.3z M99.75,31.11v30.6h17.32L99.75,31.11 L99.75,31.11z M95.67,61.7V31.16L77.96,61.7H95.67L95.67,61.7z M27.54,22.3l22.91,40.48c0.2,0.35,0.29,0.73,0.28,1.1h0.02 c0,0.05,0,0.1,0,0.15c0,9.64-11.35,17.46-25.35,17.46c-13.85,0-25.1-7.65-25.34-17.15C0.02,64.19,0,64.02,0,63.84 c0-0.44,0.14-0.86,0.37-1.2L23.8,22.21c0.59-1.02,1.89-1.37,2.91-0.78C27.08,21.65,27.36,21.95,27.54,22.3L27.54,22.3z M27.63,31.11v30.6h17.32L27.63,31.11L27.63,31.11z M23.54,61.7V31.16L5.84,61.7H23.54L23.54,61.7z M61.99,6.07 c2.59,0,4.69,2.1,4.69,4.69c0,2.59-2.1,4.69-4.69,4.69c-2.59,0-4.69-2.1-4.69-4.69C57.3,8.17,59.4,6.07,61.99,6.07L61.99,6.07z" />
              </g>
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-blue-700">Historical Comparisons</h3>
          <p class="text-gray-600">Compare inflation rates over time to see economic trends and cycles in action.</p>
        </div>
      </a>

      <!-- Feature 5: Regional Tracking -->
      <a href="#RegionalTracking" class="block bg-gray-100 p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300 animate-fade-in hover:bg-blue-50">
        <div class="bg-gray-100 p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300 animate-fade-in">
          <div class="flex justify-center mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#2563eb" class="bi bi-globe-europe-africa drop-shadow" viewBox="0 0 16 16">
              <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0M3.668 2.501l-.288.646a.847.847 0 0 0 1.479.815l.245-.368a.81.81 0 0 1 1.034-.275.81.81 0 0 0 .724 0l.261-.13a1 1 0 0 1 .775-.05l.984.34q.118.04.243.054c.784.093.855.377.694.801-.155.41-.616.617-1.035.487l-.01-.003C8.274 4.663 7.748 4.5 6 4.5 4.8 4.5 3.5 5.62 3.5 7c0 1.96.826 2.166 1.696 2.382.46.115.935.233 1.304.618.449.467.393 1.181.339 1.877C6.755 12.96 6.674 14 8.5 14c1.75 0 3-3.5 3-4.5 0-.262.208-.468.444-.7.396-.392.87-.86.556-1.8-.097-.291-.396-.568-.641-.756-.174-.133-.207-.396-.052-.551a.33.33 0 0 1 .42-.042l1.085.724c.11.072.255.058.348-.035.15-.15.415-.083.489.117.16.43.445 1.05.849 1.357L15 8A7 7 0 1 1 3.668 2.501"/>
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-blue-700">Regional Tracking</h3>
          <p class="text-gray-600">Zoom in on specific countries or regions to track localized inflation patterns.</p>
        </div>
      </a>
    </div>
  </div>
</section>

<section id="Dashboard" class="py-5 bg-light">
  <div class="container">
    <h2 class="text-3xl font-bold mb-4 text-blue-800">Dashboard</h2>
    <p class="mb-6 text-blue-900/90">Access your personalized dashboard to track inflation trends, compare data, and visualize economic indicators.</p>
    
    <!-- Country Selector and Dynamic Chart -->
    <div class="row mb-4 mt-5">
      <div class="col-md-6">
        <label for="countrySelect" class="form-label text-blue-900 font-semibold">Select Country</label>
        <select id="countrySelect" class="form-select">
          <option value="US">USA</option>
          <option value="GB">United Kingdom</option>
          <option value="DE">Germany</option>
          <option value="NG">Nigeria</option>
          <option value="KE">Kenya</option>
          <option value="IN">India</option>
          <option value="JP">Japan</option>
          <option value="CN">China</option>
          <option value="ZA">South Africa</option>
          <option value="BR">Brazil</option>
          <option value="CA">Canada</option>
          <option value="FR">France</option>
          <option value="IT">Italy</option>
          <option value="RU">Russia</option>
          <option value="MX">Mexico</option>
          <!-- Add more as needed -->
        </select>
      </div>
    </div>
    <div>
      <canvas id="lineChart" height="100"></canvas>
    </div>
    <!-- End Dynamic Chart -->
  </div>
  <script>
    // Dynamic chart for country selection
    const ctx = document.getElementById('lineChart').getContext('2d');
    const lineChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [],
        datasets: [{
          label: 'Inflation Rate (%)',
          data: [],
          borderColor: 'rgba(75, 192, 192, 1)',
          fill: false,
          tension: 0.4
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: { beginAtZero: false }
        }
      }
    });

    async function fetchWorldBankData(countryCode) {
      const url = `https://api.worldbank.org/v2/country/${countryCode}/indicator/FP.CPI.TOTL.ZG?format=json&per_page=100`;
      try {
        const res = await fetch(url);
        const json = await res.json();
        if (!json || !json[1]) throw new Error("No data from API");

        const records = json[1].filter(r => r.value !== null).reverse();
        const labels = records.map(r => r.date);
        const data = records.map(r => r.value);
        updateChart(labels, data);
        console.log("✅ Loaded from World Bank API");
      } catch (error) {
        console.warn("⚠️ World Bank API failed. Falling back to CSV.");
        loadCSVData(countryCode);
      }
    }

    function loadCSVData(countryCode) {
      Papa.parse("inflation_data.csv", {
        download: true,
        header: true,
        complete: function(results) {
          const rows = results.data.filter(row => row.CountryCode === countryCode);
          const years = [...new Set(rows.map(r => r.Year))].sort();
          const grouped = years.map(y => {
            const entries = rows.filter(r => r.Year === y);
            const avg = entries.reduce((sum, r) => sum + parseFloat(r.Value || 0), 0) / entries.length;
            return { year: y, value: avg.toFixed(2) };
          });

          const labels = grouped.map(g => g.year);
          const data = grouped.map(g => g.value);
          updateChart(labels, data);
          console.log("✅ Loaded from CSV");
        }
      });
    }

    function updateChart(labels, data) {
      lineChart.data.labels = labels;
      lineChart.data.datasets[0].data = data;
      lineChart.update();
    }

    document.getElementById('countrySelect').addEventListener('change', function() {
      const countryCode = this.value;
      fetchWorldBankData(countryCode);
    });

    // Initial load
    fetchWorldBankData("US");
  </script>
</section>

<!-- Regional Tracking Section with Interactive Map -->
<section id="RegionalTracking" class="py-5 bg-light">
  <div class="container">
    <h2 class="text-3xl font-bold mb-4 text-blue-800">Regional Tracking</h2>
    <p class="mb-6 text-blue-900/90">Click on a country in the map below to view its real-time inflation data.</p>
    <div id="regionalMap" style="width: 100%; height: 400px; margin-bottom: 2rem; border-radius: 1rem; overflow: hidden;"></div>
  </div>
  <script>
    am5.ready(function() {
      var root = am5.Root.new("regionalMap");
      root.setThemes([am5themes_Animated.new(root)]);

      var chart = root.container.children.push(
        am5map.MapChart.new(root, {
          panX: "translateX",
          panY: "translateY",
          wheelY: "zoom",
          projection: am5map.geoMercator()
        })
      );

      var polygonSeries = chart.series.push(
        am5map.MapPolygonSeries.new(root, {
          geoJSON: am5geodata_worldLow
        })
      );

      polygonSeries.mapPolygons.template.setAll({
        tooltipText: "{name}",
        interactive: true
      });

      polygonSeries.mapPolygons.template.events.on("click", function(ev) {
        var countryId = ev.target.dataItem.dataContext.id;
        var codeMap = {
          "US": "US",
          "GB": "GB",
          "DE": "DE",
          "NG": "NG",
          "KE": "KE",
          "IN": "IN",
          "JP": "JP",
          "CN": "CN",
          "ZA": "ZA",
          "BR": "BR",
          "CA": "CA",
          "FR": "FR",
          "IT": "IT",
          "RU": "RU",
          "MX": "MX"
          // Add more as needed
        };
        if (codeMap[countryId]) {
          document.getElementById('countrySelect').value = codeMap[countryId];
          fetchWorldBankData(codeMap[countryId]);
          window.scrollTo({ top: document.getElementById('Dashboard').offsetTop - 60, behavior: 'smooth' });
        } else {
          alert("Data for this country is not available.");
        }
      });
    });
  </script>
</section>

<section id="Resources" class="py-5 bg-light">
  <div class="container">
    <h2 class="text-3xl font-bold mb-4 text-blue-800">Resources</h2>
    <p class="mb-4 text-blue-900/90">Explore helpful resources to deepen your understanding of inflation and how to work with economic data:</p>
    <div class="mb-6">
      <h3 class="text-xl font-semibold mb-2 text-blue-700">Learn</h3>
      <ul class="list-disc list-inside text-left mb-4">
        <li>
          <a href="https://www.imf.org/en/Topics/inflation" target="_blank" class="text-blue-600 hover:underline">What is Inflation? (IMF)</a>
        </li>
        <li>
          <a href="https://www.investopedia.com/terms/i/inflation.asp" target="_blank" class="text-blue-600 hover:underline">Inflation Explained (Investopedia)</a>
        </li>
        <li>
          <a href="https://www.worldbank.org/en/news/feature/2022/06/07/how-inflation-affects-people-around-the-world" target="_blank" class="text-blue-600 hover:underline">Inflation Impact (World Bank)</a>
        </li>
      </ul>
    </div>
    <div class="mb-6">
      <h3 class="text-xl font-semibold mb-2 text-blue-700">Data & Tools</h3>
      <ul class="list-disc list-inside text-left mb-4">
        <li>
          <a href="https://data.worldbank.org/indicator/FP.CPI.TOTL.ZG" target="_blank" class="text-blue-600 hover:underline">World Bank CPI Data</a>
        </li>
        <li>
          <a href="https://www.chartjs.org/docs/latest/" target="_blank" class="text-blue-600 hover:underline">Chart.js Documentation</a>
        </li>
        <li>
          <a href="https://www.papaparse.com/docs" target="_blank" class="text-blue-600 hover:underline">PapaParse CSV Parser Guide</a>
        </li>
      </ul>
    </div>
    <div>
      <h3 class="text-xl font-semibold mb-2 text-blue-700">Downloads</h3>
      <ul class="list-disc list-inside text-left">
        <li>
          <a href="inflation_data.csv" download class="text-blue-600 hover:underline">Download Sample CSV File</a>
        </li>
        <li>
          <a href="PapaParse_Load_File.pdf" download class="text-blue-600 hover:underline">CSV Loading Tutorial (PDF)</a>
        </li>
      </ul>
    </div>
  </div>
</section>
    
<section id="About" class="py-5 bg-light">
  <div class="container">
    <h2 class="text-3xl font-bold mb-4 text-blue-800">About TrackFlation</h2>
    <p class="mb-4 text-blue-900/90">
      TrackFlation is a web-based interactive dashboard designed to help users track, visualize, and better understand inflation trends across the world. This project was developed as part of an academic initiative to combine data science, web development, and economic analysis into a practical tool.
    </p>
    <h3 class="text-xl font-semibold mb-2 text-blue-700">What We Offer</h3>
    <ul class="list-disc list-inside mb-4 text-blue-900/90">
      <li>Live inflation data from the World Bank API</li>
      <li>CSV upload and fallback for offline data</li>
      <li>Dynamic, interactive charts with country filtering</li>
      <li>Educational resources and glossary links</li>
    </ul>
    <h3 class="text-xl font-semibold mb-2 text-blue-700">Our Mission</h3>
    <p class="mb-4 text-blue-900/90">
      Our goal is to make complex economic data accessible and understandable through interactive tools and clean visual design.
    </p>
    <h3 class="text-xl font-semibold mb-2 text-blue-700">Built With</h3>
    <ul class="list-disc list-inside text-blue-900/90">
      <li>HTML, CSS (Tailwind/Bootstrap)</li>
      <li>JavaScript + Chart.js</li>
      <li>World Bank Open Data API</li>
      <li>PapaParse for CSV parsing</li>
    </ul>
    <h3 class="text-xl font-semibold mb-2 text-blue-700">+(254)745491216</h3>
    <p class="mb-4 text-blue-900/90">
      For inquiries, reach us at
      <a href="mailto:johnegichuho@gmail.com" class="text-blue-600 hover:underline font-semibold inline-flex items-center">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M16 12l-4-4-4 4m8 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6"></path>
        </svg>
        johnegichuho@gmail.com
      </a>
    </p>
    <div class="mt-6 text-sm text-blue-900/70 italic flex items-center gap-2">
      <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
      </svg>
      Created by <span class="font-semibold text-blue-700 ml-1">Mungai John</span> &mdash; <span class="ml-1">Software Engineering Alumni</span>
    </div>
  </div>
</section>
    
<footer class="bg-gray-900 py-4 mt-12 rounded-t-xl shadow-inner">
  <div class="container mx-auto text-center">
    <span class="text-xs text-blue-200 tracking-wide">
      &copy; 2025 <span class="font-semibold text-blue-400">TrackFlation</span>. All rights reserved.
    </span>
  </div>
</footer>
  
 </body>
</html>