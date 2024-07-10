// Function to fetch table data
function fetchTableData() {
    var formData = new FormData();
    formData.append('action', 'fetch_table_data');

    jQuery.ajax({
        url: ajax_object.ajax_url,
        data: formData,
        processData: false,
        contentType: false,
        type: 'post',
        success: function(response) {
            if (response.success) {
                jQuery('#table-container').html('<table class="wp-list-table widefat fixed striped table-view-list posts"><thead><td>ID</td><td>NAME</td><td>EMAIL</td><td>status</td><td>phone</td><td>username</td><td>city</td><td>Action</td></thead><tbody id="my-table-result">' + response.data + '</tbody></table>');
            }
        }
    });
}

// Function to fetch form data
function fetchFormData() {
    var formData = jQuery('#ajaxregform').serializeArray();
    var html = '<h2>Registered User Information</h2><ul>';

    formData.forEach(function(input) {
        html += '<li><strong>' + input.name + ':</strong> ' + input.value + '</li>';
    });

    html += '</ul>';
    jQuery('#table-container').append(html);
}

// Function to handle form submission
jQuery('#ajaxregform').on('submit', function(e) {
    e.preventDefault(); // Prevent default form submission

    var formData = jQuery(this).serialize(); // Serialize form data

    jQuery.ajax({
        url: ajax_object.ajax_url,
        type: 'post',
        data: {
            action: 'process_form_data',
            form_data: formData
        },
        success: function(response) {
            if (response.success) {
                fetchTableData(); // Reload table data after form submission
            }
        }
    });
});

// Initial table data load
jQuery(document).ready(function() {
    fetchTableData();
});
