<?php

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel {

    public function registerBundles() {
        $bundles = array(
            //Bundles systèmes ----------------------------------------
            new FM\ElfinderBundle\FMElfinderBundle(),
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
//            new Symfony\Cmf\Bundle\CoreBundle\CmfCoreBundle(),
            new Symfony\Cmf\Bundle\RoutingBundle\CmfRoutingBundle(),
//            new Symfony\Cmf\Bundle\RoutingAutoBundle\CmfRoutingAutoBundle(),
            //Bundles internes ECM ----------------------------------------
            new ECM\Bundle\HomeBundle\ECMHomeBundle(),
            new ECM\Bundle\UserBundle\ECMUserBundle(),
            new ECM\Bundle\ArticleBundle\ECMArticleBundle(),
            new ECM\Bundle\ModuleBundle\ECMModuleBundle(),
            new ECM\Bundle\AdminBundle\ECMAdminBundle(),
            //Bundles externes ----------------------------------------
            new Pix\SortableBehaviorBundle\PixSortableBehaviorBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            //Slugify
            new Cocur\Slugify\Bridge\Symfony\CocurSlugifyBundle(),
            //Bootstrap
            new Braincrafted\Bundle\BootstrapBundle\BraincraftedBootstrapBundle(),
            //KNP
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Knp\Bundle\MarkdownBundle\KnpMarkdownBundle(),
            //FOS User
            new FOS\UserBundle\FOSUserBundle(),
            //CK Editor
            new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
            // Sonata
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
//            new Sonata\PageBundle\SonataPageBundle(),
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
            new Sonata\AdminBundle\SonataAdminBundle(),
            new Sonata\FormatterBundle\SonataFormatterBundle(),
//            new Sonata\CacheBundle\SonataCacheBundle(),
//            new Sonata\SeoBundle\SonataSeoBundle(),
//            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
//            new Sonata\NotificationBundle\SonataNotificationBundle(),
//            new Application\Sonata\PageBundle\ApplicationSonataPageBundle(),
//            new Application\Sonata\NotificationBundle\ApplicationSonataNotificationBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Acme\DemoBundle\AcmeDemoBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader) {
        $loader->load(__DIR__ . '/config/config_' . $this->getEnvironment() . '.yml');
    }

}
