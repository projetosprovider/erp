<?php

namespace geekcom\ValidatorDocs\Tests;

final class TestValidator extends ValidatorTestCase
{
    public function testCpf()
    {
        $correct = \Validator::make(
            ['certo' => '094.050.986-59'],
            ['certo' => 'cpf']
        );

        $incorrect = \Validator::make(
            ['errado' => '99800-1926'],
            ['errado' => 'cpf']
        );

        $this->assertTrue($correct->passes());

        $this->assertTrue($incorrect->fails());
    }

    public function testCpfFormato()
    {
        $correct = \Validator::make(
            ['certo' => '094.050.986-59'],
            ['certo' => 'formato-cpf']
        );

        $incorrect = \Validator::make(
            ['errado' => '094.050.986-591'],
            ['errado' => 'formato-cpf']
        );

        $this->assertTrue($correct->passes());

        $this->assertTrue($incorrect->fails());
    }


    public function testCnpj()
    {
        $correct = \Validator::make(
            ['certo' => '53.084.587/0001-20'],
            ['certo' => 'cnpj']
        );

        $incorrect = \Validator::make(
            ['errado' => '51.084.587/0001-20'],
            ['errado' => 'cnpj']
        );

        $this->assertTrue($correct->passes());

        $this->assertTrue($incorrect->fails());
    }


    public function testCnpjFormato()
    {
        $correct = \Validator::make(
            ['certo' => '53.084.587/0001-20'],
            ['certo' => 'formato-cnpj']
        );

        $incorrect = \Validator::make(
            ['errado' => '51.084.587/000120'],
            ['errado' => 'formato-cnpj']
        );

        $this->assertTrue($correct->passes());

        $this->assertTrue($incorrect->fails());
    }


    public function testCpfCnpj()
    {
        $correct = \Validator::make(
            ['certo' => '53.084.587/0001-20'],
            ['certo' => 'cpf-cnpj']
        );

        $incorrect = \Validator::make(
            ['errado' => '99800-1926'],
            ['errado' => 'cpf-cnpj']
        );

        $this->assertTrue($correct->passes());

        $this->assertTrue($incorrect->fails());
    }


    public function testCpfCnpjFormato()
    {
        $correct = \Validator::make(
            ['certo' => '094.050.986-59'],
            ['certo' => 'formato-cpf-cnpj']
        );

        $incorrect = \Validator::make(
            ['errado' => '51.084.587/000120'],
            ['errado' => 'formato-cpf-cnpj']
        );

        $this->assertTrue($correct->passes());

        $this->assertTrue($incorrect->fails());
    }


    public function testCnh()
    {
        $correct = \Validator::make(
            ['certo' => '96784547943'],
            ['certo' => 'cnh']
        );

        $incorrect = \Validator::make(
            ['errado' => '96784547999'],
            ['errado' => 'cnh']
        );

        $this->assertTrue($correct->passes());

        $this->assertTrue($incorrect->fails());
    }


    public function testTituloEleitor()
    {
        $correct = \Validator::make(
            ['certo' => '3021260'],
            ['certo' => 'titulo_eleitor']
        );

        $incorrect = \Validator::make(
            ['errado' => '1000101230190'],
            ['errado' => 'titulo_eleitor']
        );

        $this->assertTrue($correct->passes());

        $this->assertTrue($incorrect->fails());
    }
    
    public function testNis()
    {
        $correct = \Validator::make(
            ['certo' => '201.73374.34-9'],
            ['certo' => 'nis']
        );

        $incorrect = \Validator::make(
            ['errado' => '201.73374.34-0'],
            ['errado' => 'nis']
        );

        $this->assertTrue($correct->passes());

        $this->assertTrue($incorrect->fails());
    }

    public function testNisormato()
    {
        $correct = \Validator::make(
            ['certo' => '201.73374.34-9'],
            ['certo' => 'formato-nis']
        );

        $incorrect = \Validator::make(
            ['errado' => '201.733.7434-9'],
            ['errado' => 'formato-nis']
        );

        $this->assertTrue($correct->passes());

        $this->assertTrue($incorrect->fails());
    }

}
