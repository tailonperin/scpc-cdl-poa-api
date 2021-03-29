<?php


namespace Tailonperin\ScpcCdlPoaApi\api;


abstract class FamiliaSCPC extends Base
{
    protected $cpf;
    protected $tipoCredito;
    protected $ddd;
    protected $telefone;
    protected $cepOrigem;
    protected $tipoConsulta;
    protected $parcelaSegura;
    protected $moduloDecisao;
    protected $codigoScore;

    /*
     * <CodigoCDL>RS034</CodigoCDL>
			<CodigoAssociado>2410</CodigoAssociado>
			<CodigoFilial>1</CodigoFilial>
			<CPF>22222222222</CPF>
			<TipoCredito>CC</TipoCredito>
			<DDD>0</DDD>
			<Telefone>0</Telefone>
			<CEPOrigem>0</CEPOrigem>
			<TipoConsulta>SPCAE</TipoConsulta>
			<ParcelaSegura>N</ParcelaSegura>
			<ModuloDecisao>N</ModuloDecisao>
			<CodigosScore>54</CodigosScore>
			<Senha>TESTE</Senha>



    <!—- Se foi informado Cheque Completo -->
<Quantidade>0</Quantidade>
<ValorCheque>0.00</ValorCheque>
<!-- Opcional -->
<OrigemInformacoes>C(CMC7) </OrigemInformacoes>
<!—- Se foi informado Origem Informações -->
<Campo1>0</Campo1>
<Campo2>0</Campo2>
<Campo3>0</Campo3>
<!-- Senão -->
<Banco>0</Banco>
<Agencia>0</Agencia>
<ContaCorrente>0</ContaCorrente>
<DigitoContaCorrente>0</DigitoContaCorrente>
<Cheque>0</Cheque>
<DigitoCheque>0</DigitoCheque>
<DataCheque>0</DataCheque>
<!—- Fim das informações Cheque Completo -->
     */

    protected function endpointName()
    {
        return 'ConsultaSCPC';
    }

    protected function requiredFields()
    {
        return [
            'CodigoCDL' => $this->codigoCDL,
            'CodigoAssociado' => $this->codigoAssociado,
            'CodigoFilial' => $this->codigoFilial,
            'CPF' => $this->cpf,
            'TipoCredito' => $this->tipoCredito,
            'DDD' => $this->ddd,
            'Telefone' => $this->telefone,
            'CEPOrigem' => $this->cepOrigem,
            'TipoConsulta' => $this->tipoConsulta,
            'ParcelaSegura' => $this->parcelaSegura,
            'ModuloDecisao' => $this->moduloDecisao,
            'CodigosScore' => $this->codigoScore,
            'Senha' => $this->senha,
        ];
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     * @return FamiliaSCPC
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTipoCredito()
    {
        return $this->tipoCredito;
    }

    /**
     * @param mixed $tipoCredito
     * @return FamiliaSCPC
     */
    public function setTipoCredito($tipoCredito)
    {
        $this->tipoCredito = $tipoCredito;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDdd()
    {
        return $this->ddd;
    }

    /**
     * @param mixed $ddd
     * @return FamiliaSCPC
     */
    public function setDdd($ddd)
    {
        $this->ddd = $ddd;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param mixed $telefone
     * @return FamiliaSCPC
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCepOrigem()
    {
        return $this->cepOrigem;
    }

    /**
     * @param mixed $cepOrigem
     * @return FamiliaSCPC
     */
    public function setCepOrigem($cepOrigem)
    {
        $this->cepOrigem = $cepOrigem;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTipoConsulta()
    {
        return $this->tipoConsulta;
    }

    /**
     * @param mixed $tipoConsulta
     * @return FamiliaSCPC
     */
    public function setTipoConsulta($tipoConsulta)
    {
        $this->tipoConsulta = $tipoConsulta;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParcelaSegura()
    {
        return $this->parcelaSegura;
    }

    /**
     * @param mixed $parcelaSegura
     * @return FamiliaSCPC
     */
    public function setParcelaSegura($parcelaSegura)
    {
        $this->parcelaSegura = $parcelaSegura;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModuloDecisao()
    {
        return $this->moduloDecisao;
    }

    /**
     * @param mixed $moduloDecisao
     * @return FamiliaSCPC
     */
    public function setModuloDecisao($moduloDecisao)
    {
        $this->moduloDecisao = $moduloDecisao;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodigoScore()
    {
        return $this->codigoScore;
    }

    /**
     * @param mixed $codigoScore
     * @return FamiliaSCPC
     */
    public function setCodigoScore($codigoScore)
    {
        $this->codigoScore = $codigoScore;
        return $this;
    }
}
