<?php

/*
 * This file is part of the Claroline Connect package.
 *
 * (c) Claroline Consortium <consortium@claroline.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Claroline\CoreBundle\Library\Transfert\ConfigurationBuilders\Tools\Resources;

use Claroline\CoreBundle\Library\Transfert\Importer;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use JMS\DiExtraBundle\Annotation as DI;
use Claroline\CoreBundle\Entity\Workspace\Workspace;

/**
 * @DI\Service("claroline.tool.resources.text_importer")
 * @DI\Tag("claroline.importer")
 */
class TextImporter extends Importer implements ConfigurationInterface
{
    private $container;
    private $om;

    /**
     * @DI\InjectParams({
     *     "container" = @DI\Inject("service_container")
     * })
     */
    public function __construct($container)
    {
        $this->container = $container;
        $om = $this->container->get('claroline.persistence.object_manager');
    }

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('data');
        $this->addTextSection($rootNode);

        return $treeBuilder;
    }

    public function addTextSection($rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('text')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('path')->isRequired()->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ->end();
    }

    public function supports($type)
    {
        return $type == 'yml' ? true: false;
    }

    public function validate(array $data)
    {
        $processor = new Processor();
        $processor->processConfiguration($this, $data);
    }

    public function import(array $array)
    {

    }

    public function export(Workspace $workspace, array &$files, $object)
    {
        $content = $this->om->getRepository('Claroline\CoreBundle\Entity\Revision')
            ->getLastRevision($object)->getContent();

        var_dump($content);
    }

    public function getName()
    {
        return 'text_importer';
    }
} 