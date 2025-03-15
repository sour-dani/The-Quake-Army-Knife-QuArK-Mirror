#This script lists the character encoding of all Infobase HTML pages.

import chardet
import os
import sys

if len(sys.argv) != 2:
	raise RuntimeError("Usage: python %s <infobase path>" % (sys.argv[0], ))
path = sys.argv[1]

def checkDir(path):
	for entry in os.scandir(path):
		if entry.is_dir():
			checkDir(entry.path)
		else:
			checkFile(entry.path)

def checkFile(filename):
	#FIXME: Filter files:
	if not filename.endswith(".txt"):
		return
	with open(filename, "rb") as inFile:
		charset = chardet.detect(inFile.read())
		print("%s: %s" % (filename, charset['encoding']))

checkDir(path)
