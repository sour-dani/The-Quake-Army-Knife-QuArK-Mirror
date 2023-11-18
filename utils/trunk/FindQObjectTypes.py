import os

rootPath = "..\\source\\"

#---

classes = {}
classExt = {}

def doDir(dir):
	for item in os.listdir(dir):
		full_itemname = os.path.join(dir, item)
		if os.path.isdir(full_itemname):
			doDir(full_itemname)
		else:
			doFile(full_itemname)

def doFile(filename):
	if not filename.endswith(".pas"):
		return
	if filename.endswith("Bezier - OLD_CNT.pas") or filename.endswith("Bezier - NEW_CNT.pas"):
		return
	Recording = False
	with open(filename, mode="r") as inFile:
		for line in inFile.readlines():
			lineX = line.strip()
			if len(lineX) == 0:
				continue
			elif lineX.startswith("//"):
				continue
			if Recording:
				index = lineX.find("TypeInfo:='")
				if index != -1:
					index += len("TypeInfo:='")
					index2 = lineX.find("'", index)
					if index2 == -1:
						raise RuntimeError("Parse failure!")
					if ClassName in classExt:
						raise RuntimeError("Double entry for %s!" % (ClassName, ))
					classExt[ClassName] = lineX[index:index2]
					Recording = False
				index = lineX.find("Result:='")
				if index != -1:
					index += len("Result:='")
					index2 = lineX.find("'", index)
					if index2 == -1:
						raise RuntimeError("Parse failure!")
					if ClassName in classExt:
						raise RuntimeError("Double entry for %s!" % (ClassName, ))
					classExt[ClassName] = lineX[index:index2]
					Recording = False
				index = lineX.find("result:='")
				if index != -1:
					index += len("result:='")
					index2 = lineX.find("'", index)
					if index2 == -1:
						raise RuntimeError("Parse failure!")
					if ClassName in classExt:
						raise RuntimeError("Double entry for %s!" % (ClassName, ))
					classExt[ClassName] = lineX[index:index2]
					Recording = False
			else:
				if lineX.startswith("class function "):
					index = lineX.find(".TypeInfo")
					if index == -1:
						continue
					ClassName = lineX[len("class function "):index].strip()
					index = lineX.find("TypeInfo:='")
					if index != -1:
						index += len("TypeInfo:='")
						index2 = lineX.find("'", index)
						if index2 == -1:
							raise RuntimeError("Parse failure!")
						if ClassName in classExt:
							raise RuntimeError("Double entry for %s!" % (ClassName, ))
						classExt[ClassName] = lineX[index:index2]
					else:
						Recording = True
				elif lineX.startswith("RegisterQObject("):
					if not lineX.endswith(");"):
						raise RuntimeError("Parse failure!")
					ClassName, FileExt = lineX[len("RegisterQObject("):-len(");")].split(", ")
					FileExt = FileExt.strip().strip("'\"")
					if len(FileExt) != 1:
						raise RuntimeError("Parse failure!")
					if not ord(FileExt) in classes:
						classes[ord(FileExt)] = set()
					if ClassName == "TPolyedre":
						continue
					classes[ord(FileExt)].add(ClassName)
	if Recording:
		print(filename)
		raise RuntimeError("Parse failure!")

doDir(rootPath)
for key in sorted(classes.keys()):
	print()
	print("'%s':" % (chr(key), ))
	for ClassName in sorted(classes[key]):
		print("    %s: '%s'" % (ClassName, classExt[ClassName]))
