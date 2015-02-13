<?php

namespace Cnerta\MailingBundle\Mailing;

use Cnerta\MailingBundle\Mailing\MailParametersInterface;

/**
 * @author Valérian Girard <valerian.girard@eduter.fr>
 */
interface MailingServiceInterface
{
    /**
     * Envoie de mail simple
     *
     * @param array/array <Account> $accountList
     * @param array $paramList
     * @return type
     */
    public function sendEmail(array $accountList, $template, MailParametersInterface $mailParameters = null);
}
