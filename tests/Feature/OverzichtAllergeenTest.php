<?php

namespace Tests\Feature;

use Tests\TestCase;

class OverzichtAllergeenTest extends TestCase
{

    public function test_index_returns_view()
    {
        $response = $this->get(route('allergeen-overzicht.index'));
        $response->assertStatus(200);
        $response->assertViewIs('allergeen-overzicht');
    }

    public function test_filter_only_returns_products_with_lactose()
    {
        $response = $this->get(route('allergeen-overzicht.filterByAllergie', ['filter_allergie' => 'lactose']));
        $response->assertStatus(200);
        $response->assertViewIs('allergeen-overzicht');
        $response->assertSee('Dit product bevat lactose');
        $response->assertDontSee('Dit product bevat gelatine');
        $response->assertDontSee('Dit product bevat soja');
    }
}
