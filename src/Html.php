<?php 

namespace TS\Text\HtmlBuilder;


/**
 * @author Timo Stamm <ts@timostamm.de>
 * @license AGPLv3.0 https://www.gnu.org/licenses/agpl-3.0.txt
 */
class Html {
	
	
	public static $voidTags = ['area', 'base', 'basefont', 'bgsound', 'br', 'col', 'command', 'embed', 'frame', 'hr', 'image', 'img', 'input', 'isindex', 'keygen', 'link', 'menuitem', 'meta', 'nextid', 'param', 'source', 'track', 'wbr'];
	
	
	public static function comment( $text ) {
		return new Comment( $text );
	}
	
	
	public static function text( $text ) {
		return new Text( $text );
	}
	
	
	public static function element($tagName, $attrs=null) {
		
		$attrs = is_null($attrs) ? [] : $attrs;
		
		$el = new Element($tagName, $attrs);
		
		return $el;
		
	}
	
	
}


