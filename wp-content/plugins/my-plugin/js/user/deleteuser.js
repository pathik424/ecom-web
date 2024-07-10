
alert('i am here');





//  // Add event listener to delete buttons

 jQuery(document).on('click', '.delete-button', function() {

    var id = jQuery(this).val(); // Extract the ID of the row to be deleted
    var link = ajax_object.ajax_url;
    var formData = new FormData();
    formData.append('action', 'user_delete_entry');
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
                    // jQuery('#updateModal').hide();
                                    // location.reload();
                    
                  
                    
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log the server response
                    // console.log(status);
                    // console.log(error);
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