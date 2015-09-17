<?php

namespace Cnerta\MailingBundle\Tests\Functional\Mailing;

use Cnerta\MailingBundle\Mailing\MailingService;
use Cnerta\MailingBundle\Mailing\MailParameters;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @group MailingServiceTest
 */
class MailingServiceTest extends WebTestCase
{
    public function testSimpleEmailSending()
    {
        /* @var $client \Symfony\Bundle\FrameworkBundle\Client */
        $client = static::createClient();

        $spoolFolder = $client->getContainer()->getParameter("swiftmailer.spool.default.file.path");

        $this->unlinkAll($spoolFolder);



        $parameters = new MailParameters();

        $parameters->addBodyParameters("name", "Amelia Schmitt");

        /* @var $mailing MailingService */
        $mailing = $client->getContainer()->get('cnerta.mailing');

        $mailing->sendEmail(array("user@exemple.com"), 'welcome', $parameters);

        $file = $this->getFile($spoolFolder);

        $this->assertContains("Amelia Schmitt", file_get_contents($file->getPathname()));
    }

    /**
     * @param string $dir
     * @return \SplFileInfo
     */
    private function getFile($dir)
    {
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir), \RecursiveIteratorIterator::SELF_FIRST);
        /* @var $fileInfo \SplFileInfo */
        foreach ($iterator as $filename => $fileInfo) {
            if($fileInfo->isFile()) {
                return $fileInfo;
            }
        }
    }

    private function unlinkAll($dir)
    {
        $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator(
                $dir, \FilesystemIterator::SKIP_DOTS
                ), \RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($iterator as $filename => $fileInfo) {
            if ($fileInfo->isDir()) {
                rmdir($filename);
            } else {
                unlink($filename);
            }
        }
    }

}
