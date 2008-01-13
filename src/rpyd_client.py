#!/usr/bin/env python
import sys
from rpy import r

from rpyd import rpyd
from rpyd.ttypes import Response, Predictor

from thrift import Thrift
from thrift.transport import TSocket
from thrift.transport import TTransport
from thrift.protocol import TBinaryProtocol

if __name__ == "__main__":
  rpyd_server = 'localhost'
  rpyd_port = 9111

  transport = TSocket.TSocket(rpyd_server, rpyd_port)
  transport = TTransport.TBufferedTransport(transport)
  protocol = TBinaryProtocol.TBinaryProtocol(transport)

  client = rpyd.Client(protocol)

  transport.open()

  Y = Response({"name": "response",
                "data": range(3)})

  x0 = Predictor({"name": "x0"})
  x0.data = range(3)

  x1 = Predictor()
  x1.name = "x1"
  x1.data = [1, 1, 2]

  X = [x0, x1]

  model = client.lm(Y, X)
  print "Client: " + str(model)

  transport.close()

