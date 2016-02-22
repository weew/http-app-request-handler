<?php

namespace Weew\HttpApp\RequestHandler;

use Weew\Http\IHttpRequest;
use Weew\Http\IHttpResponse;

interface IRequestHandler {
    /**
     * @param IHttpRequest $request
     *
     * @return IHttpResponse
     */
    function handle(IHttpRequest $request);
}
