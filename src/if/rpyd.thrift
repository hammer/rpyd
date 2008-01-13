#!/usr/local/bin/thrift -py
include "fb303.thrift"

cpp_namespace thrift.rpyd

struct Response
{
  1: string name,
  2: list<double> data
}

struct Predictor
{
  1: string name,
  2: bool is_factor = 0,
  3: list<double> data
}

exception RegressionError {
  1: i32 what,
  2: string why
}

service rpyd extends fb303.FacebookService {
   map<string, double> lm(1: Response Y, 2: list<Predictor> X) throws (1: RegressionError ouch)
}
