"""   QuArK  -  Quake Army Knife
"""
#
# Copyright (C) 1996-99 Armin Rigo
# THIS FILE IS PROTECTED BY THE GNU GENERAL PUBLIC LICENCE
# FOUND IN FILE "COPYING.TXT"
#

Info = {
   "plug-in":       "Shine Entity Line Extensions",
   "desc":          "Displays entity lines for Shine",
   "date":          "Dec. 17, 2007",
   "author":        "Shine",
   "author e-mail": "",
   "quark":         "Version 6.6.0 Beta 1" }


import quarkx
from quarkpy.maputils import *
import quarkpy.mapentities

DefaultDrawEntityLines = quarkpy.mapentities.DefaultDrawEntityLines

def ParseCompoundVolume(CVString):

    nNumSpheres = 0

    iChar = 0
    while iChar < len(CVString) and CVString[iChar] != ' ':
        iChar = iChar + 1

    if iChar == len(CVString):
        return []

    nNumSpheres = int(CVString[:iChar])

    ParseList = []

    for iSphere in range(nNumSpheres):
        while iChar < len(CVString) and CVString[iChar] == ' ':
            iChar = iChar + 1

        if iChar == len(CVString):
            return []

        SphereInfoStart = iChar

        # X
        while iChar < len(CVString) and CVString[iChar] != ' ':
            iChar = iChar + 1

        if iChar == len(CVString):
            return []

        # Space
        while iChar < len(CVString) and CVString[iChar] == ' ':
            iChar = iChar + 1

        if iChar == len(CVString):
            return []

        # Y
        while iChar < len(CVString) and CVString[iChar] != ' ':
            iChar = iChar + 1

        if iChar == len(CVString):
            return []

        # Space
        while iChar < len(CVString) and CVString[iChar] == ' ':
            iChar = iChar + 1

        if iChar == len(CVString):
            return []

        # Z
        while iChar < len(CVString) and CVString[iChar] != ' ':
            iChar = iChar + 1

        if iChar == len(CVString):
            return []

        iSphereOrigin = quarkx.vect(CVString[SphereInfoStart:iChar])

        # Space
        while iChar < len(CVString) and CVString[iChar] == ' ':
            iChar = iChar + 1

        if iChar == len(CVString):
            return []

        # Radius
        SphereInfoStart = iChar
        while iChar < len(CVString) and CVString[iChar] != ' ':
            iChar = iChar + 1

        iSphereRadius = float(CVString[SphereInfoStart:iChar])

        ParseList = ParseList + [(iSphereOrigin, iSphereRadius)]

    return ParseList

class ShineDrawEntityLines(DefaultDrawEntityLines):

    def drawAABB(self, mins, maxs, color, view):
        cv = view.canvas()
        cv.pencolor = color

        # calculate aabb points
        aabb_010 = view.proj(quarkx.vect(mins.x, maxs.y, mins.z))
        aabb_110 = view.proj(quarkx.vect(maxs.x, maxs.y, mins.z))
        aabb_100 = view.proj(quarkx.vect(maxs.x, mins.y, mins.z))
        aabb_001 = view.proj(quarkx.vect(mins.x, mins.y, maxs.z))
        aabb_011 = view.proj(quarkx.vect(mins.x, maxs.y, maxs.z))
        aabb_101 = view.proj(quarkx.vect(maxs.x, mins.y, maxs.z))
        aabb_000 = view.proj(mins)
        aabb_111 = view.proj(maxs)

        # draw low level
        cv.line(int(aabb_000.x), int(aabb_000.y), int(aabb_010.x), int(aabb_010.y))
        cv.line(int(aabb_110.x), int(aabb_110.y), int(aabb_010.x), int(aabb_010.y))
        cv.line(int(aabb_110.x), int(aabb_110.y), int(aabb_100.x), int(aabb_100.y))
        cv.line(int(aabb_000.x), int(aabb_000.y), int(aabb_100.x), int(aabb_100.y))
        # draw high level
        cv.line(int(aabb_001.x), int(aabb_001.y), int(aabb_011.x), int(aabb_011.y))
        cv.line(int(aabb_111.x), int(aabb_111.y), int(aabb_011.x), int(aabb_011.y))
        cv.line(int(aabb_111.x), int(aabb_111.y), int(aabb_101.x), int(aabb_101.y))
        cv.line(int(aabb_001.x), int(aabb_001.y), int(aabb_101.x), int(aabb_101.y))
        # draw medium level
        cv.line(int(aabb_000.x), int(aabb_000.y), int(aabb_001.x), int(aabb_001.y))
        cv.line(int(aabb_010.x), int(aabb_010.y), int(aabb_011.x), int(aabb_011.y))
        cv.line(int(aabb_110.x), int(aabb_110.y), int(aabb_111.x), int(aabb_111.y))
        cv.line(int(aabb_100.x), int(aabb_100.y), int(aabb_101.x), int(aabb_101.y))

    def drawonesphere(self, entity, sphereradius, org, OriginalOrigin, color, view):
        try:
            radius = sphereradius * view.scale(OriginalOrigin)
        except:
            return
        cv = view.canvas()
        cv.pencolor = color
        cv.penwidth = 2
        cv.brushstyle = BS_CLEAR
        cv.ellipse(int(org.x-radius), int(org.y-radius), int(org.x+radius), int(org.y+radius))

    def drawentityradius(self, entity, nameradius, org, color, view):
        try:
            if entity[nameradius] is None:
                return
            radius = float(entity[nameradius]) * view.scale(org)
        except:
            return
        cv = view.canvas()
        cv.pencolor = color
        cv.penwidth = 2
        cv.brushstyle = BS_CLEAR
        cv.ellipse(int(org.x-radius), int(org.y-radius), int(org.x+radius), int(org.y+radius))

    def drawentitylines(self, entity, org, view, entities, processentities):
        # Draw the default target/targetname/killtarget/light/_light arrows/ellipse
        DefaultDrawEntityLines.drawentitylines(self, entity, org, view, entities, processentities)

        if entity["pivot"] is not None:
           self.drawentityarrows("pivotname", entity["pivot"], org, 1, RED, view, entities, processentities)
        if entity["Activator.Target"] is not None:
           self.drawentityarrows("Trigger.TargetName", entity["Activator.Target"], org, 0, color, view, entities, processentities)

#    pos = string.find(CVD, " ")
#    if pos>-1:
#          NV = CVD[:pos]
#          debug(NV)
#          i=0
#          while i<NV:
#            debug(i)
#            i = i+1
        if (entity["CollisionInfo.mins"] is not None) and (entity["CollisionInfo.maxs"] is not None):
            mins = org + quarkx.vect(entity["CollisionInfo.mins"])
            maxs = org + quarkx.vect(entity["CollisionInfo.maxs"])
            self.drawAABB(mins, maxs, color, view)

        if entity["CollisionInfo.CompoundVolumeData"] is not None:
            SpheresList = ParseCompoundVolume(entity["CollisionInfo.CompoundVolumeData"])
            for Sphere in SpheresList:
                SphereOrigin, SphereRadius = Sphere

                ItemOrigin = quarkx.vect(entity["origin"])

                szmangle = "0 0 0"
                if entity["mangle"] is not None:
                    szmangle = entity["mangle"]

                angles = quarkx.vect(szmangle)
                pitch = -angles.x*deg2rad
                yaw = angles.y*deg2rad
                roll = angles.z*deg2rad

                mat = matrix_rot_z(yaw)*matrix_rot_y(pitch)*matrix_rot_x(roll)

                SphereOrigin = (mat*SphereOrigin)+ItemOrigin
                self.drawonesphere(entity, SphereRadius, view.proj(SphereOrigin),SphereOrigin, color, view)
        else:
            EntityForm = quarkx.getqctxlist(":form" , entity.shortname)
            if EntityForm is not None and len(EntityForm) > 0:
                EntityForm = EntityForm[-1]
                for TestItem in EntityForm.subitems:
                    if TestItem.shortname == "CompVolInfo":
                        if TestItem["CVInfo"] is not None:
                            SpheresList = ParseCompoundVolume(TestItem["CVInfo"])
                            for Sphere in SpheresList:
                                SphereOrigin, SphereRadius = Sphere

                                ItemOrigin = quarkx.vect(entity["origin"])

                                szmangle = "0 0 0"
                                if entity["mangle"] is not None:
                                    szmangle = entity["mangle"]

                                angles = quarkx.vect(szmangle)
                                pitch = -angles.x*deg2rad
                                yaw = angles.y*deg2rad
                                roll = angles.z*deg2rad

                                mat = matrix_rot_z(yaw)*matrix_rot_y(pitch)*matrix_rot_x(roll)

                                SphereOrigin = (mat*SphereOrigin)+ItemOrigin
                                self.drawonesphere(entity, SphereRadius, view.proj(SphereOrigin),SphereOrigin, color, view)
                        break

        self.drawentityradius(entity, "CollisionInfo.radius", org1, color, view)
        self.drawentityradius(entity, "SkinMesh.VisibilityDistance", org1, color, view)
        self.drawentityradius(entity, "Shadow.VisibilityDistance", org1, color, view)
        self.drawentityradius(entity, "BrushModel.VisibilityDistance", org1, color, view)
        self.drawentityradius(entity, "Shadow.MaxDistance", org1, color, view)

        self.drawentityradius(entity, "Sound.MinDistance", org1, BLUE, view)
        self.drawentityradius(entity, "Sound.MaxDistance", org1, RED, view)

        if entity.shortname == "NavPoint" and entity.parent is not None:
            self.drawentityradius(entity, "Location.radius", org1, RED, view)
            radius = float(entity["Location.radius"])
            worldspawn = entity.parent
            while worldspawn.shortname <> "worldspawn" and worldspawn.parent is not None:
                worldspawn = worldspawn.parent
            items = worldspawn.findallsubitems("NavPoint", ":e")
            for item in items:
                if item <> entity and item["origin"] is not None:
                    ItemOrigin = quarkx.vect(item["origin"])
                    ItemRadius = float(item["Location.radius"])
                    lenItem = abs(org - ItemOrigin)
                    if lenItem < 2*(radius + ItemRadius)+300.0:
                        OrgItem = view.proj(ItemOrigin)
                        drawcolor = color
                        if lenItem <= (radius + ItemRadius):
                            drawcolor = YELLOW
                        self.drawentityradius(item, "Location.radius", OrgItem, drawcolor, view)
        else:
            self.drawentityradius(entity, "Location.radius", org1, color, view)


#
# Register this class with its gamename
#
quarkpy.mapentities.EntityLinesMapping.update({
  "Shine": ShineDrawEntityLines()
})
