# How to normalize code formating

This respostory uses `phpcs` to scan for both security and formating preferences. It follows the WordPress Coding
Standards as well as other PHP standards where they don't conflict.

## CodeClimate runs on all Pull Requests

We have configure CodeClimate to check for PHPCS violations using the rules we have defined in `phpcs.xml` on every
pull request. When possible, issues flagged in this way should be resolved prior to asking for a Code Review. If you do
no feel it is important to resolve a particular issue, it would be best to note that to the code reviewer when requsting
a code review and why.

## Security checks run in GitHub Actions

We run a subset of phpcs rules automatically in GitHub Actions. Failure on these checks will fail the build. If there is
a good reason to not resolve something found in this check, you will need to:

- use the phpcs:disable/enable syntax for the specific rule to be skipped around the code in violation
- inform the code reviewer clearly why this is being skipped and not resolved at this time

## Running checks locally

It is often better to run checks locally rather than rely on CodeClimate or GitHub Actions to determine if you have
resolved all issues in a pull reqeust.

You can run `composer security` to run the security checks on the whole repository. This should always be expected to
output no concerns.

You can run our full checks on a specific file via `composer phpcs FILENAME` (you can run it on the whole repository
but there are a lot of legacy rule violations so you should focus only on files you are working directly with as part
of your pull request).

You can enable your code editor to work for you. In VSCode, the extension `PHP Sniffer & Beatifier` does solid job
autofixing or flagging errors when you save the file depending on your configuration.
