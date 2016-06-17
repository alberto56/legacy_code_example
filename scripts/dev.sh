set -e

echo -e "About to destroy old containers named legacy_code_dev_d7 if it exists."

docker kill legacy_code_dev_d7 > /dev/null 2> /dev/null || true
docker rm legacy_code_dev_d7 > /dev/null 2> /dev/null || true

echo -e "About to build new legacy_code_dev_d7 container for D7 development."

docker build -f="Dockerfile-drupal7" -t docker-legacy_code_example .
docker run -d -p 80 --name legacy_code_dev_d7 -v $(pwd):/srv/drupal/www/sites/all/modules/legacy_code_example/ docker-legacy_code_example

echo -e "About to enable legacy_code_example on d7 environment."

docker exec legacy_code_dev_d7 bash -c 'cd /srv/drupal/www && drush en -y legacy_code_example'

D7PORT=$(docker ps|grep legacy_code_dev_d7|sed 's/.*0.0.0.0://g'|sed 's/->.*//g')
echo -e "To log into your D7 environment go to:"
echo -e ""
echo -e ' ==> '$(./scripts/uli-for-container.sh legacy_code_dev_d7)|sed "s/default/172.17.8.101:$D7PORT/g"
echo -e ""
