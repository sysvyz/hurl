<?php namespace Hurl;

use Traversable;

/**
 * Class Object
 * @package Hurl
 * @codeCoverageIgnore
 */
class Object
{

	public function getHashValue()
	{
		return spl_object_hash($this);
	}

	public function equals($other)
	{
		return $this === $other;
	}
}

/**
 * Class GenericObject
 * @package Hurl
 * @codeCoverageIgnore
 */
class GenericObject implements \ArrayAccess, \IteratorAggregate
{
	public function equals($other)
	{
		if (!($other instanceof GenericObject)) {
			return false;
		}
		foreach ($this as $key => $value) {
			if (!isset($other['$key'])) {
				return false;
			}
		}
	}

	/**
	 * @var array
	 */
	private $vars = [];

	public function __construct()
	{
	}

	public static function init(array $data)
	{
		$instance = new self();
		$instance->vars = $data;
		return $instance;
	}

	public function hydrate(array $data)
	{
		$this->vars = $data + $this->vars;
	}

	function __call($name, $arguments)
	{
		$f = $this->vars[$name];
		if (!is_callable($f)) {
			throw new \Exception($name . " is not callable!");
		}
		return $f(...$arguments);

	}

	function __get($name)
	{
		return $this->vars[$name];
	}

	function __set($name, $value)
	{
		$this->vars[$name] = $value;
	}

	function __isset($name)
	{
		return isset($this->vars[$name]);
	}

	function __unset($name)
	{

		unset($this->vars[$name]);
	}


	/**
	 * Whether a offset exists
	 * @link http://php.net/manual/en/arrayaccess.offsetexists.php
	 * @param mixed $offset <p>
	 * An offset to check for.
	 * </p>
	 * @return boolean true on success or false on failure.
	 * </p>
	 * <p>
	 * The return value will be casted to boolean if non-boolean was returned.
	 * @since 5.0.0
	 */
	public function offsetExists($offset)
	{
		return isset($this->vars[$offset]);
	}

	/**
	 * Offset to retrieve
	 * @link http://php.net/manual/en/arrayaccess.offsetget.php
	 * @param mixed $offset <p>
	 * The offset to retrieve.
	 * </p>
	 * @return mixed Can return all value types.
	 * @since 5.0.0
	 */
	public function offsetGet($offset)
	{
		return $this->vars[$offset];
	}

	/**
	 * Offset to set
	 * @link http://php.net/manual/en/arrayaccess.offsetset.php
	 * @param mixed $offset <p>
	 * The offset to assign the value to.
	 * </p>
	 * @param mixed $value <p>
	 * The value to set.
	 * </p>
	 * @return void
	 * @since 5.0.0
	 */
	public function offsetSet($offset, $value)
	{
		$this->vars[$offset] = $value;
	}

	/**
	 * Offset to unset
	 * @link http://php.net/manual/en/arrayaccess.offsetunset.php
	 * @param mixed $offset <p>
	 * The offset to unset.
	 * </p>
	 * @return void
	 * @since 5.0.0
	 */
	public function offsetUnset($offset)
	{
		unset($this->vars[$offset]);
	}

	/**
	 * Retrieve an external iterator
	 * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
	 * @return Traversable An instance of an object implementing <b>Iterator</b> or
	 * <b>Traversable</b>
	 * @since 5.0.0
	 */
	public function getIterator()
	{
		return new \ArrayIterator($this->vars);
	}
}