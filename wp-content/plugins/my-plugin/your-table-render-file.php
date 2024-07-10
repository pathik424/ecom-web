<?php
global $wpdb, $table_prefix;
$wp_emp = $table_prefix . 'emp';

// For search query
$search_term = isset($_GET['my_serarch_term']) ? sanitize_text_field($_GET['my_serarch_term']) : '';
if ($search_term) {
    $q = $wpdb->prepare("SELECT * FROM `$wp_emp` WHERE `name` LIKE %s", '%' . $wpdb->esc_like($search_term) . '%');
} else {
    $q = "SELECT * FROM `$wp_emp`;";
}

$result = $wpdb->get_results($q);

// Handle AJAX request for fetching updated table data
if (defined('DOING_AJAX') && DOING_AJAX && isset($_POST['action']) && $_POST['action'] == 'fetch_table_data') {
    ob_start();
    include __FILE__; // Include the file itself to render the table
    echo ob_get_clean();
    wp_die();
}

ob_start();
?>

<table class="wp-list-table widefat fixed striped table-view-list posts">
    <thead>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>STATUS</th>
            <th>PHONE</th>
            <th>USERNAME</th>
            <th>CITY</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody id="my-table-result">
        <?php foreach ($result as $row): ?>
            <tr>
                <td><?php echo esc_html($row->ID); ?></td>
                <td><?php echo esc_html($row->name); ?></td>
                <td><?php echo esc_html($row->email); ?></td>
                <td><?php echo esc_html($row->status); ?></td>
                <td><?php echo esc_html($row->phone); ?></td>
                <td><?php echo esc_html($row->username); ?></td>
                <td><?php echo esc_html($row->city); ?></td>
                <td>
                    <button class="btn-update" data-id="<?php echo esc_attr($row->ID); ?>">Update</button>
                    <button class="delete-button" value="<?php echo esc_attr($row->ID); ?>">Delete</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
echo ob_get_clean();
?>
