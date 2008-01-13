<?php

include_once // generated rpyd.php file
include_once // path_to_thrift.'/protocol/TBinaryProtocol.php';
include_once // path_to_thrift.'/transport/TBufferedTransport.php';
include_once // path_to_thrift.'/transport/TSocket.php';

function rpyd_get_rpyd_client() {
  try {
    $rpyd_server = 'localhost';
    $rpyd_port = 9111;

    $sock = new TSocket($rpyd_server, $rpyd_port);
    $trans = new TBufferedTransport($sock);
    $prot = new TBinaryProtocol($trans);

    // Create the client
    $rpyd_client = new rpydClient($prot);

    // Open the transport (we rely on PHP to close it at script termination)
    $trans->open();

    // return rpyd client
    return $rpyd_client;
  } catch (Exception $x) {
    echo 'you should handle this guy.';
  }
}

function rpyd_create_response($name, $data) {
  $resp = new Response;
  $resp->name = $name;
  $resp->data = $data;
  return $resp;
}

function rpyd_create_predictor($name, $data, $is_factor = 0) {
  $pred = new Predictor;
  $pred->name = $name;
  $pred->data = $data;
  $pred->is_factor = $is_factor;
  return $pred;
}

function rpyd_test_client() {
  $rpyd_client = rpyd_get_rpyd_client();
  $Y = rpyd_create_response('Y', array(0, 1, 2));
  $x0 = rpyd_create_predictor('x0', array(0, 1, 2));
  $x1= rpyd_create_predictor('x1', array(1, 1, 2));
  $X = array($x0, $x1);
  $mdl = $rpyd_client->lm($Y, $X);
  print_r($mdl);
}
