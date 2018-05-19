<?php
namespace classes;

/**
 * phpunit-skelgen --bootstrap ../loader.php --test -- "classes\Router" router.php
 * mv -v RouterTest.php ../test/
 */

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-05-28 at 11:37:51.
 */
class RouterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Router
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $_SERVER = array(
            'REQUEST_URI' => '/www/abcd/dfsds/asdffs/ds',
            'SCRIPT_NAME' => '/www/index.php',
        );

        $this->object = new Router;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers classes\Router::getModel
     */
    public function testGetModel()
    {
        $this->assertNull($this->object->getModel());
    }

    /**
     * @covers classes\Router::setModel
     */
    public function testSetModel()
    {
        $this->object->setModel('action/sekce/nesekce/asekce/usekce/nasekce/aaaaa/bbbbb/ccc');
        $this->assertEquals('action/sekce/nesekce/asekce/usekce/nasekce/aaaaa/bbbbb/ccc', $this->object->getModel());
    }

    /**
     * @covers classes\Router::setModel
     */
    public function testSetModel1() {
        $p = array(
          //hlavni
          'action/sekce/nesekce/asekce/usekce/nasekce/aaaaa/bbbbb/ccc',
          //dalsi jsou uz volitelne pro konkretni pripady
          'actiony==kuksa/subjinaakce/subsub2/busbus4',
          'actionx==kuksa/subjinaakcex==ne/subsub2x/busbus4x',
          'action==galerie/substranka',
          'action==galerie/page==[0-9]+',
        );

        $this->object->setModel($p);
        $this->assertEquals($p, $this->object->getModel());
    }

    /**
     * @covers classes\Router::getDefault
     */
    public function testGetDefault()
    {
        $this->assertEquals('', $this->object->getDefault());
    }

    /**
     * @covers classes\Router::setDefault
     */
    public function testSetDefault()
    {
        $this->object->setDefault('a');
        $this->assertEquals('a', $this->object->getDefault());
    }

    /**
     * @covers classes\Router::setDefault
     */
    public function testSetDefault1()
    {
        $this->object->setDefault('a/b/c');
        $this->assertEquals('a/b/c', $this->object->getDefault());
    }

    /**
     * @covers classes\Router::getRequestUri
     */
    public function testGetRequestUri()
    {
        $this->assertEquals(array('abcd', 'dfsds', 'asdffs', 'ds'), $this->object->getRequestUri());
    }

    /**
     * @covers classes\Router::getRequest
     */
    public function testGetRequest()
    {
        $this->assertEquals('abcd/dfsds/asdffs/ds', $this->object->getRequest());
    }

    /**
     * @covers classes\Router::setRequest
     */
    public function testSetRequest()
    {
        $this->object->setRequest('xx/aaa/hh/rr/jj');
        $this->assertEquals('xx/aaa/hh/rr/jj', $this->object->getRequest());
    }

    /**
     * @covers classes\Router::getUri
     */
    public function testGetUri()
    {
        $this->object->setModel('action/sekce/nesekce/asekce/usekce/nasekce/aaaaa/bbbbb/ccc');
        $this->assertEquals(array('action' => 'abcd', 'sekce' => 'dfsds', 'nesekce' => 'asdffs', 'asekce' => 'ds'), $this->object->getUri());
    }

    /**
     * @covers classes\Router::getUri
     */
    public function testGetUri2()
    {
        $p = array(
          //hlavni
          'action/sekce/nesekce/asekce/usekce/nasekce/aaaaa/bbbbb/ccc',
          //dalsi jsou uz volitelne pro konkretni pripady
          'actiony==kuksa/subjinaakce/subsub2/busbus4',
          'actionx==kuksa/subjinaakcex==ne/subsub2x/busbus4x',
          'action==galerie/substranka',
          'action==galerie/page==[0-9]+',
        );
        $this->object->setModel($p);
        $this->assertEquals(array('action' => 'abcd', 'sekce' => 'dfsds', 'nesekce' => 'asdffs', 'asekce' => 'ds'), $this->object->getUri());
    }

    /**
     * @covers classes\Router::getUri
     */
    public function testGetUri3()
    {
        $p = array(
          //hlavni
          'action/sekce/nesekce/asekce/usekce/nasekce/aaaaa/bbbbb/ccc',
          //dalsi jsou uz volitelne pro konkretni pripady
          'actiony==kuksa/subjinaakce/subsub2/busbus4',
          'actionx==kuksa/subjinaakcex==ne/subsub2x/busbus4x',
          'action==galerie/substranka',
          'action==galerie/page==[0-9]+',
        );
        $this->object->setModel($p)->setRequest('abcx');
        $this->assertEquals(array('action' => 'abcx'), $this->object->getUri());
    }

    /**
     * @covers classes\Router::getUri
     */
    public function testGetUri4()
    {
        $p = array(
          //hlavni
          'action/sekce/nesekce/asekce/usekce/nasekce/aaaaa/bbbbb/ccc',
          //dalsi jsou uz volitelne pro konkretni pripady
          'actiony==kuksa/subjinaakce/subsub2/busbus4',
          'actionx==kuksa/subjinaakcex==ne/subsub2x/busbus4x',
          'action==galerie/substranka',
          'action==galerie/page==[0-9]+',
        );
        $this->object->setModel($p)->setRequest('kuksa');
        $this->assertEquals(array('actiony' => 'kuksa'), $this->object->getUri());
    }

    /**
     * @covers classes\Router::getUri
     */
    public function testGetUri5()
    {
        $p = array(
          //hlavni
          'action/sekce/nesekce/asekce/usekce/nasekce/aaaaa/bbbbb/ccc',
          //dalsi jsou uz volitelne pro konkretni pripady
          'actiony==kuksa/subjinaakce/subsub2/busbus4',
          'actionx==kuksa/subjinaakcex==ne/subsub2x/busbus4x',
          'action==galerie/substranka',
          'action==galerie/page==[0-9]+',
        );
        $this->object->setModel($p)->setRequest('kuksa/ne');
        $this->assertEquals(array('actionx' => 'kuksa', 'subjinaakcex' => 'ne'), $this->object->getUri());
    }

    /**
     * @covers classes\Router::getUri
     */
    public function testGetUri6()
    {
        $p = array(
          //hlavni
          'action/sekce/nesekce/asekce/usekce/nasekce/aaaaa/bbbbb/ccc',
          //dalsi jsou uz volitelne pro konkretni pripady
          'actiony==kuksa/subjinaakce/subsub2/busbus4',
          'actionx==kuksa/subjinaakcex==ne/subsub2x/busbus4x',
          'action==galerie/substranka',
          'action==galerie/page==[0-9]+',
        );
        $this->object->setModel($p)->setRequest('kuksa/ano');
        $this->assertEquals(array('actiony' => 'kuksa', 'subjinaakce' => 'ano'), $this->object->getUri());
    }

    /**
     * @covers classes\Router::getUri
     */
    public function testGetUri7()
    {
        $p = array(
          //hlavni
          'action/sekce/nesekce/asekce/usekce/nasekce/aaaaa/bbbbb/ccc',
          //dalsi jsou uz volitelne pro konkretni pripady
          'actiony==kuksa/subjinaakce/subsub2/busbus4',
          'actionx==kuksa/subjinaakcex==ne/subsub2x/busbus4x',
          'action==galerie/substranka',
          'action==galerie/page==[0-9]+',
        );
        $this->object->setModel($p)->setRequest('galerie/ano');
        $this->assertEquals(array('action' => 'galerie', 'substranka' => 'ano'), $this->object->getUri());
    }

    /**
     * @covers classes\Router::getUri
     */
    public function testGetUri8()
    {
        $p = array(
          //hlavni
          'action/sekce/nesekce/asekce/usekce/nasekce/aaaaa/bbbbb/ccc',
          //dalsi jsou uz volitelne pro konkretni pripady
          'actiony==kuksa/subjinaakce/subsub2/busbus4',
          'actionx==kuksa/subjinaakcex==ne/subsub2x/busbus4x',
          'action==galerie/substranka',
          'action==galerie/page==[0-9]+',
        );
        $this->object->setModel($p)->setRequest('galerie/42');
        $this->assertEquals(array('action' => 'galerie', 'page' => '42'), $this->object->getUri());
    }

    /**
     * @covers classes\Router::request
     */
    public function testRequest()
    {
        $this->assertEquals('abcd/dfsds/asdffs/ds', Router::request());
    }

    /**
     * @covers classes\Router::uri
     */
    public function testUri()
    {
        $this->assertEquals(array('action' => 'abcd', 'sekce' => 'dfsds', 'nesekce' => 'asdffs', 'asekce' => 'ds'), Router::uri('action/sekce/nesekce/asekce/usekce/nasekce/aaaaa/bbbbb/ccc'));
    }

    /**
     * @covers classes\Router::uri
     */
    public function testUri2()
    {
        $this->assertEquals(array('action' => ''), Router::uri('action/sekce/nesekce/asekce/usekce/nasekce/aaaaa/bbbbb/ccc', '', 'a/b/c/d/e/f/g/h/i/j'));
    }

    /**
     * @covers classes\Router::uri
     */
    public function testUri3()
    {
        $this->assertEquals(array('action' => 'a', 'sekce' => 'b', 'nesekce' => 'c'), Router::uri('action/sekce/nesekce/asekce/usekce/nasekce/aaaaa/bbbbb/ccc', 'a/b/c', 'a/b/c/d/e/f/g/h/i/j'));
    }

    /**
     * @covers classes\Router::uri
     */
    public function testUri4()
    {
        $this->assertEquals(array('action' => 'a', 'sekce' => 'b', 'nesekce' => 'c'), Router::uri('action/sekce/nesekce/asekce/usekce/nasekce/aaaaa/bbbbb/ccc', 'a/b/c', 'a/b/c/d/e/f/g/h/i/j'));
    }

    /**
     * @covers classes\Router::uri
     */
    public function testUri5()
    {
        $this->assertEquals(array('action' => ''), Router::uri('action/sekce/nesekce/asekce/usekce/nasekce/aaaaa/bbbbb/ccc', null, 'a/b/c/d/e/f/g/h/i/j'));
    }

    /**
     * @covers classes\Router::uri
     */
    public function testUri6()
    {
        $this->assertEquals(array('a' => '1', 'b' => '2', 'c' => '3', 'd' => '4', 'e' => '5', 'f' => '6', 'g' => '7', 'h' => '8', 'i' => '9'), Router::uri('a/b/c/d/e/f/g/h/i/j', null, '1/2/3/4/5/6/7/8/9'));
    }
    
    /**
     * @covers classes\Router::uri
     */
    public function testUri7()
    {
        $this->assertEquals(array('a' => ''), Router::uri('a/b/c/d/e/f/g/h/i/j', null, ''));
    }
    
    /**
     * @covers classes\Router::uri
     */
    public function testUri8()
    {
        $this->assertEquals(array('b' => '2', 'c' => '3', 'd' => '4', 'e' => '5', 'f' => '6', 'g' => '7', 'h' => '8', 'i' => '9'), Router::uri('a/b/c/d/e/f/g/h/i/j', null, '1/2/3/4/5/6/7/8/9', 1));
    }
    
    /**
     * @covers classes\Router::uri
     */
    public function testUri9()
    {
        $this->assertEquals(array('c' => '3', 'd' => '4', 'e' => '5', 'f' => '6', 'g' => '7', 'h' => '8', 'i' => '9'), Router::uri('a/b/c/d/e/f/g/h/i/j', null, '1/2/3/4/5/6/7/8/9', 2));
    }
    
    /**
     * @covers classes\Router::uri
     */
    public function testUri10()
    {
        $this->assertEquals(array('c' => '3', 'd' => '4', 'e' => '5', 'f' => '6'), Router::uri('a/b/c/d/e/f/g/h/i/j', null, '1/2/3/4/5/6/7/8/9', 2, 4));
    }
    
    /**
     * @covers classes\Router::uri
     */
    public function testUri11()
    {
        $this->assertEquals(array('g' => '7', 'h' => '8', 'i' => '9'), Router::uri('a/b/c/d/e/f/g/h/i/j', null, '1/2/3/4/5/6/7/8/9', -3));
    }
    
    /**
     * @covers classes\Router::uri
     */
    public function testUri12()
    {
        $this->assertEquals(array('d' => '4', 'e' => '5', 'f' => '6'), Router::uri('a/b/c/d/e/f/g/h/i/j', null, '1/2/3/4/5/6/7/8/9', 3, -3));
    }

    public function testMigrateTest() 
    {       
       $_SERVER = array('REQUEST_URI' => '/www/svn/goodflow_cook/reciped/dfsds/asdffs/ds',
                        'SCRIPT_NAME' => '/www/svn/goodflow_cook/index.php',
                        );
      
        $r = new Router();

        $this->assertEquals('reciped/dfsds/asdffs/ds', $r->getRequest());

        $this->assertEquals('reciped/dfsds/asdffs/ds', Router::request());

        $r = new Router;

        $model = array('action/subakce/id/di/ouje');

        $this->assertEquals(array('action' => 'reciped', 'subakce' => 'dfsds', 'id' => 'asdffs', 'di' => 'ds'), $r->setModel($model)->getUri());
        $this->assertEquals(array('subakce' => 'dfsds', 'id' => 'asdffs', 'di' => 'ds'), $r->setModel($model)->getUri(1));
        $this->assertEquals(array('action' => 'reciped', 'subakce' => 'dfsds'), $r->setModel($model)->getUri(0, 2));
        $this->assertEquals(array('subakce' => 'dfsds', 'id' => 'asdffs'), $r->setModel($model)->getUri(1, 2));

        $r = new Router;

        $r->setRequest('akce')
          ->setModel($model);
        $this->assertEquals(array('action' => 'akce'), $r->getUri());

        $r = new Router;
        $r->setDefault('domu')
          ->setModel($model)
          ->setRequest('');

        $this->assertEquals(array('action' => 'domu'), $r->getUri());

        $r->setDefault('domu/sekce1');
        $this->assertEquals(array('action' => 'domu', 'subakce' => 'sekce1'), $r->getUri());

        $r->setModel(array());
        //~ $this->assertEquals($model, $r->getModel());
        $this->assertEquals(array(), $r->getModel());

        $this->assertEquals('domu/sekce1', $r->getDefault());

        $model = array('action/subakce');
        $r->setModel($model)
          ->setRequest('pokus/sekce/dalsisekce');
        $this->assertEquals(array('action' => 'domu', 'subakce' => 'sekce1'), $r->getUri());

        $r->setRequest('pokus/sekce');
        $this->assertEquals(array('action' => 'pokus', 'subakce' => 'sekce'), $r->getUri());

        $this->assertEquals(array('pokus', 'sekce'), $r->getRequestUri());

        $r->setRequest('pokus');
        $this->assertEquals(array('action' => 'pokus'), $r->getUri());

        $r->setRequest('');
        $this->assertEquals(array('action' => 'domu', 'subakce' => 'sekce1'), $r->getUri());

        $r = new Router;
        $r->setModel(array('action/subakce/subsub/busbus'))
          ->setRequest('')
          ->setDefault('');

        $this->assertEquals(array('action' => ''), $r->getUri());

        $r = new Router;
        $r->setModel(array('action/subakce/subsub/busbus',
                                'action==kuksa/subjinaakce/subsub2/busbus4')
                          )
          ->setRequest('kuksa/franta/alojs');
        $this->assertEquals(array('action' => 'kuksa', 'subjinaakce' => 'franta', 'subsub2' => 'alojs'), $r->getUri());

        $r = new Router;
        $r->setModel(array('action/subakce/subsub/busbus',
                                'action==galerie/page==[0-9]+')
                          )
          ->setRequest('galerie/44');
        $this->assertEquals(array('action' => 'galerie', 'page' => '44'), $r->getUri());

        // 1. chyba opravena a otestovana z provozu
        $_SERVER = array('REQUEST_URI' => '/texturepacky',
                        'SCRIPT_NAME' => '/index.php',
                        );
        $r = new Router;
        $this->assertEquals(array('action' => 'texturepacky'), $r->setModel('action/sekce')->getUri());
        $this->assertEquals('texturepacky', Router::request()); //bugfix


        $_SERVER = array('REQUEST_URI' => '/www/git/goodflow/gmr_hosting/',
                        'SCRIPT_NAME' => '/www/git/goodflow/gmr_hosting/index.php',
                        );
        $r = new Router;
        $r->setRequest('');
        $this->assertEquals(array('action' => ''), $r->setModel('action/sekce')->getUri());
        $this->assertEquals('', Router::request()); // bugfix #2
    }
}
