inherited QForm2: TQForm2
  OnDestroy = FormDestroy
  PixelsPerInch = 96
  TextHeight = 13
  object ListView1: TListView
    Left = 9
    Top = 13
    Width = 409
    Height = 246
    Align = alClient
    Columns = <>
    DragMode = dmAutomatic
    MultiSelect = True
    ReadOnly = True
    TabOrder = 4
    ViewStyle = vsList
    OnDblClick = ListView1DblClick
    OnEndDrag = ListView1EndDrag
    OnDragDrop = ListView1DragDrop
    OnDragOver = ListView1DragOver
    OnKeyDown = ListView1KeyDown
    OnMouseDown = ListView1MouseDown
    OnStartDrag = ListView1StartDrag
  end
end
