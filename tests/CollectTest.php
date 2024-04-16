<?php

use PHPUnit\Framework\TestCase;
use Collect\Collect;

class CollectTest extends TestCase
{
    public function testKeys()
    {
        $collect = new Collect([13, 17]);
        $this->assertSame([0, 1], $collect->keys()->toArray(), 'Keys should be 0 and 1');

        $collect = new Collect([13 => 13, 17 => 17]);
        $this->assertSame([13, 17], $collect->keys()->toArray(), 'Keys should be 13 and 17');
    }

    public function testValues()
    {
        $collect = new Collect([13, 17]);
        $this->assertSame([13, 17], $collect->values()->toArray(), 'Values should be 13 and 17');
    }

    public function testGet()
    {
        $collect = new Collect([13, 17]);
        $this->assertSame(13, $collect->get(0), 'Get should be 13');
        $this->assertSame(17, $collect->get(1), 'Get should be 17');
        $this->assertSame([13, 17], $collect->get(), 'Get should be [13, 17]');
    }

    public function testExcept()
    {
        $collect = new Collect([13, 17]);
        $this->assertSame([1 => 17], $collect->except(0)->toArray(), 'Except should be [1 => 17]');
        $this->assertSame([0 => 13], $collect->except(1)->toArray(), 'Except should be [0 => 13]');
    }

    public function testOnly()
    {
        $collect = new Collect([13, 17]);
        $this->assertSame([0 => 13], $collect->only(0)->toArray(), 'Only should be [0 => 13]');
        $this->assertSame([1 => 17], $collect->only(1)->toArray(), 'Only should be [1 => 17]');
    }

    public function testFirst()
    {
        $collect = new Collect([13, 17]);
        $this->assertSame(13, $collect->first(), 'First should be 13');
    }

    public function testCount()
    {
        $collect = new Collect([13, 17]);
        $this->assertSame(2, $collect->count(), 'Count should be 2');
    }

    public function testToArray()
    {
        $collect = new Collect([13, 17]);
        $this->assertSame([13, 17], $collect->toArray(), 'ToArray should be [13, 17]');
    }

    public function testSearch()
    {
        $collect = new Collect([
            ['id' => 1, 'color' => 'Blue'],
            ['id' => 2, 'color' => 'Yellow'],
            ['id' => 3, 'color' => 'Orange'],
            ['id' => 4, 'color' => 'Yellow'],
        ]);

        $this->assertSame([
            ['id' => 2, 'color' => 'Yellow'],
            ['id' => 4, 'color' => 'Yellow'],
        ], $collect->search("color", "Yellow")->toArray(), 'Search should be [["id" => 2, "color" => "Yellow"], ["id" => 4, "color" => "Yellow"]]');
    }

    public function testMap()
    {
        $collect = new Collect([13, 17]);
        $this->assertSame([26, 34], $collect->map(function ($value) {
            return $value * 2;
        })->toArray(), 'Map should be [26, 34]');
    }

    public function testFilter()
    {
        $collect = new Collect([-1, 0, 1]);
        $this->assertSame([2 => 1], $collect->filter(function ($value) {
            return $value > 0;
        })->toArray(), 'Filter should be [1]');
    }

    public function testEach()
    {
        $collect = new Collect([13, 17]);
        $this->assertSame([13, 17], $collect->each(function ($value) {
            return $value * 2;
        })->toArray(), 'Each should be [26, 34]');
    }

    public function testUnshift() {
        $collect = new Collect([13, 17]);
        $this->assertSame([5, 13, 17], $collect->unshift(5)->toArray(), 'Unshift should be [5, 13, 17]');
    }

    public function testShift() {
        $collect = new Collect([13, 17]);
        $this->assertSame([17], $collect->shift()->toArray(), 'Shift should be [17]');
    }

    public function testPop() {
        $collect = new Collect([13, 17]);
        $this->assertSame([13], $collect->pop()->toArray(), 'Pop should be [13]');
    }

    // Test broken method
    public function testSplice() {
        $array = [13, 14, 17, 18];
        $collect = new Collect($array);
        $this->assertEquals([13, 18], $collect->splice([1, 2])->toArray());
    }
}
