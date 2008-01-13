#!/usr/bin/env python
import sys
from rpy import r

from rpyd import rpyd
from rpyd.ttypes import Response, Predictor

from thrift.transport import TSocket
from thrift.transport import TTransport
from thrift.protocol import TBinaryProtocol
from thrift.server import TServer

class rpydHandler:
  def __init__(self):
    self.log = {}

  def lm(self, Y, X):
    observations = {}

    # here's where we would handle factors
    for predictor in X:
      observations[predictor.name] = predictor.data

    # get Wilkinson-Rogers notation for model
    wr_model = "%s ~ %s" % (Y.name, " + ".join(observations.keys()))

    # add y to the model
    observations[Y.name] = Y.data

    # fit the model
    model = r.lm(r(wr_model), data = observations)

    return model['coefficients']

  # this doesn't clean up transport; how to get reference to server's transport from handler?
  def shutdown(self):
    sys.exit()

if __name__ == "__main__":
  rpyd_port = 9111

  handler = rpydHandler()
  processor = rpyd.Processor(handler)
  transport = TSocket.TServerSocket(rpyd_port)
  tfactory = TTransport.TBufferedTransportFactory()
  pfactory = TBinaryProtocol.TBinaryProtocolFactory()

  # RPy is NOT thread safe
  server = TServer.TSimpleServer(processor, transport, tfactory, pfactory)

  print "Starting the server..."
  server.serve()
  print "done."


