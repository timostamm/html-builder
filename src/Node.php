<?php

namespace TS\Text\HtmlBuilder;


use TS\Data\Tree\ProtectedAccess\ChildrenTrait;
use TS\Data\Tree\ProtectedAccess\LookupTrait;


/**
 *
 * @author Timo Stamm <ts@timostamm.de>
 * @license AGPLv3.0 https://www.gnu.org/licenses/agpl-3.0.txt
 */
abstract class Node
{
	
	use ChildrenTrait;
	use LookupTrait;

	protected function childNodesToString()
	{
		$html = '';
		foreach ($this->getChildren() as $child) {
			$html .= $child->toString();
		}
		return $html;
	}

	abstract function toString();

	public function __toString()
	{
		return $this->toString();
	}

}

