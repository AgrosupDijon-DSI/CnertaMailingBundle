<?php

namespace Cnerta\MailingBundle\Mailing;

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
    public function sendEmail(array $accountList, $template, MailParameters $mailParameters = null);
}
