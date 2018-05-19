#ifndef MAINWINDOWIMPL_H
#define MAINWINDOWIMPL_H
//
#include <QMainWindow>
#include "ui_main.h"
//
class MainWindowImpl : public QMainWindow, public Ui::MainWindow
{
  Q_OBJECT

public:
  MainWindowImpl( QWidget * parent = 0, Qt::WFlags f = 0 );
  
//ClickLabel(QWidget *parent = 0, Qt::WindowFlags f = 0);
//ClickLabel(const QString &text, QWidget *parent = 0, Qt::WindowFlags f = 0);
//virtual ~ClickLabel();

private slots:
  //void pokus();
  void click_pridej_login();
  void pokus_klik();
};
#endif




