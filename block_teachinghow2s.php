<?php

class block_teachinghow2s extends block_base {

	public function init() {
		$this->title = get_string('pluginname', 'block_teachinghow2s');
	}

	public function get_content() {
		if ($this->content !== null) {
			return $this->content;
		}

		$this->content = new stdClass;
		$this->content->text = 'Testing 123';
		$this->content->footer = 'Footer?';

		return $this->content;
	}

	public function has_config() {
		return true;
	}
}