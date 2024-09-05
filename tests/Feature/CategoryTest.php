<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    public function it_can_create_a_category()
    {
        $data = [
            'name' => 'Electronics',
        ];


        $this->assertDatabaseHas('categories', $data);
    }


    public function it_can_fetch_all_categories()
    {
        $response = $this->getJson('/api/allCats');

        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');  // تحقق من عدد الفئات المسترجعة
    }


}
