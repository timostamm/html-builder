PHP HTML Builder
================

A simple library to generate HTML fragments with a jquery-like interface. 

This library does not parse HTML, and it does not provide element lookup via selectors or otherwise. It is focused on quick but extensible creation of simple HTML fragments, for example embed codes. 


### Factory methods

##### Html::element($tagName)

Creates an element.

##### Html::comment($text)

Creates a comment node.

##### Html::comment($text)

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





## Example

```php
```
