#This script checks that there are no unexpected files present, or expected files missing in the release.

import os
import sys

if len(sys.argv) != 2:
	raise RuntimeError("Usage: python %s <runtime path>" % (sys.argv[0], ))
path = sys.argv[1]

if os.path.exists(os.path.join(path, ".svn")):
	print("WARNING: SVN directory found: %s" % (os.path.join(path, ".svn"), ))

if os.path.exists(os.path.join(path, "Setup.qrk")):
	print("WARNING: Setup.qrk file found: %s" % (os.path.join(path, "Setup.qrk"), ))

if os.path.exists(os.path.join(path, "QUARK.LOG")):
	print("WARNING: QuArK log file found: %s" % (os.path.join(path, "QUARK.LOG"), ))

if not os.path.exists(os.path.join(path, "help")):
	print("WARNING: Help directory missing: %s" % (os.path.join(path, "help"), ))

if not os.path.exists(os.path.join(path, "QuArK.exe")):
	print("WARNING: QuArK executable missing: %s" % (os.path.join(path, "QuArK.exe"), ))

if os.path.exists(os.path.join(path, "QuArK.map")):
	print("WARNING: QuArK executable debug mapping found: %s" % (os.path.join(path, "QuArK.map"), ))

for entry in os.scandir(os.path.join(path, "plugins")):
	if entry.is_dir():
		print("WARNING: Unexpected directory: %s" % (entry.path, ))
		continue
	if entry.name == ".svn":
		print("WARNING: SVN directory found: %s" % (entry.path, ))
		continue
	if entry.name.endswith(".pyc"):
		print("WARNING: Compiled Python file found: %s" % (entry.path, ))
		continue

for entry in os.scandir(os.path.join(path, "quarkpy")):
	if entry.is_dir():
		print("WARNING: Unexpected directory: %s" % (entry.path, ))
		continue
	if entry.name == ".svn":
		print("WARNING: SVN directory found: %s" % (entry.path, ))
		continue
	if entry.name.endswith(".pyc"):
		print("WARNING: Compiled Python file found: %s" % (entry.path, ))
		continue
