<?php

set_error_handler(function() {
    var_dump(array('args'  => func_get_args(),
                   'trace' => debug_backtrace()));
    die();
});

defun('sample', function($f, $n) {
                  return array_map($f, up_to($n));
                });

defuns(call_user_func(function() {
  $tests = array();
  $run   = function($t) {
             return call_user_func_array($t[0], sample('random', $t[1]));
           };

  return array('deftest'  => function($name, $test) use (&$tests) {
                               $tests[$name] = array($test, arity($test));
                             },

               'runtests' => function($_) use (&$tests, $run) {
                               return array_filter(array_map($run, $tests));
                             },

               'deftests' => key_map('deftest'));
}));
