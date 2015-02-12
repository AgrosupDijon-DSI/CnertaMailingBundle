<?php

namespace Cnerta\MailingBundle\Mailing;

/**
 * @author Valérian Girard <valerian.girard@eduter.fr>
 */
interface MailParametersInterface
{
    /**
     * @param string $key
     * @param mixin $value
     * @return Cnerta\MailingBundle\MailingBundle\Mailing\MailParameters
     */
    public function addObjectParameters($key, $value);
    
    /**
     * @param array $objectParameters
     * @return Cnerta\MailingBundle\MailingBundle\Mailing\MailParameters
     */
    public function setObjectParameters(array $objectParameters);
    
    /**
     * @return array
     */
    public function getObjectParameters();
    
    /**
     * @param string $key
     * @param mixin $value
     * @return Cnerta\MailingBundle\MailingBundle\Mailing\MailParameters
     */
    public function addBodyParameters($key, $value);
    
    /**
     * @param array $bodyParameters
     * @return Cnerta\MailingBundle\MailingBundle\Mailing\MailParameters
     */
    public function setBodyParameters(array $bodyParameters);
    
    /**
     * @return array
     */
    public function getBodyParameters();
    
    /**
     * @return string
     */
    public function getTemplateBundle();

    /**
     * 
     * @param string $templateBundle
     * @return \Cnerta\MailingBundle\Mailing\MailParameters
     */
    public function setTemplateBundle($templateBundle);
}
