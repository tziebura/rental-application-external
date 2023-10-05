<?php

namespace App\PaymentService\Infrastructure\Api\Rest;

use App\Contracts\Payment\PaymentContract;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: "/rest/v1/payment")]
class PaymentController extends AbstractController
{
    #[Route(path: "/pay")]
    public function pay(Request $request): Response
    {
        $paymentContract = new PaymentContract();
        $success = $paymentContract->successfulPayment();
        $notEnoughMoney = $paymentContract->notEnoughMoney();

        $content = $request->getContent();
        if ($content === $success->getRequestAsJson()) {
            return new Response($success->getResponseAsJson());
        }

        if ($content === $notEnoughMoney->getRequestAsJson()) {
            return new Response($notEnoughMoney->getResponseAsJson());
        }

        return new Response('{"status": "UNKNOWN"');
    }
}