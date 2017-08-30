<?php
/**
 * Plugin Name: AddC
 * Plugin URI: http://github.com/sh-sh-dev/AddC
 * Description: a Plugin for access to before and after the title and content posts
 * Version: 1.0
 * Author: Shaygan Shokrollahi
 * Author URI: http://sh-sh-dev.github.io
 * License: MIT
 */

if ( is_admin() ){ // admin actions
    function add_theme_menu_item_addC() {
        add_menu_page("AddC Settings", "AddC Settings", "manage_options", "AddC-Setting", "theme_settings_page_addC", null, 60);
    }
    add_action("admin_menu", "add_theme_menu_item_addC");

    function theme_settings_page_addC() {
        ?>
        <div class="wrap">
            <h1>AddC Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields("section");
                do_settings_sections("AddC-options");
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
    function display_before_title () {
        ?>
        <input placeholder="Text before the subject" name="before_title" value="<?= get_option('before_title'); ?>">
        <?
    }
    function display_after_title () {
        ?>
        <input placeholder="Text after the subject" name="after_title" value="<?= get_option('after_title'); ?>">
        <?
    }
    function display_before_content () {
        ?>
        <hr>
        <input placeholder="Text before the content" name="before_content" value="<?= get_option('before_content'); ?>">
        <?
    }
    function display_after_content () {
        ?>
        <input placeholder="Text after the content" name="after_content" value="<?= get_option('after_content'); ?>">
        <?
    }
    function display_AddC_panel_fields() {
        add_settings_section("section", null, null, "AddC-options");
        add_settings_field("before_title", "Text before the subject", "display_before_title", "AddC-options", "section");
        add_settings_field("after_title", "Text after the subject", "display_after_title", "AddC-options", "section");
        add_settings_field("before_content", "Text before the content", "display_before_content", "AddC-options", "section");
        add_settings_field("after_content", "Text after the content", "display_after_content", "AddC-options", "section");
        register_setting("section", "before_title");
        register_setting("section", "after_title");
        register_setting("section", "before_content");
        register_setting("section", "after_content");
    }
    add_action("admin_init", "display_AddC_panel_fields");
}
else {
    add_filter("the_title","TitleAddC");
    add_filter("the_content","ContentAddC");
    function TitleAddC($title) {
        $separator = ' ';
        $before_title = get_option("before_title").$separator;
        $after_title = get_option("after_title").$separator;
        return $before_title.$title.$after_title;
    }
    function ContentAddC($content) {
        $separator = ' ';
        $before_content = get_option("before_content").$separator;
        $after_content = get_option("after_content").$separator;
        return $before_content.$content.$after_content;
    }
}
?>
