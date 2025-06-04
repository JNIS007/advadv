<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSR</title>
    <?php
    include("./admin/includes/config.php");
    include("header.php");
        $relatedPages = [
      "Responsible Tourism in Nepal with Advanced Adventures" => "responsible-tourism.php",
      "Health & Porter Policy" => "health-porter-policy.php",
      "Education" => "#",
      "Social Awareness" => "social-awareness.php",
      "Wild Guide Nepal" => "wild-guide-nepal.php",
      "Employment" => "employment.php",
      "Wildlife Spotting" => "wildlife-spotting.php",
      "Learn Nepali Language" => "learn-nepali-language.php"
    ];

    $i=isset($_GET["id"]) ? $_GET["id"] : 0;
    $Q = mysqli_query($con,"select * from cms where id ='$i'");
    $data= mysqli_fetch_assoc($Q);
    ?>

    <div class="container px-4 py-8 mx-auto lg:px-8">
        <div class="flex items-center mb-6 text-gray-600">
            <a href="/" class="hover:text-blue-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                    </path>
                </svg>
            </a>
            <span class="mx-2">→</span>
            <span><?php echo $data["Title"];?></span>
        </div>
        <!-- Main Content and Sidebar Wrapper -->
        <div class="flex flex-col gap-8 lg:flex-row">
            <!-- Main Content -->
            <div class="w-full lg:w-3/4">
                <h1 class="mb-6 text-3xl font-bold"><?php echo $data["Title"];?></h1>

                <!-- Featured Image -->
                <div class="mb-8">
                    <img src="./admin/<?php echo $data["Img_url"];?>" alt="Nepal Visa" class="w-full h-auto mb-6 rounded-lg shadow-md">
                </div>

                <!-- Nepal Visa Info -->
                <div class="space-y-6 text-gray-800 leading-relaxed text-[16px]">
                    <?php echo $data["Description"];?>
                </div>

                <!-- Newsletter -->
                <div class="mt-10">
                    <div class="p-6 rounded-lg shadow-sm bg-indigo-50">
                        <div class="flex flex-col justify-between sm:flex-row sm:items-center">
                            <div class="mb-4 sm:mb-0">
                                <p class="text-lg font-medium text-gray-800">Sign Up for Newsletter for Special Deals &
                                    Discounts</p>
                                <p class="mt-1 text-sm text-gray-600">Stay updated with our latest offers and travel
                                    packages</p>
                            </div>
                            <div class="flex-shrink-0 sm:ml-4">
                                <form class="flex w-full sm:w-auto">
                                    <input type="email" placeholder="Your Email Address"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-l sm:w-64 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                        required>
                                    <button type="submit"
                                        class="px-4 py-2 text-white transition-colors bg-indigo-600 rounded-r hover:bg-indigo-700 whitespace-nowrap">
                                        Subscribe
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

     <aside class="w-full lg:w-1/4">
                <div class="sticky top-6">
                    <div class="p-6 bg-white rounded-lg shadow-md">
                        <h3 class="mb-4 text-xl font-bold text-gray-800">Related Pages</h3>
                        <ul class="space-y-3">
                          <?php foreach($relatedPages as $title => $link){?>
                            <li class="pb-3 border-b">
                                <a href="<?php echo $link; ?>" class="text-blue-600 transition-colors hover:text-blue-800"> <?php echo $title; ?></a>
                            </li>
                           <?php } ?>
                        </ul>
                    </div>
                </div>
            </aside>
      </div>
    </div>
  </div>
        </div>
    </div>




    <?php
    include("footer.php");
    ?>

    </body>

</html>