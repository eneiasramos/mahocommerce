<?php
/**
 * Maho
 *
 * @category   Unserialize
 * @package    Unserialize_Reader
 * @copyright  Copyright (c) 2006-2020 Magento, Inc. (https://magento.com)
 * @copyright  Copyright (c) 2022 The OpenMage Contributors (https://openmage.org)
 * @license    https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Class Unserialize_Reader_ArrKey
 */
class Unserialize_Reader_ArrKey
{
    /**
     * @var int
     */
    protected $_status;

    /**
     * @object
     */
    protected $_reader;

    public const NOT_STARTED = 1;
    public const READING_KEY = 2;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->_status = self::NOT_STARTED;
    }

    /**
     * @param string $char
     * @param string $prevChar
     * @return mixed|null
     * @throws Exception
     */
    public function read($char, $prevChar)
    {
        if ($this->_status == self::NOT_STARTED) {
            switch ($char) {
                case Unserialize_Parser::TYPE_STRING:
                    $this->_reader = new Unserialize_Reader_Str();
                    $this->_status = self::READING_KEY;
                    break;
                case Unserialize_Parser::TYPE_INT:
                    $this->_reader = new Unserialize_Reader_Int();
                    $this->_status = self::READING_KEY;
                    break;
                default:
                    throw new Exception('Unsupported data type ' . $char);
            }
        }

        if ($this->_status == self::READING_KEY) {
            $key = $this->_reader->read($char, $prevChar);
            if (!is_null($key)) {
                return $key;
            }
        }
        return null;
    }
}
