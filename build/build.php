#!/usr/bin/env php
<?php
/**
 * build.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-09
 * @version   $Id$
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

$projectRoot     = dirname( dirname( __FILE__ ) );
$buildRoot       = __DIR__;
$pharFileName    = 'wp-query-builder.phar';
$pharFileAbsPath = "{$buildRoot}/{$pharFileName}";


/**
 * Excluded dirs
 */
$excludeDirs = array(
    '.git',
    'build',
    'docs',
    'tests',
    '.idea'
);

/**
 * Excluded files
 */
$excludeFiles = array(
    '.coveralls.yml',
    '.gitattributes',
    '.gitignore',
    '.travis.yml',
    'composer.json',
    'composer.lock',
    'licence',
    'licence.txt',
    'license',
    'license.txt',
    'readme',
    'readme.md',
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
$fileFilter = function ( $file, $key, $iterator ) use ( $excludeDirs, $excludeFiles ) {
    if ( $iterator->hasChildren() && ! in_array( strtolower( $file->getFilename() ), $excludeDirs ) ) {
        return true;
    }

    return $file->isFile() && ! in_array( strtolower( $file->getFilename() ), $excludeFiles );
};


$p = new Phar( $pharFileName, FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::KEY_AS_FILENAME );

$p->startBuffering();

$p->setDefaultStub( 'vendor/autoload.php', 'vendor/autoload.php' );

if ( file_exists( $pharFileAbsPath ) && is_readable( $pharFileAbsPath ) ) {
    unlink( $pharFileAbsPath );
}

$gzFile = $pharFileAbsPath . '.gz';
if ( file_exists( $gzFile ) && is_readable( $gzFile ) ) {
    unlink( $gzFile );
}

$indexFilePath   = "{$projectRoot}/index.php";
$indexFileHandle = fopen( $indexFilePath, 'w' );

fwrite( $indexFileHandle, "<?php if(defined('WPINC')) require_once 'vendor/autoload.php';" );

fclose( $indexFileHandle );

$innerIterator = new RecursiveDirectoryIterator( $projectRoot, RecursiveDirectoryIterator::SKIP_DOTS );

$iterator = new RecursiveIteratorIterator( new RecursiveCallbackFilterIterator( $innerIterator, $fileFilter ) );

$p->buildFromIterator( $iterator, $projectRoot );

$p->compress( Phar::GZ );

$p->stopBuffering();

if ( file_exists( $indexFilePath ) && is_readable( $indexFilePath ) ) {
    unlink( $indexFilePath );
}