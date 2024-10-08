<?php
/**
 * Maho
 *
 * @category   Mage
 * @package    Mage_Downloadable
 * @copyright  Copyright (c) 2006-2020 Magento, Inc. (https://magento.com)
 * @copyright  Copyright (c) 2022-2023 The OpenMage Contributors (https://openmage.org)
 * @license    https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

require_once 'Mage/Downloadable/controllers/Adminhtml/Downloadable/FileController.php';

/**
 * Downloadable File upload controller
 *
 * @category   Mage
 * @package    Mage_Downloadable
 * @deprecated  after 1.4.2.0 Mage_Downloadable_Adminhtml_Downloadable_FileController is used
 */
class Mage_Downloadable_FileController extends Mage_Downloadable_Adminhtml_Downloadable_FileController
{
    /**
     * Controller pre-dispatch method
     * Show 404 front page
     *
     * @return $this
     */
    #[\Override]
    public function preDispatch()
    {
        $this->_forward('defaultIndex', 'cms_index');

        return $this;
    }
}
