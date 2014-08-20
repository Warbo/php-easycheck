<?php

require_once(__DIR__ . '/vendor/autoload.php');

$run = key_map(function($name, $test) {
                 echo "Checking {$name}: ";
                 if ($result = $test()) {
                   var_dump($result);
                   die();
                 }
                 echo "Passed\n";
               });
$run(array('sample counts correctly' => function() {
              $n      = abs(mt_rand()) & 255;
              $result = sample(function() { return null; }, $n);

              return ($result === array_fill(0, $n, null))? 0
                                                          : get_defined_vars();
            },

            'truthy tests fail' => function() {
              deftest(0, function() { return true; });
              $results = runtests(null);
              return (array(true) === $results)? 0 : get_defined_vars();
            }));
