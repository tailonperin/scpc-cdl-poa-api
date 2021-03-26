<?php
namespace Tailonperin\ScpcCdlPoaApi\api;

abstract class Base
{
    protected $codigoCDL;
    protected $codigoAssociado;
    protected $codigoFilial;
    protected $senha;

    protected $requestData = [];
    protected $optionalFields = [];

    public function __construct($codigoCDL, $codigoAssociado, $codigoFilial, $senha)
    {
        $this->codigoCDL = $codigoCDL;
        $this->codigoAssociado = $codigoAssociado;
        $this->codigoFilial = $codigoFilial;
        $this->senha = $senha;
    }

    protected function environment()
    {
        $environment = env('CDL_POA_ENV', 'dev');

        return $environment;
    }

    protected function url()
    {
        return $this->hosts()[$this->environment()];
    }

    public function addProperty($key, $value)
    {
        $this->optionalFields[$key] = $value;

        return $this;
    }

    public function addProperties($values)
    {
        $this->optionalFields = array_merge($values, $this->optionalFields);

        return $this;
    }

    protected abstract function endpointName();

    protected abstract function hosts();

    protected abstract function requiredFields();

    protected function validations($fields)
    {
        foreach ($fields as $key => $field) {
            if(is_null($field)) {
                throw new \Exception("$key é uma informação obrigatória!");
            }
        }
    }

    protected function mountXML()
    {
        $xml = new \SimpleXMLElement('<soap:Envelope
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xmlns:xsd="http://www.w3.org/2001/XMLSchema"
	xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"/>');

        $data = [
            'soap:Body' => [
                $this->endpointName().' xmlns="http://tempuri.org/"' => $this->requestData
            ]
        ];

        dd($data);
        $this->arrayToXml($data, $xml);

        dd($xml->asXML());
    }

    public function enviar()
    {
        $url = $this->url();

        $requiredFieldsData = $this->requiredFields();

        $this->validations($requiredFieldsData);

        $this->requestData = array_merge($requiredFieldsData, $this->requestData);
        $this->requestData = array_merge($this->optionalFields, $this->requestData);

        $xml = $this->mountXML();

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml->asXML());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $return = curl_exec($ch);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($return, 0, $header_size);
        $body = substr($return, $header_size);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if($httpCode == 200) {

            $xml = simplexml_load_string($body);
            $json = json_encode($xml);
            $array = json_decode($json,TRUE);

            return $array;
        }

        return $return;
    }

    function arrayToXml($array, &$xml){
        foreach ($array as $key => $value) {
            if(is_array($value)){
                if(is_int($key)){
                    $key = "e";
                }
                $label = $xml->addChild($key);
                $this->arrayToXml($value, $label);
            }
            else {
                $xml->addChild($key, $value);
            }
        }
    }
}
