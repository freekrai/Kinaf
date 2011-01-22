<?php
	abstract class Controller{
		
		protected $controller;
		protected $action;
		protected $variableStack;
		protected $pdo;
		
		public function __construct($controller,$action){
			$this->controller = $controller;
			$this->action = $action;
			$this->variableStack = array();
			$this->pdo = db::singleton();
		}
		
		/* render another view by using controller action parameters */
		protected function render_view($controller,$action,$layout="default"){
			if(file_exists(dirname(__FILE__). "/../views/frontEnd/".$controller."/".$action.".php")){
				$layout = new layout($layout);
				$layout->load(dirname(__FILE__). "/../views/frontEnd/".$controller."/".$action.".php",$this->variableStack);
			} else {
				new Error("The view ".$this->action." was not found !");
			}
		}
		
		/* render the current view */
		protected function render($layout = "default"){
			
			if(file_exists(dirname(__FILE__). "/../views/frontEnd/".$this->controller."/".$this->action.".php")){
				$layout = new layout($layout);
				$layout->load(dirname(__FILE__). "/../views/frontEnd/".$this->controller."/".$this->action.".php",$this->variableStack);
			} else {
				new Error("The view ".$this->action." was not found !");
			}
			
		}
		
		protected function add($key,$value){
			if(array_key_exists($key,$this->variableStack)){
				new Error("The key is allready in the variableStack");
			}
			
			$this->variableStack[$key] = $value;
			
		}
	}
?>
