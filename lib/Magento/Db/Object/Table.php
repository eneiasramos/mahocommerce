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
 * Magento_Db_Object_Table
 *
 * @category   Magento
 * @package    Magento_Db
 */
class Magento_Db_Object_Table extends Magento_Db_Object implements Magento_Db_Object_Interface
{
    /**
     * @var string
     */
    protected $_dbType  = 'TABLE';

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

    /**
     * Create a new table from source
     *
     * @param $source Zend_Db_Select
     * @return Magento_Db_Object_Table
     */
    public function createFromSource(Zend_Db_Select $source)
    {
        $this->_adapter->query(
            'CREATE ' . $this->getDbType() . ' ' . $this->_objectName . ' AS ' . $source
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
}
