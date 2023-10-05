<?php

namespace App\Tests\PaymentService\Infrastructure\Api\Rest;

use App\Contracts\Payment\PaymentContract;
use App\Contracts\Payment\PaymentScenario;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\AbstractBrowser;
use Symfony\Component\HttpFoundation\Response;

class PaymentControllerSystemTest extends WebTestCase
{
    private AbstractBrowser $browser;
    private PaymentContract $paymentContract;

    public function setUp(): void
    {
        $this->browser = $this->createClient([], [
            'HTTP_HOST' => 'localhost:8081',
        ]);
        $this->paymentContract = new PaymentContract();
    }

    /**
     * @test
     */
    public function shouldSuccessfullyCompletePayment(): void
    {
        $scenario = $this->paymentContract->successfulPayment();
        $actual = $this->pay($scenario);

        $this->assertEquals($scenario->getResponseAsJson(), $actual);
    }

    /**
     * @test
     */
    public function shouldRecognizeNotEnoughResources(): void
    {
        $scenario = $this->paymentContract->notEnoughMoney();
        $actual = $this->pay($scenario);

        $this->assertEquals($scenario->getResponseAsJson(), $actual);
    }

    private function pay(PaymentScenario $scenario)
    {
        $this->browser->jsonRequest('POST', '/rest/v1/payment/pay', json_decode($scenario->getRequestAsJson(), true));
        $this->assertStatusCode(Response::HTTP_OK, $this->browser);

        return $this->browser->getResponse()->getContent();
    }
}