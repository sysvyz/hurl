<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.05.16
 * Time: 20:29
 */

namespace Hurl\Out;


use Hurl\Node\Statics\_Array;

class Tag
{
	protected $name;
	protected $attributes = [];
	protected $content = [];

	/**
	 * Tag constructor.
	 * @param $name
	 * @param array $attributes
	 * @param array $content
	 */
	public function __construct(string $name, array $attributes = [], array $content = [])
	{
		$this->name = $name;
		$this->attributes = $attributes;
		$this->content = $content;
	}

	public static function init($name, array $attributes = [], array $content = [])
	{
		return new self($name, $attributes, $content);
	}

	function __toString()
	{
		$mapimplode = _Array::recursiveMerge()->map(function ($e) {

			return $e . '';
		})->implode('');

		$elem = TagNode::element($this->name, $this->attributes);

		return '' . $elem($mapimplode($this->content));
	}

	/**
	 * @return mixed
	 * @codeCoverageIgnore
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return array
	 * @codeCoverageIgnore
	 */
	public function getAttributes()
	{
		return $this->attributes;
	}

	/**
	 * @return array
	 * @codeCoverageIgnore
	 */
	public function getContent()
	{
		return $this->content;
	}

	/**
	 * @param mixed $name
	 * @return Tag
	 * @codeCoverageIgnore
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * @param array $attributes
	 * @return Tag
	 * @codeCoverageIgnore
	 */
	public function setAttributes($attributes)
	{
		$this->attributes = $attributes;
		return $this;
	}

	/**
	 * @param array $content
	 * @return Tag
	 * @codeCoverageIgnore
	 */
	public function setContent($content)
	{
		$this->content = $content;
		return $this;
	}


	public function inner(... $content)
	{

		$this->content = $content;
		return $this;
	}

}