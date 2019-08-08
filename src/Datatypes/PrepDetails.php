<?php

namespace Sonnenglas\AmazonMws\Datatypes;

use Sonnenglas\AmazonMws\Enum;

class PrepDetails
{
  private $options = [];
  /**
   * Required attributes, the default is not set yet.
   *
   * @var array
   */
  private $requiredFields = [
    'PrepInstruction' => false,
    'PrepOwner'       => false,
  ];

  /**
   * Set PrepInstruction
   *
   * @param string $instruction
   */
  public function setPrepInstruction( string $instruction )
  {
    $this->options['PrepInstruction'] = $instruction;

    $this->requiredFields['PrepInstruction'] = true;
  }

  /**
   * Set PrepOwner
   *
   * @param string $owner
   */
  public function setPrepOwner( string $owner )
  {
    if ( ! in_array( $owner, Enum::PREP_OWNERS ) )
    {
      throw new \InvalidArgumentException( 'Invalid value of PrepOwner. possible: ' . implode( ',', Enum::PREP_OWNERS ) );
    }

    $this->options['PrepOwner'] = $owner;

    $this->requiredFields['PrepOwner'] = true;
  }

  /**
   * Check required attributes and return options.
   *
   * @return array
   */
  public function toArray()
  {
    if ( array_sum( $this->requiredFields ) < count( $this->requiredFields ) )
    {
      throw new \InvalidArgumentException( 'Pallet missing required attributes' );
    }

    return $this->options;
  }
}