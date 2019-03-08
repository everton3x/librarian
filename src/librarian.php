<?php

namespace librarian;

function import(string ...$modules)
{
    
    $obj = new class
    {
        public $modules = ['*'];
        
        public function from(string $package): void
        {
            $base_dir = $this->packageToPath($package);
            $scan = ($this->isRecursive($package))? $this->scanRecursive($base_dir) : $this->scan($base_dir);
            
            foreach ($this->modules as $module) {
                $pattern = ($module === '*')? "/\.php/": "/{$module}\.php/";
                reset($scan);
                foreach ($scan as $key => $filepath) {
                    if(preg_match($pattern, $filepath)) {
                        require_once realpath($filepath);
                        unset($scan[$key]);
                    }
                }
            }
        }
        
        protected function isRecursive(string $package): bool
        {
            return (substr($package, -1, 1) === '*')? true : false;
        }
        
        protected function packageToPath(string $package): string
        {
            return str_replace('*', '', str_replace('.', DIRECTORY_SEPARATOR, $package));
        }
        
        protected function scanRecursive(string $base_dir): array
        {
            $scan = [];
            $it = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($base_dir));
            $it->rewind();
            while ($it->valid()) {
                if($it->isFile()) {
                    $scan[] = $it->getPathname();
                }
                $it->next();
            }
            return $scan;
        }
        
        protected function scan(string $base_dir): array
        {
            $scan = [];
            $it = new \DirectoryIterator($base_dir);
            $it->rewind();
            foreach ($it as $fileinfo) {
                if($fileinfo->isFile()) {
                    $scan[] = $it->getPathname();
                }
            }
            return $scan;
        }
    };
    
    if($modules) {
        $obj->modules = $modules;
    }
    
    return $obj;
}
