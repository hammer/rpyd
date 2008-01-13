#!/usr/bin/env python

# requires rpy, thrift, fb303

from distutils.core import setup

setup(name = 'rpyd',
      version = '0.0.1',
      description = 'rpyd',
      author = 'Jeff Hammerbacher',
      author_email = 'hammer@facebook.com',
      url = 'http://www.jeffhammerbacher.com',
      package_dir = {'': 'lib/py'},
      packages = ['rpyd'])
