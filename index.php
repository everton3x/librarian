<?php

require_once 'src/librarian.php';

librarian\import('hello')->from('sample_lib.*');

hello_mars();
hello_venus();
