<?php

class Router {
	 /*
	 * @the registry
	 */
	 private $registry;

	 /*
	 * @the controller path
	 */
	 private $path;

	 private $args = array();

	 public $file;

	 public $controller;

	 public $action;

	 function __construct($registry) {
			$this->registry = $registry;
	 }

	 /**
	 *
	 * @set controller directory path
	 *
	 * @param string $path
	 *
	 * @return void
	 *
	 */
	 function setPath($path) {

		if (is_dir($path) == false)
		{
			throw new Exception ('Invalid controller path: `' . $path . '`');
		}
		$this->path = $path;
	}


	 /**
	 *
	 * @load the controller
	 *
	 * @access public
	 *
	 * @return void
	 *
	 */
	 public function loader()
	 {

		$this->getController();

		if (is_readable($this->file) == false)
		{
			$this->file = $this->path.'/error404.php';
					$this->controller = 'error404';
		}

		// include the controller
		include $this->file;

		$class = $this->controller . 'Controller';
		$controller = new $class($this->registry);

		if (is_callable(array($controller, $this->action)) == false)
		{
			$action = 'index';
		}
		else
		{
			$action = $this->action;
		}

		$controller->$action();
	 }


	 /**
	 *
	 * @get the controller
	 *
	 * @access private
	 *
	 * @return void
	 *
	 */
	private function getController() {

		/*** get the route from the url ***/
		$route = (empty($_GET['rt'])) ? '' : $_GET['rt'];

		if (empty($route))
		{
			$route = 'index';
		}
		else
		{
			$parts = explode('/', $route);
			$this->controller = $parts[0];
			if(isset( $parts[1]))
			{
				$this->action = $parts[1];
			}
		}

		if (empty($this->controller))
		{
			$this->controller = 'index';
		}

		if (empty($this->action))
		{
			$this->action = 'index';
		}

		$this->file = $this->path .'/'. $this->controller . 'Controller.php';
	}

}
