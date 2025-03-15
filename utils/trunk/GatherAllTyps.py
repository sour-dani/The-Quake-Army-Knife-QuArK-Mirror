#This script lists all "Typ"-specifics that are in use.

import os
import sys

if len(sys.argv) != 2:
	raise RuntimeError("Usage: python %s <runtime path>" % (sys.argv[0], ))
path = sys.argv[1]

allTyps = set()
allClasses = set()

def doFile(filename):
	if os.path.splitext(filename)[1] != ".qrk":
		return
	with open(filename, "r") as inFile:
		oldLine = ""
		rememberLine = ""
		for lineNR, line in enumerate(inFile.readlines()):
			lineX = line.strip()
			if len(lineX) == 0:
				continue
			if lineX.startswith("{"):
				rememberLine = oldLine
			oldLine = lineX
			if not lineX.startswith("Typ"):
				continue
			lineX = lineX[len("Typ"):].lstrip()
			if not lineX.startswith("="):
				continue
			lineX = lineX[len("="):].lstrip()
			lineX = lineX.split("//", 1)[0].rstrip()
			if not (lineX.startswith("\"") and lineX.endswith("\"")):
				raise RuntimeError("Parse failure!")
			lineX = lineX[len("\""):-len("\"")]
			if len(lineX) == 0:
				print(filename, line)
				raise RuntimeError("Parse failure!")
			allTyps.add(lineX)
			if lineX.startswith("LN"):
				if not rememberLine.endswith("="):
					raise RuntimeError("Parse failure!")
				rememberLine = rememberLine[:-len("=")].rstrip()
				if not rememberLine.endswith(":"):
					raise RuntimeError("Parse failure!")
				rememberLine = rememberLine[:-len(":")].rstrip()
				#print(filename, lineNR + 1, rememberLine)
				allClasses.add(rememberLine)
	return

def doDir(path):
	for entry in os.scandir(path):
		if entry.is_dir():
			doDir(entry.path)
		else:
			doFile(entry.path)

doDir(os.path.join(path, "addons"))
print("Typ:")
print("\n".join(sorted(allTyps)))
print()
print("Classes:")
print("\n".join(sorted(allClasses)))
