#This script can be run over a 'runtime' directory, and it removes all CVS files, and CVS information from text files.
#WARNING: Be careful! Many files get modified or deleted! Make sure you run it over the right directory!

import os
import shutil
import sys

if len(sys.argv) != 2:
	raise RuntimeError("Usage: python %s <runtime path>" % (sys.argv[0], ))
path = sys.argv[1]

def DoFile(filename):
	if (os.path.splitext(filename)[1] != ".py") and (os.path.splitext(filename)[1] != ".txt") and (os.path.splitext(filename)[1] != ".qrk"):
		#Not a file we want/need to handle!
		return

	lines = []
	with open(filename, mode="r") as inFile
		for line in inFile.readlines():
			lines.append(line)

	def getLinesToRemove(lines, identifier):
		whatLines = []
		lineIdentifier = -1
		for i, line in enumerate(lines):
			if line.find(identifier) != -1:
				lineIdentifier = i
				break
		if lineIdentifier != -1:
			index = lines[lineIdentifier].find(identifier)
			#Everything in front of the identifier is the prepend-marker to use to figure out the size of the CVS information block.
			marker = lines[lineIdentifier][:index]
			if len(marker) != 0:
				i = lineIdentifier - 1
				while (i >= 0) and (lines[i].startswith(marker)):
					i -= 1
				startOfBlock = i + 1
				i = lineIdentifier + 1
				while (i < len(lines)) and (lines[i].startswith(marker)):
					i += 1
				endOfBlock = i - 1
				for i in range(startOfBlock, endOfBlock + 1):
					whatLines.append(i)
			else:
				whatLines.append(lineIdentifier)
		return whatLines

	removeLines = []
	removeLines += getLinesToRemove(lines, "$Id:")
	removeLines += getLinesToRemove(lines, "$Header")
	removeLines += getLinesToRemove(lines, "$Log")
	removeLines += getLinesToRemove(lines, "# ----------- REVISION HISTORY ------------") #Special case: This line too!
	if len(removeLines) != 0:
		with open(filename, mode="w") as outFile:
			for i, line in enumerate(lines):
				if not i in removeLines:
					outFile.write(line)

def DoDir(path):
	for entry in os.scandir(path):
		if entry.is_dir():
			if entry.name == "CVS":
				shutil.rmtree(entry.path)
			else:
				DoDir(entry.path)
		else:
			if entry.name in set({".cvsignore", ".project"}):
				os.remove(entry.path)
			else:
				DoFile(entry.path)

raw_input("This will modify files and may delete entire directories in the given path! Are you sure? (BREAK the script if not!)")
DoDir(path)
