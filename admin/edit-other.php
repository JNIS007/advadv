<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else {
  // Get the ID from the URL
  $id = isset($_GET['oid']) ? intval($_GET['oid']) : 0;

  if ($id > 0) {
    // Fetch existing data from the database
    $query = mysqli_query($con, "SELECT * FROM other WHERE id = $id and is_active=1;");
    $data = mysqli_fetch_assoc($query);

    if (!empty($data['chart_data'])) {
      $chartData = json_decode($data['chart_data'], true);
    }

    if (!$data) {
      $_SESSION['error'] = "Record not found";
      header('location:other-category.php');
      exit();
    }
  } else {
    $_SESSION['error'] = "Invalid ID";
    header('location:other-category.php');
    exit();
  }
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- App title -->
    <title>Adventure | Edit Post</title>

    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/4.20.2/full/ckeditor.js"></script>

    <!-- Select2 -->
    <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

    <!-- Jquery filer css -->
    <link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
    <link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
    <script src="assets/js/modernizr.min.js"></script>
    <script>
      function getSubCat(val) {
        $.ajax({
          type: "POST",
          url: "get_subcategory.php",
          data: 'catid=' + val,
          success: function (data) {
            $("#subcategory").html(data);
          }
        });
      }
    </script>
    <style>
      body {
        font-family: Arial;
      }

      .tabs {
        display: flex;
        background: #364050;
        justify-content: start;
        align-items: center;
        gap: 30px;
        padding: 20px;
      }

      .tab {
        margin-right: 15px;
        font-weight: bold;
        color: #818d9a;
        cursor: pointer;
      }

      .tab.active {
        background: #364050;
        color: white;
        font-weight: bold;
      }

      .tab:hover {
        color: white;
        font-weight: bold;
      }

      .tab-content {
        border: 1px solid #ccc;
        padding: 15px;
      }

      .submit-btn {
        background: #10a3b3;
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        float: right;
        margin-top: 30px;
      }

      #addMoreBtn {
        margin-top: 30px;
      }

      /* Error message styling */
      .alert {
        margin: 15px 0;
        padding: 15px;
        border-radius: 4px;
      }

      .alert-success {
        background-color: #dff0d8;
        border-color: #d6e9c6;
        color: #3c763d;
      }

      .alert-danger {
        background-color: #f2dede;
        border-color: #ebccd1;
        color: #a94442;
      }

      .cke_notifications_area {
        display: none !important;
      }
    </style>
  </head>

  <body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

      <!-- Top Bar Start -->
      <?php include('includes/topheader.php'); ?>
      <!-- ========== Left Sidebar Start ========== -->
      <?php include('includes/leftsidebar.php'); ?>
      <!-- Left Sidebar End -->

      <!-- ============================================================== -->
      <!-- Start right Content here -->
      <!-- ============================================================== -->
      <div class="content-page">
        <!-- Start content -->
        <div class="content">
          <div class="container">

            <!-- Success Message -->
            <?php if (isset($_SESSION["msg"])) { ?>
              <div class="alert alert-success" role="alert">
                <strong>Well done!</strong> <?php echo htmlentities($_SESSION["msg"]); ?>
              </div>
              <?php unset($_SESSION["msg"]); ?>
            <?php } ?>

            <!-- Error Message -->
            <?php if (isset($_SESSION["error"])) { ?>
              <div class="alert alert-danger" role="alert">
                <strong>Oh snap!</strong> <?php echo htmlentities($_SESSION["error"]); ?>
              </div>
              <?php unset($_SESSION["error"]); ?>
            <?php } ?>

            <h4>Edit Package Details</h4>

            <form action="update-other.php" method="POST" id="postForm">
              <input type="hidden" name="id" value="<?php echo $id; ?>">

              <div class="tabs">
                <div class="tab active" data-tab="ITINERARY">ITINERARY</div>
                <div class="tab" data-tab="USEFUL_INFORMATION">USEFUL INFORMATION</div>
                <div class="tab" data-tab="WHATS_INCLUDED">WHATS INCLUDED</div>
                <div class="tab" data-tab="FAQ">FAQ</div>
                <div class="tab" data-tab="RECOMMENDED_PACKAGE">RECOMMENDED PACKAGE</div>
                <div class="tab" data-tab="CHART">CHART</div>
                <div class="tab" data-tab="SEO">SEO</div>
                <div class="tab" data-tab="BELONGS">BELONGS TO</div>
              </div>

              <div class="tab-content" data-tab="ITINERARY">
                <div class="card-box">
                  <h4><b>Detailed Itinerary:</b></h4>
                  <textarea class="form-control" id="editor1" name="It"
                    required><?php echo isset($data['Detailed_Itinerary']) ? htmlspecialchars($data['Detailed_Itinerary']) : ''; ?></textarea>
                </div>
                <div class="card-box">
                  <h4><b>Trip Facts</b></h4>
                  <textarea class="form-control" id="editor2" name="Nt"
                    required><?php echo isset($data['Important_Note']) ? htmlspecialchars($data['Important_Note']) : ''; ?></textarea>
                </div>
              </div>

              <div class="tab-content" data-tab="USEFUL_INFORMATION" style="display:none;">
                <div class="card-box">
                  <h4><b>Useful Information:</b></h4>
                  <textarea class="form-control" id="editor3"
                    name="useful_info"><?php echo isset($data['Useful_Information']) ? htmlspecialchars($data['Useful_Information']) : ''; ?></textarea>
                </div>
              </div>

              <div class="tab-content" data-tab="WHATS_INCLUDED" style="display:none;">
                <div class="card-box">
                  <h4><b>What's Included:</b></h4>
                  <textarea class="form-control" id="editor4"
                    name="whats_included"><?php echo isset($data['Inc']) ? htmlspecialchars($data['Inc']) : ''; ?></textarea>
                </div>
                <div class="card-box">
                  <h4><b>What's Excluded:</b></h4>
                  <textarea class="form-control" id="editor5"
                    name="whats_Excluded"><?php echo isset($data['Exc']) ? htmlspecialchars($data['Exc']) : ''; ?></textarea>
                </div>
              </div>

              <div class="tab-content" data-tab="FAQ" style="display:none;">
                <div class="card-box">
                  <h4><b>FAQ:</b></h4>
                  <textarea class="form-control" id="editor6"
                    name="faq"><?php echo isset($data['faq']) ? htmlspecialchars($data['faq']) : ''; ?></textarea>
                </div>
              </div>

              <div class="tab-content" data-tab="RECOMMENDED_PACKAGE" style="display:none;">
                <div class="card-box">
                  <h4><b>Recommended Package:</b></h4>
                  <textarea class="form-control" id="editor7"
                    name="req"><?php echo isset($data['Recommended_Package']) ? htmlspecialchars($data['Recommended_Package']) : ''; ?></textarea>
                </div>
              </div>
               <div class="tab-content" data-tab="SEO" style="display:none;">
                <div class="card-box">
                  <h4><b>SEO:</b></h4>
                  <div class="form-group m-b-20">
                    <label for="posttitle">Page Title</label>
                    <input type="text" class="form-control" id="posttitle" name="pagetitle" placeholder="Enter title" required 
                      value="<?php echo isset($data['PageTitle']) ? htmlspecialchars($data['PageTitle']) : ''; ?>">
                  </div>
                  <div class="form-group m-b-20">
                    <label for="postkeywords">Meta Keywords</label>
                    <input type="text" class="form-control" id="postkeywords" name="keyword" placeholder="Enter Keywords" required
                      value="<?php echo isset($data['Keywords']) ? htmlspecialchars($data['Keywords']) : ''; ?>">
                  </div>
                  <div class="form-group m-b-20">
                    <label for="postauthor">Meta Author</label>
                    <input type="text" class="form-control" id="postauthor" name="Author" placeholder="Enter Author" required
                      value="<?php echo isset($data['MetaAuthor']) ? htmlspecialchars($data['MetaAuthor']) : ''; ?>">
                  </div>
                  <label for="exampleInputEmail1">Meta Description</label>
                  <textarea class="form-control" id="editor8" name="Desc"><?php 
                    echo isset($data['Description']) ? htmlspecialchars($data['Description']) : ''; 
                  ?></textarea>
                </div>
              </div>

    <div class="tab-content" data-tab="BELONGS" style="display:none;">
    <div class="card-box">
        <h4><b>Belongs To:</b></h4>
        <div class="form-group mb-3">
            <label for="destination">Destination:</label>
            <select class="form-control" name="destination" id="destination" required>
                <option value="">-- Select Destination --</option>
                <?php
                $destQuery = mysqli_query($con, "SELECT id, DestName FROM tbldest WHERE Is_Active = 1;");
                while ($destRow = mysqli_fetch_assoc($destQuery)) {
                    // Get the destination ID from the post
                    $postQuery = mysqli_query($con, "SELECT DestID FROM tblposts WHERE id = " . intval($data['P_id']));
                    $postRow = mysqli_fetch_assoc($postQuery);
                    
                    $selected = ($postRow['DestID'] == $destRow['id']) ? 'selected' : '';
                    echo '<option value="' . $destRow['id'] . '" ' . $selected . '>' . htmlspecialchars($destRow['DestName']) . '</option>';
                }
                ?>
            </select>
        </div>
        
        <div class="form-group mb-3">
            <label for="category">Category:</label>
            <select class="form-control" name="category" id="category" required>
                <option value="">-- Loading Categories... --</option>
            </select>
        </div>
        
        <div class="form-group mb-3">
            <label for="postTitle">Related Post:</label>
            <select class="form-control" name="related_post_id" id="postTitle" required>
                <option value="<?php echo $data['P_id']; ?>" selected>
                    <?php 
                    $postQuery = mysqli_query($con, "SELECT PostTitle FROM tblposts WHERE id = " . intval($data['P_id']));
                    $postRow = mysqli_fetch_assoc($postQuery);
                    echo htmlspecialchars($postRow['PostTitle']);
                    ?>
                </option>
              
            </select>
        </div>
    </div>
</div>

              <div class="tab-content" data-tab="CHART" style="display:none;">
                <div class="card-box">
                  <!-- Container for dynamic fields -->
                  <div id="dynamicFieldsContainer">
                    <?php
                    if (isset($chartData) && count($chartData) > 0) {
                      foreach ($chartData as $item) {
                        echo '<div class="row field-group mt-3">';
                        echo '<div class="col-md-6">';
                        echo '<h4><b>Itinerary Outline:</b></h4>';
                        echo '<input type="text" class="form-control" name="itinerary_outline[]" value="' . htmlspecialchars($item['outline']) . '" />';
                        echo '</div>';
                        echo '<div class="col-md-6">';
                        echo '<h4><b>Height in meter:</b></h4>';
                        echo '<input type="number" class="form-control" name="height_in_meter[]" step="0.01" value="' . htmlspecialchars($item['height']) . '" />';
                        echo '</div>';
                        echo '</div>';
                      }
                    } else {
                      echo '<div class="row field-group">';
                      echo '<div class="col-md-6">';
                      echo '<h4><b>Itinerary Outline:</b></h4>';
                      echo '<input type="text" class="form-control" name="itinerary_outline[]" placeholder="e.g., Day 01" />';
                      echo '</div>';
                      echo '<div class="col-md-6">';
                      echo '<h4><b>Height in meter:</b></h4>';
                      echo '<input type="number" class="form-control" name="height_in_meter[]" step="0.01" placeholder="e.g., 185" />';
                      echo '</div>';
                      echo '</div>';
                    }
                    ?>
                  </div>

                  <!-- Add More Button -->
                  <button type="button" id="addMoreBtn" class="btn btn-primary mt-3">
                    Add Another
                  </button>
                </div>
              </div>

              <br>
              <button type="submit" name="submit" class="submit-btn">Update</button>
            </form>

          </div> <!-- container -->
        </div> <!-- content -->

        <?php include('includes/footer.php'); ?>
      </div>
      <!-- ============================================================== -->
      <!-- End Right content here -->
      <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->

    <script>
      var resizefunc = [];

      // JavaScript to handle tab active class switching
      const tabs = document.querySelectorAll('.tab');
      tabs.forEach(tab => {
        tab.addEventListener('click', function () {
          tabs.forEach(t => t.classList.remove('active'));
          this.classList.add('active');
        });
      });

      const tabButtons = document.querySelectorAll('.tab');
      const tabContents = document.querySelectorAll('.tab-content');

      tabButtons.forEach(tab => {
        tab.addEventListener('click', function () {
          const tabName = this.getAttribute('data-tab');
          tabButtons.forEach(btn => btn.classList.remove('active'));
          this.classList.add('active');

          tabContents.forEach(content => {
            if (content.getAttribute('data-tab') === tabName) {
              content.style.display = 'block';
            } else {
              content.style.display = 'none';
            }
          });
        });
      });

      document.getElementById('addMoreBtn').addEventListener('click', function () {
        const container = document.getElementById('dynamicFieldsContainer');
        const newFieldGroup = document.createElement('div');
        newFieldGroup.className = 'row field-group mt-3';
        newFieldGroup.innerHTML = `
          <div class="col-md-6">
            <h4><b>Itinerary Outline:</b></h4>
            <input type="text" class="form-control" name="itinerary_outline[]" />
          </div>
          <div class="col-md-6">
            <h4><b>Height in meter:</b></h4>
            <input type="number" class="form-control" name="height_in_meter[]" step="0.01"/>
          </div>
        `;
        container.appendChild(newFieldGroup);
      });

      // Form validation
      document.getElementById('postForm').addEventListener('submit', function (e) {
        const requiredFields = document.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
          if (!field.value.trim()) {
            isValid = false;
            field.style.borderColor = 'red';
          } else {
            field.style.borderColor = '';
          }
        });

        if (!isValid) {
          e.preventDefault();
          alert('Please fill in all required fields');
        }
      });

   // Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    const destinationSelect = document.getElementById('destination');
    const categorySelect = document.getElementById('category');
    const postSelect = document.getElementById('postTitle');
    
    // For edit mode, load categories when page loads
    if (destinationSelect.value) {
        loadCategories(destinationSelect.value);
    }
    
    // Destination change handler
    destinationSelect.addEventListener('change', function() {
        if (this.value) {
            loadCategories(this.value);
            // Reset posts dropdown
            postSelect.innerHTML = '<option value="">-- Select Category First --</option>';
            postSelect.disabled = true;
        } else {
            categorySelect.innerHTML = '<option value="">-- Select Destination First --</option>';
            categorySelect.disabled = true;
            postSelect.innerHTML = '<option value="">-- Select Category First --</option>';
            postSelect.disabled = true;
        }
    });
    
    // Category change handler
    categorySelect.addEventListener('change', function() {
        if (this.value && destinationSelect.value) {
            loadPosts(destinationSelect.value, this.value);
        } else {
            postSelect.innerHTML = '<option value="">-- Select Category First --</option>';
            postSelect.disabled = true;
        }
    });
});

function loadCategories(destinationId) {
    const categorySelect = document.getElementById('category');
    
    fetch('get_cat.php?destination_id=' + destinationId)
        .then(response => response.json())
        .then(categories => {
            categorySelect.innerHTML = '<option value="">-- Select Category --</option>';
            categories.forEach(category => {
                const option = document.createElement('option');
                option.value = category.id;
                option.textContent = category.CategoryName;
                categorySelect.appendChild(option);
            });
            categorySelect.disabled = false;
            
            // For edit mode, select the saved category
            <?php if (isset($data['P_id'])): ?>
            const savedCategoryId = <?php 
                $catQuery = mysqli_query($con, "SELECT CategoryId FROM tblposts WHERE id = " . intval($data['P_id']));
                $catRow = mysqli_fetch_assoc($catQuery);
                echo $catRow['CategoryId'] ?? 'null';
            ?>;
            if (savedCategoryId) {
                categorySelect.value = savedCategoryId;
                // Trigger posts load
                loadPosts(destinationId, savedCategoryId);
            }
            <?php endif; ?>
        })
        .catch(error => console.error('Error:', error));
}

function loadPosts(destinationId, categoryId) {
    const postSelect = document.getElementById('postTitle');
    
    fetch('get_posts.php?destination_id=' + destinationId + '&category_id=' + categoryId)
        .then(response => response.json())
        .then(posts => {
            // postSelect.innerHTML = '<option value="">-- Select Post --</option>';
            posts.forEach(post => {
                const option = document.createElement('option');
                option.value = post.id;
                option.textContent = post.PostTitle;
                postSelect.appendChild(option);
            });
            postSelect.disabled = false;
        })
        .catch(error => console.error('Error:', error));
}
    </script>

    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="../plugins/switchery/switchery.min.js"></script>

    <!-- Select 2 -->
    <script src="../plugins/select2/js/select2.min.js"></script>
    <!-- Jquery filer js -->
    <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>

    <!-- App js -->
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>

    <script>
      jQuery(document).ready(function () {
        // Initialize CKEditor for all textareas
        for (let i = 1; i <= 8; i++) {
          CKEDITOR.replace('editor' + i, {
            toolbar: [
              { name: 'document', items: ['Source', '-', 'NewPage', 'Preview', '-', 'Templates'] },
              { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
              { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt'] },
              { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
              { name: 'colors', items: ['TextColor', 'BGColor'] },
              { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'CopyFormatting'] },
              { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
              { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar'] },
              { name: 'tools', items: ['Maximize', 'ShowBlocks'] }
            ],
            height: 300
          });
        }
        // Initialize Select2
        $(".select2").select2();
        $(".select2-limiting").select2({ maximumSelectionLength: 2 });
      });
    </script>

  </body>

  </html>
<?php } ?>