<?php


namespace Tailonperin\ScpcCdlPoaApi\api;


abstract class DefineRiscoSCPC extends Base
{
    /*
    <CNPJ>12345678901234</CNPJ>
    <quadroSocial>true</quadroSocial>
    <participacoes>true</participacoes>
    <faturamentoPresumido>true</faturamentoPresumido>
     */
    protected $cnpj;
    protected $quadroSocial = false;
    protected $participacoes = false;
    protected $faturamentoPresumido = false;

    protected function endpointName()
    {
        return 'ConsultaCadastro';
    }

    protected function requiredFields()
    {
        return [
            'codigoCDL' => $this->codigoCDL,
            'codigoAssociado' => $this->codigoAssociado,
            'codigoFilial' => $this->codigoFilial,
            'senha' => $this->senha,
            'CNPJ' => $this->cnpj,
            'quadroSocial' => $this->quadroSocial,
            'participacoes' => $this->participacoes,
            'faturamentoPresumido' => $this->faturamentoPresumido,
        ];
    }

    /**
     * @return mixed
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * @param mixed $cnpj
     * @return DefineRiscoSCPC
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuadroSocial()
    {
        return $this->quadroSocial;
    }

    /**
     * @param mixed $quadroSocial
     * @return DefineRiscoSCPC
     */
    public function setQuadroSocial($quadroSocial)
    {
        $this->quadroSocial = $quadroSocial;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParticipacoes()
    {
        return $this->participacoes;
    }

    /**
     * @param mixed $participacoes
     * @return DefineRiscoSCPC
     */
    public function setParticipacoes($participacoes)
    {
        $this->participacoes = $participacoes;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFaturamentoPresumido()
    {
        return $this->faturamentoPresumido;
    }

    /**
     * @param mixed $faturamentoPresumido
     * @return DefineRiscoSCPC
     */
    public function setFaturamentoPresumido($faturamentoPresumido)
    {
        $this->faturamentoPresumido = $faturamentoPresumido;
        return $this;
    }
}
