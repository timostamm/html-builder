<?php

namespace TS\Text\HtmlBuilder;


use TS\Data\Tree\ProtectedAccess\AttributesTrait;

/**
 * @author Timo Stamm <ts@timostamm.de>
 * @license AGPLv3.0 https://www.gnu.org/licenses/agpl-3.0.txt
 */
class Element extends Node {
	
	
	use AttributesTrait;
	
	private $tagName = '';
	
	
	public function __construct( $tagName, array $attributes=null ) {
		$this->tagName = $tagName;
		if ( is_array($attributes) ) {
			foreach ( $attributes as $name => $value ) {
				$this->setAttribute($name, $value);
			}
		}
	}
	
	// since we do not parse html, it does not make much sense to expose a query api
	/*
	public function children() {
		$this->children(function(Node $node){
			return $node instanceof Element;
		});
	}
	
	public function find(callable $where) {
		if ( $where($this) ) {
			yield $this;
		}
		$eles = $this->descendants(function(Node $node){
			return $node instanceof Element && $where($node);
		});
		foreach ($eles as $el) {
			yield $el;
		}
	}
	
	public function closest(callable $where) {
		if ( $where($this) ) {
			return $this;
		}
		return $this->ancestor(function(Node $node){
			return $node instanceof Element && $where($node);
		});
	}
	*/
	
	
	public function removeAttr($name) {
		$this->removeAttribute( $name );
		return $this;
	}
	
	
	public function attr($name, $value) {
		
		if ( 1 == func_num_args() )
		{
			if ( false === $this->hasAttribute($name) ) {
				return null;
			}
			
			return $this->getAttribute($name, true);
			
		}
		else if ( 2 == func_num_args() )
		{
			
			$this->setAttribute($name, $value);
			
			return $this;
			
		}
		else if ( 0 === func_num_args() )
		{
			
			return $this->getAttributes();
			
		}
		else
		{
			throw new \InvalidArgumentException();
		}
		
	}
	
	
	public function append($tagNameOrNode, array $attrs=null) {
		if ( $tagNameOrNode instanceof Node ) {
			$this->addChild( $tagNameOrNode );
			if (is_null($attrs) == false) {
				throw new \InvalidArgumentException();
			}
		} else {
			$el = Html::element($tagNameOrNode, $attrs);
			$this->addChild( $el );
		}
		return $this;
	}
	
	
	public function appendTo( Element $target ) {
		$target->append( $this );
		return $this;
	}
	
	
	public function prepend($tagNameOrNode, array $attrs=null) {
		if ( $tagNameOrNode instanceof Node ) {
			$this->insertChildAt(0, $tagNameOrNode);
			if (is_null($attrs) == false) {
				throw new \InvalidArgumentException();
			}
		} else {
			$el = Html::element($tagNameOrNode, $attrs);
			$this->insertChildAt(0, $el );
		}
		return $this;
	}
	
	
	public function prependTo( Element $target ) {
		$target->prepend( $this );
		return $this;
	}
	
	
	
	public function html() {
		if ( 1 === func_num_args() )
		{
			$this->addChild( new RawHtml( func_get_arg(0) ) );
			return $this;
		}
		else if ( 0 === func_num_args() ) {
			$html = '';
			foreach ( $this->getChildren() as $node ) {
				$html .= $node->toString();
			}
			return $html;
		}
		else
		{
			throw new \InvalidArgumentException();
		}
		
		$this->addChild( new RawHtml( $str ) );
		return $this;
		
	}
	
	
	
	public function text() {
		if ( 1 === func_num_args() )
		{
			$this->addChild( new Text( func_get_arg(0) ) );
			return $this;
		}
		else if ( 0 === func_num_args() ) {
			$txt = '';
			
			if ($this instanceof Text) {
				$txt .= $this->text;
			}
			foreach ( $this->descendants() as $node ) {
				if ( $node instanceof Text ) {
					$txt .= $node->text;
				}
			}
			
			return $txt;
		}
		else
		{
			throw new \InvalidArgumentException();
		}
	}
	
	
	
	public function addClass( $class ) {
		$o = $this->getClasses();
		$o[] = $class;
		$this->setAttribute('class', join(' ', $o));
		return $this;
	}
	
	public function hasClass( $class ) {
		return in_array($class, $this->getClasses());
	}
	
	public function removeClass( $class ) {
		$o = $this->getClasses();
		$i = array_search($class, $o);
		if ( $i !== false ) {
			unset($o[$i]);
		}
		$classes = trim(join(' ', $o));
		if ($classes === '') {
			$this->removeAttribute('class');
		} else {
			$this->setAttribute('class', $classes);
		}
		return $this;
	}
	
	public function toggleClass( $class, $state ) {
		$this->removeClass($class);
		if ( $state ) {
			$this->addClass($class);
		}
		return $this;
	}
	
	
	private function getClasses() {
		$o = $this->getAttribute('class');
		$o = is_string($o) ? explode(' ', $o) : [];
		$o = array_map(function($i){ return trim($i); }, $o);
		return $o;
	}
	
	
	
	public function getTagname() {
		return $this->tagName;
	}
	
	
	public function switchTagname( $value ) {
		$this->tagName = $value;
		return $this;
	}
	
	
	
	public function toString() {
		if ( count($this->getChildren()) === 0 && in_array($this->tagName, Html::$voidTags) ) {
			$attrs = $this->attributesToString();
			return sprintf('<%s%s>', $this->tagName, $attrs===''?'':' '.$attrs);
			
		} else {
			$content = $this->childNodesToString();
			$attrs = $this->attributesToString();
			return sprintf('<%s%s>%s</%s>', $this->tagName, $attrs===''?'':' '.$attrs, $content, $this->tagName);
		}
	}
	
	
	protected function attributesToString() {
		$parts = [];
		foreach ( $this->getAttributes() as $key => $value ) {
			
			$k = strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $key));
			if ( $value === true || $value === null ) {
				
				$parts[] = $k;
				
			} else {
				
				$v = strval($value);
				$v = htmlspecialchars($v, ENT_QUOTES | ENT_SUBSTITUTE | ENT_DISALLOWED | ENT_HTML5, 'UTF-8');
				$parts[] = sprintf('%s="%s"', $k, $v);
				
			}
		}
		return implode(' ', $parts);
	}
	
	
	public function __toString() {
		return $this->toString();
	}
	
}

