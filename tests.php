<?php

require_once(__DIR__ . '/vendor/autoload.php');

key_map(function($name, $test) {
          echo "Checking {$name}: ";
          if ($result = $test()) {
            var_dump($result);
            die();
          }
          echo "Passed\n";
        },
        array(

  'sample counts correctly' => function() {
    $n      = abs(mt_rand()) & 255;
    $result = sample(function() { return null; }, $n);

    return ($result === array_fill(0, $n, null))? 0 : get_defined_vars();
  },

  'truthy tests fail' => function() {
    $result = runtests(function() { return true; });
    return (count($result) === 0)? 0 : get_defined_vars();
  },

  'falsy tests pass' => function() {
    $pre = runtests(null);
    deftest('falsy', function() {});
                       $results = array_diff_key(runtests(null), $pre);
                       return (array() === $results)? 0 : get_defined_vars();
  }));
