<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception;

use Exception;

/**
 * Exception Class InfrastructureException
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Exception
 */
class InfrastructureException extends Exception
{
    /**
     * Returns the <No Environment Parameter> Exception.
     *
     * @param integer $id
     *
     * @return InfrastructureException
     */
    public static function noEnvParam($id): InfrastructureException
    {
        return new static(\sprintf('The environment variable %s does not exist in the server.', $id));
    }

    /**
     * Returns the <No Data Header passed in request> Exception.
     *
     * @param $data
     * @return InfrastructureException
     */
    public static function noDataHeader($data): InfrastructureException
    {
        return new static(\sprintf('The %s data is not passed in the header request.', $data));
    }

    /**
     * Returns the <No Tenant Definition in the multi-tenant description file> Exception.
     *
     * @param integer $id
     *
     * @return InfrastructureException
     */
    public static function noTenantDefinition($id): InfrastructureException
    {
        return new static(\sprintf('The tenant %s is not define in the multi-tenants file.', $id));
    }

    /**
     * Returns the <No Tenant database connection> Exception.
     *
     * @param integer $id
     *
     * @return InfrastructureException
     */
    public static function noTenantDatabaseConnection($id): InfrastructureException
    {
        return new static(\sprintf('The connection of the database associated with the tenant %s is not done.', $id));
    }
}
