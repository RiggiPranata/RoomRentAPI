<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestTrait;
use Config\Services;
use Exception;

class FilterJwt implements FilterInterface
{
    use ResponseTrait;
    use RequestTrait;
    public function before(RequestInterface $request, $arguments = null)
    {

        $header = $request->getServer('HTTP_AUTHORIZATION');
        try {
            helper('jwt');
            $encodedToken = getJWT($header);
            validationJWT($encodedToken);
            return $request;
        } catch (Exception $e) {
            return Services::response()->setJSON(
                [
                    'error' => $e->getMessage()
                ]
            )->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
