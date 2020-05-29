<?php

class Cookie
{
	private $name;
	private $value;
	private $time;

	public function __construct($name, $value='', $time = 0) {
		$this->name = $name;
		$this->value = $value;
		if (empty($time)) {
			$this->time = $time;
		} else {
			$this->time = time() + $time;
		}
	}

	public function setCookie() {
		setcookie($this->name, $this->value, $this->time, '/');
	}

	public function getCookie() {
		return isset($_COOKIE["$this->name"]) ? $_COOKIE["$this->name"] : null;
	}

	public function unCookie() {
		setcookie($this->name, '', -1);
	}
}
