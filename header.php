<?php
$menuData = [];

$dests = mysqli_query($con, "SELECT * FROM tbldest");
while ($dest = mysqli_fetch_assoc($dests)) {
  $destId = $dest['Id'];
  $menuData[$destId] = [
    'name' => $dest['DestName'],
    'categories' => []
  ];

  $cats = mysqli_query($con, "SELECT * FROM tblcategory WHERE destId = $destId AND Is_Active = 1");
  while ($cat = mysqli_fetch_assoc($cats)) {
    $catId = $cat['id'];
    $catName = $cat['CategoryName'];
    $menuData[$destId]['categories'][$catId] = [
      'id' => $catId,
      'name' => $catName,
      'posts' => [],
      'subcategories' => []
    ];

    // Fetch subcategories
    $subcats = mysqli_query($con, "SELECT * FROM tblsubcategory WHERE CategoryId = $catId AND Is_Active = 1");
    while ($subcat = mysqli_fetch_assoc($subcats)) {
      $subcatId = $subcat['id'];
      $subcatEntry = [
        'id' => $subcatId,
        'name' => $subcat['Subcategory'],
        'sposts' => []
      ];

      // Get posts for each subcategory
      $sposts = mysqli_query($con, "SELECT  * FROM tblposts where CategoryId='$catId' and SubCategoryId='$subcatId 'AND Is_Active = 1 ORDER BY sort_order ASC;");
      while ($post = mysqli_fetch_assoc($sposts)) {
        $subcatEntry['sposts'][] = [
          'id' => $post['id'],
          'title' => $post['PostTitle']
        ];
      }

      $menuData[$destId]['categories'][$catId]['subcategories'][] = $subcatEntry;
    }

    // Only include top-level posts if category is NOT "Trekking in Nepal in Mountains" or "Tours in Nepal"
    if ($catName !== "Trekking in Nepal in Mountains" && $catName !== "Tours in Nepal") {
      $posts = mysqli_query($con, "SELECT * FROM tblposts WHERE CategoryId = $catId AND Is_Active = 1 ORDER BY sort_order ASC");
      while ($post = mysqli_fetch_assoc($posts)) {
        $menuData[$destId]['categories'][$catId]['posts'][] = [
          'id' => $post['id'],
          'title' => $post['PostTitle']
        ];
      }
    }
  }
}

// $json = json_encode($menuData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
// echo "<pre>";
// echo $json;
// echo "</pre>";
?>




<script src="https://cdn.tailwindcss.com"></script>
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const dropdown = document.getElementById('countries-dropdown');
    const mainToggle = document.getElementById('main-toggle');

    // Show dropdown on hover
    mainToggle.addEventListener('mouseenter', () => {
      dropdown.classList.remove('hidden');
    });

    // Hide dropdown when mouse leaves both button and dropdown
    mainToggle.addEventListener('mouseleave', (e) => {
      setTimeout(() => {
        if (!mainToggle.matches(':hover') && !dropdown.matches(':hover')) {
          dropdown.classList.add('hidden');
        }
      }, 200);
    });

    dropdown.addEventListener('mouseleave', (e) => {
      setTimeout(() => {
        if (!mainToggle.matches(':hover') && !dropdown.matches(':hover')) {
          dropdown.classList.add('hidden');
        }
      }, 200);
    });

    // Handle submenu hover (optional enhancement)
    const submenuButtons = document.querySelectorAll('#countries-dropdown button');

    submenuButtons.forEach(button => {
      const submenu = button.nextElementSibling;
      if (!submenu) return;

      button.addEventListener('mouseenter', () => {
        submenu.classList.remove('hidden');
      });

      button.parentElement.addEventListener('mouseleave', () => {
        submenu.classList.add('hidden');
      });
    });
  });
  document.addEventListener('DOMContentLoaded', function() {
    const bookingDropdown = document.getElementById('booking-dropdown');
    const bookingToggle = document.getElementById('booking-trigger'); // Trigger element for the booking dropdown

    // Show dropdown on hover
    bookingToggle.addEventListener('mouseenter', () => {
      bookingDropdown.classList.remove('hidden');
    });

    // Hide dropdown when mouse leaves both the button and the dropdown
    bookingToggle.addEventListener('mouseleave', (e) => {
      setTimeout(() => {
        if (!bookingToggle.matches(':hover') && !bookingDropdown.matches(':hover')) {
          bookingDropdown.classList.add('hidden');
        }
      }, 200);
    });

    bookingDropdown.addEventListener('mouseleave', (e) => {
      setTimeout(() => {
        if (!bookingToggle.matches(':hover') && !bookingDropdown.matches(':hover')) {
          bookingDropdown.classList.add('hidden');
        }
      }, 200);
    });

    // Handle submenu hover (optional enhancement)
    const submenuButtons = document.querySelectorAll('#booking-dropdown button');

    submenuButtons.forEach(button => {
      const submenu = button.nextElementSibling;
      if (!submenu) return;

      button.addEventListener('mouseenter', () => {
        submenu.classList.remove('hidden');
      });

      button.parentElement.addEventListener('mouseleave', () => {
        submenu.classList.add('hidden');
      });
    });
  });
  document.addEventListener('DOMContentLoaded', function() {
    const travelDropdown = document.getElementById('travel-dropdown');
    const travelTrigger = document.getElementById('travel-trigger');

    travelTrigger.addEventListener('mouseenter', () => {
      travelDropdown.classList.remove('hidden');
    });

    travelTrigger.addEventListener('mouseleave', () => {
      setTimeout(() => {
        if (!travelTrigger.matches(':hover') && !travelDropdown.matches(':hover')) {
          travelDropdown.classList.add('hidden');
        }
      }, 200);
    });

    travelDropdown.addEventListener('mouseleave', () => {
      setTimeout(() => {
        if (!travelTrigger.matches(':hover') && !travelDropdown.matches(':hover')) {
          travelDropdown.classList.add('hidden');
        }
      }, 200);
    });
  });
  document.addEventListener('DOMContentLoaded', function() {
    const csrDropdown = document.getElementById('csr-dropdown');
    const csrTrigger = document.getElementById('csr-trigger');

    csrTrigger.addEventListener('mouseenter', () => {
      csrDropdown.classList.remove('hidden');
    });

    csrTrigger.addEventListener('mouseleave', () => {
      setTimeout(() => {
        if (!csrTrigger.matches(':hover') && !csrDropdown.matches(':hover')) {
          csrDropdown.classList.add('hidden');
        }
      }, 200);
    });

    csrDropdown.addEventListener('mouseleave', () => {
      setTimeout(() => {
        if (!csrTrigger.matches(':hover') && !csrDropdown.matches(':hover')) {
          csrDropdown.classList.add('hidden');
        }
      }, 200);
    });
  });


  tailwind.config = {
    theme: {
      extend: {
        colors: {
          primary: '#1a365d', // Deep navy for professionalism
          secondary: '#c2410c', // Adventurous orange for accents
        },
        animation: {
          'fadeIn': 'fadeIn 0.8s ease-out forwards',
        },
        keyframes: {
          fadeIn: {
            'from': {
              opacity: '0',
              transform: 'translateY(20px)'
            },
            'to': {
              opacity: '1',
              transform: 'translateY(0)'
            }
          }
        }
      }
    }
  }
  const goToTopButton = document.getElementById('goToTop');

  window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
      goToTopButton.classList.add('visible');
    } else {
      goToTopButton.classList.remove('visible');
    }
  });

  goToTopButton.addEventListener('click', () => {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
</script>

<style>
  /* Header Dropdowns */
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

  /* Mobile Menu */
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

  /* Swiper Overrides */
  .swiper-button-next,
  .swiper-button-prev {
    background-color: rgba(255, 255, 255, 0.2);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    backdrop-filter: blur(5px);
    transition: all 0.3s ease;
  }

  .swiper-button-next:hover,
  .swiper-button-prev:hover {
    background-color: rgba(255, 255, 255, 0.3);
  }

  .swiper-button-next::after,
  .swiper-button-prev::after {
    font-size: 1.5rem;
    color: white;
  }

  .swiper-pagination-bullet {
    background: white;
    opacity: 0.6;
    width: 12px;
    height: 12px;
  }

  .swiper-pagination-bullet-active {
    background: #1a365d;
    opacity: 1;
  }

  .testimonials-carousel {
    padding-bottom: 3rem;
  }

  .testimonials-carousel .swiper-pagination-bullet {
    width: 12px;
    height: 12px;
    background: rgba(26, 54, 93, 0.3);
    opacity: 1;
    transition: all 0.3s ease;
  }

  .testimonials-carousel .swiper-pagination-bullet-active {
    background: #1a365d;
    width: 30px;
    border-radius: 6px;
  }

  [class="dropdown"] {
    transition: all 0.2s ease;
  }

  / Prevent layout shift / .relative {
    position: relative;
  }

  .absolute {
    position: absolute;
  }

  / Better hover effects */ .hover:bg-gray-50:hover {
    background-color: #f9fafb;
  }

  .hover:text-secondary:hover {
    color: #6b7280;
  }

  @media (max-width: 1024px) {

    .testimonial-prev,
    .testimonial-next {
      display: none;
    }
  }
</style>
</head>

<body class="font-sans antialiased">
  <!-- Top info bar -->
  <div class="py-2 text-sm text-white bg-gray-800">
    <div class="container flex items-center justify-between px-4 mx-auto text-sm md:text-base">
      <span><i class="mr-1 fas fa-medal"></i> 15 Years Experience</span>
      <div>
        <div class="flex items-center space-x-4">
          <span><i class="mr-1 fas fa-phone-alt"></i> +977-9851189771</span>
          <a href="https://api.whatsapp.com/send?phone=9779851189771" target="_blank" class="hover:text-secondary">
            <i class="mr-1 fab fa-whatsapp"></i> WhatsApp
          </a>
          <a href="https://api.whatsapp.com/send?phone=9779851189771" target="_blank" class="hover:text-secondary">
            <i class="mr-1 fab fa-whatsapp"></i> Talk To Expert
          </a>
          <a href="viber://contact?number=9779851189771" target="_blank" class="hover:text-secondary">
            <i class="mr-1 fab fa-viber"></i> Viber
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Main header -->
  <header class="sticky top-0 z-50 bg-white shadow-md">
    <div class="container px-4 mx-auto">
      <div class="flex items-center justify-between py-4">
        <!-- Logo -->
        <a href="index.php" class="flex items-center">
          <img src="assets/logo.png" alt="Advanced Adventures" class="object-contain h-12 md:h-16">
        </a>

        <!-- Desktop Navigation -->
        <nav class="items-center hidden space-x-8 lg:flex">
          <!-- Destinations Mega Menu -->
          <div class="relative">
            <button id="main-toggle" class="flex items-center font-medium text-gray-700 transition hover:text-primary">
              Destination <i class="ml-1 text-xs fas fa-chevron-down"></i>
            </button>

            <div id="countries-dropdown" class="absolute left-0 hidden w-48 mt-2 bg-white rounded-md shadow-xl">
              <ul class="py-1">
                <?php foreach ($menuData as $destId => $dest): ?>
                  <li class="relative group">
                    <button class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-50 hover:text-secondary">
                      <?= htmlspecialchars($dest['name']) ?>
                      <?php if (!empty($dest['categories'])): ?>
                        <i class="ml-2 text-xs fas fa-chevron-right"></i>
                      <?php endif; ?>
                    </button>

                    <?php if (!empty($dest['categories'])): ?>
                      <div class="absolute top-0 hidden bg-white rounded-md shadow-xl whitespace-nowrap left-full">
                        <ul class="py-1">
                          <?php foreach ($dest['categories'] as $catId => $cat): ?>
                            <li class="relative group">
                              <button class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-50 hover:text-secondary">
                                <?= htmlspecialchars($cat['name']) ?>
                                <?php if (!empty($cat['subcategories']) || !empty($cat['posts'])): ?>
                                  <i class="ml-2 text-xs fas fa-chevron-right"></i>
                                <?php endif; ?>
                              </button>

                              <?php if (!empty($cat['subcategories'])): ?>
                                <!-- Show subcategories if they exist -->
                                <div class="absolute top-0 hidden bg-white rounded-md shadow-xl whitespace-nowrap left-full">
                                  <ul class="py-1">
                                    <?php foreach ($cat['subcategories'] as $subcat): ?>
                                      <li class="relative group">
                                        <?php if (!empty($subcat['sposts'])): ?>
                                          <button class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-50 hover:text-secondary">
                                            <?= htmlspecialchars($subcat['name']) ?>
                                            <i class="ml-2 text-xs fas fa-chevron-right"></i>
                                          </button>

                                          <div class="absolute top-0 hidden bg-white rounded-md shadow-xl whitespace-nowrap left-full">
                                            <ul class="py-1">
                                              <?php foreach ($subcat['sposts'] as $post): ?>
                                                <li>
                                                  <a href="new_page.php?id=<?= $post['id'] ?>" class="block px-4 py-2 hover:bg-gray-50 hover:text-secondary">
                                                    <?= htmlspecialchars($post['title']) ?>
                                                  </a>
                                                </li>
                                              <?php endforeach; ?>
                                            </ul>
                                          </div>
                                        <?php else: ?>
                                          <span class="block px-4 py-2 text-gray-400">
                                            <?= htmlspecialchars($subcat['name']) ?>
                                          </span>
                                        <?php endif; ?>
                                      </li>
                                    <?php endforeach; ?>
                                  </ul>
                                </div>
                              <?php elseif (!empty($cat['posts'])): ?>
                                <!-- Show posts directly if no subcategories exist -->
                                <div class="absolute top-0 hidden bg-white rounded-md shadow-xl whitespace-nowrap left-full">
                                  <ul class="py-1">
                                    <?php foreach ($cat['posts'] as $post): ?>
                                      <li>
                                        <a href="new_page.php?id=<?= $post['id'] ?>" class="block px-4 py-2 hover:bg-gray-50 hover:text-secondary">
                                          <?= htmlspecialchars($post['title']) ?>
                                        </a>
                                      </li>
                                    <?php endforeach; ?>
                                  </ul>
                                </div>
                              <?php endif; ?>
                            </li>
                          <?php endforeach; ?>
                        </ul>
                      </div>
                    <?php endif; ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>



          <!-- Other Menu Items -->
          <!-- Booking Dropdown -->
          <div id="booking-container" class="relative inline-block">
            <!-- Trigger -->
            <div id="booking-trigger" class="font-medium text-gray-700 transition cursor-pointer hover:text-primary">
              Booking <i class="fas fa-chevron-down"></i>
            </div>

            <!-- Dropdown Menu -->
            <div id="booking-dropdown" class="absolute left-0 z-50 hidden w-48 mt-2 bg-white rounded-md shadow-lg">
              <a href="booking.php" class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-50 hover:text-secondary">Book Your Trip</a>
              <a href="how_to_pay.php" class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-50 hover:text-secondary">How to Pay</a>
              <a href="payOnline.php" class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-50 hover:text-secondary">Pay Online</a>
              <a href="termsandconditions.php" class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-50 hover:text-secondary">Terms & conditions</a>
              <a href="DiscountOffers.php" class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-50 hover:text-secondary">Discount
                Offers</a>
            </div>
          </div>
          <div id="travel-container" class="relative inline-block">
            <!-- Trigger -->
            <div id="travel-trigger" class="font-medium text-gray-700 transition cursor-pointer hover:text-primary">
              Travel Guide <i class="fas fa-chevron-down"></i>
            </div>


            <!-- Dropdown Menu -->
            <div id="travel-dropdown" class="absolute left-0 z-50 hidden w-48 mt-2 bg-white rounded-md shadow-lg">
              <?php
              $Query = mysqli_query($con, "select * from travel_guide where status=1");
              while ($got_data = mysqli_fetch_assoc($Query)) {
              ?>
                <a href="travel.php?id=<?php echo $got_data["id"]; ?>" class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-50 hover:text-secondary"><?php echo $got_data["Title"]; ?></a>
              <?php } ?>

            </div>

          </div>


          <a href="/page/about-us.html" class="font-medium text-gray-700 transition hover:text-primary">About Us</a>

          <div id="csr-container" class="relative inline-block">
            <!-- Trigger -->
            <div id="csr-trigger" class="font-medium text-gray-700 transition cursor-pointer hover:text-primary">
              CSR <i class="fas fa-chevron-down"></i>
            </div>

            <!-- Dropdown Menu -->
            <div id="csr-dropdown" class="absolute left-0 z-50 hidden mt-2 bg-white rounded-md shadow-lg w-72">
              <?php
              $k = mysqli_query($con, "select * from cms where status=1");
              while ($got = mysqli_fetch_assoc($k)) {
              ?>
                <a href="CSR.php?id=<?php echo $got["id"]; ?>" class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-50 hover:text-secondary"><?php echo $got["Title"]; ?></a>
              <?php } ?>
            </div>
          </div>

          <a href="/testimonials.html" class="font-medium text-gray-700 transition hover:text-primary">Trip Reviews</a>
          <a href="#" class="font-medium text-gray-700 transition hover:text-primary">Travel Blog</a>
          <a href="contact.php" class="font-medium text-gray-700 transition hover:text-primary">Contact</a>
          <!-- Search Button -->
          <button class="p-2 text-gray-600 hover:text-primary">
            <i class="fas fa-search"></i>
          </button>

          <!-- CTA Button -->
          <a href="/page/book-your-trip.html"
            class="bg-primary hover:bg-[#122747] text-white px-4 py-2 rounded-md font-medium transition">
            Book Now
          </a>
        </nav>

        <!-- Mobile Menu Button -->
        <button class="text-gray-700 lg:hidden focus:outline-none" id="mobile-menu-button">
          <i class="text-2xl fas fa-bars"></i>
        </button>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 lg:hidden">
      <div class="absolute top-0 right-0 w-4/5 h-full max-w-sm overflow-y-auto bg-white shadow-lg mobile-menu">
        <div class="flex items-center justify-between p-4 border-b">
          <img src="https://www.advadventures.com/dist/frontend/img/adv-logo-new.jpg" alt="Advanced Adventures"
            class="h-10">
          <button id="close-mobile-menu" class="text-gray-600">
            <i class="text-2xl fas fa-times"></i>
          </button>
        </div>

        <div class="p-4 space-y-4">
          <div class="accordion">
            <button class="flex items-center justify-between w-full py-2 font-medium text-gray-700">
              Destinations <i class="fas fa-chevron-down"></i>
            </button>
            <div class="hidden pl-4 mt-2 space-y-2 accordion-content">
              <a href="/nepal" class="block py-1 hover:text-secondary">Nepal</a>
              <a href="/tibet" class="block py-1 hover:text-secondary">Tibet</a>
              <a href="/bhutan" class="block py-1 hover:text-secondary">Bhutan</a>
              <a href="#" class="block py-1 hover:text-secondary">Mt. Kailash</a>
              <a href="#" class="block py-1 hover:text-secondary">luxury Travel</a>
            </div>
          </div>

          <a href="/page/booking.html" class="block py-2 font-medium text-gray-700">Booking</a>
          <a href="/page/travel-guide.html" class="block py-2 font-medium text-gray-700">Travel Guide</a>
          <a href="/page/about-us.html" class="block py-2 font-medium text-gray-700">About Us</a>
          <a href="/page/csr.html" class="block py-2 font-medium text-gray-700">CSR</a>
          <a href="/testimonials.html" class="block py-2 font-medium text-gray-700">Reviews</a>

          <div class="pt-4 border-t">
            <a href="/page/book-your-trip.html"
              class="block w-full bg-primary hover:bg-[#122747] text-white text-center px-4 py-2 rounded-md font-medium">
              Book Now
            </a>
          </div>
        </div>
      </div>
    </div>
  </header>