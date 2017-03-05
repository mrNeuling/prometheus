<?php

class Cache {

    private $dir;
    // Added extension for windows support
    private $extension = ".cache";

    public function __construct($dir) {
        $this->dir = $dir;
    }

    public function has($key) {
        if (is_file($this->dir . '/cache/' . $key . $extension)) {
            return true;
        }

        return false;
    }

    public function get($key) {
        return unserialize(file_get_contents($this->dir . '/cache/' . $key . $extension));
    }

    public function put($object, $key) {
        $content = serialize($object);
        return file_put_contents($this->dir . '/cache/' . $key . $extension, $content);
    }
}

return new Cache(__DIR__);