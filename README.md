PHP HTML Builder
================

A simple library to generate HTML fragments with a jquery-like interface. 

This library does not parse HTML, and it does not provide element lookup via selectors or otherwise. It is focused on building simple HTML fragments, for example embed codes, while taking care of proper escaping and other simple syntax rules. Its purpose is to replace manual concatenation of strings.



### Examples

```php
function generateBarcodeHtml( $barcode ) {
	
	$generator = new BarcodeGeneratorHTML();
	$htmlCode = $generator->getBarcode( $$barcode->toString(), $$barcode->getType(), 1, 45 );
	
	$el = Html::element('div');
	$el->addClass('barcode-container');
	
	Html::element('div')
		->addClass('barcode-bars')
		->html( $htmlCode )
		->appendTo($el);
	
	Html::element('div')
		->addClass('barcode-number')
		->text( $normalizedValue->toString() )
		->appendTo($el);
	
	return $el;
}

public function generateMenu(array $items) {
	
	$ul = Html::element('ul');
	
	foreach ( $this->items as $item ) {

		$li = Html::element('li')
			->appendTo( $ul )
			->toggleClass('active', $item['id'] === $this->activeId);
		
		Html::element('a')
			->attr('href', '/' . $item['url_key'] . '.html')
			->text( $item['title'] )
			->appendTo( $li );
		
	}
	
	return (string)$ul;
}
```


### Factory methods

##### Html::element($tagName)

Creates an element.

##### Html::comment($text)

Creates a comment node.

##### Html::text($text)

Creates a text node.


### Appending elements

##### $el->append($tagNameOrNode)

Add the new element as the last child.

##### $el->appendTo(Element $target)

Add the element as the targets last child.

##### $el->prepend($tagNameOrNode)

Add the new element as the first child.

##### $el->prependTo($Element $target)

Add the element as the targets first child.



### Element Attributes

##### $el->attr($name, $value)

Sets the attribute with the given name and value.

##### $el->attr($name)

Returns the attribute with the given name.

##### $el->attr()

Returns all attributes as an associative array.

##### $el->removeAttr($name)

Removes the attribute with the given name.


### Element html

##### $el->html($str)

Adds a raw html string as a child.

##### $el->html()

Returns the html representation of the content.

##### $el->__toString() / $el->toString()

Returns the node as html.



### Element text

##### $el->html($str)

Adds a text node.

##### $el->text()

Returns the text contents of this node including its descendants.


### Element classes

##### $el->addClass($class)

Add one or more classes. Multiple classes are separated by a space.

##### $el->hasClass($class)

Returns true if the element has the class.

##### $el->toggleClass($class, $state)

Remove or add the class.

##### get classes

Use `$el->attr("class")`



### Element tag name

##### $el->getTagname()

Returns the tag name.

##### $el->switchTagname($value)

Changes the tag name.



