<?php namespace Tests\Repositories;

use App\Models\Webpage;
use App\Repositories\WebpageRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class WebpageRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var WebpageRepository
     */
    protected $webpageRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->webpageRepo = \App::make(WebpageRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_webpage()
    {
        $webpage = factory(Webpage::class)->make()->toArray();

        $createdWebpage = $this->webpageRepo->create($webpage);

        $createdWebpage = $createdWebpage->toArray();
        $this->assertArrayHasKey('id', $createdWebpage);
        $this->assertNotNull($createdWebpage['id'], 'Created Webpage must have id specified');
        $this->assertNotNull(Webpage::find($createdWebpage['id']), 'Webpage with given id must be in DB');
        $this->assertModelData($webpage, $createdWebpage);
    }

    /**
     * @test read
     */
    public function test_read_webpage()
    {
        $webpage = factory(Webpage::class)->create();

        $dbWebpage = $this->webpageRepo->find($webpage->id);

        $dbWebpage = $dbWebpage->toArray();
        $this->assertModelData($webpage->toArray(), $dbWebpage);
    }

    /**
     * @test update
     */
    public function test_update_webpage()
    {
        $webpage = factory(Webpage::class)->create();
        $fakeWebpage = factory(Webpage::class)->make()->toArray();

        $updatedWebpage = $this->webpageRepo->update($fakeWebpage, $webpage->id);

        $this->assertModelData($fakeWebpage, $updatedWebpage->toArray());
        $dbWebpage = $this->webpageRepo->find($webpage->id);
        $this->assertModelData($fakeWebpage, $dbWebpage->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_webpage()
    {
        $webpage = factory(Webpage::class)->create();

        $resp = $this->webpageRepo->delete($webpage->id);

        $this->assertTrue($resp);
        $this->assertNull(Webpage::find($webpage->id), 'Webpage should not exist in DB');
    }
}
