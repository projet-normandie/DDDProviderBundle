<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Generalisation\Orm;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\PersistenceException;
//use Doctrine\ORM\Cache;
use Doctrine\ORM\Query;

/**
 * Trait Query
 *
 * @deprecated Kept because it contains useful methods.
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Persistence\Generalisation\Orm
 */
trait TraitQuery
{
    /**
     * Return query in cache
     *
     * @param Query $query
     * @param integer $time
     * @param int $mode [Cache::MODE_GET, Cache::MODE_PUT, Cache::MODE_NORMAL, Cache::MODE_REFRESH]
     * @param boolean $canUseCache
     * @param string $namespace
     * @return Query
     * @throws PersistenceException
     */
    /*
    public function cacheQuery(
        Query $query,
        $time = 3600,
        $mode = Cache::MODE_NORMAL,
        $canUseCache = true,
        $namespace = ''
    ) {
        if (!$query) {
            throw new PersistenceException('Invalid query instance');
        }
        // create single file from all input
        $input_hash = $namespace . sha1(serialize($query->getParameters()) . $query->getSQL());
        $query->useResultCache(true, $time, (string)$input_hash);
        $query->useQueryCache(true);

        if (method_exists($query, 'setCacheMode')) {
            $query->setCacheMode($mode);
        }

        if (method_exists($query, 'setCacheable')) {
            $query->setCacheable($canUseCache);
        }

        return $query;
    }
    */

    /**
     * Loads all translations with all translatable
     * fields from the given entity
     *
     * @link https://github.com/l3pp4rd/DoctrineExtensions/blob/master/doc/translatable.md#entity-domain-object
     *
     * @param Query   $query
     * @param boolean $lazy_loading
     *
     * @return $this
     */
    /*
    public function setHints(Query $query, $lazy_loading = true)
    {
        // BE CAREFUL ::: Strange Issue with Query Hint and APC
        $query->setHint(
            Query::HINT_CUSTOM_OUTPUT_WALKER,
            'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
        );
        // if you use memcache or apc. You should set locale and other options like fallback to query through hints.
        //Otherwise the query will be cached with a first used locale
        if (!$lazy_loading) {
            // to avoid lazy-loading.
            $query->setHint(Query::HINT_FORCE_PARTIAL_LOAD, true);
        }
        $query->setHint(Query::HINT_REFRESH, true);

        return $this;
    }
    */

    /**
     * Loads all translations with all translatable fields from the given entity
     *
     * @param Query $query
     * @param int $result
     *
     * @return array|object of result query
     * @throws \InvalidArgumentException
     */
    /*
    public function findByQuery(Query $query, $result = Query::HYDRATE_ARRAY)
    {
        if (!in_array($result, [Query::HYDRATE_ARRAY, Query::HYDRATE_OBJECT], true)) {
            throw new \InvalidArgumentException('We have not set the good option value : array or object !');
        }

        return $query->execute(null, $result);
    }
    */

    /**
     * Way to iterate over a large result set with "yield" php function.
     *
     * <code>
     *  $q = $this->_em->createQuery('SELECT e FROM AppBundle:EntityTwo e');
     *  $entityOne->setEntityTwo($this->yieldByQuery($q));
     * </code>
     *
     * @param Query   $query
     *
     * @return \Iterator
     */
    /*
    public function yieldByQuery(Query $query)
    {
        foreach ($query->iterate() as $row) {
            yield $row[0];

            // detach from Doctrine, so that it can be Garbage-Collected immediately
            $this->em->detach($row[0]);
        }

        return null;
    }
    */
}
