<?php

namespace Weew\App\RequestHandler\Exceptions;

use Exception;
use Weew\Http\IHttpResponse;

class HttpResponseException extends Exception {
    /**
     * @var IHttpResponse
     */
    private $response;

    /**
     * @param IHttpResponse $response
     */
    public function __construct(IHttpResponse $response) {
        parent::__construct();
        $this->response = $response;
    }

    /**
     * @return IHttpResponse
     */
    public function getHttpResponse() {
        return $this->response;
    }
}

