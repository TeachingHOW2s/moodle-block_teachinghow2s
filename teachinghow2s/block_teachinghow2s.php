<?php

class block_teachinghow2s extends block_base {

	public function init() {
		$this->title = get_string('pluginname', 'block_teachinghow2s');
	}

	public function get_content() {

	    global $CFG;

		if ($this->content !== null) {
			return $this->content;
		}

		if (! isloggedin() || isguestuser()) {
			return '';
		}

		// Disable the block if required settings haven't been provided
		if (! get_config('block_teachinghow2s', 'security_key') ||
			! get_config('block_teachinghow2s', 'organisation_id')) {
			return '';
		}

		$this->content = new stdClass;

		$content = html_writer::start_tag('form', array(
			'method' => 'post',
			'action' => 'https://app.teachinghow2s.com/moodle/launch'
		));

		$content .= html_writer::empty_tag('input', array(
			'class' => 'launch-image',
			'type'  => 'image',
			'src'   => $CFG->wwwroot . '/blocks/teachinghow2s/images/how2.png'
		));

		$content .= html_writer::empty_tag('input', array(
			'type'  => 'hidden',
			'name'  => 'params',
			'value' => base64_encode(json_encode($this->get_launch_params()))
		));

		$content .= html_writer::end_tag('form');

		$this->content->text = $content;

		return $this->content;
	}

	public function has_config() {
		return true;
	}

	private function get_launch_params() {

	    global $USER, $CFG;

		$params = array();

		$params['muid'] = get_host_from_url($CFG->wwwroot) . ':' . $USER->id;
		$params['oid']  = get_config('block_teachinghow2s', 'organisation_id');
		$params['murl'] = $CFG->wwwroot;
		$params['s']    = $this->build_signature(
			$params,
			get_config('block_teachinghow2s', 'security_key')
		);

		return $params;
	}

	private function build_signature($params, $securityKey) {

		ksort($params);

		$data = '';

		foreach($params as $key => $value) {
			$data .= $key . $value;
		}

		$data = strtolower($data);

		return hash_hmac("sha256", $data, $securityKey);
	}
}