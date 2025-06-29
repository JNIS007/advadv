<?php
$i = 1;
include("./admin/includes/config.php");
$id = $_GET['id'];


if ($id == '') {
  header('location:https://www.dotweb.com.np/advadventure/adv/index.php');
} else {
  $query = mysqli_query($con, "SELECT * FROM tblposts WHERE Is_Active = 1 and id='$id'");
  $row = mysqli_fetch_array($query);

  $q = "SELECT * FROM other WHERE P_id='$id' and is_active = 1 ";
  $result = mysqli_query($con, $q);


  $roo = mysqli_fetch_assoc($result);

  if (mysqli_num_rows($result) > 0) {

    function cleanText($text)
    {
      $patterns = [
        "/(\r\n)+/",
        "/(\\\\r\\\\n)+/"
      ];
      return preg_replace($patterns, '', $text);
    }
    $itineraryText = cleanText($roo["Detailed_Itinerary"]);
    $inputString = cleanText($roo["Useful_Information"]);
    $inc = cleanText($roo["Inc"]);
    $exe = cleanText($roo["Exc"]);
    $altitudeDataJson = cleanText($roo["chart_data"]); // Your JSON string: '[{"outline":"Day 01","height":"1350"},{"outline":"Day 04","height":"1560"}]'
    $Important_Note = cleanText($roo["Important_Note"]);
    $Recommended_PackageJson = cleanText($roo["selectedrecommend"]);
    // Decode the JSON data
    $altitudeData = json_decode($altitudeDataJson, true);
    $Recommended_Package = json_decode($Recommended_PackageJson, true);


    // Prepare arrays for Chart.js
    $labels = [];
    $dataPoints = [];
    $dayDetails = [];

    foreach ($altitudeData as $item) {
      $labels[] = $item['outline'];
      $dataPoints[] = (int) $item['height'];
      $dayDetails[] = $item['outline'] . " - " . $item['height'] . "m";
    }

    // Fill in missing days with null values (if needed)
    $completeLabels = [];
    $completeData = [];
    $completeDetails = [];

    for ($i = 1; $i <= count($altitudeData); $i++) {
      $dayStr = 'Day ' . str_pad($i, 2, '0', STR_PAD_LEFT);
      $completeLabels[] = $dayStr;

      $found = false;
      foreach ($altitudeData as $item) {
        if ($item['outline'] === $dayStr) {
          $completeData[] = (int) $item['height'];
          $completeDetails[] = $item['outline'] . " - " . $item['height'] . "m";
          $found = true;
          break;
        }
      }

      if (!$found) {
        $completeData[] = null;
        $completeDetails[] = $dayStr . " - No data";
      }
    }



    function parsePipeSeparatedList($html)
    {
      // Remove HTML tags and decode HTML entities
      $plainText = html_entity_decode(strip_tags($html));

      // Normalize line breaks and slashes
      $plainText = preg_replace('/\\\\r\\\\n|\r\n|\n|\r/', ' ', $plainText);
      $plainText = preg_replace('/\s+/', ' ', $plainText); // Collapse whitespace

      // Split by pipe and trim each item
      $items = array_map('trim', explode('|', $plainText));

      // Remove empty entries
      return array_filter($items, fn($item) => !empty($item));
    }

    // Example usage:
    $it = (parsePipeSeparatedList($inc));                 // inclusions
    $exit = parsePipeSeparatedList($exe);               // exclusions
    $items = parsePipeSeparatedList($inputString);      // general items
    // $smtrek = parsePipeSeparatedList($Recommended_Package); // recommended packages


    // Trim whitespace from each item and create an associative array
    $result = [];
    foreach ($items as $item) {
      $item = trim($item);
      if (!empty($item)) {
        // Split each item into key-value pairs
        $parts = explode(':', $item, 2);
        if (count($parts) === 2) {
          $key = trim($parts[0]);
          $value = trim($parts[1]);
          $result[$key] = $value;
        }
      }
    }


    $tripFacts = [];

    if (!empty($Important_Note)) {
      // Decode HTML entities and strip tags
      $plainText = html_entity_decode(strip_tags($Important_Note));

      // Normalize line breaks and whitespace
      $plainText = preg_replace('/\\\\r\\\\n|\r\n|\n|\r/', ' ', $plainText);
      $plainText = preg_replace('/\s+/', ' ', $plainText); // Collapse spaces

      // Split by pipe
      $components = explode('|', $plainText);

      foreach ($components as $component) {
        $component = trim($component);
        if (strpos($component, ':') !== false) {
          list($key, $value) = explode(':', $component, 2);
          $tripFacts[trim($key)] = trim($value);
        }
      }
    }










    // Display the results
    // echo "<ul>";
    // foreach ($result as $key => $value) {
    //     echo "<li><strong>$key:</strong> $value</li>";
    // }
    // echo "</ul>";

    // Parse the text into structured days
    // Parse itinerary text with pipe delimiter
    $days = [];

    if (!empty($itineraryText)) {
      // Clean HTML tags and normalize line breaks/delimiters
      $plainText = strip_tags($itineraryText, '<strong>'); // Keep <strong> for structure
      $plainText = preg_replace('/<strong>\|<\/strong>|<strong>\|/', '|', $plainText); // Normalize pipe inside <strong>
      $plainText = preg_replace('/<br\s*\/?>|\r\n|\n/', '|', $plainText); // Normalize line breaks as pipe
      $plainText = strip_tags($plainText); // Remove remaining tags

      // Split into individual day entries using lookahead for "Day XX:"
      $dayEntries = preg_split('/(?=Day \d{1,2}:)/', $plainText, -1, PREG_SPLIT_NO_EMPTY);

      foreach ($dayEntries as $dayEntry) {
        $components = explode('|', $dayEntry);

        $day = [
          'day' => '',
          'title' => '',
          'altitude' => '',
          'meals' => '',
          'description' => ''
        ];

        foreach ($components as $component) {
          $component = trim($component);

          if (preg_match('/^Day (\d{1,2}):(.+)$/', $component, $dayMatch)) {
            $day['day'] = trim($dayMatch[1]);
            $day['title'] = trim($dayMatch[2]);
          } elseif (preg_match('/^Altitude:(.+)$/i', $component, $altMatch)) {
            $day['altitude'] = trim($altMatch[1]);
          } elseif (preg_match('/^Meals:(.+)$/i', $component, $mealsMatch)) {
            $day['meals'] = trim($mealsMatch[1]);
          } elseif (preg_match('/^Description:(.+)$/i', $component, $descMatch)) {
            $day['description'] = trim($descMatch[1]);
          }
        }

        if (!empty($day['day']) && !empty($day['title'])) {
          $days[] = $day;
        }
      }
    }

    // Display the formatted output
    // foreach ($days as $day) {
    //     echo "<div class='itinerary-day'>";
    //     echo "<h3>Day {$day['day']}: {$day['title']}</h3>";
    //     echo "<p><strong>Altitude:</strong> {$day['altitude']}</p>";
    //     echo "<p><strong>Meals:</strong> {$day['meals']}</p>";
    //     echo "<p><strong>Description:</strong> {$day['description']}</p>";
    //     echo "</div><br>";
    // }
    $data = 1;
    $qaText = $roo["faq"];

    // Strip HTML tags and decode entities
    $plainText = html_entity_decode(strip_tags($qaText));

    // Normalize slashes, line breaks, and extra spaces
    $plainText = preg_replace('/\\\\r\\\\n|\r\n|\n|\r/', ' ', $plainText);
    $plainText = preg_replace('/\s+/', ' ', $plainText); // Collapse multiple spaces

    // Match Q: ... A: ...
    preg_match_all('/Q:\s*(.*?)\s*A:\s*(.*?)(?=Q:|$)/s', $plainText, $matches, PREG_SET_ORDER);

    $formattedQA = [];
    foreach ($matches as $match) {
      $formattedQA[] = [
        'question' => trim($match[1]),
        'answer' => trim($match[2])
      ];
    }


    // Display the formatted Q&A
    // foreach ($formattedQA as $qa) {
    //     echo '<div class="qa-item">';
    //     echo '  <div class="font-bold text-blue-600 question">Q: ' . htmlspecialchars($qa['question']) . '</div>';
    //     echo '  <div class="mt-2 text-gray-700 answer">A: ' . htmlspecialchars($qa['answer']) . '</div>';
    //     echo '</div>';
    //     echo '<hr class="my-4">';
    // }
  } else {
    echo "No record found";
    exit;
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <!-- CKEditor -->
  <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $row["PostTitle"] ?> | Advanced Adventures</title>
  <?php
  include("header.php");

  ?>

  <!-- External Dependencies -->
  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- Tailwind Config -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#1a365d',
            secondary: '#c2410c',
            'accent-blue': '#005FAB'
          },
          animation: {
            fadeIn: 'fadeIn 0.8s ease-out forwards',
          },
          keyframes: {
            fadeIn: {
              from: {
                opacity: '0',
                transform: 'translateY(20px)'
              },
              to: {
                opacity: '1',
                transform: 'translateY(0)'
              }
            }
          }
        }
      }
    }
  </script>

  <!-- Custom Styles -->
  <style>
    /* Gradient Background Animation */
    @keyframes gradient-bg {
      0% {
        background: linear-gradient(45deg, #ff7e5f, #feb47b);
        /* Red to Orange */
      }

      25% {
        background: linear-gradient(45deg, #11c5cb, #2575fc);
        /* Purple to Blue */
      }

      50% {
        background: linear-gradient(45deg, #00b09b, #96c93d);
        /* Teal to Green */
      }

      75% {
        background: linear-gradient(45deg, #ff9a8b, #ff6a00);
        /* Pink to Red */
      }

      100% {
        background: linear-gradient(45deg, #ff7e5f, #feb47b);
        /* Red to Orange */
      }
    }

    /* Applying the gradient animation to the badges */
    .animate-gradient-bg {
      animation: gradient-bg 6s ease infinite;
    }

    /* Optional: Text and icon color transition to match gradient */
    .animate-gradient-bg a .flex .text-[#005FAB] {
      color: #fff;
      transition: color 0.5s ease;
    }

    .animate-gradient-bg a:hover .flex .text-[#005FAB] {
      color: #000;
    }

    .dropdown-content {
      opacity: 0;
      visibility: hidden;
      transform: translateY(10px);
      transition: all 0.2s ease;
    }

    .dropdown:hover .dropdown-content,
    .dropdown:focus-within .dropdown-content {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }

    @keyframes slideIn {
      from {
        transform: translateX(100%);
      }

      to {
        transform: translateX(0);
      }
    }

    .mobile-menu {
      animation: slideIn 0.3s ease-out;
    }

    @keyframes fade-in-up {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }

      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .animate-fade-in-up {
      animation: fade-in-up 0.8s ease-out;
    }

    .perspective-1000 {
      perspective: 1000px;
    }

    .group:hover .group-hover\:rotate-x-12 {
      transform: rotateX(12deg);
    }

    .backdrop-blur-sm {
      backdrop-filter: blur(4px);
    }

    .hover\:scale-105:hover {
      transform: scale(1.05);
    }

    .transition-transform {
      transition: transform 0.3s ease;
    }


    /* Remove background and border */
    .swiper-button-next,
    .swiper-button-prev {
      background: none;
      border: none;
      color: #000;
      /* change to your desired arrow color */
      width: auto;
      height: auto;
    }

    /* Remove default circle by removing pseudo-elements */
    .swiper-button-next::after,
    .swiper-button-prev::after {
      font-size: 24px;
      /* size of the arrow */
      font-weight: bold;
      background: none;
      border-radius: 0;
      padding: 0;
      color: #fff;
      /* Arrow color */
    }
  </style>
</head>

<body class="font-sans antialiased bg-gray-50">
  <!-- Top Info Bar -->


  <!-- Main Content Container -->
  <div class="flex flex-col gap-8 px-4 py-8 mx-auto md:flex-row max-w-7xl sm:px-6 lg:px-8">
    <!-- Main Content (3/4 width) -->
    <main class="w-full md:w-3/4">
      <!-- Featured Image -->
      <!-- Swiper Container -->
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          <?php
          // Split the images by comma
          $images = json_decode($row["PostImage"], true);
          foreach ($images as $image) {
            echo "
          <div class='swiper-slide'>
  <img src='./admin/postimages/$image' style='width:100%; height:400px; object-fit:cover; border-radius:10px;' />
</div>

        ";
          }
          ?>
        </div>

        <!-- Swiper Navigation (Optional) -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
      </div>


      <!-- Breadcrumb -->
      <div class="py-2 text-sm text-gray-600">
        Home - Nepal - <?php echo $row["PostTitle"] ?>
      </div>

      <!-- Title Section -->
      <div class="mb-6">
        <h1 class="text-3xl font-bold text-accent-blue"><?php echo $row["PostTitle"] ?> – <?php echo $row["Days"] ?>
          Days
        </h1>
        <p class="mt-1 font-medium text-yellow-600">★★★★★ 140 reviews on TripAdvisor | Recommended by 99% of travelers
        </p>
      </div>

      <!-- Sticky Navigation -->
      <div class="sticky z-40 py-2 mb-8 bg-white shadow-md top-28">
        <div class="flex px-4 mx-auto space-x-6 overflow-x-auto max-w-7xl">
          <a href="#facts" class="font-semibold text-blue-600 hover:text-secondary">Trip Facts</a>
          <a href="#overview" class="font-semibold text-blue-600 hover:text-secondary">Overview</a>
          <a href="#itinerary" class="font-semibold text-blue-600 hover:text-secondary">Itinerary</a>
          <a href="#includes" class="font-semibold text-blue-600 hover:text-secondary">Includes/Exclude</a>
          <a href="#info" class="font-semibold text-blue-600 hover:text-secondary">Useful Info</a>
          <a href="#faqs" class="font-semibold text-blue-600 hover:text-secondary">FAQs</a>
          <a href="#reviews" class="font-semibold text-blue-600 hover:text-secondary">Reviews</a>
        </div>
      </div>

      <!-- Trip Facts Section -->
      <section id="facts" class="p-8 mb-10 shadow-lg bg-blue-50 rounded-xl">
        <h2 class="pb-4 mb-8 text-3xl font-bold border-b-2 text-accent-blue border-accent-blue">Trip Facts</h2>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
          <?php foreach ($tripFacts as $label => $value): ?>
            <div class="flex items-start space-x-4">
              <div class="w-8 mt-1 text-accent-blue">
                <!-- Optional: Add icon logic based on $label if needed -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                </svg>
              </div>
              <div>
                <h3 class="mb-1 text-lg font-semibold"><?= $label; ?></h3>
                <p class="text-gray-700"><?= $value; ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- Trip Overview Section -->
      <section id="overview" class="p-8 mb-10 shadow-lg bg-blue-50 rounded-xl">
        <h2 class="pb-4 mb-8 text-3xl font-bold border-b-2 text-accent-blue border-accent-blue">Trip Overview</h2>
        <div class="space-y-6 leading-relaxed text-gray-700">
          <p>
            <?php echo $row["PostDetails"]; ?>
          </p>
          <div class="p-6 border-l-4 rounded-lg bg-white/70 border-accent-blue">
            <h3 class="mb-4 text-xl font-semibold text-accent-blue">Key Highlights</h3>
            <ul class="space-y-2">
              <?php foreach ($result as $key => $value) { ?>
                <li class="flex items-start space-x-2">
                  <svg class="w-5 mt-1 text-accent-blue" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span><?php echo "<strong>$key:</strong> $value"; ?></span>
                </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </section>

      <!-- Continue with all other sections (Itinerary, Includes/Excludes, etc.) following the same pattern -->
      <!-- ... [Remaining content sections would follow here with identical structure] ... -->

      <!-- Compact Short Itinerary -->
      <section class="p-6 mb-8 shadow-sm bg-blue-50 rounded-xl">
        <h2 class="text-3xl font-bold text-[#005FAB] mb-6 border-b-2 border-[#005FAB] pb-4">Short Itinerary</h2>
        <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
          <!-- Day Items -->
          <?php foreach ($days as $day) {
            ?>
            <div class="p-4 transition-shadow rounded-lg shadow-sm bg-white/90 hover:shadow-md">
              <div class="flex items-start gap-3">
                <div class="bg-[#005FAB] text-white w-8 h-8 rounded-full flex items-center justify-center shrink-0">
                  <?php echo $day['day']; ?>
                </div>
                <div>
                  <h3 class="mb-1 font-semibold text-gray-800"><?php echo $day['title']; ?></h3>
                </div>
              </div>
            </div>
          <?php } ?>

      </section>


      <!-- Detailed Itinerary -->
      <section class="p-6 mb-8 shadow-sm bg-blue-50 rounded-xl">
        <h2 class="text-3xl font-bold text-[#005FAB] mb-8 border-b-2 border-[#005FAB] pb-4">Detailed Itinerary</h2>
        <div class="space-y-6 leading-relaxed text-gray-700">
          <div x-data="{ selected: null }" class="space-y-4">

            <!-- Day 01 -->
            <?php
            foreach ($days as $day) {
              ?>
              <div class="border border-gray-200 rounded-lg">
                <button @click="selected !== <?php echo $i; ?> ? selected = <?php echo $i; ?> : selected = null"
                  class="flex items-center justify-between w-full px-4 py-3 font-semibold text-left text-black">
                  <span><strong>Day <?php echo $day['day']; ?>:</strong> <?php echo $day['title']; ?></span>
                  <span x-show="selected !== <?php echo $i; ?>">+</span>
                  <span x-show="selected === <?php echo $i; ?>">−</span>
                </button>
                <div x-show="selected === <?php echo $i; ?>" x-collapse class="px-4 pb-4 text-black">
                  <p><strong>Altitude:</strong> <?php echo $day['altitude']; ?></p>
                  <p><strong>Meals:</strong> <?php echo $day['meals']; ?></p>
                  <br>
                  <p><?php echo $day['description']; ?></p>
                </div>
              </div>
              <?php
              $i++;
            } ?>
          </div>
        </div>
      </section>
      <section class="p-6 mb-8 text-center shadow-sm bg-blue-50 rounded-xl">
        <h2 class="text-2xl font-bold text-[#005FAB] mb-4">Not satisfied with this itinerary?</h2>
        <p class="mb-4 text-gray-700">We can customize it to suit your travel needs.</p>
        <a href="#" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-[#122747] transition">
          Customize this Trip
        </a>
      </section>



      <!-- Include Alpine.js -->
      <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>



      <!-- Altitude Map -->
      <section class="p-6 shadow-sm bg-blue-50 rounded-xl">
        <h2 class="text-3xl font-bold text-[#005FAB] mb-8 border-b-2 border-[#005FAB] pb-4">Altitude Map</h2>
        <div class="flex items-center justify-center bg-gray-100 rounded-lg h-96">
          <canvas id="altitudeChart" class="w-full h-full"></canvas>
        </div>
      </section>

      <!-- Include Chart.js -->
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

      <script>
        const ctx = document.getElementById('altitudeChart').getContext('2d');

        const altitudeChart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: <?php echo json_encode($completeLabels); ?>,
            datasets: [{
              label: 'Altitude (m)',
              data: <?php echo json_encode($completeData); ?>,
              backgroundColor: 'rgba(0, 95, 171, 0.2)',
              borderColor: 'rgba(0, 95, 171, 1)',
              borderWidth: 2,
              pointBackgroundColor: 'rgba(0, 95, 171, 1)',
              pointRadius: 5,
              tension: 0.3,
              fill: true,
            }]
          },
          options: {
            responsive: true,
            plugins: {
              tooltip: {
                backgroundColor: '#ffffff',
                titleColor: '#005FAB',
                bodyColor: '#333333',
                font: {
                  size: 14,
                  family: 'Arial, sans-serif',
                  weight: 'bold'
                },
                callbacks: {
                  title: function (context) {
                    return context[0].label;
                  },
                  label: function (context) {
                    const dayDetails = <?php echo json_encode($completeDetails); ?>;
                    return dayDetails[context.dataIndex];
                  }
                }
              },
              legend: {
                display: false
              },
              title: {
                display: false
              }
            },
            scales: {
              y: {
                beginAtZero: false,
                title: {
                  display: true,
                  text: 'Altitude (meters)',
                  font: {
                    size: 16,
                    family: 'Arial, sans-serif',
                    weight: 'bold'
                  },
                  color: '#005FAB'
                },
                ticks: {
                  font: {
                    size: 14,
                    family: 'Arial, sans-serif',
                    weight: 'normal'
                  },
                  color: '#333333'
                }
              },
              x: {
                title: {
                  display: true,
                  text: 'Days',
                  font: {
                    size: 16,
                    family: 'Arial, sans-serif',
                    weight: 'bold'
                  },
                  color: '#005FAB'
                },
                ticks: {
                  font: {
                    size: 14,
                    family: 'Arial, sans-serif',
                    weight: 'normal'
                  },
                  color: '#333333'
                }
              }
            }
          }
        });
      </script>

      <!-----------------Includes and Excludes--------------------->
      <section class="p-6 mt-8 shadow-lg bg-blue-50 rounded-xl">
        <h2 class="pb-2 mb-6 text-3xl font-bold text-gray-800 border-b-2">What's Included?</h2>
        <ul class="pl-6 space-y-4 text-gray-700 list-disc">
          <?php
          foreach ($it as $itm) {
            $cleanItem = trim($itm);

            ?>

          <li class="flex items-center space-x-2">
            <span class="w-2.5 h-2.5 bg-blue-500 rounded-full"></span>
            <?php if (!empty($cleanItem)) {
              echo "<span>{$cleanItem}</span>";
            } ?>
          </li>
          <?php } ?>
        </ul>
      </section>

      <section class="p-6 mt-8 shadow-lg bg-blue-50 rounded-xl">
        <h2 class="pb-2 mb-6 text-3xl font-bold text-gray-800 border-b-2">What's Not Included?</h2>
        <ul class="pl-6 space-y-4 text-gray-700 list-disc">
          <?php
          foreach ($exit as $itmm) {
            $cleanItem = trim($itmm);

            ?>
          <li class="flex items-center space-x-2">
            <span class="w-2.5 h-2.5 bg-red-500 rounded-full"></span>
            <?php if (!empty($cleanItem)) {
              echo "<span>{$cleanItem}</span>";
            } ?>
          </li>

          <?php } ?>
        </ul>
      </section>




      <!-- Departure Dates Section -->
      <section id="departures" class="p-6 mt-8 bg-white border border-gray-200 shadow-lg rounded-xl">
        <h2 class="mb-4 text-3xl font-bold text-gray-800"><?php echo $row["PostTitle"]; ?></h2>

        <p class="mb-6 text-gray-700">
          Choose between joining a fixed departure group or creating your own private trip.
          Below are the upcoming group departures for 2025 & 2026.
        </p>

        <!-- Tabs -->
        <div class="flex mb-6 space-x-2">
          <button id="tab-group" class="px-4 py-2 font-medium text-white rounded-md tab-button bg-primary">Group
            Departures</button>
          <button id="tab-private" class="px-4 py-2 font-medium text-gray-800 bg-gray-200 rounded-md tab-button">Private
            Trip</button>
        </div>

        <!-- Date Filters -->
        <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-2">
          <div>
            <label for="startDate" class="block mb-1 text-sm font-medium text-gray-700">Start Date</label>
            <input type="date" id="startDate"
              class="w-full p-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
          </div>
          <div>
            <label for="endDate" class="block mb-1 text-sm font-medium text-gray-700">End Date</label>
            <input type="date" id="endDate"
              class="w-full p-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
          </div>
        </div>
        <input type="hidden" id="postId" value="<?php echo $id; ?>">

        <!-- Departures Table -->
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Trip Starts
                </th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Trip Ends
                </th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Price Per
                  Person</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Book Now</th>
              </tr>
            </thead>
            <tbody id="departure-data" class="bg-white divide-y divide-gray-200">
              <!-- Initial data loaded from PHP -->
              <?php
              $postQuery = mysqli_query($con, "SELECT * FROM tblpostdetails WHERE post_id = $id");
              if (mysqli_num_rows($postQuery) > 0) {
                while ($fetch = mysqli_fetch_assoc($postQuery)) {
                  echo '
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">' . date('d M Y', strtotime($fetch["start_date"])) . '</td>
              <td class="px-6 py-4 whitespace-nowrap">' . date('d M Y', strtotime($fetch["end_date"])) . '</td>
              <td class="px-6 py-4 whitespace-nowrap">USD ' . $fetch["cost_per_person"] . '</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                  Available
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <button class="px-4 py-2 text-sm font-medium text-white rounded-md bg-primary hover:bg-primary-dark">
                  Book Now
                </button>
              </td>
            </tr>';
                }
              } else {
                echo '
          <tr>
            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
              No departures available
            </td>
          </tr>';
              }
              ?>
            </tbody>
          </table>
        </div>

        <!-- Private Trip Content -->
        <div id="private-departures" class="hidden p-6 mt-6 rounded-lg bg-blue-50">
          <h3 class="mb-2 text-xl font-semibold text-gray-800">Plan a Private Trip</h3>
          <p class="mb-4 text-gray-700">
            Looking for a private departure with your own group, family, or solo? We can customize this trek based on
            your
            preferred dates, comfort level, and travel style.
          </p>
          <a href="#inquiry-form"
            class="inline-block px-6 py-2 font-medium text-white rounded-md bg-primary hover:bg-primary-dark">
            Inquire About a Private Trip
          </a>
        </div> <button id="refresh-btn"
          class="flex items-center px-4 py-2 ml-4 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
          <i class="mr-2 fas fa-sync-alt"></i> Reset Filters
        </button>
      </section>

      <script>
        // Tab Switching
        document.getElementById('tab-group').addEventListener('click', () => {
          document.getElementById('departures').querySelector('.overflow-x-auto').classList.remove('hidden');
          document.getElementById('private-departures').classList.add('hidden');
          document.getElementById('tab-group').classList.remove('bg-gray-200');
          document.getElementById('tab-group').classList.add('bg-primary', 'text-white');
          document.getElementById('tab-private').classList.remove('bg-primary', 'text-white');
          document.getElementById('tab-private').classList.add('bg-gray-200', 'text-gray-800');
        });

        document.getElementById('tab-private').addEventListener('click', () => {
          document.getElementById('private-departures').classList.remove('hidden');
          document.getElementById('departures').querySelector('.overflow-x-auto').classList.add('hidden');
          document.getElementById('tab-private').classList.remove('bg-gray-200');
          document.getElementById('tab-private').classList.add('bg-primary', 'text-white');
          document.getElementById('tab-group').classList.remove('bg-primary', 'text-white');
          document.getElementById('tab-group').classList.add('bg-gray-200', 'text-gray-800');
        });

        // Date Filtering with AJAX
        document.getElementById('startDate').addEventListener('change', fetchDepartures);
        document.getElementById('endDate').addEventListener('change', fetchDepartures);

        function fetchDepartures() {
          const startDate = document.getElementById('startDate').value;
          const endDate = document.getElementById('endDate').value;
          const postId = document.getElementById('postId').value;

          // Only fetch if both dates are selected
          if (startDate && endDate) {
            // Show loading state
            const tbody = document.getElementById('departure-data');
            tbody.innerHTML = `
      <tr>
        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
          <i class="mr-2 fas fa-spinner fa-spin"></i> Loading departures...
        </td>
      </tr>
    `;

            // Make AJAX request
            fetch('fetch-departures.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
              },
              body: `start_date=${startDate}&end_date=${endDate}&post_id=${postId}`
            })
              .then(response => {
                if (!response.ok) {
                  throw new Error('Network response was not ok');
                }
                return response.json();
              })
              .then(data => {
                updateDepartureTable(data);
              })
              .catch(error => {
                console.error('Error fetching departures:', error);
                tbody.innerHTML = `
        <tr>
          <td colspan="5" class="px-6 py-4 text-center text-red-500">
            Error loading departures. Please try again.
          </td>
        </tr>
      `;
              });
          }
        }

        function updateDepartureTable(departures) {
          const tbody = document.getElementById('departure-data');

          if (departures.length === 0) {
            tbody.innerHTML = `
      <tr>
        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
          No departures found for the selected date range
        </td>
      </tr>
    `;
            return;
          }

          let html = '';
          departures.forEach(departure => {
            const startDate = new Date(departure.start_date);
            const endDate = new Date(departure.end_date);

            html += `
      <tr>
        <td class="px-6 py-4 whitespace-nowrap">${formatDate(startDate)}</td>
        <td class="px-6 py-4 whitespace-nowrap">${formatDate(endDate)}</td>
        <td class="px-6 py-4 whitespace-nowrap">USD ${departure.cost_per_person}</td>
        <td class="px-6 py-4 whitespace-nowrap">
          <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
            Available
          </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
          <button class="px-4 py-2 text-sm font-medium text-white rounded-md bg-primary hover:bg-primary-dark">
            Book Now
          </button>
        </td>
      </tr>
    `;
          });

          tbody.innerHTML = html;
        }

        function formatDate(date) {
          const options = {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
          };
          return date.toLocaleDateString('en-US', options);
        }

        // Load initial data when page loads
        document.addEventListener('DOMContentLoaded', () => {
          // Format initial dates
          const dateCells = document.querySelectorAll('#departure-data td:nth-child(1), #departure-data td:nth-child(2)');
          dateCells.forEach(cell => {
            const date = new Date(cell.textContent);
            if (!isNaN(date)) {
              cell.textContent = formatDate(date);
            }
          });
        });

        // Refresh button functionality
        document.getElementById('refresh-btn').addEventListener('click', function () {
          // Clear the date inputs
          document.getElementById('startDate').value = '';
          document.getElementById('endDate').value = '';

          // Reset to show all departures
          fetchAllDepartures();
        });

        function fetchAllDepartures() {
          const postId = document.getElementById('postId').value;
          const tbody = document.getElementById('departure-data');

          // Show loading state
          tbody.innerHTML = `
    <tr>
      <td colspan="5" class="px-6 py-4 text-center text-gray-500">
        <i class="mr-2 fas fa-spinner fa-spin"></i> Loading all departures...
      </td>
    </tr>
  `;

          // Make AJAX request to get all departures
          fetch('fetch-another.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `post_id=${postId}&get_all=true`
          })
            .then(response => response.json())
            .then(data => {
              updateDepartureTable(data);
            })
            .catch(error => {
              console.error('Error fetching departures:', error);
              tbody.innerHTML = `
      <tr>
        <td colspan="5" class="px-6 py-4 text-center text-red-500">
          Error loading departures. Please try again.
        </td>
      </tr>
    `;
            });
        }
      </script>
      <script>
        var swiper = new Swiper(".mySwiper", {
          loop: true,
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
          },
          pagination: {
            el: ".swiper-pagination",
            clickable: true
          },
          autoplay: {
            delay: 2500,
            disableOnInteraction: false
          }
        });
      </script>


      <script>
        const tabGroup = document.getElementById('tab-group');
        const tabPrivate = document.getElementById('tab-private');
        const groupSection = document.getElementById('group-departures');
        const privateSection = document.getElementById('private-departures');

        tabGroup.addEventListener('click', () => {
          groupSection.classList.remove('hidden');
          privateSection.classList.add('hidden');
          tabGroup.classList.add('bg-primary', 'text-white');
          tabGroup.classList.remove('bg-gray-300', 'text-gray-800');
          tabPrivate.classList.remove('bg-primary', 'text-white');
          tabPrivate.classList.add('bg-gray-300', 'text-gray-800');
        });

        tabPrivate.addEventListener('click', () => {
          privateSection.classList.remove('hidden');
          groupSection.classList.add('hidden');
          tabPrivate.classList.add('bg-primary', 'text-white');
          tabPrivate.classList.remove('bg-gray-300', 'text-gray-800');
          tabGroup.classList.remove('bg-primary', 'text-white');
          tabGroup.classList.add('bg-gray-300', 'text-gray-800');
        });
      </script>
      <section id="info" class="..."> <!-- Keep existing classes -->
        <!-- Useful Info content -->
      </section>
      <section id="similar-treks" class="p-6 mt-8 shadow-lg bg-blue-50 rounded-xl">
        <h2 class="text-2xl font-bold text-[#005FAB] mb-4">Similar Tours</h2>
        <ul class="space-y-3 text-blue-700 list-disc list-inside">
          <?php
          if (!empty($Recommended_Package)) {

            // Sanitize and prepare IDs
            $ids = array_map('intval', $Recommended_Package);
            $idList = implode(',', $ids);



            // Second: Fetch titles to display
            $select_sql = "SELECT * FROM tblposts WHERE id IN ($idList)";
            $result = mysqli_query($con, $select_sql);

            if ($result && mysqli_num_rows($result) > 0) {

              while ($rowlatest = mysqli_fetch_assoc($result)) {
                ?>
                <li>
                  <a href="<?php echo URL; ?>?id=<?php echo ($rowlatest['id']); ?>">
                    <?php echo $rowlatest['PostTitle']; ?>
                  </a>
                </li>


                <?php
              }
              ?>
              <?php
            } else {
              echo "<li>No packages found to display.</li>";
            }
          }
          ?>
        </ul>



      </section>

      <section class="p-6 mt-8 shadow-lg bg-blue-50 rounded-xl" id="faqs">
        <h2 class="text-3xl font-bold text-[#005FAB] mb-6 border-b-2 border-[#005FAB] pb-3">Frequently Asked Questions
        </h2>

        <div class="space-y-6" x-data="{ open: null }">
          <!-- Visa Requirements -->
          <?php
          foreach ($formattedQA as $qa) {
            ?>
            <div class="border border-gray-200 rounded-lg">
              <button @click="open !== <?php echo $data; ?> ? open = <?php echo $data; ?> : open = null"
                class="flex items-center justify-between w-full px-4 py-3 font-semibold text-left text-gray-800">
                <span><?php echo $qa['question']; ?></span>
                <i class="fas fa-chevron-down text-[#005FAB]"
                  :class="{ 'rotate-180': open === <?php echo $data; ?> }"></i>
              </button>
              <div x-show="open === <?php echo $data; ?>" x-collapse class="px-4 pb-4 text-gray-700">
                <p><?php echo $qa['answer']; ?></p>
              </div>
            </div>

            <?php
            $data++;
          } ?>
      </section>


    </main>

    <!-- Sidebar Area (1/4) -->
    <aside class="w-full space-y-8 md:w-1/4">

      <!-- Trip Price Box -->
      <div class="relative p-6 bg-white border border-gray-200 shadow-lg rounded-xl">
        <div
          class="absolute flex items-center justify-center w-12 h-12 text-sm font-bold text-white bg-red-500 rounded-full -top-3 -right-3">
          10%
        </div>
        <div class="mb-4 text-center">
          <p class="text-2xl font-bold text-[#005FAB]">US $<?php echo $row['Price']; ?> <span
              class="text-sm font-normal text-gray-600">per
              person</span></p>
        </div>
        <div class="flex flex-col items-center mb-4 space-y-1">
          <div class="flex text-lg text-yellow-400">
            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
              class="fas fa-star"></i><i class="fas fa-star"></i>
          </div>
          <span class="text-sm text-gray-500">based on 0 reviews</span>
        </div>
        <div class="flex items-center justify-between mb-4 text-sm text-gray-600">
          <span class="flex items-center"><i class="mr-1 fas fa-lock"></i> All inclusive</span>
          <span class="flex items-center"><i class="mr-1 fas fa-calendar-alt"></i> <?php echo $row["Days"]; ?>
            Days</span>
        </div>
        <ul class="py-4 mb-4 space-y-3 text-sm text-gray-700 border-t border-b border-gray-200">
          <li class="flex items-start space-x-2"><i class="fas fa-key text-[#005FAB] mt-1"></i><span>Group & Early
              Booking Discount Available</span></li>
          <li class="flex items-start space-x-2"><i
              class="fas fa-plane-departure text-[#005FAB] mt-1"></i><span>Guaranteed Departure</span></li>
          <li class="flex items-start space-x-2"><i class="fas fa-users text-[#005FAB] mt-1"></i><span>Local
              Professional Guides</span></li>
          <li class="flex items-start space-x-2"><i class="fas fa-first-aid text-[#005FAB] mt-1"></i><span>Safe Trip &
              Professional Services</span></li>
          <li class="flex items-start space-x-2"><i class="fas fa-user-friends text-[#005FAB] mt-1"></i><span>Private &
              Group Departure</span></li>
        </ul>
        <div class="space-y-3">
          <button
            class="w-full bg-[#005FAB] hover:bg-[#004080] text-white py-2 rounded-lg font-semibold transition-colors">Book
            Now Pay Later</button>
          <button
            class="w-full border-2 border-[#005FAB] text-[#005FAB] hover:bg-blue-50 py-2 rounded-lg font-semibold transition-colors">Enquire
            Now</button>
        </div>
      </div>

      <!-- TripAdvisor Badge -->
      <div
        class="group bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-3xl p-6 hover:bg-white hover:shadow-xl hover:shadow-green-100/20 hover:-translate-y-1 transition-all duration-500 cursor-pointer">
        <a href="https://www.tripadvisor.com/Attraction_Review-g293890-d9984262-Reviews-Advanced_Adventures_Nepal-Kathmandu_Kathmandu_Valley_Bagmati_Zone_Central_Region.html"
          target="_blank" class="flex items-center justify-between">
          <div class="flex items-center space-x-4">
            <div
              class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center shadow-lg shadow-green-200/50">
              <i class="fab fa-tripadvisor text-white text-xl"></i>
            </div>
            <div>
              <h3 class="font-bold text-gray-900 text-lg group-hover:text-green-600 transition-colors">TripAdvisor</h3>
              <div class="flex items-center space-x-1 mt-1">
                <div class="flex text-amber-400">
                  <i class="fas fa-star text-sm"></i>
                  <i class="fas fa-star text-sm"></i>
                  <i class="fas fa-star text-sm"></i>
                  <i class="fas fa-star text-sm"></i>
                  <i class="fas fa-star text-sm"></i>
                </div>
                <span class="text-sm font-medium text-gray-600 ml-2">140 reviews</span>
              </div>
            </div>
          </div>
          <i class="fas fa-external-link-alt text-gray-400 group-hover:text-green-500 transition-colors"></i>
        </a>
      </div>

      <!-- Google Reviews Badge -->
      <div
        class="group bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-3xl p-6 hover:bg-white hover:shadow-xl hover:shadow-blue-100/20 hover:-translate-y-1 transition-all duration-500 cursor-pointer">
        <a href="https://www.google.com/maps/place/Advanced+Adventures" target="_blank"
          class="flex items-center justify-between">
          <div class="flex items-center space-x-4">
            <div
              class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-200/50">
              <i class="fab fa-google text-white text-xl"></i>
            </div>
            <div>
              <h3 class="font-bold text-gray-900 text-lg group-hover:text-blue-600 transition-colors">Google Reviews
              </h3>
              <div class="flex items-center space-x-1 mt-1">
                <div class="flex text-amber-400">
                  <i class="fas fa-star text-sm"></i>
                  <i class="fas fa-star text-sm"></i>
                  <i class="fas fa-star text-sm"></i>
                  <i class="fas fa-star text-sm"></i>
                  <i class="fas fa-star text-sm"></i>
                </div>
                <span class="text-sm font-medium text-gray-600 ml-2">4.9 rating</span>
              </div>
            </div>
          </div>
          <i class="fas fa-external-link-alt text-gray-400 group-hover:text-blue-500 transition-colors"></i>
        </a>
      </div>


      <!-- Contact Form (Sticky) -->
      <div class="sticky p-6 mt-6 bg-white shadow-lg top-28 rounded-xl">
        <h3 class="mb-4 text-xl font-bold text-accent-blue">Have a question?</h3>
        <form method="POST" action="https://www.advadventures.com/thanks.html" accept-charset="UTF-8">
          <input type="hidden" name="_token" value="KTDBdgD5J1Of9GYcnR79zJgMdRFDk47b7XWPHUCm">
          <div class="space-y-4">
            <div>
              <label for="name" class="block mb-1 text-sm font-medium text-gray-700">Full Name <span
                  class="text-blue-600">*</span></label>
              <input type="text" id="name" name="name" required placeholder="Enter your name"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
              <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email <span
                  class="text-blue-600">*</span></label>
              <input type="email" id="email" name="email" required placeholder="Enter your email"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
              <label for="phone" class="block mb-1 text-sm font-medium text-gray-700">Phone</label>
              <input type="tel" id="phone" name="phone" placeholder="Enter your phone (Optional)"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
              <label for="message" class="block mb-1 text-sm font-medium text-gray-700">Message <span
                  class="text-blue-600">*</span></label>
              <textarea id="message" name="comment" required placeholder="Enter your query"
                class="w-full h-32 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>
            <input type="hidden" name="subject" value="Enquiry">
            <div class="pt-2">
              <button type="submit"
                class="w-full px-4 py-2 font-semibold text-white transition-all rounded-md bg-gradient-to-r from-blue-600 to-blue-800 hover:from-blue-700 hover:to-blue-900">
                Send Message
              </button>
            </div>
            <p class="mt-3 text-xs italic text-center text-gray-500">
              We respect your privacy. We never share, sell, publicize or market your personal info in any way, shape,
              or form.
            </p>
          </div>
        </form>
      </div>

    </aside>
  </div>
  </div>

  <?php
  include("footer.php");
  ?>

  <!-- Scripts -->
  <script>
    // Mobile Menu Functionality
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const closeMobileMenu = document.getElementById('close-mobile-menu');

    mobileMenuButton.addEventListener('click', () => {
      mobileMenu.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    });

    closeMobileMenu.addEventListener('click', () => {
      mobileMenu.classList.add('hidden');
      document.body.style.overflow = '';
    });

    mobileMenu.addEventListener('click', (e) => {
      if (e.target === mobileMenu) {
        mobileMenu.classList.add('hidden');
        document.body.style.overflow = '';
      }
    });

    // Accordion Functionality
    document.querySelectorAll('.accordion button').forEach(button => {
      button.addEventListener('click', () => {
        const content = button.nextElementSibling;
        const icon = button.querySelector('i');
        content.classList.toggle('hidden');
        icon.classList.toggle('fa-chevron-down');
        icon.classList.toggle('fa-chevron-up');
      });
    });

    // Back to Top Button
    const goToTopBtn = document.getElementById('goToTop');
    window.addEventListener('scroll', () => {
      if (window.pageYOffset > 300) {
        goToTopBtn.style.opacity = '1';
        goToTopBtn.style.visibility = 'visible';
      } else {
        goToTopBtn.style.opacity = '0';
        goToTopBtn.style.visibility = 'hidden';
      }
    });

    goToTopBtn.addEventListener('click', (e) => {
      e.preventDefault();
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });

    // Chart.js Implementation
    const ctx = document.getElementById('altitudeChart').getContext('2d');
    const altitudeChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Day 01', 'Day 02', 'Day 03', 'Day 04', 'Day 05', 'Day 06', 'Day 07', 'Day 08', 'Day 09', 'Day 10', 'Day 11', 'Day 12'],
        datasets: [{
          label: 'Altitude (m)',
          data: [1350, 1350, 2161, 1350, 3650, 3650, 3650, 1350, 2248, 2200, 3180, 2200],
          backgroundColor: 'rgba(0, 95, 171, 0.2)',
          borderColor: 'rgba(0, 95, 171, 1)',
          borderWidth: 2,
          pointBackgroundColor: 'rgba(0, 95, 171, 1)',
          pointRadius: 5,
          tension: 0.3,
          fill: true,
        }]
      },
      options: {
        responsive: true,
        plugins: {
          tooltip: {
            backgroundColor: '#ffffff',
            titleColor: '#005FAB',
            bodyColor: '#333333',
            font: {
              size: 14,
              family: 'Arial, sans-serif',
              weight: 'bold'
            }
          },
          legend: {
            display: false
          },
          title: {
            display: false
          }
        },
        scales: {
          y: {
            beginAtZero: false,
            title: {
              display: true,
              text: 'Altitude (meters)',
              font: {
                size: 16,
                family: 'Arial, sans-serif',
                weight: 'bold'
              },
              color: '#005FAB'
            },
            ticks: {
              font: {
                size: 14,
                family: 'Arial, sans-serif'
              },
              color: '#333333'
            }
          },
          x: {
            title: {
              display: true,
              text: 'Days',
              font: {
                size: 16,
                family: 'Arial, sans-serif',
                weight: 'bold'
              },
              color: '#005FAB'
            },
            ticks: {
              font: {
                size: 14,
                family: 'Arial, sans-serif'
              },
              color: '#333333'
            }
          }
        }
      }
    });

    document.getElementById('startDate').addEventListener('change', fetchDepartures);
    document.getElementById('endDate').addEventListener('change', fetchDepartures);

    function fetchDepartures() {
      const startDate = document.getElementById('startDate').value;
      const endDate = document.getElementById('endDate').value;
      const postId = document.getElementById('postId').value;

      if (startDate && endDate) {
        fetch('fetch-departures.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: `start_date=${startDate}&end_date=${endDate}&post_id=${postId}`
        })
          .then(response => response.json())
          .then(data => {
            const tbody = document.getElementById('departure-data');
            tbody.innerHTML = '';

            if (data.length === 0) {
              tbody.innerHTML = `
                    <tr>
                        <td colspan="5" class="px-4 py-3 text-center text-gray-600">
                            No departures found for the selected date range
                        </td>
                    </tr>
                `;
            } else {
              data.forEach(row => {
                tbody.innerHTML += `
                        <tr class="border-t">
                            <td class="px-4 py-3">${formatDate(row.start_date)}</td>
                            <td class="px-4 py-3">${formatDate(row.end_date)}</td>
                            <td class="px-4 py-3">USD ${row.cost_per_person}</td>
                            <td class="px-4 py-3 font-semibold text-green-600">Available</td>
                            <td class="px-4 py-3">
                                <button class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                                    Book Now
                                </button>
                            </td>
                        </tr>
                    `;
              });
            }
          })
          .catch(error => {
            console.error('Error:', error);
          });
      }
    }

    function formatDate(dateString) {
      const options = {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
      };
      return new Date(dateString).toLocaleDateString('en-US', options);
    }
  </script>

</body>

</html>