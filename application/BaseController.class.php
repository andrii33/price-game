<?php

abstract Class BaseController {

	/*
	 * @registry object
	 */
	protected $registry;

	public function __construct($registry) {
		$this->registry = $registry;
	}

	/**
	 * @all controllers must contain an index method
	 */
	abstract function index();


	/**
	 * @param $key
	 * @return string
	 */
	public function getArgument($key) {
		return @trim(strip_tags($_GET[$key]));
	}

}
