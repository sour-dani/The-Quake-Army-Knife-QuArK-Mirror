#This script checks that there are no blocks of NULL-bytes in any of the files.
#This can happen when file transfers go wrong, or randomly when sharing folders between VMs.
#Note: In rare cases, a file may validly have such blocks, so carefully check whether all files reported are really corrupt!

import os
import sys

if len(sys.argv) != 2:
	raise RuntimeError("Usage: python %s <runtime path>" % (sys.argv[0], ))
path = sys.argv[1]

block_size = 1024
search_pattern = b"\x00" * 16

BinaryFiles = set({".exe", ".dll", ".bmp", ".png", ".jpg", ".gif"})

def checkFile(filename):
	global search_pattern
	with open(filename, "rb") as inFile:
		while True:
			buffer = inFile.read(block_size)
			if len(buffer) == 0:
				break
			if search_pattern in buffer:
				print("WARNING: NULLs found in file: \"%s\"!" % (filename, ))
				break

def checkDir(dirname):
	for entry in os.scandir(dirname):
		if entry.is_dir():
			checkDir(entry.path)
		else:
			if os.path.splitext(entry.name)[1] in BinaryFiles:
				continue
			checkFile(entry.path)

checkDir(path)
