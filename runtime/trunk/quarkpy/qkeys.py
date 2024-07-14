"""   QuArK  -  Quake Army Knife

Keyboard constants and utilities
"""
#
# Copyright (C) 1996-99 Armin Rigo
# THIS FILE IS PROTECTED BY THE GNU GENERAL PUBLIC LICENCE
# FOUND IN FILE "COPYING.TXT"
#

# Virtual-Key Codes, Standard Set
# The list below is converted from the Win32 documentation.
LBUTTON = '\x01'    # mouse
RBUTTON = '\x02'    # mouse
CANCEL = '\x03'
MBUTTON = '\x04'    # mouse
XBUTTON1 = '\x05'   # mouse
XBUTTON2 = '\x06'   # mouse
BACK = '\x08'
TAB = '\x09'
CLEAR = '\x0C'
RETURN = '\x0D'
SHIFT = '\x10'
CONTROL = '\x11'
MENU = '\x12'       # this is ALT
PAUSE = '\x13'
CAPITAL = '\x14'
ESCAPE = '\x1B'
SPACE = '\x20'
PRIOR = '\x21'      # this is Page Up
NEXT = '\x22'       # this is Page Down
END = '\x23'
HOME = '\x24'
LEFT = '\x25'
UP = '\x26'
RIGHT = "\x27"
DOWN = '\x28'
SELECT = '\x29'
PRINT = '\x2A'
EXECUTE = '\x2B'
SNAPSHOT = '\x2C'
INSERT = '\x2D'
DELETE = '\x2E'
HELP = '\x2F'
# VK_0 thru VK_9 are the same as ASCII '0' thru '9'
# VK_A thru VK_Z are the same as ASCII 'A' thru 'Z'
LWIN = '\x5B'
RWIN = '\x5C'
APPS = '\x5D'
SLEEP = '\x5F'
NUMPAD0 = '\x60'
NUMPAD1 = '\x61'
NUMPAD2 = '\x62'
NUMPAD3 = '\x63'
NUMPAD4 = '\x64'
NUMPAD5 = '\x65'
NUMPAD6 = '\x66'
NUMPAD7 = '\x67'
NUMPAD8 = '\x68'
NUMPAD9 = '\x69'
MULTIPLY = '\x6A'
ADD = '\x6B'
SEPARATOR = '\x6C'
SUBTRACT = '\x6D'
DECIMAL = '\x6E'
DIVIDE = '\x6F'
F1 = '\x70'
F2 = '\x71'
F3 = '\x72'
F4 = '\x73'
F5 = '\x74'
F6 = '\x75'
F7 = '\x76'
F8 = '\x77'
F9 = '\x78'
F10 = '\x79'
F11 = '\x7A'
F12 = '\x7B'
F13 = '\x7C'
F14 = '\x7D'
F15 = '\x7E'
F16 = '\x7F'
F17 = '\x80'
F18 = '\x81'
F19 = '\x82'
F20 = '\x83'
F21 = '\x84'
F22 = '\x85'
F23 = '\x86'
F24 = '\x87'
NUMLOCK = '\x90'
SCROLL = '\x91'
#LSHIFT = '\xA0'
#RSHIFT = '\xA1'      # left and right keys are not distinguished
#LCONTROL = '\xA2'
#RCONTROL = '\xA3'
#LMENU = '\xA4'       # left ALT
#RMENU = '\xA5'       # right ALT
#BROWSER_BACK = '\xA6'
#BROWSER_FORWARD = '\xA7'
#BROWSER_REFRESH = '\xA8'
#BROWSER_STOP = '\xA9'
#BROWSER_SEARCH = '\xAA'
#BROWSER_FAVORITES = '\xAB'
#BROWSER_HOME = '\xAC'
#VOLUME_MUTE = '\xAD'
#VOLUME_DOWN = '\xAE'
#VOLUME_UP = '\xAF'
#MEDIA_NEXT_TRACK = '\xB0'
#MEDIA_PREV_TRACK = '\xB1'
#MEDIA_STOP = '\xB2'
#MEDIA_PLAY_PAUSE = '\xB3'
#LAUNCH_MAIL = '\xB4'
#LAUNCH_MEDIA_SELECT = '\xB5'
#LAUNCH_APP1 = '\xB6'
#LAUNCH_APP2 = '\xB7'
#PROCESSKEY = '\xE5'
#ATTN = '\xF6'
#CRSEL = '\xF7'
#EXSEL = '\xF8'
#EREOF = '\xF9'
#PLAY = '\xFA'
#ZOOM = '\xFB'
#NONAME = '\xFC'
#PA1 = '\xFD'
#OEM_CLEAR = '\xFE'


# compute keyname dictionnary

def keynames():
    global _keynames
    try:
        return _keynames
    except NameError:
        _keynames = {}
        for item, value in globals().items():
            if type(value)==type('') and len(value)==1:
                _keynames[value] = item
        return _keynames
