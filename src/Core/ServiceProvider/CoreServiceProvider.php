<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Core\ServiceProvider;

use PeterPecosz\ShoppingPlanner\Core\Url\Url;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Slim\Factory\AppFactory;
use Slim\Factory\Psr17\SlimPsr17Factory;
use Slim\Psr7\Factory\StreamFactory;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigTest;

use function DI\create;
use function DI\factory;
use function DI\get;

class CoreServiceProvider implements ServiceDefinitionProviderInterface
{
    public function getDefinitions(): array
    {
        return [
            ServerRequestInterface::class => factory(
                static function (): ServerRequestInterface {
                    return SlimPsr17Factory::getServerRequestCreator()->createServerRequestFromGlobals();
                }
            ),

            ResponseFactoryInterface::class => factory(
                static function (): ResponseFactoryInterface {
                    return AppFactory::determineResponseFactory();
                }
            ),

            StreamFactoryInterface::class => factory(
                static function (): StreamFactoryInterface {
                    return new StreamFactory();
                }
            ),

            Environment::class => create()
                ->constructor(
                    create(FilesystemLoader::class)
                        ->constructor(get('twig.template_path')),
                    get('twig.parameters')
                )
                ->method(
                    'addTest',
                    create(TwigTest::class)
                        ->constructor('string', 'is_string')
                )
                ->method(
                    'addTest',
                    create(TwigTest::class)
                        ->constructor('array', 'is_array')
                )
                ->method(
                    'addTest',
                    create(TwigTest::class)
                        ->constructor('url', [Url::class, 'isUrl'])
                ),

            ExpressionLanguage::class => create(),
        ];
    }
}
