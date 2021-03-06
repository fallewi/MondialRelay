<?php

namespace MondialRelay\Model\Base;

use \Exception;
use \PDO;
use MondialRelay\Model\MondialRelayPickupAddress as ChildMondialRelayPickupAddress;
use MondialRelay\Model\MondialRelayPickupAddressQuery as ChildMondialRelayPickupAddressQuery;
use MondialRelay\Model\Map\MondialRelayPickupAddressTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'mondial_relay_pickup_address' table.
 *
 *
 *
 * @method     ChildMondialRelayPickupAddressQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildMondialRelayPickupAddressQuery orderByJsonRelayData($order = Criteria::ASC) Order by the json_relay_data column
 * @method     ChildMondialRelayPickupAddressQuery orderByOrderAddressId($order = Criteria::ASC) Order by the order_address_id column
 *
 * @method     ChildMondialRelayPickupAddressQuery groupById() Group by the id column
 * @method     ChildMondialRelayPickupAddressQuery groupByJsonRelayData() Group by the json_relay_data column
 * @method     ChildMondialRelayPickupAddressQuery groupByOrderAddressId() Group by the order_address_id column
 *
 * @method     ChildMondialRelayPickupAddressQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMondialRelayPickupAddressQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMondialRelayPickupAddressQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMondialRelayPickupAddress findOne(ConnectionInterface $con = null) Return the first ChildMondialRelayPickupAddress matching the query
 * @method     ChildMondialRelayPickupAddress findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMondialRelayPickupAddress matching the query, or a new ChildMondialRelayPickupAddress object populated from the query conditions when no match is found
 *
 * @method     ChildMondialRelayPickupAddress findOneById(int $id) Return the first ChildMondialRelayPickupAddress filtered by the id column
 * @method     ChildMondialRelayPickupAddress findOneByJsonRelayData(string $json_relay_data) Return the first ChildMondialRelayPickupAddress filtered by the json_relay_data column
 * @method     ChildMondialRelayPickupAddress findOneByOrderAddressId(int $order_address_id) Return the first ChildMondialRelayPickupAddress filtered by the order_address_id column
 *
 * @method     array findById(int $id) Return ChildMondialRelayPickupAddress objects filtered by the id column
 * @method     array findByJsonRelayData(string $json_relay_data) Return ChildMondialRelayPickupAddress objects filtered by the json_relay_data column
 * @method     array findByOrderAddressId(int $order_address_id) Return ChildMondialRelayPickupAddress objects filtered by the order_address_id column
 *
 */
abstract class MondialRelayPickupAddressQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \MondialRelay\Model\Base\MondialRelayPickupAddressQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\MondialRelay\\Model\\MondialRelayPickupAddress', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMondialRelayPickupAddressQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMondialRelayPickupAddressQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \MondialRelay\Model\MondialRelayPickupAddressQuery) {
            return $criteria;
        }
        $query = new \MondialRelay\Model\MondialRelayPickupAddressQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildMondialRelayPickupAddress|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MondialRelayPickupAddressTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MondialRelayPickupAddressTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return   ChildMondialRelayPickupAddress A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID, JSON_RELAY_DATA, ORDER_ADDRESS_ID FROM mondial_relay_pickup_address WHERE ID = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            $obj = new ChildMondialRelayPickupAddress();
            $obj->hydrate($row);
            MondialRelayPickupAddressTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildMondialRelayPickupAddress|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return ChildMondialRelayPickupAddressQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MondialRelayPickupAddressTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildMondialRelayPickupAddressQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MondialRelayPickupAddressTableMap::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMondialRelayPickupAddressQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(MondialRelayPickupAddressTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(MondialRelayPickupAddressTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MondialRelayPickupAddressTableMap::ID, $id, $comparison);
    }

    /**
     * Filter the query on the json_relay_data column
     *
     * Example usage:
     * <code>
     * $query->filterByJsonRelayData('fooValue');   // WHERE json_relay_data = 'fooValue'
     * $query->filterByJsonRelayData('%fooValue%'); // WHERE json_relay_data LIKE '%fooValue%'
     * </code>
     *
     * @param     string $jsonRelayData The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMondialRelayPickupAddressQuery The current query, for fluid interface
     */
    public function filterByJsonRelayData($jsonRelayData = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($jsonRelayData)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $jsonRelayData)) {
                $jsonRelayData = str_replace('*', '%', $jsonRelayData);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MondialRelayPickupAddressTableMap::JSON_RELAY_DATA, $jsonRelayData, $comparison);
    }

    /**
     * Filter the query on the order_address_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderAddressId(1234); // WHERE order_address_id = 1234
     * $query->filterByOrderAddressId(array(12, 34)); // WHERE order_address_id IN (12, 34)
     * $query->filterByOrderAddressId(array('min' => 12)); // WHERE order_address_id > 12
     * </code>
     *
     * @param     mixed $orderAddressId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMondialRelayPickupAddressQuery The current query, for fluid interface
     */
    public function filterByOrderAddressId($orderAddressId = null, $comparison = null)
    {
        if (is_array($orderAddressId)) {
            $useMinMax = false;
            if (isset($orderAddressId['min'])) {
                $this->addUsingAlias(MondialRelayPickupAddressTableMap::ORDER_ADDRESS_ID, $orderAddressId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orderAddressId['max'])) {
                $this->addUsingAlias(MondialRelayPickupAddressTableMap::ORDER_ADDRESS_ID, $orderAddressId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MondialRelayPickupAddressTableMap::ORDER_ADDRESS_ID, $orderAddressId, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildMondialRelayPickupAddress $mondialRelayPickupAddress Object to remove from the list of results
     *
     * @return ChildMondialRelayPickupAddressQuery The current query, for fluid interface
     */
    public function prune($mondialRelayPickupAddress = null)
    {
        if ($mondialRelayPickupAddress) {
            $this->addUsingAlias(MondialRelayPickupAddressTableMap::ID, $mondialRelayPickupAddress->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the mondial_relay_pickup_address table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MondialRelayPickupAddressTableMap::DATABASE_NAME);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MondialRelayPickupAddressTableMap::clearInstancePool();
            MondialRelayPickupAddressTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildMondialRelayPickupAddress or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildMondialRelayPickupAddress object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public function delete(ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MondialRelayPickupAddressTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MondialRelayPickupAddressTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        MondialRelayPickupAddressTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MondialRelayPickupAddressTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

} // MondialRelayPickupAddressQuery
