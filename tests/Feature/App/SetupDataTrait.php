<?php
namespace Tests\Feature\App;

use Illuminate\Foundation\Testing\DatabaseMigrations;

trait SetupDataTrait
{

    use DatabaseMigrations;

    public function setUp() :void
    {
        parent::setUp();
        $this->defaultHeaders = ['Accept' => 'application/json'];
        $this->artisan('db:seed');
        $this->additionalData();
    }

    public function additionalData()
    {
        //
    }
}
