<?php

use KABBOUCHI\BigNumber;

it('plus', function () {
    expect(BigNumber::of(1)->plus(2)->toNumber())->toEqual(3);
});

it('toFixed', function () {
    expect(BigNumber::of(3.456)->toFixed())->toEqual('3.456')
        ->and(BigNumber::of(3.456)->toFixed(0))->toEqual('3')
        ->and(BigNumber::of(3.456)->toFixed(2))->toEqual('3.46');
});

it('multipliedBy', function () {
    expect(
        BigNumber::of(2)
            ->multipliedBy(3)
            ->times(4)
            ->toNumber()
    )
        ->toEqual(24);
});

it('negated', function () {
    expect(BigNumber::of(1.8)->negated()->toString())->toEqual('-1.8')
        ->and(BigNumber::of(-1.3)->negated()->toString())->toEqual('1.3');
});

it('absoluteValue', function () {
    expect(BigNumber::of(-1.8)->absoluteValue()->toString())->toEqual('1.8')
        ->and(BigNumber::of(-1.3)->abs()->toString())->toEqual('1.3');
});

it('isNegative', function () {
    expect(BigNumber::of(-1.8)->isNegative())->toBeTrue();
});

it('isPositive', function () {
    expect(BigNumber::of(1.8)->isPositive())->toBeTrue();
});

it('dividedBy', function () {
    expect(BigNumber::of(355)->dividedBy(113)->toString())->toEqual('3.141592920354');
});

it('minus', function () {
    expect(BigNumber::of(.3)->minus(.1)->toString())->toEqual('0.2');
});

it('max', function () {
    expect(BigNumber::max(1, 2, 3, 4)->toString())->toEqual('4');
});

it('min', function () {
    expect(BigNumber::min(1, 2, 3, 4)->toString())->toEqual('1');
});

it('sum', function () {
    expect(BigNumber::sum(1, 2, 3, 4)->toString())->toEqual('10');
});

it('isZero', function () {
    expect(BigNumber::of(0)->isZero())->toBeTrue();
});

it('isEqualTo', function () {
    expect(BigNumber::of(123)->isEqualTo(123))->toBeTrue();
});

it('toPrecision', function () {
    expect(BigNumber::of(3.456)->toPrecision())->toEqual('3.456')
        ->and(BigNumber::of(3.456)->toPrecision(0))->toEqual('3.456')
        ->and(BigNumber::of(3.456)->toPrecision(1))->toEqual('3')
    ->and(BigNumber::of(3.456)->toPrecision(2))->toEqual('3.5');
});

it('pow', function () {
    expect(
        BigNumber::of(1)
            ->div(5)
            ->times(BigNumber::of(10)->pow(18))
            ->toString()
    )->toEqual('200000000000000000');
});
