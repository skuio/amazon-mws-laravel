<?php

namespace Sonnenglas\AmazonMws\Datatypes;

class PartneredLtlDataInput
{
  private $options = [];
  /**
   * Required attributes, the default is not set yet.
   *
   * @var array
   */
  private $requiredFields = [
    'Contact'          => false,
    'BoxCount'         => false,
    'FreightReadyDate' => false,
  ];

  public function setContact( string $name, string $phone, string $email, string $fax )
  {
    $this->options['Contact.Name']  = $name;
    $this->options['Contact.Phone'] = $phone;
    $this->options['Contact.Email'] = $email;
    $this->options['Contact.Fax']   = $fax;

    $this->requiredFields['Contact'] = true;
  }

  public function setBoxCount( int $boxCount )
  {
    $this->options['BoxCount'] = $boxCount;

    $this->requiredFields['BoxCount'] = true;
  }

  public function setSellerFreightClass( string $sellerFreightClass )
  {
    $this->options['SellerFreightClass'] = $SellerFreightClass;
  }

  public function setFreightReadyDate( string $freightReadyDate )
  {
    $this->options['FreightReadyDate'] = $freightReadyDate;

    $this->requiredFields['FreightReadyDate'] = true;
  }

  public function setTotalWeight( int $value, string $unit )
  {
    $this->options['TotalWeight.Value'] = $value;
    $this->options['TotalWeight.Unit']  = $unit;
  }

  public function setSellerDeclaredValue( string $value, string $currencyCode )
  {
    $this->options['SellerDeclaredValue.Value']        = $value;
    $this->options['SellerDeclaredValue.CurrencyCode'] = $currencyCode;
  }

  public function setPalletList( array $palets )
  {
    foreach ( $palets as $index => $palet )
    {
      if ( ! $palets instanceof Pallet )
      {
        throw new \InvalidArgumentException( 'The pallet list must-have items of Pallet data type.' );
      }

      foreach ( $palet->toArray() as $key => $value )
      {
        $this->options[ 'PalletList.member.' . ( $index + 1 ) . '.' . $key ] = $value;
      }
    }
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
      throw new \InvalidArgumentException( 'PartneredLtlDataInput missing required attributes' );
    }

    return $this->options;
  }
}