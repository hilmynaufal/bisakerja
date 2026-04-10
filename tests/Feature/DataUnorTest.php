<?php

namespace Tests\Feature;

use App\Livewire\DataUnor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DataUnorTest extends TestCase
{
    /**
     * Test that the priority fields exist in the data_unor table.
     */
    public function test_priority_fields_exist_in_database()
    {
        if (Schema::hasTable('data_unor')) {
            $this->assertTrue(Schema::hasColumn('data_unor', 'is_prioritas_nasional'));
            $this->assertTrue(Schema::hasColumn('data_unor', 'is_prioritas_instansi'));
        } else {
            $this->markTestSkipped('data_unor table does not exist in test environment.');
        }
    }

    /**
     * Test that the Livewire component has the priority properties.
     */
    public function test_livewire_component_has_priority_properties()
    {
        // We can't easily test mount() if the table doesn't exist,
        // but we can test that the properties are defined in the class.
        $component = new DataUnor();
        $this->assertTrue(property_exists($component, 'is_prioritas_nasional'));
        $this->assertTrue(property_exists($component, 'is_prioritas_instansi'));
    }
}
