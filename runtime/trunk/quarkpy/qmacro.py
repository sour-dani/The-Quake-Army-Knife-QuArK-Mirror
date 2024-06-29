"""   QuArK  -  Quake Army Knife

Python macros available for direct call by QuArK
"""
#
# Copyright (C) 1996-2000 Armin Rigo
# THIS FILE IS PROTECTED BY THE GNU GENERAL PUBLIC LICENCE
# FOUND IN FILE "COPYING.TXT"
#

#
# Macros are called by QuArK based on name. These are the
# only direct calls that QuArK can make to Python. Usually,
# Python provides callback to QuArK.
#


import quarkx
import dialogboxes
import qutils

#
# Macros called when there is an object to display in a window.
#

def MACRO_displaymap(self, what=None):
    "Called when there is a map to display."
    import qutils
    qutils.loadmapeditor(what)
    import mapeditor
    if isinstance(self.info, mapeditor.MapEditor):
        self.info.ReopenRoot(self)
    else:
        mapeditor.MapEditor(self)   # new map editor

def MACRO_displaybsp(self):
    MACRO_displaymap(self,'bsp')


def MACRO_displaymdl(self):
    "Called when there is a model to display."
    import qutils
    qutils.loadmdleditor()
    import mdleditor
    if isinstance(self.info, mdleditor.ModelEditor):
        self.info.ReopenRoot(self)
    else:
        mdleditor.ModelEditor(self)   # new model editor



#
# Macro called when QuArK needs the images of a Duplicator.
#

def MACRO_duplicator(dup):
    "Computes Duplicator images."
    import qutils
    if quarkx.setupsubset(qutils.SS_MAP, "Options")["IgnoreDup"]:
        return []

    qutils.loadmapeditor()
    import mapduplicator
    items = mapduplicator.DupManager(dup).buildimages()
    return items


#
# Macro called when a linear operation is applied.
#

def MACRO_applylinear(entity, matrix):
    "Applies a linear distortion (rotate, zoom, etc) on an entity or a Duplicator."
    # Note : "origin" is updated by QuArK before it calls this macro.
    import qutils
    qutils.loadmapeditor()
    import mapentities
    mapentities.CallManager("applylinear", entity, matrix)


#
# Macro called when the mouse is over a control with a hint
#

def MACRO_hint(form, text=None):
    if form is None:
        return ""
    import qbaseeditor
    if not isinstance(form.info, qbaseeditor.BaseEditor):
        return
    return form.info.showhint(text)


#
# Macro called to build a map (when the big GO! button is pressed).
#

def MACRO_buildmaps(maps, mode, extracted, cfgfile="", defaultbsp=None):
    "Builds maps and runs Quake."

    if mode is None:
        code = "P"
        text = "Play"
    else:
        code = quarkx.buildcodes[mode]
        text = quarkx.buildmodes[mode]
    forcepak = "K" in code
    runquake = "P" in code
    build = quarkx.newobj(":")

    if "C" in code:                #
        build["Textures"] = "1"    # Complete rebuild
        build["QCSG1"] = "1"       #
        build["QBSP1"] = "1"
        build["VIS1"] = "1"
        build["LIGHT1"] = "1"
        build["LIGHTCmd"] = "-extra"

    elif "F" in code:              #
        build["Textures"] = "1"    # Fast rebuild
        build["QCSG1"] = "1"       #
        build["QBSP1"] = "1"

    else:                          #
        pass                       # Don't build maps
                                   #
    maplist = []
    for map in maps:
        root = map['Root']
        if root is None: continue
        root = map.findname(root)
        if root is None: continue
        maplist.append((map, root, build))

    import qutils
    qutils.loadmapeditor()
    import mapquakemenu
    mapquakemenu.RebuildAndRun(maplist, None, runquake, text, forcepak, extracted, cfgfile, defaultbsp)



#
# Macro called to "pack" a model.
#

def MACRO_pack_model(model):
    import mdlpack
    return mdlpack.PackModel(model)

#
# Macro called when a model component is modified.
#

def MACRO_update_model(component):
    import mdlpack
    mdlpack.UpdateModel(component)


#
# Macro called when an item in the '?' menu is selected.
#

helpfn = {}
def MACRO_helpmenu(text):
    import qeditor
    getattr(qeditor, helpfn[text])()




def MACRO_pybutton(pybtn):
    dlg = dialogboxes.dialogboxes[pybtn["sendto"]]
    return dlg.info.buttons[pybtn.shortname]

def MACRO_makeaddon(self):
    a = quarkx.getqctxlist()
    a.reverse()
    i = 0
    while (a[i]["GameDir"] == None):
        i = i + 1
        if i == len(a):
            raise RuntimeError("No GameDir found")
    a[i].makeentitiesfromqctx()

def MACRO_makeaddon_tex(self):
    a = quarkx.getqctxlist()
    a.reverse()
    i = 0
    while (a[i]["GameDir"] == None):
        i = i + 1
        if i == len(a):
            raise RuntimeError("No GameDir found")
    a[i].maketexturesfromqctx()

def MACRO_loadentityplugins(self):
    import plugins
    plugins.LoadPlugins("ENT")
    global MACRO_loadentityplugins
    MACRO_loadentityplugins = lambda x: None    # next calls to loadmdleditor() do nothing

def MACRO_loadmdlimportexportplugins(self):
    import plugins
    plugins.LoadPlugins("IE_")
    # Fill the importer menu with menu items
    orderedlist = mdlimportmenuorder.keys()
    orderedlist.sort()
    for menuindex in orderedlist:
        for importer in mdlimportmenuorder[menuindex]:
            quarkx.mdlimportmenu(importer)
    global MACRO_loadmdlimportexportplugins
    MACRO_loadmdlimportexportplugins = lambda x: None    # next calls to loadmdleditor() do nothing

### A list, used below, to pass items to for the main QuArK menu Conversion section.
### See the plugins files that start with "ent" for its use.


def MACRO_ent_convertfrom(text):
    # Decker - Some menuitem-captions contains a '&'-character (you know, the one which tells what mnemonic-key can be used)
    # These '&'-characters has to be removed, for the entfn[text] to work properly.
    text = text.replace("&", "")

    import qeditor
    a = quarkx.getqctxlist()
    a.reverse()

    import qentbase
    Proc, Ext, Desc = qentbase.entfn[text]
    if Ext is not None:
        files = quarkx.filedialogbox("Select File", text, [Ext, Desc])
        if len(files) != 0:
            file = files[0]
            gn = a[0]["GameDir"]
            if (gn is None) or (gn == ""):
                gn = file
            Proc(a[0].parent, file, gn)
    else:
        Proc(a[0].parent)

### A list, used below, to pass items to for the main QuArK menu 'Model Importers' section.
### See the plugins files that start with "ie_" for its use.
mdlimport = {}
mdlimportmenuorder = {}

def MACRO_mdl_pythonimporter(text):
    import qeditor
    a = quarkx.getqctxlist()
    a.reverse()

    # Decker - Some menuitem-captions contains a '&'-character (you know, the one which tells what mnemonic-key can be used)
    # These '&'-characters has to be removed, for the entfn[text] to work properly.
    text = text.replace("&", "")

    mdlf = mdlimport[text]
    if mdlf is not None and mdlf[0][0] is not None:
        files = quarkx.filedialogbox("Select File", text, mdlf[0])
        if len(files) != 0:
            filename = files[0]
            gamename = a[0]["GameDir"]
            if (gamename is None) or (gamename == ""):
                gamename = filename
            mdlf[1](a[0].parent, filename, gamename)
    if mdlf[0][0] is None and mdlf[1] is not None:
        mdlf[1](a[0].parent) # This calls the function that is stored in the "mdlimport" list above.

### A list, used below, to pass items to for the main QuArK menu 'Model Exporters' section.
### See the plugins files that start with "ie_" for its use.
mdlexport = {}
mdlexportmenuorder = {}

def MACRO_mdl_pythonexporter(text):
    import qeditor
    a = quarkx.getqctxlist()
    a.reverse()

    # Decker - Some menuitem-captions contains a '&'-character (you know, the one which tells what mnemonic-key can be used)
    # These '&'-characters has to be removed, for the entfn[text] to work properly.
    text = text.replace("&", "")

    mdlf = mdlexport[text]
    if mdlf is not None and mdlf[0][0] is not None:
        # See plugins\mapbotwaypointer.py file for example of line below for use.
        files = quarkx.filedialogbox("Save file as...", text, mdlf[0], qutils.SAVEDIALOG)
        if len(files) != 0:
            file = files[0]
            gn = a[0]["GameDir"]
            if (gn is None) or (gn == ""):
                gn = file
            mdlf[1](a[0].parent, file, gn)
    if mdlf[0][0] is None and mdlf[1] is not None:
        mdlf[1](a[0].parent) # This calls the function that is stored in the "mdlexport" list above.
