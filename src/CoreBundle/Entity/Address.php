<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Address
 *
 * @ORM\Embeddable
 */
class Address
{
    const COUNTRY_BELGIUM = "BE";

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min="1",
     *      max="100",
     * )
     */
    protected $street;

    /**
     * @var string
     *
     * @ORM\Column(name="second_line", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min="0",
     *      max="100",
     * )
     */
    protected $secondLine;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=20, nullable=true)
     * @Assert\Length(
     *      min="1",
     *      max="20",
     * )
     */
    protected $number;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=10, nullable=true)
     * @Assert\Length(
     *      min="4",
     *      max="6",
     * )
     */
    protected $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=90, nullable=true)
     * @Assert\Length(
     *      min="2",
     *      max="90",
     * )
     */
    protected $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     * @Assert\Country()
     */
    protected $country;


    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="decimal", precision=18, scale=12, nullable=true)
     */
    private $latitude;
    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="decimal", precision=18, scale=12, nullable=true)
     */
    private $longitude;


    /**
     * @param string $street
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $number
     * @return Address
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $zipCode
     * @return Address
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param string $city
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $country
     * @return Address
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Get a printable version of this address
     * @return string
     * @deprecated
     * todo remove?
     */
    public function getFullyReadable()
    {
        $address = array(
            $this->getNumber() . ', ' . $this->getStreet(),
            $this->getZipCode() . ' ' . $this->city,
            $this->country
        );
        return implode(PHP_EOL, $address);
    }

    function __toString()
    {
        return $this->getFullyReadable();
    }


    /**
     * @return string
     * @deprecated
     * todo remove?
     */
    public function toJson()
    {
        return json_encode(array(
            'street'  => $this->street,
            'number'  => $this->number,
            'zipCode' => $this->zipCode,
            'city'    => $this->city,
            'country' => $this->country
        ));
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return string
     */
    public function getSecondLine()
    {
        return $this->secondLine;
    }

    /**
     * @param string $secondLine
     * @return Address
     */
    public function setSecondLine($secondLine)
    {
        $this->secondLine = $secondLine;
        return $this;
    }


}

