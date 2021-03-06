<?php

namespace Code16\Sharp\Tests\Unit\Show\Fields;

use Code16\Sharp\Show\Fields\SharpShowTextField;
use Code16\Sharp\Tests\SharpTestCase;

class SharpShowTextFieldTest extends SharpTestCase
{
    /** @test */
    function we_can_define_label()
    {
        $field = SharpShowTextField::make("textfield")
            ->setLabel("Label");

        $this->assertEquals([
            "key" => "textfield",
            "type" => "text",
            "label" => "Label"
        ], $field->toArray());
    }

    /** @test */
    function we_can_define_collapseWordCount()
    {
        $field = SharpShowTextField::make("textfield")
            ->collapseToWordCount(15);

        $this->assertEquals([
            "key" => "textfield",
            "type" => "text",
            "collapseToWordCount" => 15
        ], $field->toArray());
    }

    /** @test */
    function we_can_reset_collapseWordCount()
    {
        $field = SharpShowTextField::make("textfield")
            ->collapseToWordCount(15);

        $field->doNotCollapse();

        $this->assertEquals([
            "key" => "textfield",
            "type" => "text",
        ], $field->toArray());
    }
}