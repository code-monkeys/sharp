<?php

namespace Code16\Sharp\Tests\Unit\Form\Eloquent\Relationships;

use Code16\Sharp\Form\Eloquent\Relationships\BelongsToRelationUpdater;
use Code16\Sharp\Tests\Fixtures\Person;
use Code16\Sharp\Tests\Unit\Form\Eloquent\SharpFormEloquentBaseTest;

class BelongsToRelationUpdaterTest extends SharpFormEloquentBaseTest
{

    /** @test */
    function we_can_update_a_belongsTo_relation()
    {
        $mother = Person::create(["name" => "Jane Wayne"]);
        $person = Person::create(["name" => "John Wayne"]);

        $updater = new BelongsToRelationUpdater();

        $updater->update($person, "mother", $mother->id);

        $this->assertDatabaseHas("people", [
            "id" => $person->id,
            "mother_id" => $mother->id
        ]);
    }

    /** @test */
    function we_can_create_a_belongsTo_relation()
    {
        $person = Person::create(["name" => "John Wayne"]);

        $updater = new BelongsToRelationUpdater();

        $updater->update($person, "mother:name", "Jane Wayne");

        $this->assertCount(2, Person::all());

        $mother = Person::where("name", "Jane Wayne")->first();

        $this->assertDatabaseHas("people", [
            "id" => $person->id,
            "mother_id" => $mother->id
        ]);
    }
}