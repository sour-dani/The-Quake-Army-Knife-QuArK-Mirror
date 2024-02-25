(**************************************************************************
QuArK -- Quake Army Knife -- 3D game editor
Copyright (C) QuArK Development Team

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

https://quark.sourceforge.io/ - Contact information in AUTHORS.TXT
**************************************************************************)
unit Python;

{$IFDEF DEBUG}
{$DEFINE PyRefDEBUG}
{$DEFINE DebugPythonLeak}
{$ENDIF}

 {-------------------}

interface

uses ExtraFunctionality {$IFDEF PyProfiling}, Classes {$ENDIF};

{$INCLUDE PyVersions.inc}
{$I DelphiVer.inc}

type
 CFILE = Pointer;

 PyCharacterType = AnsiChar;
 PyChar = PAnsiChar;
 //PPyChar = ^PyChar;

 {$IFDEF PYTHON25}
 Py_ssize_t = ssize_t;
 Py_ssize_tPtr = ^Py_ssize_t;
 {$ENDIF}

 PyObjectPtr = ^PyObject;
 PyTypeObject = ^TyTypeObject;

 PyObject = ^TyObject;
 TyObject = object
             ob_refcnt: {$IFDEF PYTHON25}Py_ssize_t{$ELSE}Integer{$ENDIF};
             ob_type: PyTypeObject;
            end;

 PyVarObject = ^TyVarObject;
 TyVarObject = object(TyObject)
                ob_size: {$IFDEF PYTHON25}Py_ssize_t{$ELSE}Integer{$ENDIF};
               end;
(* PyIntObject = ^TyIntObject;
 TyIntObject = object(TyObject)
                ob_ival: LongInt;
               end;
 PyTupleObject = ^TyTupleObject;
 TyTupleObject = object(TyVarObject)
                  ob_item: array[0..0] of PyObject;
                 end;
 PyStringObject = ^TyStringObject;
 TyStringObject = object(TyVarObject)
                   ob_shash: LongInt;
                   ob_sstate: Integer;
                   ob_sval: array[0..0] of Char;
                  end; *)

 TyCFunction = function(self, args: PyObject) : PyObject; cdecl;
 TyCFunctionKey = function(self, args, keys: PyObject) : PyObject; cdecl;
 PTyMethodDef = ^TyMethodDef;
 TyMethodDef = record
                ml_name: (*const*) PyChar;
                case Integer of
                 0: (ml_meth: TyCFunction;
                     ml_flags: Integer;
                     ml_doc: (*const*) PyChar);
                 1: (ml_keymeth: TyCFunctionKey);
               end;

 PPyMemberDef = ^PyMemberDef;
 PyMemberDef = record
   name : PyChar;
   _type : integer;
   offset : {$IFDEF PYTHON25}Py_ssize_t{$ELSE}Integer{$ENDIF};
   flags : integer;
   doc : PyChar;
 end;

 getter = function(ob : PyObject; ptr : Pointer) : PyObject; cdecl;
 setter = function(ob1, ob2 : PyObject; ptr : Pointer) : integer; cdecl;

 PPyGetSetDef = ^PyGetSetDef;
 PyGetSetDef = record
   name : PyChar;
   get : getter;
   _set : setter;
   doc : PyChar;
   closure : Pointer;
 end;

 FnUnaryFunc         = function(o1: PyObject) : PyObject; cdecl;
 FnBinaryFunc        = function(o1,o2: PyObject) : PyObject; cdecl;
 FnTernaryFunc       = function(o1,o2,o3: PyObject) : PyObject; cdecl;
 FnInquiry           = function(o: PyObject) : Integer; cdecl;
 {$IFDEF PYTHON25}FnLenfunc           = function(o: PyObject) : Py_ssize_t; cdecl;{$ENDIF}
 FnCoercion      = function(var o1, o2: PyObject) : Integer; cdecl;
 FnIntArgFunc        = function(o: PyObject; i1: Integer) : PyObject; cdecl;
 FnIntIntArgFunc     = function(o: PyObject; i1, i2: Integer) : PyObject; cdecl;
 {$IFDEF PYTHON25}FnSSizeArgFunc      = function(o: PyObject; i1: Py_ssize_t) : PyObject; cdecl;{$ENDIF}
 {$IFDEF PYTHON25}FnSSizeSSizeArgFunc = function(o: PyObject; i1: Py_ssize_t; i2: Py_ssize_t) : PyObject; cdecl;{$ENDIF}
 FnIntObjArgProc     = function(o: PyObject; i: Integer; o2: PyObject) : Integer; cdecl;
 FnIntIntObjArgProc  = function(o: PyObject; i1, i2: Integer; o2: PyObject) : Integer; cdecl;
 {$IFDEF PYTHON25}FnSSizeObjArgProc   = function(o: PyObject; i: Py_ssize_t; o2: PyObject) : Integer; cdecl;{$ENDIF}
 {$IFDEF PYTHON25}FnSSizeSSizeObjArgProc = function(o: PyObject; i1, i2: Py_ssize_t; o2: PyObject) : Integer; cdecl;{$ENDIF}
 FnObjObjArgProc     = function(o1,o2,o3: PyObject) : Integer; cdecl;

 //buffer interface
 FnReadBufferProc    = function(o: PyObject; i: {$IFDEF PYTHON25}Py_ssize_t{$ELSE}Integer{$ENDIF}; p: Pointer): {$IFDEF PYTHON25}Py_ssize_t{$ELSE}Integer{$ENDIF}; cdecl;
 FnWriteBufferProc   = function(o: PyObject; i: {$IFDEF PYTHON25}Py_ssize_t{$ELSE}Integer{$ENDIF}; p: Pointer): {$IFDEF PYTHON25}Py_ssize_t{$ELSE}Integer{$ENDIF}; cdecl;
 FnSegCountProc      = function(o: PyObject; i: {$IFDEF PYTHON25}Py_ssize_t{$ELSE}Integer{$ENDIF}): {$IFDEF PYTHON25}Py_ssize_t{$ELSE}Integer{$ENDIF}; cdecl;
 FnCharBufferProc    = function(o: PyObject; i: {$IFDEF PYTHON25}Py_ssize_t{$ELSE}Integer{$ENDIF}; p: PyChar): {$IFDEF PYTHON25}Py_ssize_t{$ELSE}Integer{$ENDIF}; cdecl;
 {$IFDEF PYTHON26}
 FnGetBufferProc     = function(o: PyObject; p: Pointer; i: Integer): Integer; cdecl;
 FnReleaseBufferProc = procedure(o: PyObject; p: Pointer); cdecl;
 {$ENDIF}

 FnObjObjProc      = function(ob1, obj2: PyObject): integer; cdecl;
 FnVisitProc       = function(ob1: PyObject; ptr: Pointer): integer; cdecl;
 FnTraverseProc    = function(ob1: PyObject; proc: FnVisitProc; ptr: Pointer): integer; cdecl;

 FnFreeFunc      = procedure(ptr: Pointer); cdecl;
 FnDestructor    = procedure(o: PyObject); cdecl;
 FnPrintFunc     = function(o: PyObject; f: CFILE; flags: Integer) : Integer; cdecl;
 FnGetAttrFunc   = function(o: PyObject; attr: PyChar) : PyObject; cdecl;
 FnGetAttrOFunc  = function(o: PyObject; attr: PyObject) : PyObject; cdecl;
 FnSetAttrFunc   = function(o: PyObject; attr: PyChar; v: PyObject) : Integer; cdecl;
 FnSetAttrOFunc  = function(o: PyObject; attr: PyObject; v: PyObject) : Integer; cdecl;
 FnCmpFunc       = function(o1, o2: PyObject) : Integer; cdecl;
 FnReprfunc      = function(o: PyObject) : PyObject; cdecl;
 FnHashfunc      = function(o: PyObject) : LongInt; cdecl;
 FnRichCmpFunc   = function(ob1, ob2 : PyObject; i : Integer) : PyObject; cdecl;
 FnGetIterFunc   = function(ob1 : PyObject) : PyObject; cdecl;
 FnIterNextFunc  = function(ob1 : PyObject) : PyObject; cdecl;
 FnDescrGetFunc  = function(ob1, ob2, ob3 : PyObject) : PyObject; cdecl;
 FnDescrSetFunc  = function(ob1, ob2, ob3 : PyObject) : Integer; cdecl;
 FnInitProc      = function(ob1, ob2, ob3 : PyObject) : Integer; cdecl;
 FnNewFunc       = function(t: PyTypeObject; ob1, ob2 : PyObject) : PyObject; cdecl;
 FnAllocFunc     = function(t: PyTypeObject; i : {$IFDEF PYTHON25}Py_ssize_t{$ELSE}Integer{$ENDIF}) : PyObject; cdecl;

 PyNumberMethods = ^TyNumberMethods;
 TyNumberMethods = record
                    nb_add, nb_subtract, nb_multiply,
                    nb_divide, nb_remainder, nb_divmod: FnBinaryFunc;
                    nb_power: FnTernaryFunc;
                    nb_negative, nb_positive, nb_absolute: FnUnaryFunc;
                    nb_nonzero: FnInquiry;
                    nb_invert: FnUnaryFunc;
                    nb_lshift, nb_rshift,
                    nb_and, nb_xor, nb_or: FnBinaryFunc;
                    nb_coerce: FnCoercion;
                    nb_int, nb_long, nb_float, nb_oct, nb_hex: FnUnaryFunc;
{$IFDEF PYTHON20}
                    nb_inplace_add, nb_inplace_subtract, nb_inplace_multiply,
                    nb_inplace_divide, nb_inplace_remainder: FnBinaryFunc;
                    nb_inplace_power: FnTernaryFunc;
                    nb_inplace_lshift, nb_inplace_rshift,
                    nb_inplace_and, nb_inplace_xor, nb_inplace_or: FnBinaryFunc;
{$ENDIF}
{$IFDEF PYTHON22}
                    // The following require the Py_TPFLAGS_HAVE_CLASS flag
                    nb_floor_divide, nb_true_divide, nb_inplace_floor_divide, nb_inplace_true_divide: FnBinaryFunc;
{$ENDIF}
{$IFDEF PYTHON25}
                    nb_index: FnUnaryFunc;
{$ENDIF}
                   end;

 PySequenceMethods = ^TySequenceMethods;
 TySequenceMethods = record
                      sq_length: {$IFDEF PYTHON25}FnLenfunc{$ELSE}FnInquiry{$ENDIF};
                      sq_concat: FnBinaryfunc;
                      sq_repeat: {$IFDEF PYTHON25}FnSSizeArgfunc{$ELSE}FnIntArgFunc{$ENDIF};
                      sq_item: {$IFDEF PYTHON25}FnSSizeArgfunc{$ELSE}FnIntArgFunc{$ENDIF};
                      sq_slice: {$IFDEF PYTHON25}FnSSizeSSizeArgfunc{$ELSE}FnIntIntArgFunc{$ENDIF};
                      sq_ass_item: {$IFDEF PYTHON25}FnSSizeObjArgproc{$ELSE}FnIntObjArgProc{$ENDIF};
                      sq_ass_slice: {$IFDEF PYTHON25}FnSSizeSSizeObjArgproc{$ELSE}FnIntIntObjArgProc{$ENDIF};
                      sq_contains: FnObjObjProc;
{$IFDEF PYTHON20}
                      sq_inplace_concat: FnBinaryFunc;
                      sq_inplace_repeat: {$IFDEF PYTHON25}FnSSizeArgFunc{$ELSE}FnIntArgFunc{$ENDIF};
{$ENDIF}
                     end;

 PyMappingMethods = ^TyMappingMethods;
 TyMappingMethods = record
                     mp_length: {$IFDEF PYTHON25}FnLenFunc{$ELSE}FnInquiry{$ENDIF};
                     mp_subscript: FnBinaryFunc;
                     mp_ass_subscript: FnObjObjArgProc;
                    end;

 PyBufferProcs = ^TyBufferProcs;
 TyBufferProcs = record
                  bf_getreadbuffer: FnReadBufferProc;
                  bf_getwritebuffer: FnWriteBufferProc;
                  bf_getsegcount: FnSegCountProc;
                  bf_getcharbuffer: FnCharBufferProc;
                  {$IFDEF PYTHON26}
                  bf_getbuffer: FnGetBufferProc;
                  bf_releasebuffer: FnReleaseBufferProc;
                  {$ENDIF}
                 end;

 TyTypeObject = object(TyVarObject)
                 tp_name: (*const*) PyChar;
                 tp_basicsize, tp_itemsize: {$IFDEF PYTHON25}Py_ssize_t{$ELSE}Integer{$ENDIF};

                 tp_dealloc: FnDestructor;
                 tp_print: FnPrintFunc;
                 tp_getattr: FnGetAttrFunc;
                 tp_setattr: FnSetAttrFunc;
                 tp_compare: FnCmpFunc;
                 tp_repr: FnReprFunc;

                 tp_as_number: PyNumberMethods;
                 tp_as_sequence: PySequenceMethods;
                 tp_as_mapping: PyMappingMethods;

                 tp_hash: FnHashfunc;
                 tp_call: FnTernaryfunc;
                 tp_str: FnReprfunc;
                 tp_getattro: FnGetattrofunc;
                 tp_setattro: FnSetattrofunc;

                 tp_as_buffer: PyBufferProcs;

                 tp_flags: LongInt;

                 tp_doc: PyChar;

{$IFDEF PYTHON20}
                 tp_traverse:    FnTraverseProc;   // call function for all accessible objects
                 tp_clear:       FnInquiry;   // delete references to contained objects
{$ENDIF}
{$IFDEF PYTHON21}
                 tp_richcompare: FnRichCmpFunc;   // rich comparisons
                 tp_weaklistoffset: {$IFDEF PYTHON25}Py_ssize_t{$ELSE}LongInt{$ENDIF};   // weak reference enabler
{$ENDIF}
{$IFDEF PYTHON22}
                 tp_iter: FnGetIterFunc;
                 tp_iternext: FnIterNextFunc;

                 tp_methods          : PTyMethodDef;
                 tp_members          : PPyMemberDef;
                 tp_getset           : PPyGetSetDef;
                 tp_base             : PyTypeObject;
                 tp_dict             : PyObject;
                 tp_descr_get        : FnDescrGetFunc;
                 tp_descr_set        : FnDescrSetFunc;
                 tp_dictoffset       : {$IFDEF PYTHON25}Py_ssize_t{$ELSE}LongInt{$ENDIF};
                 tp_init             : FnInitProc;
                 tp_alloc            : FnAllocFunc;
                 tp_new              : FnNewFunc;
                 tp_free             : FnFreeFunc; // Low-level free-memory routine
                 tp_is_gc            : FnInquiry; // For PyObject_IS_GC
                 tp_bases            : PyObject;
                 tp_mro              : PyObject; // method resolution order
                 tp_cache            : PyObject;
                 tp_subclasses       : PyObject;
                 tp_weaklist         : PyObject;
                 tp_del              : FnDestructor;
{$ENDIF}
{$IFDEF PYTHON26}
                 tp_version_tag      : Cardinal; //Type attribute cache version tag
{$ENDIF}
      end;

const
 // PYTHON_API_VERSION =
 //   1001 for Python ?
 //   1002 for Python ?
 //   1002 for Python ?
 //   1003 for Python ?
 //   1004 for Python ?
 //   1005 for Python ?
 //   1006 for Python 1.4?
 //   1007 for Python 1.5.1?
 //   1008 for Python 1.5.2b1 (NO LONGER SUPPORTED!) or 1.6?
 //   1009 for Python 2.0?
 //   1010 for Python 2.1a2 (and probably 2.1 as well)
 //   1011 for Python 2.2
 //   1012 for Python 2.3 and 2.4
 //   1013 for Python 2.5 and 2.6 and 2.7
 // Version info from here: http://svn.python.org/view/python/trunk/Include/modsupport.h
{$IFDEF PYTHON27}
 PYTHON_API_VERSION = 1013;
{$ELSE}

{$IFDEF PYTHON26}
 PYTHON_API_VERSION = 1013;
{$ELSE}

{$IFDEF PYTHON25}
 PYTHON_API_VERSION = 1013;
{$ELSE}

{$IFDEF PYTHON24}
 PYTHON_API_VERSION = 1012;
{$ELSE}

{$IFDEF PYTHON23}
 PYTHON_API_VERSION = 1012;
{$ELSE}

{$IFDEF PYTHON22}
 PYTHON_API_VERSION = 1011;
{$ELSE}

{$IFDEF PYTHON21}
 PYTHON_API_VERSION = 1010;
{$ELSE}

{$IFDEF PYTHON20}
 PYTHON_API_VERSION = 1009;
{$ELSE}

//Minimal support version is 2.0!
 PYTHON_API_VERSION = 1009;

{$ENDIF}
{$ENDIF}
{$ENDIF}
{$ENDIF}
{$ENDIF}
{$ENDIF}
{$ENDIF}
{$ENDIF}

// METH_OLDARGS  = $0000; //Do not use!
 METH_VARARGS  = $0001;
 METH_KEYWORDS = $0002;
 METH_NOARGS   = $0004;
 METH_O        = $0008;
{$IFDEF PYTHON23}
 METH_CLASS    = $0010;
 METH_STATIC   = $0020;
{$ENDIF}
{$IFDEF PYTHON24}
 METH_COEXIST  = $0040;
{$ENDIF}

 {-------------------}

var

Py_Initialize: procedure; cdecl;
Py_Finalize: procedure; cdecl;
Py_SetProgramName: procedure (name : PyChar); cdecl;
//Py_GetProgramName: function : PyChar; cdecl;
//Py_SetPythonHome: procedure (name : PyChar); cdecl;
//Py_GetPythonHome: function : PyChar; cdecl;
Py_GetVersion: function : (*const*) PyChar; cdecl;
//Py_GetBuildNumber: function : (*const*) PyChar; cdecl; //Introduced during Python 2.5 development, but removed before release.
//Py_GetPlatform: function : (*const*) PyChar; cdecl;
//Py_GetCopyright: function : (*const*) PyChar; cdecl;
//Py_GetCompiler: function : (*const*) PyChar; cdecl;
//Py_GetBuildInfo: function : (*const*) PyChar; cdecl;

PyRun_SimpleString: function (const P: PyChar) : Integer; cdecl;
//PyRun_String: function (const str: PyChar; start: Integer; Globals, Locals: PyObject) : PyObject; cdecl;
//Py_CompileString: function (const str, filename: PyChar; start: Integer) : PyObject; cdecl;

//Py_InitModule: function ({$IFDEF PYTHON25}const {$ENDIF}name: PyChar; MethodDef: PTyMethodDef) : PyObject; cdecl;
//Py_InitModule3: function ({$IFDEF PYTHON25}const {$ENDIF}name: PyChar; MethodDef: PTyMethodDef; {$IFDEF PYTHON25}const {$ENDIF}doc: PyChar) : PyObject; cdecl;
Py_InitModule4: function ({$IFDEF PYTHON25}const {$ENDIF}name: PyChar; MethodDef: PTyMethodDef; {$IFDEF PYTHON25}const {$ENDIF}doc: PyChar; self: PyObject; Version: Integer) : PyObject; cdecl;
PyModule_GetDict: function (module: PyObject) : PyObject; cdecl;
PyModule_New: function (const name: PyChar) : PyObject; cdecl;
//PyImport_ImportModule: function (const name: PyChar) : PyObject; cdecl;

//PyEval_GetGlobals: function : PyObject; cdecl;
//PyEval_GetLocals: function : PyObject; cdecl;
//function PyEval_GetBuiltins : PyObject; cdecl;
PyEval_CallObject: function (o, args: PyObject) : PyObject; cdecl;
{$IFDEF PYTHON27}
//Python 2.7.x broke backwards compatibility without warning
PyEval_CallObjectWithKeywords: function (o, args, kw: PyObject) : PyObject; cdecl;
{$ENDIF}
PyCallable_Check: function (o: PyObject) : Integer; cdecl;

PyErr_Print: procedure; cdecl;
PyErr_Clear: procedure; cdecl;
PyErr_Occurred: function : PyObject; cdecl;
PyErr_Fetch: procedure (var o1, o2, o3: PyObject); cdecl;
PyErr_Restore: procedure (o1, o2, o3: PyObject); cdecl;
PyErr_NewException: function (name: PyChar; base, dict: PyObject) : PyObject; cdecl;
PyErr_SetString: procedure (o: PyObject; const c: PyChar); cdecl;
//function PyErr_BadArgument : Integer; cdecl;
PyErr_ExceptionMatches: function (exc: PyObject) : Integer; cdecl;

//function PyObject_Hash(o: PyObject) : LongInt; cdecl;
PyObject_Length: function (o: PyObject) : {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF}; cdecl;
//PyObject_GetItem: function (o, key: PyObject) : PyObject; cdecl;
PyObject_HasAttrString: function (o: PyObject; const attr_name: PyChar) : Integer; cdecl;
PyObject_GetAttrString: function (o: PyObject; const attr_name: PyChar) : PyObject; cdecl;
PyObject_IsTrue: function (o: PyObject) : Integer; cdecl;
PyObject_Str: function (o: PyObject) : PyObject; cdecl;
PyObject_Repr: function (o: PyObject) : PyObject; cdecl;
PySequence_GetItem: function (o: PyObject; index: {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF}) : PyObject; cdecl;
PySequence_In: function (o, value: PyObject) : Integer; cdecl;
PySequence_Index: function (o, value: PyObject) : {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF}; cdecl;
PySequence_DelItem: function (o: PyObject; index: {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF}) : Integer; cdecl;
PyMapping_HasKey: function (o, key: PyObject) : Integer; cdecl;
PyMapping_HasKeyString: function (o: PyObject; const key: PyChar) : Integer; cdecl;
PyNumber_Float: function (o: PyObject) : PyObject; cdecl;

Py_BuildValue: function (const fmt: PyChar{, ...}) : PyObject; cdecl;
PyArg_ParseTuple: function (src: PyObject; const fmt: PyChar{, ...}) : Integer; cdecl;
//PyArg_ParseTupleAndKeywords: function (args, kw: PyObject; const fmt: PyChar; keywords: PPyChar{, ...}) : Integer; cdecl;

PyTuple_New: function (size: {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF}) : PyObject; cdecl;
PyTuple_GetItem: function (tuple: PyObject; index: {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF}) : PyObject; cdecl;
PyTuple_SetItem: function (tuple: PyObject; index: {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF}; item: PyObject) : Integer; cdecl;
//PyTuple_Size: function (tuple: PyObject) : {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF}; cdecl;

PyList_New: function (size: {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF}) : PyObject; cdecl;
PyList_GetItem: function (list: PyObject; index: {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF}) : PyObject; cdecl;
PyList_SetItem: function (list: PyObject; index: {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF}; item: PyObject) : Integer; cdecl;
PyList_Insert: function (list: PyObject; index: {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF}; item: PyObject) : Integer; cdecl;
PyList_Append: function (list: PyObject; item: PyObject) : Integer; cdecl;
//PyList_Size: function (list: PyObject) : {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF}; cdecl;

PyDict_New: function : PyObject; cdecl;
PyDict_SetItemString: function (dict: PyObject; const key: PyChar; item: PyObject) : Integer; cdecl;
PyDict_GetItemString: function (dict: PyObject; const key: PyChar) : PyObject; cdecl;
//PyDict_SetItem: function (dict: PyObject; key: PyObject; item: PyObject) : Integer; cdecl;
PyDict_GetItem: function (dict, key: PyObject) : PyObject; cdecl;
PyDict_Keys: function (dict: PyObject) : PyObject; cdecl;
PyDict_Values: function (dict: PyObject) : PyObject; cdecl;
//PyDict_Items: function(dict: PyObject) : PyObject; cdecl;
//PyDict_DelItemString: function(dict: PyObject; key: PyChar) : Integer; cdecl;
//PyDict_Size: function (dict: PyObject) : {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF}; cdecl;
PyDict_Next: function (dict: PyObject; pos : {$IFDEF PYTHON25} Py_ssize_tPtr {$ELSE} PInteger {$ENDIF}; key : PyObjectPtr; value : PyObjectPtr) : Integer; cdecl;

PyString_FromString: function (const str: PyChar) : PyObject; cdecl;
PyString_AsString: function (o: PyObject) : PyChar; cdecl;
PyString_FromStringAndSize: function (const str: PyChar; size: {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF}) : PyObject; cdecl;
PyString_Size: function (o: PyObject) : {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF}; cdecl;

PyInt_FromLong: function (Value: LongInt) : PyObject; cdecl;
PyInt_AsLong: function (o: PyObject) : LongInt; cdecl;
//PyInt_FromSsize_t: function (Value: Py_ssize_t) : PyObject; cdecl;
//PyInt_FromSize_t: function (Value: size_t) : PyObject; cdecl;
//PyInt_AsSsize_t: function (o: PyObject) : Py_ssize_t; cdecl;
//PyInt_AsUnsignedLongMask: function (o: PyObject) : Longword; cdecl;

//Long integers in Python are unlimited in size (only limited by the amount of available memory)
//PyLong_FromLong: function (Value : LongInt) : PyObject; cdecl;
//PyLong_FromUnsignedLong: function (Value : Longword) : PyObject; cdecl;
//PyLong_FromSsize_t: function (Value : Py_ssize_t) : PyObject; cdecl;
//PyLong_FromSize_t: function (Value : size_t) : PyObject; cdecl;
//PyLong_FromDouble: function (Value : Double) : PyObject; cdecl;
//PyLong_AsLong: function (o : PyObject) : LongInt; cdecl;
//PyLong_AsLongAndOverflow: function (o : PyObject, overflow : PInteger) : LongInt; cdecl;
//PyLong_AsSsize_t: function(o : PyObject) : Py_ssize_t; cdecl;
//PyLong_AsUnsignedLong: function(o : PyObject) : Longword; cdecl;
//PyLong_AsUnsignedLongMask: function (o : PyObject) : Longword; cdecl;
//PyLong_AsDouble: function (o : PyObject) : Double; cdecl;

PyFloat_FromDouble: function (Value: Double) : PyObject; cdecl;
PyFloat_AsDouble: function (o: PyObject) : Double; cdecl;

PyObject_Init: function (o: PyObject; t: PyTypeObject) : PyObject; cdecl;

// function _PyObject_NewVar(t: PyTypeObject; i: {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF}; o: PyObject) : PyObject; cdecl;

PyCFunction_New: function (const Def: TyMethodDef; self: PyObject) : PyObject; cdecl;

//New in Python 2.3:
//PyBool_Check: function (o: PyObject) : Integer; cdecl;
//Py_False: function : PyObject; cdecl;
//Py_True: function : PyObject; cdecl;
//PyBool_FromLong: function (Value: LongInt) : PyObject; cdecl;
PyGC_Collect: function : {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF}; cdecl;

{$IFDEF PyProfiling}
type
  PyCodeObject = ^TyCodeObject;
  TyCodeObject = object(TyObject)
    co_argcount, co_nlocals, co_stacksize, co_flags: Integer;
    co_code, co_consts, co_names, co_varnames: PyObject;
    {$IFDEF PYTHON21}
    co_freevars, co_cellvars: PyObject;
    {$ENDIF}
    co_filename, co_name: PyObject;
    co_firstlineno: Integer;
    co_lnotab: PyObject;
    {$IFDEF PYTHON25}
    co_zombieframe: Pointer;
    {$ENDIF}
    {$IFDEF PYTHON27}
    co_weakreflist: PyObject;
    {$ENDIF}
  end;

const
  CO_MAXBLOCKS = 20;

type
  PyTryBlock = record
    b_type, b_handler, b_level: Integer;
  end;

  PyFrameObject = ^TyFrameObject;
  TyFrameObject = object(TyVarObject)
    f_back: PyFrameObject;
    f_code: PyCodeObject;
    f_builtins: PyObject;
    f_globals: PyObject;
    f_locals: PyObject;
    f_valuestack: ^PyObject;

    f_stacktop: ^PyObject;
    f_trace: PyObject;

    f_exc_type, f_exc_value, f_exc_traceback: PyObject;

    f_tstate: Pointer; //Actually PyThreadState, but Delphi can't handle forward record declarations, so we have to break the cyclical dependency.
    f_lasti, f_lineno, f_iblock: Integer;

    f_blockstack: packed array[0..CO_MAXBLOCKS-1] of PyTryBlock;
    f_localsplus: array of PyObject; //dynamically sized
  end;

{$IFDEF PYTHON22}
type
  Py_tracefunc = function(obj: PyObject; frame: PyFrameObject; what: Integer; arg: PyObject) : Integer;
{$ENDIF}

type
  PyInterpreterState = ^TyInterpreterState;
  TyInterpreterState = record
    next, tstate_head: PyInterpreterState;
    modules, sysdict, builtins: PyObject;
    {$IFDEF PYTHON26}
    modules_reloading: PyObject;
    {$ENDIF}
    {$IFDEF PYTHON22}
    codec_search_path, codec_search_cache, codec_error_registry: PyObject;
    {$ELSE}
    checkinterval: Integer;
    {$ENDIF}
    //dlopenflags: Integer; //HAVE_DLOPEN
    {$IFDEF PYTHON24}
    //tscdump: Integer; //WITH_TSC
    {$ENDIF}
  end;

  PyThreadState = ^TyThreadState;
  TyThreadState = record
    next: PyThreadState;
    interp: PyInterpreterState;

    frame: PyFrameObject;
    recursion_depth: Integer;

    {$IFNDEF PYTHON23}
    ticker: Integer;
    {$ENDIF}
    tracing: Integer;
    {$IFDEF PYTHON22}
    use_tracing: Integer;
    {$ENDIF}

    {$IFDEF PYTHON22}
    c_profilefunc: Py_tracefunc;
    c_tracefunc: Py_tracefunc;
    c_profileobj: PyObject;
    c_traceobj: PyObject;
    {$ELSE}
    sys_profilefunc, sys_tracefunc: PyObject;
    {$ENDIF}

    curexc_type, curexc_value, curexc_traceback: PyObject;
    exc_type, exc_value, exc_traceback: PyObject;

    dict: PyObject;

    {$IFDEF PYTHON23}
    tick_counter, gilstate_counter: Integer;

    async_exc: PyObject;
    thread_id: LongInt;

    (* These were added in Python 2.7.4:
    trash_delete_nesting: Integer;
    trash_delete_later: PyObject;
    *)
    {$ENDIF}
  end;

var
  PyThreadState_Get: function : PyThreadState; cdecl;
  PyCode_Addr2Line: function(co: PyCodeObject; addrq: Integer) : Integer; cdecl; //Note: Added in Python 2.3.0
{$ENDIF}

//Macro's
//function PyTuple_GET_SIZE(o: PyObject) : {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF};{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
//function PyList_GET_SIZE(o: PyObject) : {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF};{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
//function PyDict_GET_SIZE(o: PyObject) : {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF};{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
//function PyString_GET_SIZE(o: PyObject) : {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF};{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}

 {-------------------}

function PyObject_NEW(t: PyTypeObject) : PyObject;
{function PyObject_NEWVAR(t: PyTypeObject; i: Integer) : PyObject;}
procedure PyObject_DEL(o: PyObject);
function Py_BuildValueX(const fmt: PyChar; const Args: array of const) : PyObject;
function PyArg_ParseTupleX(src: PyObject; const fmt: PyChar; const Args: array of const) : Integer;
//function PyArg_ParseTupleAndKeywordsX(arg, kwdict: PyObject; const fmt: PyChar; var kwlist: PyChar; const Args: array of const) : Integer;  pascal;
procedure Py_INCREF(o: PyObject);
procedure Py_DECREF(o: PyObject);
procedure Py_REF_Delta(o: PyObject; Delta: Integer);
procedure Py_XINCREF(o: PyObject);
procedure Py_XDECREF(o: PyObject);
//function PySeq_Length(o: PyObject) : {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF};
//function PySeq_Item(o: PyObject; index: {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF}) : PyObject;

var
 PyInt_Type:    PyTypeObject;
 PyType_Type:   PyTypeObject;
 PyList_Type:   PyTypeObject;
 PyString_Type: PyTypeObject;
 PyFloat_Type:  PyTypeObject;
 PyTuple_Type:  PyTypeObject;

function IsPythonLoaded : Boolean;
function InitializePython : Integer;
procedure UnInitializePython;
procedure SizeDownPython;

//These functions convert the Delphi String (AnsiString or UnicodeString) to Python's PChar (PAnsiChar or PUnicodeChar) and back.
{$IFDEF UNICODE}
function PyStrPas(const P: PyChar) : UnicodeString;{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
function ToPyChar(const S: UnicodeString) : PyChar;{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
{$ELSE}
function PyStrPas(const P: PyChar) : AnsiString;{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
function ToPyChar(const S: AnsiString) : PyChar;{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
{$ENDIF}

{$IFDEF PyProfiling}
function PythonGetStackTrace() : TStringList;
{$ENDIF}

 {-------------------}

implementation

uses
  {$IFDEF Debug}QkObjects, {$ENDIF}
  {$IFDEF DebugPythonLeak}{$IFNDEF PyProfiling}Classes,{$ENDIF} QConsts, PyObjects, Quarkx,{$ENDIF}
  Windows, Forms, SysUtils, StrUtils, {Registry2,} QkExceptions,
  ApplPaths, VersionNumbers, SystemDetails, Logging;

{$IFDEF DebugPythonLeak}
var g_PythonObjects: TList;
{$ENDIF}

 {-------------------}

const
  PythonVersionAny{: Cardinal} = $0000000; //Using Python's own PY_VERSION_HEX scheme here.
  PythonVersion230{: Cardinal} = $20300f0;
  //PythonVersion235{: Cardinal} = $20305f0;
  //PythonVersion250{: Cardinal} = $20500f0;
  //PythonVersion260{: Cardinal} = $20600f0;
  //PythonVersion270{: Cardinal} = $20700f0;
  PythonProcList: array[0..{$IFDEF PyProfiling}60{$ELSE}58{$ENDIF}] of record
                                    Variable: Pointer;
                                    Name: PChar;
                                    MinimalVersion: Cardinal;
                                  end =
  ( (Variable: @@Py_Initialize;              Name: 'Py_Initialize';              MinimalVersion: PythonVersionAny ),
    (Variable: @@Py_Finalize;                Name: 'Py_Finalize';                MinimalVersion: PythonVersionAny ),
    (Variable: @@Py_GetVersion;              Name: 'Py_GetVersion';              MinimalVersion: PythonVersionAny ),
    (Variable: @@Py_SetProgramName;          Name: 'Py_SetProgramName';          MinimalVersion: PythonVersionAny ),
    (Variable: @@PyRun_SimpleString;         Name: 'PyRun_SimpleString';         MinimalVersion: PythonVersionAny ),
//  (Variable: @@Py_CompileString;           Name: 'Py_CompileString';           MinimalVersion: PythonVersionAny ),
//  (Variable: @@Py_InitModule;              Name: 'Py_InitModule';              MinimalVersion: PythonVersionAny ), //Missing in DLL
//  (Variable: @@Py_InitModule3;             Name: 'Py_InitModule3';             MinimalVersion: PythonVersionAny ), //Missing in DLL
{$IFDEF CPU64BITS}
    (Variable: @@Py_InitModule4;             Name: 'Py_InitModule4_64';          MinimalVersion: PythonVersionAny ),
{$ELSE}
    (Variable: @@Py_InitModule4;             Name: 'Py_InitModule4';             MinimalVersion: PythonVersionAny ),
{$ENDIF}
    (Variable: @@PyModule_GetDict;           Name: 'PyModule_GetDict';           MinimalVersion: PythonVersionAny ),
    (Variable: @@PyModule_New;               Name: 'PyModule_New';               MinimalVersion: PythonVersionAny ),
//  (Variable: @@PyImport_ImportModule;      Name: 'PyImport_ImportModule';      MinimalVersion: PythonVersionAny ),
//  (Variable: @@PyEval_GetGlobals;          Name: 'PyEval_GetGlobals';          MinimalVersion: PythonVersionAny ),
//  (Variable: @@PyEval_GetLocals;           Name: 'PyEval_GetLocals';           MinimalVersion: PythonVersionAny ),
{$IFDEF PYTHON27}
    (Variable: @@PyEval_CallObjectWithKeywords; Name: 'PyEval_CallObjectWithKeywords'; MinimalVersion: PythonVersionAny ),
{$ELSE}
    (Variable: @@PyEval_CallObject;          Name: 'PyEval_CallObject';          MinimalVersion: PythonVersionAny ),
{$ENDIF}
    (Variable: @@PyCallable_Check;           Name: 'PyCallable_Check';           MinimalVersion: PythonVersionAny ),
    (Variable: @@PyErr_Print;                Name: 'PyErr_Print';                MinimalVersion: PythonVersionAny ),
    (Variable: @@PyErr_Clear;                Name: 'PyErr_Clear';                MinimalVersion: PythonVersionAny ),
    (Variable: @@PyErr_Occurred;             Name: 'PyErr_Occurred';             MinimalVersion: PythonVersionAny ),
    (Variable: @@PyErr_Fetch;                Name: 'PyErr_Fetch';                MinimalVersion: PythonVersionAny ),
    (Variable: @@PyErr_Restore;              Name: 'PyErr_Restore';              MinimalVersion: PythonVersionAny ),
    (Variable: @@PyErr_NewException;         Name: 'PyErr_NewException';         MinimalVersion: PythonVersionAny ),
    (Variable: @@PyErr_SetString;            Name: 'PyErr_SetString';            MinimalVersion: PythonVersionAny ),
    (Variable: @@PyErr_ExceptionMatches;     Name: 'PyErr_ExceptionMatches';     MinimalVersion: PythonVersionAny ),
    (Variable: @@PyObject_Length;            Name: 'PyObject_Length';            MinimalVersion: PythonVersionAny ),
//    (Variable: @@PyObject_GetItem;           Name: 'PyObject_GetItem';           MinimalVersion: PythonVersionAny ),
    (Variable: @@PyObject_HasAttrString;     Name: 'PyObject_HasAttrString';     MinimalVersion: PythonVersionAny ),
    (Variable: @@PyObject_GetAttrString;     Name: 'PyObject_GetAttrString';     MinimalVersion: PythonVersionAny ),
    (Variable: @@PyObject_IsTrue;            Name: 'PyObject_IsTrue';            MinimalVersion: PythonVersionAny ),
    (Variable: @@PyObject_Str;               Name: 'PyObject_Str';               MinimalVersion: PythonVersionAny ),
    (Variable: @@PyObject_Repr;              Name: 'PyObject_Repr';              MinimalVersion: PythonVersionAny ),
    (Variable: @@PySequence_GetItem;         Name: 'PySequence_GetItem';         MinimalVersion: PythonVersionAny ),
    (Variable: @@PySequence_In;              Name: 'PySequence_In';              MinimalVersion: PythonVersionAny ), //Is a legacy alias for the new PySequence_Contains
    (Variable: @@PySequence_Index;           Name: 'PySequence_Index';           MinimalVersion: PythonVersionAny ),
    (Variable: @@PySequence_DelItem;         Name: 'PySequence_DelItem';         MinimalVersion: PythonVersionAny ),
    (Variable: @@PyMapping_HasKey;           Name: 'PyMapping_HasKey';           MinimalVersion: PythonVersionAny ),
    (Variable: @@PyMapping_HasKeyString;     Name: 'PyMapping_HasKeyString';     MinimalVersion: PythonVersionAny ),
    (Variable: @@PyNumber_Float;             Name: 'PyNumber_Float';             MinimalVersion: PythonVersionAny ),
    (Variable: @@Py_BuildValue;              Name: 'Py_BuildValue';              MinimalVersion: PythonVersionAny ),
    (Variable: @@PyArg_ParseTuple;           Name: 'PyArg_ParseTuple';           MinimalVersion: PythonVersionAny ),
    (Variable: @@PyTuple_New;                Name: 'PyTuple_New';                MinimalVersion: PythonVersionAny ),
    (Variable: @@PyTuple_GetItem;            Name: 'PyTuple_GetItem';            MinimalVersion: PythonVersionAny ),
    (Variable: @@PyTuple_SetItem;            Name: 'PyTuple_SetItem';            MinimalVersion: PythonVersionAny ),
    (Variable: @@PyList_New;                 Name: 'PyList_New';                 MinimalVersion: PythonVersionAny ),
    (Variable: @@PyList_GetItem;             Name: 'PyList_GetItem';             MinimalVersion: PythonVersionAny ),
    (Variable: @@PyList_SetItem;             Name: 'PyList_SetItem';             MinimalVersion: PythonVersionAny ),
    (Variable: @@PyList_Insert;              Name: 'PyList_Insert';              MinimalVersion: PythonVersionAny ),
    (Variable: @@PyList_Append;              Name: 'PyList_Append';              MinimalVersion: PythonVersionAny ),
    (Variable: @@PyDict_New;                 Name: 'PyDict_New';                 MinimalVersion: PythonVersionAny ),
    (Variable: @@PyDict_SetItemString;       Name: 'PyDict_SetItemString';       MinimalVersion: PythonVersionAny ),
    (Variable: @@PyDict_GetItemString;       Name: 'PyDict_GetItemString';       MinimalVersion: PythonVersionAny ),
    (Variable: @@PyDict_GetItem;             Name: 'PyDict_GetItem';             MinimalVersion: PythonVersionAny ),
    (Variable: @@PyDict_Keys;                Name: 'PyDict_Keys';                MinimalVersion: PythonVersionAny ),
    (Variable: @@PyDict_Values;              Name: 'PyDict_Values';              MinimalVersion: PythonVersionAny ),
    (Variable: @@PyDict_Next;                Name: 'PyDict_Next';                MinimalVersion: PythonVersionAny ),
    (Variable: @@PyString_FromString;        Name: 'PyString_FromString';        MinimalVersion: PythonVersionAny ),
    (Variable: @@PyString_AsString;          Name: 'PyString_AsString';          MinimalVersion: PythonVersionAny ),
    (Variable: @@PyString_FromStringAndSize; Name: 'PyString_FromStringAndSize'; MinimalVersion: PythonVersionAny ),
    (Variable: @@PyString_Size;              Name: 'PyString_Size';              MinimalVersion: PythonVersionAny ),
    (Variable: @@PyInt_FromLong;             Name: 'PyInt_FromLong';             MinimalVersion: PythonVersionAny ),
    (Variable: @@PyInt_AsLong;               Name: 'PyInt_AsLong';               MinimalVersion: PythonVersionAny ),
//    (Variable: @@PyInt_FromSsize_t;          Name: 'PyInt_FromSsize_t';          MinimalVersion: PythonVersion250 ),
//    (Variable: @@PyInt_FromSize_t;           Name: 'PyInt_FromSize_t';           MinimalVersion: PythonVersion250 ),
//    (Variable: @@PyInt_AsSsize_t;            Name: 'PyInt_AsSsize_t';            MinimalVersion: PythonVersion250 ),
//    (Variable: @@PyInt_AsUnsignedLongMask;   Name: 'PyInt_AsUnsignedLongMask';   MinimalVersion: PythonVersion230 ),
//    (Variable: @@PyLong_FromLong;            Name: 'PyLong_FromLong';            MinimalVersion: PythonVersionAny ),
//    (Variable: @@PyLong_FromUnsignedLong;    Name: 'PyLong_FromUnsignedLong';    MinimalVersion: PythonVersionAny ),
//    (Variable: @@PyLong_FromSsize_t;         Name: 'PyLong_FromSsize_t';         MinimalVersion: PythonVersion260 ),
//    (Variable: @@PyLong_FromSize_t;          Name: 'PyLong_FromSize_t';          MinimalVersion: PythonVersion260 ),
//    (Variable: @@PyLong_FromDouble;          Name: 'PyLong_FromDouble';          MinimalVersion: PythonVersionAny ),
//    (Variable: @@PyLong_AsLong;              Name: 'PyLong_AsLong';              MinimalVersion: PythonVersionAny ),
//    (Variable: @@PyLong_AsLongAndOverflow;   Name: 'PyLong_AsLongAndOverflow';   MinimalVersion: PythonVersion270 ),
//    (Variable: @@PyLong_AsSsize_t;           Name: 'PyLong_AsSsize_t';           MinimalVersion: PythonVersion260 ),
//    (Variable: @@PyLong_AsUnsignedLong;      Name: 'PyLong_AsUnsignedLong';      MinimalVersion: PythonVersionAny ),
//    (Variable: @@PyLong_AsUnsignedLongMask;  Name: 'PyLong_AsUnsignedLongMask';  MinimalVersion: PythonVersion230 ),
//    (Variable: @@PyLong_AsDouble;            Name: 'PyLong_AsDouble';            MinimalVersion: PythonVersionAny ),
    (Variable: @@PyFloat_FromDouble;         Name: 'PyFloat_FromDouble';         MinimalVersion: PythonVersionAny ),
    (Variable: @@PyFloat_AsDouble;           Name: 'PyFloat_AsDouble';           MinimalVersion: PythonVersionAny ),
    (Variable: @@PyObject_Init;              Name: 'PyObject_Init';              MinimalVersion: PythonVersionAny ),
    (Variable: @@PyCFunction_New;            Name: 'PyCFunction_New';            MinimalVersion: PythonVersionAny ),
    (Variable: @@PyGC_Collect;               Name: 'PyGC_Collect';               MinimalVersion: PythonVersion230 ){$IFDEF PyProfiling},
    (Variable: @@PyThreadState_Get;          Name: 'PyThreadState_Get';          MinimalVersion: PythonVersionAny ),
    (Variable: @@PyCode_Addr2Line;           Name: 'PyCode_Addr2Line';           MinimalVersion: PythonVersion230 ){$ENDIF}
  );

var
  PythonLoaded: boolean;

  PythonLib: HMODULE;
  PythonDll: String;

 {-------------------}

{$IFDEF PYTHON27}
function PyEval_CallObjectX(o, args: PyObject) : PyObject; cdecl;
begin
  result := PyEval_CallObjectWithKeywords(o, args, nil);
end;
{$ENDIF}

 {-------------------}

function GoodPythonVersion(NumberToCheck: Cardinal; const PythonVersionNumber: TVersionNumber) : boolean;
var
  PY_MAJOR_VERSION, PY_MINOR_VERSION, PY_MICRO_VERSION{, PY_RELEASE_LEVEL, PY_RELEASE_SERIAL}: Cardinal;
begin
  //This function checks if the Python version 'encoded' in NumberToCheck
  //is equal or higher to the given PythonVersionNumber.
  PY_MAJOR_VERSION := NumberToCheck shr 24;
  PY_MINOR_VERSION := (NumberToCheck shr 16) mod 256;
  PY_MICRO_VERSION := (NumberToCheck shr 8) mod 256;
  //PY_RELEASE_LEVEL := (NumberToCheck shr 4) mod 16;
  //PY_RELEASE_SERIAL := NumberToCheck mod 16;
  Result:=PythonVersionNumber.IsEqualOrGreater([PY_MAJOR_VERSION, PY_MINOR_VERSION, PY_MICRO_VERSION]);
end;

(*function GetPython1Version(): String;
var
  R: TRegistry2;
begin
  R:=TRegistry2.Create(KEY_READ);
  try
    R.RootKey:=HKEY_LOCAL_MACHINE;
    if R.OpenKey('\SOFTWARE\Python\PythonCore\CurrentVersion', false) then
      Result:=R.ReadString('');
  finally
    R.free;
  end;
end;

function GetPython1DllPath(const Version: String): String;
var
  R: TRegistry2;
begin
  R:=TRegistry2.Create(KEY_READ);
  try
    R.RootKey:=HKEY_LOCAL_MACHINE;
    if R.OpenKey('\SOFTWARE\Python\PythonCore\'+Version+'\Dll', false) then
      Result:=R.ReadString('');
  finally
    R.free;
  end;
end;*)

function IsPythonLoaded : Boolean;
begin
  Result:=PythonLoaded;
end;

function InitializePython : Integer;
var
  obj1: PyObject;
  I: Integer;
  P: Pointer;
  s: string;
  Index: Integer;
  VersionNumber: TVersionNumber;
  VersionNumberString: String;
  FoundGoodVersion: Boolean;
begin
  VersionNumber:=nil;

  //See ProbableCauseOfFatalError in QuarkX for return value meaning
  Result:=6;

  //We are using PYTHONHOME env instead of calling Py_SetPythonHome,
  //because this automatically gives us static storage that Python required.
  //Be careful though,  you are not allowed to change its value!
  S:=ExtractFileDir(Application.Exename);
  if SetEnvironmentVariable('PYTHONHOME', PChar(S)) = false then
    Exit;
  if SetEnvironmentVariable('PYTHONPATH', PChar(ConcatPaths([S, 'Lib']))) = false then //Note that this doesn't actually work if Python is embedded, but for consistency, let's set it anyway.
    Exit;
//FIXME: Not used for now
//  if SetEnvironmentVariable('PYTHONOPTIMIZE', '1') = false then
//    Exit;
{$IFDEF Debug}
  if SetEnvironmentVariable('PYTHONDEBUG', '1') = false then
    Exit;
  //if SetEnvironmentVariable('PYTHONVERBOSE', '1') = false then
  //  Exit;
  if SetEnvironmentVariable('PYTHONDUMPREFS', '1') = false then
    Exit;
{$ENDIF}
  //if SetEnvironmentVariable('PYTHONDONTWRITEBYTECODE', '1') = false then
  //  Exit;
  Result:=5;

  if PythonLib=0 then
  begin
    PythonDll:='python.dll';

    Log(LOG_VERBOSE, 'Now loading Python DLL...');
    PythonLib:=LoadLibrary(PChar(ConcatPaths([GetQPath(pQuArKDll), PythonDll])));
    if PythonLib=0 then
    begin
      //If the PythonDLL was not found in the dlls-dir,
      //let's try to load from anywhere else...
      {$IFDEF PYTHON27}
       PythonDll:='python27.dll';
      {$ELSE}
       {$IFDEF PYTHON26}
        PythonDll:='python26.dll';
       {$ELSE}
        {$IFDEF PYTHON25}
         PythonDll:='python25.dll';
        {$ELSE}
         {$IFDEF PYTHON24}
          PythonDll:='python24.dll';
         {$ELSE}
          {$IFDEF PYTHON23}
           PythonDll:='PYTHON23.DLL';
          {$ELSE}
           {$IFDEF PYTHON22}
            PythonDll:='PYTHON22.DLL';
           {$ELSE}
            {$IFDEF PYTHON21}
             PythonDll:='PYTHON21.DLL';
            {$ELSE}
             {$IFDEF PYTHON20}
              PythonDll:='PYTHON20.DLL';
             {$ELSE}
              PythonDll:='';
             {$ENDIF}
            {$ENDIF}
           {$ENDIF}
          {$ENDIF}
         {$ENDIF}
        {$ENDIF}
       {$ENDIF}
      {$ENDIF}

      if PythonDll<>'' then
        PythonLib:=LoadLibrary(PChar(PythonDll));

      if PythonLib=0 then
      begin
        Exit;  {This is handled manually}
        {Raise InternalE('Unable to load dlls/PythonLib.dll');}
      end;
    end;
  end;
  Result:=4;

  //First load the all-version functions (in order to load Py_GetVersion)
  for I:=Low(PythonProcList) to High(PythonProcList) do
  begin
    if (PythonProcList[I].MinimalVersion = PythonVersionAny) then
    begin
      P:=GetProcAddress(PythonLib, PythonProcList[I].Name);
      if P=Nil then
      begin
        Log(LOG_PYTHON, LOG_CRITICAL, 'Unable to load %s!', [PythonProcList[I].Name]);
        Exit;
      end;
    end
    else
      P:=nil;
    PPointer(PythonProcList[I].Variable)^:=P;
  end;
  {$IFDEF PYTHON27}
  PyEval_CallObject := PyEval_CallObjectX;
  {$ENDIF}
  Py_SetProgramName(ToPyChar(Application.Exename));
  Py_Initialize;
  s:=PyStrPas(Py_GetVersion());
  Log(LOG_PYTHON, 'PYTHON:');
  Log(LOG_PYTHON, 'Version: %s', [s]);
  Log(LOG_PYTHON, 'DLL: %s', [RetrieveModuleFilename(PythonLib)]);
  Result:=3;

  //Process Py_GetVersion to find version number. It is documented to be the version number, followed by a space, and its description.
  Index:=Pos(' ', s);
  if Index <> 0 then
    VersionNumberString:=LeftStr(s, Index-1)
  else
    VersionNumberString:=s;

  try
    VersionNumber:=TVersionNumber.Create(VersionNumberString);

    if VersionNumber.Count = 0 then
    begin
      Log(LOG_WARNING, 'Cannot parse Python version number %s!', [s]);
      Exit;
    end;

    if VersionNumber.IsEqualOrGreater([3]) then
    begin
      //Python 3 or larger: Proceed at own risk!
      FoundGoodVersion:=True;
      LogAndWarn(Format('Unsupported, future version (%s) of Python found! QuArK might behave unpredictably!', [VersionNumberString]));
    end
    else if VersionNumber.IsEqualOrGreater([2, 4]) then
    begin
      //Python 2.4 or higher: Supported!
      FoundGoodVersion:=True;
      if not VersionNumber.IsEqual([2, 4, 4]) then
        LogAndWarn(Format('A different version (%s) of Python than supported found! QuArK might behave unpredictably!', [VersionNumberString]));
    end
    else
      FoundGoodVersion:=False;

    if not FoundGoodVersion then
    begin
      LogAndWarn(Format('Unsupported version (%s) of Python found!', [VersionNumberString]));
      Exit;
    end;
    Result:=2;

    //Now that we know the Python version, load the version-specific functions
    for I:=Low(PythonProcList) to High(PythonProcList) do
    begin
      if (PythonProcList[I].MinimalVersion = PythonVersionAny) then
        continue;
      if GoodPythonVersion(PythonProcList[I].MinimalVersion, VersionNumber) then
      begin
        P:=GetProcAddress(PythonLib, PythonProcList[I].Name);
        if P=Nil then
        begin
          Log(LOG_PYTHON, LOG_CRITICAL, 'Unable to load %s!', [PythonProcList[I].Name]);
          Exit;
        end;
        PPointer(PythonProcList[I].Variable)^:=P;
      end;
    end;
    Result:=1;

  finally
    if VersionNumber<>nil then VersionNumber.Free;
  end;

  //Retrieve the values of the basic Python types
  obj1:=PyList_New(0);
  if obj1=Nil then
    Exit;
  PyList_Type:=obj1^.ob_type;
  Py_DECREF(obj1);

  obj1:=PyTuple_New(0);
  if obj1=Nil then
    Exit;
  PyTuple_Type:=obj1^.ob_type;
  Py_DECREF(obj1);

  obj1:=PyInt_FromLong(0);
  if obj1=Nil then
    Exit;
  PyInt_Type:=obj1^.ob_type;
  Py_DECREF(obj1);

  obj1:=PyString_FromString('');
  if obj1=Nil then
    Exit;
  PyString_Type:=obj1^.ob_type;
  Py_DECREF(obj1);

  obj1:=PyFloat_FromDouble(0.0);
  if obj1=Nil then
    Exit;
  PyFloat_Type:=obj1^.ob_type;
  Py_DECREF(obj1);

  //It is not possible to create a PyType_Type directly. However,
  //we can get it through a PyType we already have.
  PyType_Type:=PyList_Type^.ob_type;

  PythonLoaded:=true;
  Result:=0;
end;

procedure UnInitializePython;
var
  I: Integer;
begin
  if PythonLib<>0 then
  begin
    if FreeLibrary(PythonLib)=false then
    begin
      //FIXME: If FreeLibrary failed, can we still trust the loaded Python?
      //       Shouldn't we be killing PythonLoaded?
      LogWindowsError(GetLastError(), 'FreeLibrary(PythonLib)');
      LogAndRaiseError('Unable to unload the Python library');
    end;
    PythonLib:=0;

    PythonLoaded:=false;

    for I:=Low(PythonProcList) to High(PythonProcList) do
      PPointer(PythonProcList[I].Variable)^:=nil;
  end;
end;

procedure SizeDownPython;
begin
  //GC doesn't work when PyErr is set
  //See: https://github.com/python/cpython/commit/2fe940c727802ad54cff9486c658bc38743f7bfc
  if PyErr_Occurred<>Nil then
    Exit;
  if Assigned(PyGC_Collect) then
    PyGC_Collect; //FIXME: PythonEnd code?
end;

function PyObject_NEW(t: PyTypeObject) : PyObject;
var
 o: PyObject;
begin
  {$IFDEF DEBUG}
  o:=AllocMem(t^.tp_basicsize);
  {$ELSE}
  GetMem(o, t^.tp_basicsize);
  {$ENDIF}
  Result:=PyObject_Init(o,t);
  {$IFDEF DebugPythonLeak}
  g_PythonObjects.Add(o);
  {$ENDIF}
end;

(*function PyObject_NEWVAR(t: PyTypeObject; i: Integer) : PyObject;
var
 o: PyObject;
begin
 {$IFDEF DEBUG}
 o:=AllocMem(t^.tp_basicsize + i*t^.tp_itemsize);
 {$ELSE}
 GetMem(o, t^.tp_basicsize + i*t^.tp_itemsize);
 {$ENDIF}
 Result:=_PyObject_NewVar(t,i,o);
end;*)

procedure PyObject_DEL(o: PyObject);
begin
  {$IFDEF DebugPythonLeak}
  g_PythonObjects.Remove(o);
  {$ENDIF}
  FreeMem(o);
end;

//In Delphi, "array of const" is defined as an open array of TVarRec's.
//The argument gets replaced by the compiler by a Pointer to a number of TVarRec's,
//and another argument that's an Integer with the Length of the array.
//TVarRec is a record with its first member (pointer/integer-sized) containing the data,
//and a second member a Byte called VType indicating what type of data the first record holds.

//We implement the following Python types:
//O (object), which will be a vtPointer (PyObject).
//i (integer), which will be a vtInteger.
//s (string), which will be a vtPChar or vtPWideChar (PyChar).
//f (float), which will be a vtExtended (10 byte float).
//d (double), which will be a vtExtended (10 byte float).

//Note that this function does NOT contain a full-featured parser for the format string;
//let's only implement what we need here. For example, we're not implementing 'p' boolean.
//Additionally, we're "cheating" with 'O!'; it requires a TypeObject, and then
//a PyObject, but we're "mis"-parsing it as two pointers, which is functionally equivalent.
function Py_BuildValueX(const fmt: PyChar; const Args: array of const) : PyObject;
var
  StackGrowth: size_t;
asm
  {$IFDEF CPUX86}
  //EAX: fmt
  //EDX: pointer to Args's first item
  //ECX: length of Args, minus 1

  push edi               { store the value of edi, because we want to use that register }
  push esi               { store the value of esi, because we want to use that register }

  inc ecx                { get the actual number of items }

  //We have to jump to the end of the Args-array, because we have to iterate over it reversed
  mov edi, ecx           { we're going to calculate the number of bytes from the number of items }
  shl edi, 3             { multiply the number of elements with SizeOf(TVarRec) }
  add edx, edi           { go to the end of the Args-array (one past it) }

  mov StackGrowth, 0   { this is the amount with which we've grown the stack }

  //Loop over the Args-array
  mov esi, eax         { we have to walk over the fmt in order to distinguish floats from doubles }
  @L1:
    //We have to skip over any symbols in fmt that don't need an argument
    @testFmtChar:
    cmp byte ptr [esi], '('       { skip '(' }
    jz @skipFmtChar
    cmp byte ptr [esi], ')'       { skip ')' }
    jz @skipFmtChar
    //cmp byte ptr [esi], '{'       { skip '{' }
    //jz @skipFmtChar
    //cmp byte ptr [esi], '}'       { skip '}' }
    //jz @skipFmtChar
    cmp byte ptr [esi], '|'       { skip '|' }
    jz @skipFmtChar
    //cmp byte ptr [esi], ':'       { skip ':' }
    //jz @skipFmtChar
    //cmp byte ptr [esi], ','       { skip '.' }
    //jz @skipFmtChar
    //cmp byte ptr [esi], ' '       { skip ' ' }
    //jz @skipFmtChar
    cmp byte ptr [esi], 0         { sanity check for end of fmt-string }
    jnz @FmtReady      { jump if we found a format-character }

    add esp, StackGrowth   { remove the arguments we pushed onto the stack }
    pop esi                { restore the original value of esi }
    pop edi                { restore the original value of edi }
    mov al, reInvalidCast  { prepare an "invalid cast" error }
    jmp System.Error       { raise the error }

    @skipFmtChar:
    inc esi            { go to the next character }
    jmp @testFmtChar   { test that one too }
    @FmtReady:

    //Process the Args-item
    sub edx, 8    { go back one item in the Args-array; 8 = SizeOf(TVarRec) }
    //[EDX].Integer[0] = TVarRec.data
    //[EDX].Byte[4]    = TVarRec.VType
    movzx edi, [edx].Byte[4]          // TVarRec.VType
    cmp edi, vtInteger    { handle integers }
    jz @lInteger
    cmp edi, vtExtended   { handle floating points }
    jz @lExtended
    cmp edi, vtPointer    { handle objects }
    jz @lPointer
    cmp edi, vtPChar      { handle strings }
    jz @lPointer
    cmp edi, vtPWideChar  { handle strings }
    jz @lPointer

    //If we reach this point, there's an unsupported variable type in the Args-array
    add esp, StackGrowth   { remove the arguments we pushed onto the stack }
    pop esi                { restore the original value of esi }
    pop edi                { restore the original value of edi }
    mov al, reInvalidCast  { prepare an "invalid cast" error }
    jmp System.Error       { raise the error }

    //Convert the item
    @lInteger:
    push dword ptr [edx]               { push the integer onto the stack }
    add StackGrowth, 4
    jmp @lDoneConverting

    @lExtended:
    mov edi, [edx]            { it's a pointer to a double, so dereference it once }
    fld tbyte ptr [edi]       { put the 10 byte float into x87 stack }
    cmp byte ptr [esi], 'f'   { floats are 4 bytes, doubles are 8 bytes }
    jz @isFloat
    sub esp, 8                { make room on stack for the double }
    fstp qword ptr [esp]      { pop double from x87 stack onto CPU stack }
    fwait                     { make sure any floating point exceptions are handled }
    add StackGrowth, 8        { double, so this requires 8 bytes}
    jmp @lDoneConverting
    @isFloat:
    sub esp, 4                { make room on stack for the float }
    add StackGrowth, 4
    fstp dword ptr [esp]      { pop single from x87 stack onto CPU stack }
    fwait                     { make sure any floating point exceptions are handled }
    jmp @lDoneConverting

    @lPointer:
    push dword ptr [edx]  { push the pointer onto the stack }
    add StackGrowth, 4
    //jmp @lDoneConverting

    @lDoneConverting:

    dec ecx              { we've finished processing an item in the Args-array }
    jnz @L1              { back to L1 if we're not done with the Args-array yet }
  push fmt               { push the fmt-string onto the stack as well, making it the first argument for Py_BuildValue }
  add StackGrowth, 4
  call Py_BuildValue     { call Py_BuildValue }
  add esp, StackGrowth   { remove the arguments we pushed onto the stack }
  pop esi                { restore the original value of esi }
  pop edi                { restore the original value of edi }

  //Result in EAX
  {$ELSE}
  {$IFDEF CPUX64}
  //RCX: fmt
  //RDX: pointer to Args's first item
  //R8: length of Args, minus 1

  push rdi               { store the value of rdi, because we want to use that register }
  push rsi               { store the value of rsi, because we want to use that register }

  inc r8                 { get the actual number of items }
  mov rax, r8            { free up the r8 register }

  //We have to jump to the end of the Args-array, because we have to iterate over it reversed
  mov rdi, r8            { we're going to calculate the number of bytes from the number of items }
  shl rdi, 4             { multiply the number of elements with SizeOf(TVarRec) }
  add rdx, rdi           { go to the end of the Args-array (one past it) }

  mov StackGrowth, 0     { this is the amount with which we've grown the stack }

  //Always need room for 4 arguments on the stack
  cmp rax, 3             { if there are 3 or more arguments, we don't need to reserve anything on the stack }
  jge @lDoneReservering
  push 0
  add StackGrowth, 8

  cmp rax, 2             { if there are 2 arguments, we've already reserved enough }
  je @lDoneReservering
  push 0
  add StackGrowth, 8

  cmp rax, 1             { if there is 1 argument, we've already reserved enough }
  je @lDoneReservering
  push 0
  add StackGrowth, 8

  @lDoneReservering:

  //Loop over the Args-array
  mov rsi, rcx         { we have to walk over the fmt in order to distinguish floats from doubles }
  @L1:
    //We have to skip over any symbols in fmt that don't need an argument
    @testFmtChar:
    cmp byte ptr [rsi], '('       { skip '(' }
    jz @skipFmtChar
    cmp byte ptr [rsi], ')'       { skip ')' }
    jz @skipFmtChar
    //cmp byte ptr [rsi], '{'       { skip '{' }
    //jz @skipFmtChar
    //cmp byte ptr [rsi], '}'       { skip '}' }
    //jz @skipFmtChar
    cmp byte ptr [rsi], '|'       { skip '|' }
    jz @skipFmtChar
    //cmp byte ptr [rsi], ':'       { skip ':' }
    //jz @skipFmtChar
    //cmp byte ptr [rsi], ','       { skip '.' }
    //jz @skipFmtChar
    //cmp byte ptr [rsi], ' '       { skip ' ' }
    //jz @skipFmtChar
    cmp byte ptr [rsi], 0         { sanity check for end of fmt-string }
    jnz @FmtReady      { jump if we found a format-character }

    //If we reach this point, the fmt-string is bad!
    add rsp, StackGrowth   { remove the arguments we pushed onto the stack }
    pop rsi                { restore the original value of rsi }
    pop rdi                { restore the original value of rdi }
    mov al, reInvalidCast  { prepare an "invalid cast" error }
    jmp System.Error       { raise the error }

    @skipFmtChar:
    inc rsi            { go to the next character }
    jmp @testFmtChar   { test that one too }
    @FmtReady:

    //Process the Args-item
    sub rdx, 16    { go back one item in the Args-array; 16 = SizeOf(TVarRec) }
    //[RDX].Integer[0] = TVarRec.data
    //[RDX].Byte[4]    = TVarRec.VType
    movzx rdi, [rdx].Byte[8]          // TVarRec.VType
    cmp rdi, vtInteger    { handle integers }
    jz @lInteger
    cmp rdi, vtExtended   { handle floating points }
    jz @lExtended
    cmp rdi, vtPointer    { handle objects }
    jz @lPointer
    cmp rdi, vtPChar      { handle strings }
    jz @lPointer
    cmp rdi, vtPWideChar  { handle strings }
    jz @lPointer

    //If we reach this point, there's an unsupported variable type in the Args-array
    add rsp, StackGrowth   { remove the arguments we pushed onto the stack }
    pop rsi                { restore the original value of rsi }
    pop rdi                { restore the original value of rdi }
    mov al, reInvalidCast  { prepare an "invalid cast" error }
    jmp System.Error       { raise the error }

    //Convert the item
    @lInteger:
    push qword ptr [rdx]               { push the integer onto the stack }
    add StackGrowth, 8
    jmp @lPutInRegister

    @lExtended:
    mov rdi, [rdx]            { it's a pointer to a double, so dereference it once }
    cmp byte ptr [rsi], 'f'   { floats are 4 bytes, doubles are 8 bytes }
    jz @isFloat
    push qword ptr [rdi]      { push the double onto the stack }
    add StackGrowth, 8        { double, so this requires 8 bytes}
    jmp @lPutInRegisterDouble
    @isFloat:
    sub rsp, 4                { make room on stack for the float }
    fld qword ptr [rdi]       { put the 10 byte float into x87 stack }
    fstp dword ptr [rsp]      { pop single from x87 stack onto CPU stack }
    fwait                     { make sure any floating point exceptions are handled }
    add StackGrowth, 4
    jmp @lPutInRegisterFloat

    @lPointer:
    push qword ptr [rdx]  { push the pointer onto the stack }
    add StackGrowth, 8
    //jmp @lPutInRegister

    @lPutInRegister:
    //Put the second, third, and fourth arguments (if any) in the rdx, r8, and r9 registers respectively
    cmp rax, 1            { second argument }
    jne @lPutInRegister2
    mov rdx, [rsp]
    jmp @lRegistersReady
    @lPutInRegister2:
    cmp rax, 2            { third argument }
    jne @lPutInRegister3
    mov r8, [rsp]
    jmp @lRegistersReady
    @lPutInRegister3:
    cmp rax, 3            { fourth argument }
    jne @lRegistersReady
    mov r9, [rsp]
    jmp @lRegistersReady

    @lPutInRegisterFloat:
    //Put the second, third, and fourth arguments (if any) in the xmm1, xmm2, xmm3 registers respectively
    cmp rax, 1            { second argument }
    jne @lPutInRegisterFloat2
    movss xmm1, [rsp]
    jmp @lRegistersReady
    @lPutInRegisterFloat2:
    cmp rax, 2            { third argument }
    jne @lPutInRegisterFloat3
    movss xmm2, [rsp]
    jmp @lRegistersReady
    @lPutInRegisterFloat3:
    cmp rax, 3            { fourth argument }
    jne @lRegistersReady
    movss xmm3, [rsp]
    jmp @lRegistersReady

    @lPutInRegisterDouble:
    //Put the second, third, and fourth arguments (if any) in the xmm1, xmm2, xmm3 registers respectively
    cmp rax, 1            { second argument }
    jne @lPutInRegisterDouble2
    movsd xmm1, [rsp]
    jmp @lRegistersReady
    @lPutInRegisterDouble2:
    cmp rax, 2            { third argument }
    jne @lPutInRegisterDouble3
    movsd xmm2, [rsp]
    jmp @lRegistersReady
    @lPutInRegisterDouble3:
    cmp rax, 3            { fourth argument }
    jne @lRegistersReady
    movsd xmm3, [rsp]
    //jmp @lRegistersReady

    @lRegistersReady:

    dec rax              { we've finished processing an item in the Args-array }
    jnz @L1              { back to L1 if we're not done with the Args-array yet }

  push fmt               { push the fmt-string onto the stack as well, making it the first argument for Py_BuildValue }
  add StackGrowth, 8
  call Py_BuildValue     { call Py_BuildValue }
  add rsp, StackGrowth   { remove the arguments we pushed onto the stack }
  pop rsi                { restore the original value of rsi }
  pop rdi                { restore the original value of rdi }

  //Result in RAX
  {$ELSE}
  {$Message Error 'Unsupported CPU architecture!'}
  {$ENDIF}
  {$ENDIF}
end;

//See documentation for Py_BuildValueX above for more information
function PyArg_ParseTupleX(src: PyObject; const fmt: PyChar; const Args: array of const) : Integer;
var
  StackGrowth: size_t;
asm
  {$IFDEF CPUX86}
  //EAX: src
  //EDX: fmt
  //ECX: pointer to Args's first item
  //ESP+12: length of Args, minus 1

  push edi               { store the value of edi, because we want to use that register }
  push esi               { store the value of esi, because we want to use that register }
  push ebx               { store the value of ebx, because we want to use that register }

  mov ebx, [esp+24]      { we're pushing things onto the stack, so we need Args in a register }
  inc ebx                { get the actual number of items }

  //We have to jump to the end of the Args-array, because we have to iterate over it reversed
  mov edi, ebx           { we're going to calculate the number of bytes from the number of items }
  shl edi, 3             { multiply the number of elements with SizeOf(TVarRec) }
  add ecx, edi           { go to the end of the Args-array (one past it) }

  mov StackGrowth, 0     { this is the amount with which we've grown the stack }

  //Loop over the Args-array
  mov esi, edx           { we have to walk over the fmt in order to distinguish floats from doubles }
  @L1:
    //We have to skip over any symbols in fmt that don't need an argument
    @testFmtChar:
    cmp byte ptr [esi], '('       { skip '(' }
    jz @skipFmtChar
    cmp byte ptr [esi], ')'       { skip ')' }
    jz @skipFmtChar
    //cmp byte ptr [esi], '{'       { skip '{' }
    //jz @skipFmtChar
    //cmp byte ptr [esi], '}'       { skip '}' }
    //jz @skipFmtChar
    cmp byte ptr [esi], '|'       { skip '|' }
    jz @skipFmtChar
    //cmp byte ptr [esi], ':'       { skip ':' }
    //jz @skipFmtChar
    //cmp byte ptr [esi], ','       { skip '.' }
    //jz @skipFmtChar
    //cmp byte ptr [esi], ' '       { skip ' ' }
    //jz @skipFmtChar
    cmp byte ptr [esi], 0         { sanity check for end of fmt-string }
    jnz @FmtReady      { jump if we found a format-character }

    //If we reach this point, the fmt-string is bad!
    add esp, StackGrowth   { remove the arguments we pushed onto the stack }
    pop ebx                { restore the original value of ebx }
    pop esi                { restore the original value of esi }
    pop edi                { restore the original value of edi }
    mov al, reInvalidCast  { prepare an "invalid cast" error }
    jmp System.Error       { raise the error }

    @skipFmtChar:
    inc esi            { go to the next character }
    jmp @testFmtChar   { test that one too }
    @FmtReady:

    //Process the Args-item
    sub ecx, 8    { go back one item in the Args-array; 8 = SizeOf(TVarRec) }
    //[ECX].Integer[0] = TVarRec.data
    //[ECX].Byte[4]    = TVarRec.VType
    movzx edi, [ecx].Byte[4]          // TVarRec.VType
    cmp edi, vtInteger    { handle integers }
    jz @lInteger
    cmp edi, vtExtended   { handle floating points }
    jz @lExtended
    cmp edi, vtPointer    { handle objects }
    jz @lPointer
    cmp edi, vtPChar      { handle strings }
    jz @lPointer
    cmp edi, vtPWideChar  { handle strings }
    jz @lPointer

    //If we reach this point, there's an unsupported variable type in the Args-array
    add esp, StackGrowth   { remove the arguments we pushed onto the stack }
    pop ebx                { restore the original value of ebx }
    pop esi                { restore the original value of esi }
    pop edi                { restore the original value of edi }
    mov al, reInvalidCast  { prepare an "invalid cast" error }
    jmp System.Error       { raise the error }

    //Convert the item
    @lInteger:
    push dword ptr [ecx]               { push the integer onto the stack }
    add StackGrowth, 4
    jmp @lDoneConverting

    @lExtended:
    mov edi, [ecx]            { it's a pointer to a double, so dereference it once }
    fld tbyte ptr [edi]       { put the 10 byte float into x87 stack }
    cmp byte ptr [esi], 'f'   { floats are 4 bytes, doubles are 8 bytes }
    jz @isFloat
    sub esp, 8                { make room on stack for the double }
    fstp qword ptr [esp]      { pop double from x87 stack onto CPU stack }
    fwait                     { make sure any floating point exceptions are handled }
    add StackGrowth, 8        { double, so this requires 8 bytes}
    jmp @lDoneConverting
    @isFloat:
    sub esp, 4                { make room on stack for the float }
    add StackGrowth, 4
    fstp dword ptr [esp]      { pop single from x87 stack onto CPU stack }
    fwait                     { make sure any floating point exceptions are handled }
    jmp @lDoneConverting

    @lPointer:
    push dword ptr [ecx]  { push the pointer onto the stack }
    add StackGrowth, 4
    //jmp @lDoneConverting

    @lDoneConverting:

    dec ebx              { we've finished processing an item in the Args-array }
    jnz @L1              { back to L1 if we're not done with the Args-array yet }
  push fmt               { push the fmt-string onto the stack  }
  push src               { push the src-object onto the stack as well, making it the first argument for Py_BuildValue }
  add StackGrowth, 8
  call PyArg_ParseTuple  { call PyArg_ParseTuple }
  add esp, StackGrowth   { remove the arguments we pushed onto the stack }
  pop ebx                { restore the original value of ebx }
  pop esi                { restore the original value of esi }
  pop edi                { restore the original value of edi }

  //Result in EAX
  {$ELSE}
  {$IFDEF CPUX64}
  //RCX: src
  //RDX: fmt
  //R8: pointer to Args's first item
  //R9: length of Args, minus 1

  push rdi               { store the value of rdi, because we want to use that register }

  inc r9                 { get the actual number of items }
  mov rax, r9            { store a copy of the number of items }

  //We have to jump to the end of the Args-array, because we have to iterate over it reversed
  mov rdi, r9            { we're going to calculate the number of bytes from the number of items }
  shl rdi, 4             { multiply the number of elements with SizeOf(TVarRec) }
  add r8, rdi            { go to the end of the Args-array (one past it) }

  mov StackGrowth, 0     { this is the amount with which we've grown the stack }

  //Always need room for 4 arguments on the stack
  cmp rax, 2             { if there are 2 or more arguments, we don't need to reserve anything on the stack }
  jge @lDoneReservering
  push 0
  add StackGrowth, 8

  cmp rax, 1             { if there is 1 argument, we've already reserved enough }
  je @lDoneReservering
  push 0
  add StackGrowth, 8

  @lDoneReservering:

  //Loop over the Args-array
  @L1:
    //Process the Args-item
    sub r8, 16    { go back one item in the Args-array; 16 = SizeOf(TVarRec) }
    //[R8].Integer[0] = TVarRec.data
    //[R8].Byte[8]    = TVarRec.VType
    movzx rdi, [r8].Byte[8]          // TVarRec.VType
    //cmp rdi, vtInteger    { handle integers }
    //jz @lInteger
    //cmp rdi, vtExtended   { handle floating points }
    //jz @lExtended
    cmp rdi, vtPointer    { handle objects }
    jz @lPointer
    //cmp rdi, vtPChar      { handle strings }
    //jz @lPointer
    //cmp rdi, vtPWideChar  { handle strings }
    //jz @lPointer

    //If we reach this point, there's an unsupported variable type in the Args-array
    add rsp, StackGrowth   { remove the arguments we pushed onto the stack }
    pop rdi                { restore the original value of rdi }
    mov al, reInvalidCast  { prepare an "invalid cast" error }
    jmp System.Error       { raise the error }

    //Convert the item
    @lPointer:
    push qword ptr [r8]  { push the pointer onto the stack }
    add StackGrowth, 8
    //jmp @lDoneConverting

    //@lDoneConverting:

    dec r9               { we've finished processing an item in the Args-array }
    jnz @L1              { back to L1 if we're not done with the Args-array yet }

  //Put the third and fourth arguments (if any) in the r8 and r9 registers respectively
  cmp rax, 0
  jle @lRegistersReady
  mov r8, [rsp]
  cmp rax, 1
  jle @lRegistersReady
  mov r9, [rsp+8]
  @lRegistersReady:

  push fmt               { push the fmt-string onto the stack }
  push src               { push the src-object onto the stack as well }
  add StackGrowth, 16
  call PyArg_ParseTuple  { call PyArg_ParseTuple }
  add rsp, StackGrowth   { remove the arguments we pushed onto the stack }
  pop rdi                { restore the original value of rdi }

  //Result in RAX
  {$ELSE}
  {$Message Error 'Unsupported CPU architecture!'}
  {$ENDIF}
  {$ENDIF}
end;

//FIXME: Still needs to be modified to handle double's!!!
(*function PyArg_ParseTupleAndKeywordsX(arg, kwdict: PyObject; const fmt: PyChar; var kwlist: PyChar; const Args: array of const) : Integer; pascal; assembler;
asm
 {$IFDEF CPUX86}
 mov ecx, [Args-4]
 mov edx, [Args]
 add ecx, ecx
 add ecx, ecx
 add ecx, ecx
 add ecx, edx
 @L1:
  mov eax, [ecx]
  push eax
  sub ecx, 8
  cmp ecx, edx
 jnb @L1
 push [kwlist]
 push [fmt]
 push [kwdict]
 push [arg]
 //call PyArg_ParseTupleAndKeywords
 {$ELSE}
 {$IFDEF CPUX64}
 {$Message Error 'Unsupported CPU architecture!'} //FIXME
 {$ELSE}
 {$Message Error 'Unsupported CPU architecture!'}
 {$ENDIF}
 {$ENDIF}
end;*)

{$IFDEF PyRefDEBUG}
procedure RefError;{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
begin
 Raise InternalE('Python Reference count error');
end;
{$ENDIF}

procedure Py_INCREF(o: PyObject);{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
begin
  with o^ do
  begin
    {$IFDEF PyRefDEBUG}
    if ob_refcnt<0 then
      RefError();
    {$ENDIF}
    Inc(ob_refcnt);
  end;
end;

procedure Py_XINCREF(o: PyObject);{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
begin
  if o <> nil then Py_INCREF(o);
end;

procedure Py_Dealloc(o: PyObject);{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
begin
  with o^ do
  begin
    if @ob_type^.tp_dealloc<>nil then
      ob_type^.tp_dealloc(o);
  end;
end;

procedure Py_DECREF(o: PyObject);
begin
  with o^ do
  begin
    {$IFDEF PyRefDEBUG}
    if ob_refcnt <= 0 then
      RefError();
    {$ENDIF}
    Dec(ob_refcnt);
    if ob_refcnt = 0 then
      Py_Dealloc(o);
  end;
end;

procedure Py_XDECREF(o: PyObject);
begin
  if o <> nil then Py_DECREF(o);
end;

procedure Py_REF_Delta(o: PyObject; Delta: Integer);
begin
  if Delta=0 then
    {$IFDEF DEBUG}
    Raise InternalE('Delta = 0!');
    {$ELSE}
    Exit;
    {$ENDIF}
  with o^ do
  begin
    {$IFDEF PyRefDEBUG}
    if ob_refcnt<0 then
      RefError();
    if (Delta<0) and (ob_refcnt=0) then
      RefError();
    {$ENDIF}
    Inc(ob_refcnt, Delta);
    {$IFDEF PyRefDEBUG}
    if ob_refcnt < 0 then
      RefError();
    {$ENDIF}
    if ob_refcnt <= 0 then
      Py_Dealloc(o);
  end;
end;

(*function PySeq_Length(o: PyObject) : {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF};
begin
 with PyTypeObject(o^.ob_type)^ do
  if (tp_as_sequence=Nil) or not Assigned(tp_as_sequence^.sq_length) then
   Result:=0
  else
   Result:=tp_as_sequence^.sq_length(o);
end;

function PySeq_Item(o: PyObject; index: {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF}) : PyObject;
begin
 with PyTypeObject(o^.ob_type)^ do
  if (tp_as_sequence=Nil) or not Assigned(tp_as_sequence^.sq_item) then
   Result:=Nil
  else
   Result:=tp_as_sequence^.sq_item(o, index);
end;*)

{$IFDEF UNICODE}
function PyStrPas(const P: PyChar) : UnicodeString;
begin
 Result:=UnicodeString(P);
end;

function ToPyChar(const S: UnicodeString) : PyChar;
begin
 Result:=PAnsiChar(AnsiString(S));
end;
{$ELSE}
function PyStrPas(const P: PyChar) : AnsiString;
begin
 Result:=P;
end;

function ToPyChar(const S: AnsiString) : PyChar;
begin
 Result:=PAnsiChar(S);
end;
{$ENDIF}

{$IFDEF PyProfiling}
//Based on: https://stackoverflow.com/questions/1796510/accessing-a-python-traceback-from-the-c-api
function PythonGetStackTrace() : TStringList;
var
 tstate: PyThreadState;
 frame: PyFrameObject;
 LineNumber: Integer;
 Filename, Funcname: PyChar;
begin
 Result := TStringList.Create;
 tstate := PyThreadState_GET();
 if tstate = nil then
   Exit;
 frame := tstate^.frame;
 if frame = nil then
   Exit;

  while (frame<>nil) do
  begin
    {$IFDEF PYTHON23}
    LineNumber := PyCode_Addr2Line(frame^.f_code, frame^.f_lasti);
    {$ELSE}
    LineNumber := frame^.lineno;
    {$ENDIF}
    Filename := PyString_AsString(frame^.f_code^.co_filename);
    Funcname := PyString_AsString(frame^.f_code^.co_name);
    Result.Add(Format('%s: %s, line %d', [Funcname, Filename, LineNumber]));
    frame := frame^.f_back;
  end;
end;
{$ENDIF}

{$IFDEF DebugPythonLeak}
const
  PythonObjectDumpFile = 'PythonObjectDump.txt';

procedure PythonObjectDump;
var
  Text: TStringList;
  I: Integer;
  SomePythonObject: PyObject;
  Q: QObject;
begin
  Text:=TStringList.Create;
  try
    Text.Add(QuArKVersion + ' ' + QuArKMinorVersion);

    Text.Add('-----');

    Text.Add(Format('%5.5s  %s  %s', ['RefCnt', 'Class', 'Object']));
    for I:=0 to g_PythonObjects.Count-1 do
    begin
      SomePythonObject := g_PythonObjects[I];
      Q:=QkObjFromPyObj(SomePythonObject);
      if Q=nil then
        Text.Add(Format('%5d  %s  nil', [SomePythonObject.ob_refcnt, SomePythonObject.ob_type.tp_name]))
      else
        Text.Add(Format('%5d  %s  %s', [SomePythonObject.ob_refcnt, SomePythonObject.ob_type.tp_name, Q.Name+Q.TypeInfo]));
    end;

    Text.SaveToFile(ExtractFilePath(ParamStr(0))+PythonObjectDumpFile);
  finally
    Text.Free;
  end;
end;

procedure TestPythonObjectDump;
begin
  if g_PythonObjects.Count>0 then
    if Windows.MessageBox(0, PChar(Format('Some Python objects were not correctly freed. This is a bug. Do you want to write a data report (%s.txt) ?', [PythonObjectDumpFile])), 'QuArK - DEBUGGING', MB_YESNO) = IDYES then
      PythonObjectDump;
end;
{$ENDIF}

//Careful! No error checking is performed.
(*function PyTuple_GET_SIZE(o: PyObject) : {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF};
begin
  Result:=PyVarObject(o).ob_size;
end;*)

//Careful! No error checking is performed.
(*function PyList_GET_SIZE(o: PyObject) : {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF};
begin
  Result:=PyVarObject(o).ob_size;
end;*)

//Careful! No error checking is performed.
(*function PyDict_GET_SIZE(o: PyObject) : {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF};
begin
  Result:=PyVarObject(o).ob_size;
end;*)

//Careful! No error checking is performed.
(*function PyString_GET_SIZE(o: PyObject) : {$IFDEF PYTHON25} Py_ssize_t {$ELSE} Integer {$ENDIF};
begin
  Result:=PyVarObject(o).ob_size;
end;*)

initialization
  PythonLib:=0;
{$IFDEF DebugPythonLeak}
  g_PythonObjects:=TList.Create;

finalization
  TestPythonObjectDump;
  g_PythonObjects.Free;
{$ENDIF}
end.
