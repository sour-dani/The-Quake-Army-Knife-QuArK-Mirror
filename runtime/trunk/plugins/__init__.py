"""   QuArK  -  Quake Army Knife

Plug-ins Launcher
"""
#
# Copyright (C) 1996-99 Armin Rigo
# THIS FILE IS PROTECTED BY THE GNU GENERAL PUBLIC LICENCE
# FOUND IN FILE "COPYING.TXT"
#

# This code loads files from the "plugins" directory.

#   q_*.py     loaded at start-up
#   map*.py    loaded only when a map editor opens
#   mdl*.py    loaded only when a model editor opens


import os
import quarkx
import quarkpy.qutils

LoadedPlugins = []

def LoadPlugins(beginning):
    for dir in __path__:
        for file in os.listdir(dir):
            f = file.upper()
            if (f[-3:]=='.PY') and (f[:len(beginning)]==beginning):
                quarkx.log("Loading plugin: %s" % (file, ), quarkpy.qutils.LOG_VERBOSE)
                module = __import__(file[:-3], globals(), locals())
                if module not in LoadedPlugins:
                    LoadedPlugins.append(module)
