<?php
if (!defined('SORTABLE_ADS')) {
    exit;
}
?>
<input type="text" class="regular-text ltr srtads-validate" id="srtads_site_domain_field"
       name="<?= esc_attr($args['name']) ?>" value="<?= esc_attr($args['value']) ?>"
       required pattern="[a-zA-Z]([-a-zA-Z0-9]*[a-zA-Z0-9])?(\.[a-zA-Z]([-a-zA-Z0-9]*[a-zA-Z0-9])?)+"
       title="Example: my-example1.domain.com"
       aria-describedby="srtads_site_domain_field_description"/>
<p class="description" id="srtads_site_domain_field_description">
<?= esc_html__('Sortable uses this domain to identify the site. It may be different from the real domain of the site. This should be given to you be your Sortable Representative.', 'sortable-ads') ?>
</p>
