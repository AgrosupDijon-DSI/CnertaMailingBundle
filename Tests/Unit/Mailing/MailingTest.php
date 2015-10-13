<?php

namespace Cnerta\MailingBundle\Tests\Unit\Mailing;

use Cnerta\MailingBundle\Mailing\MailingService;

/**
 * @group MailingTest
 */
class MailingTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @mock \Twig_Environment
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $templating;

    /**
     * @mock \Swift_Mailer
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $mailer;

    /**
     * @mock \Psr\Log\LoggerInterface
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $logger;

    protected function setUp()
    {
        $this->templating = $this->getMockBuilder("Twig_Environment")
                ->disableOriginalConstructor()->getMock();

        $this->mailer = $this->getMockBuilder("Swift_Mailer")
                ->disableOriginalConstructor()->getMock();

        $this->logger = $this->getMockBuilder("Psr\Log\LoggerInterface")
                ->disableOriginalConstructor()->getMock();
    }

    public function testSimpleEmailSending()
    {
        $twigtemplate = $this->getMockBuilder("Twig_Template")
                ->disableOriginalConstructor()->getMock();

        $twigtemplate->expects($this->any())
                ->method('renderBlock')
                ->willReturn("Some String");

        $this->templating->expects($this->any())
                ->method("loadTemplate")
                ->willReturn($twigtemplate);

        $this->logger->expects($this->once())
                ->method("info")
                ->with("Email: 'Some String' sended to: 'user@exemple.com'");


        $mail = $this->getMailingService();

        $mail->sendEmail(array("user@exemple.com"), "bumb");
    }

    public function testSimpleUserSending()
    {

        $user = $this->getMockBuilder("std_class")
                ->setMethods(array("getEmail"))
                ->disableOriginalConstructor()->getMock();
        $user->expects($this->once())
                ->method('getEmail')
                ->willReturn("user@exemple.com");

        $twigtemplate = $this->getMockBuilder("Twig_Template")
                ->disableOriginalConstructor()->getMock();

        $twigtemplate->expects($this->any())
                ->method('renderBlock')
                ->willReturn("Some String");

        $this->templating->expects($this->any())
                ->method("loadTemplate")
                ->willReturn($twigtemplate);

        $this->logger->expects($this->once())
                ->method("info")
                ->with("Email: 'Some String' sended to: 'user@exemple.com'");


        $mail = $this->getMailingService();

        $mail->sendEmail(array($user), "bumb");
    }

    /**
     * @expectedException RuntimeException
     * @expectedExceptionMessage Invalid email
     */
    public function testFailWithFakeUser()
    {
        $user = $this->getMockBuilder("std_class")
                ->disableOriginalConstructor()->getMock();

        $twigtemplate = $this->getMockBuilder("Twig_Template")
                ->disableOriginalConstructor()->getMock();

        $twigtemplate->expects($this->any())
                ->method('renderBlock')
                ->willReturn("Some String");

        $this->templating->expects($this->any())
                ->method("loadTemplate")
                ->willReturn($twigtemplate);

        $this->logger->expects($this->never())
                ->method("info");


        $mail = $this->getMailingService();

        $mail->sendEmail(array($user), "bumb");
    }


    /**
     *
     * @param array $config
     * @return MailingService
     */
    private function getMailingService($config = null)
    {
        if($config === null) {
            $config = array(
                "default_bundle" => null,
                "active_log" => true,
                "from_email" => array(
                    "address" => "exemple@exemple.com",
                    "sender_name" => "Webmaster"
                )
            );
        }

        return new MailingService($config, $this->templating, $this->mailer, $this->logger);
    }
}
