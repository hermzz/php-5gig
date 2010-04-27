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
	
	public function venueGet($venue_id)
	{
		return $this->_request('venue.get', array('venue_id' => $venue_id));
	}
	
	public function venueGetEvents($venue_id, $past=false)
	{
		return $this->_request('venue.getEvents', array('venue_id' => $venue_id, 'past' => $past));
	}
	
	public function cityGetEvents($city, $country_iso=false, $past=false)
	{
		return $this->_request('city.getEvents', array('city' => $city, 'country_iso' => $country_iso, 'past' => $past));
	}
	
	public function artistGetEvents($artist, $country_iso=false, $past=false)
	{
		return $this->_request('city.getEvents', array('artist' => $artist, 'country_iso' => $country_iso, 'past' => $past));
	}
	
	public function setDomain($domain)
	{
		$this->_domain = $domain;
	}
	
	private function _request($method, $params)
	{
		$tmp_params = array();
		foreach($params as $k => $v)
			$tmp_params[] = $k.'='.urlencode($v);
			
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
