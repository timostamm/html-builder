<?php 

namespace TS\Text\HtmlBuilder;


/**
 * @author Timo Stamm <ts@timostamm.de>
 * @license AGPLv3.0 https://www.gnu.org/licenses/agpl-3.0.txt
 */
class Text extends Node {
	
	public $text;
	
	public function __construct( $text ) {
		if ( is_string( $text ) ) {
			$this->text = $text;
		} else if ( is_null( $text ) ) {
			$this->text = '';
		} else {
			$this->text = strval( $text );
		}
	}
	
	public function toString() {
		return htmlspecialchars($this->text, ENT_NOQUOTES | ENT_SUBSTITUTE | ENT_DISALLOWED | ENT_HTML5, 'UTF-8');
	}
	

	public function __toString() {
		return $this->toString();
	}
	
}

