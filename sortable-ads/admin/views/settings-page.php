<?php
if (!current_user_can('manage_options')) {
    exit;
}
?>
<div class="wrap">
<h1><?= esc_html(get_admin_page_title()) ?></h1>
 <form action="options.php" method="post">
<?php
settings_fields('srtads');
do_settings_sections($page);
submit_button();
?>
  </form>
</div>
<?php
