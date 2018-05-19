#include "mainwindowimpl.h"
#include <QMessageBox>
#include <QCursor>
#include <QPoint>

#include <QPainter>
#include <QRectF>

//
MainWindowImpl::MainWindowImpl( QWidget * parent, Qt::WFlags f) 
  : QMainWindow(parent, f)
{
  setupUi(this);
  //connect(pushButton, SIGNAL(clicked()), this, SLOT(pokus()));
  //connect(pridej_login, SIGNAL(clicked()), this, SLOT(click_pridej_login()));
  
  //connect(pushButton, SIGNAL(clicked()), this, SLOT(pokus_klik()));
  
    
  
  //connect(label_6, SIGNAL(linkActivated(const QString & )), this, SLOT(myslot(const QString &)));

  //tab->setStyleSheet("QCheckBox:hover#checkBox_6 { color: red; }");
  //kurva!
  //label_6->setText(tr("<a style='color: red;' href='http://www.google.com'>HIT HERE</a>"));
  
  //connect(checkBox_6, SIGNAL(clicked()), this, SLOT(pokus_klik()));
   
  //listView->WidthMode = Maximum;
  //int wid = listView->addColumn("pokus", 20);
  
  //QDirModel model;
//  QDirModel model;

  //QTreeView tree;
  //tree.setModel(&model);

  //listView->
  //listWidget->addItem(trUtf8("ašč řšřž zrřžšču"));
  
  //connect(pridej_login, SIGNAL(clicked()), this, SLOT(click_pridej_login()));
  

  //listWidget->
}

/*
void MainWindowImpl::pokus()
{
  QMessageBox::information(this, tr("Info..."), "ahojky");
}*/

//prida radky pro login
void MainWindowImpl::click_pridej_login()
{
  //QMessageBox::information(this, tr("Info..."), "ahojky přídávání loginu");
  tabulka_loginu->setRowCount(tabulka_loginu->rowCount() + 1);
  //tabWidget->setStyleSheet("checkBox_3 { color: red; }");
  
}

void MainWindowImpl::pokus_klik()
{
  QPoint m = QCursor::pos();
  listWidget->addItem("ahoj: " + QString::number(m.x()));
}
