<?php

namespace Tests\Feature;

use App\Pet;
use App\Photo;
use App\Place;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class PhotosTest extends TestCase
{
    public function test_api_photos_index_route()
    {
        $user = factory(User::class)->make();

        $this->actingAs($user, 'api')
            ->get('/api/photos')
            ->assertOk();
    }

    public function test_api_photos_store_route()
    {
        $user = factory(User::class)->make();

        $this->actingAs($user, 'api')
            ->post('/api/photos', [
            ])
            ->assertJsonStructure([
                'url',
                'created_at',
                'updated_at',
            ])
            ->assertStatus(201);
    }

    public function test_api_photos_show_route()
    {
        $user = factory(User::class)->make();

        $photo = factory(Photo::class)->create();

        $this->actingAs($user, 'api')
            ->get('/api/photos/' . $photo->id)
            ->assertJsonStructure([
                'url',
                'created_at',
                'updated_at',
            ])
            ->assertStatus(200);
    }

    public function test_api_pet_photos_index_route()
    {
        $user = factory(User::class)->make();

        $pet = factory(Pet::class)->create();

        $this->actingAs($user, 'api')
            ->get('/api/pets/' . $pet->id . '/photos')
            ->assertStatus(200);
    }

    public function test_api_place_photos_index_route()
    {
        $user = factory(User::class)->make();

        $place = factory(Place::class)->create();

        $this->actingAs($user, 'api')
            ->get('/api/places/' . $place->id . '/photos')
            ->assertStatus(200);
    }

    public function test_api_photos_delete_route()
    {
        $user = factory(User::class)->make();

        $photo = factory(Photo::class)->create();

        $this->actingAs($user, 'api')
            ->delete('/api/photos/' . $photo->id)
            ->assertStatus(200);
    }
}
