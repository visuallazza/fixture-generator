lint:
	vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.php --diff --allow-risky=yes --using-cache=yes

test:
	vendor/bin/phpunit --testsuite Unit

install:
	composer intall