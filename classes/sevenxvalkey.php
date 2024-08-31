<?php
/**
 * File containing the sevenxValkey class.
 *
 * @copyright Copyright (C) 7x. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 * @version //autogentag//
 * @package sevenx_valkey
 */

/*!
  \class sevenxValkey eztemplateimageoperator.php
  \ingroup eZTemplateOperators
  \brief Valkey Database Commands and Parameters Supported using operator "valkey"

  This operator allows a connection to a valkey compatible database to run arbatrary commands
*/

class sevenxValkey extends Redis
{
    /**
     * Initializes the valkey / redis class.
     *
     * @param string $valkeyName
     */
    public function __construct( $configuration = array() )
    {
        if ( phpversion('Redis') >= 6 )
        {
            parent::__construct( $configuration );
        }
        else
        {
            parent::__construct();
        }
    }
}

?>