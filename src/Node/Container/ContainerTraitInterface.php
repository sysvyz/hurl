<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 26.06.16
 * Time: 23:49
 */

namespace Hurl\Node\Container;



interface ContainerTraitInterface{

	public function getBefore();
	public function getAfter();
}
