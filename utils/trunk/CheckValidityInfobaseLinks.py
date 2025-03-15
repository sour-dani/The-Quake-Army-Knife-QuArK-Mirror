#This script checks that all links to the Infobase actually link to existing Infobase pages.

import os
import sys

if len(sys.argv) != 3:
	raise RuntimeError("Usage: python %s <infobase path> <runtime path>" % (sys.argv[0], ))
pathInfobase = sys.argv[1]
pathRuntime = sys.argv[2]

def checkFile(filename):
	if not filename.endswith(".py"):
		return
	with open(filename, "r") as file:
		for lineNR, line in enumerate(file.readlines()):
			if line.lstrip().startswith("#"):
				continue
			index = line.find(".html")
			if index == -1:
				continue
			if not line[index + len(".html")] in ("|", "\"", "#"):
				continue
			index2a = line.rfind("|", 0, index)
			index2b = line.rfind("\"", 0, index)
			if index2a == -1:
				index2 = index2b
			else:
				if index2b == -1:
					index2 = index2a
				else:
					index2 = max(index2a, index2b)
			if index2 == -1:
				raise RuntimeError("Unable to extract infobase link for \"%s\" on line %i!" % (filename, lineNR + 1))
			infobase_link = line[index2 + len("|"):index + len(".html")] #FIXME: len("|") OR len("\"")
			if not os.path.exists(os.path.join(pathInfobase, "output", infobase_link)):
				print("Possible bad infobase link in \"%s\" on line %i to \"%s\"!" % (filename, lineNR + 1, infobase_link))

def checkDir(path):
	for entry in os.scandir(path):
		if entry.is_dir():
			checkDir(entry.path)
		else:
			checkFile(entry.path)

checkDir(pathRuntime)
#FIXME: How to check links from "source"?
