#This script lists the RMF version of all the RMF-files in the given path.

import os
import struct
import sys

if len(sys.argv) != 2:
	raise RuntimeError("Usage: python %s <path>" % (sys.argv[0], ))
path = sys.argv[1]

for entry in os.scandir(path):
	if os.path.splitext(entry.name)[1] != ".rmf":
		continue
	with open(entry.path, mode="rb") as inFile:
		print()
		print("File:", entry.name)
		print("Version:", struct.unpack("<f", inFile.read(4))[0])
