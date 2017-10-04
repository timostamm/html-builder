<?php

namespace TS\Text\HtmlBuilder;


use PHPUnit\Framework\TestCase;


/**
 * @author Timo Stamm <ts@timostamm.de>
 * @license AGPLv3.0 https://www.gnu.org/licenses/agpl-3.0.txt
 */
class ElementTest extends TestCase {
	
	

	public function testText(){
		$el = new Element('p');
		$el->text('abc');
		
		$this->assertSame(
			'abc',
			$el->text()
		);
		
		$el->append('br');
		
		$el->text('hallo');
		
		$this->assertSame(
			"abchallo",
			$el->text()
		);
		
	}
	
	
	public function testConstructorWithAttributes(){
		
		$el = new Element('p', ['class' => 'foo']);
		
		$this->assertSame(
			'<p class="foo"></p>',
			$el->toString()
		);
		
	}
	


	public function testPrepend(){
	
		$el = (new Element('p'))
			->append((new Element('span'))->text('a'))
			->append((new Element('span'))->text('b'))
			->prepend((new Element('span'))->text('c'));
		
		$this->assertSame('cab', $el->text());
	
	}
	
	
	public function testAppend(){
		
		$el = (new Element('p'))
			->append((new Element('b'))->text('i am bold'))
			->append((new Element('span'))->text('hello'))
			->append( new Text('world') )
			;
		
		$this->assertSame(
			'<p><b>i am bold</b><span>hello</span>world</p>',
			$el->toString()
			);
		
	}
	

	public function testAppendTo(){
	
		$ul = (new Element('ul'));
		
		(new Element('li'))
			->text('a')
			->appendTo($ul);
		
		(new Element('li'))
			->text('b')
			->appendTo($ul);
		
		$this->assertSame(
			'<ul><li>a</li><li>b</li></ul>',
			$ul->toString()
		);
	
	}
	
	
	public function testClasses(){
	
		$el = new Element('p', ['class' => 'foo bar']);
		
		$this->assertTrue( $el->hasClass('foo') );
		$this->assertTrue( $el->hasClass('bar') );
		
		$el->removeClass('foo');
		$this->assertFalse( $el->hasClass('foo') );
		$this->assertTrue( $el->hasClass('bar') );
		
		$el->toggleClass('baz', true);
		$el->toggleClass('bar', false);
		$this->assertTrue( $el->hasClass('baz') );
		$this->assertFalse( $el->hasClass('bar') );
		$this->assertFalse( $el->hasClass('foo') );
		
	}
	
	
}