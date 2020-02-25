<?php

class CrudServiceClientAdapterUnitTest extends \PHPUnit\Framework\TestCase
{

    /**
     * Testing lazy getter
     */
    public function testLazyGetServiceClient(): void
    {
        // setupp
        $adapter = new \Mezon\Gui\ListBuilder\CrudServiceClientAdapter('https://service.example');

        // test bodyy
        $client = $adapter->getClient();

        // assertionss
        $this->assertInstanceOf(\Mezon\CrudService\CrudServiceClient::class, $client);
    }

    /**
     * Testing setClient method
     */
    public function testSetClient(): void
    {
        // setup
        $adapter = new \Mezon\Gui\ListBuilder\CrudServiceClientAdapter();

        // test body
        $adapter->setClient(new \Mezon\CrudService\CrudServiceClient('http://service'));

        // assertions
        $this->assertEquals('http://service', $adapter->getClient()
            ->getUrl());
    }
}
