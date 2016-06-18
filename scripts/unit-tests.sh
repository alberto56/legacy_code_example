set -e

echo -e ""
echo -e "-----"
echo -e ""
echo -e "About to run fast unit tests on your environments."

docker kill legacy_code_example_dev_phpunit > /dev/null 2> /dev/null || true
docker rm legacy_code_example_dev_phpunit > /dev/null 2> /dev/null || true
docker build -f="Dockerfile-phpunit" -t legacy_code_example_dev_phpunit .

echo -e ""
echo -e "Unit tests complete; no errors found."
echo -e ""
