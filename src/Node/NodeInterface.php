<?php
namespace Hurl\Node;
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.05.16
 * Time: 03:26
 */
interface NodeInterface
{

	public function __invoke(... $args);

	public function call(callable $then);

}