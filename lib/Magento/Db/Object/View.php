<?php
/**
 * Maho
 *
 * @category   Magento
 * @package    Magento_Db
 * @copyright  Copyright (c) 2006-2020 Magento, Inc. (https://magento.com)
 * @copyright  Copyright (c) 2022-2023 The OpenMage Contributors (https://openmage.org)
 * @license    https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Magento_Db_Object_View
 *
 * @category   Magento
 * @package    Magento_Db
 */
class Magento_Db_Object_View extends Magento_Db_Object implements Magento_Db_Object_Interface
{
    public const ALGORITHM_MERGE       = 'MERGE';
    public const ALGORITHM_TEMPTABLE   = 'TEMPTABLE';

    /**
     * @var string
     */
    protected $_dbType  = 'VIEW';

    /**
     * Create view from source
     *
     * @param $source
     * @param string $algorithm
     * @return Magento_Db_Object_View
     */
    public function createFromSource(Zend_Db_Select $source, $algorithm = self::ALGORITHM_MERGE)
    {
        $this->_adapter->query(
            'CREATE ALGORITHM = ' . $algorithm . ' ' . $this->getDbType() . ' '
                . $this->getObjectName() . ' AS ' . $source
        );
        return $this;
    }

    /**
     * Describe Table
     *
     * @return array
     */
    #[\Override]
    public function describe()
    {
        return $this->_adapter->describeTable($this->_objectName, $this->_schemaName);
    }

    /**
     * Check is object exists
     *
     * @return bool
     */
    #[\Override]
    public function isExists()
    {
        return $this->_adapter->isTableExists($this->_objectName, $this->_schemaName);
    }
}
