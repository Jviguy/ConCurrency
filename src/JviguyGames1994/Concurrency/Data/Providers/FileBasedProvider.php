<?php


namespace JviguyGames1994\Concurrency\Data\Providers;


abstract class FileBasedProvider extends Provider
{
    /** @var $glob string the path to the glob location */
    public $glob;
    /** @var $files File[] */
    public $files;
    /** @var $path string the path to the users data */
    public $path;
}