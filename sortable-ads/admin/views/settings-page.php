<?php
if (!defined('SORTABLE_ADS') || !current_user_can('manage_options')) {
    exit;
}
settings_errors();
?>
<div class="wrap">
    <h1><?= esc_html(get_admin_page_title()) ?></h1>
    <form action="options.php" method="post">
<?php
settings_fields('srtads');
do_settings_sections($args['page']);
submit_button();
?>
    </form>
</div>
