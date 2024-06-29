"""   QuArK  -  Quake Army Knife

Dialog boxes
"""
#
# Copyright (C) 1996-99 Armin Rigo
# THIS FILE IS PROTECTED BY THE GNU GENERAL PUBLIC LICENCE
# FOUND IN FILE "COPYING.TXT"
#

import quarkx
import qutils

#
#    ---- Dialog Boxes ----
#

dialogboxes = {}

def closedialogbox(name):
    try:
        dialogboxes[name].close()
        del dialogboxes[name]
    except KeyError:
        pass


#
# The class "dialogbox" is a base for actual dialog boxes.
# See qeditor.py and mapfindreptex.py for examples.
#

class dialogbox:

    dlgdef = None # abstract
    size = (300,170)
    begincolor = None
    endcolor = None
    name = None
    dfsep = 0.6
    dlgflags = qutils.FWF_KEEPFOCUS | qutils.FWF_POPUPCLOSE

    def __init__(self, form, src, **buttons):
        name = self.name or self.__class__.__name__
        closedialogbox(name)
        f = quarkx.newobj("Dlg:form")
        self.f = f
        self.src = src
        self.buttons = buttons
        if self.dlgdef is not None:
            f.loadtext(self.dlgdef)
            for pybtn in f.findallsubitems("", ':py'):
                pybtn["sendto"] = name
            if form is not None:
                dlg = form.newfloating(self.dlgflags, f["Caption"])
                dlg.windowrect = self.windowrect()
                if self.begincolor is not None: dlg.begincolor = self.begincolor
                if self.endcolor is not None: dlg.endcolor = self.endcolor
                dlg.onclose = self.onclose
                dlg.info = self
                self.dlg = dlg
                dialogboxes[name] = dlg
                df = dlg.mainpanel.newdataform()
                self.df = df
                df.header = 0
                df.sep = self.dfsep
                df.setdata(src, f)
                df.onchange = self.datachange
                import qeditor
                df.flags = qeditor.DF_AUTOFOCUS
                dlg.show()
            else:
                self.dlg = None
                self.df = None
                quarkx.beep()
        else:
            self.df = None

    def windowrect(self):
        x1,y1,x2,y2 = quarkx.screenrect()
        cx = (x1+x2)/2
        cy = (y1+y2)/2
        size = self.size
        return (cx-size[0]/2, cy-size[1]/2, cx+size[0]/2, cy+size[1]/2)

    def datachange(self, df):
        pass   # abstract

    def onclose(self, dlg):
        self.src = None
        dlg.info = None
        dlg.onclose = None
        if self.df is not None:
            self.df.onchange = None
            self.df = None
        self.dlg = None
        self.f = None
        del self.buttons

    def close(self, reserved=None):
        self.dlg.close()


class placepersistent_dialogbox(dialogbox):
    def __init__(self, form, src, label, **buttons):
        name = self.name or self.__class__.__name__
        self.label = label
        closedialogbox(name)
        f = quarkx.newobj("Dlg:form")
        f.loadtext(self.dlgdef)
        self.f = f
        for pybtn in f.findallsubitems("", ':py'):
            pybtn["sendto"] = name
        self.buttons = buttons
        dlg = form.newfloating(self.dlgflags, f["Caption"])
        dialogboxes[name] = dlg
        dlg.windowrect = self.windowrect()
        if self.begincolor is not None: dlg.begincolor = self.begincolor
        if self.endcolor is not None: dlg.endcolor = self.endcolor
        dlg.onclose = self.onclose
        dlg.info = self
        self.dlg = dlg
        self.src = src
        df = dlg.mainpanel.newdataform()
        self.df = df
        df.header = 0
        df.sep = self.dfsep
        df.setdata(src, f)
        df.onchange = self.datachange
        import qeditor
        df.flags = qeditor.DF_AUTOFOCUS
        dlg.show()

    def windowrect(self):
        rect = quarkx.setupsubset(self.editor.MODE,"Options")['dlgdim_'+self.label]
        if rect is not None:
            return (int(rect[0]), int(rect[1]), int(rect[2]), int(rect[3]))
        x1,y1,x2,y2 = quarkx.screenrect()
        dx = x1-x2
        dy = y1-y2
        cx = (x1+x2)/2
        cy = (y1+y2)/2
        size = self.size
        return (cx-size[0]/2, cy-size[1]/2, cx+size[0]/2, cy+size[1]/2)

    def onclose(self, dlg):
        quarkx.setupsubset(self.editor.MODE,"Options")['dlgdim_'+self.label] = self.dlg.windowrect
        dialogbox.onclose(self, dlg)

class LiveEditDlg(placepersistent_dialogbox):

    def __init__(self, form, label, editor, setup, action, onclosing=None):

    #
    # General initialization of some local values
    #

        self.editor = editor

        src = quarkx.newobj(":")
        self.src = src
        self.action = action
        self.setup = setup
        self.onclosing = onclosing
        self.form = form
        self.setup(self)

    #
    # Create the dialog form and the buttons
    #

        import qtoolbar
        placepersistent_dialogbox.__init__(self, form, src, label,
           exit = qtoolbar.button(
            self.cancel,
            "close dialog",
            qutils.ico_dict['ico_editor'], 0,
            "Exit"))

    def cancel(self, dlg):
        self.src = None
        dialogbox.close(self, dlg)

    def datachange(self, dlg):
       quarkx.globalaccept()
       self.action(self)
       self.setup(self)
       self.df.setdata(self.src, self.f)

    def onclose(self,dlg):
        if self.onclosing is not None:
            self.onclosing(self)
        placepersistent_dialogbox.onclose(self,dlg)

#
# A specialization of LiveEditDlg for running dialogs
#   with PM-style buttons
#
class LiveButtonDlg(LiveEditDlg):

    def __init__(self, label, editor, setup, action, onclosing=None):
        setattr(editor,'dlg_'+label,self)
        LiveEditDlg.__init__(self,quarkx.clickform,label,editor,setup,action,onclosing)

    def onclose(self,dlg):
        delattr(self.editor,'dlg_'+self.label)
        LiveEditDlg.onclose(self,dlg)

class LiveBrowserDlg(LiveButtonDlg):

    endcolor = qutils.AQUA
    size = (220,160)
    dfsep = 0.35
    dlgflags = qutils.FWF_KEEPFOCUS


    def __init__(self, label, editor, pack, moresetup=None, moreaction=None, onclosing=None):

        self.moresetup=moresetup
        self.moreaction=moreaction

        self.pack=pack
        pack.seen = 0

        #
        # im_func stuff needed because default values methods
        #
        LiveButtonDlg.__init__(self, label, editor, self.presetup.im_func, self.preaction.im_func, onclosing)


    def presetup(self):
         #
         # Names and list-indexes of close planes
         #
         pack = self.pack
         ran = range(len(pack.collected))
         pack.slist = map(lambda obj, num:"%d) %s"%(num+1,obj.shortname), pack.collected, ran)
         pack.klist = map(lambda d:`d`, ran)
         self.src["collected$Items"] = "\015".join(pack.slist)
         self.src["collected$Values"] = "\015".join(pack.klist)
         if not pack.seen and len(ran)>0:
             self.src["collected"] = '0'
             self.chosen = '0'
             pack.seen = 1
         elif len(ran)==0:
             self["collected"] = ''
             self.chosen = ''

         #
         # Note the commas, EF..1 controls take 1-tuples as data
         #
         self.src["num"]=len(pack.klist),
         if self.moresetup is not None:
             self.moresetup(self)

    def preaction(self):
        self.chosen=self.pack.collected[eval(self.src["collected"])]
        if self.moreaction is not None:
            self.moreaction(self)

#
# Like dialog box but with possibility of specifying
#   the location in the initialization.
#
class locatable_dialog_box(dialogbox):
    def __init__(self, form, src, px, py, **buttons):
        self.px, self.py = px, py
        dialogbox.__init__(self, form, src, **buttons)

    def windowrect(self):
        x1,y1,x2,y2 = quarkx.screenrect()
        dx = x1-x2
        dy = y1-y2
        ox, oy = dx/self.px, dy/self.py
        cx = (x1+x2)/2
        cy = (y1+y2)/2
        size = self.size
        return (ox+cx-size[0]/2, oy+cy-size[1]/2, ox+cx+size[0]/2, oy+cy+size[1]/2)
