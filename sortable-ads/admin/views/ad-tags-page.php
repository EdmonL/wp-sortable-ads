<div class="wrap">
    <h1><?= esc_html(get_admin_page_title()) ?></h1>
    <form>
<?php
do_settings_sections($args['page']);
?>
    </form>
</div>
<?php
