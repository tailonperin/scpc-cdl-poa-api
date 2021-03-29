<?php
namespace Tailonperin\ScpcCdlPoaApi\api;

abstract class Base
{
    protected $url;

    protected $codigoCDL;
    protected $codigoAssociado;
    protected $codigoFilial;
    protected $senha;

    protected $requestData = [];
    protected $optionalFields = [];
    
    protected $responseBody;

    public function __construct($url, $codigoCDL, $codigoAssociado, $codigoFilial, $senha)
    {
        $this->url = $url;

        $this->codigoCDL = $codigoCDL;
        $this->codigoAssociado = $codigoAssociado;
        $this->codigoFilial = $codigoFilial;
        $this->senha = $senha;
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

    protected abstract function requiredFields();
    protected abstract function getKey();

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

        $xmlToAdd = $xml->addChild('soap:Body', '');
        $type = $this->endpointName();
        $xmlToAdd = $xmlToAdd->addChild($type, '', 'http://tempuri.org/');

        $data = $this->requestData;

        $this->arrayToXml($data, $xmlToAdd);

        return $xml;
    }

    public function enviar()
    {
        $url = $this->url;

        if(is_null($this->url)) {
            throw new \Exception("URL not defined.");
        }

        $requiredFieldsData = $this->requiredFields();

        $this->validations($requiredFieldsData);

        $this->requestData = array_merge($requiredFieldsData, $this->requestData);
        $this->requestData = array_merge($this->requestData, $this->optionalFields);

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
        $this->responseBody = $body;
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if($httpCode == 200) {
            $arrayXml = $this->xmlstr_to_array($body);

            return [
                'http_code' => $httpCode,
                'response' => $arrayXml
            ];
        }

        return [
            'http_code' => $httpCode,
            'response' => $body
        ];
    }

    function xmlstr_to_array($xmlstr) {
        $doc = new \DOMDocument();
        $doc->loadXML($xmlstr);
        $root = $doc->documentElement;
        $output = $this->domnode_to_array($root);
        $output['@root'] = $root->tagName;
        return $output;
    }

    function domnode_to_array($node) {
        $output = array();
        switch ($node->nodeType) {
            case XML_CDATA_SECTION_NODE:
            case XML_TEXT_NODE:
                $output = trim($node->textContent);
                break;
            case XML_ELEMENT_NODE:
                for ($i=0, $m=$node->childNodes->length; $i<$m; $i++) {
                    $child = $node->childNodes->item($i);
                    $v = $this->domnode_to_array($child);
                    if(isset($child->tagName)) {
                        $t = $child->tagName;
                        if(!isset($output[$t])) {
                            $output[$t] = array();
                        }
                        $output[$t][] = $v;
                    }
                    elseif($v || $v === '0') {
                        $output = (string) $v;
                    }
                }
                if($node->attributes->length && !is_array($output)) { //Has attributes but isn't an array
                    $output = array('@content'=>$output); //Change output into an array.
                }
                if(is_array($output)) {
                    if($node->attributes->length) {
                        $a = array();
                        foreach($node->attributes as $attrName => $attrNode) {
                            $a[$attrName] = (string) $attrNode->value;
                        }
                        $output['@attributes'] = $a;
                    }
                    foreach ($output as $t => $v) {
                        if(is_array($v) && count($v)==1 && $t!='@attributes') {
                            $output[$t] = $v[0];
                        }
                    }
                }
                break;
        }
        return $output;
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
