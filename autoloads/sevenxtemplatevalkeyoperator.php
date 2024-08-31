<?php
/**
 * File containing the sevenxTemplateValkeyOperator class.
 *
 * @copyright Copyright (C) 7x. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 * @version //autogentag//
 * @package sevenx_valkey
 */

/*!
  \class sevenxTemplateValkeyOperator eztemplateimageoperator.php
  \ingroup eZTemplateOperators
  \brief Valkey Database Commands and Parameters Supported using operator "valkey"

  This operator allows a connection to a valkey compatible database to run arbatrary commands
*/

class sevenxTemplateValkeyOperator
{
    /**
     * Initializes the valkey operator with the operator name $name.
     *
     * @param string $valkeyName
     */
    public function __construct( $valkeyName = "valkey" )
    {
        $this->Operators = array( $valkeyName );

        if ( class_exists( 'Redis' ) )
            $this->isValkeySupported = true;
    }

    function operatorTemplateHints()
    {
        return array( 'valkey' => array( 'input' => true,
                                         'output' => true,
                                         'output-type' => array( 'objectproxy', 'keep' ),
                                         'parameters' => true ) );
    }

    /*!
     Run a given valkey command and return the results of the command.
    */
    function modify( $tpl, $operatorName, $operatorParameters, $rootNamespace, $currentNamespace, &$inputValue, $namedParameters,
                     $placement )
    {
        if ( !$this->isValkeySupported )
        {
            eZDebug::writeError( "$operatorName cannot be used since the following Valkey / Redis functions are missing." );
            return;
        }

        if ( $operatorName == 'valkey' )
        {
            $iniValkey = eZINI::instance( 'valkey.ini' );
            $configuration = (array) $iniValkey->variable( "ValkeySettings", "DatabaseConnectionConfiguration" );

            if ( phpversion('Redis') >= 6 )
            {
                $valkeyDB = new sevenxValkey($configuration);
            }
            else
            {
                $valkeyDB = new sevenxValkey();
                $valkeyDB->connect( $configuration['host'], $configuration['port'] );
            }

            $command = $namedParameters['function'];
            $commandParameters = $namedParameters['function_parameters'];

            $commandParameters = array_merge( array( $command ), $commandParameters );
            $inputValue = call_user_func_array(array($valkeyDB, "rawCommand"), $commandParameters );
            //$inputValue = $valkeyDB->rawCommand($command, $commandParameters);
        }
    }

    /*!
     Returns the operators in this class.
    */
    function operatorList()
    {
        return $this->Operators;
    }

    /*!
     \return true to tell the template engine that the parameter list exists per operator type.
    */
    function namedParameterPerOperator()
    {
        return true;
    }

    /*!
     See eZTemplateOperator::namedParameterList
    */
    function namedParameterList()
    {
        return array( 'valkey' => array( "function" => array( 'type' => 'string',
                                                                'required' => true,
                                                                'default' => false ),
                                              "function_parameters" => array( "type" => "mixed",
                                                                 "required" => false,
                                                                 "default" => false )
                                              )
                );
    }

    /// \privatesection
    /// The operator array
    public $Operators;
    /// Whether valkey client class is supported
    public $isValkeySupported;
}

?>