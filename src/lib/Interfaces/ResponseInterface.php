<?php

interface ResponseInterface {
	
	public function setContent($content);
	public function setHeader($header);
	public function status($code);
	public function outPut($content);

}

?>
