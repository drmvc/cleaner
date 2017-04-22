<?php namespace DrMVC\Helpers;
include __DIR__ . "/../src/Arrays.php";

use PHPUnit\Framework\TestCase;

class arraysTest extends TestCase
{
    public $array;
    public $array_keys;
    public $dir;
    public $dir_array;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->array_keys = array(
            array("title" => "lemon", "count" => 4),
            array("title" => "orange", "count" => 2),
            array("title" => "banana", "count" => 9),
            array("title" => "apple", "count" => 5)
        );

        $this->array[1] = array('k1' => 'v1', 'k2' => 'v2');
        $this->array[2] = array('k2' => 'v2', 'k1' => 'v1');
        $this->array[3] = array('k1' => 'v1', 'k3' => 'v3');

        $this->dir = __DIR__ . '/dir4tests';
        $this->dir_array = array(
            'dummy.txt',
            'subdirectory1' => array(
                'dummy1.txt',
                'dummy2.txt'
            ),
            'subdirectory2' => array(
                'dummy.txt',
                'subdirectory3' => array(
                    'dummynator.txt'
                )
            )
        );
    }

    public function testIsMDArray()
    {
        $this->assertTrue(Arrays::is_md($this->array));
        $this->assertFalse(Arrays::is_md($this->array[1]));
    }

    public function testArrayEqual()
    {
        $this->assertTrue(Arrays::equivalent($this->array[1], $this->array[1]));
        $this->assertTrue(Arrays::equivalent($this->array[1], $this->array[2]));
        $this->assertFalse(Arrays::equivalent($this->array[1], $this->array[3]));
    }

    public function testSortByKey()
    {
        $out[1]['asc'] = Arrays::order_by($this->array_keys, 'title', SORT_ASC);
        $out[1]['desc'] = Arrays::order_by($this->array_keys, 'title', SORT_DESC);
        $out[2]['asc'] = Arrays::order_by($this->array_keys, 'count', SORT_ASC);
        $out[2]['desc'] = Arrays::order_by($this->array_keys, 'count', SORT_DESC);

        $this->assertFalse(print_r($out[1]['asc'], true) == print_r($this->array_keys, true));
        $this->assertFalse(print_r($out[1]['desc'], true) == print_r($this->array_keys, true));
        $this->assertFalse(print_r($out[2]['asc'], true) == print_r($this->array_keys, true));
        $this->assertFalse(print_r($out[2]['desc'], true) == print_r($this->array_keys, true));
    }

    public function testDirToArray()
    {
        $files = Arrays::dir_to_array($this->dir);
        $files_tree = print_r($files, true);
        $dir_tree = print_r($this->dir_array, true);
        $dir_tree2 = print_r($this->dir_array['subdirectory2'], true);

        $this->assertTrue($files_tree == $dir_tree);
        $this->assertFalse($files_tree == $dir_tree2);
    }

    public function testMDSearch()
    {
        $result1 = Arrays::md_search($this->array, $this->array[3], false);
        $result2 = Arrays::md_search($this->array, array('some' => 'value'), false);

        $this->assertTrue($result1[0] == 3);
        $this->assertFalse($result2);
    }
}