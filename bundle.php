<?php

$pharfile = 'giftifan.phar';
if (file_exists($pharfile)) {
    unlink($pharfile);
}

$phar = new Phar($pharfile);
$phar->startBuffering();
$phar->buildFromDirectory(__DIR__, '/\.(php|json|yml|env|flf)$/');
$phar->setStub($phar->createDefaultStub('index.php'));
$phar->compressFiles(Phar::GZ);
$phar->stopBuffering();

echo "Phar file created successfully: $pharfile\n";
echo "You can now run the bot using: php $pharfile\n";