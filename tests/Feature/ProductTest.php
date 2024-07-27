<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function test_list_product_page(): void
    {
        try {
            $response = $this->get('/product');
            $response->assertStatus(200);
        } catch (\Throwable $e) {
            $this->fail("Exception: " . $e->getMessage() . "\n" . $e->getTraceAsString());
        }
    }
}
