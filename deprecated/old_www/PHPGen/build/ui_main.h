/********************************************************************************
** Form generated from reading ui file 'main.ui'
**
** Created: Wed Apr 22 17:21:15 2009
**      by: Qt User Interface Compiler version 4.3.4
**
** WARNING! All changes made in this file will be lost when recompiling ui file!
********************************************************************************/

#ifndef UI_MAIN_H
#define UI_MAIN_H

#include <QtCore/QVariant>
#include <QtGui/QAction>
#include <QtGui/QApplication>
#include <QtGui/QButtonGroup>
#include <QtGui/QCheckBox>
#include <QtGui/QGroupBox>
#include <QtGui/QLabel>
#include <QtGui/QLineEdit>
#include <QtGui/QListWidget>
#include <QtGui/QMainWindow>
#include <QtGui/QPushButton>
#include <QtGui/QStatusBar>
#include <QtGui/QTabWidget>
#include <QtGui/QTableWidget>
#include <QtGui/QWidget>

class Ui_MainWindow
{
public:
    QWidget *centralwidget;
    QTabWidget *tabWidget;
    QWidget *tab;
    QCheckBox *checkBox_3;
    QGroupBox *groupBox;
    QCheckBox *checkBox;
    QCheckBox *checkBox_2;
    QGroupBox *groupBox_2;
    QCheckBox *checkBox_4;
    QCheckBox *checkBox_5;
    QLineEdit *lineEdit;
    QLabel *label;
    QLabel *label_3;
    QLineEdit *lineEdit_2;
    QGroupBox *groupBox_3;
    QLineEdit *lineEdit_4;
    QLineEdit *lineEdit_3;
    QLabel *label_4;
    QLabel *label_5;
    QLabel *label_2;
    QLineEdit *lineEdit_5;
    QWidget *tab_2;
    QGroupBox *groupBox_4;
    QPushButton *pridej_login;
    QTableWidget *tabulka_loginu;
    QListWidget *listWidget;
    QWidget *tab_3;
    QWidget *tab_4;
    QStatusBar *statusbar;

    void setupUi(QMainWindow *MainWindow)
    {
    if (MainWindow->objectName().isEmpty())
        MainWindow->setObjectName(QString::fromUtf8("MainWindow"));
    MainWindow->resize(713, 578);
    centralwidget = new QWidget(MainWindow);
    centralwidget->setObjectName(QString::fromUtf8("centralwidget"));
    tabWidget = new QTabWidget(centralwidget);
    tabWidget->setObjectName(QString::fromUtf8("tabWidget"));
    tabWidget->setGeometry(QRect(10, 10, 651, 541));
    tab = new QWidget();
    tab->setObjectName(QString::fromUtf8("tab"));
    tab->setEnabled(true);
    checkBox_3 = new QCheckBox(tab);
    checkBox_3->setObjectName(QString::fromUtf8("checkBox_3"));
    checkBox_3->setGeometry(QRect(130, 20, 91, 23));
    checkBox_3->setChecked(true);
    groupBox = new QGroupBox(tab);
    groupBox->setObjectName(QString::fromUtf8("groupBox"));
    groupBox->setGeometry(QRect(10, 10, 101, 71));
    checkBox = new QCheckBox(groupBox);
    checkBox->setObjectName(QString::fromUtf8("checkBox"));
    checkBox->setGeometry(QRect(10, 20, 91, 23));
    checkBox->setCheckable(true);
    checkBox->setChecked(true);
    checkBox_2 = new QCheckBox(groupBox);
    checkBox_2->setObjectName(QString::fromUtf8("checkBox_2"));
    checkBox_2->setGeometry(QRect(10, 40, 91, 23));
    checkBox_2->setChecked(true);
    groupBox_2 = new QGroupBox(tab);
    groupBox_2->setObjectName(QString::fromUtf8("groupBox_2"));
    groupBox_2->setGeometry(QRect(10, 90, 121, 171));
    checkBox_4 = new QCheckBox(groupBox_2);
    checkBox_4->setObjectName(QString::fromUtf8("checkBox_4"));
    checkBox_4->setGeometry(QRect(10, 20, 91, 23));
    checkBox_4->setChecked(true);
    checkBox_5 = new QCheckBox(groupBox_2);
    checkBox_5->setObjectName(QString::fromUtf8("checkBox_5"));
    checkBox_5->setGeometry(QRect(10, 90, 91, 23));
    lineEdit = new QLineEdit(groupBox_2);
    lineEdit->setObjectName(QString::fromUtf8("lineEdit"));
    lineEdit->setGeometry(QRect(10, 60, 91, 24));
    label = new QLabel(groupBox_2);
    label->setObjectName(QString::fromUtf8("label"));
    label->setGeometry(QRect(10, 40, 91, 21));
    label_3 = new QLabel(groupBox_2);
    label_3->setObjectName(QString::fromUtf8("label_3"));
    label_3->setGeometry(QRect(10, 120, 91, 18));
    lineEdit_2 = new QLineEdit(groupBox_2);
    lineEdit_2->setObjectName(QString::fromUtf8("lineEdit_2"));
    lineEdit_2->setGeometry(QRect(10, 140, 91, 24));
    groupBox_3 = new QGroupBox(tab);
    groupBox_3->setObjectName(QString::fromUtf8("groupBox_3"));
    groupBox_3->setGeometry(QRect(10, 270, 111, 171));
    lineEdit_4 = new QLineEdit(groupBox_3);
    lineEdit_4->setObjectName(QString::fromUtf8("lineEdit_4"));
    lineEdit_4->setGeometry(QRect(10, 90, 91, 24));
    lineEdit_3 = new QLineEdit(groupBox_3);
    lineEdit_3->setObjectName(QString::fromUtf8("lineEdit_3"));
    lineEdit_3->setGeometry(QRect(10, 40, 91, 24));
    label_4 = new QLabel(groupBox_3);
    label_4->setObjectName(QString::fromUtf8("label_4"));
    label_4->setGeometry(QRect(10, 20, 91, 18));
    label_5 = new QLabel(groupBox_3);
    label_5->setObjectName(QString::fromUtf8("label_5"));
    label_5->setGeometry(QRect(10, 70, 91, 18));
    label_2 = new QLabel(groupBox_3);
    label_2->setObjectName(QString::fromUtf8("label_2"));
    label_2->setGeometry(QRect(10, 120, 91, 18));
    lineEdit_5 = new QLineEdit(groupBox_3);
    lineEdit_5->setObjectName(QString::fromUtf8("lineEdit_5"));
    lineEdit_5->setGeometry(QRect(10, 140, 91, 24));
    tabWidget->addTab(tab, QString());
    tab_2 = new QWidget();
    tab_2->setObjectName(QString::fromUtf8("tab_2"));
    groupBox_4 = new QGroupBox(tab_2);
    groupBox_4->setObjectName(QString::fromUtf8("groupBox_4"));
    groupBox_4->setGeometry(QRect(10, 10, 261, 291));
    pridej_login = new QPushButton(groupBox_4);
    pridej_login->setObjectName(QString::fromUtf8("pridej_login"));
    pridej_login->setGeometry(QRect(10, 250, 75, 28));
    tabulka_loginu = new QTableWidget(groupBox_4);
    tabulka_loginu->setObjectName(QString::fromUtf8("tabulka_loginu"));
    tabulka_loginu->setGeometry(QRect(10, 30, 241, 221));
    tabulka_loginu->setFrameShape(QFrame::StyledPanel);
    tabulka_loginu->setFrameShadow(QFrame::Sunken);
    tabulka_loginu->setVerticalScrollBarPolicy(Qt::ScrollBarAlwaysOn);
    tabulka_loginu->setHorizontalScrollBarPolicy(Qt::ScrollBarAlwaysOff);
    tabulka_loginu->setProperty("showDropIndicator", QVariant(true));
    tabulka_loginu->setDragDropOverwriteMode(true);
    tabulka_loginu->setAlternatingRowColors(true);
    tabulka_loginu->setSelectionMode(QAbstractItemView::SingleSelection);
    tabulka_loginu->setSelectionBehavior(QAbstractItemView::SelectRows);
    tabulka_loginu->setTextElideMode(Qt::ElideRight);
    tabulka_loginu->setVerticalScrollMode(QAbstractItemView::ScrollPerItem);
    tabulka_loginu->setShowGrid(true);
    tabulka_loginu->setGridStyle(Qt::DotLine);
    tabulka_loginu->setCornerButtonEnabled(true);
    tabulka_loginu->setRowCount(3);
    tabulka_loginu->setColumnCount(2);
    listWidget = new QListWidget(tab_2);
    listWidget->setObjectName(QString::fromUtf8("listWidget"));
    listWidget->setGeometry(QRect(290, 40, 256, 192));
    tabWidget->addTab(tab_2, QString());
    tab_3 = new QWidget();
    tab_3->setObjectName(QString::fromUtf8("tab_3"));
    tabWidget->addTab(tab_3, QString());
    tab_4 = new QWidget();
    tab_4->setObjectName(QString::fromUtf8("tab_4"));
    tabWidget->addTab(tab_4, QString());
    MainWindow->setCentralWidget(centralwidget);
    statusbar = new QStatusBar(MainWindow);
    statusbar->setObjectName(QString::fromUtf8("statusbar"));
    MainWindow->setStatusBar(statusbar);

    retranslateUi(MainWindow);

    tabWidget->setCurrentIndex(1);


    QMetaObject::connectSlotsByName(MainWindow);
    } // setupUi

    void retranslateUi(QMainWindow *MainWindow)
    {
    MainWindow->setWindowTitle(QApplication::translate("MainWindow", "MainWindow", 0, QApplication::UnicodeUTF8));
    tab->setAccessibleName(QString());
    checkBox_3->setText(QApplication::translate("MainWindow", "Aktualizace", 0, QApplication::UnicodeUTF8));
    groupBox->setTitle(QApplication::translate("MainWindow", "Klenot", 0, QApplication::UnicodeUTF8));
    checkBox->setText(QApplication::translate("MainWindow", "Klenot", 0, QApplication::UnicodeUTF8));
    checkBox_2->setText(QApplication::translate("MainWindow", "Auto Klenot", 0, QApplication::UnicodeUTF8));
    groupBox_2->setTitle(QApplication::translate("MainWindow", "Administrace", 0, QApplication::UnicodeUTF8));
    checkBox_4->setText(QApplication::translate("MainWindow", "Administrace", 0, QApplication::UnicodeUTF8));
    checkBox_5->setText(QApplication::translate("MainWindow", "Aktivni admin", 0, QApplication::UnicodeUTF8));
    lineEdit->setText(QApplication::translate("MainWindow", "\\$admin", 0, QApplication::UnicodeUTF8));
    label->setText(QApplication::translate("MainWindow", "Adresa adminu:", 0, QApplication::UnicodeUTF8));
    label_3->setText(QApplication::translate("MainWindow", "Soubory menu:", 0, QApplication::UnicodeUTF8));
    lineEdit_2->setText(QApplication::translate("MainWindow", "./sekce", 0, QApplication::UnicodeUTF8));
    groupBox_3->setTitle(QApplication::translate("MainWindow", "GET adresy", 0, QApplication::UnicodeUTF8));
    lineEdit_4->setText(QApplication::translate("MainWindow", "modul", 0, QApplication::UnicodeUTF8));
    lineEdit_3->setText(QApplication::translate("MainWindow", "action", 0, QApplication::UnicodeUTF8));
    label_4->setText(QApplication::translate("MainWindow", "GET kam:", 0, QApplication::UnicodeUTF8));
    label_5->setText(QApplication::translate("MainWindow", "GET idmodul", 0, QApplication::UnicodeUTF8));
    label_2->setText(QApplication::translate("MainWindow", "GET submenu", 0, QApplication::UnicodeUTF8));
    lineEdit_5->setText(QApplication::translate("MainWindow", "sub", 0, QApplication::UnicodeUTF8));
    tabWidget->setTabText(tabWidget->indexOf(tab), QApplication::translate("MainWindow", "Nastaven\303\255: promenne", 0, QApplication::UnicodeUTF8));
    groupBox_4->setTitle(QApplication::translate("MainWindow", "Loginy do adminu", 0, QApplication::UnicodeUTF8));
    pridej_login->setText(QApplication::translate("MainWindow", "P\305\231idej", 0, QApplication::UnicodeUTF8));
    if (tabulka_loginu->columnCount() < 2)
        tabulka_loginu->setColumnCount(2);

    QTableWidgetItem *__colItem = new QTableWidgetItem();
    __colItem->setText(QApplication::translate("MainWindow", "Jmeno", 0, QApplication::UnicodeUTF8));
    tabulka_loginu->setHorizontalHeaderItem(0, __colItem);

    QTableWidgetItem *__colItem1 = new QTableWidgetItem();
    __colItem1->setText(QApplication::translate("MainWindow", "heslo", 0, QApplication::UnicodeUTF8));
    tabulka_loginu->setHorizontalHeaderItem(1, __colItem1);
    if (tabulka_loginu->rowCount() < 3)
        tabulka_loginu->setRowCount(3);

    bool __sortingEnabled = tabulka_loginu->isSortingEnabled();
    tabulka_loginu->setSortingEnabled(false);

    QTableWidgetItem *__item = new QTableWidgetItem();
    __item->setText(QApplication::translate("MainWindow", "Geniv", 0, QApplication::UnicodeUTF8));
    tabulka_loginu->setItem(0, 0, __item);

    QTableWidgetItem *__item1 = new QTableWidgetItem();
    __item1->setText(QApplication::translate("MainWindow", "93f9a5d3507bbd81db94663fd09dc866", 0, QApplication::UnicodeUTF8));
    tabulka_loginu->setItem(0, 1, __item1);

    QTableWidgetItem *__item2 = new QTableWidgetItem();
    __item2->setText(QApplication::translate("MainWindow", "Fugess", 0, QApplication::UnicodeUTF8));
    tabulka_loginu->setItem(1, 0, __item2);

    QTableWidgetItem *__item3 = new QTableWidgetItem();
    __item3->setText(QApplication::translate("MainWindow", "7c8c47575b1ff8a0a34e871a33b5954f", 0, QApplication::UnicodeUTF8));
    tabulka_loginu->setItem(1, 1, __item3);

    QTableWidgetItem *__item4 = new QTableWidgetItem();
    __item4->setText(QApplication::translate("MainWindow", "jurkix", 0, QApplication::UnicodeUTF8));
    tabulka_loginu->setItem(2, 0, __item4);

    QTableWidgetItem *__item5 = new QTableWidgetItem();
    __item5->setText(QApplication::translate("MainWindow", "2750e0d761a4d611073ae2ac3b171753", 0, QApplication::UnicodeUTF8));
    tabulka_loginu->setItem(2, 1, __item5);

    tabulka_loginu->setSortingEnabled(__sortingEnabled);

    tabWidget->setTabText(tabWidget->indexOf(tab_2), QApplication::translate("MainWindow", "UserPromenne", 0, QApplication::UnicodeUTF8));
    tabWidget->setTabText(tabWidget->indexOf(tab_3), QApplication::translate("MainWindow", "CofigPormenne", 0, QApplication::UnicodeUTF8));
    tabWidget->setTabText(tabWidget->indexOf(tab_4), QApplication::translate("MainWindow", "Promenne", 0, QApplication::UnicodeUTF8));
    Q_UNUSED(MainWindow);
    } // retranslateUi

};

namespace Ui {
    class MainWindow: public Ui_MainWindow {};
} // namespace Ui

#endif // UI_MAIN_H
