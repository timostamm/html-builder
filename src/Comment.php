<?php 

namespace TS\Text\HtmlBuilder;


/**
 * @author Timo Stamm <ts@timostamm.de>
 * @license AGPLv3.0 https://www.gnu.org/licenses/agpl-3.0.txt
 */
class Comment extends Node {
	
	
	public function __construct($content) {
		if (is_null($content)) {
			// pass
		} else if (is_string($content)) {
			$this->addChild( new Text( $content ) );
		} else if ( $content instanceof Node ) {
			$this->addChild( $content );
		} else {
			$this->addChild( new Text( strval($content) ) );
		}
	}
	
	public function toString() {
		return sprintf('<!--%s-->', $this->childNodesToString() );
	}
	
	public function __toString() {
		return $this->toString();
	}
	
}

