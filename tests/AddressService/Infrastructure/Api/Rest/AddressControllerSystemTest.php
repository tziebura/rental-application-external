<?php

namespace App\Tests\AddressService\Infrastructure\Api\Rest;

use App\Contracts\AddressVerification\AddressVerificationContract;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\AbstractBrowser;
use Symfony\Component\HttpFoundation\Response;

class AddressControllerSystemTest extends WebTestCase
{
    private AbstractBrowser $browser;
    private AddressVerificationContract $addressVerificationContract;

    public function setUp(): void
    {
        $this->browser = $this->createClient([], [
            'HTTP_HOST' => 'localhost:8081',
        ]);
        $this->addressVerificationContract = new AddressVerificationContract();
    }

    /**
     * @test
     */
    public function shouldRecognizeValidAddress(): void
    {
        $scenario = $this->addressVerificationContract->validAddress();
        $this->browser->jsonRequest('POST', '/rest/v1/address/verify', json_decode($scenario->getRequestAsJson(), true));
        $this->assertStatusCode(Response::HTTP_OK, $this->browser);
        $this->assertEquals($scenario->getResponseAsJson(), $this->browser->getResponse()->getContent());
    }

    /**
     * @test
     */
    public function shouldRecognizeInvalidAddress(): void
    {
        $scenario = $this->addressVerificationContract->invalidAddress();
        $this->browser->jsonRequest('POST', '/rest/v1/address/verify', json_decode($scenario->getRequestAsJson(), true));
        $this->assertStatusCode(Response::HTTP_OK, $this->browser);
        $this->assertEquals($scenario->getResponseAsJson(), $this->browser->getResponse()->getContent());
    }
}