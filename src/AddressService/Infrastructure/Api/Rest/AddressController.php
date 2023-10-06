<?php

namespace App\AddressService\Infrastructure\Api\Rest;

use App\Contracts\AddressVerification\AddressVerificationContract;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: "/rest/v1/address")]
class AddressController extends AbstractController
{
    #[Route(path: "/verify")]
    public function verify(Request $request): Response
    {
        $addressVerificationContract = new AddressVerificationContract();
        $invalid = $addressVerificationContract->invalidAddress();
        $valid   = $addressVerificationContract->validAddress();

        $content = $request->getContent();
        if ($content === $invalid->getRequestAsJson()) {
            return new Response($invalid->getResponseAsJson());
        }

        if ($content === $valid->getRequestAsJson()) {
            return new Response($valid->getResponseAsJson());
        }

        return new Response('{"status": "UNKNOWN"}');
    }
}