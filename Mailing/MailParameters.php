<?php

namespace Cnerta\MailingBundle\MailingBundle\Mailing;

/**
 * @author Valérian Girard <valerian.girard@eduter.fr>
 */
class MailParameters
{
    /**
     * @var array
     */
    private $objectParameters;
    /**
     * @var array
     */
    private $bodyParameters;
    
    function __construct(array $objectParameters = array(), array $bodyParameters = array())
    {
        $this->objectParameters = $objectParameters;
        $this->bodyParameters = $bodyParameters;
    }
    
    /**
     * @param string $key
     * @param mixin $value
     * @return Cnerta\MailingBundle\MailingBundle\Mailing\MailParameters
     */
    public function addObjectParameters($key, $value)
    {
        $this->objectParameters[$key] = $value;
        return $this;
    }
    
    /**
     * @param array $objectParameters
     * @return Cnerta\MailingBundle\MailingBundle\Mailing\MailParameters
     */
    public function setObjectParameters(array $objectParameters)
    {
        $this->objectParameters = $objectParameters;
        return $this;
    }
    
    /**
     * @return array
     */
    public function getObjectParameters()
    {
        return $this->objectParameters;
    }
    
    /**
     * @param string $key
     * @param mixin $value
     * @return Cnerta\MailingBundle\MailingBundle\Mailing\MailParameters
     */
    public function addBodyParameters($key, $value)
    {
        $this->bodyParameters[$key] = $value;
        return $this;
    }
    
    /**
     * @param array $bodyParameters
     * @return Cnerta\MailingBundle\MailingBundle\Mailing\MailParameters
     */
    public function setBodyParameters(array $bodyParameters)
    {
        $this->bodyParameters = $bodyParameters;
        return $this;
    }
    
    /**
     * @return array
     */
    public function getBodyParameters()
    {
        return $this->bodyParameters;
    }
}
