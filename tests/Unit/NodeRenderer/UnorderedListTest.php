<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Unit\NodeRenderer;

use Contentful\StructuredText\Node\UnorderedList as NodeClass;
use Contentful\StructuredText\NodeRenderer\UnorderedList;
use Contentful\Tests\StructuredText\Implementation\Node;
use Contentful\Tests\StructuredText\Implementation\Renderer;
use Contentful\Tests\StructuredText\TestCase;

class UnorderedListTest extends TestCase
{
    public function testRendering()
    {
        $renderer = new Renderer();
        $nodeRenderer = new UnorderedList();
        $node = new NodeClass([new Node('Some text')]);

        $this->assertTrue($nodeRenderer->supports($node));
        $this->assertFalse($nodeRenderer->supports(new Node('Some value')));

        $this->assertSame('<ul>Some text</ul>', $nodeRenderer->render($renderer, $node));
    }

    /**
     * @expectedException        \LogicException
     * @expectedExceptionMessage Trying to use node renderer "Contentful\StructuredText\NodeRenderer\UnorderedList" to render unsupported node of class "Contentful\Tests\StructuredText\Implementation\Node".
     */
    public function testInvalidNodeRendered()
    {
        $renderer = new Renderer();
        $nodeRenderer = new UnorderedList();

        $nodeRenderer->render($renderer, new Node('Some value'));
    }
}