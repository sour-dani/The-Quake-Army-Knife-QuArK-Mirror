#This script lists the BSP header signature of all the BSP-files in the given path.

import os
import struct
import sys

if len(sys.argv) != 2:
	raise RuntimeError("Usage: python %s <path>" % (sys.argv[0], ))
path = sys.argv[1]

for entry in os.scandir(path):
	if os.path.splitext(entry.name)[1] not in set({".bsp", ".d3dbsp"}):
		continue
	with open(entry.path, mode="rb", buffering=0) as inFile:
		inFile.seek(0, os.SEEK_END)
		size = inFile.tell()
		if size < 8:
			print("WARNING: %s is too small!" % (entry.name, ))
			continue
		inFile.seek(0, os.SEEK_SET)
		data = inFile.read(4)
		signatureStr = struct.unpack("4s", data)[0]
		signatureInt = struct.unpack("I", data)[0]
		version = struct.unpack("I", inFile.read(4))[0]
	print("%s: %s (0x%08x) - Version: 0x%08x" % (entry.name, signatureStr, signatureInt, version))
