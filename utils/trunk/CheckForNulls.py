import os

path = "..\\Copy of runtime"
path = "C:\\Program Files (x86)\\QuArK 6.6"

block_size = 1024
search_pattern = b"\x00" * 16

BinaryFiles = set({".exe", ".dll", ".bmp", ".png", ".jpg"})

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
