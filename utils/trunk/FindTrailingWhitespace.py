#This script lists all text-lines that have trailing whitespace.
#Most trailing whitespaces are simply mistakes, needlessly taking up bytes. So let's remove them!

import os
import sys

if len(sys.argv) != 2:
	raise RuntimeError("Usage: python %s <runtime path>" % (sys.argv[0], ))
path = sys.argv[1]

def doDir(path):
	for entry in os.scandir(path):
		if entry.is_dir():
			doDir(entry.path)
		else:
			doFile(entry.path)

def doFile(path):
	if os.path.splitext(path)[1] not in set({".qrk", ".py", ".txt"}):
		return
	if path.endswith(".qrk"):
		with open(path, "rb") as file:
			header = file.read(8)
		if header == b"QQRKBIN1":
			#Binary qrk file; skip it!
			return
	with open(path, "r", encoding="ANSI") as file:
		for lineNR, line in enumerate(file.readlines()):
			lineX = line.rstrip("\r\n")
			if lineX.endswith(" ") or lineX.endswith("\t"):
				print("Trailing whitespace in file %s on line %i!" % (path, lineNR + 1))

doDir(path)
