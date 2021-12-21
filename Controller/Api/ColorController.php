
<?php
class ColorController extends BaseController
{

    public function listAction()
    {
        $strErrorDesc = '';
 
        if (strtoupper($_SERVER["REQUEST_METHOD"]) !== 'GET') {
            $this->sendMethodNotSupported('GET');
            return;
        }
        $arrQueryStringParams = $this->getQueryStringParams();

        try {
            $colorModel = new ColorModel();
            $intLimit = 100;
            if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
                $intLimit = $arrQueryStringParams['limit'];
            }
            $arrColor = $colorModel->getColors($intLimit);
            $responseData = json_encode($arrColor);
            $this->sendOutput($responseData,array('Content-Type: application/json', HTTP_STATUS_200));
        } catch (Error $e) {
            $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
            $strErrorHeader = HTTP_ERROR_500;
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), array('Content-Type: application/json', $strErrorHeader));
        }
    }

    public function createAction()
    {
        $strErrorDesc = '';
 
        if (strtoupper($_SERVER["REQUEST_METHOD"]) !== 'POST') {
            $this->sendMethodNotSupported('POST');
            return;
        }
        $body = $this->getRequestBody();
        $value = $body['value'];

        $patternValue = "/#(?:[0-9a-fA-F]{3}){1,2}/i";

        if(!preg_match($patternValue, $value)) {
            $strErrorDesc = 'Color value is not valid';
            $strErrorHeader = HTTP_ERROR_403;
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), array('Content-Type: application/json', $strErrorHeader));
            return;
        }

        try {
            $colorModel = new ColorModel();
            $colorModel->createColor($value);
            $this->sendOutput(json_encode($value), array('Content-Type: application/json', HTTP_STATUS_200));
        } catch (Error $e) {
            $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
            $strErrorHeader = HTTP_ERROR_500;
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), array('Content-Type: application/json', $strErrorHeader));
        }
    }

    public function deleteAction()
    {
        $strErrorDesc = '';
 
        if (strtoupper($_SERVER["REQUEST_METHOD"]) !== 'DELETE') {
            $this->sendMethodNotSupported('DELETE');
            return;
        }
        $body = $this->getRequestBody();

        try {
            $colorModel = new ColorModel();
            $response = $colorModel->deleteColor($body['value']);
            $this->sendOutput(json_encode($response),array('Content-Type: application/json', HTTP_STATUS_200));
        } catch (Error $e) {
            $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
            $strErrorHeader = HTTP_ERROR_500;
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), array('Content-Type: application/json', $strErrorHeader));
        }
    }
}