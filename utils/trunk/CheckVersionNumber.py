# This script checks that the version-numbers set in various files, match.

import os
import sys

if len(sys.argv) != 7:
	raise RuntimeError("Usage: python %s <version major> <version minor> <release> <version patch> <source path> <runtime path>" % (sys.argv[0], ))
version_major, version_minor, version_release, version_patch = sys.argv[1:5]
pathSource = sys.argv[5]
pathRuntime = sys.argv[6]

#Check QConsts.pas
FoundVersion = False
FoundMinorVersion = False
with open(os.path.join(pathSource, "prog", "QConsts.pas"), mode="r") as inFile:
	for line in inFile.readlines():
		lineX = line.strip()
		if lineX.startswith("QuArKVersion"):
			if FoundVersion:
				raise RuntimeError("Duplicated QuArKVersion in QConsts.pas!")
			parts = lineX.split("=")
			if len(parts) != 2:
				raise RuntimeError("Parse failure in QConsts.pas!")
			if not parts[1].endswith(";"):
				raise RuntimeError("Parse failure in QConsts.pas!")
			version = parts[1][:-len(";")].lstrip()
			if not (version.startswith("'") and version.endswith("'")):
				raise RuntimeError("Parse failure in QConsts.pas!")
			version = version[len("'"):-len("'")]
			version_expected = "QuArK %s.%s" % (version_major, version_minor)
			if version != version_expected:
				raise RuntimeError("QConsts.pas version is different. Got '%s', expected '%s'!" % (version, version_expected))
			FoundVersion = True
		elif lineX.startswith("QuArKMinorVersion"):
			if FoundMinorVersion:
				raise RuntimeError("Duplicated QuArKMinorVersion in QConsts.pas!")
			parts = lineX.split("=")
			if len(parts) != 2:
				raise RuntimeError("Parse failure in QConsts.pas!")
			if not parts[1].endswith(";"):
				raise RuntimeError("Parse failure in QConsts.pas!")
			version = parts[1][:-len(";")].lstrip()
			if not (version.startswith("'") and version.endswith("'")):
				raise RuntimeError("Parse failure in QConsts.pas!")
			version = version[len("'"):-len("'")]
			version_expected = "%s %s" % (version_release, version_patch)
			if version != version_expected:
				raise RuntimeError("QConsts.pas version is different. Got '%s', expected '%s'!" % (version, version_expected))
			FoundMinorVersion = True
if not FoundVersion:
	raise RuntimeError("QConsts.pas QuArKVersion not found!")
if not FoundMinorVersion:
	raise RuntimeError("QConsts.pas QuArKMinorVersion not found!")
del FoundVersion
del FoundMinorVersion

#Check QuArK.dof
FoundFileVersion = False
FoundProductVersion = False
with open(os.path.join(pathSource, "QuArK.dof"), mode="r") as inFile:
	for line in inFile.readlines():
		lineX = line.strip()
		index = lineX.find("#")
		if index != -1:
			lineX = lineX[:index].rstrip()
		del index
		if lineX.startswith("FileVersion"):
			if FoundFileVersion:
				raise RuntimeError("Duplicated FileVersion in QuArK.dof!")
			parts = lineX.split("=")
			if len(parts) != 2:
				raise RuntimeError("Parse failure in QuArK.dof!")
			version = parts[1]
			version_expected = "%s.%s.%s.%s" % (version_major, version_minor, version_patch, "0")
			if version != version_expected:
				raise RuntimeError("QuArK.dof FileVersion is different. Got '%s', expected '%s'!" % (version, version_expected))
			FoundFileVersion = True
		elif lineX.startswith("ProductVersion"):
			if FoundProductVersion:
				raise RuntimeError("Duplicated ProductVersion in QuArK.dof!")
			parts = lineX.split("=")
			if len(parts) != 2:
				raise RuntimeError("Parse failure in QuArK.dof!")
			version = parts[1]
			version_expected = "%s.%s (%s-Release)" % (version_major, version_minor, version_release)
			if version != version_expected:
				raise RuntimeError("QuArK.dof ProductVersion is different. Got '%s', expected '%s'!" % (version, version_expected))
			FoundProductVersion = True
if not FoundFileVersion:
	raise RuntimeError("QuArK.dof FileVersion not found!")
if not FoundProductVersion:
	raise RuntimeError("QuArK.dof ProductVersion not found!")
del FoundFileVersion
del FoundProductVersion

#Check defaults.qrk
FoundVersion = False
FoundInternalVersion = False
with open(os.path.join(pathRuntime, "addons", "Defaults.qrk"), mode="r") as inFile:
	for line in inFile.readlines():
		lineX = line.strip()
		if lineX.startswith("Version"):
			if FoundVersion:
				raise RuntimeError("Duplicated Version in Defaults.qrk!")
			parts = lineX.split("=")
			if len(parts) != 2:
				raise RuntimeError("Parse failure in Defaults.qrk!")
			version = parts[1].lstrip()
			if not (version.startswith("\"") and version.endswith("\"")):
				raise RuntimeError("Parse failure in Defaults.qrk!")
			version = version[len("\""):-len("\"")]
			version_expected = "QuArK %s.%s %s %s" % (version_major, version_minor, version_release, version_patch)
			if version != version_expected:
				raise RuntimeError("Defaults.qrk version is different. Got '%s', expected '%s'!" % (version, version_expected))
			FoundVersion = True
		elif lineX.startswith("InternalVersion"):
			if FoundInternalVersion:
				raise RuntimeError("Duplicated InternalVersion in Defaults.qrk!")
			parts = lineX.split("=")
			if len(parts) != 2:
				raise RuntimeError("Parse failure in Defaults.qrk!")
			version = parts[1].lstrip()
			if not (version.startswith("'") and version.endswith("'")):
				raise RuntimeError("Parse failure in Defaults.qrk!")
			version = version[len("'"):-len("'")]
			version_expected = "%s.%s" % (version_major, version_minor)
			if version != version_expected:
				raise RuntimeError("Defaults.qrk version is different. Got '%s', expected '%s'!" % (version, version_expected))
			FoundInternalVersion = True
if not FoundVersion:
	raise RuntimeError("Defaults.qrk Version not found!")
if not FoundInternalVersion:
	raise RuntimeError("Defaults.qrk InternalVersion not found!")
del FoundVersion
del FoundInternalVersion

#Check qdictionnary.py
FoundVersion = False
with open(os.path.join(pathRuntime, "quarkpy", "qdictionnary.py"), mode="r") as inFile:
	for line in inFile.readlines():
		lineX = line.strip()
		index = lineX.find("#")
		if index != -1:
			lineX = lineX[:index].rstrip()
		del index
		if lineX.startswith("0:"):
			if FoundVersion:
				raise RuntimeError("Duplicated Version in qdictionnary.py!")
			parts = lineX.split(":")
			if len(parts) != 2:
				raise RuntimeError("Parse failure in qdictionnary.py!")
			if not parts[1].endswith(","):
				raise RuntimeError("Parse failure in qdictionnary.py!")
			version = parts[1][:-len(",")].lstrip()
			if not (version.startswith("\"") and version.endswith("\"")):
				raise RuntimeError("Parse failure in qdictionnary.py!")
			version = version[len("\""):-len("\"")]
			version_expected = "QuArK %s.%s %s %s" % (version_major, version_minor, version_release, version_patch)
			if version != version_expected:
				raise RuntimeError("qdictionnary.py version is different. Got '%s', expected '%s'!" % (version, version_expected))
			FoundVersion = True
if not FoundVersion:
	raise RuntimeError("qdictionnary.py Version not found!")
del FoundVersion
