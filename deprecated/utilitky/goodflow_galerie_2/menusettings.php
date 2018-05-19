<?php
/*
 *      menusettings.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  final class MenuSettings {
    const URL = 'set';

    public static function getName() {
      return _('Settings');
    }

    public static function getXmlPath() {
      return XmlStorage::getAutoPath(__DIR__, __CLASS__);
    }

    public static function getXmlData() {
      return XmlStorage::getData(self::getXmlPath(), false);
    }

    //prenastaveni zmensovaciho pomeru...
    public static function getContent($co) {
      $result = NULL;
      $get_adress = Administration::getGetAdress();
      $xml_path = self::getXmlPath();

      switch ($co) {
        default:
          $data = XmlStorage::getData($xml_path, false);
//TODO oddelit hodnoty minsize a maxsize od sebe (kazde zvlast) a pridat osetreni na cisla
//poznamenat ze 0x0 je originalni velikost, WxH je pevna...
          $form = new Form;
          $form->addText('minsize', array('label' => _('Mini size'), 'value' => Core::isFill($data, 'minsize', Config::MINSIZE)))
                ->addText('maxsize', array('label' => _('Maxi size'), 'value' => Core::isFill($data, 'maxsize', Config::MAXSIZE)))
                ->addText('title', array('label' => _('Title'), 'value' => Core::isFill($data, 'title')))
                ->addTextArea('description', array('label' => _('Description'), 'value' => Core::isFill($data, 'description')))
                ->addCheckbox('robots', array('label' => _('Enable indexing robots'), 'state' => Core::isFill($data, 'robots')))
                ->addSubmit(__CLASS__.'_submit', array('value' => _('Save')));

          $result = $form;

          if ($form->isSubmitted()) {

            if (XmlStorage::setData($xml_path, $form->getValues())) {
              $result = _('successfully saved');
              Core::setRefresh(1, Core::getAbsoluteUrl(array($get_adress[0] => self::URL)));
            }
          }
        break;
      }

      return $result;
    }
  }

  //class ExceptionMenuSettings extends Exception {}

?>
