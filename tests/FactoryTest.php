<?php

namespace TS\Text\HtmlBuilder;


use PHPUnit\Framework\TestCase;


/**
 *
 * @author Timo Stamm <ts@timostamm.de>
 * @license AGPLv3.0 https://www.gnu.org/licenses/agpl-3.0.txt
 */
class FactoryTest extends TestCase
{
	
	public function testComment()
	{
		$n = Html::comment('hallo welt');
		$this->assertInstanceOf(Comment::class, $n);
		$this->assertSame('<!--hallo welt-->', $n->toString());
	}
	
	public function testText()
	{
		$n = Html::text('hallo welt');
		$this->assertInstanceOf(Text::class, $n);
		$this->assertSame('hallo welt', $n->toString());
	}
	
	public function testElement()
	{
		$n = Html::element('p');
		$this->assertInstanceOf(Element::class, $n);
		$this->assertSame('<p></p>', $n->toString());
	}
	
	public function testElementWithAttributes()
	{
		$n = Html::element('a', ['href' => '/foo']);
		$this->assertInstanceOf(Element::class, $n);
		$this->assertSame('<a href="/foo"></a>', $n->toString());
	}
	
}