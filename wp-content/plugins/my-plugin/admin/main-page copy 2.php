<?php

global $wpdb, $table_prefix;
$wp_emp = $table_prefix . 'emp';

// for search query
if (isset($_GET['my_serarch_term'])) {
    $q = "SELECT * FROM `$wp_emp` WHERE `name` LIKE '%" . $_GET['my_serarch_term'] . "%';";
} else {
    $q = "SELECT * FROM `$wp_emp`;";
}

$result = $wpdb->get_results($q);

// Handle AJAX request for fetching updated table data
if (isset($_POST['action']) && $_POST['action'] == 'fetch_table_data') {
    ob_start();
    ?>
    <div class="wrap">
    <H1>My Users</H1>
    <div class="my-form">
        <form action="<?php echo admin_url('admin.php'); ?>" id='my-search-form'>
            <input type="hidden" name="page" value="my-plugin-page">
            <input type="text" name="my_serarch_term" id="my-search-term">
            <input type="submit" value="search" name="search">
            <input type="submit" value="clear" name="my-plugin-page">
            <a href="/wordpressWs/customeplugin/ajax-register/" type="button" class="btn btn-primary">Add Employee</a>
        </form>
    </div>

        <table class="wp-list-table widefat fixed striped table-view-list posts">
            <thead>
                <td>ID</td>
            <td>NAME</td>
            <td>EMAIL</td>
            <td>STATUS</td>
            <td>PHONE</td>
            <td>USERNAME</td>
            <td>CITY</td>
            <td>ACTION</td>
        </thead>
        <tbody id="">
            <?php
            foreach ($result as $row) :
                ?>
                <tr>
                    <td><?php echo $row->ID; ?></td>
                    <td><?php echo $row->name; ?></td>
                    <td><?php echo $row->email; ?></td>
                    <td><?php echo $row->status; ?></td>
                    <td><?php echo $row->phone; ?></td>
                    <td><?php echo $row->username; ?></td>
           
                    <td>
                        <button class="btn-update" data-id="<?php echo $row->ID; ?>">Update</button>
                        <button class="delete-button" value=<?php echo $row->ID ?>>Delete</button>
                    </td>
                </tr>
                <?php
            endforeach;
            ?>
        </tbody>
    </table>
    </div>
    <?php
    echo ob_get_clean();
    wp_die();
}




ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form with Popup</title>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Document</title>
</head>
<body>

<div class="container" >
    <div class="content">
        <img src="https://res.cloudinary.com/debbsefe/image/upload/f_auto,c_fill,dpr_auto,e_grayscale/image_fz7n7w.webp" alt="header-image" class="cld-responsive">
        <h1 class="form-title">Register Here</h1>
        <form method="post" action="main-page.php" id="ajaxregform">
            <input type="text" placeholder="First name" name="name" id="name" required>
            <input type="text" placeholder="Email" name="email" id="email" required>
            <input type="text" placeholder="status" name="status" id="status" required>
            <input type="text" placeholder="phone" name="phone" id="phone" required>
            <input type="text" placeholder="UserName" name="username" id="username" required>
            <input type="text" placeholder="city" name="city" id="city" required>
            <input type="submit" class="button" name="register" value="Register" required>
        </form>
    </div>
</div>

<div class="wrap" >
    <H1>My Users</H1>
    <div class="my-form">
        <form action="<?php echo admin_url('admin.php'); ?>" id='my-search-form'>
            <input type="hidden" name="page" value="my-plugin-page">
            <input type="text" name="my_serarch_term" id="my-search-term">
            <input type="submit" value="search" name="search">
            <input type="submit" value="clear" name="my-plugin-page">
            <a href="/wordpressWs/customeplugin/ajax-register/" type="button" class="btn btn-primary">Add Employee</a>
        </form>
    </div>
    <div id="table-container">
        <table class="wp-list-table widefat fixed striped table-view-list posts">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>name</th>
                    <th>email</th>
                    <th>status</th>
                    <th>phone</th>
                    <th>username</th>
                    <th>city</th>
                </tr>
                
                <tbody id="my-table-result">
            </thead>
            <?php
                foreach ($result as $row) :
                ?>
                    <tr>
                        <td><?php echo $row->ID; ?></td>
                        <td><?php echo $row->name; ?></td>
                        <td><?php echo $row->email; ?></td>
                        <td><?php echo $row->status; ?></td>
                        <td><?php echo $row->username; ?></td>
                        <td><?php echo $row->city; ?></td>
                        <td>
                            <button class="btn btn-sm btn-update" id="btn-update" data-id="<?php echo $row->ID; ?>">Update</button>
                            <button class="delete-button" value=<?php echo $row->ID ?> >Delete</button>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>

             
            </thead>
             
            </tbody>
        </table>
    </div>
</div>

<!-- Update Modal -->
<div id="updateModal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Update User</h2>
        <form id="updateForm">
            <input type="hidden" name="ID" id="updateID">
            <input type="text" placeholder="First name" name="name" id="updateName" required>
            <input type="text" placeholder="Email" name="email" id="updateEmail" required>
            <input type="text" placeholder="Status" name="status" id="updateStatus" required>
            <input type="text" placeholder="Phone" name="phone" id="updatePhone" required>
            <input type="text" placeholder="Username" name="username" id="updateUsername" required>
            <input type="text" placeholder="City" name="city" id="updateCity" required>
            <input type="submit" class="button" value="Update">
        </form>
    </div>
</div>


<script>


//------------------------------------------------------------------------------------------My search function----------------------------------



// jQuery('#my-search-form').submit(function(event) {
//     event.preventDefault();
//     var formData = jQuery(this).serialize();
//     jQuery.ajax({
//         url: ajaxurl,
//         type: 'post',
//         data: {
//             action: 'my_search_func', // Action defined in WordPress AJAX hook
//             search_term: jQuery('#my-search-term').val(),
//             // You can add other form data here if needed
//         },
//         success: function(response) {
//             // Update the table content with the returned data
//             jQuery('#my-table-result').html(response);
//         },
//         error: function(xhr, status, error) {
//             console.error("Error fetching data: " + status + " - " + error);
//         }
//     });
// });

//------------------------------------------------------------------------------------------My search function----------------------------------


//----------------------------------------------------------Registration-------------------------------------------------------------


jQuery('#ajaxregform').submit(function(event) {
    event.preventDefault();
    var link = "<?php echo admin_url('admin-ajax.php'); ?>";
    var form = jQuery('#ajaxregform').serialize();
    var formData = new FormData();
    formData.append('action', 'contact_us');
    formData.append('contact_us', form);
    jQuery.ajax({
        url: link,
        data: formData,
        processData: false,
        contentType: false,
        type: 'post',
        success: function(result)
        {
            Swal.fire({
                    title: 'Success!',
                    text: 'Registration successful.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    
                    jQuery('#ajaxregform')[0].reset();
                    fetchTableData();
                    // location.reload();
                });
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Error!',
                    text: 'There was an error processing your request.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
    
//----------------------------------------------------------Registration-------------------------------------------------------------



//----------------------------------------------------------Read-------------------------------------------------------------

  // Function to fetch table data
  function fetchTableData() {
        var link = "<?php echo admin_url('admin-ajax.php'); ?>";
        var formData = new FormData();
        formData.append('action', 'fetch_table_data');

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

    
    //----------------------------------------------------------Read-------------------------------------------------------------
    
    
    
    
    
    
    
    
    
    
    
    
//----------------------------------------------------------Update-------------------------------------------------------------


jQuery(document).ready(function() {
    // Handle update button click
    jQuery(document).on('click', '#btn-update', function() {
        var id = jQuery(this).data('id');
        var link = "<?php echo admin_url('admin-ajax.php'); ?>";
        var formData = new FormData();
        formData.append('action', 'update_entry');
        formData.append('ID', id);
        
        jQuery.ajax({
            url: link,
            data: formData,
            processData: false,
            contentType: false,
            type: 'post',
            success: function(response) {
                if (response.success) {
                    // If the AJAX request is successful, populate the modal with user data
                    var user = response.data;
                    jQuery('#updateID').val(user.ID);
                    jQuery('#updateName').val(user.name);
                    jQuery('#updateEmail').val(user.email);
                    jQuery('#updateStatus').val(user.status);
                    jQuery('#updatePhone').val(user.phone);
                    jQuery('#updateUsername').val(user.username);
                    jQuery('#updateCity').val(user.city);
                    jQuery('#updateModal').show(); // Show the modal
                } else {
                    // If there's an error, show an error message
                    Swal.fire({
                        title: 'Error!',
                        text: response.data,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(xhr, status, error) {
                // If there's an error in the AJAX request itself, show an error message
                Swal.fire({
                    title: 'Error!',
                    text: 'There was an error processing your request.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });


    
    jQuery('#updateForm').submit(function(event) {
    event.preventDefault(); // Prevent the default form submission
    var link = "<?php echo admin_url('admin-ajax.php'); ?>";
    var formData = jQuery(this).serialize(); // Serialize the form data
    
    jQuery.ajax({
        url: link,
        data: formData + '&action=process_update_entry', // Include the action parameter
        type: 'post',
        success: function(result) {
            // console.log('Form Data:', formData); // Log form 
            // console.log(result); // Log form 

            Swal.fire({
                    title: 'Success!',
                    text: 'Registration successful.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    fetchTableData();
                    jQuery('#updateModal').hide();
                                    // location.reload();
                });
        },
        error: function(xhr, status, error) {
            // If there's an error in the AJAX request itself, show an error message
            Swal.fire({
                title: 'Error!',
                text: 'There was an error processing your request.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
});


    // Close modal when clicking on <span> (x)
    jQuery(document).on('click', '.close', function() {
        jQuery('#updateModal').hide(); // Hide the modal
    });

    // Close modal when clicking outside of the modal
    jQuery(window).click(function(event) {
        if (event.target.id == 'updateModal') {
            jQuery('#updateModal').hide(); // Hide the modal
        }
    });
});


//----------------------------------------------------------Update-------------------------------------------------------------
    
        
//----------------------------------------------------------Delete-------------------------------------------------------------


// Add event listener to delete buttons
jQuery(document).on('click', '.delete-button', function() {
    var id = jQuery(this).val(); // Extract the ID of the row to be deleted
    var link = "<?php echo admin_url('admin-ajax.php'); ?>";
    var formData = new FormData();
    formData.append('action', 'delete_entry');
    formData.append('ID', id); // Send the ID of the row to be deleted

    // Display a confirmation prompt
    Swal.fire({
        title: 'Are you sure?',
        text: 'You are about to delete this entry. This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete', 
    }).then((result) => {
        if (result.isConfirmed) {
            // User confirmed, proceed with deletion
            jQuery.ajax({
                url: link,
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(response) {

                    // jQuery('#table-container').html(data);

                    // Upon successful deletion, fetch and update the table data
                    Swal.fire({
                        title: 'Success!',
                        text: 'Entry deleted successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'

                        });
                    fetchTableData();
                    jQuery('#updateModal').hide();
                                    // location.reload();
                    
                  
                    
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'There was an error processing your request.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });
});
</script>

<style>




    html, body {
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

    input[type=text], [type=email] {
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
        background-color: rgba(0,0,0,0.4);
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
echo ob_get_clean();
?>
