<?php
/**
 * build.php description
 *
 * @author    Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
 * @date      2015-11-09
 * @version   $Id$
 * @copyright Copyright (c) 2015 Interactive Data Managed Solutions Ltd.
 */

$projectRoot     = dirname(dirname(__FILE__));
$buildRoot       = __DIR__;
$pharFileName    = 'wp-query-builder.phar';
$pharFileAbsPath = $buildRoot . "/$pharFileName";


/**
 * Excluded dirs
 */
$excludeDirs = array(
    '.git',
    'tests',
    'build',
    'docs',
);
/**
 * Excluded files
 */
$excludeFiles = array(
    'LICENCE.txt',
    '.coveralls.yml',
    'composer.lock',
    '.gitignore',
    '.travis.yml',
    'composer.json',
    'README.md',
    '.gitattributes',
    'LICENCE',
);

/**
 * Filter to use with Dir Iterator
 *
 * @param SplFileInfo                     $file
 * @param mixed                           $key
 * @param RecursiveCallbackFilterIterator $iterator
 *
 * @return bool True if you need to recurse or if the item is acceptable
 */
$fileFilter =
    function ($file, $key, $iterator) use ($excludeDirs, $excludeFiles)
    {
        if ($iterator->hasChildren()
            && !in_array(
                $file->getFilename(), $excludeDirs
            )
        )
        {
            return true;
        }

        return $file->isFile()
               && !in_array(
            $file->getFilename(), $excludeFiles
        );
    };


$p = new Phar(
    $pharFileName,
    FilesystemIterator::CURRENT_AS_FILEINFO
    | FilesystemIterator::KEY_AS_FILENAME
);

$p->startBuffering();

$p->setDefaultStub('vendor/autoload.php', 'vendor/autoload.php');

if (file_exists($pharFileAbsPath) && is_readable($pharFileAbsPath))
{
    unlink($pharFileAbsPath);
}

$gzFile = $pharFileAbsPath . '.gz';
if (file_exists($gzFile) && is_readable($gzFile))
{
    unlink($gzFile);
}

$innerIterator = new RecursiveDirectoryIterator(
    $projectRoot, RecursiveDirectoryIterator::SKIP_DOTS
);

$iterator = new RecursiveIteratorIterator(
    new RecursiveCallbackFilterIterator($innerIterator, $fileFilter)
);

$p->buildFromIterator($iterator, $projectRoot);

$p->compress(Phar::GZ);

$p->stopBuffering();
