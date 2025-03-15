#This script lists the line endings for all the static website pages.

import os
import sys

if len(sys.argv) != 2:
	raise RuntimeError("Usage: python %s <website path>" % (sys.argv[0], ))
path = sys.argv[1]

def DoDir(pathname):
	for entry in os.scandir(pathname):
		if entry.is_dir():
			DoDir(entry.path)
		else:
			DoFile(entry.path)

def DoFile(filename):
	if os.path.splitext(filename)[1] not in set({".txt", ".php", ".html", ".htm"}):
		return
	GotCR = False
	GotLF = False
	with open(filename, mode="rb") as inFile:
		while True:
			c = inFile.read(1)
			if len(c) == 0:
				break
			if (c == b'\x0A'):
				GotCR = True
			elif (c == b'\x0D'):
				GotLF = True
	if GotCR:
		if GotLF:
			print("%s: CRLF" % (filename, ))
		else:
			pass #print("%s: CR" % (filename, ))
	else:
		if GotLF:
			print("%s: LF" % (filename, ))
		else:
			print("%s: ??" % (filename, ))

DoDir(path)
