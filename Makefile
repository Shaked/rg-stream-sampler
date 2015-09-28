install:
	composer self-update && composer install --no-interaction --prefer-source

update:
	composer self-update && composer update --no-interaction --prefer-source

test:
	./bin/phpunit

cover:
	rm -rf ./coverage/
	./bin/phpunit --coverage-html ./coverage/ && open ./coverage/index.html

bench:
	 ./bin/athletic -p ./src/Sampler/Benchmarks/  -b ./vendor/autoload.php