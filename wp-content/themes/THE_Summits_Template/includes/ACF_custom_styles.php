<?php

add_action('acf/input/admin_head', 'my_acf_admin_head');

function my_acf_admin_head() {
?>

<style type="text/css">

div.acf-label.acf-accordion-title, h2.hndle.ui-sortable-handle {
    background-color: lightblue;
    text-align: left;
}
</style>

<?php
}