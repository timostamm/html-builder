<?php 

namespace TS\Text\HtmlBuilder;


/**
 * @author Timo Stamm <ts@timostamm.de>
 * @license AGPLv3.0 https://www.gnu.org/licenses/agpl-3.0.txt
 */
class RawHtml extends Node {
	
	
	public $html;
	
	
	public function __construct( $html ) {
		if ( is_string( $html ) ) {
			$this->html = $html;
		} else if ( is_null( $html ) ) {
			$this->html = '';
		} else {
			throw new \LogicException();
		}
	}
	
	public function toString() {
		return $this->html;
	}
	

	public function __toString() {
		return $this->toString();
	}
	
}

