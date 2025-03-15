# qdictionnarycheck.py - check for uniqueness in qdictionnary entries

numbers = set()
with open("..\\runtime\\quarkpy\\qdictionnary.py", mode='r') as inFile:
	for lineNR, line in enumerate(inFile.readlines()):
		line = line.strip()
		if line == "":
			#Empty line
			continue
		if line.startswith("#"):
			#Comment line
			continue
		number = line.split(":")
		if len(number) < 2:
			#Not a dictionary entry
			continue
		number = int(number[0])
		if number in numbers:
			print("Duplicate on line: %i" % (lineNR + 1, ))
		else:
			numbers.add(number)
