<?php

define('ACRE','AC');
define('ALAGOAS','AL');
define('AMAPA','AP');
define('AMAZONAS','AM');
define('BAHIA','BA');
define('CEARA','CE');
define('DISTRITO_FEDERAL','DF');
define('ESPIRITO_SANTO','ES');
define('GOIAS','GO');
define('MARANHAO','MA');
define('MATO_GROSSO','MT');
define('MATO_GROSSO_DO_SUL','MS');
define('MINAS_GERAIS','MG');
define('PARA','PA');
define('PARAIBA','PB');
define('PARANA','PR');
define('PERNANBUCO','PE');
define('PIAUI','PI');
define('RIO_DE_JANEIRO','RJ');
define('RIO_GRANDE_DO_NORTE','RN');
define('RIO_GRANDE_DO_SUL','RS');
define('RONDONIA','RO');
define('RORAIMA','RR');
define('SANTA_CATARINA','SC');
define('SAO_PAULO','SP');
define('SERGIPE','SE');
define('TOCANTIS','TO');

if (!function_exists('cep'))
{

    /**
     * @param $cep
     * @return $this
     */
    function cep($cep)
    {

        $canducciCep = new Canducci\Cep\Cep(new Canducci\Cep\CepClient());

        return $canducciCep->find($cep);

    }
}

if (!function_exists('endereco'))
{

    /**
     * @param $uf
     * @param $cidade
     * @param $logradouro
     * @return mixed
     */
    function endereco($uf, $cidade, $logradouro)
    {

        $enderecoCep = new Canducci\Cep\Endereco(new Canducci\Cep\CepClient());

        return $enderecoCep->find($uf, $cidade, $logradouro);

    }

}
