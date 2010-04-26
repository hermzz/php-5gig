<?php

class FiveGig 
{
	private $_api_key = null;
	private $_domain = 'nvivo.es';
	
	public function __construct($api_key)
	{
		$this->_api_key = $api_key;
	}
	
	public function userGetEvents($username, $past=false)
	{
		return $this->_request('user.getEvents', array('user' => $username, 'past' => $past));
	}
	
	private function _request($method, $params)
	{
		$tmp_params = array();
		foreach($params as $k => $v)
			$tmp_params[] = $k.'='.$v;
			
		$url = sprintf('http://www.%s/api/request.php?api_key=%s&method=%s&%s&format=json',
			$this->_domain, $this->_api_key, $method, implode('&', $tmp_params));
		$json = file_get_contents($url);
		
		if(!$json)
			throw new Exception('Got empty response from server');
			
		$data = json_decode($json);
		
		if(!$data)
			throw new Exception('Got invalid JSON from the server');
			
		return $data;
	}
}

?>
