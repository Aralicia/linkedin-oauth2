<?php
/**
 * @package   datastore
 * @author    Spoon <spoon4@gmail.com>
 * @link      https://github.com/Spoon4/linkedin-oauth2
 * @copyright 2014 Spoon
 *
 * @since    1.1.0
 */
class LinkedInUser
{
	private $token;
	private $data = array();
	
	/**
	 * Constructor
	 *
	 * @param LinkedInToken $token
	 */
	public function __construct(LinkedInToken $token)
	{
		$this->token = $token;
	}
	
	public function isValid()
	{
		return $this->token && $this->token->isValid();
	}
	
	public function setToken(LinkedInToken $token)
	{
		$this->token = $token;
	}
	
	public function getToken()
	{
		return $this->token;
	}
	
	public function setProperties(array $data)
	{
		$this->data = $data;
	}
	
	public function __set($property, $value)
	{
		$this->data[$property] = $value;
	}
		
	public function __get($property)
	{
		if(array_key_exists($property, $this->data))
			return $this->data[$property];
	//	else
	//		throw new LinkedInException('linkedin_user_exception', "The property '$property' doesn't exist on LinkedIn user.");
		return null;
	}
	
	public function __isset($property)
	{
		return isset($this->data[$property]);
	}
	
	// public function __sleep()
	// {
	// 	return array_merge(array('token'), array_keys($this->data));
	// }
	
	public function __toString()
	{
		return "{token: $this->token, data: [".join(', ', $this->data)."]}";
	}
}