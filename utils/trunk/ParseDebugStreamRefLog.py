#This script parses the DebugStreamRef log file.

import os
import sys

if len(sys.argv) != 2:
	raise RuntimeError("Usage: python %s <runtime path>" % (sys.argv[0], ))
path = sys.argv[1]

data = []
with open(os.path.join(path, "DebugStreamRef.log"), mode="r") as inFile:
	for line in inFile.readlines():
		action, rest = line.rstrip("\r\n").split(" ", 1)
		if action == "Close":
			handle = rest
			rest = ""
			filename = ""
		else:
			handle, rest = rest.split(": ", 1)
			if action != "Open":
				refcount, rest = rest.split(" ", 1)
				filename = ""
			else:
				refcount = 0
				filename = rest
				rest = ""
		if int(handle) == 0:
			#Skip it!
			continue
		data.append((action, int(handle), int(refcount), filename, rest))

# Track one file
handle_to_track = -1
for line in data:
	action, handle, refcount, filename, rest = line
	if (action == "Open") and (filename == "Z:\Kingpin\main\Pak0.pak"):
		handle_to_track = handle
		continue
	if handle != handle_to_track:
		continue
	#print(action, refcount)

# Find leaks
refs = {}
for line in data:
	action, handle, refcount, filename, rest = line
	if action == "Open":
		refs[handle] = [filename, refcount]
	elif (action == "AddRef") or (action == "AddRefNode"):
		refs[handle][1] += 1
	elif action == "Release":
		refs[handle][1] -= 1
	elif action == "Close":
		if refs[handle][1] != 0:
			print("REFCOUNT failure!", refs[handle][0])
	else:
		raise RuntimeError("Unknown 'action'")
for ref in refs.values():
	if ref[1] != 0:
		print("REFCOUNT leak!", ref[0])
