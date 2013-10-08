<?php

namespace Markdowner;

use \Michelf\Markdown;

class App extends \Slim\Slim {
    private $basePath = '../docs';
    public $docMap = array();

    public function __construct($options) {
        parent::__construct($options);

        $this->findAllDocs();
        $this->initialize();
    }

    public function findDocs($path) {
        $result = array();

        if (!is_readable($path) || !is_dir($path)) {
            return array();
        }

        if ($handle = opendir($path)) {

            while (false !== ($entry = readdir($handle))) {
                if ($entry[0] != '.') {
                    if (is_dir($path.'/'.$entry)) {
                        $docs = $this->findDocs($path.'/'.$entry);
                        foreach ($docs as $key => $value) {
                            $result[] = $value;
                        }
                    } else {
                        $info = pathinfo($entry);
                        if (strtolower($info['extension']) == 'md') {
                            $result[] = $path.'/'.$entry;
                        }
                    }
                }
            }

            closedir($handle);
        }

        return $result;
    }

    public function findAllDocs() {
        if (is_readable('../README.md')) {
            $this->docMap['/'] = '../README.md';
        } elseif(is_readable('../README')) {
            $this->docMap['/'] = '../README';
        } else {
            $this->docMap['/'] = NULL;
        }

        $docs = $this->findDocs($this->basePath);

        foreach ($docs as $doc) {
            $this->docMap[substr($doc, strlen($this->basePath))] = $doc;
        }
    }

    public function initialize() {
        $app = $this;

        $app->get('/(:path+)', function($path = '/') use ($app) {
            if (is_array($path)) {
                $path = '/'.implode('/', $path);
            }

            $app->render('doc.php', array(
                'content' => $app->getText($path),
                'docMap' => $app->docMap,
                'path' => $path
            ));
        });
    }

    public function getText($uri) {
        $path = $this->docMap[$uri];

        if (empty($path)) {
            return '';
        }

        $text = file_get_contents($path);
        return Markdown::defaultTransform($text);
    }

    public function run() {
        parent::run();
    }
}