<?php
defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

	$settings->add(new admin_setting_heading(
		'block_teachinghow2s/settings',
		new lang_string('authsettings', 'block_teachinghow2s'),
		new lang_string('authsettingsdesc', 'block_teachinghow2s')
	));

	$settings->add(new admin_setting_configtext(
		'block_teachinghow2s/security_key',
		new lang_string('securitykey', 'block_teachinghow2s'),
		'',
		'',
		PARAM_TEXT
	));

	$settings->add(new admin_setting_configtext(
		'block_teachinghow2s/organisation_id',
		new lang_string('organisationid', 'block_teachinghow2s'),
		'',
		'',
		PARAM_TEXT
	));
}