<?php

namespace Cnerta\MailingBundle\Tests\Unit\DependencyInjection;

use Cnerta\MailingBundle\DependencyInjection\CnertaMailingExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @group CnertaMailingExtensionTest
 */
class CnertaMailingExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CnertaMailingExtension
     */
    private $extension;

    /**
     * @var ContainerBuilder
     */
    private $container;

    protected function setUp()
    {
        $this->extension = new CnertaMailingExtension();

        $this->container = new ContainerBuilder();
        $this->container->registerExtension($this->extension);
    }

    public function testWithoutConfiguration()
    {
        $this->container->loadFromExtension($this->extension->getAlias());
        $this->extension->load(array(), $this->container);

        $configs = $this->container->findDefinition("cnerta.mailing")->getArgument(0);
        $this->assertTrue($this->container->hasDefinition("cnerta.mailing"));
        $this->assertArrayHasKey("default_bundle", $configs);
        $this->assertArrayHasKey("from_email", $configs);
    }

    public function testWithYamlConfig()
    {
        $configYaml = <<<YAML
cnerta_mailing:
    default_bundle: "FooBundle"
    from_email:
        address: exemple@exemple.com
        sender_name: "My name is"
YAML;

        $yamlParser = new \Symfony\Component\Yaml\Parser();

        $config = $yamlParser->parse($configYaml);

        $this->container->loadFromExtension($this->extension->getAlias());
        $this->extension->load($config, $this->container);

        $configs = $this->container->findDefinition("cnerta.mailing")->getArgument(0);

        $this->assertEquals("FooBundle", $configs["default_bundle"]);
        $this->assertEquals("exemple@exemple.com", $configs["from_email"]["address"]);
        $this->assertEquals("My name is", $configs["from_email"]["sender_name"]);
    }

}
