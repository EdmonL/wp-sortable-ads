<?php
if (!current_user_can('manage_options')) {
    exit;
}
/*if (isset($_GET['settings-updated'])) {
    add_settings_error('srtads_messages', 'srtads_message', __('Settings saved.', 'srtads'), 'updated');
}*/
//settings_errors('srtads_message');
?>
<div class="wrap">
 <h1><?= esc_html(get_admin_page_title()) ?></h1>
 <form action="options.php" method="post">
<?php
settings_fields('srtads');
submit_button();
?>
  </form>
</div>
<?php
