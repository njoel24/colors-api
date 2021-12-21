
<?php
class BaseController
{   
    public function __call($name, $arguments)
    {
        $this->sendOutput('', array(HTTP_ERROR_404));
    }

    protected function sendMethodNotSupported($method)
    {
        $strErrorDesc = 'Method not supported';
        $strErrorHeader = HTTP_ERROR_422;
        $this->sendOutput(json_encode(array('error' => $strErrorDesc)), array('Content-Type: application/json', $strErrorHeader));
    }
 
    protected function getUriSegments()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode( '/', $uri );
 
        return $uri;
    }
 
    protected function getQueryStringParams()
    {
        parse_str($_SERVER['QUERY_STRING'], $query);
        return $query;
    }

    protected function getRequestBody() {
        return json_decode(file_get_contents('php://input'), true);
    }
 
    protected function sendOutput($data, $httpHeaders=array())
    {
        header_remove('Set-Cookie');
        header("Access-Control-Allow-Origin: http://localhost:3000");
        header("Access-Control-Allow-Methods: GET, POST, DELETE");
 
        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }
 
        echo $data;
        exit;
    }
}