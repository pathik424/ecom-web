<?php

//---------------------------------------------------------Start Register Data----------------------------------------------------------------------------------}}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>


  <!-- Ensure you have included these in your HTML -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>



  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



  <title>Document</title>

</head>
<body>


<div class="container">
  <div class="content">
    <img src="https://res.cloudinary.com/debbsefe/image/upload/f_auto,c_fill,dpr_auto,e_grayscale/image_fz7n7w.webp" alt="header-image" class="cld-responsive">

    <h1 class="form-title">My User</h1>
    <form method="post" action="" id="userajaxregform">
      <input type="text" placeholder="name" name="display_name" class="forms_field-input" />
      <input type="text" placeholder="User name" name="user_login" class="forms_field-input" />
      <input type="text" placeholder="User Nicename" name="user_nicename" class="forms_field-input" />
      <input type="email" placeholder="Email" name="user_email" class="forms_field-input" />
      <input type="password" placeholder="Password" name="user_pass" class="forms_field-input" />
      <br>
      <br>
      <input type="submit" class="button" name="register" value="Register" required>
    </form>
  </div>
</div>











<?php
//---------------------------------------------------------------------Register----------------------------------------------------------------
?>


<script>
  <?php
  //---------------------------------------------------------------------Register-------------------------------------------------------------- 
  ?>
  jQuery(document).ready(function($) {
    $('#userajaxregform').submit(function(event) { // Add event as parameter
      event.preventDefault(); // Use event to prevent default behavior
      // console.log('Form submission intercepted.');

      var link = "<?php echo admin_url('admin-ajax.php'); ?>";
      // console.log('Admin AJAX URL:', link);

      var form = $('#userajaxregform').serialize();
      // console.log('Serialized form data:', form);

      var formData = new FormData();
      formData.append('action', 'user_us');
      formData.append('user_us', form);

      // console.log('FormData object:', formData);

      $.ajax({
        url: link,
        data: formData,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(result)
        {
            Swal.fire({
                    title: 'Success!',
                    text: 'Registration successful.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    
                    jQuery('#userajaxregform')[0].reset();
                    fetchTableData(); // anathi reload nai thay
                    // location.reload();
                });
          
        },
        error: function(xhr, status, error) {
          // console.error('AJAX call failed:', xhr.responseText);
          Swal.fire('Error', 'An error occurred: ' + xhr.responseText, 'error');
        }
      });
    });
  });




  
  // Function to fetch table data

  function fetchTableData() {
        var link = "<?php echo admin_url('admin-ajax.php'); ?>";
        var formData = new FormData();
        formData.append('action', 'fetch_user_table_data');

        jQuery.ajax({
            url: link,
            data: formData,
            processData: false,
            contentType: false,
            type: 'post',
            success: function(data) {
                jQuery('#table-container').html(data);
            },
            error: function(xhr, status, error) {
                console.error("Error fetching table data: " + status + " - " + error);
            }
        });
    }

    // Fetch table data on page load
    jQuery(document).ready(function() {
        fetchTableData();
    });


//  // Add event listener to delete buttons

//  jQuery(document).on('click', '.delete-button', function() {
//     var id = jQuery(this).val(); // Extract the ID of the row to be deleted
//     var link = "<?php echo admin_url('admin-ajax.php'); ?>";
//     var formData = new FormData();
//     formData.append('action', 'user_delete_entry');
//     formData.append('ID', id); // Send the ID of the row to be deleted

//     // Display a confirmation prompt
//     Swal.fire({
//         title: 'Are you sure?',
//         text: 'You are about to delete this entry. This action cannot be undone.',
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes, delete', 
//     }).then((result) => {
//         if (result.isConfirmed) {
//             // User confirmed, proceed with deletion
//             jQuery.ajax({
//                 url: link,
//                 data: formData,
//                 processData: false,
//                 contentType: false,
//                 type: 'POST',
//                 success: function(response) {

//                     // jQuery('#table-container').html(data);

//                     // Upon successful deletion, fetch and update the table data
//                     Swal.fire({
//                         title: 'Success!',
//                         text: 'Entry deleted successfully.',
//                         icon: 'success',
//                         confirmButtonText: 'OK'

//                         });
//                     fetchTableData();
//                     // jQuery('#updateModal').hide();
//                                     // location.reload();
                    
                  
                    
//                 },
//                 error: function(xhr, status, error) {
//                     Swal.fire({
//                         title: 'Error!',
//                         text: 'There was an error processing your request.',
//                         icon: 'error',
//                         confirmButtonText: 'OK'
//                     });
//                 }
//             });
//         }
//     });
// });



   

</script>





<style>
  html,
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: bisque;
    height: 100%;
  }

  .swal2-actions {
    align-items: center;
    justify-content: center;
    width: 100% !important;
    max-width: 100% !important;
  }

  .container {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .content {
    background-color: white;
    width: 500px;
    height: 700px;
  }

  img {
    width: 100%;
    height: 25%;
  }

  .form-title {
    padding: 10px 40px 0px;
  }

  form {
    padding: 0px 40px;
  }

  input[type=text],
  input[type=email],input[type=password] {
    border: none;
    border-bottom: 1px solid black;
    outline: none;
    width: 100%;
    margin: 8px 0;
    padding: 10px 0;
  }

  input[type=number] {
    border: none;
    border-bottom: 1px solid black;
    outline: none;
    margin: 8px 0;
    padding: 5px 0;
  }

  select {
    border: none;
    border-bottom: 1px solid black;
    outline: none;
    margin: 8px 0;
    padding: 5px 0;
    width: 50%;
  }

  .beside {
    display: flex;
    justify-content: space-between;
  }

  button {
    color: #ffffff;
    background-color: #4caf50;
    height: 40px;
    width: 25%;
    margin-top: 15px;
    cursor: pointer;
    border: none;
    border-radius: 2%;
    outline: none;
    text-align: center;
    font-size: 16px;
    text-decoration: none;
    -webkit-transition-duration: 0.4s;
    transition-duration: 0.4s;
  }

  button:hover {
    background-color: #333333;
  }

  .page-content {
    display: flex;
    gap: 50px;
    align-items: start;
  }

  /* Modal Styles */
  #updateModal {
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
    display: none;
  }

  .modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
  }

  .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }

  .close:hover,
  .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }
</style>




</body>
</html>






<?php
//---------------------------------------------------------End Registration Data----------------------------------------------------------------------------------}}







//---------------------------------------------------------Start View Data----------------------------------------------------------------------------------}}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>Document</title>
</head>

<body>

<div id="table-container">
        <table class="wp-list-table widefat fixed striped table-view-list posts">

        </table>
        </div>

</body>

</html>
<?php

//--------------------------------------------------------End View Data----------------------------------------------------------------------------------}}
?>