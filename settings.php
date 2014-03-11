<?php
defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

    $settings->add(new admin_setting_configtext(
        'block_teachinghow2s/testparam',
        new lang_string('testparam', 'block_teachinghow2s'),
        new lang_string('testparamdesc', 'block_teachinghow2s'),
        'Default val',
        PARAM_TEXT
    ));
}