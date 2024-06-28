"""   QuArK  -  Quake Army Knife

Entity functions.
"""
#
# Copyright (C) 1996-99 Armin Rigo
# THIS FILE IS PROTECTED BY THE GNU GENERAL PUBLIC LICENCE
# FOUND IN FILE "COPYING.TXT"
#

import quarkx

entfn = {}

def RegisterEntityConverter(Text, Ext, Desc, Proc):
    if Proc is None:
        #squawk("this is not a valid entity converter")
        return
    entfn[Text] = (Proc, Ext, Desc)
    quarkx.entitymenuitem(Text)
