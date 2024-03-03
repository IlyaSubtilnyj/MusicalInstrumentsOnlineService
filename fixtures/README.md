Delete fixture changes: $manager->getRepository(Tag::class)->deleteAll();
Extend custom fixture from GroupInjectionFixture or use GroupInjectionTrait and extends Fixture and implements FixtureGroupInterface.

Apply fixtures like that: 'php bin/console doctrine:fixtures:load --group=core', using group only which are defined in groups.php file of DataFixtures namespace.
Inside groups.php file description of groups to use in console load command.

make:fixture creates fixtures in src/DataFixtures folder - just move them in fixture project filder.

To load particular fixture just write this: php bin/console doctrine:fixtures:load --group=/%your_fixture_name%/

References
1. https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html