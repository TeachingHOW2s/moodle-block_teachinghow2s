<?php

defined('MOODLE_INTERNAL') || die();

$capabilities = array(
	'block/teachinghow2s:myaddinstance' => array(
		'captype' => 'write',
		'contextlevel' => CONTEXT_SYSTEM,
		'archetypes' => array(
			'user' => CAP_ALLOW
		),
		'clonepermissionsfrom' => 'moodle/my:manageblocks'
	),

	'block/teachinghow2s:addinstance' => array(
		'riskbitmask' => RISK_SPAM | RISK_XSS,
		'captype' => 'write',
		'contextlevel' => CONTEXT_BLOCK,
		'archetypes' => array(
			'editingteacher' => CAP_ALLOW,
			'manager' => CAP_ALLOW
		),
		'clonepermissionsfrom' => 'moodle/site:manageblocks'
	)
);