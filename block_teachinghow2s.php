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

		$this->content = new stdClass;

		$content = html_writer::start_tag('form', array(
			'method' => 'post',
			'action' => 'https://app.teachinghow2s.local/moodle/launch'
		));

		$content .= html_writer::empty_tag('input', array(
			'class' => 'launch-image',
			'type'  => 'image',
			'src'   => $CFG->wwwroot . '/blocks/teachinghow2s/images/how2.png'
		));

		foreach ($this->get_launch_params() as $key => $value) {
			$content .= html_writer::empty_tag('input', array(
				'type'  => 'hidden',
				'name'  => $key,
				'value' => $value
			));
		}

		$content .= html_writer::end_tag('form');

		$this->content->text = $content;

		return $this->content;
	}

	public function has_config() {
		return true;
	}

	private function get_launch_params() {

	    global $USER;

		$params = array();

		$params['user'] = $USER->id;
		$params['organisation'] = 'sampleApiKey';
		$params['signature'] = $this->build_signature($params);

		return $params;
	}

	private function build_signature($params) {

		ksort($params);

		$data = '';

		foreach($params as $key => $value) {
			$data .= $key . $value;
		}

		$data = strtolower($data);

		// This will be retrieved from the HOW2 app and inserted by
		// admins when the HOW2 block is installed.
		$secretKey = 'youllneverguess';

		return hash_hmac("sha256", $data, $secretKey);
	}
}