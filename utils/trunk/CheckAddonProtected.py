#This script checks that the QuArKProtected-flag is set on all official QuArK addon files.

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
			if os.path.splitext(entry.name)[1] != ".qrk":
				#Not a QRK file
				continue
			if entry.name.startswith("UserData"):
				#Userdata files are writable
				continue
			doFile(entry.path)

def doFile(path):
	with open(path, "rb") as file:
		header = file.read(8)
	if header == b"QQRKBIN1":
		#Binary qrk file; skip it!
		return
	FoundIt = False
	with open(path, "r") as file:
		for line in file.readlines():
			if line.strip() in set({'QuArKProtected = "1"', 'QuArKProtected = "1"       // Additional user warnings to prevents accidental change of this file'}):
				FoundIt = True
				break
			if line.find('QuArKProtected') != -1:
				print("WARNING: Line contains QuArKProtected, but looks suspicious (%s)..." % (path, ))
				FoundIt = True
				break
	if not FoundIt:
		print("WARNING: File %s is not protected!" % (path, ))

doDir(os.path.join(path, "addons"))
