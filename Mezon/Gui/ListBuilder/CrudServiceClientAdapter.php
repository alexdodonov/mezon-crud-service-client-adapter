<?php
namespace Mezon\Gui\ListBuilder;

use Mezon\CrudService\CrudServiceClientInterface;
use Mezon\Gui\ListBuilder\Adapters\Common;
use Mezon\CrudService\CrudServiceClient;

/**
 * Class CrudServiceClientAdapter
 *
 * @package ListBuilder
 * @subpackage CrudServiceClientAdapter
 * @author Dodonov A.A.
 * @version v.1.0 (2019/09/11)
 * @copyright Copyright (c) 2019, aeon.org
 */

/**
 * Logic adapter for list builder
 */
class CrudServiceClientAdapter extends Common
{

    /**
     * Crud Service Client object
     *
     * @var CrudServiceClientInterface
     */
    protected $crudServiceClient = null;

    /**
     * Service name
     *
     * @var string
     */
    protected $service = '';

    /**
     * Login
     *
     * @var string
     */
    protected $login = '';

    /**
     * Password
     *
     * @var string
     */
    protected $password;

    /**
     * Constructor
     *
     * @param string $service
     *            Service name
     * @param string $login
     *            Login
     * @param string $password
     *            Password
     */
    public function __construct(string $service = '', string $login = '', string $password = '')
    {
        $this->service = $service;

        $this->login = $login;

        $this->password = $password;
    }

    /**
     * Method returns client to service
     *
     * @return CrudServiceClientInterface Client
     */
    public function getClient(): CrudServiceClientInterface
    {
        if ($this->crudServiceClient === null) {
            $this->crudServiceClient = new CrudServiceClient(
                $this->service,
                $this->login,
                $this->password);
        }

        return $this->crudServiceClient;
    }

    /**
     * Method sets service client
     *
     * @param CrudServiceClientInterface $crudServiceClient
     *            Service client
     */
    public function setClient(CrudServiceClientInterface $crudServiceClient)
    {
        $this->crudServiceClient = $crudServiceClient;
    }

    /**
     * Method returns all vailable records
     *
     * @return array all vailable records
     */
    public function all(): array
    {
        return $this->getClient()->getList(0, 1000000);
    }

    /**
     * Method returns a subset from vailable records
     *
     * @param array $order
     *            order settings
     * @param int $from
     *            the beginning of the bunch
     * @param int $limit
     *            the size of the batch
     * @return array subset from vailable records
     */
    public function getRecords(array $order, int $from, int $limit): array
    {
        return $this->getClient()->getList($from, $limit, 0, [], $order);
    }

    /**
     * Record preprocessor
     *
     * @param object $record
     *            record to be preprocessed
     * @return object preprocessed record
     */
    public function preprocessListItem(object $record): object
    {
        // in this case all transformations are done on the service's side
        return $record;
    }
}
