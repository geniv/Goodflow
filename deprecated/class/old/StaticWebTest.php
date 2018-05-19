<?php
namespace classes;

//~ classes\StaticWeb, classes\IPage

/**
 * phpunit-skelgen --test -- "classes\StaticWeb" StaticWeb.php
 * mv -v StaticWebTest.php ../test/
 * phpunit --bootstrap ../classes/StaticWeb.php StaticWebTest
 */

  class page1 implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Stránka 1',
                  'addition' => 'co děláme',
                  'idsekce' => 'hlavni');
    }

    //extra JS pro danou stranku
    public static function getJS() {}

    //extra CSS pro danou stranku
    public static function getCSS() {}

    //obsah
    public static function getContent() {
      $result = 'obsah page1';
      return $result;
    }
  }

  class page2 implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Stránka 2',
                  'addition' => 'co děláme 2',
                  'idsekce' => 'hlavni2');
    }

    //extra JS pro danou stranku
    public static function getJS() {
      return 'muj_js';
    }

    //extra CSS pro danou stranku
    public static function getCSS() {}

    //obsah
    public static function getContent() {
      $result = 'obsah page2';
      return $result;
    }
  }

  class page3 implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Stránka 3',
                  'addition' => 'co děláme 3',
                  'idsekce' => 'hlavni3');
    }

    //extra JS pro danou stranku
    public static function getJS() {}

    //extra CSS pro danou stranku
    public static function getCSS() {
      return 'muj_css';
    }

    //obsah
    public static function getContent() {
      $result = 'obsah page3';
      return $result;
    }
  }

  abstract class page41 implements IPage {  //musi byt abstract protoze nedodrzuji implementaci rozhranni!!!!
    public static function getName() {
      return array('name' => 'Stránka 41',
                  'addition' => 'co děláme 41',
                  'idsekce' => 'hlavni41');
    }
  }

  abstract class page51 implements IPage {
    public static function getName() {
      return array('name' => 'Stránka 51',
                  'addition' => 'co děláme 51',
                  'idsekce' => 'hlavni51');
    }
  }

  abstract class page61 implements IPage {
    public static function getName() {
      return array('name' => 'Stránka 61',
                  'addition' => 'co děláme 61',
                  'idsekce' => 'hlavni61');
    }
  }

  class pageAdmin implements IPage {
    const VISIBLE = false;
    public static function getName() {
      return array('name' => 'Stránka admin',
                  'addition' => 'co děláme admin',
                  'idsekce' => 'hlavniAdmin');
    }

    //obsah
    public static function getContent() {
      $result = 'obsah admin';
      return $result;
    }
  }

/**
 * Generated by PHPUnit_SkeletonGenerator on 2012-09-15 at 17:01:47.
 */
class StaticWebTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var StaticWeb
     */
    protected $object, $menu;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $_SERVER = array('REQUEST_URI' => '/www/svn/goodflow_cook/reciped/dfsds/asdffs/ds',
                        'SCRIPT_NAME' => '/www/svn/goodflow_cook/index.php',
                        );

        $this->object = new StaticWeb(array('lv1/lv2/lv3/lv4'));

        //var_dump(__NAMESPACE__);

        $this->menu = array('' => 'classes\page1',
                            'a' => 'classes\page2',
                            'b' => array('e' => 'classes\page41',
                                        '' => 'classes\page3',
                                        'f' => array('' => 'classes\page51',
                                                    'g' => array('' => 'classes\page61',
                                                                )
                                                    ),
                                        ),
                            'admin' => 'classes\pageAdmin',
                            );
        $this->object->setLoadMenu($this->menu);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @expectedException classes\ExceptionStaticWeb
     */
    public function testException1() {
      $sw = new StaticWeb(array());  //nezadane route pravidlo
    }

    /**
     * @expectedException classes\ExceptionStaticWeb
     */
    public function testException2() {
      $sw = new StaticWeb(array('a/b/c'));
      $sw->getCurrentClass(); //nenactene menu
    }

    /**
     * @expectedException classes\ExceptionStaticWeb
     */
    public function testException3() {
      $sw = new StaticWeb(array('a/b/c'));
      $sw->setLoadMenu($this->menu);
      $sw->getMenu(array());  //prazdne pole
    }

    /**
     * @expectedException classes\ExceptionStaticWeb
     */
    public function testException4() {
      $sw = new StaticWeb(array('a/b/c'));
      $sw->setLoadMenu($this->menu);
      $sw->getMenu(array('obal' => 'ahoj'));  //obal neni callback
    }

    /**
     * @expectedException classes\ExceptionStaticWeb
     */
    public function testException5() {
      $sw = new StaticWeb(array('a/b/c'));
      $sw->setLoadMenu($this->menu);
      $sw->getMenu(array('menu' => 'ahoj'));  //menu neni callback
    }

    /**
     * @expectedException classes\ExceptionStaticWeb
     */
    public function testException6() {
      $sw = new StaticWeb(array('a/b/c'));
      $sw->setLoadMenu($this->menu);
      $sw->getMenu(array('obalA' => 'ahoj'));  //spatny index, obal je, neni menu
    }

    /**
     * @expectedException classes\ExceptionStaticWeb
     */
    public function testException7() {
      $sw = new StaticWeb(array('a/b/c'));
      $sw->setLoadMenu($this->menu);
      $sw->getMenu(array('menuA' => 'ahoj'));  //spatny index, obal je, neni menu
    }

    /**
     * @expectedException classes\ExceptionStaticWeb
     */
    //~ public function testException8() {  //FIXME musi byt chybny!
      //~ $this->object->setRequestUri('b/e');
      //~ $this->object->getContent();
    //~ }

    /**
     * @expectedException classes\ExceptionStaticWeb
     */
    //~ public function testException9() {
      //~ $this->object->setRequestUri('b/e');
      //~ $this->object->getJS();
    //~ }

    /**
     * @expectedException classes\ExceptionStaticWeb
     */
    //~ public function testException10() {
      //~ $this->object->setRequestUri('b/e');
      //~ $this->object->getCSS();
    //~ }

    /**
     * @expectedException classes\ExceptionStaticWeb
     */
    public function testException11() {
      $sw = new StaticWeb(array('a/b/c'));
      $sw->getMenu(array('menu' => 'ahoj'));  //neni definovane menu
    }

    /**
     * @covers StaticWeb::setDefaultUri
     */
    public function testSetDefaultUri()
    {
        $sw = new StaticWeb(array('aa/bb/cc'));
        $sw->setLoadMenu($this->menu);
        $this->assertEquals('', $sw->getDefaultUri());
        $this->assertEquals('classes\page1', $sw->getCurrentClass());
        $this->assertEquals(array('aa' => ''), $sw->getUri());
        $this->assertEquals(array('classes\page1'), $sw->getArrayClass());

        $sw->setDefaultUri('a');
        $this->assertEquals('a', $sw->getDefaultUri());
        $this->assertEquals('classes\page2', $sw->getCurrentClass());
        $this->assertEquals(array('aa' => 'a'), $sw->getUri());
        $this->assertEquals(array('classes\page2'), $sw->getArrayClass());

        $sw->setRequestUri('b');
        $this->assertEquals('b', $sw->getRequestUri());
        $this->assertEquals('classes\page3', $sw->getCurrentClass());
        $this->assertEquals(array('aa' => 'b'), $sw->getUri());
        $this->assertEquals(array('classes\page3'), $sw->getArrayClass());

        $sw->setRequestUri('b/e');
        $this->assertEquals('b/e', $sw->getRequestUri());
        $this->assertEquals('classes\page41', $sw->getCurrentClass());
        $this->assertEquals(array('classes\page3', 'classes\page41'), $sw->getArrayClass());

        $sw->setRequestUri('b/f/g');
        $this->assertEquals('b/f/g', $sw->getRequestUri());
        $this->assertEquals('classes\page61', $sw->getCurrentClass());
        $this->assertEquals(array('classes\page3', 'classes\page51', 'classes\page61'), $sw->getArrayClass());
    }

    /**
     * @covers StaticWeb::getTitle
     */
    public function testGetTitle()
    {
      $p1 = page1::getName();
      $this->assertEquals(' - '.$p1['name'], $this->object->getTitle());
    }

    /**
     * @covers StaticWeb::getMenu
     */
    public function testGetMenu()
    {
        $skel = array('obal' => function($row) {
                                  return implode('', $row['submenu']);//'<span>'.implode('', $row['submenu']).'</span>';
                                },
                      'menu' => function($row) {
                                  $result = '<a href="'.$row['url'].'">'.$row['name'].'</a>';
                                  return $result;
                                },
                      );
        $this->assertEquals('<a href="">Stránka 1</a><a href="a">Stránka 2</a><a href="b/e">Stránka 41</a><a href="b">Stránka 3</a><a href="b/f">Stránka 51</a><a href="b/f/g">Stránka 61</a>', implode('', $this->object->getMenu($skel)));
    }

    /**
     * @covers StaticWeb::getContent
     */
    public function testGetContent()
    {
        $this->object->setRequestUri('');
        $this->assertEquals('hlavni', $this->object->getVariable('idsekce'));
        $this->assertEquals('obsah page1', $this->object->getContent());

        $this->object->setRequestUri('a');
        $this->assertEquals('hlavni2', $this->object->getVariable('idsekce'));
        $this->assertEquals('obsah page2', $this->object->getContent());

        $this->object->setRequestUri('admin');
        $this->assertEquals('hlavniAdmin', $this->object->getVariable('idsekce'));
        $this->assertEquals('obsah admin', $this->object->getContent());
    }

    /**
     * @covers StaticWeb::getJS
     */
    public function testGetJS()
    {
        $this->object->setRequestUri('');
        $this->assertNull($this->object->getJS());

        $this->object->setRequestUri('a');
        $this->assertEquals('muj_js', $this->object->getJS());
    }

    /**
     * @covers StaticWeb::getCSS
     */
    public function testGetCSS()
    {
        $this->object->setRequestUri('');
        $this->assertNull($this->object->getCSS());

        $this->object->setRequestUri('b');
        $this->assertEquals('muj_css', $this->object->getCSS());
    }

    public function testSelfRoute()
    {
        $r = new Route();
        $r->setRouteModel(array('aa/bb/cc'))
          ->setDefaultUri('');
        $sw = new StaticWeb($r);

        $sw->setLoadMenu($this->menu);
        $this->assertEquals('', $sw->getDefaultUri());
        $this->assertEquals('classes\page1', $sw->getCurrentClass());
        $this->assertEquals(array('aa' => ''), $sw->getUri());
        $this->assertEquals(array('classes\page1'), $sw->getArrayClass());

        $sw->setDefaultUri('a');
        $this->assertEquals('a', $sw->getDefaultUri());
        $this->assertEquals('classes\page2', $sw->getCurrentClass());
        $this->assertEquals(array('aa' => 'a'), $sw->getUri());
        $this->assertEquals(array('classes\page2'), $sw->getArrayClass());

        $sw->setRequestUri('b');
        $this->assertEquals('b', $sw->getRequestUri());
        $this->assertEquals('classes\page3', $sw->getCurrentClass());
        $this->assertEquals(array('aa' => 'b'), $sw->getUri());
        $this->assertEquals(array('classes\page3'), $sw->getArrayClass());

        $sw->setRequestUri('b/e');
        $this->assertEquals('b/e', $sw->getRequestUri());
        $this->assertEquals('classes\page41', $sw->getCurrentClass());
        $this->assertEquals(array('classes\page3', 'classes\page41'), $sw->getArrayClass());

        $sw->setRequestUri('b/f/g');
        $this->assertEquals('b/f/g', $sw->getRequestUri());
        $this->assertEquals('classes\page61', $sw->getCurrentClass());
        $this->assertEquals(array('classes\page3', 'classes\page51', 'classes\page61'), $sw->getArrayClass());
    }
}
