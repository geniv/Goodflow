unit Download;

interface

uses
  Windows, Messages, SysUtils, Classes, Controls, StdCtrls, URLMon;

type
  TDownload = class(TButton)
  private
   FOdkud,FKam:string;
   FKom:boolean;
   FCo:string;
    { Private declarations }
  protected

    { Protected declarations }
  public
    constructor Create(AOwner:TComponent);override;
    procedure click;override;
    function Stahni(Odkud,Kam,Co:string):boolean;
    { Public declarations }
  published
    property Odkud:string read FOdkud write FOdkud;
    property Kam:string read FKam write FKam;
    property Dokonceno:boolean read FKom;
    property Soubor:string read Fco write FCo;
    { Published declarations }
  end;

procedure Register;

implementation

constructor TDownload.Create(AOwner:TComponent);
begin
inherited Create(AOwner);
FOdkud:='http://';
FKam:='C:';
FCo:='soubor.exe';
end;

procedure TDownload.click;
begin
inherited click;
if(FOdkud<>'')and(FKam<>'')and(FCo<>'')then
 begin
  if UrlDownloadToFile(nil,PChar(FOdkud+'/'+FCo),PChar(FKam+'\'+FCo),0,nil)=0 then
    FKom:=true
     else
    FKom:=false;
 end;
end;

function TDownload.Stahni(odkud,kam,co:string):Boolean;
begin
if URLMon.URLDownloadToFile(nil,pchar(odkud+'/'+co),pchar(kam+'\'+co),0,nil)=0 then
result:=true
else
result:=false;
end;


procedure Register;
begin
  RegisterComponents('Moje vlastni', [TDownload]);
end;

end.
