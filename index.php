<?php

require_once 'vendor/autoload.php';
require_once 'utils/giftifan.php';

use Povils\Figlet;
use Symfony\Component\Console\Output\ConsoleOutput;

if (!function_exists('readline')) {
  function readline(string $prompt = ''): string
  {
    echo $prompt;
    return rtrim(fgets(STDIN), "\r\n");
  }
}

$figlet = new Figlet\Figlet();
$output = new ConsoleOutput();

function exitWithError(string $message): void
{
  global $output;
  $output->writeln('<error>' . $message . '</error>');
  exit(1);
}


echo "\033[2J\033[;H";

$figlet->setFont('small')->write('giftifan');
$output->writeln('===============================================');

$output->writeln('<comment>[1]</comment> Attendance');
$output->writeln('<comment>[2]</comment> Claim Ads');
$output->writeln('');

$menu = readline('~ Choose menu : ');

if ($menu !== '1' && $menu !== '2')
  exitWithError('Invalid menu choice. Please choose 1 or 2.');

$account = readline('~ List (default: accounts.txt) : ');
if (empty($account)) $account = 'accounts.txt';
$account = getcwd() . '/' . $account;

if (!file_exists($account)) {
  exitWithError('Account file not found: ' . $account);
}

$accounts = file($account, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$password = readline('~ Password : ');

$loop = readline('~ Loop (default: 10) : ');

if (empty($loop) || !is_numeric($loop) || $loop < 1) {
  $loop = 10;
}

$delay = readline('~ Delay (default: 10s) : ');

if (empty($delay) || !is_numeric($delay) || $delay < 0) {
  $delay = 10;
}

for ($i = 0; $i < $loop; $i++) {
  foreach ($accounts as $email) {
    $email = trim($email);
    if (empty($email)) continue;

    $output->writeln('');
    try {
      $giftifan = new Giftifan($email, $password);
      $output->writeln('<comment>' . $email . '</comment>');
    } catch (Exception $e) {
      $output->writeln('<comment>' . $email . '</comment>');
      $output->writeln('└── <error>' . $e->getMessage() . '</error>');
      continue;
    }

    if ($menu === '1') {
      try {
        $giftifan->attendance();
        $output->writeln('├── <info>Attendance completed</info>');
      } catch (Exception $e) {
        $output->writeln('├── <error>' . $e->getMessage() . '</error>');
      }
      $output->writeln('└── Waiting for ' . $delay . ' seconds...');
      sleep($delay);
    } elseif ($menu === '2') {
      try {
        $giftifan->claimAds();
        $output->writeln('├── <info>Claim Ads completed</info>');
      } catch (Exception $e) {
        $output->writeln('├── <error>' . $e->getMessage() . '</error>');
      }
      $output->writeln('└── Waiting for ' . $delay . ' seconds...');
      sleep($delay);
    }
  }
}

$output->writeln('');
