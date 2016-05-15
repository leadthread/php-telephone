<?php

namespace Zenapply\DataTypes;

use libphonenumber\PhoneNumberUtil as Util;
use libphonenumber\PhoneNumberFormat as Format;
use libphonenumber\PhoneNumberType as Type;

/**
 * @see https://en.wikipedia.org/wiki/Telephone_numbering_plan#Structure
 */
class Telephone 
{
    //Telephone variations
    protected $format_E164;
    protected $format_international;
    protected $format_national;
    protected $format_RFC3966;

    //Telephone structure
    protected $country_code;
    protected $area_code;
    protected $subscriber_code;
    protected $extension;

    //Telephone extras
    protected $region;
    protected $input;

    //Telephone types
    protected $typeMap = [
        Type::FIXED_LINE => 'FIXED_LINE',
        Type::MOBILE => 'MOBILE',
        Type::FIXED_LINE_OR_MOBILE => 'FIXED_LINE_OR_MOBILE',
        Type::TOLL_FREE => 'TOLL_FREE',
        Type::PREMIUM_RATE => 'PREMIUM_RATE',
        Type::SHARED_COST => 'SHARED_COST',
        Type::VOIP => 'VOIP',
        Type::PERSONAL_NUMBER => 'PERSONAL_NUMBER',
        Type::PAGER => 'PAGER',
        Type::UAN => 'UAN',
        Type::UNKNOWN => 'UNKNOWN',
        Type::EMERGENCY => 'EMERGENCY',
        Type::VOICEMAIL => 'VOICEMAIL',
        Type::SHORT_CODE => 'SHORT_CODE',
        Type::STANDARD_RATE => 'STANDARD_RATE',
    ];

    /**
     * @param string $input  The phone number
     * @param string $region The region or country of the phone number
     */
    public function __construct($input,$region = 'US')
    {
        $this->input = $input;
        $this->region = $region;
        $this->setup();
    }

    /**
     * @return void
     */
    protected function setup()
    {
        $util = Util::getInstance();
        $number = $util->parse($this->input, $this->region);
        
        //Meta
        $this->valid  = $util->isValidNumber($number);
        $this->type   = $this->typeMap[$util->getNumberType($number)];

        //Formats
        $this->format_E164          = $util->format($number, Format::E164);
        $this->format_international = $util->format($number, Format::INTERNATIONAL);
        $this->format_national      = $util->format($number, Format::NATIONAL);
        $this->format_RFC3966       = $util->format($number, Format::RFC3966);
        
        //Get the parts
        $this->country_code    = $number->getCountryCode();
        $this->extension       = $number->getExtension();
        $this->area_code       = $this->extractAreaCode();
        $this->subscriber_code = $this->extractSubscriberCode();
    }

    protected function extractAreaCode()
    {
        if($this->region === 'US' && $this->isValid()){
            $exp = '/^\+?(1)?\s?\(?(\d{3})\)?(?:\s|\.|\-)?(\d{3})(?:\s|\.|\-)?(\d{4})$/';
            preg_match($exp,$this->format_E164,$matches);
            if(count($matches) === 5){
                return $matches[2];
            }
        }

        return null;
    }

    protected function extractSubscriberCode()
    {
        if($this->region === 'US' && $this->isValid()){
            $exp = '/^\+?(1)?\s?\(?(\d{3})\)?(?:\s|\.|\-)?(\d{3})(?:\s|\.|\-)?(\d{4})$/';
            preg_match($exp,$this->format_E164,$matches);
            if(count($matches) === 5){
                return $matches[3] . $matches[4];
            }
        }

        return null;
    }

    /*=====================================
    =            Ouput Methods            =
    =====================================*/

    /**
     * @return string
     */
    public function getRFC3966()
    {
        return $this->format_RFC3966;
    }

    /**
     * @return string
     */
    public function getNational()
    {
        return $this->format_national;
    }

    /**
     * @return string
     */
    public function getInternational()
    {
        return $this->format_international;
    }

    /**
     * @return string
     */
    public function getE164()
    {
        return $this->format_E164;
    }


    /**
     * @return string
     */
    public function getOriginal()
    {
        return $this->input;
    }

    /**
     * @return string
     */
    public function getAreaCode()
    {
        return $this->area_code;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->country_code;
    }

    /**
     * @return string
     */
    public function getSubscriberCode()
    {
        return $this->subscriber_code;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function isValid()
    {
        return $this->valid;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getE164();
    }
    
    /*=====  End of Ouput Methods  ======*/
}