<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Webpage;

class WebpageApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_webpage()
    {
        $webpage = factory(Webpage::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/webpages', $webpage
        );

        $this->assertApiResponse($webpage);
    }

    /**
     * @test
     */
    public function test_read_webpage()
    {
        $webpage = factory(Webpage::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/webpages/'.$webpage->id
        );

        $this->assertApiResponse($webpage->toArray());
    }

    /**
     * @test
     */
    public function test_update_webpage()
    {
        $webpage = factory(Webpage::class)->create();
        $editedWebpage = factory(Webpage::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/webpages/'.$webpage->id,
            $editedWebpage
        );

        $this->assertApiResponse($editedWebpage);
    }

    /**
     * @test
     */
    public function test_delete_webpage()
    {
        $webpage = factory(Webpage::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/webpages/'.$webpage->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/webpages/'.$webpage->id
        );

        $this->response->assertStatus(404);
    }
}
